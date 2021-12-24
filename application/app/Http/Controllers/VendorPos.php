<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Material;
use App\Models\VendorPo;
use App\Models\VendorRfq;
use App\Models\RfqMaterial;
use Illuminate\Http\Request;
use App\Models\VendorQuotation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\VendorPoRepository;
use App\Repositories\AttachmentRepository;
use App\Http\Responses\VendorPos\EditResponse;
use App\Http\Responses\VendorPos\ShowResponse;
use App\Http\Responses\VendorPos\IndexResponse;
use App\Http\Responses\VendorPos\StoreResponse;
use App\Http\Responses\VendorPos\CreateResponse;
use App\Http\Responses\VendorPos\UpdateResponse;
use App\Http\Responses\VendorPos\DestroyResponse;
use App\Http\Requests\VendorPos\VendorPosValidation;
use App\Http\Responses\VendorPos\AttachDettachResponse;

class VendorPos extends Controller
{
     /**
     * The VendorPos repository instance.
     */
    protected $vendorporepo;
    protected $attachmentrepo;
    protected $eventrepo;


    public function __construct(AttachmentRepository $attachmentrepo, VendorPoRepository $vendorporepo, EventRepository $eventrepo) {
        //parent
        parent::__construct();

        $this->vendorporepo = $vendorporepo;
        $this->eventrepo = $eventrepo;
        $this->attachmentrepo = $attachmentrepo;

          //authenticated
          $this->middleware('auth');
          //Permissions on methods
        $this->middleware('vendorpoMiddlewareIndex');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //get team vendorpos
         $vendorpos = $this->vendorporepo->search();

         
         //reponse payload
         $payload = [
             'page' => $this->pageSettings('vendorpos'),
             'vendorpos' => $vendorpos,
         ];

          //show the view
        return new IndexResponse($payload);
    }


