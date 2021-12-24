<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for projects
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\Http\Controllers\Lpo;
use Illuminate\Support\Facades\Mail;

use App\Mail\RfmToAdmin;
use App\Mail\RfmToHeadOfAccount;
use App\Mail\RfmToManager;
use App\Models\Settings;

use App\Repositories\UserRepository;

use App\Repositories\EventRepository;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Str;
use App\Models\LpoMgt;
use App\Models\Material;
use App\Models\Rfm;
use App\Models\RfmMaterial;
use App\Models\User as ModelsUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;


class RfmRepository
{
    /**
     * The projects repository instance.
     */
    protected $rfms;
    protected $lporepo;
    protected $eventrepo;
    protected $userrepo;
    /**
     * Inject dependecies
     */
    public function __construct(Rfm $rfms, LpoRepository $lporepo, EventRepository $eventrepo, UserRepository $userrepo)
    {
        $this->rfms = $rfms;
        $this->lporepo = $lporepo;
        $this->eventrepo = $eventrepo;
        $this->userrepo = $userrepo;
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @param array $data optional data payload
     * @return object property collection
     */
    public function search($id = '', $data = [])
    {

        $rfms = $this->rfms->newQuery();

        //default - always apply filters
        if (!isset($data['apply_filters'])) {
            $data['apply_filters'] = true;
        }

        // select all
        $rfms->selectRaw('users.id as user_id,users.first_name as first_name,clients.client_id as client_id,clients.client_company_name,rfms.*');
        $rfms->join('users', 'users.id', '=', 'rfms.inline_manager_id');
        $rfms->leftJoin('clients', 'clients.client_id', '=', 'rfms.user_client_id');
        //params: rfm id
        if (is_numeric($id)) {
            $rfms->where('rfms.id', $id);
        }


        //filter my leads (using the actions button)
        if (request()->filled('filter_my_rfms')) {
            $rfms->where('inline_manager_id', auth()->id())->where('is_material_added', 1);
            $rfms->orWhere('hoc_id', auth()->id())->where('is_material_added', 1);
            $rfms->orWhere('user_client_id',auth()->user()->clientid)->where('is_material_added',1);
        }

        // search
        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query') || request()->filled('query')) {

            $rfms->where(function ($query) {
                $query->where('rfms.id', '=', request('search_query'));
                $query->orWhere('rfms.ref_num', 'LIKE', '%' . request('search_query'));
                $query->orWhere('department', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('subject', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('site', 'LIKE', '%' . request('search_query') . '%');
            });
        }

        //

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            //direct column name
            if (Schema::hasColumn('rfms', request('orderby'))) {
                $rfms->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'id':
                    $rfms->orderBy('id', request('sortorder'));
                    break;
            }
        } else {
            //default sorting
            $rfms->orderBy(
                config('settings.ordering_rfms.sort_by'),
                config('settings.ordering_rfms.sort_order')
            );
        }

        //stats - count all

        // Get the results and return them.
        if (isset($data['limit']) && is_numeric($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = config('system.settings_system_pagination_limits');
        }

        return $rfms->paginate($limit);
    }


    /**
     * update a record
     * @param int $id project id
     * @return mixed int|bool  project id or false
     */
    public function update($id)
    {
        //get the record
        $rfm_id = '';


        if (!$rfm = $this->rfms->find($id)) {
            Log::error("record could not be found", ['process' => '[RfmRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'id' => $id ?? '']);
            return false;
        }

        if (isset(request()->client_id)) {
            $rfm->user_client_id = request('client_id');
            $rfm->rfm_type = true;
        }
        // assign hoa
        if (request()->rfm_hoa != '' || request()->rfm_hoa != null) {
            $rfm->hoc_id = request()->rfm_hoa;
            $hoa_email = ModelsUser::where('id',request()->rfm_hoa)->select('email')->first()->email;
            Mail::to($hoa_email)->send(new RfmToHeadOfAccount($rfm));
        }

        //  send to admin
        if (request()->send_to_admin == 'send_to_admin') {
            $rfm->assign_admin = 'assigned';
        }

        //  change status for admin
        if (request()->change_status == 'approved') {
            $rfm->status = 'approved';
            $rfm->approval = auth()->user()->is_admin ? auth()->user()->first_name . ' ' . auth()->user()->last_name : 'Administrator';
            $rfm_id = $id;
        }

        if (request()->change_status == 'rejected') {
            $rfm->status = 'rejected';
        }
        $rfm->supervisor_id = $rfm->supervisor_id;
        $rfm->inline_manager_id = request('rfm_clientid');
        $rfm->department = request('rfm_department');
        $rfm->subject = request('rfm_subject');
        $rfm->site = request('rfm_site');
        $rfm->material_id = request('rfm_material');
        $rfm->quantity = request('rfm_quantity');
        $rfm->due_date = request('rfm_due_date');
        $rfm->requestor = $rfm->requestor ?? '';
        $rfm->remarks = request('rfm_remarks');

        //save
        if ($rfm->save()) {
            if ($rfm_id != '' || $rfm_id != null) {
                $this->generateLpo($rfm_id);
                return $rfm->id;
            }
            return $rfm->id;
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
        $rfm = new $this->rfms;
        if (request()->rfm_hoa != '' || request()->rfm_hoa != null) {
            $rfm->hoc_id = request()->rfm_hoa;
        }

        //data
        $rfm->ref_num =  'RFM-REF-' . random_int(1999, 9999);
        $rfm->inline_manager_id = request('rfm_clientid');
        $rfm->department = request('rfm_department');
        $rfm->subject = request('rfm_subject');
        $rfm->site = request('rfm_site');
        $rfm->material_id = 1;
        $rfm->quantity = 1;
        $rfm->due_date = request('rfm_due_date');
        $rfm->requestor = auth()->user()->first_name;
        $rfm->remarks = request('rfm_remarks');
        $rfm->supervisor_id = auth()->user()->id;
        $rfm->status = 'submitted';


        //save and return id
        if ($rfm->save()) {
            // find manager email
            $manager_email = ModelsUser::where('id',$rfm->inline_manager_id)->select('email')->first()->email;
            Mail::to($manager_email)->send(new RfmToManager($rfm));
            return $rfm->id;
        } else {
            Log::error("record could not be created - database error", ['process' => '[RfmRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }


    public function generateLpo($id)
    {
        if (!$rfm = $this->rfms->find($id)) {
            Log::error("record could not be found", ['process' => '[RfmRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'id' => $id ?? '']);
            return false;
        }
        $total_value_of_materials = RfmMaterial::where('rfm_id', $id)->pluck('total')->sum();
        $old_lpo = LpoMgt::where('rfm_ref_no', $rfm->ref_num)->pluck('id');

        if (count($old_lpo) >= 1) {
            LpoMgt::destroy($old_lpo);
        }
        //save lpo
        if ($total_value_of_materials) {
            $lpo = new LpoMgt;
            //data
            $lpo->ref_no = 'PO-REF-' . random_int(1999, 9999);
            $lpo->rfm_ref_no = $rfm->ref_num;
            $lpo->department = $rfm->department;
            $lpo->subject = $rfm->subject;
            $lpo->site = $rfm->site;
            $lpo->value = $total_value_of_materials;
            $lpo->date_requested = $rfm->due_date;
            $lpo->requestor = $rfm->requestor;
            $lpo->remarks = $rfm->remarks;
            $lpo->status = $rfm->status;
            $lpo->rfm_copy_link = $rfm->download_link;
            $lpo->supervisor_id = $rfm->supervisor_id;
            $lpo->save();

            /** ----------------------------------------------
             * record event [rfm created]
             * ----------------------------------------------*/
            $data = [
                'event_creatorid' => auth()->id(),
                'event_item' => 'po_created',
                'event_item_id' => '',
                'event_item_lang' => 'po_created',
                'event_item_content' => $lpo->ref_num,
                'event_item_content2' => '',
                'event_parent_type' => 'rfm',
                'event_parent_id' => $lpo->id,
                'event_parent_title' => $lpo->site ?? '',
                'event_show_item' => 'yes',
                'event_show_in_timeline' => 'yes',
                'event_clientid' => auth()->id(),
                'eventresource_type' => 'lpo',
                'eventresource_id' => $lpo->id,
                'event_notification_category' => 'notifications_rfms_activity',
            ];
            //record event
            if ($event_id = $this->eventrepo->create($data)) {
                //get users
                $users = $this->userrepo->getClientUsers($lpo->id, 'all', 'ids');
                // //record notification
                // $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
            }
        }
        //save and return id
        // if ($lpo->save()) {
        //     return redirect()->back()->with('success','Record Added Successfully');
        // } else {
        //     Log::error("record could not be created - database error", ['process' => '[RfmRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
        //     return false;
        // }
    }
}
