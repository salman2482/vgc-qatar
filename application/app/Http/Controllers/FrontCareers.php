<?php

namespace App\Http\Controllers;


use App\Models\CareerApply;
use App\Models\FrontCareer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AttachmentRepository;
use App\Repositories\FrontCareerRepository;
use App\Http\Responses\FrontCareers\EditResponse;
use App\Http\Responses\FrontCareers\ShowResponse;
use App\Http\Responses\FrontCareers\IndexResponse;
use App\Http\Responses\FrontCareers\StoreResponse;
use App\Http\Responses\FrontCareers\CreateResponse;
use App\Http\Responses\FrontCareers\UpdateResponse;
use App\Http\Responses\FrontCareers\DestroyResponse;
use App\Http\Responses\FrontCareers\ShowDynamicResponse;
use App\Http\Requests\FrontCareers\FrontCareerValidation;

class FrontCareers extends Controller
{
    /**
     * The frontcareer repository instance.
     */
    protected $frontcareerrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    public function __construct(FrontCareerRepository $frontcareerrepo, AttachmentRepository $attachmentrepo,EventRepository $eventrepo,UserRepository $userrepo)
    {
        //parent
        parent::__construct();
        $this->frontcareerrepo = $frontcareerrepo;
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
        //get team frontcareers
        $frontcareers = $this->frontcareerrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('frontcareers'),
            'frontcareers' => $frontcareers,
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
        $frontcareer = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'frontcareer' => $frontcareer,
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
    public function store(FrontCareerValidation $request)
    {
        //create the frontcareer
        if (!$frontcareer_id = $this->frontcareerrepo->create()) {
           return abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $frontcareers = $this->frontcareerrepo->search($frontcareer_id);
        $frontcareer = $frontcareers->first();
        
        //[save attachments] loop through and save each attachment
        if (request()->filled('frontcareer')) {
            foreach (request('frontcareer') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'frontcareer',
                    'attachmentresource_id' => $frontcareer_id,
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
        $rows = $this->frontcareerrepo->search();
        $count = $rows->count();
        /** ----------------------------------------------
         * record event [frontcareer created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontcareer_created',
            'event_item_id' => '',
            'event_item_lang' => 'frontcareer_created',
            'event_item_content' => $frontcareer->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View career',
            'event_parent_id' => $frontcareer->id,
            'event_parent_title' => $frontcareer->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View career',
            'eventresource_id' => $frontcareer->id,
            'event_notification_category' => 'notifications_frontcareer_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontcareer->id, 'all', 'ids');
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'frontcareers' => $frontcareers,
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
        $frontcareers = $this->frontcareerrepo->search($id);
        $frontcareer = $frontcareers->first();

        //reponse payload
        $payload = [
            'frontcareer' => $frontcareer,
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
        $frontcareers = $this->frontcareerrepo->search($id);
        $frontcareer = $frontcareers->first();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'frontcareer')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'frontcareer' => $frontcareer,
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
    public function update(FrontCareerValidation $request, $id)
    {
       //get career
       $frontcareers = $this->frontcareerrepo->search($id);
       $frontcareer = $frontcareers->first();
       //update
       if (!$this->frontcareerrepo->update($id)) {
           abort(409);
       }

        //get career
        $frontcareers = $this->frontcareerrepo->search($id);
        $frontcareer = $frontcareers->first();
        if (request()->filled('frontcareer')) {
            foreach (request('frontcareer') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'frontcareer',
                    'attachmentresource_id' => $frontcareer->id,
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
         * record event [frontcareer updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontcareer_updated',
            'event_item_id' => '',
            'event_item_lang' => 'frontcareer_updated',
            'event_item_content' => $frontcareer->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View career',
            'event_parent_id' => $frontcareer->id,
            'event_parent_title' => $frontcareer->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View career',
            'eventresource_id' => $frontcareer->id,
            'event_notification_category' => 'notifications_frontcareer_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontcareer->id, 'all', 'ids');

        }

        //reponse payload
        $payload = [
            'frontcareers' => $frontcareers,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified career from storage.
     * @param object DestroyRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete each record in the array
        //get record
        if (!\App\Models\FrontCareer::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $frontcareers = $this->frontcareerrepo->search($id);
        $frontcareer = $frontcareers->first();

          //delete attachemnts
    // if ($attachments = $frontcareer->attachments()->get()) {
    //     foreach ($attachments as $attachment) {
    //         if ($attachment->attachment_directory != '') {
    //             if (Storage::exists("files/$attachment->attachment_directory")) {
    //                 Storage::deleteDirectory("files/$attachment->attachment_directory");
    //             }
    //         }
    //         $attachment->delete();
    //     }
    // }

        /** ----------------------------------------------
         * record event [frontcareer deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'frontcareer_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'frontcareer_deleted',
            'event_item_content' => $frontcareer->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Front View career',
            'event_parent_id' => $frontcareer->id,
            'event_parent_title' => $frontcareer->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Front View career',
            'eventresource_id' => $frontcareer->id,
            'event_notification_category' => 'notifications_frontcareer_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($frontcareer->id, 'all', 'ids');

        }

        //delete the category
        $frontcareer->delete();

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
                __('lang.frontcareers'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'frontcareers',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_careers' => 'active',
            'submenu_careers' => 'active',
            'mainmenu_careers' => 'active',
            'sidepanel_id' => 'sidepanel-filter-frontcareers',
            'dynamic_search_url' => url('frontcareers/search?action=search&frontcareerresource_id=' . request('frontcareerresource_id') . '&frontcareerresource_type=' . request('frontcareerresource_type')),
            'add_button_classes' => 'add-edit-frontcareers-button',
            'load_more_button_route' => 'frontcareers',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_frontcareer'),
            'add_modal_create_url' => url('frontcareers/create?frontcareerresource_id=' . request('frontcareerresource_id') . '&frontcareerresource_type=' . request('frontcareerresource_type')),
            'add_modal_action_url' => url('frontcareers?frontcareerresource_id=' . request('frontcareerresource_id') . '&frontcareerresource_type=' . request('frontcareerresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //careers list page
        if ($section == 'frontcareers') {
            $page += [
                'meta_title' => __('lang.frontcareers'),
                'heading' => __('lang.frontcareers'),
                'sidepanel_id' => 'sidepanel-filter-frontcareers',
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
     * Display the specified career
     * @param int $id career id
     * @return \Illuminate\Http\Response
     */
    public function showDynamic($id)
    {

        //get the career
        $frontcareers = $this->careerrepo->search($id);

        //career
        $frontcareer = $frontcareers->first();

        $page = $this->pageSettings('frontcareers', $frontcareer);

        //set dynamic url for use in template
        switch (request()->segment(3)) {
            case 'frontcareers':
        
                $sections = request()->segment(3);
                $section = rtrim($sections, 's');
                $page['dynamic_url'] = url($sections . '?source=ext&' . $section . 'resource_type=career&' . $section . 'resource_id=' . $frontcareer->id);
                break;

                case 'details':
                $page['dynamic_url'] = url('frontcareers/' . $frontcareer->id . '/frontcareers-details');
                break;

           
                default:
                $page['dynamic_url'] = url('frontcareers?source=ext&commentresource_type=career&commentresource_id=' . $frontcareer->id);
                break;
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'career' => $frontcareer,
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
            'selector' => '#frontcareer_attachment_' . $attachment->attachment_id,
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
        $frontcareer = FrontCareer::findOrFail($id);
        // dd($frontcareer);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'frontcareer')
            ->get();
        return view('pages.frontcareer.show-event',compact('frontcareer','attachments'));
    }

}
