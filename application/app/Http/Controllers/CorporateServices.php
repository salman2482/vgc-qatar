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
use App\Http\Controllers\SubCorporateServices;
use App\Repositories\CoporateServiceRepository;
use App\Http\Responses\CorporateServices\EditResponse;
use App\Http\Responses\CorporateServices\ShowResponse;
use App\Http\Responses\CorporateServices\IndexResponse;
use App\Http\Responses\CorporateServices\StoreResponse;
use App\Http\Responses\CorporateServices\CreateResponse;
use App\Http\Responses\CorporateServices\UpdateResponse;
use App\Http\Responses\CorporateServices\DestroyResponse;
use App\Http\Responses\CorporateServices\ShowDynamicResponse;
use App\Http\Requests\CorporateServices\CorporateServiceValidation;

class CorporateServices extends Controller
{

    /**
     * The corporateservice repository instance.
     */
    protected $corporateservicerepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    protected $subcorp;
    public function __construct(CoporateServiceRepository $corporateservicerepo, AttachmentRepository $attachmentrepo,EventRepository $eventrepo,UserRepository $userrepo,SubCorporateServices $subcorp)
    {
        //parent
        parent::__construct();
        $this->corporateservicerepo = $corporateservicerepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;
        $this->userrepo = $userrepo;
        $this->subcorp = $subcorp;
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
        //get team corporateservices
        $corporateservices = $this->corporateservicerepo->search();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('corporateservices'),
            'corporateservices' => $corporateservices,
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
        $corporateservice = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'corporateservice' => $corporateservice,
        ];

