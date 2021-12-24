<?php

namespace App\Http\Controllers;


use App\Models\FrontBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AttachmentRepository;
use App\Repositories\FrontBannerRepository;
use App\Http\Responses\FrontBanners\EditResponse;
use App\Http\Responses\FrontBanners\ShowResponse;
use App\Http\Responses\FrontBanners\IndexResponse;
use App\Http\Responses\FrontBanners\StoreResponse;
use App\Http\Responses\FrontBanners\CreateResponse;
use App\Http\Responses\FrontBanners\UpdateResponse;
use App\Http\Responses\FrontBanners\DestroyResponse;
use App\Http\Responses\FrontBanners\ShowDynamicResponse;
use App\Http\Requests\FrontBanners\FrontBannerValidation;
use App\Models\FCategory;

class FrontBanners extends Controller
{
    /**
     * The frontbanner repository instance.
     */
    protected $frontbannerrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    public function __construct(FrontBannerRepository $frontbannerrepo, AttachmentRepository $attachmentrepo,EventRepository $eventrepo,UserRepository $userrepo)
    {
        //parent
        parent::__construct();
        $this->frontbannerrepo = $frontbannerrepo;
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
        //get team frontbanners
        $frontbanners = $this->frontbannerrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('frontbanners'),
            'frontbanners' => $frontbanners,
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
        $frontbanner = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'frontbanner' => $frontbanner,
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
    public function store(FrontBannerValidation $request)
    {
        //create the frontbanner
        if (!$frontbanner_id = $this->frontbannerrepo->create()) {
           return abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $frontbanners = $this->frontbannerrepo->search($frontbanner_id);
        $frontbanner = $frontbanners->first();
        //[save attachments] loop through and save each attachment
        if (request()->filled('frontbanner')) {
            foreach (request('frontbanner') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'frontbanner',
                    'attachmentresource_id' => $frontbanner_id,
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
        $rows = $this->frontbannerrepo->search();
        $count = $rows->count();
        /** ----------------------------------------------
         * record event [frontbanner created]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontbanner_created',
            'event_item_id' => '',
            'event_item_lang' => 'frontbanner_created',
            'event_item_content' => $frontbanner->name,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View Client',
            'event_parent_id' => $frontbanner->id,
            'event_parent_title' => $frontbanner->name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View Client',
            'eventresource_id' => $frontbanner->id,
            'event_notification_category' => 'notifications_frontbanner_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontbanner->id, 'all', 'ids');
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'frontbanners' => $frontbanners,
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
        $frontbanners = $this->frontbannerrepo->search($id);
        $frontbanner = $frontbanners->first();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->get();

        //reponse payload
        $payload = [
            'frontbanner' => $frontbanner,
            'attachments' => $attachments,
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
        $frontbanners = $this->frontbannerrepo->search($id);
        $frontbanner = $frontbanners->first();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'frontbanner' => $frontbanner,
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
    public function update(FrontBannerValidation $request, $id)
    {
        //get client
        $frontbanners = $this->frontbannerrepo->search($id);
        $frontbanner = $frontbanners->first();
        //update

        $oldName = $frontbanner->title;
        $oldCategory = FCategory::where('name', $oldName)->first();
        
        if($oldCategory){
            $oldCategory->name = $request->frontbanner_title;
            $oldCategory->save();
        }

        if (!$this->frontbannerrepo->update($id)) {
            abort(409);
        }

        //get client
        $frontbanners = $this->frontbannerrepo->search($id);
        $frontbanner = $frontbanners->first();
        if (request()->filled('frontbanner')) {
            foreach (request('frontbanner') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'frontbanner',
                    'attachmentresource_id' => $frontbanner->id,
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
         * record event [frontbanner updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontbanner_updated',
            'event_item_id' => '',
            'event_item_lang' => 'frontbanner_updated',
            'event_item_content' => $frontbanner->name,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View Client',
            'event_parent_id' => $frontbanner->id,
            'event_parent_title' => $frontbanner->name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View Client',
            'eventresource_id' => $frontbanner->id,
            'event_notification_category' => 'notifications_frontbanner_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontbanner->id, 'all', 'ids');

        }

        //reponse payload
        $payload = [
            'frontbanners' => $frontbanners,
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
        if (!\App\Models\FrontBanner::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $frontbanners = $this->frontbannerrepo->search($id);
        $frontbanner = $frontbanners->first();

          //delete attachemnts
    if ($attachments = $frontbanner->attachments()->get()) {
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
         * record event [frontbanner deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontbanner_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'frontbanner_deleted',
            'event_item_content' => $frontbanner->name,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View Client',
            'event_parent_id' => $frontbanner->id,
            'event_parent_title' => $frontbanner->name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View Client',
            'eventresource_id' => $frontbanner->id,
            'event_notification_category' => 'notifications_frontbanner_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontbanner->id, 'all', 'ids');

        }

        //delete the category
        $frontbanner->delete();

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
                __('lang.frontbanners'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'frontbanners',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_fronts' => 'active',
            'submenu_banners' => 'active',
            'mainmenu_banners' => 'active',
            'sidepanel_id' => 'sidepanel-filter-frontbanners',
            'dynamic_search_url' => url('frontbanners/search?action=search&frontbannerresource_id=' . request('frontbannerresource_id') . '&frontbannerresource_type=' . request('frontbannerresource_type')),
            'add_button_classes' => 'add-edit-frontbanners-button',
            'load_more_button_route' => 'frontbanners',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_frontbanner'),
            'add_modal_create_url' => url('frontbanners/create?frontbannerresource_id=' . request('frontbannerresource_id') . '&frontbannerresource_type=' . request('frontbannerresource_type')),
            'add_modal_action_url' => url('frontbanners?frontbannerresource_id=' . request('frontbannerresource_id') . '&frontbannerresource_type=' . request('frontbannerresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //banners list page
        if ($section == 'frontbanners') {
            $page += [
                'meta_title' => __('lang.frontbanners'),
                'heading' => __('lang.frontbanners'),
                'sidepanel_id' => 'sidepanel-filter-frontbanners',
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
     * Display the specified banner
     * @param int $id banner id
     * @return \Illuminate\Http\Response
     */
    public function showDynamic($id)
    {

        //get the banner
        $frontbanners = $this->bannerrepo->search($id);

        //banner
        $frontbanner = $frontbanners->first();

        $page = $this->pageSettings('frontbanners', $frontbanner);

        //set dynamic url for use in template
        switch (request()->segment(3)) {
            case 'frontbanners':
        
                $sections = request()->segment(3);
                $section = rtrim($sections, 's');
                $page['dynamic_url'] = url($sections . '?source=ext&' . $section . 'resource_type=client&' . $section . 'resource_id=' . $frontbanner->id);
                break;
            case 'details':
                $page['dynamic_url'] = url('frontbanners/' . $frontbanner->id . '/frontbanners-details');
                break;
            default:
                $page['dynamic_url'] = url('frontbanners?source=ext&commentresource_type=client&commentresource_id=' . $frontbanner->id);
                break;
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'banner' => $frontbanner,
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
            'selector' => '#frontbanner_attachment_' . $attachment->attachment_id,
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
        $frontbanner = FrontBanner::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->get();
        return view('pages.frontbanner.show-event',compact('frontbanner','attachments'));
    }
}
