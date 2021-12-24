<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for contacts
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
use App\Repositories\ClientRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\AttachmentRepository;
use App\Http\Responses\Employees\EditResponse;
use App\Http\Responses\Employees\IndexResponse;
use App\Http\Responses\Employees\StoreResponse;
use App\Http\Responses\Employees\CreateResponse;
use App\Http\Responses\Employees\UpdateResponse;
use App\Http\Responses\Employees\DestroyResponse;
use App\Models\Service;
use Illuminate\Support\Facades\Date;

class EmployeesController extends Controller
{

    /**
     * The users repository instance.
     */
    protected $userrepo;

    /**
     * The category repository instance.
     */
    protected $categoryrepo;

    /**
     * The client repository instance.
     */
    protected $clientrepo;
    protected $attachmentrepo;

    public function __construct(UserRepository $userrepo, CategoryRepository $categoryrepo, ClientRepository $clientrepo, AttachmentRepository $attachmentrepo)
    {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');
        // ->except(['fetchSchedules', 'scheduleView'])
        $this->middleware('contactsMiddlewareIndex');

        //dependencies
        $this->userrepo = $userrepo;
        $this->categoryrepo = $categoryrepo;
        $this->clientrepo = $clientrepo;
        $this->attachmentrepo = $attachmentrepo;
    }

    /**
     * Display a listing of contacts
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //get contacts
        request()->merge([
            'employee' => 'employee',
            'status' => 'active',
        ]);
        $contacts = $this->userrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('contacts'),
            'contacts' => $contacts,
        ];

        //show views
        return new IndexResponse($payload);
    }

    /**
     * Show the form for creating a new contact.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //page settings
        $page = $this->pageSettings('create');
        $services = Service::all();
        //reponse payload
        $payload = [
            'page' => $page,
            'services' => $services,
        ];

        //show the form
        return new CreateResponse($payload);
    }

    /**
     * Store a newly created contact in storage.
     * @param object ClientRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRepository $clientrepo)
    {
        //custom error messages
        $messages = [
            'clientid.exists' => __('lang.item_not_found'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'description' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
        ], $messages);

        //validation errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }

        //set other data (client role = 3)
        request()->merge([
            'type' => 'team',
            'role_id' => 16,
        ]);
        request()->merge([
            'is_employee'  => 1,
        ]);
        //password
        $password = str_random(9);

        //save contact
        if (!$userid = $this->userrepo->create(bcrypt($password))) {
            abort(409);
        }

        //get the contact
        $contacts = $this->userrepo->search($userid);
        $contact = $contacts->first();
        
        //[save attachments] loop through and save each attachment
        if (request()->filled('employee')) {
            foreach (request('employee') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employee',
                    'attachmentresource_id' => $contact->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_employee'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        
        $contact->services()->attach(request('service_id'));
        $contact->save();

        /** ----------------------------------------------
         * send email to user
         * ----------------------------------------------*/
        $data = [
            'password' => $password,
        ];
        $mail = new \App\Mail\UserWelcome($contact, $data);
        $mail->build();

        //counting rows
        $rows = $this->userrepo->search();
        $count = $rows->total();

        //reponse payload
        $payload = [
            'contacts' => $contacts,
            'count' => $count,
        ];

