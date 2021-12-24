<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmployeLegalDocument;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AttachmentRepository;
use App\Repositories\EmployeeLegalRepository;
use App\Http\Responses\EmployeeLegal\EditResponse;
use App\Http\Responses\EmployeeLegal\ShowResponse;
use App\Http\Responses\EmployeeLegal\IndexResponse;
use App\Http\Responses\EmployeeLegal\StoreResponse;
use App\Http\Responses\EmployeeLegal\CreateResponse;
use App\Http\Responses\EmployeeLegal\UpdateResponse;
use App\Http\Responses\EmployeeLegal\DestroyResponse;

class EmployeLegalDocuments extends Controller
{
    /**
     * The document repository instance.
     */
    protected $employeerepo;
    protected $attachmentrepo;
    protected $eventrepo;
    public function __construct(EmployeeLegalRepository $employeerepo, AttachmentRepository $attachmentrepo, EventRepository $eventrepo)
    {
        //parent
        parent::__construct();

        $this->employeerepo = $employeerepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;

        //authenticated
        $this->middleware('auth');
        //Permissions on methods
        $this->middleware('employeeMiddlewareIndex');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get documents
        $employees = $this->employeerepo->search();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('employees'),
            'employees' => $employees,
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
        $employee = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'employee' => $employee,
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
    public function store(Request $request)
    {
        $messages = [];

        //validate
        $validator = Validator::make(request()->all(), [
            'employee_no' => [
                'required',
            ],
            'employee_name' => [
                'required',
            ],
            'visa_no' => [
                'required',
            ],
            'id_no' => [
                'required',
            ],
            'expiration' => [
                'required',
            ],
            'passport_no' => [
                'required',
            ],
            'passport_expiration' => [
                'required',
            ],
            'contract_no' => [
                'required',
            ],
            'contract_expiration' => [
                'required',
            ],
            'arrival_date' => [
                'required',
            ],
            'working_starting_date' => [
                'required',
            ],
            'phcc_no' => [
                'required',
            ],
            'phcc_expiration' => [
                'required',
            ],
            'joining_visa_no' => [
                'required',
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


        if (!$employee_id = $this->employeerepo->create()) {
            abort(409);
        }

        $employees = $this->employeerepo->search($employee_id);
        $employee = $employees->first();

        //counting all rows
        $rows = $this->employeerepo->search();
        $count = $rows->count();

        // save attachments
        if (request()->filled('id_copy_attachments')) {
            foreach (request('id_copy_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employeelegaldocument',
                    'attachmentresource_id' => $employee_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_id_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('passport_attachments')) {
            foreach (request('passport_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employeelegaldocument',
                    'attachmentresource_id' => $employee_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_passport_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('contract_attachments')) {
            foreach (request('contract_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employeelegaldocument',
                    'attachmentresource_id' => $employee_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_contract_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('hamad_card_attachments')) {
            foreach (request('hamad_card_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employeelegaldocument',
                    'attachmentresource_id' => $employee_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_hamad_card_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('others_attachments')) {
            foreach (request('others_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employeelegaldocument',
                    'attachmentresource_id' => $employee_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_other_document'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        // end of attachments


        /** ----------------------------------------------
         * record event [document created]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'employee_legal_document_created',
            'event_item_id' => '',
            'event_item_lang' => 'employee_legal_document_created',
            'event_item_content' => $employee->id,
            'event_item_content2' => '',
            'event_parent_type' => 'employeedocument',
            'event_parent_id' => $employee->id,
            'event_parent_title' => $employee->employee_name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'employeedocument',
            'eventresource_id' => $employee->id,
            'event_notification_category' => 'notifications_employeedocument_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            // $users = $this->userrepo->getClientUsers($employee->id, 'all', 'ids');
            // //record notification
            // $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'employees' => $employees,
        ];

        //process reponse
        return new StoreResponse($payload);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeLegalDocument  $employeLegalDocument
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get the expense
        $employees = $this->employeerepo->search($id);
        $employee = $employees->first();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'employeelegaldocument')
            ->get();

        //reponse payload
        $payload = [
            'employee' => $employee,
            'attachments' => $attachments,
        ];

        //show the form
        return new ShowResponse($payload);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeLegalDocument  $employeLegalDocument
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employess = $this->employeerepo->search($id);
        $employee = $employess->first();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'employeelegaldocument')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'employee' => $employee,
            'attachments' => $attachments,
        ];
        return new EditResponse($payload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeLegalDocument  $employeLegalDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //get employees
        $employees = $this->employeerepo->search($id);
        $employee = $employees->first();
        //update
        if (!$this->employeerepo->update($id)) {
            abort(409);
        }

        //get employees
        $employees = $this->employeerepo->search($id);
        $employee = $employees->first();

        // save attachments
        // save attachments
        if (request()->filled('id_copy_attachments')) {
            foreach (request('id_copy_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employeelegaldocument',
                    'attachmentresource_id' => $employee->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_id_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('passport_attachments')) {
            foreach (request('passport_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employeelegaldocument',
                    'attachmentresource_id' => $employee->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_passport_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('contract_attachments')) {
            foreach (request('contract_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employeelegaldocument',
                    'attachmentresource_id' => $employee->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_contract_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('hamad_card_attachments')) {
            foreach (request('hamad_card_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employeelegaldocument',
                    'attachmentresource_id' => $employee->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_hamad_card_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('others_attachments')) {
            foreach (request('others_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'employeelegaldocument',
                    'attachmentresource_id' => $employee->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_other_document'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        // end of attachments
        /** ----------------------------------------------
         * record event [document created]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'employee_legal_document_updated',
            'event_item_id' => '',
            'event_item_lang' => 'employee_legal_document_updated',
            'event_item_content' => $employee->id,
            'event_item_content2' => '',
            'event_parent_type' => 'employeedocument',
            'event_parent_id' => $employee->id,
            'event_parent_title' => $employee->employee_name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'employeedocument',
            'eventresource_id' => $employee->id,
            'event_notification_category' => 'notifications_employeedocument_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
        }


        //reponse payload
        $payload = [
            'employees' => $employees,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeLegalDocument  $employeLegalDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!\App\Models\EmployeLegalDocument::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $employess = $this->employeerepo->search($id);
        $employee = $employess->first();


        /** ----------------------------------------------
         * record event [document created]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'employee_legal_document_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'employee_legal_document_deleted',
            'event_item_content' => $employee->id,
            'event_item_content2' => '',
            'event_parent_type' => 'employeedocument',
            'event_parent_id' => $employee->id,
            'event_parent_title' => $employee->employee_name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'employeedocument',
            'eventresource_id' => $employee->id,
            'event_notification_category' => 'notifications_employeedocument_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
        }
        //delete the employee
        $employee->delete();

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
                __('Employee Legal Documents'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'employeedocument',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_control' => 'active',
            'submenu_employeedocument' => 'active',
            'sidepanel_id' => 'sidepanel-filter-employeedocument',
            'dynamic_search_url' => url('employeedocument/search?action=search&employeedocumentresource_id=' . request('employeedocumentresource_id') . '&employeedocumentresource_type=' . request('employeedocumentresource_type')),
            'add_button_classes' => 'add-edit-employeedocument-button',
            'load_more_button_route' => 'employeedocument',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('Add Employee Legal Document'),
            'add_modal_create_url' => url('employeedocument/create?employeedocumentresource_id=' . request('employeedocumentresource_id') . '&employeedocumentresource_type=' . request('employeedocumentresource_type')),
            'add_modal_action_url' => url('employeedocument?employeedocumentresource_id=' . request('employeedocumentresource_id') . '&employeedocumentresource_type=' . request('employeedocumentresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'employees') {
            $page += [
                'meta_title' => __('Employee Legal Document'),
                'heading' => __('Employee Legal Document'),
                'sidepanel_id' => 'sidepanel-filter-documents',
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
            'selector' => '#employee_attachment_' . $attachment->attachment_id,
            'action' => 'slideup-slow-remove',
        );

        //response
        return response()->json($jsondata);
    }

    public function downloadAttachment($id)
    {

        //check if file exists in the database
        $attachment = \App\Models\Attachment::Where('attachment_uniqiueid', request()->route('uniqueid'))->first();
        /** ----------------------------------------------
         * record event [document created]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'employee_legal_document_downloaded',
            'event_item_id' => '',
            'event_item_lang' => 'employee_legal_document_downloaded',
            'event_item_content' => 'Employee Legal Document Downloaded',
            'event_item_content2' => '',
            'event_parent_type' => 'employee legal document',
            'event_parent_id' => $attachment->attachmentresource_id,
            'event_parent_title' => 'Employee Legal Document Downloaded',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'employee legal document',
            'eventresource_id' => $attachment->attachmentresource_id,
            'event_notification_category' => 'notifications_employeelegaldocument_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
        }
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
        $employee = EmployeLegalDocument::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'employeelegaldocument')
            ->get();

        return view('pages.employeedocs.show-event', compact('employee', 'attachments'));
    }
}
