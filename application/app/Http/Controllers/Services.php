<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ServiceRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AttachmentRepository;
use App\Http\Responses\Services\EditResponse;
use App\Http\Responses\Services\ShowResponse;
use App\Http\Responses\Services\IndexResponse;
use App\Http\Responses\Services\StoreResponse;
use App\Http\Responses\Services\CreateResponse;
use App\Http\Responses\Services\UpdateResponse;
use App\Http\Responses\Services\DestroyResponse;

class Services extends Controller
{
    protected $servicerepo;

    public function __construct(ServiceRepository $servicerepo, AttachmentRepository $attachmentrepo)
    {
        //parent
        parent::__construct();

        $this->servicerepo = $servicerepo;
        $this->attachmentrepo = $attachmentrepo;

        //authenticated
        $this->middleware('auth');
        //Permissions on methods
        $this->middleware('servicessMiddlewareIndex');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //get team quotations
        $services = $this->servicerepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('services'),
            'services' => $services,
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
        $page = 'create';
        return view('pages.service.create-service.wrapper',compact('page'));
        
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
            'service_title' => [
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
        if (!$service_id = $this->servicerepo->create()) {
            return abort(419);
        }

        $services = $this->servicerepo->search($service_id);
        $service = $services->first();

        //counting rows
        $rows = $this->servicerepo->search();
        $count = $rows->total();



        //reponse payload
        $payload = [
            'count' => $count,
            'services' => $services,
        ];

        //process reponse
        // return new StoreResponse($payload);
        return redirect()->route('services.index')->with('success','Service Added Successfully');
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
        $services = $this->servicerepo->search($id);
        $service = $services->first();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'services')
            ->get();

        //reponse payload
        $payload = [
            'service' => $service,
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
        $services = $this->servicerepo->search($id);
        $service = $services->first();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'services')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'service' => $service,
            'attachments' => $attachments,
        ];
        // return new EditResponse($payload);
        return view('pages.service.create-service.wrapper',compact('payload'));
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
        $services = $this->servicerepo->search($id);
        $service = $services->first();
        //update
        if (!$this->servicerepo->update($id)) {
            abort(409);
        }
        //get project
        $services = $this->servicerepo->search($id);
        $service = $services->first();

        //reponse payload
        $payload = [
            'services' => $services,
            'id' => $id,
        ];

        //generate a response
        return redirect()->route('services.index')->with('success','Service updated Succesfully');
        // return new UpdateResponse($payload);
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
        if (!\App\Models\Service::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $services = $this->servicerepo->search($id);
        $service = $services->first();

        $service->delete();

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
                __('Service'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'services',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_bookings' => 'active',
            'submenu_services' => 'active',
            'sidepanel_id' => 'sidepanel-filter-services',
            'dynamic_search_url' => url('services/search?action=search&serviceresource_id=' . request('serviceresource_id') . '&serviceresource_type=' . request('serviceresource_type')),
            'add_button_classes' => 'add-edit-services-button',
            'load_more_button_route' => 'services',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('Add Service'),
            'add_modal_create_url' => url('services/create?serviceresource_id=' . request('serviceresource_id') . '&serviceresource_type=' . request('serviceresource_type')),
            'add_modal_action_url' => url('services?serviceresource_id=' . request('serviceresource_id') . '&serviceresource_type=' . request('serviceresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'services') {
            $page += [
                'meta_title' => __('Service'),
                'heading' => __('Service'),
                'sidepanel_id' => 'sidepanel-filter-service',
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
            'selector' => '#service_attachment_' . $attachment->attachment_id,
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
}
