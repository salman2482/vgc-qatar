<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CorporateService;
use App\Models\SubCorporateService;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AttachmentRepository;
use App\Repositories\SubCoporateServiceRepository;
use App\Http\Responses\SubCorporateServices\EditResponse;
use App\Http\Responses\SubCorporateServices\ShowResponse;
use App\Http\Responses\SubCorporateServices\IndexResponse;
use App\Http\Responses\SubCorporateServices\StoreResponse;
use App\Http\Responses\SubCorporateServices\CreateResponse;
use App\Http\Responses\SubCorporateServices\UpdateResponse;
use App\Http\Responses\SubCorporateServices\DestroyResponse;
use App\Http\Responses\SubCorporateServices\ShowDynamicResponse;
use App\Http\Requests\SubCorporateServices\SubCorporateServiceValidation;

class SubCorporateServices extends Controller
{
    /**
     * The corporateservice repository instance.
     */
    protected $subcorporateservicerepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    public function __construct(SubCoporateServiceRepository $subcorporateservicerepo, AttachmentRepository $attachmentrepo,EventRepository $eventrepo,UserRepository $userrepo)
    {
        //parent
        parent::__construct();
        $this->subcorporateservicerepo = $subcorporateservicerepo;
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
        //get team subcorporateservices
        $subcorporateservices = $this->subcorporateservicerepo->search();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('subcorporateservices'),
            'subcorporateservices' => $subcorporateservices,
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
        $subcorporateservice = '';
        $corporateservices = CorporateService::all();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'subcorporateservice' => $subcorporateservice,
            'corporateservices' => $corporateservices,
        ];

