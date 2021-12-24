<?php

/** --------------------------------------------------------------------------------
 * This repository class manages all the data absctration for users
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Repositories;

use App\FrontVendorRegistration;
use App\Mail\VendorVerificationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Log;

class VUserRepository {

    /**
     * The users repository instance.
     */
    protected $users;

    /**
     * Inject dependecies
     */
    public function __construct(User $users) {
        $this->users = $users;
    }

    /**
     * get a single user from the database
     * @param int $id record id
     * @return object
     */
    public function get($id = '') {

        //new query
        $users = $this->users->newQuery();

        //validation
        if (!is_numeric($id)) {
            return false;
        }

        $users->where('id', $id);

        //sanity: client
        if (request()->filled('clientid')) {
            $users->where('clientid', request()->input('clientid'));
        }

        return $users->first();
    }

    /**
     * chec if a user exists
     * @param int $id The user id
     * @return bool
     */
    public function exists($id = '') {

        //new query
        $users = $this->users->newQuery();

        //validation
        if (!is_numeric($id)) {
            Log::error("validation error - invalid params", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //check
        $users->where('id', '=', $id);
        return $users->exists();
    }

    /**
     * Search model
     * @param int $id optional for getting a single, specified record
     * @return object user collection
     */
    public function search($id = '') {

        //user object
        $users = $this->users->newQuery();

        $users->where('vendor',1);
       
        $users->leftjoinClients();

        //ignore system user
        $users->where('id', '>', 0);


        //filter: id
        if (request()->filled('id')) {
            $users->where('id', request('id'));
        }
        if (is_numeric($id)) {
            $users->where('id', $id);
        }

        //filter: created date (start)
        if (request()->filled('filter_date_created_start')) {
            $users->where('created', '>=', request('filter_date_created_start'));
        }

        //filter: created date (end)
        if (request()->filled('filter_date_created_end')) {
            $users->where('created', '<=', request('filter_date_created_end'));
        }

        //filters: primary or not
        if (request()->filled('filter_account_owner')) {
            $users->where('account_owner', request('filter_account_owner'));
        }

        //filters-array: name  (NB: the user id is the value received)
        if (is_array(request('filter_name')) && !empty(array_filter(request('filter_name')))) {
            $users->whereIn('id', request('filter_name'));
        }

        //filters-array: email (NB: the user id is the value received)
        if (is_array(request('filter_email')) && !empty(array_filter(request('filter_email')))) {
            $users->whereIn('id', request('filter_email'));
        }

        //filters-array: client  (NB: the client id is the value received)
        if (is_array(request('filter_clientid')) && !empty(array_filter(request('filter_clientid')))) {
            $users->whereIn('clientid', request('filter_clientid'));
        }

        //sanity: client
        if (request()->filled('clientid')) {
            $users->where('clientid', request('clientid'));
        }

      

        //search: various client columns and relationships (where first, then wherehas)
        if (request()->filled('search_query')) {
            $users->where(function ($query) {
                $query->where('first_name', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('last_name', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('email', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('phone', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('status', 'LIKE', '%' . request('search_query') . '%');
                $query->orWhere('company_name', 'LIKE', '%' . request('search_query') . '%');
            });
        }

        //sorting
        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {
            if (Schema::hasColumn('users', request('orderby'))) {
                $users->orderBy(request('orderby'), request('sortorder'));
            }
            //others
            switch (request('orderby')) {
                case 'first_name':
                    $users->orderBy('first_name', request('sortorder'));
                    break;
                case 'email':
                    $users->orderBy('email', request('sortorder'));
                    break;
                case 'phone':
                    $users->orderBy('phone', request('sortorder'));
                    break;
                case 'last_seen':
                    $users->orderBy('last_seen', request('sortorder'));
                    break;
                case 'status':
                    $users->orderBy('status', request('sortorder'));
                    break;
                                               
            }
        } else {
            //default sorting
            $users->orderBy('first_name', 'asc');
        }

        //eager load
        $users->with([
            'role',
        ]);

        // Get the results and return them.
        return $users->paginate(config('system.settings_system_pagination_limits'));
    }

    /**
     * Update a users preferences
     * e.g. left menu position, stats panel position etc
     * @param int $id users id
     * @return bool
     */
    public function updatePreferences($id = '') {

        //validation
        if (!is_numeric($id)) {
            return false;
        }

        //get user from database
        if ($user = $this->users->find($id)) {

            //preference: left menu position
            if (in_array(request('leftmenu_position'), array('open', 'collapsed'))) {
                $user->pref_leftmenu_position = request('leftmenu_position');
            }

            //preference: stats panel position
            if (in_array(request('statspanel_position'), array('open', 'collapsed'))) {
                $user->pref_statspanel_position = request('statspanel_position');
            }

            //preference: show own tasks or all
            if (in_array(request('pref_filter_own_tasks'), array('yes', 'no'))) {
                $user->pref_filter_own_tasks = request('pref_filter_own_tasks');
            }

            //preference: show own projects or all
            if (in_array(request('pref_filter_own_projects'), array('yes', 'no'))) {
                $user->pref_filter_own_projects = request('pref_filter_own_projects');
            }

            //update preferences
            $user->save();

            return true;
        }
        return false;
    }

    /**
     * Create a new user
     * @param string $password bcrypted password
     * @param string $type team or client
     * @return bool
     */
    public function create($password = '') {

        //save new user
        $user = new $this->users;

        //data
        $user->type = request('type');
        $user->email = request('email');
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->phone = request('phone');
        $user->position = request('position');
        $user->role_id = request('role_id');
        $user->creatorid = Auth()->user()->id;

        //password
        if ($password != '') {
            $user->password = $password;
        }

        //client user
        if (request()->filled('clientid')) {
            $user->clientid = request('clientid');
        }

        //primary contact
        if (request('account_owner') == 'yes') {
            $user->account_owner = 'yes';
        }

        //dashboard access
        $user->dashboard_access = (request('dashboard_access') == 'on') ? 'yes' : 'no';

        //save
        if ($user->save()) {
            return $user->id;
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    /**
     * Create a new user via the client signup form
     * @param string $password bcrypted password
     * @param string $type team or client
     * @return bool
     */
    public function signUp($clientId = '') {

        //save new user
        $user = new $this->users;

        //data
        $user->clientid = $clientId;
        $user->password = Hash::make(request('password'));
        $user->type = 'client';
        $user->email = request('email');
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->role_id = 2;
        $user->creatorid = 0;
        $user->account_owner = 'yes';

        //notification settings
        $user->notifications_new_project = config('settings.default_notifications_client.notifications_new_project');
        $user->notifications_projects_activity = config('settings.default_notifications_client.notifications_projects_activity');
        $user->notifications_billing_activity = config('settings.default_notifications_client.notifications_billing_activity');
        $user->notifications_tasks_activity = config('settings.default_notifications_client.notifications_tasks_activity');
        $user->notifications_tickets_activity = config('settings.default_notifications_client.notifications_tickets_activity');
        $user->notifications_system = config('settings.default_notifications_client.notifications_system');

        //save
        if ($user->save()) {
            return $user;
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    /**
     * update a user record
     * @param int $id user id
     * @return bool
     */
    public function update($id) {

        //get the user
        if (!$user = $this->users->find($id)) {
            Log::error("record could not be found", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'user_id' => $id ?? '']);
            return false;
        }

        $oldStatus = $user->status;
        //general
        $user->email = request('email');
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->position = request('position');
        $user->phone = request('phone');
        $user->status = request('status');
        $user->position = request('position');
        
        $vendor = FrontVendorRegistration::where('user_id', $id)->first();
        $vendor->vendor_company_name = request('vendor_company_name');
        $vendor->commercial_registration_no = request('commercial_registration_no');
        $vendor->trade_license_no = request('trade_license_no');
        $vendor->email  = request('email');
        $vendor->office_telephone_no = request('office_telephone_no');
        $vendor->address = request('address');
        $vendor->po_box = request('po_box');
        $vendor->company_association = request('company_association');
        $vendor->learn_about_compnay = request('learn_about_compnay');
        

        //client user
        if (request()->filled('clientid')) {
            $user->clientid = request('clientid');
        }

        //dashboard access
        $user->dashboard_access = (request('dashboard_access') == 'on') ? 'yes' : 'no';

        
        if (request('role_id') != '') {
            $user->role_id = request('role_id');
        }


        //save changes
        if ($user->save()) {
            $vendor->save();
            if($oldStatus != request('status')){
                $data = [   
                    'status' => request('status'),
                    'email' => request('email'),     
                    'first_name' => request('first_name'),
                    'last_name' => request('last_name'), 
                    ];
                Mail::to(request('email'))->send(new VendorVerificationMail($data));
            } 

            return true;
        } else {
            Log::error("record could not be saved - database error", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    /**
     * autocomplete feed for user names
     * @param string $type (team|client)
     * @param string $searchterm
     * @return array
     */
    public function autocompleteNames($type = '', $searchterm = '') {

        //validation
        if ($searchterm == '') {
            return [];
        }

        //start
        $query = $this->users->newQuery();
        $query->selectRaw("CONCAT_WS(' ', first_name, last_name) AS value, id");

        //filter
        if ($type != '') {
            $query->where('type', '=', $type);
        }

        $query->whereRaw("CONCAT_WS(' ', first_name, last_name) LIKE '%$searchterm%'");

        //return
        return $query->get();
    }

    /**
     * autocomplete feed for email addresses
     * @param string $type (team|client)
     * @param string $searchterm
     * @return array
     */
    public function autocompleteEmail($type = '', $searchterm = '') {

        //validation
        if ($searchterm == '') {
            return [];
        }

        //start
        $query = $this->users->newQuery();

        $query->selectRaw("email AS value, id");

        //filter
        if ($type != '') {
            $query->where('type', '=', $type);
        }

        $query->where('email', 'like', "%$searchterm%");

        //return
        return $query->get();
    }

    /**
     * get all team members who can receive estimate emails
     * @return object
     */
    public function mailingListTeamEstimates($notification_type = '') {

        //start query
        $query = $this->users->newQuery();
        $query->where('type', '=', 'team');

        //email notification
        if ($notification_type == 'email') {
            $query->where('notifications_billing_activity', '=', 'yes_email');
        }

        //email notification
        if ($notification_type == 'app') {
            $query->whereIn('notifications_billing_activity', ['yes', 'yes_email']);
        }

        //has permissions to view estimates
        $query->whereHas('role', function ($q) {
            $q->where('role_estimates', '>=', 1);
        });

        //with roles
        $query->with([
            'role',
        ]);

        //get the users
        $users = $query->get();

        //return list
        return $users;
    }

    /**
     * get all team members who can receive invoice & payments emails
     * @return object
     */
    public function mailingListInvoices($notification_type = '') {

        //start query
        $query = $this->users->newQuery();
        $query->where('type', '=', 'team');

        //email notification
        if ($notification_type == 'email') {
            $query->where('notifications_billing_activity', '=', 'yes_email');
        }

        //email notification
        if ($notification_type == 'app') {
            $query->whereIn('notifications_billing_activity', ['yes', 'yes_email']);
        }

        //has permissions to view invoices and payments
        $query->whereHas('role', function ($q) {
            $q->where('role_invoices', '>=', 1);
        });

        //with roles
        $query->with([
            'role',
        ]);

        //get the users
        $users = $query->get();

        //return list
        return $users;
    }

    /**
     * various feeds for ajax auto complete
     * @example $this->userrepo->getClientUsers(1, 'all', 'ids')
     * @param numeric $type (company_name)
     * @param string $results the result return type (ids|collection)
     * @param string $user_type return all users or just the primary user (all|owner)
     * @return array
     */
    public function getClientUsers($client_id = '', $user_type = 'all', $results = 'ids') {

        //validation
        if (!is_numeric($client_id) || !in_array($results, ['ids', 'collection']) || !in_array($user_type, ['all', 'owner'])) {
            return false;
        }

        //start
        $query = $this->users->newQuery();

        //basics
        $query->where('type', 'client');
        $query->where('clientid', $client_id);

        //primary user only
        if ($user_type == 'owner') {
            $query->where('account_owner', 'yes');
        }

        //with roles
        $query->with([
            'role',
        ]);

        //get the users
        $users = $query->get();

        //create a list of id's
        $list = [];
        foreach ($users as $user) {
            $list[] = $user->id;
        }

        //return collection
        if ($results == 'collection') {
            return $users;
        } else {
            return $list;
        }
    }

    /**
     * get all team members
     * @param string $results the result return type (ids|collection)
     * @return object
     */
    public function getTeamMembers($results = 'collection') {

        //start query
        $query = $this->users->newQuery();
        $query->where('type', '=', 'team');

        //with roles
        $query->with([
            'role',
        ]);

        //get the users
        $users = $query->get();

        //create a list of id's
        $list = [];
        foreach ($users as $user) {
            $list[] = $user->id;
        }

        //return collection
        if ($results == 'collection') {
            return $users;
        } else {
            return $list;
        }
    }

    /**
     * Get the client account owner
     * @param numeric $client_id client did
     * @return object client model object
     */
    public function getClientAccountOwner($client_id = '') {

        if (!is_numeric($client_id)) {
            Log::error("validation error - invalid params", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //start
        $query = $this->users->newQuery();
        $query->where('type', 'client');
        $query->where('account_owner', 'yes');
        $query->where('clientid', $client_id);

        //return client
        $users = $query->take(1)->get();

        return $users->first();

    }

    /**
     * update a record
     * @param int $id record id
     * @return mixed bool or id of record
     */
    public function updateAvatar($id) {

        //get the user
        if (!$user = $this->users->find($id)) {
            Log::error("record could not be found", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'user_id' => $id ?? '']);
            return false;
        }

        //update users avatar
        $user->avatar_directory = request('avatar_directory');
        $user->avatar_filename = request('avatar_filename');

        //save
        if ($user->save()) {
            return true;
        } else {
            Log::error("record could not be saved - database error", ['process' => '[userRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }
    }

    /**
     * get all team members
     * @param int $client_id
     * @param int $new_owner_id the user to set as new owner
     * @return object
     */
    public function updateAccountOwner($client_id = '', $new_owner_id = '') {

        //validation
        if (!is_numeric($client_id) || !is_numeric($new_owner_id)) {
            Log::error("validation error - invalid params", ['process' => '[UserRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);
            return false;
        }

        //reset existing account owner
        $query = $this->users->newQuery();
        $query->where('clientid', $client_id);
        $query->update(['account_owner' => 'no']);

        //set owner
        $query = $this->users->newQuery();
        $query->where('clientid', $client_id);
        $query->where('id', $new_owner_id);
        $query->update(['account_owner' => 'yes']);
    }

     /**
     * various feeds for ajax auto complete
     * @param string $type (company_managers)
     * @param string $searchterm
     * @return object client model object
     */
    public function autocompleteFeed($type = '', $searchterm = '') {

        //validation
        if ($type == '' || $searchterm == '') {
            return [];
        }

        //start
        $query = $this->users->newQuery();

        if ($type == 'company_managers') {
            $query->selectRaw('first_name AS value, id AS id');
            $query->where('type','team');
            $query->where('first_name', 'LIKE', '%' . $searchterm . '%');
        }

        //return
        return $query->get();
    }
}