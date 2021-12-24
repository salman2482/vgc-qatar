<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for vusers
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\FrontVendorRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Repositories\EventRepository;
use App\Repositories\VUserRepository;
use App\Repositories\ClientRepository;
use App\Repositories\CategoryRepository;
use App\Http\Responses\VUsers\EditResponse;
use App\Http\Responses\VUsers\IndexResponse;
use App\Http\Responses\VUsers\StoreResponse;
use App\Http\Responses\VUsers\CreateResponse;
use App\Http\Responses\VUsers\UpdateResponse;
use App\Http\Responses\VUsers\DestroyResponse;

class VUsers extends Controller {

    /**
     * The users repository instance.
     */
    protected $userrepo;
    protected $eventrepo;

    /**
     * The category repository instance.
     */
    protected $categoryrepo;

    /**
     * The client repository instance.
     */
    protected $clientrepo;

    public function __construct(VUserRepository $userrepo, CategoryRepository $categoryrepo, ClientRepository $clientrepo,EventRepository $eventrepo) {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');

        $this->middleware('contactsMiddlewareIndex')->only([
            'index',
            'update',
            'store',
        ]);

        
        //dependencies
        $this->userrepo = $userrepo;
        $this->eventrepo = $eventrepo;
        
        $this->categoryrepo = $categoryrepo;
        $this->clientrepo = $clientrepo;
    }

    /**
     * Display a listing of vusers
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //get vusers
        request()->merge([
            'type' => 'client',
            'status' => 'active',
        ]);
        $vusers = $this->userrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('vusers'),
            'vusers' => $vusers,
        ];
        //show views
        return new IndexResponse($payload);
    }

    /**
     * Show the form for creating a new vuser.
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //page settings
        $page = $this->pageSettings('create');

        //reponse payload
        $payload = [
            'page' => $page,
        ];

        //show the form
        return new CreateResponse($payload);
    }

    /**
     * Store a newly created vuser in storage.
     * @param object ClientRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRepository $clientrepo) {

        //custom error messages
        $messages = [
            'clientid.exists' => __('lang.item_not_found'),
        ];

        //validate
        $validator = Validator::make(request()->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            'clientid' => [
                'required',
                Rule::exists('clients', 'client_id'),
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
            'role_id' => 2,
            'type' => 'client',
        ]);

        //password
        $password = str_random(9);

        //save vuser
        if (!$userid = $this->userrepo->create(bcrypt($password))) {
            abort(409);
        }

        //get the vuser
        $vusers = $this->userrepo->search($userid);
        $vuser = $vusers->first();

        //update client user specific - default notification settings
        $vuser->notifications_new_project = config('settings.default_notifications_client.notifications_new_project');
        $vuser->notifications_projects_activity = config('settings.default_notifications_client.notifications_projects_activity');
        $vuser->notifications_billing_activity = config('settings.default_notifications_client.notifications_billing_activity');
        $vuser->notifications_tasks_activity = config('settings.default_notifications_client.notifications_tasks_activity');
        $vuser->notifications_tickets_activity = config('settings.default_notifications_client.notifications_tickets_activity');
        $vuser->notifications_system = config('settings.default_notifications_client.notifications_system');
        $vuser->force_password_change = config('settings.force_password_change');
        $vuser->save();

        /** ----------------------------------------------
         * send email to user
         * ----------------------------------------------*/
        $data = [
            'password' => $password,
        ];
        $mail = new \App\Mail\UserWelcome($vuser, $data);
        $mail->build();

        //counting rows
        $rows = $this->userrepo->search();
        $count = $rows->total();

        //reponse payload
        $payload = [
            'vusers' => $vusers,
            'count' => $count,
        ];

        //process reponse
        return new StoreResponse($payload);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id vuser id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $page = $this->pageSettings('edit');

        //the user
        $user = \App\Models\User::Where('id', $id)->first();

        //reponse payload
        $payload = [
            'page' => $page,
            'user' => $user,
        ];

        //process reponse
        return new EditResponse($payload);

    }

    /**
     * Update the specified vuser in storage.
     * @param int $id vuser id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {
        
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
        $vusers = $this->userrepo->search($id);
        $vuser = $vusers->first();

        /** ----------------------------------------------
         * record event [vendor profile updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->user()->id,
            'event_item' => 'vendor_profile_updated',
            'event_item_id' => '',
            'event_item_lang' => 'vendor_profile_updated',
            'event_item_content' => $user->company_name,
            'event_item_content2' => '',
            'event_parent_type' => 'Admin Updated Vendor Profile',
            'event_parent_id' => $user->id,
            'event_parent_title' => $user->company_name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => $user->id,
            'eventresource_type' => 'vendor',
            'eventresource_id' => $user->id,
            'event_notification_category' => 'notifications_vendor_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            
        }


        //reponse payload
        $payload = [
            'vusers' => $vusers,
            'clientid' => $user->clientid,
            'original_owner' => $original_owner,
            'user' => $vuser,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified vuser from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $userrepos = $this->userrepo->search($id);
        $userrepo = $userrepos->first();
        
        /** ----------------------------------------------
         * record event [vendor profile deleted]
         * ----------------------------------------------*/
        $vendor = FrontVendorRegistration::where('user_id', $id)->first();

        $user =  User::where('id', $vendor->user_id)->first();

        $data = [
            'event_creatorid' => auth()->user()->id,
            'event_item' => 'vendor_profile_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'vendor_profile_deleted',
            'event_item_content' => $user->company_name,
            'event_item_content2' => '',
            'event_parent_type' => 'Admin Deleted Vendor Profile',
            'event_parent_id' => $user->id,
            'event_parent_title' => $user->company_name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => $user->id,
            'eventresource_type' => 'vendor',
            'eventresource_id' => $user->id,
            'event_notification_category' => 'notifications_vendor_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            
        }
        //delete the category
        $userrepo->delete();

        if($vendor){
            $vendor->delete();
        }

         
        $allrows = array();
        
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
    public function updatePreferences() {

        $this->userrepo->updatePreferences(auth()->id());

    }

    /**
     * basic page setting for this section of the app
     * @param string $section page section (optional)
     * @param array $data any other data (optional)
     * @return array
     */
    private function pageSettings($section = '', $data = []) {

        //common settings
        $page = [
            'crumbs' => [
                __('lang.clients'),
                __('lang.users'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'vusers',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_vendors' => 'active',
            'submenu_vusers' => 'active',
            'mainmenu_vusers' => 'active',
            'sidepanel_id' => 'sidepanel-filter-vusers',
            'dynamic_search_url' => url('vusers/search?action=search&vuserresource_id=' . request('vuserresource_id') . '&vuserresource_type=' . request('vuserresource_type')),
            'add_button_classes' => '',
            'load_more_button_route' => 'vusers',
            'source' => 'list',
        ];

        //client user settings
        if (auth()->user()->is_client) {
            $page['visibility_list_page_actions_filter_button'] = '';
            $page['visibility_list_page_actions_search'] = '';
        }

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_user'),
            'add_modal_create_url' => url('vusers/create?vuserresource_id=' . request('vuserresource_id') . '&vuserresource_type=' . request('vuserresource_type')),
            'add_modal_action_url' => url('vusers?vuserresource_id=' . request('vuserresource_id') . '&vuserresource_type=' . request('vuserresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //contracts list page
        if ($section == 'vusers') {
            $page += [
                'meta_title' => __('lang.users'),
                'heading' => __('lang.users'),

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

    public function showEvent($id)
    {
        $vuser = User::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'vuser')
            ->get();
        return view('pages.vusers.show-event',compact('vuser','attachments'));
    }
}