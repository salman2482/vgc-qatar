<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\ContractMgt;
use Carbon\Carbon;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class ContractMgtRepository
{
    /**
     * The contracts repository instance.
     */
    protected $contracts;

    /**
     * Inject dependecies
     */
    public function __construct(ContractMgt $contracts)
    {
        $this->contracts = $contracts;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object property collection
     */
    public function search($id = '', $data = [])
    {
        $contracts = $this->contracts->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all
        $contracts->leftJoin('clients', 'clients.client_id', '=', 'contract_mgts.client_id');

        $contracts->selectRaw('*');

        //params: contract id
        if (is_numeric($id)) {
            $contracts->where('id', $id);
        }

        //filter my contacts (using the actions button)
        if (request()->filled('filter_my_contracts')) {
            //contacts assigned to me
            $contracts->where('uploaded_by', auth()->id());
        }

        // //[data filter] - clients
        // if (isset($data['property_id'])) {
        //     $properties->where('id', $data['property_id']);
        // }


        // //apply filters
        // if ($data['apply_filters']) {

        //     //filter property id
        //     if (request()->filled('filter_property_id')) {
        //         $properties->where('id', request('filter_property_id'));
        //     }


        //     //filter: start date (start)
        //     if (request()->filled('filter_start_date_start')) {
        //         $properties->where('created_at', '>=', request('filter_start_date_start'));
        //     }
        // }


        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {

            $contracts->where(function ($query) {
                $query->where('id', '=', request('search_query'));
                $query->orWhere('ref_no', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('description', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('signed_by', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('project_value', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('category', 'LIKE', '%' . request('search_query') . '%');
            });
        }

        //



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('contract_mgts', request('orderby'))) {
                $contracts->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'ref_no':
                    $contracts->orderBy('title', request('sortorder'));
                    break;
                case 'description':
                    $contracts->orderBy('description', request('sortorder'));
                    break;
                case 'signed_by':
                    $contracts->orderBy('signed_by', request('sortorder'));
                    break;
                case 'project_value':
                    $contracts->orderBy('project_value', request('sortorder'));
                    break;
            }
        } else {
            //default sorting
            $contracts->orderBy(
                config('settings.ordering_contracts.sort_by'),
                config('settings.ordering_contracts.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $contracts->paginate($limit);
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
        $result = $input->gt(request('contract_expiry_date'));


        //get the record
        if (!$contract = $this->contracts->find($id)) {
            Log::error("record could not be found", ['process' => '[ContractRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        //general
        $contract->client_id = request('contract_client_id');
        $contract->ref_no = 'ref_' . Str::random(5);
        $contract->category = request('contract_category');
        $contract->description = request('contract_description');
        $contract->issuance_date = request('contract_issuance_date');
        $contract->signed_by = request('contract_signed_by');
        $contract->sarting_date = request('contract_starting_date');
        $contract->expiray_date = request('contract_expiry_date');
        $contract->renewal_date = request('contract_renewal_date');
        $contract->project_value = request('contract_project_value');
        $contract->remarks = request('contract_remarks');
        $contract->lpo_copy = request('contract_lpo_copy');
        $contract->contract_copy = request('contract_contract_copy');
        if (!$result) {
            $contract->status = 'valid';
        } else {
            $contract->status = 'expired';
        }
        //save
        if ($contract->save()) {
            return $contract->id;
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
        $contract = new $this->contracts;
        //data
        $contract->client_id = request('contract_client_id');
        $contract->ref_no = 'ref_' . Str::random(5);
        $contract->category = request('contract_category');
        $contract->description = request('contract_description');
        $contract->issuance_date = request('contract_issuance_date');
        $contract->signed_by = request('contract_signed_by');
        $contract->sarting_date = request('contract_starting_date');
        $contract->expiray_date = request('contract_expiry_date');
        $contract->renewal_date = request('contract_renewal_date');
        $contract->project_value = request('contract_project_value');
        $contract->remarks = request('contract_remarks');
        $contract->lpo_copy = request('contract_lpo_copy');
        $contract->contract_copy = request('contract_contract_copy');
        $contract->uploaded_by = auth()->user()->id;
        $contract->status = 'valid';

        //save and return id
        if ($contract->save()) {
            return $contract->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[ContractMgtRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }
}
