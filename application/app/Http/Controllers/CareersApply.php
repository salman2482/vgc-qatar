<?php

namespace App\Http\Controllers;


use App\Models\CareerApply;
use Illuminate\Http\Request;
use App\Mail\CareerApplyMail;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AttachmentRepository;
use App\Repositories\CareerApplyRepository;
use App\Http\Responses\CareersApply\EditResponse;
use App\Http\Responses\CareersApply\IndexResponse;
use App\Http\Responses\CareersApply\StoreResponse;
use App\Http\Responses\CareersApply\CreateResponse;
use App\Http\Responses\CareersApply\UpdateResponse;
use App\Http\Responses\CareersApply\DestroyResponse;
use App\Http\Responses\CareersApply\ShowDynamicResponse;
use App\Http\Requests\CareersApply\CareerApplyValidation;

class CareersApply extends Controller
{
    /**
     * The careerapply repository instance.
     */
    protected $careerapplyrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    public function __construct(CareerApplyRepository $careerapplyrepo, AttachmentRepository $attachmentrepo,EventRepository $eventrepo,UserRepository $userrepo)
    {
        //parent
        parent::__construct();
        $this->careerapplyrepo = $careerapplyrepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;
        $this->userrepo = $userrepo;
        //authenticated
        
        //authenticated
        $this->middleware('auth')->except('store');
        $this->middleware('frontclientprojectMiddlewareIndex')->except('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get team careersapply
        $careersapply = $this->careerapplyrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('careersapply'),
            'careersapply' => $careersapply,
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
        $careerapply = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'careerapply' => $careerapply,
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
    public function store(CareerApplyValidation $request)
    {
        // $request->validate([
        //     'g-recaptcha-response' => 'required|captcha',
        // ],[ 'g-recaptcha-response.required'=> trans('fl.Captcha Required'), ]);
        //create the careerapply
        $apply = new CareerApply();
        $apply->type = request('type');
        $apply->field = request('field');
        $apply->position = request('position');
        $apply->experience = request('experience');
        $apply->first_name = request('first_name');
        $apply->middle_name = request('middle_name');
        $apply->last_name = request('last_name');
        $apply->dob = request('dob');
        $apply->gender = request('gender');
        $apply->marital_status = request('marital_status');
        $apply->education = request('education');
        $apply->nationality = request('nationality');
        $apply->other_nationality = request('other_nationality');
        $apply->current_country = request('current_country');
        $apply->address = request('address');
        $apply->primary_email = request('primary_email');
        $apply->secondary_email = request('secondary_email');
        $apply->mobile = request('mobile');
        $apply->land_line = request('land_line');
        $apply->time_to_receive_calls = request('time_to_receive_calls');
        $apply->why_current_job = request('why_current_job');
        $apply->termination = request('termination');
        $apply->governmental_permits = request('governmental_permits');
        $apply->nongovernmental_permits = request('nongovernmental_permits');
        $apply->license = request('license');
        $apply->certificate = request('certificate');
        $apply->joining_date = request('joining_date');
        $apply->noc = request('noc');
        $apply->objections = request('objections');
        $apply->expected_salary = request('expected_salary');
        
        $apply->employer_1 = request('employer_1');
        $apply->employer_2 = request('employer_2');
        $apply->employer_3 = request('employer_3');
        
        $apply->department_1 = request('department_1');
        $apply->department_2 = request('department_2');
        $apply->department_3 = request('department_3');

        $apply->designation_1 = request('designation_1');
        $apply->designation_2 = request('designation_2');
        $apply->designation_3 = request('designation_3');


        $apply->in_line_manager_1 = request('in_line_manager_1');
        $apply->in_line_manager_2 = request('in_line_manager_2');
        $apply->in_line_manager_3 = request('in_line_manager_3');


        $apply->service_duration_1 = request('service_duration_1');
        $apply->service_duration_2 = request('service_duration_2');
        $apply->service_duration_3 = request('service_duration_3');

        $apply->salary_1 = request('salary_1');
        $apply->salary_2 = request('salary_2');
        $apply->salary_3 = request('salary_3');

        $apply->references_name_1 = request('references_name_1');
        $apply->references_name_2 = request('references_name_2');
        $apply->references_name_3 = request('references_name_3');

        $apply->references_contact_1 = request('references_contact_1');
        $apply->references_contact_2 = request('references_contact_2');
        $apply->references_contact_3 = request('references_contact_3');

        $apply->references_email_1 = request('references_email_1');
        $apply->references_email_2 = request('references_email_2');
        $apply->references_email_3 = request('references_email_3');

        $apply->references_relationship_1 = request('references_relationship_1');
        $apply->references_relationship_2 = request('references_relationship_2');
        $apply->references_relationship_3 = request('references_relationship_3');

        //for updated_resume
        if ($request->hasFile('updated_resume')) {
            $file = $request->file('updated_resume');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/career/'.$fileName,file_get_contents($file));
            $apply->updated_resume = $fileName;
        }else{
            $apply->updated_resume = "";
        }

        //for certficates
        if ($request->hasFile('certficates')) {
            $file = $request->file('certficates');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/career/'.$fileName,file_get_contents($file));
            $apply->certficates = $fileName;
        }else{
            $apply->certficates = "";
        }
        
        //for other_doc
        if ($request->hasFile('other_doc')) {
            $file = $request->file('other_doc');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/career/'.$fileName,file_get_contents($file));
            $apply->other_doc = $fileName;
        }else{
            $apply->other_doc = "";
        }

        $apply->save();

    
        Mail::to(request('primary_email'))->send(new CareerApplyMail($apply));
        
        /** ----------------------------------------------
         * record event [careerapply created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => $apply->id,
            'event_item' => 'careerapply_created',
            'event_item_id' => '',
            'event_item_lang' => 'careerapply_created',
            'event_item_content' => $apply->type.' For '.$apply->field,
            'event_item_content2' => '',
            'event_parent_type' => 'Career Apply',
            'event_parent_id' => $apply->id,
            'event_parent_title' => $apply->type.' For '.$apply->field ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => $apply->id,
            'eventresource_type' => 'Career Apply',
            'eventresource_id' => $apply->id,
            'event_notification_category' => 'notifications_careerapply_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($apply->id, 'all', 'ids');
        }
        return redirect()->route('front.career')->with('success','You have Successfully Applied');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $careerapply = CareerApply::findOrFail($id);
        return view('pages.careerapply.components.table.show', compact('careerapply'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $careersapply = $this->careerapplyrepo->search($id);
        $careerapply = $careersapply->first();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'careerapply')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'careerapply' => $careerapply,
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
    public function update(CareerApplyValidation $request, $id)
    {
       //get careerapply
       $careersapply = $this->careerapplyrepo->search($id);
       $careerapply = $careersapply->first();
       //update
       if (!$this->careerapplyrepo->update($id)) {
           abort(409);
       }

        //get careerapply
        $careersapply = $this->careerapplyrepo->search($id);
        $careerapply = $careersapply->first();
        if (request()->filled('careerapply')) {
            foreach (request('careerapply') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'careerapply',
                    'attachmentresource_id' => $careerapply->id,
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
         * record event [careerapply updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'careerapply_updated',
            'event_item_id' => '',
            'event_item_lang' => 'careerapply_updated',
            'event_item_content' => $careerapply->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Career Apply',
            'event_parent_id' => $careerapply->id,
            'event_parent_title' => $careerapply->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Career Apply',
            'eventresource_id' => $careerapply->id,
            'event_notification_category' => 'notifications_careerapply_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($careerapply->id, 'all', 'ids');

        }

        //reponse payload
        $payload = [
            'careersapply' => $careersapply,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified careerapply from storage.
     * @param object DestroyRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete each record in the array
        //get record
        if (!\App\Models\CareerApply::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $careersapply = $this->careerapplyrepo->search($id);
        $careerapply = $careersapply->first();

        /** ----------------------------------------------
         * record event [careerapply deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'careerapply_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'careerapply_deleted',
            'event_item_content' => $careerapply->title,
            'event_item_content2' => '',
            'event_parent_type' => 'Career Apply',
            'event_parent_id' => $careerapply->id,
            'event_parent_title' => $careerapply->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Career Apply',
            'eventresource_id' => $careerapply->id,
            'event_notification_category' => 'notifications_careerapply_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($careerapply->id, 'all', 'ids');

        }

        //delete the category
        $careerapply->delete();

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
                __('lang.careersapply'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'careersapply',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_careers' => 'active',
            'submenu_careersapply' => 'active',
            'mainmenu_careersapply' => 'active',
            'sidepanel_id' => 'sidepanel-filter-careersapply',
            'dynamic_search_url' => url('careersapply/search?action=search&careerapplyresource_id=' . request('careerapplyresource_id') . '&careerapplyresource_type=' . request('careerapplyresource_type')),
            'add_button_classes' => 'add-edit-careersapply-button',
            'load_more_button_route' => 'careersapply',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_careerapply'),
            'add_modal_create_url' => url('careersapply/create?careerapplyresource_id=' . request('careerapplyresource_id') . '&careerapplyresource_type=' . request('careerapplyresource_type')),
            'add_modal_action_url' => url('careersapply?careerapplyresource_id=' . request('careerapplyresource_id') . '&careerapplyresource_type=' . request('careerapplyresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //careersapply list page
        if ($section == 'careersapply') {
            $page += [
                'meta_title' => __('lang.careersapply'),
                'heading' => __('lang.careersapply'),
                'sidepanel_id' => 'sidepanel-filter-careersapply',
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
     * Display the specified careerapply
     * @param int $id careerapply id
     * @return \Illuminate\Http\Response
     */
    public function showDynamic($id)
    {

        //get the careerapply
        $careersapply = $this->careerrepo->search($id);

        //careerapply
        $careerapply = $careersapply->first();

        $page = $this->pageSettings('careersapply', $careerapply);

        //set dynamic url for use in template
        switch (request()->segment(3)) {
            case 'careersapply':
        
                $sections = request()->segment(3);
                $section = rtrim($sections, 's');
                $page['dynamic_url'] = url($sections . '?source=ext&' . $section . 'resource_type=careerapply&' . $section . 'resource_id=' . $careerapply->id);
                break;

                case 'details':
                $page['dynamic_url'] = url('careersapply/' . $careerapply->id . '/careersapply-details');
                break;

           
                default:
                $page['dynamic_url'] = url('careersapply?source=ext&commentresource_type=careerapply&commentresource_id=' . $careerapply->id);
                break;
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'careerapply' => $careerapply,
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
            'selector' => '#careerapply_attachment_' . $attachment->attachment_id,
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
        $careerapply = CareerApply::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'careerapply')
            ->get();
        return view('pages.careerapply.show-event',compact('careerapply','attachments'));
    }

}
