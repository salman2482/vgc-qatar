<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\QuotationRepository;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AttachmentRepository;
use App\Http\Responses\Quotations\EditResponse;
use App\Http\Responses\Quotations\ShowResponse;
use App\Http\Responses\Quotations\IndexResponse;
use App\Http\Responses\Quotations\StoreResponse;
use App\Http\Responses\Quotations\CreateResponse;
use App\Http\Responses\Quotations\UpdateResponse;
use App\Http\Responses\Quotations\DestroyResponse;
use App\Http\Responses\Quotations\ChangeStatusResponse;
use App\Models\Quotation as ModelsQuotation;

class Quotation extends Controller
{
    protected $quotationrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    public function __construct(QuotationRepository $quotationrepo, AttachmentRepository $attachmentrepo, EventRepository $eventrepo, UserRepository $userrepo)
    {
        //parent
        parent::__construct();

        $this->quotationrepo = $quotationrepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;
        $this->userrepo = $userrepo;
        //authenticated
        $this->middleware('auth');
        //Permissions on methods
        $this->middleware('quotationsMiddlewareIndex');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get team quotations
        $quotations = $this->quotationrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('quotations'),
            'quotations' => $quotations,
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
        $quotation = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'quotation' => $quotation,
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
            'issuance_date' => [
                'required',
            ],
            'expiration' => [
                'required',
            ],
            'delivery_date' => [
                'required',
            ],
            'estimated_by' => [
                'required',
            ],
            'delivery_method' => [
                'required',
            ],
            'client_rfq_ref' => [
                'required',
            ],
            'quotation_client_id' => [
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
        if (!$quotation_id = $this->quotationrepo->create()) {
            return abort(419);
        }

        $quotations = $this->quotationrepo->search($quotation_id);
        $quotation = $quotations->first();
        //[save attachments] loop through and save each attachment
        if (request()->filled('transmital_attachments')) {
            foreach (request('transmital_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'quotations',
                    'attachmentresource_id' => $quotation_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_transmital_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('technical_attachments')) {
            foreach (request('technical_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'quotations',
                    'attachmentresource_id' => $quotation_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_technical_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('financial_attachments')) {
            foreach (request('financial_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'quotations',
                    'attachmentresource_id' => $quotation_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_financial_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        //counting rows
        $rows = $this->quotationrepo->search();
        $count = $rows->total();


        /** ----------------------------------------------
         * record event [RFM deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'quotation_created',
            'event_item_id' => '',
            'event_item_lang' => 'quotation_created',
            'event_item_content' => $quotation->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'quotation',
            'event_parent_id' => $quotation->id,
            'event_parent_title' => $quotation->ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'quotation',
            'eventresource_id' => $quotation->id,
            'event_notification_category' => 'notifications_quotation_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($quotation->id, 'all', 'ids');
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'quotations' => $quotations,
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
        $quotations = $this->quotationrepo->search($id);
        $quotation = $quotations->first();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'quotations')
            ->get();

        //reponse payload
        $payload = [
            'quotation' => $quotation,
            'attachments' => $attachments,
        ];

        /** ----------------------------------------------
         * record event [RFM deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'quotation_viewed',
            'event_item_id' => '',
            'event_item_lang' => 'quotation_viewed',
            'event_item_content' => $quotation->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'quotation',
            'event_parent_id' => $quotation->id,
            'event_parent_title' => $quotation->ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'quotation',
            'eventresource_id' => $quotation->id,
            'event_notification_category' => 'notifications_quotation_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($quotation->id, 'all', 'ids');
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
        $quotations = $this->quotationrepo->search($id);
        $quotation = $quotations->first();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'quotations')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'quotation' => $quotation,
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
        $quotations = $this->quotationrepo->search($id);
        $quotation = $quotations->first();
        //update
        if (!$this->quotationrepo->update($id)) {
            abort(409);
        }
        //get project
        $quotations = $this->quotationrepo->search($id);
        $quotation = $quotations->first();
        // dd(request()->all());
        //[save attachments] loop through and save each attachment
        if (request()->filled('transmital_attachments')) {
            foreach (request('transmital_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'quotations',
                    'attachmentresource_id' => $quotation->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_transmital_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('technical_attachments')) {
            foreach (request('technical_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'quotations',
                    'attachmentresource_id' => $quotation->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_technical_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('financial_attachments')) {
            foreach (request('financial_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'quotations',
                    'attachmentresource_id' => $quotation->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_financial_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        /** ----------------------------------------------
         * record event [RFM deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'quotation_updated',
            'event_item_id' => '',
            'event_item_lang' => 'quotation_updated',
            'event_item_content' => $quotation->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'quotation',
            'event_parent_id' => $quotation->id,
            'event_parent_title' => $quotation->ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'quotation',
            'eventresource_id' => $quotation->id,
            'event_notification_category' => 'notifications_quotation_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($quotation->id, 'all', 'ids');
        }

        //reponse payload
        $payload = [
            'quotations' => $quotations,
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
        if (!\App\Models\Quotation::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $quotations = $this->quotationrepo->search($id);
        $quotation = $quotations->first();

        /** ----------------------------------------------
         * record event [RFM deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'quotation_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'quotation_deleted',
            'event_item_content' => $quotation->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'quotation',
            'event_parent_id' => $quotation->id,
            'event_parent_title' => $quotation->ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'quotation',
            'eventresource_id' => $quotation->id,
            'event_notification_category' => 'notifications_quotation_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($quotation->id, 'all', 'ids');
        }

        $quotation->delete();

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
                __('Quotation'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'quotations',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_control' => 'active',
            'submenu_quotations' => 'active',
            'sidepanel_id' => 'sidepanel-filter-quotations',
            'dynamic_search_url' => url('quotations/search?action=search&quotationresource_id=' . request('quotationresource_id') . '&quotationresource_type=' . request('quotationresource_type')),
            'add_button_classes' => 'add-edit-quotations-button',
            'load_more_button_route' => 'quotations',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('Add Quotation'),
            'add_modal_create_url' => url('quotations/create?quotationresource_id=' . request('quotationresource_id') . '&quotationresource_type=' . request('quotationresource_type')),
            'add_modal_action_url' => url('quotations?quotationresource_id=' . request('quotationresource_id') . '&quotationresource_type=' . request('quotationresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'quotations') {
            $page += [
                'meta_title' => __('Quotation'),
                'heading' => __('Quotation'),
                'sidepanel_id' => 'sidepanel-filter-quotation',
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
            'selector' => '#quotation_attachment_' . $attachment->attachment_id,
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

    /**
     * Show the form for changing a projects status
     * @return \Illuminate\Http\Response
     */
    public function changeStatus()
    {

        //get the quotation
        $quotation = \App\Models\Quotation::Where('id', request()->route('quotation'))->first();

        //reponse payload
        $payload = [
            'quotation' => $quotation,
        ];

        //show the form
        return new ChangeStatusResponse($payload);
    }


    /**
     * change status project status
     * @return \Illuminate\Http\Response
     */
    public function changeStatusUpdate()
    {
        //validate the project exists
        $quotation = \App\Models\Quotation::Where('id', request()->route('quotation'))->first();


        //old status
        $old_status = $quotation->status;

        //validate
        if (!in_array(request('quotation_status'), ['approved', 'rejected'])) {
            abort(409, __('lang.invalid_status'));
        }

        //update the project
        $quotation->status = request('quotation_status');
        $quotation->save();

        //get refreshed project
        $quotations = $this->quotationrepo->search(request()->route('quotation'));
        $quotation = $quotations->first();

        //reponse payload
        $payload = [
            'quotations' => $quotations,
            'id' => request()->route('quotation'),
        ];

        //show the form
        return new UpdateResponse($payload);
    }

    public function showEvent($id)
    {
        $quotation = ModelsQuotation::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'quotations')
            ->get();
        return view('pages.quotation.show-event', compact('quotation', 'attachments'));
    }
}