        //process reponse
        return new StoreResponse($payload);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id contact id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //page settings
        $page = $this->pageSettings('edit');
        $services = Service::all();
        //the user
        $user = \App\Models\User::Where('id', $id)->first();
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'employee')
            ->get();
        //reponse payload
        $payload = [
            'page' => $page,
            'user' => $user,
            'attachments' => $attachments,
            'services' => $services,
        ];

        //process reponse
        return new EditResponse($payload);
    }

    /**
     * Update the specified contact in storage.
     * @param int $id contact id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // dd(request()->all());
        //vars
        $original_owner = '';

        //validate the form
        $validator = Validator::make(request()->all(), [
            'first_name' => [
                'required',
            ],
            'last_name' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id, 'id'),
            ],
        ]);

        //validation errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }

        //get the user
        $user = \App\Models\User::Where('id', $id)->first();
         if (request()->filled('employee')) {
            foreach (request('employee') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employee',
                    'attachmentresource_id' => $user->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_employee'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        
        
        $user->services()->sync(request()->service_id);
        //update the user
        if (!$this->userrepo->update($id)) {
            abort(409);
        }

        //update accout owner
        if (request('account_owner') == 'on') {
            //get the current account owner
            $owner = \App\Models\User::Where('clientid', $user->clientid)->where('account_owner', 'yes')->first();
            //update owner
            $this->userrepo->updateAccountOwner($user->clientid, $id);
            //get original owner in friendly format
            $original_owner = $this->userrepo->search($owner->id);
        }

        //get the user
        $contacts = $this->userrepo->search($id);

        $contact = $contacts->first();

        //reponse payload
        $payload = [
            'contacts' => $contacts,
            'clientid' => $user->clientid,
            'original_owner' => $original_owner,
            'user' => $contact,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified contact from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //delete each record in the array
        $allrows = array();

        //get record
        if (!\App\Models\User::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        // //get it in useful format
        $employees = $this->userrepo->search($id);
        $employee = $employees->first();
        
        if ($attachments = $employee->attachments()->get()) {
        foreach ($attachments as $attachment) {
            if ($attachment->attachment_directory != '') {
                if (Storage::exists("files/$attachment->attachment_directory")) {
                    Storage::deleteDirectory("files/$attachment->attachment_directory");
                }
            }
            $attachment->delete();
        }
    }

        $employee->delete();
        //reponse payload
        $payload = [
            'allrows' => $id,
        ];

        //generate a response
        return new DestroyResponse($payload);
    }

    /**
     * Update preferences of logged in user
     * @return null silent
     */
    public function updatePreferences()
    {

        $this->userrepo->updatePreferences(auth()->id());
    }

    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = [])
    {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.clients'),
                __('Employees'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'employees',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_bookings' => 'active',
            'submenu_employees' => 'active',
            'sidepanel_id' => 'sidepanel-filter-employees',
            'dynamic_search_url' => url('employees/search?action=search&employeeresource_id=' . request('employeeresource_id') . '&employeeresource_type=' . request('employeeresource_type')),
            'add_button_classes' => '',
            'load_more_button_route' => 'employees',
            'source' => 'list',
        ];

        //client user settings
        if (auth()->user()->is_client) {
            $page['visibility_list_page_actions_filter_button'] = '';
            $page['visibility_list_page_actions_search'] = '';
        }

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('Create a new Employee'),
            'add_modal_create_url' => url('employees/create?employeeresource_id=' . request('employeeresource_id') . '&employeeresource_type=' . request('employeeresource_type')),
            'add_modal_action_url' => url('employees?employeeresource_id=' . request('employeeresource_id') . '&employeeresource_type=' . request('employeeresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //contracts list page
        if ($section == 'employees') {
            $page += [
                'meta_title' => __('Employee'),
                'heading' => __('Employee'),

            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //create new resource
        if ($section == 'create') {
            $page += [
                'section' => 'create',
            ];
            return $page;
        }

        //edit new resource
        if ($section == 'edit') {
            $page += [
                'section' => 'edit',
            ];
            return $page;
        }

        //ext page settings
        if ($section == 'ext') {
            $page += [
                'list_page_actions_size' => 'col-lg-12',
                'source' => 'list',
            ];
            return $page;
        }

        //return
        return $page;
    }

    public function fetchSchedules($id)
    {
        $data = UserSchedule::where('user_id', $id)->get();
        return response()->json($data);
    }

    public function ScheduleView(Request $request, $id = null)
    {
        if ($request->ajax()) {
            $user = $request->id;
            $data = UserSchedule::whereDate('start', '>=', $request->start)->where('user_id', $user)
                ->get();
            return response()->json($data);
        }
        return view('pages.employees.user-schedule', compact('id'));
    }

    public function storeSchedule(Request $request)
    {
        // dd($request->all());
        switch ($request->type) {
            case 'create':
                $event = UserSchedule::create([
                    'user_id' => $request->user_id,
                    'title' => $request->event_name,
                    'start' => $request->event_start,
                    'end' => $request->event_end,
                    'start_time' => $request->event_start_time,
                    'end_time' => $request->event_end_time,
                ]);

                return response()->json($event);
                break;

            case 'edit':
                $event = UserSchedule::find($request->id);
                $event->title = $request->title;
                $event->start = $request->start;
                $event->start_time = $request->event_start_time;
                $event->end_time = $request->event_end_time;
                $event->user_id = $request->user_id;
                $event->save();
                return response()->json($event);
                break;

            case 'delete':
                $event = UserSchedule::find($request->id)->delete();
                return response()->json($event);
                break;

            default:
                # ...
                break;
        }
    }
    
    public function deleteAttachment($id)
    {
        //check if file exists in the database
        $attachment = \App\Models\Attachment::Where('attachment_uniqiueid', request()->route('uniqueid'))->first();

        //confirm thumb exists
        if ($attachment->attachment_directory != '') {
            if (Storage::exists("files/$attachment->attachment_directory")) {
                Storage::deleteDirectory("files/$attachment->attachment_directory");
            }
        }

        $attachment->delete();

        //hide and remove row
        $jsondata['dom_visibility'][] = array(
            'selector' => '#employee_attachment_' . $attachment->attachment_id,
            'action' => 'slideup-slow-remove',
        );

        //response
        return response()->json($jsondata);
    }
}
