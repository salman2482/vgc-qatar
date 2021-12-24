<?php

namespace App\Http\Controllers;

use App\Models\SubProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\EventRepository;
use App\Repositories\DestroyRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\FproductRepository;
use App\Repositories\AttachmentRepository;
use App\Http\Responses\Fproducts\EditResponse;
use App\Http\Responses\Fproducts\ShowResponse;
use App\Http\Responses\Fproducts\IndexResponse;
use App\Http\Responses\Fproducts\StoreResponse;
use App\Http\Responses\Fproducts\CreateResponse;
use App\Http\Responses\Fproducts\UpdateResponse;
use App\Http\Responses\Fproducts\DestroyResponse;
use App\Http\Requests\Fproducts\FproductValidation;
use App\Http\Responses\Fproducts\ShowDynamicResponse;

class Fproduct extends Controller
{
    /**
     * The fproduct repository instance.
     */
    protected $fproductrepo;
    protected $attachmentrepo;
    protected $subproduct;
    protected $eventrepo;

    public function __construct(FproductRepository $fproductrepo, AttachmentRepository $attachmentrepo, SubProducts
    $subproduct, EventRepository $eventrepo)
    {
        //parent
        parent::__construct();

        $this->fproductrepo = $fproductrepo;
        $this->attachmentrepo = $attachmentrepo;
        $this->subproduct = $subproduct;
        $this->eventrepo = $eventrepo;


        //authenticated
        $this->middleware('auth');
        //Permissions on methods
        $this->middleware('frontclientprojectMiddlewareIndex');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get team fproducts
        $fproducts = $this->fproductrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('fproducts'),
            'fproducts' => $fproducts,
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
        $cats = DB::table('f_categories')->get();

        $fproduct = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'fproduct' => $fproduct,
            'cats' => $cats,

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
    public function store(FproductValidation $request)
    {
        //create the fproduct
        if (!$fproduct_id = $this->fproductrepo->create()) {
           return abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $fproducts = $this->fproductrepo->search($fproduct_id);
        $fproduct = $fproducts->first();

        //[save attachments] loop through and save each attachment
        if (request()->filled('attachments')) {
            foreach (request('attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'fproduct',
                    'attachmentresource_id' => $fproduct_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_fproduct_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        //counting all rows
        $rows = $this->fproductrepo->search();
        $count = $rows->count();

        /** ----------------------------------------------
        * record event [fproduct created]
        * ----------------------------------------------*/

        $data = [
        'event_creatorid' => auth()->id(),
        'event_item' => 'fproduct_created',
        'event_item_id' => '',
        'event_item_lang' => 'fproduct_created',
        'event_item_content' => $fproduct->title,
        'event_item_content2' => '',
        'event_parent_type' => 'Corporate Service',
        'event_parent_id' => $fproduct->id,
        'event_parent_title' => $fproduct->title ?? '',
        'event_show_item' => 'yes',
        'event_show_in_timeline' => 'yes',
        'event_clientid' => auth()->id(),
        'eventresource_type' => 'Corporate Service',
        'eventresource_id' => $fproduct->id,
        'event_notification_category' => 'notifications_fproduct_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
        //get users
        }

        //reponse payload
        $payload = [
            'count' => $count,
            'fproducts' => $fproducts,
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
        $fproducts = $this->fproductrepo->search($id);
        $fproduct = $fproducts->first();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'fproduct')
            ->get();

        //reponse payload
        $payload = [
            'fproduct' => $fproduct,
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
        $fproducts = $this->fproductrepo->search($id);
        $fproduct = $fproducts->first();

        $cats = DB::table('f_categories')->get();

        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'fproduct')
            ->get();
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('edit'),
            'fproduct' => $fproduct,
            'attachments' => $attachments,
            'cats' => $cats,

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
    public function update(FproductValidation $request, $id)
    {
        //get project
        $fproducts = $this->fproductrepo->search($id);
        $fproduct = $fproducts->first();
        //update
        if (!$this->fproductrepo->update($id)) {
            abort(409);
        }

        //get project
        $fproducts = $this->fproductrepo->search($id);
        $fproduct = $fproducts->first();
        if (request()->filled('attachments')) {
            foreach (request('attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => auth()->user()->id,
                    'attachmentresource_type' => 'fproduct',
                    'attachmentresource_id' => $fproduct->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachments_unique_input_fproduct_copy'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

          /** ----------------------------------------------
          * record event [fproduct updated]
          * ----------------------------------------------*/

          $data = [
          'event_creatorid' => auth()->id(),
          'event_item' => 'fproduct_updated',
          'event_item_id' => '',
          'event_item_lang' => 'fproduct_updated',
          'event_item_content' => $fproduct->title,
          'event_item_content2' => '',
          'event_parent_type' => 'Corporate Service',
          'event_parent_id' => $fproduct->id,
          'event_parent_title' => $fproduct->title ?? '',
          'event_show_item' => 'yes',
          'event_show_in_timeline' => 'yes',
          'event_clientid' => auth()->id(),
          'eventresource_type' => 'Corporate Service',
          'eventresource_id' => $fproduct->id,
          'event_notification_category' => 'notifications_fproduct_activity',
          ];

          //record event
          if ($event_id = $this->eventrepo->create($data)) {
          //get users

          }

        //reponse payload
        $payload = [
            'fproducts' => $fproducts,
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
        if (!\App\Models\FProduct::find($id)) {
            abort(409, __('lang.error_request_could_not_be_completed'));
        }

        //get it in useful format
        $fproducts = $this->fproductrepo->search($id);
        $fproduct = $fproducts->first();

        if ($attachments = $fproduct->attachments()->get()) {
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
        * record event [fproduct deleted]
        * ----------------------------------------------*/

        $data = [
        'event_creatorid' => auth()->id(),
        'event_item' => 'fproduct_deleted',
        'event_item_id' => '',
        'event_item_lang' => 'fproduct_deleted',
        'event_item_content' => $fproduct->title,
        'event_item_content2' => '',
        'event_parent_type' => 'Corporate Service',
        'event_parent_id' => $fproduct->id,
        'event_parent_title' => $fproduct->title ?? '',
        'event_show_item' => 'yes',
        'event_show_in_timeline' => 'yes',
        'event_clientid' => auth()->id(),
        'eventresource_type' => 'Corporate Service',
        'eventresource_id' => $fproduct->id,
        'event_notification_category' => 'notifications_fproduct_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
        //get users
        }

        //delete the category
        $sub_product = SubProduct::where('f_product_id', $fproduct->id)->get();
            if($sub_product){
            foreach ($sub_product as $key ) {
                $this->subproduct->destroy($key->id);
            }
        }

        //delete the category
        $fproduct->delete();

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
                __('lang.fproducts'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'fproducts',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_fproducts' => 'active',
            'submenu_fproducts' => 'active',
            'sidepanel_id' => 'sidepanel-filter-fproducts',
            'dynamic_search_url' => url('fproducts/search?action=search&fproductresource_id=' . request('fproductresource_id') . '&fproductresource_type=' . request('fproductresource_type')),
            'add_button_classes' => 'add-edit-fproducts-button',
            'load_more_button_route' => 'fproducts',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_fproduct'),
            'add_modal_create_url' => url('fproducts/create?fproductresource_id=' . request('fproductresource_id') . '&fproductresource_type=' . request('fproductresource_type')),
            'add_modal_action_url' => url('fproducts?fproductresource_id=' . request('fproductresource_id') . '&fproductresource_type=' . request('fproductresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //projects list page
        if ($section == 'fproducts') {
            $page += [
                'meta_title' => __('lang.fproducts'),
                'heading' => __('lang.fproducts'),
                'sidepanel_id' => 'sidepanel-filter-fproducts',
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
        $fproducts = $this->projectrepo->search($id);

        //project
        $fproduct = $fproducts->first();

        $page = $this->pageSettings('fproducts', $fproduct);

        //apply permissions
        // $this->applyPermissions($project);

        //set dynamic url for use in template
        switch (request()->segment(3)) {
            case 'fproducts':
            case 'files':
            
                $sections = request()->segment(3);
                $section = rtrim($sections, 's');
                $page['dynamic_url'] = url($sections . '?source=ext&' . $section . 'resource_type=project&' . $section . 'resource_id=' . $fproduct->id);
                break;
            case 'details':
                $page['dynamic_url'] = url('fproducts/' . $fproduct->id . '/fproducts-details');
                break;
            default:
                $page['dynamic_url'] = url('fproducts?source=ext&commentresource_type=project&commentresource_id=' . $fproduct->id);
                break;
        }

        //reponse payload
        $payload = [
            'page' => $page,
            'project' => $fproduct,
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
            'selector' => '#fproduct_attachment_' . $attachment->attachment_id,
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
