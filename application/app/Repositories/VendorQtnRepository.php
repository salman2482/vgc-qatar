<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for VendorQtnRepository
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Http\Controllers\VendorQtns;
use App\Mail\VendorQtnMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\DB;

use App\Models\User;
use Carbon\Carbon;

use App\Models\VendorQuotation;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class VendorQtnRepository
{
    
    /**
     * The projects repository instance.
     */
    protected $vendorqtns;

    /**
     * Inject dependecies
     */
    public function __construct(VendorQuotation $vendorqtns)
    {
        $this->vendorqtns = $vendorqtns;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object VendorQtnRepository collection
     */
    public function search($id = '', $data = [])
    {
        $vendorqtns = $this->vendorqtns->newQuery();
        
        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }
        
        // select first name from user and all records from vendor quotation
        $vendorqtns->selectRaw('users.first_name,vendor_quotations.*')
        ->join('users', 'users.id', '=', 'vendor_quotations.user_id');
        

        //params: vendorqtn id
        if (is_numeric($id)) {
            $vendorqtns->where('vendor_quotations.id', $id);
        }


        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $vendorqtns->where(function ($query) {
                $query->where('vendor_quotations.id','=',request('search_query'));
                $query->orWhere('rfq_ref','LIKE','%'.request('search_query').'%');
                $query->orWhere('receiving_date','LIKE','%'.request('search_query').'%');
                $query->orWhere('category','LIKE','%'.request('search_query').'%');
                $query->orWhere('qtn_ref_no','LIKE','%'.request('search_query').'%');
                $query->orWhere('total_value','LIKE','%'.request('search_query').'%');
                $query->orWhere('devlivery_time','LIKE','%'.request('search_query').'%');
                $query->orWhere('upload_qtn_copy','LIKE','%'.request('search_query').'%');
                $query->orWhere('upload_rfq_copy','LIKE','%'.request('search_query').'%');
                $query->orWhere('status','LIKE','%'.request('search_query').'%');
            });
        }

        // 


        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //others
                    switch (request('orderby')) {
                    case 'id':
                    $vendorqtns->orderBy('id', request('sortorder'));
                    break;
                    case 'rfq_ref':
                    $vendorqtns->orderBy('rfq_ref', request('sortorder'));
                    break;
                    case 'category':
                    $vendorqtns->orderBy('category', request('sortorder'));
                    break;
                    case 'receiving_date':
                    $vendorqtns->orderBy('receiving_date', request('sortorder'));
                    break;
                    case 'qtn_ref_no':
                    $vendorqtns->orderBy('qtn_ref_no', request('sortorder'));
                    break;
                    case 'devlivery_time':
                    $vendorqtns->orderBy('devlivery_time', request('sortorder'));
                    break;
                    case 'upload_qtn_copy':
                    $vendorqtns->orderBy('upload_qtn_copy', request('sortorder'));
                    break;
                    case 'upload_rfq_copy':
                    $vendorqtns->orderBy('upload_rfq_copy', request('sortorder'));
                    break;
                    case 'status':
                        $vendorqtns->orderBy('status', request('sortorder'));
                        break;
                    case 'total_value':
                        $vendorqtns->orderBy('total_value', request('sortorder'));
                        break;
                                                                                                                                                }
        } else {
            //default sorting
            $vendorqtns->orderBy(
                config('settings.ordering_vendorqtns.sort_by'),
                config('settings.ordering_vendorqtns.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }
        // dd($vendorqtns);

        return $vendorqtns->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$vendorqtn = $this->vendorqtns->find($id)) {
            Log::error("record could not be found", ['process' => '[VendorQtnRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'vendorqtn_id' => $id ?? '']);
            return false;
        }

        $oldStatus = $vendorqtn->status;
        $vendorqtn->status = request('vendorqtn_status');
        
    
        //save
        if ($vendorqtn->save()) {
            if($oldStatus != request('status')){
                $user = User::find($vendorqtn->user_id);
                Mail::to($user->email)->send(new VendorQtnMail($vendorqtn));
            }
            return $vendorqtn->id;
        } else {
            return false;
        }
    }


        /**
     * Create a new record
     * @return mixed int|bool project model object or false
     */
    public function create() {

        //save new user
        $vendorqtn = new $this->vendorqtns;

        $vendorqtn->status = 'WAITING FOR APPROVAL';

    
        //save and return id
        if ($vendorqtn->save()) {
            return $vendorqtn->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[VendorQtnRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
