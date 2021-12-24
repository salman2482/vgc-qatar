<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\EventRepository;
use App\Repositories\DestroyRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\AttachmentRepository;
use App\Repositories\GovtDocumentRepository;
use App\Http\Responses\GovtDocuments\EditResponse;
use App\Http\Responses\GovtDocuments\ShowResponse;
use App\Http\Responses\GovtDocuments\IndexResponse;
use App\Http\Responses\GovtDocuments\StoreResponse;
use App\Http\Responses\GovtDocuments\CreateResponse;
use App\Http\Responses\GovtDocuments\UpdateResponse;
use App\Http\Responses\GovtDocuments\DestroyResponse;
use App\Http\Responses\GovtDocuments\AttachDettachResponse;
use App\Http\Requests\GovtDocuments\GovtDocumentsValidation;
use App\Models\GovtDocument;

class GovtDocuments extends Controller
{
     /**
     * The govtdocuments repository instance.
     */
    protected $govtdocumentrepo;
    protected $attachmentrepo;
    protected $eventrepo;


    public function __construct(AttachmentRepository $attachmentrepo, GovtDocumentRepository $govtdocumentrepo,EventRepository $eventrepo) {
        //parent
        parent::__construct();

        $this->govtdocumentrepo = $govtdocumentrepo;
        $this->eventrepo = $eventrepo;
        $this->attachmentrepo = $attachmentrepo;

          //authenticated
          $this->middleware('auth');
          //Permissions on methods
        $this->middleware('documentsMiddlewareIndex')->only([
            'index',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //get team govtdocuments
         $govtdocuments = $this->govtdocumentrepo->search();

         
         //reponse payload
         $payload = [
             'page' => $this->pageSettings('govtdocuments'),
             'govtdocuments' => $govtdocuments,
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
        $govtdocument = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'govtdocument' => $govtdocument,
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
    public function store(GovtDocumentsValidation $request)
    {
        // return $request;
         //create the govtdocument
         if (!$govtdocument_id = $this->govtdocumentrepo->create()) {
            abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $govtdocuments = $this->govtdocumentrepo->search($govtdocument_id);        
        $govtdocument = $govtdocuments->first();

        //[save attachments] loop through and save each attachment
        if (request()->filled('document_attachments')) {
            foreach (request('document_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('govtdocument_clientid'),
                    'attachmentresource_type' => 'govtdocument',
                    'attachmentresource_id' => $govtdocument_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_document'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('lrc_attachments')) {
            foreach (request('lrc_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('govtdocument_clientid'),
                    'attachmentresource_type' => 'govtdocument',
                    'attachmentresource_id' => $govtdocument_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_lrc'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
         //counting all rows
        $rows = $this->govtdocumentrepo->search();
        $count = $rows->count();

        /** ----------------------------------------------
         * record event [govtdocument created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'govtdocument_created',
            'event_item_id' => '',
            'event_item_lang' => 'govtdocument_created',
            'event_item_content' => $govtdocument->type_of_document,
            'event_item_content2' => '',
            'event_parent_type' => 'govtdocument',
            'event_parent_id' => $govtdocument->id,
            'event_parent_title' => $govtdocument->type_of_document ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'govtdocument',
            'eventresource_id' => $govtdocument->id,
            'event_notification_category' => 'notifications_govtdocument_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            
        }




        //reponse payload
        $payload = [
            'count' => $count,
            'govtdocuments' => $govtdocuments,
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
        $govtdocuments = $this->govtdocumentrepo->search($id);
        $govtdocument = $govtdocuments->first();

        // return $govtdocument;
        // dd();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'govtdocument')
            ->get();

        //reponse payload
        $payload = [
            'govtdocument' => $govtdocument,
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
        $govtdocuments = $this->govtdocumentrepo->search($id);
        $govtdocument = $govtdocuments->first();

        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'govtdocument')
            ->get();

       
         //reponse payload
         $payload = [
            'attachments' => $attachments,
            'page' => $this->pageSettings('edit'),
            'govtdocument' => $govtdocument,
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
    public function update(GovtDocumentsValidation $request, $id)
    {   
        //get govtdocument
        $govtdocuments = $this->govtdocumentrepo->search($id);
        $govtdocument = $govtdocuments->first();
        //update
        if (!$this->govtdocumentrepo->update($id)) {
            abort(409);
        }

        //get govtdocument
        $govtdocuments = $this->govtdocumentrepo->search($id);
        $govtdocument = $govtdocuments->first();

        //[save attachments] loop through and save each attachment

        if (request()->filled('document_attachments')) {
            foreach (request('document_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('govtdocument_clientid'),
                    'attachmentresource_type' => 'govtdocument',
                    'attachmentresource_id' => $govtdocument->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_document'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('lrc_attachments')) {
            foreach (request('lrc_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('govtdocument_clientid'),
                    'attachmentresource_type' => 'govtdocument',
                    'attachmentresource_id' => $govtdocument->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_lrc'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        /** ----------------------------------------------
         * record event [govtdocument updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'govtdocument_updated',
            'event_item_id' => '',
            'event_item_lang' => 'govtdocument_updated',
            'event_item_content' => $govtdocument->type_of_document,
            'event_item_content2' => '',
            'event_parent_type' => 'govtdocument',
            'event_parent_id' => $govtdocument->id,
            'event_parent_title' => $govtdocument->type_of_document ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'govtdocument',
            'eventresource_id' => $govtdocument->id,
            'event_notification_category' => 'notifications_govtdocument_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            

        }


          //reponse payload
        $payload = [
            'govtdocuments' => $govtdocuments,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

     /**
     * Remove the specified govtdocument from storage.
     * @param object DestroyRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //delete each record in the array
      //get record
      if (!\App\Models\GovtDocument::find($id)) {
        abort(409, __('lang.error_request_could_not_be_completed'));
    }

    //get it in useful format
    $govtdocuments = $this->govtdocumentrepo->search($id);
    $govtdocument = $govtdocuments->first();
    
    //delete attachemnts
    if ($attachments = $govtdocument->attachments()->get()) {
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
         * record event [govtdocument deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'govtdocument_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'govtdocument_deleted',
            'event_item_content' => $govtdocument->type_of_document,
            'event_item_content2' => '',
            'event_parent_type' => 'govtdocument',
            'event_parent_id' => $govtdocument->id,
            'event_parent_title' => $govtdocument->type_of_document ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'govtdocument',
            'eventresource_id' => $govtdocument->id,
            'event_notification_category' => 'notifications_govtdocument_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            
        }

    //delete the category
    $govtdocument->delete();


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
                __('lang.govtdocuments'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'govtdocuments',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_control' => 'active',
            'submenu_govtdocuments' => 'active',
            'sidepanel_id' => 'sidepanel-filter-govtdocuments',
            'dynamic_search_url' => url('govtdocuments/search?action=search&govtdocumentresource_id=' . request('govtdocumentresource_id') . '&govtdocumentresource_type=' . request('govtdocumentresource_type')),
            'add_button_classes' => 'add-edit-govtdocuments-button',
            'load_more_button_route' => 'govtdocuments',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_govtdocument'),
            'add_modal_create_url' => url('govtdocuments/create?govtdocumentresource_id=' . request('govtdocumentresource_id') . '&govtdocumentresource_type=' . request('govtdocumentresource_type')),
            'add_modal_action_url' => url('govtdocuments?govtdocumentresource_id=' . request('govtdocumentresource_id') . '&govtdocumentresource_type=' . request('govtdocumentresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //govtdocuments list page
        if ($section == 'govtdocuments') {
            $page += [
                'meta_title' => __('lang.govtdocuments'),
                'heading' => __('lang.govtdocuments'),
                'sidepanel_id' => 'sidepanel-filter-govtdocuments',
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




    public function downloadAttachment() {

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
     * show attach/dettach govtdocument form
     * @return \Illuminate\Http\Response
     */
    public function attachDettach() {

        $govtdocument = \App\Models\GovtDocument::Where('govtdocument_id', request('id'))->first();

        //reponse payload
        $payload = [
            'govtdocument' => $govtdocument,
        ];

        //show the form
        return new AttachDettachResponse($payload);
    }


    /**
     * download an govtdocument attachment
     * @param int $id govtdocument id
     * @return \Illuminate\Http\Response
     */
    public function deleteAttachment() {

        // return 'hi';
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

    public function showEvent($id)
    {
        $govtdocument = GovtDocument::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'govtdocument')
            ->get();
        return view('pages.govtdocument.show-event',compact('govtdocument','attachments'));
    }
}
