<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\EmployeLegalDocument;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class EmployeeLegalRepository
{
    /**
     * The employeelegaldocument repository instance.
     */
    protected $employees;

    /**
     * Inject dependecies
     */
    public function __construct(EmployeLegalDocument $employees)
    {
        $this->employees = $employees;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object property collection
     */
    public function search($id = '', $data = [])
    {
        $employees = $this->employees->newQuery();



        $employees->selectRaw('*');

        //params: property id
        if (is_numeric($id)) {
            $employees->where('id', $id);
        }

        // filter my docs
        // if (request()->filled('filter_my_employee_documents')) {
        //     $employees->where('uploaded_by',auth()->id());
        // }
        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {

            $employees->where(function ($query) {
                $query->where('id', '=', request('search_query'));
                $query->orWhere('employee_no', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('employee_name', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('visa_no', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('id_no', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('contract_no', 'LIKE', '%' . request('search_query') . '%');
            });
        }

        //



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('employe_legal_documents', request('orderby'))) {
                $employees->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $employees->orderBy('id', request('sortorder'));
                    break;
                case 'employee_no':
                    $employees->orderBy('employee_no', request('sortorder'));
                    break;
                case 'employee_name':
                    $employees->orderBy('employee_name', request('sortorder'));
                    break;
            }
        } else {
            //default sorting
            $employees->orderBy(
                config('settings.ordering_employees.sort_by'),
                config('settings.ordering_employees.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $employees->paginate($limit);
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

        //get the record
        if (!$employee = $this->employees->find($id)) {
            Log::error("record could not be found", ['process' => '[EmployeeLegalRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
            return false;
        }

        //general
        $employee->employee_no = request('employee_no');
        $employee->employee_name = request('employee_name');
        $employee->visa_no = request('visa_no');
        $employee->id_no = request('id_no');
        $employee->expiration = request('expiration');
        $employee->passport_no = request('passport_no');
        $employee->passport_expiration = request('passport_expiration');
        $employee->contract_no = request('contract_no');
        $employee->contract_expiration = request('contract_expiration');
        $employee->arrival_date = request('arrival_date');
        $employee->working_starting_date = request('working_starting_date');
        $employee->phcc_no = request('phcc_no');
        $employee->phcc_expiration = request('phcc_expiration');
        $employee->joining_visa_no = request('joining_visa_no');
        $employee->working_status = request('status');


        if (!$result) {
            $employee->status = 'valid';
        } else {
            $employee->status = 'expired';
        }
        //save
        if ($employee->save()) {
            return $employee->id;
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
        $employee = new $this->employees;
        // $employee->ref_no = 'DOC-REF-'.random_int(5999,99999);
        $employee->employee_no = request('employee_no');
        $employee->employee_name = request('employee_name');
        $employee->visa_no = request('visa_no');
        $employee->id_no = request('id_no');
        $employee->expiration = request('expiration');
        $employee->passport_no = request('passport_no');
        $employee->passport_expiration = request('passport_expiration');
        $employee->contract_no = request('contract_no');
        $employee->contract_expiration = request('contract_expiration');
        $employee->arrival_date = request('arrival_date');
        $employee->working_starting_date = request('working_starting_date');
        $employee->phcc_no = request('phcc_no');
        $employee->phcc_expiration = request('phcc_expiration');
        $employee->joining_visa_no = request('joining_visa_no');
        $employee->uploaded_by = auth()->id();
        $employee->working_status = request('status');
        $employee->status = 'valid';


        //save and return id
        if ($employee->save()) {
            return $employee->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[DocumentRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }
}
