<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Models\DocumentManagment;
use App\Models\EmployeeBooking;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


class AdminEmployeeBookingRepository
{
    /**
     * The projects repository instance.
     */
    protected $employeeBookings;

    /**
     * Inject dependecies
     */
    public function __construct(EmployeeBooking $employeeBookings)
    {
        $this->employeeBookings = $employeeBookings;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object property collection
     */
    public function search($id = '', $data = [])
    {
        $employeeBookings = $this->employeeBookings->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all

        $employeeBookings->selectRaw('services.id as service_id,services.title,user_schedules.id as user_schedule_id,user_schedules.start_time,employee_bookings.*');
        $employeeBookings->join('services', 'services.id', '=', 'employee_bookings.service_id');
        $employeeBookings->leftjoin('user_schedules', 'user_schedules.id', '=', 'employee_bookings.user_schedule_id');
        // dd($employeeBookings->get());
        //params: property id
        if (is_numeric($id)) {
            $employeeBookings->where('employee_bookings.id', $id);
        }
        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {

            $employeeBookings->where(function ($query) {
                $query->orWhere('full_name', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('email', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('street_no', 'LIKE', '%' . request('search_query') . '%');
            });
        }

        //



        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('employee_bookings', request('orderby'))) {
                $employeeBookings->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $employeeBookings->orderBy('id', request('sortorder'));
                    break;
            }
        } else {
            //default sorting
            $employeeBookings->orderBy(
                config('settings.ordering_documents.sort_by'),
                config('settings.ordering_documents.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $employeeBookings->paginate($limit);
    }


    /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    // public function update($id)
    // {
    //     $input  = Carbon::now();
    //     $date = Carbon::parse($input)->format('Y-m-d');
    //     $result = $input->gt(request('document_expiration'));

    //     //get the record
    //     if (!$document = $this->documents->find($id)) {
    //         Log::error("record could not be found", ['process' => '[PropertyRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'project_id' => $id ?? '']);
    //         return false;
    //     }

    //     //general
    //     $document->subject = request('document_subject');
    //     $document->issue_date = request('document_issue_date');
    //     $document->delivery_date = request('document_delivery_date');
    //     $document->delivered_by = request('document_delivered_by');
    //     $document->delivery_method = request('document_delivery_method');
    //     $document->expiration = request('document_expiration');
    //     $document->submital_copy = request('document_submital_copy');
    //     $document->document_copy = request('document_document_copy');
    //     $document->category = request('category');
    //     $document->remarks = request('remarks');

    //     if (!$result) {
    //         $document->status = 'valid';
    //     } else {
    //         $document->status = 'expired';
    //     }
    //     // dd($document);
    //     //save
    //     if ($document->save()) {
    //         return $document->id;
    //     } else {
    //         return false;
    //     }
    // }


    /**
     * Create a new record
     * @return mixed int|bool project model object or false
     */
    // public function create()
    // {

    //     //save new user
    //     $document = new $this->documents;
    //     $document->ref_no = 'DOC-REF-' . random_int(5999, 99999);
    //     $document->subject = request('document_subject');
    //     $document->issue_date = request('document_issue_date');
    //     $document->delivery_date = request('document_delivery_date');
    //     $document->delivered_by = request('document_delivered_by');
    //     $document->delivery_method = request('document_delivery_method');
    //     $document->expiration = request('document_expiration');
    //     $document->submital_copy = request('document_submital_copy');
    //     $document->document_copy = request('document_document_copy');
    //     $document->category = request('category');
    //     $document->remarks = request('remarks');
    //     $document->uploaded_by = auth()->user()->id;
    //     $document->status = 'valid';

    //     //save and return id
    //     if ($document->save()) {
    //         return $document->id;
    //     } else {
    //         Log::error("record could not be created - database error", ['process' => '[DocumentRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
    //         return false;
    //     }
    // }
}
