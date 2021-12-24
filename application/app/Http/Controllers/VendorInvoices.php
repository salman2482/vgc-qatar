<?php

namespace App\Http\Controllers;
use PDF;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Requests\Vendor;
use App\Http\Controllers\Controller;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\VendorInvoiceRepository;
use App\Http\Responses\VendorInvoices\EditResponse;
use App\Http\Responses\VendorInvoices\ShowResponse;
use App\Http\Responses\VendorInvoices\IndexResponse;
use App\Http\Responses\VendorInvoices\StoreResponse;
use App\Http\Responses\VendorInvoices\CreateResponse;
use App\Http\Responses\VendorInvoices\UpdateResponse;
use App\Http\Responses\VendorInvoices\DestroyResponse;
use App\Http\Requests\VendorInvoices\VendorInvoicesValidation;
use App\Models\VendorInvoice;

class VendorInvoices extends Controller
{
     /**
     * The vendorinvoicerepo repository instance.
     */
    protected $vendorinvoicerepo;
    protected $eventrepo;


    public function __construct(VendorInvoiceRepository $vendorinvoicerepo, EventRepository $eventrepo) {
        //parent
        parent::__construct();
        $this->eventrepo = $eventrepo;
        $this->vendorinvoicerepo = $vendorinvoicerepo;
        
          //authenticated
          $this->middleware('auth');
          //Permissions on methods
        $this->middleware('vendorinvoiceMiddlewareIndex');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendorinvoices = $this->vendorinvoicerepo->search();
        
         //reponse payload
         $payload = [
             'page' => $this->pageSettings('vendorinvoices'),
             'vendorinvoices' => $vendorinvoices,
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

        $vendorinvoice = '';
        //reponse payload
        $payload = [
            'page' => $this->pageSettings('create'),
            'vendorinvoice' => $vendorinvoice,
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
    public function store(VendorInvoicesValidation $request)
    {
        // return $request;
         //create the govtdocument
         if (!$vendorinvoice_id = $this->vendorinvoicerepo->create()) {
            abort(409);
        }

        //get the category object (friendly for rendering in blade template)
        $vendorinvoices = $this->vendorinvoicerepo->search($vendorinvoice_id);
        $vendorinvoice = $vendorinvoices->first();

        
         //counting all rows
        $rows = $this->vendorinvoicerepo->search();
        $count = $rows->count();

        /** ----------------------------------------------
         * record event [vendorinvoice created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorinvoice_created',
            'event_item_id' => '',
            'event_item_lang' => 'vendorinvoice_created',
            'event_item_content' => $vendorinvoice->invoice_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'vendorinvoice',
            'event_parent_id' => $vendorinvoice->id,
            'event_parent_title' => $vendorinvoice->invoice_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendorinvoice',
            'eventresource_id' => $vendorinvoice->id,
            'event_notification_category' => 'notifications_vendorinvoice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            
        }


        //reponse payload
        $payload = [
            'count' => $count,
            'vendorinvoices' => $vendorinvoices,
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
        $vendorinvoices = $this->vendorinvoicerepo->search($id);
        $vendorinvoice = $vendorinvoices->first();


        //reponse payload
        $payload = [
            'vendorinvoice' => $vendorinvoice,
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
        $vendorinvoices = $this->vendorinvoicerepo->search($id);
        $vendorinvoice = $vendorinvoices->first();
       
         //reponse payload
         $payload = [
            'page' => $this->pageSettings('edit'),
            'vendorinvoice' => $vendorinvoice,
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
        //get vendorinvoice
        $vendorinvoices = $this->vendorinvoicerepo->search($id);
        $vendorinvoice = $vendorinvoices->first();
        //update
        if (!$this->vendorinvoicerepo->update($id)) {
            abort(409);
        }

        //get vendorinvoice
        $vendorinvoices = $this->vendorinvoicerepo->search($id);
        $vendorinvoice = $vendorinvoices->first();

        /** ----------------------------------------------
         * record event [vendorinvoice updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorinvoice_updated',
            'event_item_id' => '',
            'event_item_lang' => 'vendorinvoice_updated',
            'event_item_content' => $vendorinvoice->invoice_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'vendorinvoice',
            'event_parent_id' => $vendorinvoice->id,
            'event_parent_title' => $vendorinvoice->invoice_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendorinvoice',
            'eventresource_id' => $vendorinvoice->id,
            'event_notification_category' => 'notifications_vendorinvoice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            

        }

          //reponse payload
        $payload = [
            'vendorinvoices' => $vendorinvoices,
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
      if (!\App\Models\VendorInvoice::find($id)) {
        abort(409, __('lang.error_request_could_not_be_completed'));
    }

    //get it in useful format
    $vendorinvoices = $this->vendorinvoicerepo->search($id);
    $vendorinvoice = $vendorinvoices->first();
    
    /** ----------------------------------------------
         * record event [vendorinvoice deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendorinvoice_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'vendorinvoice_deleted',
            'event_item_content' => $vendorinvoice->invoice_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'vendorinvoice',
            'event_parent_id' => $vendorinvoice->id,
            'event_parent_title' => $vendorinvoice->invoice_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendorinvoice',
            'eventresource_id' => $vendorinvoice->id,
            'event_notification_category' => 'notifications_vendorinvoice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            
        }

    //delete the category
    $vendorinvoice->delete();


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
                __('lang.vendorinvoices'),
            ],
            'crumbs_special_class' => 'list-pages-crumbs',
            'page' => 'vendorinvoices',
            'no_results_message' => __('lang.no_results_found'),
            'mainmenu_vendors' => 'active',
            'submenu_vendorinvoices' => 'active',
            'mainmenu_vendorinvoices' => 'active',
            'sidepanel_id' => 'sidepanel-filter-vendorinvoices',
            'dynamic_search_url' => url('vendorinvoices/search?action=search&vendorinvoiceresource_id=' . request('vendorinvoiceresource_id') . '&vendorinvoiceresource_type=' . request('vendorinvoiceresource_type')),
            'add_button_classes' => 'add-edit-vendorinvoices-button',
            'load_more_button_route' => 'vendorinvoices',
            'source' => 'list',
        ];

        //default modal settings (modify for sepecif sections)
        $page += [
            'add_modal_title' => __('lang.add_vendorinvoice'),
            'add_modal_create_url' => url('vendorinvoices/create?vendorinvoiceresource_id=' . request('vendorinvoiceresource_id') . '&vendorinvoiceresource_type=' . request('vendorinvoiceresource_type')),
            'add_modal_action_url' => url('vendorinvoices?vendorinvoiceresource_id=' . request('vendorinvoiceresource_id') . '&vendorinvoiceresource_type=' . request('vendorinvoiceresource_type')),
            'add_modal_action_ajax_class' => '',
            'add_modal_action_ajax_loading_target' => 'commonModalBody',
            'add_modal_action_method' => 'POST',
        ];

        //vendorinvoices list page
        if ($section == 'vendorinvoices') {
            $page += [
                'meta_title' => __('lang.vendorinvoices'),
                'heading' => __('lang.vendorinvoices'),
                'sidepanel_id' => 'sidepanel-filter-vendorinvoices',
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
        $vendorinvoice = VendorInvoice::findOrFail($id);
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'vendorinvoice')
            ->get();
        return view('pages.vendorinvoice.show-event',compact('vendorinvoice','attachments'));
    }
}
