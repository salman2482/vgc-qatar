<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for vendor po
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Mail\VendorPoMail;
use App\Models\User;

use Illuminate\Support\Facades\Mail;

use App\Models\VendorPo;
use App\Models\VendorQuotation;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class VendorPoRepository
{
    /**
     * The vendor po repository instance.
     */
    protected $vendorpos;

    /**
     * Inject dependecies
     */
    public function __construct(VendorPo $vendorpos)
    {
        $this->vendorpos = $vendorpos;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object vendorpo collection
     */
    public function search($id = '', $data = [])
    {
        $vendorpos = $this->vendorpos->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $vendorpos->selectRaw('*');

        //params: vendorpo id
        if (is_numeric($id)) {
            $vendorpos->where('id', $id);
        }


        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $vendorpos->where(function ($query) {
                $query->where('vendor_pos.id','=',request('search_query'));
                $query->orWhere('po_ref','LIKE','%'.request('search_query').'%');
                $query->orWhere('issuing_date','LIKE','%'.request('search_query').'%');
                $query->orWhere('qtn_ref_no','LIKE','%'.request('search_query').'%');
                $query->orWhere('category','LIKE','%'.request('search_query').'%');
                $query->orWhere('total_value','LIKE','%'.request('search_query').'%');
                $query->orWhere('terms_condition','LIKE','%'.request('search_query').'%');
                $query->orWhere('payment_method','LIKE','%'.request('search_query').'%');
                $query->orWhere('upload_qtn_copy','LIKE','%'.request('search_query').'%');
                $query->orWhere('upload_po_copy','LIKE','%'.request('search_query').'%');
                $query->orWhere('status','LIKE','%'.request('search_query').'%');
            });
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //others
                    switch (request('orderby')) {
                    case 'id':
                    $vendorpos->orderBy('id', request('sortorder'));
                    break;
                    case 'po_ref':
                    $vendorpos->orderBy('po_ref', request('sortorder'));
                    break;
                    case 'issuing_date':
                    $vendorpos->orderBy('issuing_date', request('sortorder'));
                    break;
                    case 'qtn_ref_no':
                    $vendorpos->orderBy('qtn_ref_no', request('sortorder'));
                    break;
                    case 'category':
                    $vendorpos->orderBy('category', request('sortorder'));
                    break;
                    case 'total_value':
                    $vendorpos->orderBy('total_value', request('sortorder'));
                    break;
                    case 'payment_method':
                    $vendorpos->orderBy('payment_method', request('sortorder'));
                    break;
                    case 'status':
                    $vendorpos->orderBy('status', request('sortorder'));
                    break;
                                                                        }
        } else {
            //default sorting
            $vendorpos->orderBy(
                config('settings.ordering_vendorpos.sort_by'),
                config('settings.ordering_vendorpos.sort_order')
            );
        }

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $vendorpos->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$vendorpo = $this->vendorpos->find($id)) {
            Log::error("record could not be found", ['process' => '[VendorPoRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'vendorpo_id' => $id ?? '']);
            return false;
        }

        $vendorpo->issuing_date	 = request('vendorpo_issuing_date');
        $vendorpo->qtn_ref_no = request('vendorpo_qtn_ref_no');
        $vendorpo->category = request('vendorpo_category');
        $vendorpo->total_value = request('vendorpo_total_value');
        $vendorpo->terms_condition = request('vendorpo_terms_condition');
        $vendorpo->payment_method = request('vendorpo_payment_method');
        $vendorpo->status = request('vendorpo_status');
        //save
        if ($vendorpo->save()) {
            $user = User::find($vendorpo->user_id);
            Mail::to($user->email)->send(new VendorPoMail($vendorpo));
            return $vendorpo->id;
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
        $vendorpo = new $this->vendorpos;
        $userId = VendorQuotation::select('user_id')->where('qtn_ref_no',request('vendorpo_qtn_ref_no'))->first();
        $vendorpo->user_id	 = $userId->user_id;
        $vendorpo->issuing_date	 = request('vendorpo_issuing_date');
        $vendorpo->qtn_ref_no = request('vendorpo_qtn_ref_no');
        $vendorpo->category = request('vendorpo_category');
        $vendorpo->total_value = request('vendorpo_total_value');
        $vendorpo->terms_condition = request('vendorpo_terms_condition');
        $vendorpo->payment_method = request('vendorpo_payment_method');
        $vendorpo->status = request('vendorpo_status');
        
    
        //save and return id
        if ($vendorpo->save()) {
            $vendorpo->po_ref = 'PO-REF-'.$vendorpo->id;
            $vendorpo->save();
            $user = User::find($vendorpo->user_id);
            Mail::to($user->email)->send(new VendorPoMail($vendorpo));
            return $vendorpo->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[VendorPoRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
