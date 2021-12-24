<?php

namespace App\Http\Controllers;


use App\Models\FrontClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AttachmentRepository;
use App\Repositories\FrontClientRepository;
use App\Http\Responses\FrontClients\EditResponse;
use App\Http\Responses\FrontClients\IndexResponse;
use App\Http\Responses\FrontClients\StoreResponse;
use App\Http\Responses\FrontClients\CreateResponse;
use App\Http\Responses\FrontClients\UpdateResponse;
use App\Http\Responses\FrontClients\DestroyResponse;
use App\Http\Responses\FrontClients\ShowDynamicResponse;
use App\Http\Requests\FrontClients\FrontClientValidation;


class FrontClients extends Controller
{
    /**
     * The frontclient repository instance.
     */
    protected $frontclientrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    public function __construct(FrontClientRepository $frontclientrepo, AttachmentRepository $attachmentrepo,EventRepository $eventrepo,UserRepository $userrepo)
    {
        //parent
        parent::__construct();
        $this->frontclientrepo = $frontclientrepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;
        $this->userrepo = $userrepo;
        //authenticated
        
        //authenticated
        $this->middleware('auth');
        
        $this->middleware('frontclientprojectMiddlewareIndex');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get team frontclients
        $frontclients = $this->frontclientrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('frontclients'),
            'frontclients' => $frontclients,
        ];

