<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\Quotation;
use Carbon\Carbon;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class QuotationRepository
{
    /**
     * The contracts repository instance.
     */
    protected $quotations;

    /**
     * Inject dependecies
     */
    public function __construct(Quotation $quotations)
    {
        $this->quotations = $quotations;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object property collection
     */
    public function search($id = '', $data = [])
    {
        $quotations = $this->quotations->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all
        $quotations->selectRaw('*');
        $quotations->leftJoin('clients', 'clients.client_id', '=', 'quotations.client_id');

        //params: contract id
        if (is_numeric($id)) {
            $quotations->where('id', $id);
        }
        //filter clients
        // if (request()->filled('clientid')) {
        //     $quotations->where('client_id', request('clientid'));
        //     dd($quotations->get());
        // }
        // search
        if (request()->filled('search_query') || request()->filled('query')) {

            $quotations->where(function ($query) {
                $query->where('id', '=', request('search_query'));
                $query->orWhere('ref_no', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('client_req_ref', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('delivered_by', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('delivery_method', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('status', 'LIKE', '%' . request('search_query') . '%');
            });
        }

        //
        //filter my leads (using the actions button)
        if (request()->filled('filter_my_quotations')) {
            //leads assigned to me
            $quotations->where('quotations.client_id', auth()->user()->clientid);
        }


        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('quotations', request('orderby'))) {
                $quotations->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'ref_no':
                    $quotations->orderBy('ref_no', request('sortorder'));
                    break;
                case 'client_req_ref':
                    $quotations->orderBy('client_req_ref', request('sortorder'));
                    break;
                case 'estimated_by':
                    $quotations->orderBy('estimated_by', request('sortorder'));
                    break;
                case 'delivery_method':
                    $quotations->orderBy('delivery_method', request('sortorder'));
                    break;
                case 'status':
                    $quotations->orderBy('status', request('sortorder'));
                    break;
            }
        } else {
            //default sorting
            $quotations->orderBy(
                config('settings.ordering_quotations.sort_by'),
                config('settings.ordering_quotations.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $quotations->paginate($limit);
    }


    /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id)
    {
        $input  = Carbon::now();
        $date = Carbon::parse($input)->format('Y-m-d');
        $result = $input->gt(request('expiration'));
        // dd($result);
        //get the record
        if (!$quotation = $this->quotations->find($id)) {
            Log::error("record could not be found", ['process' => '[QuotationRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        //general
        $quotation->client_rfq_ref = request('client_rfq_ref');
        $quotation->client_id = request('quotation_client_id');
        $quotation->issuance_date = request('issuance_date');
        $quotation->expiration = request('expiration');
        $quotation->delivery_date = request('delivery_date');
        $quotation->estimated_by = request('estimated_by');
        $quotation->delivered_by = request('delivered_by');
        $quotation->delivery_method = request('delivery_method');
        if (!$result) {
            $quotation->status = 'valid';
        } else {
            $quotation->status = 'expired';
        }
        // dd($quotation);
        //save
        if ($quotation->save()) {
            return $quotation->id;
        } else {
            return false;
        }
    }


    /**
     * Create a new record
     * @return mixed int|bool project model object or false
     */
    public function create()
    {

        //save new user
        $quotation = new $this->quotations;
        //data
        $quotation->client_rfq_ref = request('client_rfq_ref');
        $quotation->client_id = request('quotation_client_id');
        $quotation->ref_no = 'QUO-REF-' . random_int(5999, 99999);
        $quotation->issuance_date = request('issuance_date');
        $quotation->expiration = request('expiration');
        $quotation->delivery_date = request('delivery_date');
        $quotation->estimated_by = request('estimated_by');
        $quotation->delivered_by = request('delivered_by');
        $quotation->delivery_method = request('delivery_method');
        $quotation->status = 'valid';


        //save and return id
        if ($quotation->save()) {
            return $quotation->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[QuotationMgtRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }
}
