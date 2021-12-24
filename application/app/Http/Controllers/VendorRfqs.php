<?php

namespace App\Http\Controllers;

use PDF;
use App\EachRfq;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\RfqMail;
use App\Models\RItem;
use App\Models\Material;
use App\Models\VendorRfq;
use App\Jobs\SendEmailJob;
use App\Models\RfqMaterial;
use Illuminate\Http\Request;
use App\Jobs\SendVendorEmail;
use App\Models\VendorQuotation;
use App\FrontVendorRegistration;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\VendorRfqRepository;
use App\Repositories\AttachmentRepository;
use App\Http\Responses\VendorRfqs\EditResponse;
use App\Http\Responses\VendorRfqs\ShowResponse;
use App\Http\Responses\VendorRfqs\IndexResponse;
use App\Http\Responses\VendorRfqs\StoreResponse;
use App\Http\Responses\VendorRfqs\CreateResponse;
use App\Http\Responses\VendorRfqs\UpdateResponse;
use App\Http\Responses\VendorRfqs\DestroyResponse;
use App\Http\Requests\VendorRfqs\VendorRfqsValidation;
use App\Http\Responses\VendorRfqs\AttachDettachResponse;
use App\Mail\RFQmail as MailRFQmail;

class VendorRfqs extends Controller
{
     /**
     * The vendorrfqrepo repository instance.
     */
    protected $vendorrfqrepo;
    protected $attachmentrepo;
    protected $eventrepo;