        //show the view
        return new IndexResponse($payload);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $frontclient = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'frontclient' => $frontclient,
        ];

        //show the form
        return new CreateResponse($payload);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FrontClientValidation $request)
    {
        // dd($request);
        //create the frontclient
        if (!$frontclient_id = $this->frontclientrepo->create()) {
           return abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $frontclients = $this->frontclientrepo->search($frontclient_id);
        $frontclient = $frontclients->first();
        //[save attachments] loop through and save each attachment
        if (request()->filled('frontclient')) {
            foreach (request('frontclient') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'frontclient',
                    'attachmentresource_id' => $frontclient_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_document'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        //counting all rows
        $rows = $this->frontclientrepo->search();
        $count = $rows->count();
        /** ----------------------------------------------
         * record event [frontclient created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontclient_created',
            'event_item_id' => '',
            'event_item_lang' => 'frontclient_created',
            'event_item_content' => $frontclient->name,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View Client',
            'event_parent_id' => $frontclient->id,
            'event_parent_title' => $frontclient->name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View Client',
            'eventresource_id' => $frontclient->id,
            'event_notification_category' => 'notifications_frontclient_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontclient->id, 'all', 'ids');
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'frontclients' => $frontclients,
        ];

        //process reponse
        return new StoreResponse($payload);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $frontclients = $this->frontclientrepo->search($id);
        $frontclient = $frontclients->first();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'frontclient')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'frontclient' => $frontclient,
            'attachments' => $attachments,
        ];
        return new EditResponse($payload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FrontclientValidation $request, $id)
    {
        //get client
        $frontclients = $this->frontclientrepo->search($id);
        $frontclient = $frontclients->first();
        //update
        if (!$this->frontclientrepo->update($id)) {
            abort(409);
        }

        //get client
        $frontclients = $this->frontclientrepo->search($id);
        $frontclient = $frontclients->first();
        if (request()->filled('frontclient')) {
            foreach (request('frontclient') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'frontclient',
                    'attachmentresource_id' => $frontclient->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_document'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

            /** ----------------------------------------------
         * record event [frontclient updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontclient_updated',
            'event_item_id' => '',
            'event_item_lang' => 'frontclient_updated',
            'event_item_content' => $frontclient->name,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View Client',
            'event_parent_id' => $frontclient->id,
            'event_parent_title' => $frontclient->name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View Client',
            'eventresource_id' => $frontclient->id,
            'event_notification_category' => 'notifications_frontclient_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontclient->id, 'all', 'ids');

        }

        //reponse payload
        $payload = [
            'frontclients' => $frontclients,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified client from storage.
     * @param object DestroyRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete each record in the array
        //get record
        if (!\App\Models\FrontClient::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $frontclients = $this->frontclientrepo->search($id);
        $frontclient = $frontclients->first();

          //delete attachemnts
    if ($attachments = $frontclient->attachments()->get()) {
        foreach ($attachments as $attachment) {
            if ($attachment->attachment_directory != '') {
                if (Storage::exists("files/$attachment->attachment_directory")) {
                    Storage::deleteDirectory("files/$attachment->attachment_directory");
                }
            }
            $attachment->delete();
        }
    }

        /** ----------------------------------------------
         * record event [frontclient deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontclient_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'frontclient_deleted',
            'event_item_content' => $frontclient->name,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View Client',
            'event_parent_id' => $frontclient->id,
            'event_parent_title' => $frontclient->name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View Client',
            'eventresource_id' => $frontclient->id,
            'event_notification_category' => 'notifications_frontclient_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontclient->id, 'all', 'ids');

        }

        //delete the category
        $frontclient->delete();

        //reponse payload
        $payload = [
            'id' => $id,
        ];

        //generate a response
        return new DestroyResponse($payload);
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
                __('lang.frontclients'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'frontclients',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_fronts' => 'active',
            'submenu_clients' => 'active',
            'mainmenu_clients' => 'active',
            'sidepanel_id' => 'sidepanel-filter-frontclients',
            'dynamic_search_url' => url('frontclients/search?action=search&frontclientresource_id=' . request('frontclientresource_id') . '&frontclientresource_type=' . request('frontclientresource_type')),
            'add_button_classes' => 'add-edit-frontclients-button',
            'load_more_button_route' => 'frontclients',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_frontclient'),
            'add_modal_create_url' => url('frontclients/create?frontclientresource_id=' . request('frontclientresource_id') . '&frontclientresource_type=' . request('frontclientresource_type')),
            'add_modal_action_url' => url('frontclients?frontclientresource_id=' . request('frontclientresource_id') . '&frontclientresource_type=' . request('frontclientresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //clients list page
        if ($section == 'frontclients') {
            $page += [
                'meta_title' => __('lang.frontclients'),
                'heading' => __('lang.frontclients'),
                'sidepanel_id' => 'sidepanel-filter-frontclients',
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //ext page settings
        if ($section == 'ext') {
            $page += [
                'list_page_actions_size' => 'col-lg-12',

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
            $page += [
                'section' => 'edit',
            ];
            return $page;
        }

        //return
        return $page;
    }

    /**
     * Display the specified client
     * @param int $id client id
     * @return \Illuminate\Http\Response
     */
    public function showDynamic($id)
    {

        //get the client
        $frontclients = $this->clientrepo->search($id);

        //client
        $frontclient = $frontclients->first();

        $page = $this->pageSettings('frontclients', $frontclient);

        //set dynamic url for use in template
        switch (request()->segment(3)) {
            case 'frontclients':
        
                $sections = request()->segment(3);
                $section = rtrim($sections, 's');
                $page['dynamic_url'] = url($sections . '?source=ext&' . $section . 'resource_type=client&' . $section . 'resource_id=' . $frontclient->id);
                break;
            case 'details':
                $page['dynamic_url'] = url('frontclients/' . $frontclient->id . '/frontclients-details');
                break;
            default:
                $page['dynamic_url'] = url('frontclients?source=ext&commentresource_type=client&commentresource_id=' . $frontclient->id);
                break;
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'client' => $frontclient,
        ];

        //response
        return new ShowDynamicResponse($payload);
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
            'selector' => '#frontclient_attachment_' . $attachment->attachment_id,
            'action' => 'slideup-slow-remove',
        );

        //response
        return response()->json($jsondata);
    }

    public function downloadAttachment($id)
    {
        //check if file exists in the database
        $attachment = \App\Models\Attachment::Where('attachment_uniqiueid', request()->route('uniqueid'))->first();

        //confirm thumb exists
        if ($attachment->attachment_filename != '') {
            $file_path = "files/$attachment->attachment_directory/$attachment->attachment_filename";
            if (Storage::exists($file_path)) {
                return Storage::download($file_path);
            }
        }
        abort(404);
    }

    public function showEvent($id)
    {
        $frontclient = FrontClient::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'frontclient')
            ->get();
        return view('pages.frontclient.show-event',compact('frontclient','attachments'));
    }
}
