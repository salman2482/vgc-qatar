<?php

/** --------------------------------------------------------------------------------
 * This controller manages all the business logic for estimates
 *
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Estimates\EstimateSave;
use App\Http\Requests\Estimates\EstimateStoreUpdate;
use App\Http\Responses\Common\ChangeCategoryResponse;
use App\Http\Responses\Estimates\AcceptResponse;
use App\Http\Responses\Estimates\AttachProjectResponse;
use App\Http\Responses\Estimates\ChangeCategoryUpdateResponse;
use App\Http\Responses\Estimates\ChangeStatusResponse;
use App\Http\Responses\Estimates\CreateResponse;
use App\Http\Responses\Estimates\DeclineResponse;
use App\Http\Responses\Estimates\DestroyResponse;
use App\Http\Responses\Estimates\EditResponse;
use App\Http\Responses\Estimates\IndexResponse;
use App\Http\Responses\Estimates\PDFResponse;
use App\Http\Responses\Estimates\PublishResponse;
use App\Http\Responses\Estimates\PublishRevisedResponse;
use App\Http\Responses\Estimates\ResendResponse;
use App\Http\Responses\Estimates\SaveResponse;
use App\Http\Responses\Estimates\ShowResponse;
use App\Http\Responses\Estimates\StoreResponse;
use App\Http\Responses\Estimates\UpdateResponse;
use App\Repositories\CategoryRepository;
use App\Repositories\DestroyRepository;
use App\Repositories\EmailerRepository;
use App\Repositories\EstimateGeneratorRepository;
use App\Repositories\EstimateRepository;
use App\Repositories\EventRepository;
use App\Repositories\EventTrackingRepository;
use App\Repositories\LineitemRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\TagRepository;
use App\Repositories\TaxRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class Estimates extends Controller {

    /**
     * The estimate repository instance.
     */
    protected $estimaterepo;

    /**
     * The tags repository instance.
     */
    protected $tagrepo;

    /**
     * The user repository instance.
     */
    protected $userrepo;

    /**
     * The tax repository instance.
     */
    protected $taxrepo;

    /**
     * The line item repository instance.
     */
    protected $lineitemrepo;

    /**
     * The unit repository instance.
     */
    protected $unitrepo;

    /**
     * The event tracking repository instance.
     */
    protected $trackingrepo;

    /**
     * The event repository instance.
     */
    protected $eventrepo;

    /**
     * The emailer repository
     */
    protected $emailerrepo;

    /**
     * The estimate generator repository
     */
    protected $estimategenerator;

    public function __construct(
        EstimateRepository $estimaterepo,
        TagRepository $tagrepo,
        UserRepository $userrepo,
        TaxRepository $taxrepo,
        LineitemRepository $lineitemrepo,
        EventRepository $eventrepo,
        EventTrackingRepository $trackingrepo,
        EmailerRepository $emailerrepo,
        EstimateGeneratorRepository $estimategenerator
    ) {

        //parent
        parent::__construct();

        //authenticated
        $this->middleware('auth');

        $this->middleware('estimatesMiddlewareIndex')->only([
            'index',
            'update',
            'store',
            'changeCategoryUpdate',
            'attachProjectUpdate',
            'changeStatusUpdate',
        ]);

        $this->middleware('estimatesMiddlewareCreate')->only([
            'create',
            'store',
        ]);

        $this->middleware('estimatesMiddlewareEdit')->only([
            'edit',
            'update',
            'emailClient',
            'dettachProject',
            'attachProject',
            'attachProjectUpdate',
            'convertToInvoice',
            'changeStatusUpdate',
            'changeStatus',
            'saveInvoice',
            'changeStatusUpdate',
        ]);

        $this->middleware('estimatesMiddlewareShow')->only([
            'show',
            'downloadPDF',
            'acceptEstimate',
            'declineEstimate',
        ]);

        $this->middleware('estimatesMiddlewareDestroy')->only(['destroy']);

        //only needed for the [action] methods
        $this->middleware('estimatesMiddlewareBulkEdit')->only(['changeCategoryUpdate']);

        //repos
        $this->estimaterepo = $estimaterepo;
        $this->tagrepo = $tagrepo;
        $this->userrepo = $userrepo;
        $this->lineitemrepo = $lineitemrepo;
        $this->taxrepo = $taxrepo;
        $this->eventrepo = $eventrepo;
        $this->trackingrepo = $trackingrepo;
        $this->emailerrepo = $emailerrepo;
        $this->estimategenerator = $estimategenerator;

    }

    /**
     * Display a listing of estimates
     * @param object ProjectRepository instance of the repository
     * @param object CategoryRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectRepository $projectrepo, CategoryRepository $categoryrepo) {

        $projects = [];

        //get estimate
        $estimates = $this->estimaterepo->search();

        //get all categories (type: estimate) - for filter panel
        $categories = $categoryrepo->get('estimate');

        //get all tags (type: lead) - for filter panel
        $tags = $this->tagrepo->getByType('estimate');

        //get clients project list
        if (config('visibility.filter_panel_clients_projects')) {
            if (is_numeric(request('estimateresource_id'))) {
                $projects = $projectrepo->search('', ['project_clientid' => request('estimateresource_id')]);
            }
        }

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('estimates'),
            'estimates' => $estimates,
            'projects' => $projects,
            'stats' => $this->statsWidget(),
            'categories' => $categories,
            'tags' => $tags,
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Show the form for creating a new estimate.
     * @param object CategoryRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryRepository $categoryrepo) {

        //estimate categories
        $categories = $categoryrepo->get('estimate');

        //get tags
        $tags = $this->tagrepo->getByType('estimate');

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'categories' => $categories,
            'tags' => $tags,
        ];

        //show the form
        return new CreateResponse($payload);
    }

    /**
     * Store a newly created estimate  in storage.
     * @param object EstimateStoreUpdate
     * @return \Illuminate\Http\Response
     */
    public function store(EstimateStoreUpdate $request) {

        //create the estimate
        if (!$bill_estimateid = $this->estimaterepo->create()) {
            abort(409);
        }

        //add tags
        $this->tagrepo->add('estimate', $bill_estimateid);

        //reponse payload
        $payload = [
            'id' => $bill_estimateid,
        ];

        //process reponse
        return new StoreResponse($payload);

    }

    /**
     * Display the specified estimate.
     * @param int $id estimate  id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        //get invoice object payload
        if (!$payload = $this->estimategenerator->generate($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //append to payload
        $payload['page'] = $this->pageSettings('estimate', $payload['bill']);

        //mark events as read
        \App\Models\EventTracking::where('parent_id', $id)
            ->where('parent_type', 'estimate')
            ->where('eventtracking_userid', auth()->id())
            ->update(['eventtracking_status' => 'read']);

        //pdf estimate
        if (request()->segment(3) == 'pdf') {
            return new PDFResponse($payload);
        }

        //process reponse
        return new ShowResponse($payload);
    }

    /**
     * save estimate changes, when an ioice is being edited
     * @param object EstimateSave
     * @return \Illuminate\Http\Response
     */
    public function saveEstimate(EstimateSave $request, $id) {

        //get the estimate
        $estimates = $this->estimaterepo->search($id);
        $estimate = $estimates->first();

        //save each line item in the database
        $this->estimaterepo->saveLineItems($id);

        //update taxes
        $this->updateEstimateTax($id);

        //update other estimate attributes
        $this->estimaterepo->updateEstimate($id);

        //reponse payload
        $payload = [
            'estimate' => $estimate,
        ];

        //response
        return new SaveResponse($payload);

    }

    /**
     * update the tax for an estimate
     * (1) delete existing estimate taxes
     * (2) for summary taxes - save new taxes
     * @param int $bill_estimateid
     * @return \Illuminate\Http\Response
     */
    private function updateEstimateTax($bill_estimateid = '') {

        //delete current estimate taxes
        \App\Models\Tax::Where('taxresource_type', 'estimate')
            ->where('taxresource_id', $bill_estimateid)
            ->delete();

        //save taxes [summary taxes]
        if (is_array(request('bill_logic_taxes'))) {
            foreach (request('bill_logic_taxes') as $tax) {
                //get data elements
                $list = explode('|', $tax);
                $data = [
                    'tax_taxrateid' => $list[2],
                    'tax_name' => $list[1],
                    'tax_rate' => $list[0],
                    'taxresource_type' => 'estimate',
                    'taxresource_id' => $bill_estimateid,
                ];
                $this->taxrepo->create($data);
            }
        }

    }

    /**
     * publish an estimate
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function publishEstimate($id) {

        //generate the invoice
        if (!$payload = $this->estimategenerator->generate($id)) {
            abort(409, __('lang.error_loading_item'));
        }

        //estimate
        $estimate = $payload['bill'];

        //validate current status
        if ($estimate->bill_status != 'draft') {
            abort(409, __('lang.estimate_already_piblished'));
        }

        /** ----------------------------------------------
         * record event [comment]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'estimate',
            'event_item_id' => $estimate->bill_estimateid,
            'event_item_lang' => 'event_created_estimate',
            'event_item_content' => __('lang.estimate') . ' - ' . $estimate->formatted_bill_estimateid,
            'event_item_content2' => '',
            'event_parent_type' => 'estimate',
            'event_parent_id' => $estimate->bill_estimateid,
            'event_parent_title' => $estimate->project_title,
            'event_clientid' => $estimate->bill_clientid,
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'eventresource_type' => (is_numeric($estimate->bill_projectid)) ? 'project' : 'client',
            'eventresource_id' => (is_numeric($estimate->bill_projectid)) ? $estimate->bill_projectid : $estimate->bill_clientid,
            'event_notification_category' => 'notifications_billing_activity',

        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users (main client)
            $users = $this->userrepo->getClientUsers($estimate->bill_clientid, 'owner', 'ids');
            //record notification
            $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
        }

        /** ----------------------------------------------
         * send email [queued]
         * ----------------------------------------------*/
        if (isset($emailusers) && is_array($emailusers)) {
            //send to users
            if ($users = \App\Models\User::WhereIn('id', $emailusers)->get()) {
                foreach ($users as $user) {
                    $mail = new \App\Mail\PublishEstimate($user, [], $estimate);
                    $mail->build();
                }
            }
        }

        //update estimate status
        \App\Models\Estimate::where('bill_estimateid', $estimate->bill_estimateid)
            ->update(['bill_status' => 'new']);

        //response
        return new PublishResponse();
    }

    /**
     * publish a revised estimate
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function publishRevisedEstimate($id) {

        //generate the invoice
        if (!$payload = $this->estimategenerator->generate($id)) {
            abort(409, __('lang.error_loading_item'));
        }

        //estimate
        $estimate = $payload['bill'];

        //validate current status
        if ($estimate->bill_status != 'declined') {
            abort(409, __('lang.action_only_available_on_declined_estimates'));
        }

        //check if estimate is not already expired
        $bill_expiry_date = \Carbon\Carbon::parse($estimate->bill_expiry_date);
        if ($bill_expiry_date->diffInDays(today(), false) > 0) {
            abort(409, __('lang.estimate_has_expired_update_date'));
        }

        /** ----------------------------------------------
         * record event [comment]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'estimate',
            'event_item_id' => $estimate->bill_estimateid,
            'event_item_lang' => 'event_revised_estimate',
            'event_item_content' => __('lang.estimate') . ' - ' . $estimate->formatted_bill_estimateid,
            'event_item_content2' => '',
            'event_parent_type' => 'estimate',
            'event_parent_id' => $estimate->bill_estimateid,
            'event_parent_title' => $estimate->project_title,
            'event_clientid' => $estimate->bill_clientid,
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'eventresource_type' => (is_numeric($estimate->bill_projectid)) ? 'project' : 'client',
            'eventresource_id' => (is_numeric($estimate->bill_projectid)) ? $estimate->bill_projectid : $estimate->bill_clientid,
            'event_notification_category' => 'notifications_billing_activity',

        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users (main client)
            $users = $this->userrepo->getClientUsers($estimate->bill_clientid, 'owner', 'ids');
            //record notification
            $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
        }

        /** ----------------------------------------------
         * send email [queued]
         * ----------------------------------------------*/
        if (isset($emailusers) && is_array($emailusers)) {
            //send to users
            if ($users = \App\Models\User::WhereIn('id', $emailusers)->get()) {
                foreach ($users as $user) {
                    $mail = new \App\Mail\PublishRevisedEstimate($user, [], $estimate);
                    $mail->build();
                }
            }
        }

        //update estimate status
        \App\Models\Estimate::where('bill_estimateid', $estimate->bill_estimateid)
            ->update(['bill_status' => 'revised']);

        //response
        return new PublishRevisedResponse();
    }

    /**
     * resend an estimate via email
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function resendEstimate($id) {

        //generate the estimate
        if (!$payload = $this->estimategenerator->generate($id)) {
            abort(409, __('lang.error_loading_item'));
        }

        //estimate
        $estimate = $payload['bill'];

        //validate current status
        if ($estimate->bill_status == 'draft') {
            abort(409, __('lang.estimate_still_draft'));
        }

        /** ----------------------------------------------
         * send email [queued]
         * ----------------------------------------------*/
        $users = $this->userrepo->getClientUsers($estimate->bill_clientid, 'owner', 'collection');
        foreach ($users as $user) {
            $mail = new \App\Mail\PublishEstimate($user, [], $estimate);
            $mail->build();
        }

        //response
        return new ResendResponse();
    }

    /**
     * customer accepting estimate
     * @param int $id estimate id
     * @return \Illuminate\Http\Response
     */
    public function acceptEstimate($id) {

        //generate the estimate
        if (!$payload = $this->estimategenerator->generate($id)) {
            abort(409, __('lang.error_loading_item'));
        }

        //estimate
        $estimate = $payload['bill'];

        //validate current status
        if (!in_array($estimate->bill_status, ['new', 'revised'])) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //update estimate status
        \App\Models\Estimate::where('bill_estimateid', $estimate->bill_estimateid)
            ->update(['bill_status' => 'accepted']);

        /** ----------------------------------------------
         * record event [comment]
         * see database table to details of each key
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'estimate',
            'event_item_id' => $estimate->bill_estimateid,
            'event_item_lang' => 'event_accepted_estimate',
            'event_item_content' => __('lang.estimate') . ' - ' . $estimate->formatted_bill_estimateid,
            'event_item_content2' => '',
            'event_clientid' => $estimate->bill_clientid,
            'event_parent_type' => 'estimate',
            'event_parent_id' => $estimate->bill_estimateid,
            'event_parent_title' => $estimate->project_title,
            'event_clientid' => $estimate->bill_clientid,
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'eventresource_type' => (is_numeric($estimate->bill_projectid)) ? 'project' : 'client',
            'eventresource_id' => (is_numeric($estimate->bill_projectid)) ? $estimate->bill_projectid : $estimate->bill_clientid,
            'event_notification_category' => 'notifications_billing_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get estimate team users, with billing app notifications enabled
            $users = $this->userrepo->mailingListTeamEstimates('app');
            //record notification
            $this->trackingrepo->recordEvent($data, $users, $event_id);
        }

        /** --------------------------------------------------------
         * send email [queued]
         * - estimate users, with biling email preference enabled
         * --------------------------------------------------------*/
        $users = $this->userrepo->mailingListTeamEstimates('email');
        foreach ($users as $user) {
            $mail = new \App\Mail\AcceptEstimate($user, [], $estimate);
            $mail->build();
        }

        //response
        return new AcceptResponse();
    }

    /**
     * customer declining an estimate
     * @param int $id estimate id
     * @return \Illuminate\Http\Response
     */
    public function declineEstimate($id) {

        //generate the estimate
        if (!$payload = $this->estimategenerator->generate($id)) {
            abort(409, __('lang.error_loading_item'));
        }

        //estimate
        $estimate = $payload['bill'];

        //validate current status
        if (!in_array($estimate->bill_status, ['new', 'revised'])) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //update estimate status
        \App\Models\Estimate::where('bill_estimateid', $estimate->bill_estimateid)
            ->update(['bill_status' => 'declined']);

        /** ----------------------------------------------
         * record event [comment]
         * see database table to details of each key
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'estimate',
            'event_item_id' => $estimate->bill_estimateid,
            'event_item_lang' => 'event_declined_estimate',
            'event_item_content' => __('lang.estimate') . ' - ' . $estimate->formatted_bill_estimateid,
            'event_item_content2' => '',
            'event_clientid' => $estimate->bill_clientid,
            'event_parent_type' => 'estimate',
            'event_parent_id' => $estimate->bill_estimateid,
            'event_parent_title' => $estimate->project_title,
            'event_clientid' => $estimate->bill_clientid,
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'eventresource_type' => (is_numeric($estimate->bill_projectid)) ? 'project' : 'client',
            'eventresource_id' => (is_numeric($estimate->bill_projectid)) ? $estimate->bill_projectid : $estimate->bill_clientid,
            'event_notification_category' => 'notifications_billing_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get estimate team users, with billing app notifications enabled
            $users = $this->userrepo->mailingListTeamEstimates('app');
            //record notification
            $this->trackingrepo->recordEvent($data, $users, $event_id);
        }

        /** --------------------------------------------------------
         * send email [queued]
         * - estimate users, with biling email preference enabled
         * --------------------------------------------------------*/
        $users = $this->userrepo->mailingListTeamEstimates('email');
        foreach ($users as $user) {
            $mail = new \App\Mail\DeclineEstimate($user, [], $estimate);
            $mail->build();
        }

        //response
        return new DeclineResponse();
    }

    /**
     * Show the form for editing the specified estimate.
     * @param object CategoryRepository instance of the repository
     * @param int $id estimate  id
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryRepository $categoryrepo, $id) {

        //get the project
        $estimate = $this->estimaterepo->search($id);

        //client categories
        $categories = $categoryrepo->get('estimate');

        //get tags
        $tags_resource = $this->tagrepo->getByResource('estimate', $id);
        $tags_user = $this->tagrepo->getByType('estimate');
        $tags = $tags_resource->merge($tags_user);

        //not found
        if (!$estimate = $estimate->first()) {
            abort(409, __('lang.estimate_not_found'));
        }

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'estimate' => $estimate,
            'categories' => $categories,
            'tags' => $tags,
        ];

        //response
        return new EditResponse($payload);
    }

    /**
     * Update the specified estimate in storage.
     * @param int $id estimate  id
     * @return \Illuminate\Http\Response
     */
    public function update($id) {
        //custom error messages
        $messages = [];

        //validate
        $validator = Validator::make(request()->all(), [
            'bill_date' => 'required|date',
            'bill_expiry_date' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) {
                    if ($value != '' && request('bill_date') != '' && (strtotime($value) < strtotime(request('bill_date')))) {
                        return $fail(__('lang.expiry_date_must_be_after_estimate_date'));
                    }
                }],
            'bill_categoryid' => [
                'required',
                Rule::exists('categories', 'category_id'),
            ],
        ], $messages);

        //errors
        if ($validator->fails()) {
            $errors = $validator->errors();
            $messages = '';
            foreach ($errors->all() as $message) {
                $messages .= "<li>$message</li>";
            }

            abort(409, $messages);
        }

        //update
        if (!$this->estimaterepo->update($id)) {
            abort(409);
        }

        //delete & update tags
        $this->tagrepo->delete('estimate', $id);
        $this->tagrepo->add('estimate', $id);

        //get project
        $estimates = $this->estimaterepo->search($id);

        //reponse payload
        $payload = [
            'estimates' => $estimates,
            'stats' => $this->statsWidget(),
        ];

        //generate a response
        return new UpdateResponse($payload);

    }

    /**
     * Remove the specified estimate from storage.
     * @param object DestroyRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRepository $destroyrepo) {

        //delete each record in the array
        $allrows = array();
        foreach (request('ids') as $id => $value) {
            //only checked items
            if ($value == 'on') {
                //destroy estimate
                $destroyrepo->destroyEstimate($id);
                //add to array
                $allrows[] = $id;
            }
        }
        //reponse payload
        $payload = [
            'allrows' => $allrows,
            'stats' => $this->statsWidget(),
        ];

        //generate a response
        return new DestroyResponse($payload);
    }

    /**
     * Show the form for changing estimate category
     * @param object CategoryRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function changeCategory(CategoryRepository $categoryrepo) {

        //get all estimate categories
        $categories = $categoryrepo->get('estimate');

        //reponse payload
        $payload = [
            'categories' => $categories,
        ];

        //show the form
        return new ChangeCategoryResponse($payload);
    }

    /**
     * update the estimate category
     * @param object CategoryRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function changeCategoryUpdate(CategoryRepository $categoryrepo) {

        //validate the category exists
        if (!\App\Models\Category::Where('category_id', request('category'))
            ->Where('category_type', 'estimate')
            ->first()) {
            abort(409, __('lang.item_not_found'));
        }

        //update each estimate
        $allrows = array();
        foreach (request('ids') as $bill_estimateid => $value) {
            if ($value == 'on') {
                $estimate = \App\Models\Estimate::Where('bill_estimateid', $bill_estimateid)->first();
                //update the category
                $estimate->bill_categoryid = request('category');
                $estimate->save();
                //get the estimate in rendering friendly format
                $estimates = $this->estimaterepo->search($bill_estimateid);
                //add to array
                $allrows[] = $estimates;
            }
        }

        //reponse payload
        $payload = [
            'allrows' => $allrows,
        ];

        //show the form
        return new ChangeCategoryUpdateResponse($payload);
    }

    /**
     * Show the form for changing an estimate status
     * @return \Illuminate\Http\Response
     */
    public function changeStatus() {

        //get the estimate
        $estimate = \App\Models\Estimate::Where('bill_estimateid', request()->route('estimate'))->first();

        //reponse payload
        $payload = [
            'estimate' => $estimate,
        ];

        //show the form
        return new ChangeStatusResponse($payload);
    }

    /**
     * change estimate status
     * @return \Illuminate\Http\Response
     */
    public function changeStatusUpdate() {

        //validate the estimate exists
        $estimate = \App\Models\Estimate::Where('bill_estimateid', request()->route('estimate'))->first();

        //update the estimate
        $estimate->bill_status = request('bill_status');
        $estimate->save();

        //get refreshed estimate
        $estimates = $this->estimaterepo->search(request()->route('estimate'));

        //reponse payload
        $payload = [
            'estimates' => $estimates,
            'bill_estimateid' => request()->route('estimate'),
            'stats' => $this->statsWidget(),
        ];

        //show the form
        return new UpdateResponse($payload);
    }

    /**
     * [UPCOMING]
     * convert to an estimate
     * @return \Illuminate\Http\Response
     */
    public function convertToInvoice() {

        //validate the estimate exists
        $estimate = \App\Models\Estimate::Where('bill_estimateid', request('id'))->first();

    }

    /**
     * Show the form for attaching a project to an estimate
     * @return \Illuminate\Http\Response
     */
    public function attachProject() {

        //get client id
        $client_id = request('client_id');

        //reponse payload
        $payload = [
            'projects_feed_url' => url("/feed/projects?ref=clients_projects&client_id=$client_id"),
        ];

        //show the form
        return new AttachProjectResponse($payload);
    }

    /**
     * attach a project to an estimate
     * @return \Illuminate\Http\Response
     */
    public function attachProjectUpdate() {

        //validate the estimate exists
        $estimate = \App\Models\estimate::Where('bill_estimateid', request()->route('estimate'))->first();

        //validate the project exists
        if (!$project = \App\Models\Project::Where('project_id', request('attach_project_id'))->first()) {
            abort(409, __('lang.item_not_found'));
        }

        //update the estimate
        $estimate->bill_projectid = request('attach_project_id');
        $estimate->bill_clientid = $project->project_clientid;
        $estimate->save();

        //get refreshed estimate
        $estimates = $this->estimaterepo->search(request()->route('estimate'));
        $estimate = $estimates->first();

        //refresh estimate
        $this->estimaterepo->refreshestimate($estimate);

        //reponse payload
        $payload = [
            'estimates' => $estimates,
        ];

        //show the form
        return new UpdateResponse($payload);
    }

    /**
     * dettach estimate from a project
     * @return \Illuminate\Http\Response
     */
    public function dettachProject() {

        //validate the estimate exists
        $estimate = \App\Models\estimate::Where('bill_estimateid', request()->route('estimate'))->first();

        //update the estimate
        $estimate->bill_projectid = null;
        $estimate->save();

        //get refreshed estimate
        $estimates = $this->estimaterepo->search(request()->route('estimate'));

        //reponse payload
        $payload = [
            'estimates' => $estimates,
        ];

        //show the form
        return new UpdateResponse($payload);
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
                __('lang.sales'),
                __('lang.estimates'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'estimates',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_estimates' => 'active',
            'mainmenu_sales' => 'active',
            'submenu_estimates' => 'active',
            'sidepanel_id' => 'sidepanel-filter-estimates',
            'dynamic_search_url' => url('estimates/search?action=search&estimateresource_id=' . request('estimateresource_id') . '&estimateresource_type=' . request('estimateresource_type')),
            'add_button_classes' => 'add-edit-estimate-button',
            'load_more_button_route' => 'estimates',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_estimate'),
            'add_modal_create_url' => url('estimates/create?estimateresource_id=' . request('estimateresource_id') . '&estimateresource_type=' . request('estimateresource_type')),
            'add_modal_action_url' => url('estimates?estimateresource_id=' . request('estimateresource_id') . '&estimateresource_type=' . request('estimateresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //estimates list page
        if ($section == 'estimates') {
            $page += [
                'meta_title' => __('lang.estimates'),
                'heading' => __('lang.estimates'),
                'sidepanel_id' => 'sidepanel-filter-estimates',
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //estimate page
        if ($section == 'estimate') {
            //adjust
            $page['page'] = 'estimate';
            //add
            $page += [
                'crumbs' => [
                    __('lang.estimates'),
                ],
                'meta_title' => __('lang.estimate') . ' #' . $data->formatted_bill_estimateid,
                'heading' => __('lang.project') . ' - ' . $data->project_title,
                'bill_estimateid' => request()->segment(2),
                'source_for_filter_panels' => 'ext',
                'section' => 'overview',
            ];

            $page['crumbs'] = [
                __('lang.sales'),
                __('lang.estimates'),
                $data['formatted_bill_estimateid'],
            ];

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
            $page['mode'] = 'editing';
            $page += [
                'section' => 'edit',
            ];
            return $page;
        }

        //return
        return $page;
    }

    /**
     * data for the stats widget
     * @return array
     */
    private function statsWidget($data = array()) {

        //stats
        $count_new = $this->estimaterepo->search('', ['stats' => 'count-new']);
        $count_accepted = $this->estimaterepo->search('', ['stats' => 'count-accepted']);
        $count_declined = $this->estimaterepo->search('', ['stats' => 'count-declined']);
        $count_expired = $this->estimaterepo->search('', ['stats' => 'count-expired']);

        $sum_new = $this->estimaterepo->search('', ['stats' => 'sum-new']);
        $sum_accepted = $this->estimaterepo->search('', ['stats' => 'sum-accepted']);
        $sum_declined = $this->estimaterepo->search('', ['stats' => 'sum-declined']);
        $sum_expired = $this->estimaterepo->search('', ['stats' => 'sum-expired']);

        //default values
        $stats = [
            [
                'value' => runtimeMoneyFormat($sum_new),
                'title' => __('lang.pending') . " ($count_new)",
                'percentage' => '100%',
                'color' => 'bg-info',
            ],
            [
                'value' => runtimeMoneyFormat($sum_accepted),
                'title' => __('lang.accepted') . " ($count_accepted)",
                'percentage' => '100%',
                'color' => 'bg-success',
            ],
            [
                'value' => runtimeMoneyFormat($sum_expired),
                'title' => __('lang.expired') . " ($count_expired)",
                'percentage' => '100%',
                'color' => 'bg-warning',
            ],
            [
                'value' => runtimeMoneyFormat($sum_declined),
                'title' => __('lang.declined') . " ($count_declined)",
                'percentage' => '100%',
                'color' => 'bg-danger',
            ],
        ];
        //return
        return $stats;
    }
}