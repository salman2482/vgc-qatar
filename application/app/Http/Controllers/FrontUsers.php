<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for frontusers
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use App\Models\FrontUser;
use App\Mail\UserApproval;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\FrontVendorRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Repositories\ClientRepository;

use App\Repositories\CategoryRepository;
use App\Repositories\frontuserRepository;
use App\Repositories\FrontUsersRepository;
use App\Http\Responses\FrontUsers\ChangeStatus;
use App\Http\Responses\FrontUsers\ShowResponse;
use App\Http\Responses\FrontUsers\IndexResponse;
use App\Http\Responses\FrontUsers\UpdateResponse;
use App\Http\Responses\FrontUsers\DestroyResponse;

class FrontUsers extends Controller
{

    /**
     * The users repository instance.
     */
    protected $userrepo;

    public function __construct(FrontUsersRepository $userrepo)
    {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');
        $this->middleware('adminCheck');

        //dependencies
        $this->userrepo = $userrepo;
    }

    /**
     * Display a listing of frontusers
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //get frontusers
        // request()->merge([
        //     'type' => 'client',
        //     'status' => 'active',
        // ]);
        $frontusers = $this->userrepo->search();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('frontusers'),
            'frontusers' => $frontusers,
        ];
        //show views
        return new IndexResponse($payload);
    }

    /**
     * Show the form for creating a new frontuser.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //page settings
        $page = $this->pageSettings('create');

        //reponse payload
        $payload = [
            'page' => $page,
        ];

        //show the form
        return new CreateResponse($payload);
    }

    public function show($id)
    {
        //get the expense
        $users = $this->userrepo->search($id);
        $user = $users->first();

        //reponse payload
        $payload = [
            'user' => $user,
        ];

        return new ShowResponse($payload);
    }
    /**
     * Store a newly created frontuser in storage.
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

        //save frontuser
        if (!$userid = $this->userrepo->create(bcrypt($password))) {
            abort(409);
        }

        //get the frontuser
        $frontusers = $this->userrepo->search($userid);
        $frontuser = $frontusers->first();

        //update client user specific - default notification settings
        $frontuser->notifications_new_project = config('settings.default_notifications_client.notifications_new_project');
        $frontuser->notifications_projects_activity = config('settings.default_notifications_client.notifications_projects_activity');
        $frontuser->notifications_billing_activity = config('settings.default_notifications_client.notifications_billing_activity');
        $frontuser->notifications_tasks_activity = config('settings.default_notifications_client.notifications_tasks_activity');
        $frontuser->notifications_tickets_activity = config('settings.default_notifications_client.notifications_tickets_activity');
        $frontuser->notifications_system = config('settings.default_notifications_client.notifications_system');
        $frontuser->force_password_change = config('settings.force_password_change');
        $frontuser->save();

        /** ----------------------------------------------
         * send email to user
         * ----------------------------------------------*/
        $data = [
            'password' => $password,
        ];
        $mail = new \App\Mail\UserWelcome($frontuser, $data);
        $mail->build();

        //counting rows
        $rows = $this->userrepo->search();
        $count = $rows->total();

        //reponse payload
        $payload = [
            'frontusers' => $frontusers,
            'count' => $count,
        ];

        //process reponse
        return new StoreResponse($payload);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id frontuser id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //   return $id;
        //     dd($id);
        //page settings
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
     * Update the specified frontuser in storage.
     * @param int $id frontuser id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

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
        $frontusers = $this->userrepo->search($id);
        $frontuser = $frontusers->first();

        //reponse payload
        $payload = [
            'frontusers' => $frontusers,
            'clientid' => $user->clientid,
            'original_owner' => $original_owner,
            'user' => $frontuser,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified frontuser from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $frontuser = FrontUser::where('user_id', $id)->first();
        $userrepo = User::where('id', $id)->first();
        //delete the user
        $frontuser->delete();
        $userrepo->delete();

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
                __('lang.users'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'frontusers',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_properties' => 'active',
            'submenu_frontusers' => 'active',
            'sidepanel_id' => 'sidepanel-filter-frontusers',
            'dynamic_search_url' => url('frontusers/search?action=search&frontuserresource_id=' . request('frontuserresource_id') . '&frontuserresource_type=' . request('frontuserresource_type')),
            'add_button_classes' => '',
            'load_more_button_route' => 'frontusers',
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
            'add_modal_create_url' => url('frontusers/create?frontuserresource_id=' . request('frontuserresource_id') . '&frontuserresource_type=' . request('frontuserresource_type')),
            'add_modal_action_url' => url('frontusers?frontuserresource_id=' . request('frontuserresource_id') . '&frontuserresource_type=' . request('frontuserresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //contracts list page
        if ($section == 'frontusers') {
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

    public function changeStatus($id)
    {
        $frontusers = $this->userrepo->search($id);
        $frontuser = $frontusers->first();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'frontuser' => $frontuser,
        ];
        return new ChangeStatus($payload);
    }

    /**
     * change status project status
     * @return \Illuminate\Http\Response
     */
    public function changeStatusUpdate()
    {

        //validate the project exists
        $frontuser = \App\Models\FrontUser::Where('user_id', request()->route('id'))->first();
        $user = User::where('id', request()->route('id'))->first();
        if ($frontuser) {
            $frontuser->status = request('user_status');
            $frontuser->save();
            $user->status = request('user_status');
            $user->save();
        }

        $data =
            [
                'status' => request('user_status'),
                'url'   => $url = env('APP_URL') . '/front/user/login',
            ];

        Mail::to($user->email)->send(new UserApproval($data));
        //get refreshed project
        $frontusers = $this->userrepo->search(request()->route('id'));
        $frontuser = $frontusers->first();

        //reponse payload
        $payload = [
            'frontusers' => $frontusers,
            'user' => $frontusers,
        ];

        //show the form
        return new UpdateResponse($payload);
    }
}
