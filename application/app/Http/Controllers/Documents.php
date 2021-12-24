<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DocumentManagment;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\DocumentRepository;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AttachmentRepository;
use App\Http\Responses\Documents\EditResponse;
use App\Http\Responses\Documents\ShowResponse;
use App\Http\Responses\Documents\IndexResponse;
use App\Http\Responses\Documents\StoreResponse;
use App\Http\Responses\Documents\CreateResponse;
use App\Http\Responses\Documents\UpdateResponse;
use App\Http\Responses\Documents\DestroyResponse;

class Documents extends Controller
{

    /**
     * The document repository instance.
     */
    protected $documentrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    public function __construct(DocumentRepository $documentrepo, AttachmentRepository $attachmentrepo, EventRepository $eventrepo, UserRepository $userrepo)
    {
        //parent
        parent::__construct();

        $this->documentrepo = $documentrepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;
        $this->userrepo = $userrepo;
        //authenticated
        $this->middleware('auth');
        //Permissions on methods
        $this->middleware('documentsMiddlewareIndex');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get documents
        $documents = $this->documentrepo->search();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('documents'),
            'documents' => $documents,
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
        $document = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'document' => $document,
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
            'document_subject' => [
                'required',
            ],
            'document_issue_date' => [
                'required',
            ],
            'document_delivery_date' => [
                'required',
            ],
            'document_delivery_method' => [
                'required',
            ],
            'document_expiration' => [
                'required',
            ],
            //   'document_submital_copy' => [
            //       'required',
            //   ],
            //   'document_document_copy' => [
            //       'required',
            //   ],


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


        if (!$document_id = $this->documentrepo->create()) {
            abort(409);
        }

        $documents = $this->documentrepo->search($document_id);
        $document = $documents->first();

        //counting all rows
        $rows = $this->documentrepo->search();
        $count = $rows->count();


        // save attachments
        if (request()->filled('submital_attachments')) {
            foreach (request('submital_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'documentmgt',
                    'attachmentresource_id' => $document_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_submital_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('document_attachments')) {
            foreach (request('document_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'documentmgt',
                    'attachmentresource_id' => $document_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_document'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        /** ----------------------------------------------
         * record event [document created]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'document_created',
            'event_item_id' => '',
            'event_item_lang' => 'document_created',
            'event_item_content' => $document->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'document',
            'event_parent_id' => $document->id,
            'event_parent_title' => $document->subject ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'document',
            'eventresource_id' => $document->id,
            'event_notification_category' => 'notifications_documents_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            // $users = $this->userrepo->getClientUsers($document->id, 'all', 'ids');
            // //record notification
            // $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'documents' => $documents,
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
        $documents = $this->documentrepo->search($id);
        $document = $documents->first();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'documentmgt')
            ->get();

        //reponse payload
        $payload = [
            'document' => $document,
            'attachments' => $attachments,
        ];


        /** ----------------------------------------------
         * record event [document created]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'document_viewed',
            'event_item_id' => '',
            'event_item_lang' => 'document_viewed',
            'event_item_content' => $document->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'document',
            'event_parent_id' => $document->id,
            'event_parent_title' => $document->subject ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'document',
            'eventresource_id' => $document->id,
            'event_notification_category' => 'notifications_documents_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($document->id, 'all', 'ids');
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
        $documents = $this->documentrepo->search($id);
        $document = $documents->first();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'documentmgt')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'document' => $document,
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
        //get documents
        $documents = $this->documentrepo->search($id);
        $document = $documents->first();
        //update
        if (!$this->documentrepo->update($id)) {
            abort(409);
        }

        //get documents
        $documents = $this->documentrepo->search($id);
        $property = $documents->first();

        // save attachments
        if (request()->filled('submital_attachments')) {
            foreach (request('submital_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'documentmgt',
                    'attachmentresource_id' => $document->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_submital_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('document_attachments')) {
            foreach (request('document_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'documentmgt',
                    'attachmentresource_id' => $document->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_document'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }


        /** ----------------------------------------------
         * record event [document updated]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'document_updated',
            'event_item_id' => '',
            'event_item_lang' => 'document_updated',
            'event_item_content' => $document->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'document',
            'event_parent_id' => $document->id,
            'event_parent_title' => $document->subject ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'document',
            'eventresource_id' => $document->id,
            'event_notification_category' => 'notifications_documents_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($document->id, 'all', 'ids');
            // //record notification
            // $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
        }

        //reponse payload
        $payload = [
            'documents' => $documents,
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
        if (!\App\Models\DocumentManagment::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $documents = $this->documentrepo->search($id);
        $document = $documents->first();


        /** ----------------------------------------------
         * record event [document deleted]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'document_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'document_deleted',
            'event_item_content' => $document->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'document',
            'event_parent_id' => $document->id,
            'event_parent_title' => $document->site ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'document',
            'eventresource_id' => $document->id,
            'event_notification_category' => 'notifications_documents_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($document->id, 'all', 'ids');
            // //record notification
            // $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);
        }
        //delete the category
        $document->delete();

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
                __('lang.documents'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'documents',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_control' => 'active',
            'submenu_documents' => 'active',
            'sidepanel_id' => 'sidepanel-filter-documents',
            'dynamic_search_url' => url('documents/search?action=search&documentresource_id=' . request('documentresource_id') . '&documentresource_type=' . request('documentresource_type')),
            'add_button_classes' => 'add-edit-documents-button',
            'load_more_button_route' => 'documents',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_document'),
            'add_modal_create_url' => url('documents/create?documentresource_id=' . request('documentresource_id') . '&documentresource_type=' . request('documentresource_type')),
            'add_modal_action_url' => url('documents?documentresource_id=' . request('documentresource_id') . '&documentresource_type=' . request('documentresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'documents') {
            $page += [
                'meta_title' => __('lang.documents'),
                'heading' => __('lang.documents'),
                'sidepanel_id' => 'sidepanel-filter-documents',
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //project page
        // if ($section == 'document') {
        //     //adjust
        //     $page['page'] = 'document';

        //     //crumbs
        //     $page['crumbs'] = [
        //         __('lang.document'),
        //         '#' . $data->id,
        //     ];

        //     //add
        //     $page += [
        //         'crumbs_special_class' => 'main-pages-crumbs',
        //         'meta_title' => __('lang.documents') . ' - ' . $data->title,
        //         'heading' => $data->title,
        //         'id' => request()->segment(2),
        //         'source_for_filter_panels' => 'ext',
        //         'section' => 'overview',
        //     ];
        //     //ajax loading and tabs
        //     return $page;
        // }

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
            'selector' => '#document_attachment_' . $attachment->attachment_id,
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
            'event_item' => 'document_downloaded',
            'event_item_id' => '',
            'event_item_lang' => 'document_downloaded',
            'event_item_content' => 'Document Downloaded',
            'event_item_content2' => '',
            'event_parent_type' => 'document',
            'event_parent_id' => $attachment->attachmentresource_id,
            'event_parent_title' => 'Document Downloaded',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'document',
            'eventresource_id' => $attachment->id,
            'event_notification_category' => 'notifications_documents_activity',
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
        $contract = DocumentManagment::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'documentmgt')
            ->get();

        return view('pages.document.show-event', compact('contract', 'attachments'));
    }
}