        return new CreateResponse($payload);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CorporateServiceValidation $request)
    {
        if (!$corporateservice_id = $this->corporateservicerepo->create()) {
        }

        //get the category object (friendly for rendering in blade template)
        $corporateservices = $this->corporateservicerepo->search($corporateservice_id);
        $corporateservice = $corporateservices->first();

        //[save attachments] loop through and save each attachment
        if (request()->filled('corporateservice')) {
            foreach (request('corporateservice') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'corporateservice',
                    'attachmentresource_id' => $corporateservice_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_corporateservice'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        
        //counting all rows
        $rows = $this->corporateservicerepo->search();
        $count = $rows->count();
        /** ----------------------------------------------
         * record event [corporateservice created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'corporateservice_created',
            'event_item_id' => '',
            'event_item_lang' => 'corporateservice_created',
            'event_item_content' => $corporateservice->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Corporate Service',
            'event_parent_id' => $corporateservice->id,
            'event_parent_title' => $corporateservice->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Corporate Service',
            'eventresource_id' => $corporateservice->id,
            'event_notification_category' => 'notifications_corporateservice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($corporateservice->id, 'all', 'ids');
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'corporateservices' => $corporateservices,
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
        $corporateservices = $this->corporateservicerepo->search($id);
        $corporateservice = $corporateservices->first();

        //reponse payload
        $payload = [
            'corporateservice' => $corporateservice,
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
        $corporateservices = $this->corporateservicerepo->search($id);
        $corporateservice = $corporateservices->first();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'corporateservice')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'corporateservice' => $corporateservice,
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
    public function update(CorporateServiceValidation $request, $id)
    {
        //get corporateservice
        $corporateservices = $this->corporateservicerepo->search($id);
        $corporateservice = $corporateservices->first();
        //update
        if (!$this->corporateservicerepo->update($id)) {
            abort(409);
        }

        //get corporateservice
        $corporateservices = $this->corporateservicerepo->search($id);
        $corporateservice = $corporateservices->first();
        if (request()->filled('corporateservice')) {
            foreach (request('corporateservice') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'corporateservice',
                    'attachmentresource_id' => $corporateservice->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_corporateservice'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

            /** ----------------------------------------------
         * record event [corporateservice updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'corporateservice_updated',
            'event_item_id' => '',
            'event_item_lang' => 'corporateservice_updated',
            'event_item_content' => $corporateservice->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Corporate Service',
            'event_parent_id' => $corporateservice->id,
            'event_parent_title' => $corporateservice->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Corporate Service',
            'eventresource_id' => $corporateservice->id,
            'event_notification_category' => 'notifications_corporateservice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($corporateservice->id, 'all', 'ids');

        }

        //reponse payload
        $payload = [
            'corporateservices' => $corporateservices,
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
        if (!\App\Models\CorporateService::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $corporateservices = $this->corporateservicerepo->search($id);
        $corporateservice = $corporateservices->first();

          //delete attachemnts
    //delete attachemnts
    if ($attachments = $corporateservice->attachments()->get()) {
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
         * record event [corporateservice deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'corporateservice_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'corporateservice_deleted',
            'event_item_content' => $corporateservice->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Corporate Service',
            'event_parent_id' => $corporateservice->id,
            'event_parent_title' => $corporateservice->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Corporate Service',
            'eventresource_id' => $corporateservice->id,
            'event_notification_category' => 'notifications_corporateservice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($corporateservice->id, 'all', 'ids');

        }

        //delete the category
        $corpid = SubCorporateService::where('corporateservice_id', $corporateservice->id)->get();
        if($corpid){
            foreach ($corpid as $key ) {
                $this->subcorp->destroy($key->id);
            }
        }
        $corporateservice->delete();
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
                __('lang.corporateservices'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'corporateservices',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_bookings' => 'active',
            'submenu_corporateservices' => 'active',
            'mainmenu_corporateservices' => 'active',
            'sidepanel_id' => 'sidepanel-filter-corporateservices',
            'dynamic_search_url' => url('corporateservices/search?action=search&corporateserviceresource_id=' . request('corporateserviceresource_id') . '&corporateserviceresource_type=' . request('corporateserviceresource_type')),
            'add_button_classes' => 'add-edit-corporateservices-button',
            'load_more_button_route' => 'corporateservices',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_corporateservice'),
            'add_modal_create_url' => url('corporateservices/create?corporateserviceresource_id=' . request('corporateserviceresource_id') . '&corporateserviceresource_type=' . request('corporateserviceresource_type')),
            'add_modal_action_url' => url('corporateservices?corporateserviceresource_id=' . request('corporateserviceresource_id') . '&corporateserviceresource_type=' . request('corporateserviceresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //corporateservices list page
        if ($section == 'corporateservices') {
            $page += [
                'meta_title' => __('lang.corporateservices'),
                'heading' => __('lang.corporateservices'),
                'sidepanel_id' => 'sidepanel-filter-corporateservices',
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
     * Display the specified corporateservice
     * @param int $id corporateservice id
     * @return \Illuminate\Http\Response
     */
    public function showDynamic($id)
    {

        //get the corporateservice
        $corporateservices = $this->corporateservicerepo->search($id);

        //corporateservice
        $corporateservice = $corporateservices->first();

        $page = $this->pageSettings('corporateservices', $corporateservice);

        //set dynamic url for use in template
        switch (request()->segment(3)) {
            case 'corporateservices':
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
                $page['dynamic_url'] = url($sections . '?source=ext&' . $section . 'resource_type=corporateservice&' . $section . 'resource_id=' . $corporateservice->id);
                break;
            case 'details':
                $page['dynamic_url'] = url('corporateservices/' . $corporateservice->id . '/corporateservices-details');
                break;
            default:
                $page['dynamic_url'] = url('corporateservices?source=ext&commentresource_type=corporateservice&commentresource_id=' . $corporateservice->id);
                break;
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'corporateservice' => $corporateservice,
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
            'selector' => '#corporateservice_attachment_' . $attachment->attachment_id,
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
        $corporateservice = CorporateService::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'corporateservice')
            ->get();
        return view('pages.corporateservice.show-event',compact('corporateservice','attachments'));
    }


    public function corporate_services()
    {
        $services = CorporateService::all();
        $attachments = \App\Models\Attachment::Where('attachmentresource_type', 'corporateservice')
            ->get();
        return view('front-end.corporate-services.corporate-services', compact('services','attachments'));
    }
    
}
