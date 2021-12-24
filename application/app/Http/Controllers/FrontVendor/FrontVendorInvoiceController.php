<?php

namespace App\Http\Controllers\FrontVendor;

use App\Models\VendorPo;
use Illuminate\Http\Request;
use App\Models\VendorInvoice;
use App\Mail\VendorInvoiceMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\Settings;

class FrontVendorInvoiceController extends Controller
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
        $invoices = VendorInvoice::where('user_id',auth()->user()->id)->get();
        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'Invoice',
            'invoices' => $invoices,
        ];
        return view('vendor-dashboard.invoice.index', compact('payload'));
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
        // $cats = $user->fvendor;
        // $cats = explode(',', $cats->category);
        
        $pos =  VendorPo::where('user_id',auth()->user()->id)->get();   
        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'Create Invoice',
        ];
        return view('vendor-dashboard.invoice.create', compact('payload','pos'));
    }


    public function getCatTotal()
    {
        $id =  request()->id;
        $category = 
        DB::table('vendor_pos')->select('category','total_value')->where('po_ref', '=', $id)->first();
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
            'lpo_ref' => 'required',
            'delivery_date' => 'required',
            'category' => 'required',
            'invoice_ref_no' => 'required',
            'total_value' => 'required',
            // 'upload_invoice_copy' => 'required',
            // 'upload_qtn_copy' => 'required',
            // 'upload_lpo_copy' => 'required',
        ]);

        $invoice = new VendorInvoice();

        if ($request->hasFile('upload_lpo_copy')) {
            $file = $request->file('upload_lpo_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $invoice->upload_lpo_copy = $fileName;
        }
        else
        {
            $invoice->upload_lpo_copy = null;
        }

        if ($request->hasFile('upload_qtn_copy')) {
            $file = $request->file('upload_qtn_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $invoice->upload_qtn_copy = $fileName;
        }
        else
        {
            $invoice->upload_qtn_copy = null;
        }

        if ($request->hasFile('upload_invoice_copy')) {
            $file = $request->file('upload_invoice_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $invoice->upload_invoice_copy = $fileName;
        }
        else
        {
            $invoice->upload_invoice_copy = null;
        }
        
        $invoice->user_id = auth()->user()->id;
        $invoice->lpo_ref = request('lpo_ref');
        $invoice->delivery_date = request('delivery_date');
        $invoice->category = request('category');
        $invoice->invoice_ref_no = request('invoice_ref_no');
        $invoice->total_value = request('total_value');
        $invoice->status = 'Received For Authentication';
        $invoice->save();
        
        $admin_mail = Settings::select('settings_email_from_address')->first()->settings_email_from_address;
        Mail::to($admin_mail)->send(new VendorInvoiceMail($invoice));
        /** ----------------------------------------------
         * record event [invoice created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendor_invoice_created',
            'event_item_id' => '',
            'event_item_lang' => 'vendor_invoice_created',
            'event_item_content' => $invoice->invoice_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'invoice',
            'event_parent_id' => $invoice->id,
            'event_parent_title' => $invoice->invoice_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'invoice',
            'eventresource_id' => $invoice->id,
            'event_notification_category' => 'notifications_invoice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            

        }
    
        return redirect()->route('front.vendorInvoice.index')->with('insert', 'Record Inserted successfully');
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
        
        $pos =  VendorPo::where('user_id',auth()->user()->id)->get();   
        $invoice = VendorInvoice::find($id);
        // dd($invoice);
        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'Edit Invoice',
            'invoice'   => $invoice,
        ];
        
        return view('vendor-dashboard.invoice.edit', compact('payload','pos'));
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
        $request->validate([
            'lpo_ref' => 'required',
            'delivery_date' => 'required',
            'category' => 'required',
            'invoice_ref_no' => 'required',
            'total_value' => 'required',
            // 'upload_invoice_copy' => 'required',
            // 'upload_qtn_copy' => 'required',
            // 'upload_lpo_copy' => 'required',
        ]);
        $invoice = VendorInvoice::find($id);
        
        if ($request->hasFile('upload_lpo_copy')) {

            if($invoice->upload_lpo_copy != ""){
                Storage::delete('public/vendor/'.$invoice->upload_lpo_copy);   
             }

            $file = $request->file('upload_lpo_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $invoice->upload_lpo_copy = $fileName;
        }

        if ($request->hasFile('upload_qtn_copy')) {

            if($invoice->upload_qtn_copy != ""){
                Storage::delete('public/vendor/'.$invoice->upload_qtn_copy);   
             }

            $file = $request->file('upload_qtn_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $invoice->upload_qtn_copy = $fileName;
        }
        
        if ($request->hasFile('upload_invoice_copy')) {

            if($invoice->upload_invoice_copy != ""){
                Storage::delete('public/vendor/'.$invoice->upload_invoice_copy);   
             }

            $file = $request->file('upload_invoice_copy');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $invoice->upload_invoice_copy = $fileName;
        }

        $invoice->lpo_ref = request('lpo_ref');
        $invoice->delivery_date = request('delivery_date');
        $invoice->category = request('category');
        $invoice->invoice_ref_no = request('invoice_ref_no');
        $invoice->total_value = request('total_value');
        $invoice->status = 'Received For Authentication';
        $invoice->save();

        $admin_mail = Settings::select('settings_email_from_address')->first()->settings_email_from_address;
        Mail::to($admin_mail)->send(new VendorInvoiceMail($invoice));
        /** ----------------------------------------------
         * record event [invoice updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendor_invoice_updated',
            'event_item_id' => '',
            'event_item_lang' => 'vendor_invoice_updated',
            'event_item_content' => $invoice->invoice_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'invoice',
            'event_parent_id' => $invoice->id,
            'event_parent_title' => $invoice->invoice_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'invoice',
            'eventresource_id' => $invoice->id,
            'event_notification_category' => 'notifications_invoice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            

        }
        
        return redirect()->route('front.vendorInvoice.index')->with('update', 'Record Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = VendorInvoice::find($id);
        if($invoice->upload_lpo_copy != ""){
            Storage::delete('public/vendor/'.$invoice->upload_lpo_copy);   
         }
         if($invoice->upload_invoice_copy != ""){
            Storage::delete('public/vendor/'.$invoice->upload_invoice_copy);   
         }
         if($invoice->upload_qtn_copy != ""){
            Storage::delete('public/vendor/'.$invoice->upload_qtn_copy);   
         }

         /** ----------------------------------------------
         * record event [invoice deleted]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vendor_invoice_deleted',
            'event_item_id' => '',
            'event_item_lang' => 'vendor_invoice_deleted',
            'event_item_content' => $invoice->invoice_ref_no,
            'event_item_content2' => '',
            'event_parent_type' => 'invoice',
            'event_parent_id' => $invoice->id,
            'event_parent_title' => $invoice->invoice_ref_no ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'invoice',
            'eventresource_id' => $invoice->id,
            'event_notification_category' => 'notifications_invoice_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            

        }
         $invoice->delete();
         return redirect()->route('front.vendorInvoice.index')->with('delete', 'Record Deleted successfully');
         
    }
}