        return new CreateResponse($payload);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCorporateServiceValidation $request)
    {
    
        if (!$subcorporateservice_id = $this->subcorporateservicerepo->create()) {
        }

        //get the category object (friendly for rendering in blade template)
        $subcorporateservices = $this->subcorporateservicerepo->search($subcorporateservice_id);
        $subcorporateservice = $subcorporateservices->first();

        //[save attachments] loop through and save each attachment
        if (request()->filled('subcorporateservice')) {
            foreach (request('subcorporateservice') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'subcorporateservice',
                    'attachmentresource_id' => $subcorporateservice_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_subcorporateservice'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        
        //counting all rows
        $rows = $this->subcorporateservicerepo->search();
        $count = $rows->count();
        /** ----------------------------------------------
         * record event [subcorporateservice created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'subcorporateservice_created',
            'event_item_id' => '',
            'event_item_lang' => 'subcorporateservice_created',
            'event_item_content' => $subcorporateservice->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Corporate Service',
            'event_parent_id' => $subcorporateservice->id,
            'event_parent_title' => $subcorporateservice->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Sub Corporate Service',
            'eventresource_id' => $subcorporateservice->id,
            'event_notification_category' => 'notifications_subcorporateservice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($subcorporateservice->id, 'all', 'ids');
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'subcorporateservices' => $subcorporateservices,
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
        $subcorporateservices = $this->subcorporateservicerepo->search($id);
        $subcorporateservice = $subcorporateservices->first();

        //reponse payload
        $payload = [
            'subcorporateservice' => $subcorporateservice,
        ];

        //show the form
        return new ShowResponse($payload);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcorporateservic = $this->subcorporateservicerepo->search($id);
        $subcorporateservice = $subcorporateservic->first();
        $corporateservices = CorporateService::all();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'subcorporateservice')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'subcorporateservice' => $subcorporateservice,
            'corporateservices' => $corporateservices,
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
    public function update(SubCorporateServiceValidation $request, $id)
    {
        //get subcorporateservice
        $subcorporateservices = $this->subcorporateservicerepo->search($id);
        $subcorporateservice = $subcorporateservices->first();
        //update
        if (!$this->subcorporateservicerepo->update($id)) {
            abort(409);
        }

        //get subcorporateservice
        $subcorporateservices = $this->subcorporateservicerepo->search($id);
        $subcorporateservice = $subcorporateservices->first();
        if (request()->filled('subcorporateservice')) {
            foreach (request('subcorporateservice') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'subcorporateservice',
                    'attachmentresource_id' => $subcorporateservice->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_subcorporateservice'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

            /** ----------------------------------------------
         * record event [subcorporateservice updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'subcorporateservice_updated',
            'event_item_id' => '',
            'event_item_lang' => 'subcorporateservice_updated',
            'event_item_content' => $subcorporateservice->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Corporate Service',
            'event_parent_id' => $subcorporateservice->id,
            'event_parent_title' => $subcorporateservice->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Corporate Service',
            'eventresource_id' => $subcorporateservice->id,
            'event_notification_category' => 'subnotifications_corporateservice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($subcorporateservice->id, 'all', 'ids');

        }

        //reponse payload
        $payload = [
            'subcorporateservices' => $subcorporateservices,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified corporateservice from storage.
     * @param object DestroyRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get record
        if (!\App\Models\SubCorporateService::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $subcorporateservices = $this->subcorporateservicerepo->search($id);
        $subcorporateservice = $subcorporateservices->first();

          //delete attachemnts
    //delete attachemnts
    if ($attachments = $subcorporateservice->attachments()->get()) {
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
         * record event [subcorporateservice deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'subcorporateservice_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'subcorporateservice_deleted',
            'event_item_content' => $subcorporateservice->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Corporate Service',
            'event_parent_id' => $subcorporateservice->id,
            'event_parent_title' => $subcorporateservice->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Corporate Service',
            'eventresource_id' => $subcorporateservice->id,
            'event_notification_category' => 'subnotifications_corporateservice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($subcorporateservice->id, 'all', 'ids');

        }

        //delete the category
        $subcorporateservice->delete();

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
                __('lang.subcorporateservices'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'subcorporateservices',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_bookings' => 'active',
            'submenu_subcorporateservices' => 'active',
            'mainmenu_subcorporateservices' => 'active',
            'sidepanel_id' => 'sidepanel-filter-subcorporateservices',
            'dynamic_search_url' => url('subcorporateservices/search?action=search&subcorporateserviceresource_id=' . request('subcorporateserviceresource_id') . '&subcorporateserviceresource_type=' . request('subcorporateserviceresource_type')),
            'add_button_classes' => 'add-edit-subcorporateservices-button',
            'load_more_button_route' => 'subcorporateservices',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_subcorporateservice'),
            'add_modal_create_url' => url('subcorporateservices/create?subcorporateserviceresource_id=' . request('subcorporateserviceresource_id') . '&subcorporateserviceresource_type=' . request('subcorporateserviceresource_type')),
            'add_modal_action_url' => url('subcorporateservices?subcorporateserviceresource_id=' . request('subcorporateserviceresource_id') . '&subcorporateserviceresource_type=' . request('subcorporateserviceresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //subcorporateservices list page
        if ($section == 'subcorporateservices') {
            $page += [
                'meta_title' => __('lang.subcorporateservices'),
                'heading' => __('lang.subcorporateservices'),
                'sidepanel_id' => 'sidepanel-filter-subcorporateservices',
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
     * Display the specified subcorporateservice
     * @param int $id subcorporateservice id
     * @return \Illuminate\Http\Response
     */
    public function showDynamic($id)
    {

        //get the subcorporateservice
        $subcorporateservices = $this->subcorporateservicerepo->search($id);

        //subcorporateservice
        $subcorporateservice = $subcorporateservices->first();

        $page = $this->pageSettings('subcorporateservices', $subcorporateservice);

        //set dynamic url for use in template
        switch (request()->segment(3)) {
            case 'subcorporateservices':
            case 'files':
            case 'invoices':
            case 'expenses':
            case 'payments':
            case 'timesheets':
            case 'notes':
            case 'tickets':
            case 'milestones':
            case 'tasks':
                $sections = request()->segment(3);
                $section = rtrim($sections, 's');
                $page['dynamic_url'] = url($sections . '?source=ext&' . $section . 'resource_type=subcorporateservice&' . $section . 'resource_id=' . $subcorporateservice->id);
                break;
            case 'details':
                $page['dynamic_url'] = url('subcorporateservices/' . $subcorporateservice->id . '/subcorporateservices-details');
                break;
            default:
                $page['dynamic_url'] = url('subcorporateservices?source=ext&commentresource_type=subcorporateservice&commentresource_id=' . $subcorporateservice->id);
                break;
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'subcorporateservice' => $subcorporateservice,
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
            'selector' => '#subcorporateservice_attachment_' . $attachment->attachment_id,
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
        $subcorporateservice = SubCorporateService::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'subcorporateservice')
            ->get();
        return view('pages.subcorporateservice.show-event',compact('subcorporateservice','attachments'));
    }


    public function subcorporate_services()
    {
        $services = SubCorporateService::all();
        $attachments = \App\Models\Attachment::Where('attachmentresource_type', 'subcorporateservice')
            ->get();
        return view('front-end.corporate-services.corporate-services', compact('services','attachments'));
    }
    
}
