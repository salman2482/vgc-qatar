<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for VendorRfqRepository
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Http\Controllers\VendorRfqs;
use Carbon\Carbon;

use App\Models\VendorRfq;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class VendorRfqRepository
{
    
    /**
     * The projects repository instance.
     */
    protected $vendorrfqs;

    /**
     * Inject dependecies
     */
    public function __construct(VendorRfq $vendorrfqs)
    {
        $this->vendorrfqs = $vendorrfqs;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object VendorRfqRepository collection
     */
    public function search($id = '', $data = [])
    {
        $vendorrfqs = $this->vendorrfqs->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $vendorrfqs->selectRaw('*');

        //params: property id
        if (is_numeric($id)) {
            $vendorrfqs->where('id', $id);
        }
        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {
          
            $vendorrfqs->where(function ($query) {
                $query->where('id','=',request('search_query'));
                $query->orWhere('rfq_ref','LIKE','%'.request('search_query').'%');
                $query->orWhere('category','LIKE','%'.request('search_query').'%');
                $query->orWhere('priority','LIKE','%'.request('search_query').'%');
                $query->orWhere('due_date_request','LIKE','%'.request('search_query').'%');
                $query->orWhere('description','LIKE','%'.request('search_query').'%');
                $query->orWhere('uom','LIKE','%'.request('search_query').'%');
                $query->orWhere('qty','LIKE','%'.request('search_query').'%');
                $query->orWhere('required_quotation_validity','LIKE','%'.request('search_query').'%');
                $query->orWhere('status','LIKE','%'.request('search_query').'%');
            });
        }

        // 



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //others
                    switch (request('orderby')) {
                    case 'id':
                    $vendorrfqs->orderBy('id', request('sortorder'));
                    break;
                    case 'rfq_ref':
                    $vendorrfqs->orderBy('rfq_ref', request('sortorder'));
                    break;
                    case 'category':
                    $vendorrfqs->orderBy('category', request('sortorder'));
                    break;
                    case 'priority':
                    $vendorrfqs->orderBy('priority', request('sortorder'));
                    break;
                    case 'due_date_request':
                    $vendorrfqs->orderBy('due_date_request', request('sortorder'));
                    break;
                   
                    case 'required_quotation_validity':
                    $vendorrfqs->orderBy('required_quotation_validity', request('sortorder'));
                    break;
                    case 'status':
                    $vendorrfqs->orderBy('status', request('sortorder'));
                    break;             
                    }
        } else {
            //default sorting
            $vendorrfqs->orderBy(
                config('settings.ordering_vendorrfqs.sort_by'),
                config('settings.ordering_vendorrfqs.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $vendorrfqs->paginate($limit);
    }


     /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id) {

        //get the record
        if (!$vendorrfq = $this->vendorrfqs->find($id)) {
            Log::error("record could not be found", ['process' => '[VendorRfqRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'vendorrfq_id' => $id ?? '']);
            return false;
        }
    
        $vendorrfq->category = implode(",", request('vendorrfq_category'));
        $vendorrfq->priority = request('vendorrfq_priority');
        $vendorrfq->company_category = request('vendorrfq_company_category');
        $vendorrfq->due_date_request = request('vendorrfq_due_date_request');
        $vendorrfq->description = request('vendorrfq_description');
        $vendorrfq->uom = request('vendorrfq_uom');
        $vendorrfq->qty = request('vendorrfq_qty');
        $vendorrfq->required_quotation_validity = request('vendorrfq_required_quotation_validity');
    
        //save
        if ($vendorrfq->save()) {
            return $vendorrfq->id;
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
        $vendorrfq = new $this->vendorrfqs;

        $vendorrfq->category = implode(",", request('vendorrfq_category'));
        $vendorrfq->priority = request('vendorrfq_priority');
        $vendorrfq->company_category = request('vendorrfq_company_category');
        $vendorrfq->due_date_request = request('vendorrfq_due_date_request');
        $vendorrfq->description = request('vendorrfq_description');
        $vendorrfq->uom = request('vendorrfq_uom');
        $vendorrfq->qty = request('vendorrfq_qty');
        $vendorrfq->status = 'WAITING FOR APPROVAL';
        $vendorrfq->required_quotation_validity = request('vendorrfq_required_quotation_validity');
        $vendorrfq->requestor = auth()->user()->first_name.' '.auth()->user()->last_name;
        $dt = Carbon::now();
        $rd = $dt->toDateString(); 
        $vendorrfq->receiving_date = $rd;

    
        //save and return id
        if ($vendorrfq->save()) {
            $new = VendorRfq::find($vendorrfq->id);
            $new->rfq_ref = 'RFQ-'.$vendorrfq->id;
            $new->save();
            return $vendorrfq->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[VendorRfqRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

}
