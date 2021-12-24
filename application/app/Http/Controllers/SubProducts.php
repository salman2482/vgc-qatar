<?php

namespace App\Http\Controllers;

use App\Models\FProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AttachmentRepository;
use App\Repositories\SubProductRepository;
use App\Http\Responses\SubProducts\EditResponse;
use App\Http\Responses\SubProducts\ShowResponse;
use App\Http\Responses\SubProducts\IndexResponse;
use App\Http\Responses\SubProducts\StoreResponse;
use App\Http\Responses\SubProducts\CreateResponse;
use App\Http\Responses\SubProducts\UpdateResponse;
use App\Http\Responses\SubProducts\DestroyResponse;
use App\Http\Requests\SubProducts\SubProductValidation;
use App\Http\Responses\SubProducts\ShowDynamicResponse;
use App\Models\SubProduct;

class SubProducts extends Controller
{
    /**
     * The subproduct repository instance.
     */
    protected $subproductrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    public function __construct(SubProductRepository $subproductrepo, AttachmentRepository $attachmentrepo,EventRepository $eventrepo, UserRepository $userrepo)
    {
        //parent
        parent::__construct();
        $this->subproductrepo = $subproductrepo;
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
        //get team subproducts
        $subproducts = $this->subproductrepo->search();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('subproducts'),
            'subproducts' => $subproducts,
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
        $subproduct = '';
        $fproducts = FProduct::all();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'subproduct' => $subproduct,
            'fproducts' => $fproducts,
        ];

        return new CreateResponse($payload);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubProductValidation $request)
    {
    
        if (!$subproduct_id = $this->subproductrepo->create()) {
        }

        //get the category object (friendly for rendering in blade template)
        $subproducts = $this->subproductrepo->search($subproduct_id);
        $subproduct = $subproducts->first();

        //[save attachments] loop through and save each attachment
        if (request()->filled('subproduct')) {
            foreach (request('subproduct') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'subproduct',
                    'attachmentresource_id' => $subproduct_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_subproduct'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        
        //counting all rows
        $rows = $this->subproductrepo->search();
        $count = $rows->count();
        /** ----------------------------------------------
         * record event [subproduct created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'subproduct_created',
            'event_item_id' => '',
            'event_item_lang' => 'subproduct_created',
            'event_item_content' => $subproduct->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Corporate Service',
            'event_parent_id' => $subproduct->id,
            'event_parent_title' => $subproduct->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Sub Corporate Service',
            'eventresource_id' => $subproduct->id,
            'event_notification_category' => 'notifications_subproduct_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($subproduct->id, 'all', 'ids');
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'subproducts' => $subproducts,
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
        $subproducts = $this->subproductrepo->search($id);
        $subproduct = $subproducts->first();

        //reponse payload
        $payload = [
            'subproduct' => $subproduct,
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
        $subproducts = $this->subproductrepo->search($id);
        $subproduct = $subproducts->first();
        $fproducts = FProduct::all();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'subproduct')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'subproduct' => $subproduct,
            'fproducts' => $fproducts,
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
    public function update(SubProductValidation $request, $id)
    {
        //get subproduct
        $subproducts = $this->subproductrepo->search($id);
        $subproduct = $subproducts->first();
        //update
        if (!$this->subproductrepo->update($id)) {
            abort(409);
        }

        //get subproduct
        $subproducts = $this->subproductrepo->search($id);
        $subproduct = $subproducts->first();
        if (request()->filled('subproduct')) {
            foreach (request('subproduct') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'subproduct',
                    'attachmentresource_id' => $subproduct->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_subproduct'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

            /** ----------------------------------------------
         * record event [subproduct updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'subproduct_updated',
            'event_item_id' => '',
            'event_item_lang' => 'subproduct_updated',
            'event_item_content' => $subproduct->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Corporate Service',
            'event_parent_id' => $subproduct->id,
            'event_parent_title' => $subproduct->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Corporate Service',
            'eventresource_id' => $subproduct->id,
            'event_notification_category' => 'subnotifications_corporateservice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($subproduct->id, 'all', 'ids');

        }

        //reponse payload
        $payload = [
            'subproducts' => $subproducts,
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
        if (!\App\Models\SubProduct::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $subproducts = $this->subproductrepo->search($id);
        $subproduct = $subproducts->first();

          //delete attachemnts
    //delete attachemnts
    if ($attachments = $subproduct->attachments()->get()) {
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
         * record event [subproduct deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'subproduct_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'subproduct_deleted',
            'event_item_content' => $subproduct->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Corporate Service',
            'event_parent_id' => $subproduct->id,
            'event_parent_title' => $subproduct->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Corporate Service',
            'eventresource_id' => $subproduct->id,
            'event_notification_category' => 'subnotifications_corporateservice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($subproduct->id, 'all', 'ids');

        }

        //delete the category
        $subproduct->delete();

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
                __('lang.subproducts'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'subproducts',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_bookings' => 'active',
            'mainmenu_fproducts' => 'active',
            'submenu_subproducts' => 'active',
            'sidepanel_id' => 'sidepanel-filter-subproducts',
            'dynamic_search_url' => url('subproducts/search?action=search&subproductresource_id=' . request('subproductresource_id') . '&subproductresource_type=' . request('subproductresource_type')),
            'add_button_classes' => 'add-edit-subproducts-button',
            'load_more_button_route' => 'subproducts',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_subproduct'),
            'add_modal_create_url' => url('subproducts/create?subproductresource_id=' . request('subproductresource_id') . '&subproductresource_type=' . request('subproductresource_type')),
            'add_modal_action_url' => url('subproducts?subproductresource_id=' . request('subproductresource_id') . '&subproductresource_type=' . request('subproductresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //subproducts list page
        if ($section == 'subproducts') {
            $page += [
                'meta_title' => __('lang.subproducts'),
                'heading' => __('lang.subproducts'),
                'sidepanel_id' => 'sidepanel-filter-subproducts',
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
     * Display the specified subproduct
     * @param int $id subproduct id
     * @return \Illuminate\Http\Response
     */
    public function showDynamic($id)
    {

        //get the subproduct
        $subproducts = $this->subproductrepo->search($id);

        //subproduct
        $subproduct = $subproducts->first();

        $page = $this->pageSettings('subproducts', $subproduct);

        //set dynamic url for use in template
        switch (request()->segment(3)) {
            case 'subproducts':
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
                $page['dynamic_url'] = url($sections . '?source=ext&' . $section . 'resource_type=subproduct&' . $section . 'resource_id=' . $subproduct->id);
                break;
            case 'details':
                $page['dynamic_url'] = url('subproducts/' . $subproduct->id . '/subproducts-details');
                break;
            default:
                $page['dynamic_url'] = url('subproducts?source=ext&commentresource_type=subproduct&commentresource_id=' . $subproduct->id);
                break;
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'subproduct' => $subproduct,
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
            'selector' => '#subproduct_attachment_' . $attachment->attachment_id,
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
        $subproduct = SubProduct::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'subproduct')
            ->get();
        return view('pages.subproduct.show-event',compact('subproduct','attachments'));
    }


    public function subcorporate_services()
    {
        $services = SubProduct::all();
        $attachments = \App\Models\Attachment::Where('attachmentresource_type', 'subproduct')
            ->get();
        return view('front-end.corporate-services.corporate-services', compact('services','attachments'));
    }
    
}