    public function __construct(AttachmentRepository $attachmentrepo, VendorRfqRepository $vendorrfqrepo, EventRepository $eventrepo) {
        //parent
        parent::__construct();
        $this->eventrepo = $eventrepo;
        $this->vendorrfqrepo = $vendorrfqrepo;
        $this->attachmentrepo = $attachmentrepo;

        
          //authenticated
          $this->middleware('auth');
          //Permissions on methods
        // $this->middleware('vendorrfqMiddlewareIndex');
        $this->middleware('vendorrfqMiddlewareIndex')->except('downloadAttachment');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get team vendorrfqs
        $vendorrfqs = $this->vendorrfqrepo->search();

        //reponse payload
        $payload = [
            'page' => $this->pageSettings('vendorrfqs'),
            'vendorrfqs' => $vendorrfqs,
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

        $vendorrfq = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'vendorrfq' => $vendorrfq,
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
    public function store(VendorRfqsValidation $request)
    {
         if (!$vendorrfq_id = $this->vendorrfqrepo->create()) {
            abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $vendorrfqs = $this->vendorrfqrepo->search($vendorrfq_id);
        $vendorrfq = $vendorrfqs->first();


        //[save attachments] loop through and save each attachment
        if (request()->filled('rfq_attachments')) {
            foreach (request('rfq_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('vendorrfq_clientid'),
                    'attachmentresource_type' => 'vendorrfq',
                    'attachmentresource_id' => $vendorrfq_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_rfq'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('video_attachments')) {
            foreach (request('video_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('vendorrfq_clientid'),
                    'attachmentresource_type' => 'vendorrfq',
                    'attachmentresource_id' => $vendorrfq_id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_video'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }

        
        //counting all rows
        $rows = $this->vendorrfqrepo->search();
        $count = $rows->count();
       
             
       
        //reponse payload
        $payload = [
            'count' => $count,
            'vendorrfqs' => $vendorrfqs,
        ];

        //process reponse
        return new StoreResponse($payload);
    }

    public function userQtn($id, $rfq)
    {
        $vendorqtn = VendorQuotation::where('user_id',$id)->where('rfq_ref',$rfq)->first();
        return view('pages/vendorqtn/components/table/show', compact('vendorqtn'));
        
    }

    //multi items vendor rfq
    public function addItems($id)
    {
        $vendorrfqs = $this->vendorrfqrepo->search($id);
        $vendorrfq = $vendorrfqs->first();
        
        $materials = Material::where('category',$vendorrfq->company_category)->get();
        $rfq_materials = RfqMaterial::where('rfq_id',$id)->get();
        //reponse payload
        $payload = [
            'vendorrfq' => $vendorrfq,
            'materials' => $materials,
            'rfq_materials' => $rfq_materials,
        ];

        return view('pages.rfq_items.wrapper',compact('payload'));
    }


    public function storeItem(Request $request)
    {

        $id = $request->vendorrfq_id;
        $rfq = VendorRfq::find($id);
        
        $materials = RfqMaterial::where('rfq_id',$id)->pluck('id');
        RfqMaterial::destroy($materials);

        $count = 0;
        if(request('qty') == null )
        {
         return redirect()->to('vendorrfqs');
        }

        if (is_array(request('material_id'))) {
            foreach (request('material_id') as $material_id) {
                //get the material
                if ($material = \App\Models\Material::Where('id', $material_id)->first()) { 
                    $total = $request->qty[$count] * $material->amount;
                    try {
                            RfqMaterial::create([
                                'rfq_id' => $rfq->id,
                                'material_id' => $material_id,
                                'title' => $material->title,
                                'qty' => $request->qty[$count],
                                'uom' => $request->uom[$count],
                                'description' => $request->description[$count],
                                'total' => $total,
                        ]);
                    } catch (\Throwable $th) {
                        echo $th->getMessage();
                    }
                    $count++;
                }
            }

        $search = explode(',', $rfq->category);
        $new_emails = [];

        //fetching the mail and id of all the users realted to the requested category 
        for($i = 0; $i< count($search); $i++){
            $emails = DB::table("front_vendor_registrations")
            ->select('email','user_id')
            ->whereRaw("find_in_set('".$search[$i]."', front_vendor_registrations.category)")
            ->get();

            array_push($new_emails,$emails);
        }
    
        $all = EachRfq::select('id')->where('vendor_rfq_id',$id)->get();
        if(!empty($all)){
        foreach($all as $single){
            EachRfq::where('id', $single->id)->delete();
            }
        }


        $materials2 = RfqMaterial::where('rfq_id', $rfq->id)->get();
        
        $rfq_cats = $rfq->category;    
        $a = explode(',',$rfq_cats);
        $email_count = [];
            if (!empty($new_emails)) {
                foreach ($new_emails as $single) {

                    foreach ($single as $t) {
                        if(!in_array($t->user_id, $email_count)){
                        
                         $us =  User::find($t->user_id);
                        $user_cats = $us->fvendor->category;
                        $b = explode(',', $user_cats);
                        $result = array_intersect($a, $b);
                        $each =  new EachRfq();
                        $each->user_id = $t->user_id;
                        $each->vendor_rfq_id = $rfq->id;
                        $each->status = 'WAITING FOR APPROVAL';
                        $each->category = implode(',', $result);
                        $each->save();
                        $user = User::find($t->user_id);
                        dispatch(new SendEmailJob($user, $rfq, $materials2));
                        
                        }
                        array_push($email_count, $t->user_id);
                    }
                }
            }
        /** ----------------------------------------------
         * record event [vendorrfq created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorrfq_created',
            'event_item_id' => '',
            'event_item_lang' => 'vendorrfq_created',
            'event_item_content' => $rfq->rfq_ref,
            'event_item_content2' => '',
            'event_parent_type' => 'Vendor RFQ',
            'event_parent_id' => $rfq->id,
            'event_parent_title' => $rfq->rfq_ref ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendorrfq',
            'eventresource_id' => $rfq->id,
            'event_notification_category' => 'notifications_vendorrfq_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            
        }

        $rfq->is_material_added = 1;
        $rfq->save();

        return redirect()->to('vendorrfqs')->with('success',__('lang.request_has_been_completed'));
     }
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendorrfqs = $this->vendorrfqrepo->search($id);
        $vendorrfq = $vendorrfqs->first();

         //get attachment
         $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
         ->Where('attachmentresource_type', 'vendorrfq')
         ->get();

        //reponse payload
        $payload = [
            'vendorrfq' => $vendorrfq,
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
        $vendorrfqs = $this->vendorrfqrepo->search($id);
        $vendorrfq = $vendorrfqs->first();
        
        //get attachment
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
        ->Where('attachmentresource_type', 'vendorrfq')
        ->get();

         //reponse payload
         $payload = [
            'page' => $this->pageSettings('edit'),
            'vendorrfq' => $vendorrfq,
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
    public function update(VendorRfqsValidation $request, $id)
    {   
        //get vendorrfq
        $vendorrfqs = $this->vendorrfqrepo->search($id);
        $vendorrfq = $vendorrfqs->first();

        $old =  $vendorrfq->category;
        //update
        if (!$this->vendorrfqrepo->update($id)) {
            abort(409);
        }

        //get vendorrfq
        $vendorrfqs = $this->vendorrfqrepo->search($id);
        $vendorrfq = $vendorrfqs->first();

        
        // if(request('vendorrfq_category') != $old){
          
        //     // delete the old records for each rfq table;
        //     $all = EachRfq::select('id')->where('vendor_rfq_id',$vendorrfq->id)->get();
        //         if(!empty($all)){
        //         foreach($all as $single){
        //             EachRfq::where('id', $single->id)->delete();
        //         }
        //     }
    
        //     //multi categories starts here
        //     $search = explode(",",$vendorrfq->category);
        //     $rfq = VendorRfq::find($vendorrfq->id);

        // }

        //[save attachments] loop through and save each attachment
        if (request()->filled('rfq_attachments')) {
            foreach (request('rfq_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('vendorrfq_clientid'),
                    'attachmentresource_type' => 'vendorrfq',
                    'attachmentresource_id' => $vendorrfq->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_rfq'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }
        if (request()->filled('video_attachments')) {
            foreach (request('video_attachments') as $uniqueid => $file_name) {
                $data = [
                    'attachment_clientid' => request('vendorrfq_clientid'),
                    'attachmentresource_type' => 'vendorrfq',
                    'attachmentresource_id' => $vendorrfq->id,
                    'attachment_directory' => $uniqueid,
                    'attachment_uniqiueid' => $uniqueid,
                    'attachment_filename' => $file_name,
                    'attachment_unique_input' => request('attachment_unique_input_video'),
                ];
                //process and save to db
                $this->attachmentrepo->process($data);
            }
        }


        /** ----------------------------------------------
         * record event [vendorrfq updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorrfq_updated',
            'event_item_id' => '',
            'event_item_lang' => 'vendorrfq_updated',
            'event_item_content' => $vendorrfq->rfq_ref,
            'event_item_content2' => '',
            'event_parent_type' => 'Vendor RFQ',
            'event_parent_id' => $vendorrfq->id,
            'event_parent_title' => $vendorrfq->rfq_ref ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendorrfq',
            'eventresource_id' => $vendorrfq->id,
            'event_notification_category' => 'notifications_vendorrfq_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            

        }


          //reponse payload
        $payload = [
            'vendorrfqs' => $vendorrfqs,
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

        //get record
      if (!\App\Models\VendorRfq::find($id)) {
        abort(409, __('lang.error_request_could_not_be_completed'));
    }

    //get it in useful format
    $vendorrfqs = $this->vendorrfqrepo->search($id);
    $vendorrfq = $vendorrfqs->first();
    
    //delete attachemnts
    if ($attachments = $vendorrfq->attachments()->get()) {
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
         * record event [vendorrfq deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorrfq_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'vendorrfq_deleted',
            'event_item_content' => $vendorrfq->rfq_ref,
            'event_item_content2' => '',
            'event_parent_type' => 'Vendor RFQ',
            'event_parent_id' => $vendorrfq->id,
            'event_parent_title' => $vendorrfq->rfq_ref ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendorrfq',
            'eventresource_id' => $vendorrfq->id,
            'event_notification_category' => 'notifications_vendorrfq_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            
        }

    
    //delete the category
    $vendorrfq->delete();

    $materials = RfqMaterial::where('rfq_id',$vendorrfq->id)->pluck('id');
    RfqMaterial::destroy($materials);


    // $all = EachRfq::select('id')->where('vendor_rfq_id',$id)->get();
    $all = EachRfq::select('id')->where('vendor_rfq_id',$id)->get();
    if(!empty($all)){
    foreach($all as $single){
        EachRfq::where('id', $single->id)->delete();
        }
    }

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
                __('lang.vendorrfqs'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'vendorrfqs',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_vendors' => 'active',
            'submenu_vendorrfqs' => 'active',
            'mainmenu_vendorrfqs' => 'active',
            'sidepanel_id' => 'sidepanel-filter-vendorrfqs',
            'dynamic_search_url' => url('vendorrfqs/search?action=search&vendorrfqresource_id=' . request('vendorrfqresource_id') . '&vendorrfqresource_type=' . request('vendorrfqresource_type')),
            'add_button_classes' => 'add-edit-vendorrfqs-button',
            'load_more_button_route' => 'vendorrfqs',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_vendorrfq'),
            'add_modal_create_url' => url('vendorrfqs/create?vendorrfqresource_id=' . request('vendorrfqresource_id') . '&vendorrfqresource_type=' . request('vendorrfqresource_type')),
            'add_modal_action_url' => url('vendorrfqs?vendorrfqresource_id=' . request('vendorrfqresource_id') . '&vendorrfqresource_type=' . request('vendorrfqresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //vendorrfqs list page
        if ($section == 'vendorrfqs') {
            $page += [
                'meta_title' => __('lang.vendorrfqs'),
                'heading' => __('lang.vendorrfqs'),
                'sidepanel_id' => 'sidepanel-filter-vendorrfqs',
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
     * show attach/dettach vendorrfq form
     * @return \Illuminate\Http\Response
     */
    public function attachDettach() {

        $vendorrfq = \App\Models\vendorrfq::Where('vendorrfq_id', request('id'))->first();

        //reponse payload
        $payload = [
            'vendorrfq' => $vendorrfq,
        ];

        //show the form
        return new AttachDettachResponse($payload);
    }


    /**
     * download an vendorrfq attachment
     * @param int $id vendorrfq id
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
            'selector' => '#vendorrfq_attachment_' . $attachment->attachment_id,
            'action' => 'slideup-slow-remove',
        );

        //response
        return response()->json($jsondata);
    }    

    public function showEvent($id)
    {
        $vendorrfq = VendorRfq::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'vendorrfq')
            ->get();
        return view('pages.vendorrfq.show-event',compact('vendorrfq','attachments'));
    }
}
