<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Mail\ContractExpiredMail;
use App\Mail\DocumentExpiredMail;
use App\Models\DocumentManagment;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AttachmentRepository;
use App\Repositories\ContractMgtRepository;
use App\Http\Responses\Contracts\EditResponse;
use App\Http\Responses\Contracts\ShowResponse;
use App\Http\Responses\Contracts\IndexResponse;
use App\Http\Responses\Contracts\StoreResponse;
use App\Http\Responses\Contracts\CreateResponse;
use App\Http\Responses\Contracts\UpdateResponse;
use App\Http\Responses\Contracts\DestroyResponse;
use App\Models\ContractMgt as ModelsContractMgt;

class ContractMgt extends Controller
{

    /**
     * The contract repository instance.
     */
    protected $contractrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;

    public function __construct(ContractMgtRepository $contractrepo, AttachmentRepository $attachmentrepo, EventRepository $eventrepo, UserRepository $userrepo)
    {
        //parent
        parent::__construct();

        $this->contractrepo = $contractrepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;
        $this->userrepo = $userrepo;

        //authenticated
        $this->middleware('auth');
        //Permissions on methods
        $this->middleware('contractsMiddlewareIndex');
    }
    /**

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get team contracts
        $contracts = $this->contractrepo->search();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('contracts'),
            'contracts' => $contracts,
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
        $contract = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'contract' => $contract,
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
            'contract_category' => [
                'required',
            ],
            'contract_description' => [
                'required',
            ],
            'contract_issuance_date' => [
                'required',
            ],
            'contract_signed_by' => [
                'required',
            ],
            'contract_starting_date' => [
                'required',
            ],
            'contract_expiry_date' => [
                'required',
            ],
            'contract_project_value' => [
                'required',
            ],
            'contract_remarks' => [
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


        //save the client first
        if (!$contract_id = $this->contractrepo->create()) {
            return abort(419);
        }

        $contracts = $this->contractrepo->search($contract_id);
        $contract = $contracts->first();
        //[save attachments] loop through and save each attachment
        if (request()->filled('lpo_attachments')) {
            foreach (request('lpo_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'contractmgt',
                    'attachmentresource_id' => $contract_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_lpo'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('contract_attachments')) {
            foreach (request('contract_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'contractmgt',
                    'attachmentresource_id' => $contract_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_contract'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        //counting rows
        $rows = $this->contractrepo->search();
        $count = $rows->total();

        /** ----------------------------------------------
         * record event [contract created]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'contract_created',
            'event_item_id' => '',
            'event_item_lang' => 'contract_created',
            'event_item_content' => $contract->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'contract',
            'event_parent_id' => $contract->id,
            'event_parent_title' => $contract->category ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'contract',
            'eventresource_id' => $contract->id,
            'event_notification_category' => 'notifications_contracts_activity',
        ];
        // dd($data);
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($contract->id, 'all', 'ids');
            // //record notification
            // $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'contracts' => $contracts,
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
        //get the expense
        $contracts = $this->contractrepo->search($id);
        $contract = $contracts->first();


        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'contractmgt')
            ->get();

        //reponse payload
        $payload = [
            'contract' => $contract,
            'attachments' => $attachments,
        ];
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'contract_viewed',
            'event_item_id' => '',
            'event_item_lang' => 'contract_viewed',
            'event_item_content' => $contract->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'contract',
            'event_parent_id' => $contract->id,
            'event_parent_title' => $contract->category ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'contract',
            'eventresource_id' => $contract->id,
            'event_notification_category' => 'notifications_contracts_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($contract->id, 'all', 'ids');
            // //record notification
            // $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
        }
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
        $contracts = $this->contractrepo->search($id);
        $contract = $contracts->first();


        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'contractmgt')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'contract' => $contract,
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
    public function update(Request $request, $id)
    {
        //get project
        $contracts = $this->contractrepo->search($id);
        $contract = $contracts->first();
        //update
        if (!$this->contractrepo->update($id)) {
            abort(409);
        }
        //get project
        $contracts = $this->contractrepo->search($id);
        $contract = $contracts->first();
        // dd(request()->all());
        //[save attachments] loop through and save each attachment
        //[save attachments] loop through and save each attachment
        if (request()->filled('lpo_attachments')) {
            foreach (request('lpo_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'contractmgt',
                    'attachmentresource_id' => $contract->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_lpo'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('contract_attachments')) {
            foreach (request('contract_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'contractmgt',
                    'attachmentresource_id' => $contract->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_contract'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        /** ----------------------------------------------
         * record event [contract updated]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'contract_updated',
            'event_item_id' => '',
            'event_item_lang' => 'contract_updated',
            'event_item_content' => $contract->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'contract',
            'event_parent_id' => $contract->id,
            'event_parent_title' => $contract->category ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'contract',
            'eventresource_id' => $contract->id,
            'event_notification_category' => 'notifications_contracts_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($contract->id, 'all', 'ids');
            // //record notification
            // $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
        }

        //reponse payload
        $payload = [
            'contracts' => $contracts,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete each record in the array
        //get record
        if (!\App\Models\ContractMgt::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $contracts = $this->contractrepo->search($id);
        $contract = $contracts->first();

        /** ----------------------------------------------
         * record event [contract deleted]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'contract_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'contract_deleted',
            'event_item_content' => $contract->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'contract',
            'event_parent_id' => $contract->id,
            'event_parent_title' => $contract->site ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'contract',
            'eventresource_id' => $contract->id,
            'event_notification_category' => 'notifications_contracts_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($contract->id, 'all', 'ids');
            // //record notification
            // $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
        }


        $contract->delete();

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
                __('lang.contracts'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'contracts',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_control' => 'active',
            'submenu_contracts' => 'active',
            'sidepanel_id' => 'sidepanel-filter-contracts',
            'dynamic_search_url' => url('contractsmgt/search?action=search&contractmgtresource_id=' . request('contractmgtresource_id') . '&contractmgtresource_type=' . request('contractmgtresource_type')),
            'add_button_classes' => 'add-edit-contracts-button',
            'load_more_button_route' => 'contracts',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('Add Contracts'),
            'add_modal_create_url' => url('contractsmgt/create?contractmgtresource_id=' . request('contractmgtresource_id') . '&contractmgtresource_type=' . request('contractmgtresource_type')),
            'add_modal_action_url' => url('contractsmgt?contractmgtresource_id=' . request('contractmgtresource_id') . '&contractmgtresource_type=' . request('contractmgtresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'contracts') {
            $page += [
                'meta_title' => __('lang.contract'),
                'heading' => __('lang.contract'),
                'sidepanel_id' => 'sidepanel-filter-contract',
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
            'selector' => '#govtdocument_attachment_' . $attachment->attachment_id,
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
        $contract = ModelsContractMgt::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'contractmgt')
            ->get();
        return view('pages.contract.show-event', compact('contract', 'attachments'));
    }
}
