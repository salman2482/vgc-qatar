<?php

namespace App\Http\Controllers\FrontVendor;

use App\EachRfq;
use App\Models\User;
use App\Models\RItem;
use App\Models\Settings;
use App\Models\VendorRfq;
use App\Mail\VendorRFQMail;
use App\Models\RfqMaterial;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Repositories\EventRepository;

class FrontVendorRfqController extends Controller
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
        $user = auth()->user();
        $userId = $user->id;
        

        $ids = EachRfq::where('user_id', auth()->user()->id)->pluck('vendor_rfq_id');

        $vgcs =  VendorRfq::whereIn('id',$ids)->get();
        
        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'RFQ',
        ];
        return view('vendor-dashboard.vgc-rfq.index', compact('payload','vgcs','userId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('front.vendor.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        return redirect()->route('front.vendor.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vgc = VendorRfq::find($id);
        if(isset($vgc)){
        }else{
            $vgc = VendorRfq::where('rfq_ref', $id)->first();
            $rfqmaterials = RfqMaterial::where('rfq_id', $vgc->id)->get();
        }
        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'RFQ Details',
            'vgc' => $vgc,
            'rfqmaterials' => $rfqmaterials,
        ];
        return view('vendor-dashboard.vgc-rfq.show', compact('payload'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vgc = VendorRfq::find($id);
        $payload = [
            'mainmenu_user' => 'active',
            'page_title' => 'Edit RFQ',
            'vgc'   => $vgc,
        ];
        
        return view('vendor-dashboard.vgc-rfq.edit', compact('payload'));
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
        $vgc = EachRfq::where('user_id', auth()->user()->id)->where('vendor_rfq_id',$id)->first();
        $oldStatus = $vgc->status;
        $vgc->status = request('status');
        $vgc->save();

        if($oldStatus != request('status')){
            $data['user'] = User::find($vgc->user_id);
            $data['vgc'] = $vgc;
            $data['rfq'] = VendorRfq::find($vgc->vendor_rfq_id);
            $admin_mail = Settings::select('settings_email_from_address')->first()->settings_email_from_address;
            Mail::to($admin_mail)->send(new VendorRFQMail($data));
        }


        /** ----------------------------------------------
         * record event [vgc updated]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => auth()->id(),
            'event_item' => 'vgc_updated',
            'event_item_id' => '',
            'event_item_lang' => 'vgc_updated',
            'event_item_content' => $vgc->vendor_rfq_id,
            'event_item_content2' => '',
            'event_parent_type' => 'Vendor Changed Status',
            'event_parent_id' => $vgc->id,
            'event_parent_title' => $vgc->vendor_rfq_id ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => auth()->id(),
            'eventresource_type' => 'Vendor Changed Status',
            'eventresource_id' => $vgc->id,
            'event_notification_category' => 'notifications_vgc_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            
        }
        return redirect()->route('front.vendorVgc.index')->with('update', 'RFQ '.request('status').' successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('front.vendor.index');

    }

    public function createPdf($canidateId, $userId)
    {
        $user = User::find($userId); 
        $rfq = VendorRfq::find($canidateId);
        $materials = RfqMaterial::where('rfq_id', $rfq->id)->get();
        
        $pdf = PDF::loadView('users.rfq',compact('rfq','user','materials'));
        return $pdf->download('Request For Quotation.pdf');
        // return view('users.rfq',compact('rfq','user','materials'));
    }
}
