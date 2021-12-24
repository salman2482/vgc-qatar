<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AttachmentRepository;
use App\Repositories\FrontProjectRepository;
use App\Http\Responses\FrontProjects\EditResponse;
use App\Http\Responses\FrontProjects\IndexResponse;
use App\Http\Responses\FrontProjects\StoreResponse;
use App\Http\Responses\FrontProjects\CreateResponse;
use App\Http\Responses\FrontProjects\UpdateResponse;
use App\Http\Responses\FrontProjects\DestroyResponse;
use App\Http\Responses\FrontProjects\ShowDynamicResponse;
use App\Http\Requests\FrontProjects\FrontProjectValidation;
use App\Models\FrontProject;

class FrontProjects extends Controller
{
    /**
     * The frontproject repository instance.
     */
    protected $frontprojectrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    public function __construct(FrontProjectRepository $frontprojectrepo, AttachmentRepository $attachmentrepo,EventRepository $eventrepo,UserRepository $userrepo)
    {
        //parent
        parent::__construct();
        $this->frontprojectrepo = $frontprojectrepo;
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
        //get team frontprojects
        $frontprojects = $this->frontprojectrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('frontprojects'),
            'frontprojects' => $frontprojects,
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
        $frontproject = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'frontproject' => $frontproject,
        ];

        // return view('pages.frontproject.components.modals.add-edit-inc');
        //show the form
        return new CreateResponse($payload);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FrontProjectValidation $request)
    {
        // dd($request);
        //create the frontproject
        if (!$frontproject_id = $this->frontprojectrepo->create()) {
           return abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $frontprojects = $this->frontprojectrepo->search($frontproject_id);
        $frontproject = $frontprojects->first();
        //[save attachments] loop through and save each attachment
        if (request()->filled('frontproject')) {
            foreach (request('frontproject') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'frontproject',
                    'attachmentresource_id' => $frontproject_id,
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
        $rows = $this->frontprojectrepo->search();
        $count = $rows->count();
        /** ----------------------------------------------
         * record event [frontproject created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontproject_created',
            'event_item_id' => '',
            'event_item_lang' => 'frontproject_created',
            'event_item_content' => $frontproject->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View Project',
            'event_parent_id' => $frontproject->id,
            'event_parent_title' => $frontproject->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View Project',
            'eventresource_id' => $frontproject->id,
            'event_notification_category' => 'notifications_frontproject_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontproject->id, 'all', 'ids');
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'frontprojects' => $frontprojects,
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
        $frontprojects = $this->frontprojectrepo->search($id);
        $frontproject = $frontprojects->first();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'frontproject')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'frontproject' => $frontproject,
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
    public function update(FrontProjectValidation $request, $id)
    {
        //get project
        $frontprojects = $this->frontprojectrepo->search($id);
        $frontproject = $frontprojects->first();
        //update
        if (!$this->frontprojectrepo->update($id)) {
            abort(409);
        }

        //get project
        $frontprojects = $this->frontprojectrepo->search($id);
        $frontproject = $frontprojects->first();
        if (request()->filled('frontproject')) {
            foreach (request('frontproject') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'frontproject',
                    'attachmentresource_id' => $frontproject->id,
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
         * record event [frontproject updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontproject_updated',
            'event_item_id' => '',
            'event_item_lang' => 'frontproject_updated',
            'event_item_content' => $frontproject->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View Project',
            'event_parent_id' => $frontproject->id,
            'event_parent_title' => $frontproject->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View Project',
            'eventresource_id' => $frontproject->id,
            'event_notification_category' => 'notifications_frontproject_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontproject->id, 'all', 'ids');

        }

        //reponse payload
        $payload = [
            'frontprojects' => $frontprojects,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified project from storage.
     * @param object DestroyRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete each record in the array
        //get record
        if (!\App\Models\FrontProject::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $frontprojects = $this->frontprojectrepo->search($id);
        $frontproject = $frontprojects->first();

          //delete attachemnts
    if ($attachments = $frontproject->attachments()->get()) {
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
         * record event [frontproject deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontproject_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'frontproject_deleted',
            'event_item_content' => $frontproject->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View Project',
            'event_parent_id' => $frontproject->id,
            'event_parent_title' => $frontproject->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View Project',
            'eventresource_id' => $frontproject->id,
            'event_notification_category' => 'notifications_frontproject_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontproject->id, 'all', 'ids');

        }

        //delete the category
        $frontproject->delete();

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
                __('lang.frontprojects'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'frontprojects',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_fronts' => 'active',
            'submenu_fprojects' => 'active',
            'mainmenu_fprojects' => 'active',
            'sidepanel_id' => 'sidepanel-filter-frontprojects',
            'dynamic_search_url' => url('frontprojects/search?action=search&frontprojectresource_id=' . request('frontprojectresource_id') . '&frontprojectresource_type=' . request('frontprojectresource_type')),
            'add_button_classes' => 'add-edit-frontprojects-button',
            'load_more_button_route' => 'frontprojects',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_frontproject'),
            'add_modal_create_url' => url('frontprojects/create?frontprojectresource_id=' . request('frontprojectresource_id') . '&frontprojectresource_type=' . request('frontprojectresource_type')),
            'add_modal_action_url' => url('frontprojects?frontprojectresource_id=' . request('frontprojectresource_id') . '&frontprojectresource_type=' . request('frontprojectresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'frontprojects') {
            $page += [
                'meta_title' => __('lang.frontprojects'),
                'heading' => __('lang.frontprojects'),
                'sidepanel_id' => 'sidepanel-filter-frontprojects',
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
     * Display the specified project
     * @param int $id project id
     * @return \Illuminate\Http\Response
     */
    public function showDynamic($id)
    {

        //get the project
        $frontprojects = $this->projectrepo->search($id);

        //project
        $frontproject = $frontprojects->first();

        $page = $this->pageSettings('frontprojects', $frontproject);

        //apply permissions
        // $this->applyPermissions($project);

        //set dynamic url for use in template
        switch (request()->segment(3)) {
            case 'frontprojects':
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
                $page['dynamic_url'] = url($sections . '?source=ext&' . $section . 'resource_type=project&' . $section . 'resource_id=' . $frontproject->id);
                break;
            case 'details':
                $page['dynamic_url'] = url('frontprojects/' . $frontproject->id . '/frontprojects-details');
                break;
            default:
                $page['dynamic_url'] = url('frontprojects?source=ext&commentresource_type=project&commentresource_id=' . $frontproject->id);
                break;
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'project' => $frontproject,
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
            'selector' => '#frontproject_attachment_' . $attachment->attachment_id,
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
        $frontproject = FrontProject::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'frontproject')
            ->get();
        return view('pages.frontproject.show-event',compact('frontproject','attachments'));
    }

}