    public function getQtnCatTotal()
    {
        $id =  request()->id;
        $category = 
        DB::table('vendor_quotations')->select('category','total_value','user_id')->where('qtn_ref_no', '=', $id)->first();
    
        $vendorName = User::select('company_name')->where('id',$category->user_id)->first();
        $name = $vendorName->company_name;
        return response()->json(['category'=>$category, 'name'=>$name]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qtns = DB::table('vendor_quotations')->where('status','APPROVED')->select('qtn_ref_no')->get();
        $vendorpo = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'vendorpo' => $vendorpo,
            'qtns' => $qtns,
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
    public function store(VendorPosValidation $request)
    {
        if (!$vendorpo_id = $this->vendorporepo->create()) {
            abort(409);
        }
        
        $vpo = VendorPo::find($vendorpo_id);
        $vqtn =  VendorQuotation::where('qtn_ref_no',$vpo->qtn_ref_no)->first();
        $vrfq = VendorRfq::where('rfq_ref', $vqtn->rfq_ref)->first();
        
        $rfqmaterials = RfqMaterial::where('rfq_id', $vrfq->id)->get();

        foreach($rfqmaterials as $rfqmaterial){
            $qty = (int)$rfqmaterial->qty;
            $materials = Material::find($rfqmaterial->material_id);
            $materials->available_stock = $materials->available_stock + $qty;
            $materials->update();
        }
        //get the category object (friendly for rendering in blade template)
        $vendorpos = $this->vendorporepo->search($vendorpo_id);
        $vendorpo = $vendorpos->first();


        //[save attachments] loop through and save each attachment
        if (request()->filled('qtn_attachments')) {
            foreach (request('qtn_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('vendorpo_clientid'),
                    'attachmentresource_type' => 'vendorpo',
                    'attachmentresource_id' => $vendorpo_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_qtn'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('po_attachments')) {
            foreach (request('po_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('vendorpo_clientid'),
                    'attachmentresource_type' => 'vendorpo',
                    'attachmentresource_id' => $vendorpo_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_po'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
         //counting all rows
        $rows = $this->vendorporepo->search();
        $count = $rows->count();

        /** ----------------------------------------------
         * record event [vendorpo created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorpo_created',
            'event_item_id' => '',
            'event_item_lang' => 'vendorpo_created',
            'event_item_content' => $vendorpo->po_ref,
            'event_item_content2' => '',
            'event_parent_type' => 'vendor PO',
            'event_parent_id' => $vendorpo->id,
            'event_parent_title' => $vendorpo->po_ref ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendor PO',
            'eventresource_id' => $vendorpo->id,
            'event_notification_category' => 'notifications_vendorpo_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
        }


        //reponse payload
        $payload = [
            'count' => $count,
            'vendorpos' => $vendorpos,
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
        $vendorpos = $this->vendorporepo->search($id);
        $vendorpo = $vendorpos->first();

        // return $vendorpo;
        // dd();
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'vendorpo')
            ->get();

        //reponse payload
        $payload = [
            'vendorpo' => $vendorpo,
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
        $vendorpos = $this->vendorporepo->search($id);
        $vendorpo = $vendorpos->first();

        $qtns = DB::table('vendor_quotations')->select('qtn_ref_no')->get();


        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'vendorpo')
            ->get();

       
         //reponse payload
         $payload = [
            'attachments' => $attachments,
            'page' => $this->pageSettings('edit'),
            'vendorpo' => $vendorpo,
            'qtns' => $qtns,

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
    public function update(VendorPosValidation $request, $id)
    {   
        //get vendorpo
        $vendorpos = $this->vendorporepo->search($id);
        $vendorpo = $vendorpos->first();
        //update
        if (!$this->vendorporepo->update($id)) {
            abort(409);
        }

        //get vendorpo
        $vendorpos = $this->vendorporepo->search($id);
        $vendorpo = $vendorpos->first();

       
        if (request()->filled('qtn_attachments')) {
            foreach (request('qtn_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('vendorpo_clientid'),
                    'attachmentresource_type' => 'vendorpo',
                    'attachmentresource_id' => $vendorpo->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_qtn'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('po_attachments')) {
            foreach (request('po_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('vendorpo_clientid'),
                    'attachmentresource_type' => 'vendorpo',
                    'attachmentresource_id' => $vendorpo->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_po'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }


        /** ----------------------------------------------
         * record event [vendorpo updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorpo_updated',
            'event_item_id' => '',
            'event_item_lang' => 'vendorpo_updated',
            'event_item_content' => $vendorpo->po_ref,
            'event_item_content2' => '',
            'event_parent_type' => 'vendor PO',
            'event_parent_id' => $vendorpo->id,
            'event_parent_title' => $vendorpo->po_ref ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendor PO',
            'eventresource_id' => $vendorpo->id,
            'event_notification_category' => 'notifications_vendorpo_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users

        }

          //reponse payload
        $payload = [
            'vendorpos' => $vendorpos,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }

     /**
     * Remove the specified vendorpo from storage.
     * @param object DestroyRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      //delete each record in the array
      //get record
      if (!\App\Models\VendorPo::find($id)) {
        abort(409, __('lang.error_request_could_not_be_completed'));
    }

    //get it in useful format
    $vendorpos = $this->vendorporepo->search($id);
    $vendorpo = $vendorpos->first();
    
    //delete attachemnts
    if ($attachments = $vendorpo->attachments()->get()) {
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
         * record event [vendorpo deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorpo_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'vendorpo_deleted',
            'event_item_content' => $vendorpo->po_ref,
            'event_item_content2' => '',
            'event_parent_type' => 'vendorpo',
            'event_parent_id' => $vendorpo->id,
            'event_parent_title' => $vendorpo->po_ref ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendorpo',
            'eventresource_id' => $vendorpo->id,
            'event_notification_category' => 'notifications_vendorpo_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
        }


    //delete the category
    $vendorpo->delete();


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
                __('lang.vendorpos'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'vendorpos',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_vendors' => 'active',
            'submenu_vendorpos' => 'active',
            'mainmenu_vendorpos' => 'active',
            'sidepanel_id' => 'sidepanel-filter-vendorpos',
            'dynamic_search_url' => url('vendorpos/search?action=search&vendorporesource_id=' . request('vendorporesource_id') . '&vendorporesource_type=' . request('vendorporesource_type')),
            'add_button_classes' => 'add-edit-vendorpos-button',
            'load_more_button_route' => 'vendorpos',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_vendorpo'),
            'add_modal_create_url' => url('vendorpos/create?vendorporesource_id=' . request('vendorporesource_id') . '&vendorporesource_type=' . request('vendorporesource_type')),
            'add_modal_action_url' => url('vendorpos?vendorporesource_id=' . request('vendorporesource_id') . '&vendorporesource_type=' . request('vendorporesource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //vendorpos list page
        if ($section == 'vendorpos') {
            $page += [
                'meta_title' => __('lang.vendorpos'),
                'heading' => __('lang.vendorpos'),
                'sidepanel_id' => 'sidepanel-filter-vendorpos',
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
     * show attach/dettach vendorpo form
     * @return \Illuminate\Http\Response
     */
    public function attachDettach() {

        $vendorpo = \App\Models\VendorPo::Where('vendorpo_id', request('id'))->first();

        //reponse payload
        $payload = [
            'vendorpo' => $vendorpo,
        ];

        //show the form
        return new AttachDettachResponse($payload);
    }


    /**
     * download an vendorpo attachment
     * @param int $id vendorpo id
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
            'selector' => '#vendorpo_attachment_' . $attachment->attachment_id,
            'action' => 'slideup-slow-remove',
        );

        //response
        return response()->json($jsondata);
    }

    public function showEvent($id)
    {
        $vendorpo = VendorPo::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'vendorpo')
            ->get();
        return view('pages.vendorpo.show-event',compact('vendorpo','attachments'));
    }
}
