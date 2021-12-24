<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Repositories\LpoRepository;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Http\Responses\Lpos\EditResponse;
use App\Http\Responses\Lpos\ShowResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Lpos\IndexResponse;
use App\Http\Responses\Lpos\StoreResponse;
use App\Repositories\AttachmentRepository;
use App\Http\Responses\Lpos\CreateResponse;
use App\Http\Responses\Lpos\RfmPDFResponse;
use App\Http\Responses\Lpos\UpdateResponse;
use App\Http\Responses\Lpos\DestroyResponse;
use App\Models\LpoMgt;

class Lpo extends Controller
{
    protected $lporepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    public function __construct(LpoRepository $lporepo, AttachmentRepository $attachmentrepo, EventRepository $eventrepo, UserRepository $userrepo)
    {
        //parent
        parent::__construct();

        $this->lporepo = $lporepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;
        $this->userrepo = $userrepo;
        //authenticated
        $this->middleware('auth');
        //Permissions on methods
        $this->middleware('lposMiddlewareIndex');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get team lpo
        $lpos = $this->lporepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('lpos'),
            'lpos' => $lpos,
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
        $lpo = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'lpo' => $lpo,
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
            'department' => [
                'required',
            ],
            'subject' => [
                'required',
            ],
            'site' => [
                'required',
            ],
            'remarks' => [
                'required',
            ],
            'value' => [
                'required',
            ],
            'requestor' => [
                'required',
            ],
            'date_requested' => [
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






        //save the lpo first
        if (!$lpo_id = $this->lporepo->create()) {
            return abort(419);
        }

        $lpos = $this->lporepo->search($lpo_id);
        //[save attachments] loop through and save each attachment
        if (request()->filled('lpo_lpo_attachments')) {
            foreach (request('lpo_lpo_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'lpos',
                    'attachmentresource_id' => $lpo_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_lpo_lpo_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('lpo_rfm_attachments')) {
            foreach (request('lpo_rfm_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'lpos',
                    'attachmentresource_id' => $lpo_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_lpo_rfm_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        //counting rows
        $rows = $this->lporepo->search();
        $count = $rows->total();
        //reponse payload
        $payload = [
            'count' => $count,
            'lpos' => $lpos,
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
        //get the lpo
        $lpos = $this->lporepo->search($id);
        $lpo = $lpos->first();

        //get attachments
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $lpo->supervisor_id)
            ->Where('attachmentresource_type', 'client')
            ->get();

        //reponse payload
        $payload = [
            'lpo' => $lpo,
            'attachments' => $attachments,
        ];
        if (request()->segment(3) == 'pdf') {
            //render view
            /** ----------------------------------------------
             * record event [rfm updated]
             * ----------------------------------------------*/
            $data = [
                'event_creatorid' => auth()->id(),
                'event_item' => 'po_downloaded',
                'event_item_id' => '',
                'event_item_lang' => 'po_downloaded',
                'event_item_content' => $lpo->ref_no,
                'event_item_content2' => '',
                'event_parent_type' => 'lpo',
                'event_parent_id' => $lpo->id,
                'event_parent_title' => 'PO Attachment Downloaded',
                'event_show_item' => 'yes',
                'event_show_in_timeline' => 'yes',
                'event_clientid' => auth()->id(),
                'eventresource_type' => 'lpo',
                'eventresource_id' => $lpo->id,
                'event_notification_category' => 'notifications_lpos_activity',
            ];
            //record event
            if ($event_id = $this->eventrepo->create($data)) {
                //get users
                // $users = $this->userrepo->getClientUsers($rfm->id, 'all', 'ids');
            }

            return new RfmPDFResponse($payload);
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
        $lpos = $this->lporepo->search($id);
        $lpo = $lpos->first();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'lpos')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'lpo' => $lpo,
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
        //get lpo
        $lpos = $this->lporepo->search($id);
        $lpo = $lpos->first();
        //update
        if (!$this->lporepo->update($id)) {
            abort(409);
        }
        //get lpo
        $lpos = $this->lporepo->search($id);
        $lpo = $lpos->first();
        //[save attachments] loop through and save each attachment
        if (request()->filled('lpo_lpo_attachments')) {
            foreach (request('lpo_lpo_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'lpos',
                    'attachmentresource_id' => $lpo->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_lpo_lpo_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('lpo_rfm_attachments')) {
            foreach (request('lpo_rfm_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'lpos',
                    'attachmentresource_id' => $lpo->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_lpo_rfm_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        /** ----------------------------------------------
         * record event [rfm updated]
         * ----------------------------------------------*/
        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'po_updated',
            'event_item_id' => '',
            'event_item_lang' => 'event_po_updated',
            'event_item_content' => $lpo->ref_num,
            'event_item_content2' => '',
            'event_parent_type' => 'lpo',
            'event_parent_id' => $lpo->id,
            'event_parent_title' => $lpo->site ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'lpo',
            'eventresource_id' => $lpo->id,
            'event_notification_category' => 'notifications_lpos_activity',
        ];
        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($lpo->id, 'all', 'ids');
        }
        //reponse payload
        $payload = [
            'lpos' => $lpos,
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
        if (!\App\Models\LpoMgt::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $lpos = $this->lporepo->search($id);
        $lpo = $lpos->first();

        /** ----------------------------------------------
         * record event [lpo deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'po_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'po_deleted',
            'event_item_content' => $lpo->ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'lpo',
            'event_parent_id' => $lpo->id,
            'event_parent_title' => $lpo->ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'lpo',
            'eventresource_id' => $lpo->id,
            'event_notification_category' => 'notifications_lpo_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($lpo->id, 'all', 'ids');
        }

        $lpo->delete();

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
                __('PO'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'lpos',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_RFM' => 'active',
            'submenu_lpos' => 'active',
            'sidepanel_id' => 'sidepanel-filter-lpos',
            'dynamic_search_url' => url('lpos/search?action=search&lporesource_id=' . request('lporesource_id') . '&lporesource_type=' . request('lporesource_type')),
            'add_button_classes' => 'add-edit-lpos-button',
            'load_more_button_route' => 'PO',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('Add PO'),
            'add_modal_create_url' => url('lpos/create?lporesource_id=' . request('lporesource_id') . '&lporesource_type=' . request('lporesource_type')),
            'add_modal_action_url' => url('lpos?lporesource_id=' . request('lporesource_id') . '&lporesource_type=' . request('lporesource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];
        if ($section == 'invoices') {
            $page += [
                'meta_title' => __('lang.invoices'),
                'heading' => __('lang.invoices'),
                'sidepanel_id' => 'sidepanel-filter-invoices',
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }
        //lpos list page
        if ($section == 'lpos') {
            $page += [
                'meta_title' => __('PO'),
                'heading' => __('PO'),
                'sidepanel_id' => 'sidepanel-filter-lpo',
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
            'selector' => '#lpo_attachment_' . $attachment->attachment_id,
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
        $lpo = LpoMgt::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'lpos')
            ->get();
        return view('pages.lpo.show-event', compact('lpo', 'attachments'));
    }
}
