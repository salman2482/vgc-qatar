<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property as AppProperty;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use App\Repositories\DestroyRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\PropertyRepository;
use App\Http\Responses\Properties\ChangeStatus;
use App\Repositories\AttachmentRepository;
use App\Http\Responses\Properties\EditResponse;
use App\Http\Responses\Properties\ShowResponse;
use App\Http\Responses\Properties\IndexResponse;
use App\Http\Responses\Properties\StoreResponse;
use App\Http\Responses\Properties\CreateResponse;
use App\Http\Responses\Properties\UpdateResponse;
use App\Http\Responses\Properties\DestroyResponse;
use App\Http\Requests\Properties\PropertyValidation;
use App\Http\Responses\Properties\ShowDynamicResponse;
use App\Models\FrontEndProperty;

class Property extends Controller
{
    /**
     * The property repository instance.
     */
    protected $propertyrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;
    public function __construct(PropertyRepository $propertyrepo, AttachmentRepository $attachmentrepo, EventRepository $eventrepo, UserRepository $userrepo)
    {
        //parent
        parent::__construct();

        $this->propertyrepo = $propertyrepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;
        $this->userrepo = $userrepo;
        //authenticated
        $this->middleware('auth');
        $this->middleware('adminCheck');

        //Permissions on methods
        $this->middleware('propertiesMiddlewareIndex');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get team properties
        $properties = $this->propertyrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('properties'),
            'properties' => $properties,
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
        $property = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'property' => $property,
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
    public function store(PropertyValidation $request)
    {
        //create the property
        if (!$property_id = $this->propertyrepo->create()) {
            return abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $properties = $this->propertyrepo->search($property_id);
        $property = $properties->first();
        //[save attachments] loop through and save each attachment
        if (request()->filled('attachments')) {
            foreach (request('attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'property',
                    'attachmentresource_id' => $property_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_property_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        //counting all rows
        $rows = $this->propertyrepo->search();
        $count = $rows->count();

        /** ----------------------------------------------
         * record event [Property created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'property_created',
            'event_item_id' => '',
            'event_item_lang' => 'property_created',
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
            'count' => $count,
            'properties' => $properties,
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
        $properties = $this->propertyrepo->search($id);
        $property = $properties->first();

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
        $properties = $this->propertyrepo->search($id);
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
        $properties = $this->propertyrepo->search($id);
        $property = $properties->first();
        //update
        if (!$this->propertyrepo->update($id)) {
            abort(409);
        }

        //get project
        $properties = $this->propertyrepo->search($id);
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
        if (!FrontEndProperty::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $properties = $this->propertyrepo->search($id);
        $property = $properties->first();


        /** ----------------------------------------------
         * record event [Property deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'property_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'property_deleted',
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

        //delete the category
        $property->delete();

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
                __('lang.properties'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'properties',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_properties' => 'active',
            'submenu_properties' => 'active',
            'sidepanel_id' => 'sidepanel-filter-properties',
            'dynamic_search_url' => url('properties/search?action=search&propertyresource_id=' . request('propertyresource_id') . '&propertyresource_type=' . request('propertyresource_type')),
            'add_button_classes' => 'add-edit-properties-button',
            'load_more_button_route' => 'properties',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_property'),
            'add_modal_create_url' => url('properties/create?propertyresource_id=' . request('propertyresource_id') . '&propertyresource_type=' . request('propertyresource_type')),
            'add_modal_action_url' => url('properties?propertyresource_id=' . request('propertyresource_id') . '&propertyresource_type=' . request('propertyresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'properties') {
            $page += [
                'meta_title' => __('lang.properties'),
                'heading' => __('lang.properties'),
                'sidepanel_id' => 'sidepanel-filter-properties',
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
     * Display the specified project
     * @param int $id project id
     * @return \Illuminate\Http\Response
     */
    public function showDynamic($id)
    {

        //get the project
        $properties = $this->projectrepo->search($id);

        //project
        $property = $properties->first();

        $page = $this->pageSettings('properties', $property);

        //apply permissions
        // $this->applyPermissions($project);

        //set dynamic url for use in template
        switch (request()->segment(3)) {
            case 'properties':
            case 'files':
            case 'invoices':
            case 'expenses':
            case 'payments':
            case 'timesheets':
            case 'notes':
            case 'tickets':
            case 'milestones':
            case 'tasks':
                $sections = request()->segment(3);
                $section = rtrim($sections, 's');
                $page['dynamic_url'] = url($sections . '?source=ext&' . $section . 'resource_type=project&' . $section . 'resource_id=' . $property->id);
                break;
            case 'details':
                $page['dynamic_url'] = url('properties/' . $property->id . '/properties-details');
                break;
            default:
                $page['dynamic_url'] = url('properties?source=ext&commentresource_type=project&commentresource_id=' . $property->id);
                break;
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'project' => $property,
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
            'selector' => '#property_attachment_' . $attachment->attachment_id,
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
        $property = AppProperty::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'property')
            ->get();
        return view('pages.property.show-event', compact('property', 'attachments'));
    }

    public function changeStatus($id)
    {
        $properties = $this->propertyrepo->search($id);
        $property = $properties->first();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'property' => $property,
        ];
        return new ChangeStatus($payload);
    }

    /**
     * change status project status
     * @return \Illuminate\Http\Response
     */
    public function changeStatusUpdate()
    {

        //validate the project exists
        $property = \App\Models\FrontEndProperty::Where('id', request()->route('id'))->first();

        //update the project
        $property->is_approved = request('property_status');
        $property->save();

        //get refreshed project
        $properties = $this->propertyrepo->search(request()->route('id'));
        $property = $properties->first();

        //reponse payload
        $payload = [
            'properties' => $properties,
        ];

        //show the form
        return new UpdateResponse($payload);
    }
}
