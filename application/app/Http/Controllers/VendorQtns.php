<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\User;
use App\Models\VendorRfq;
use App\Models\RfqMaterial;
use Illuminate\Http\Request;
use App\Http\Requests\Vendor;
use App\Models\VendorQuotation;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\VendorQtnRepository;
use App\Http\Responses\VendorQtns\EditResponse;
use App\Http\Responses\VendorQtns\ShowResponse;
use App\Http\Responses\VendorQtns\IndexResponse;
use App\Http\Responses\VendorQtns\StoreResponse;
use App\Http\Responses\VendorQtns\CreateResponse;
use App\Http\Responses\VendorQtns\UpdateResponse;
use App\Http\Responses\VendorQtns\DestroyResponse;
use App\Http\Requests\VendorQtn\VendorQtnValidation;


class VendorQtns extends Controller
{
     /**
     * The vendorqtnrepo repository instance.
     */
    protected $vendorqtnrepo;
    protected $eventrepo;


    public function __construct(VendorQtnRepository $vendorqtnrepo, EventRepository $eventrepo) {
        //parent
        parent::__construct();
        $this->eventrepo = $eventrepo;
        $this->vendorqtnrepo = $vendorqtnrepo;
        
          //authenticated
          $this->middleware('auth');
          //Permissions on methods
        $this->middleware('vendorqtnMiddlewareIndex');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get team verpos
        $vendorqtns = $this->vendorqtnrepo->search();
        
         //reponse payload
         $payload = [
             'page' => $this->pageSettings('vendorqtns'),
             'vendorqtns' => $vendorqtns,
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

        $vendorqtn = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'vendorqtn' => $vendorqtn,
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
    public function store(VendorQtnValidation $request)
    {
        // return $request;
         //create the vendorqtn
         if (!$vendorqtn_id = $this->vendorqtnrepo->create()) {
            abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $vendorqtns = $this->vendorqtnrepo->search($vendorqtn_id);

        $vendorqtn = $vendorqtns->first();
        
         //counting all rows
        $rows = $this->vendorqtnrepo->search();
        $count = $rows->count();

        /** ----------------------------------------------
         * record event [vendorqtn created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorqtn_created',
            'event_item_id' => '',
            'event_item_lang' => 'vendorqtn_created',
            'event_item_content' => $vendorqtn->qtn_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'vendorqtn',
            'event_parent_id' => $vendorqtn->id,
            'event_parent_title' => $vendorqtn->qtn_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendorqtn',
            'eventresource_id' => $vendorqtn->id,
            'event_notification_category' => 'notifications_vendorqtn_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
        }


        //reponse payload
        $payload = [
            'count' => $count,
            'vendorqtns' => $vendorqtns,
        ];

        //process reponse
        return new StoreResponse($payload);
    }


    public function createPdf($id)
    {
        $vendorqtns = $this->vendorqtnrepo->search($id);
        $vendorqtn = $vendorqtns->first();

        $user = User::find($vendorqtn->user_id);
        
        $rfq = VendorRfq::where('rfq_ref', $vendorqtn->rfq_ref)->first();
        if($rfq){
            $materials = RfqMaterial::where('rfq_id', $rfq->id)->get();
        }
        
        $pdf = PDF::loadView('users.qtn',compact('vendorqtn','user','materials'));
        return $pdf->download('Request For Quotation.pdf');
        // return view('users.qtn',compact('vendorqtn','user','materials'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $vendorqtns = $this->vendorqtnrepo->search($id);
        $vendorqtn = $vendorqtns->first();


        //reponse payload
        $payload = [
            'vendorqtn' => $vendorqtn,
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
        $vendorqtns = $this->vendorqtnrepo->search($id);
        $vendorqtn = $vendorqtns->first();
       
         //reponse payload
         $payload = [
            'page' => $this->pageSettings('edit'),
            'vendorqtn' => $vendorqtn,
        ];
        return new EditResponse($payload);
    }

    public function vendorUpdateQuotation($id){
        //get vendorqtn
        $vendorqtns = $this->vendorqtnrepo->search($id);
        $vendorqtn = $vendorqtns->first();
        //update
        if (!$this->vendorqtnrepo->update($id)) {
            abort(409);
        }else{
            return back();
        }
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
        //get vendorqtn
        $vendorqtns = $this->vendorqtnrepo->search($id);
        $vendorqtn = $vendorqtns->first();
        //update
        if (!$this->vendorqtnrepo->update($id)) {
            abort(409);
        }

        //get vendorqtn
        $vendorqtns = $this->vendorqtnrepo->search($id);
        $vendorqtn = $vendorqtns->first();

        /** ----------------------------------------------
         * record event [vendorqtn updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorqtn_updated',
            'event_item_id' => '',
            'event_item_lang' => 'vendorqtn_updated',
            'event_item_content' => $vendorqtn->qtn_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'vendorqtn',
            'event_parent_id' => $vendorqtn->id,
            'event_parent_title' => $vendorqtn->qtn_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendorqtn',
            'eventresource_id' => $vendorqtn->id,
            'event_notification_category' => 'notifications_vendorqtn_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users

        }

        //reponse payload
        $payload = [
            'vendorqtns' => $vendorqtns,
            'id' => $id,
        ];

        //generate a response
        return new UpdateResponse($payload);
    }



     /**
     * Remove the specified vendorqtn from storage.
     * @param object DestroyRepository instance of the repository
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //delete each record in the array
      //get record
      if (!\App\Models\VendorQuotation::find($id)) {
        abort(409, __('lang.error_request_could_not_be_completed'));
    }

    //get it in useful format
    $vendorqtns = $this->vendorqtnrepo->search($id);
    $vendorqtn = $vendorqtns->first();

    
        /** ----------------------------------------------
         * record event [vendorqtn deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorqtn_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'vendorqtn_deleted',
            'event_item_content' => $vendorqtn->qtn_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'vendorqtn',
            'event_parent_id' => $vendorqtn->id,
            'event_parent_title' => $vendorqtn->qtn_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendorqtn',
            'eventresource_id' => $vendorqtn->id,
            'event_notification_category' => 'notifications_vendorqtn_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
        }

    //delete the category
    $vendorqtn->delete();


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
                __('lang.vendorqtns'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'vendorqtns',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_vendors' => 'active',
            'submenu_vendorqtns' => 'active',
            'mainmenu_vendorqtns' => 'active',
            'sidepanel_id' => 'sidepanel-filter-vendorqtns',
            'dynamic_search_url' => url('vendorqtns/search?action=search&vendorqtnresource_id=' . request('vendorqtnresource_id') . '&vendorqtnresource_type=' . request('vendorqtnresource_type')),
            'add_button_classes' => 'add-edit-vendorqtns-button',
            'load_more_button_route' => 'vendorqtns',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_vendorqtn'),
            'add_modal_create_url' => url('vendorqtns/create?vendorqtnresource_id=' . request('vendorqtnresource_id') . '&vendorqtnresource_type=' . request('vendorqtnresource_type')),
            'add_modal_action_url' => url('vendorqtns?vendorqtnresource_id=' . request('vendorqtnresource_id') . '&vendorqtnresource_type=' . request('vendorqtnresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //vendorqtns list page
        if ($section == 'vendorqtns') {
            $page += [
                'meta_title' => __('lang.vendorqtns'),
                'heading' => __('lang.vendorqtns'),
                'sidepanel_id' => 'sidepanel-filter-vendorqtns',
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

    public function showEvent($id)
    {
        $vendorqtn = VendorQuotation::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'vendorqtn')
            ->get();
        return view('pages.vendorqtn.show-event',compact('vendorqtn','attachments'));
    }

}
