<?php

namespace App\Http\Controllers\FrontVendor;

use App\EachRfq;
use App\Models\Vendor;
use App\Models\Settings;
use App\Models\VendorRfq;
use App\Mail\VendorQtnMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Illuminate\Support\Facades\Request;
use App\Mail\VendorRFQ_QtnMail;
use App\Models\VendorQuotation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;

class FrontVendorQuotationController extends Controller
{

    protected $eventrepo;
    public function __construct(EventRepository $eventrepo) {
        //parent
        parent::__construct();
        $this->eventrepo = $eventrepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = VendorQuotation::where('user_id',auth()->user()->id)->get();
        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'Quotation',
            'quotations' => $quotations,
            
        ];
        return view('vendor-dashboard.quotation.index', compact('payload'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $userId = $user->id;
        
        $cats = EachRfq::select('vendor_rfq_id')->where('user_id', auth()->user()->id)->where('status', 'APPROVED')->get();
        
        $rfqs = '';
        foreach($cats as $single)
        {
            $emails = VendorRfq::where('id', $single->vendor_rfq_id)->get();
            if($emails->isNotEmpty()){
                $rfqs = $emails;
                }
        }
        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'Create Quotation',
        ];
        return view('vendor-dashboard.quotation.create', compact('payload','rfqs'));
    }

    public function getCategory()
    {
        $id =  request()->id;
        $category = 
        DB::table('vendor_rfqs')->select('category','receiving_date')->where('rfq_ref', '=', $id)->first();
        return response()->json($category);
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'rfq_ref' => 'required',
            'receiving_date' => 'required',
            'category' => 'required',
            'devlivery_time' => 'required',
            'total_value' => 'required|numeric|gt:0',
            'upload_qtn_copy' => 'required',
            ]);
        $quotation = new VendorQuotation();
        
        if ($request->hasFile('upload_qtn_copy')) {
            $file = $request->file('upload_qtn_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $quotation->upload_qtn_copy = $fileName;
        }
        else
        {
            $quotation->upload_qtn_copy = null;
        }
        
        if($request->hasFile('upload_rfq_copy')){
            $file = $request->file('upload_rfq_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $quotation->upload_rfq_copy = $fileName;
            
        }
        else{
            $quotation->upload_rfq_copy = null;
        }

        $quotation->user_id = auth()->user()->id;
        $quotation->rfq_ref = request('rfq_ref');
        $quotation->receiving_date = request('receiving_date');
        $quotation->category = request('category');
        $quotation->total_value = request('total_value');
        $quotation->devlivery_time = request('devlivery_time');
        $quotation->status = 'WAITING FOR APPROVAL';
        $quotation->save();

        //updating the qtn key
        $new = VendorQuotation::find($quotation->id);
        $new->qtn_ref_no = 'QTN-REF-'.$quotation->id;
        $new->save();
        $admin_mail = Settings::select('settings_email_from_address')->first()->settings_email_from_address;
        Mail::to($admin_mail)->send(new VendorRFQ_QtnMail($quotation));

        /** ----------------------------------------------
         * record event [vendor_quotation created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendor_quotation_created',
            'event_item_id' => '',
            'event_item_lang' => 'vendor_quotation_created',
            'event_item_content' => $new->qtn_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'Vendor Quotation',
            'event_parent_id' => $new->id,
            'event_parent_title' => $new->qtn_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'vendor_quotation',
            'eventresource_id' => $new->id,
            'event_notification_category' => 'notifications_vendor_quotation_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            

        }

        return redirect()->route('front.vendorQuotation.index')->with('insert', 'Record Inserted successfully');
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
        $user = auth()->user();
        $userId = $user->id;

        $cats = EachRfq::select('category')->where('user_id', auth()->user()->id)->where('status', 'APPROVED')->get();
        $rfqs =  VendorRfq::whereIn('category',$cats)->get();
        // dd($rfqs[0]->rfq_ref);
        

        $quotation = VendorQuotation::find($id);
        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'Edit Quotation',
            'quotation' => $quotation,
        ];
        

        return view('vendor-dashboard.quotation.edit', compact('payload','rfqs'));
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
        request()->validate([
            'rfq_ref' => 'required',
            'receiving_date' => 'required',
            'category' => 'required',
            'total_value' => 'required|numeric|gt:0',
            'devlivery_time' => 'required',
            ]);
        $quotation = VendorQuotation::find($id);

        if ($request->hasFile('upload_qtn_copy')) {
            if($quotation->upload_qtn_copy != ""){
                Storage::delete('public/vendor/'.$quotation->upload_qtn_copy);   
             }
            $file = $request->file('upload_qtn_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $quotation->upload_qtn_copy = $fileName;
        }
        
        if($request->hasFile('upload_rfq_copy')){
            if($quotation->upload_rfq_copy != ""){
                Storage::delete('public/vendor/'.$quotation->upload_rfq_copy);   
             }
            $file = $request->file('upload_rfq_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $quotation->upload_rfq_copy = $fileName;

        }
        
        if($quotation->total_value !== request('total_value')){
            $quotation->status = 'DISCOUNTED';
        }

        $quotation->rfq_ref = request('rfq_ref');
        $quotation->receiving_date = request('receiving_date');
        $quotation->category = request('category');
        $quotation->total_value = request('total_value');
        $quotation->devlivery_time = request('devlivery_time');
        $quotation->save();
       
        /** ----------------------------------------------
         * record event [quotation updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendor_quotation_updated',
            'event_item_id' => '',
            'event_item_lang' => 'vendor_quotation_updated',
            'event_item_content' => $quotation->qtn_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'Vendor Quotation',
            'event_parent_id' => $quotation->id,
            'event_parent_title' => $quotation->qtn_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'quotation',
            'eventresource_id' => $quotation->id,
            'event_notification_category' => 'notifications_quotation_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
           

        }

        return redirect()->route('front.vendorQuotation.index')->with('update', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quotation = VendorQuotation::find($id);

        if($quotation->upload_qtn_copy != ""){
            Storage::delete('public/vendor/'.$quotation->upload_qtn_copy);   
         }
        if($quotation->upload_rfq_copy != ""){
            Storage::delete('public/vendor/'.$quotation->upload_rfq_copy);   
         }

         $quotation->delete();

         /** ----------------------------------------------
         * record event [quotation deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendor_quotation_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'vendor_quotation_deleted',
            'event_item_content' => $quotation->qtn_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'Vendor Quotation',
            'event_parent_id' => $quotation->id,
            'event_parent_title' => $quotation->qtn_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'quotation',
            'eventresource_id' => $quotation->id,
            'event_notification_category' => 'notifications_quotation_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
           

        }

         return redirect()->route('front.vendorQuotation.index')->with('delete', 'Record Deleted successfully');
    }
}
