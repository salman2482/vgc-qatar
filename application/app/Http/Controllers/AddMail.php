<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\MailListRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\MailLists\IndexResponse;
use App\Http\Responses\MailLists\StoreResponse;
use App\Http\Responses\MailLists\CreateResponse;
use App\Http\Responses\MailLists\DestroyResponse;
use App\Models\EmailList;

class AddMail extends Controller
{
    /**
     * The property repository instance.
     */
    protected $mailrepo;
    public function __construct(MailListRepository $mailrepo)
    {
        //parent
        parent::__construct();

        $this->mailrepo = $mailrepo;
        //authenticated
        $this->middleware('auth');
        $this->middleware('adminCheck');

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
        //get team properties
        $mails = $this->mailrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('mailist'),
            'mails' => $mails,
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
        $mail = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'mail' => $mail,
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

        $validator = Validator::make(request()->all(), [
            'email' => [
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
        //create the property
        if (!$mail_id = $this->mailrepo->create()) {
            return abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $mails = $this->mailrepo->search($mail_id);
        $mail = $mails->first();

        $rows = $this->mailrepo->search();
        $count = $rows->count();

        //reponse payload
        $payload = [
            'count' => $count,
            'mails' => $mails,
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
        $properties = $this->mailrepo->search($id);
        $property = $properties->first();


        //get attachment
        // $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
        //     ->Where('attachmentresource_type', 'contractmgt')
        //     ->get();

        //reponse payload
        $payload = [
            'property' => $property,
            // 'attachments' => $attachments,
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
        $properties = $this->mailrepo->search($id);
        $property = $properties->first();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'property')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'property' => $property,
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
    public function update(PropertyValidation $request, $id)
    {
        //get project
        $properties = $this->mailrepo->search($id);
        $property = $properties->first();
        //update
        if (!$this->mailrepo->update($id)) {
            abort(409);
        }

        //get project
        $properties = $this->mailrepo->search($id);
        $property = $properties->first();
        if (request()->filled('attachments')) {
            foreach (request('attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'property',
                    'attachmentresource_id' => $property->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_property_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        /** ----------------------------------------------
         * record event [Property updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'property_updated',
            'event_item_id' => '',
            'event_item_lang' => 'property_updated',
            'event_item_content' => $property->title,
            'event_item_content2' => '',
            'event_parent_type' => 'property',
            'event_parent_id' => $property->id,
            'event_parent_title' => $property->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'property',
            'eventresource_id' => $property->id,
            'event_notification_category' => 'notifications_property_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($property->id, 'all', 'ids');
        }

        //reponse payload
        $payload = [
            'properties' => $properties,
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
        if (!EmailList::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $mails = $this->mailrepo->search($id);
        $mail = $mails->first();

        //delete the category
        $mail->delete();

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
                __('Mails List'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'mails',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_settings' => 'active',
            'submenu_addmails' => 'active',
            'sidepanel_id' => 'sidepanel-filter-mails',
            'dynamic_search_url' => url('mails/search?action=search&mailresource_id=' . request('mailresource_id') . '&mailresource_type=' . request('mailresource_type')),
            'add_button_classes' => 'add-edit-mails-button',
            'load_more_button_route' => 'mails',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('Add Email'),
            'add_modal_create_url' => url('mails/create?mailresource_id=' . request('mailresource_id') . '&mailresource_type=' . request('mailresource_type')),
            'add_modal_action_url' => url('mails?mailresource_id=' . request('mailresource_id') . '&mailresource_type=' . request('mailresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'mailist') {
            $page += [
                'meta_title' => __('Mails List'),
                'heading' => __('Mails List'),
                'sidepanel_id' => 'sidepanel-filter-properties',
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //project page
        // if ($section == 'property') {
        //     //adjust
        //     $page['page'] = 'property';

        //     //crumbs
        //     $page['crumbs'] = [
        //         __('lang.property'),
        //         '#' . $data->id,
        //     ];

        //     //add
        //     $page += [
        //         'crumbs_special_class' => 'main-pages-crumbs',
        //         'meta_title' => __('lang.properties') . ' - ' . $data->title,
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
}
