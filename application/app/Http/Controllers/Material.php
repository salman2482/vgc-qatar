<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\MaterialRepository;
use App\Repositories\AttachmentRepository;
use App\Http\Responses\Materials\EditResponse;
use App\Http\Responses\Materials\IndexResponse;
use App\Http\Responses\Materials\StoreResponse;
use App\Http\Responses\Materials\CreateResponse;
use App\Http\Responses\Materials\UpdateResponse;
use App\Http\Responses\Materials\DestroyResponse;
use App\Models\Material as ModelsMaterial;

class Material extends Controller
{
    /**
     * The material repository instance.
     */
    protected $materialrepo;
    protected $attachmentrepo;
    protected $eventrepo;
    protected $userrepo;

    public function __construct(MaterialRepository $materialrepo,AttachmentRepository $attachmentrepo,EventRepository $eventrepo,UserRepository $userrepo)
    {
        //parent
        parent::__construct();

        $this->materialrepo = $materialrepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->eventrepo = $eventrepo;
        $this->userrepo = $userrepo;
        //authenticated
        $this->middleware('auth');
        //Permissions on methods
        $this->middleware('materialsMiddleware');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //get team materials
         $materials = $this->materialrepo->search();

         //reponse payload
         $payload = [
             'page' => $this->pageSettings('materials'),
             'materials' => $materials,
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
        $material = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'material' => $material,
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
         //create the property
         if (!$material_id = $this->materialrepo->create()) {
            abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $materials = $this->materialrepo->search($material_id);
        $material = $materials->first();
        if (request()->filled('material_image_attachment')) {
            foreach (request('material_image_attachment') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'materials',
                    'attachmentresource_id' => $material_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_material'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        //counting all rows
        $rows = $this->materialrepo->search();
        $count = $rows->count();

         /** ----------------------------------------------
         * record event [material created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'material_created',
            'event_item_id' => '',
            'event_item_lang' => 'material_created',
            'event_item_content' => $material->title,
            'event_item_content2' => '',
            'event_parent_type' => 'material',
            'event_parent_id' => $material->id,
            'event_parent_title' => $material->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'material',
            'eventresource_id' => $material->id,
            'event_notification_category' => 'notifications_material_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($material->id, 'all', 'ids');

        }

        //reponse payload
        $payload = [
            'count' => $count,
            'materials' => $materials,
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materials = $this->materialrepo->search($id);
        $material = $materials->first();
          //get attachment
          $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
          ->Where('attachmentresource_type', 'materials')
          ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'material' => $material,
            'attachments' => $attachments
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
           $materials = $this->materialrepo->search($id);
           $material = $materials->first();
           //update
           if (!$this->materialrepo->update($id)) {
               abort(409);
           }

           //get project
           $materials = $this->materialrepo->search($id);
           $material = $materials->first();
           if (request()->filled('material_image_attachment')) {
            foreach (request('material_image_attachment') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'materials',
                    'attachmentresource_id' => $material->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_material'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }


         /** ----------------------------------------------
         * record event [material updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'material_updated',
            'event_item_id' => '',
            'event_item_lang' => 'material_updated',
            'event_item_content' => $material->title,
            'event_item_content2' => '',
            'event_parent_type' => 'material',
            'event_parent_id' => $material->id,
            'event_parent_title' => $material->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'material',
            'eventresource_id' => $material->id,
            'event_notification_category' => 'notifications_material_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($material->id, 'all', 'ids');

        }
           //reponse payload
           $payload = [
               'materials' => $materials,
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
        if (!\App\Models\Material::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $materials = $this->materialrepo->search($id);
        $material = $materials->first();

         /** ----------------------------------------------
         * record event [material deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'material_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'material_deleted',
            'event_item_content' => $material->title,
            'event_item_content2' => '',
            'event_parent_type' => 'material',
            'event_parent_id' => $material->id,
            'event_parent_title' => $material->title ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'material',
            'eventresource_id' => $material->id,
            'event_notification_category' => 'notifications_material_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            $users = $this->userrepo->getClientUsers($material->id, 'all', 'ids');

        }
        //delete the category
        $material->delete();

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
                __('Materials'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'materials',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_materials' => 'active',
            'sidepanel_id' => 'sidepanel-filter-materials',
            'dynamic_search_url' => url('materials/search?action=search&materialresource_id=' . request('materialresource_id') . '&materialresource_type=' . request('materialresource_type')),
            'add_button_classes' => 'add-edit-materials-button',
            'load_more_button_route' => 'materials',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('Add Material'),
            'add_modal_create_url' => url('materials/create?materialresource_id=' . request('materialresource_id') . '&materialresource_type=' . request('materialresource_type')),
            'add_modal_action_url' => url('materials?materialresource_id=' . request('materialresource_id') . '&materialresource_type=' . request('materialresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'materials') {
            $page += [
                'meta_title' => __('Materials'),
                'heading' => __('Materials'),
                'sidepanel_id' => 'sidepanel-filter-materials',
            ];
            if (request('source') == 'ext') {
                $page += [
                    'list_page_actions_size' => 'col-lg-12',
                ];
            }
            return $page;
        }

        //project page
        // if ($section == 'material') {
        //     //adjust
        //     $page['page'] = 'material';

        //     //crumbs
        //     $page['crumbs'] = [
        //         __('lang.material'),
        //         '#' . $data->id,
        //     ];

        //     //add
        //     $page += [
        //         'crumbs_special_class' => 'main-pages-crumbs',
        //         'meta_title' => __('Materials') . ' - ' . $data->title,
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
              'selector' => '#material_attachment_' . $attachment->attachment_id,
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
        $material = ModelsMaterial::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'materials')
            ->get();
        return view('pages.material.show-event',compact('material','attachments'));
    }
}
