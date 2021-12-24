<?php

namespace App\Http\Controllers\FrontVendor;

use PDF;
use App\EachRfq;
use App\Models\User;
use App\Models\VendorPo;
use App\Models\VendorRfq;
use App\Models\Attachment;
use App\Models\FrontBanner;
use Illuminate\Http\Request;
use App\Models\VendorInvoice;
use App\Models\VendorQuotation;
use App\FrontVendorRegistration;
use App\Mail\VendorRegisterMail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\VendorRfqs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Storage;

class FrontVendorController extends Controller
{

    protected $eventrepo;
    public function __construct(EventRepository $eventrepo) {
        //parent
        parent::__construct();
        $this->eventrepo = $eventrepo;
    }
    
    public function index()
    {
        $rfqs_count = EachRfq::where('user_id', auth()->user()->id)->count();
        $qtns_count = VendorQuotation::where('user_id',auth()->user()->id)->count();
        $po_count  = VendorPo::where('user_id', auth()->user()->id)->count();
        $invoices_count = VendorInvoice::where('user_id', auth()->user()->id)->count();

        $payload = [
            'mainmenu_user ' => 'active',
            'page_title' => 'Vendor Dashboard',
            
        ];

        return view('vendor-dashboard.index', compact('payload','rfqs_count','qtns_count','po_count','invoices_count'));
    }

    public function helpView()
    {
        $payload = [
            'mainmenu_user ' => 'active',
            'page_title' => 'Vendor Help',
        ];

        return view('vendor-dashboard.help.help',compact('payload'));
    }
    
    public function register() //show registration form
    {
        if(!auth()->user()){
            return view('front-end.register.vendor-registration');
        }else{
            return redirect()->route('front.vendor.login')->with('message','You Are Already Logged in !!!');
        }
    }


    
    public function vendorLoginForm() //show login form
    {
        $banner = FrontBanner::find(60);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')->first();
        $loginTitle = 'Vendor ';
        return view('front-end.login.vendor-login',compact('banner','attachment','loginTitle'));
    }


    //opration when the user click the login mean he submit email and password
    public function vendorLoginSuccess(Request $request) 
    {
        $user = User::where('email',$request->email)->first();
        if($user)
        {
            if($user->vendor == 1){
                //if the user is vendor and active
                if ($user->status == 'active') {
                    $credentials = $request->only('email', 'password');
                    // if the credentials are true
                if (Auth::attempt($credentials)) 
                {
                    return redirect()->route('front.vendor.index');
                }
                // if the credentials are not true then return
                else
                {
                    return redirect()->route('front.vendor.login')->with('message','Invalid Credentials');
                }
                }//active condition ends here


                // if the user is vendor but suspended
                elseif($user->status == 'suspended')
                {
                return redirect()->route('front.vendor.login')->with('message','Your Account Has Been Suspended');
                }
                // if the user is vendor but not verified
                elseif($user->status == 'unverified')
                {
                return redirect()->route('front.vendor.login')->with('message','Your Account Has Not Verified');
                }
            }
            //if the user is other than the vendor
            else{
            return redirect()->route('front.vendor.login')->with('message','Only Vendors Can Log in');
            }
        }
        // if there is no records found
        else
        {
            return redirect()->route('front.vendor.login')->with('message','No Records Found !!');
        }
    }

    public function profileSetting()
    {
        if(auth()->user()){
            $user = User::find(auth()->user()->id);
            $vendor = FrontVendorRegistration::where('user_id', auth()->user()->id)->first();
            // dd($user->fvendor);
            $payload = [
                'page_title' => 'Profile Settings',
                'user' => $user,
                'vendor' => $vendor,
            ];
            return view('vendor-dashboard.profile.profile-setting',compact('payload'));
        }
        else{
            return redirect()->back();
        }
    }

    public function UpdateProfileSetting(Request $request, $id)
    {       
        $request->validate([
            'email' => 'required',
            'vendor_company_name' => 'required',
            'commercial_registration_no' => 'required',
            'trade_license_no' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'position' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'category' => 'required',
        ]);
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->position = $request->input('position');
        $user->phone = $request->input('phone');
        $user->email  = $request->input('email');
        $user->company_name  = $request->input('vendor_company_name');
        
        $user->update();

        $vendor = FrontVendorRegistration::where('user_id', $id)->first();
        $vendor->vendor_company_name = request('vendor_company_name');
        $vendor->commercial_registration_no = request('commercial_registration_no');
        $vendor->trade_license_no = request('trade_license_no');
        $vendor->email  = request('email');
        $vendor->office_telephone_no = request('office_telephone_no');
        $vendor->address = request('address');
        $vendor->po_box = request('po_box');
        $vendor->category = implode(',',request('category'));

        
        //for company_profile
        if ($request->hasFile('company_profile')) {
            if($vendor->company_profile != ""){
                Storage::delete('public/vendor/'.$vendor->company_profile);   
            }

            $file = $request->file('company_profile');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $vendor->company_profile = $fileName;
        }

        //company_commercial_license
        if ($request->hasFile('company_commercial_license')) {
            if($vendor->company_commercial_license != ""){
                Storage::delete('public/vendor/'.$vendor->company_commercial_license);   
            }

            $file = $request->file('company_commercial_license');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $vendor->company_commercial_license = $fileName;
        }

        //other_documents
        if ($request->hasFile('other_documents')) {
            if($vendor->other_documents != ""){
                Storage::delete('public/vendor/'.$vendor->other_documents);   
            }

            $file = $request->file('other_documents');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $vendor->other_documents = $fileName;
        }


        // dd($vendor);
        $vendor->save();

        $data = [
            'event_creatorid' => $user->id,
            'event_item' => 'vendor_updated',
            'event_item_id' => '',
            'event_item_lang' => 'vendor_updated',
            'event_item_content' => $user->company_name,
            'event_item_content2' => '',
            'event_parent_type' => 'Vendor Updated Profile',
            'event_parent_id' => $user->id,
            'event_parent_title' => $user->company_name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => $user->id,
            'eventresource_type' => 'vendor',
            'eventresource_id' => $user->id,
            'event_notification_category' => 'notifications_vendor_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            
        }

        return redirect()->route('front.vendor.index')->with('update','Account Has Been Updated');
    }

    public function vendorLogOut(Request $request) {
        Auth::logout();
        return redirect()->route('front.index');
      }

      //user registration 
    public function store(Request $request)
    {
        $request->validate([
            // 'g-recaptcha-response' => 'required|captcha',
            'email' => 'required|unique:users',
            'vendor_company_name' => 'required',
            'commercial_registration_no' => 'required',
            'trade_license_no' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'position' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'category' => 'required',
            'company_profile' => 'required',
            'company_commercial_license' => 'required',
        ],[ 'g-recaptcha-response.required'=> trans('fl.Captcha Required'), ]);

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->position = $request->input('position');
        $user->company_name  = request('vendor_company_name');
        $user->phone = $request->input('phone');
        $user->email  = $request->input('email');
        $user->vendor  =  1;
        $user->type  =  'vendor';
        $user->status  =  'unverified';
        $user->password= Hash::make(request('password'));
        $user->save();

        $vendor = new FrontVendorRegistration();
        $vendor->vendor_company_name = request('vendor_company_name');
        $vendor->commercial_registration_no = request('commercial_registration_no');
        $vendor->trade_license_no = request('trade_license_no');
        $vendor->title = request('title');
        $vendor->email  = $request->input('email');
        $vendor->office_telephone_no = request('office_telephone_no');
        $vendor->address = request('address');
        $vendor->po_box = request('po_box');
        $vendor->company_association = request('company_association');
        $vendor->learn_about_compnay = request('learn_about_compnay');
        $vendor->category = implode(',',$request->category);

        //for company_profile
        if ($request->hasFile('company_profile')) {
            $file = $request->file('company_profile');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $vendor->company_profile = $fileName;
        }else{
            $vendor->company_profile = "";
        }
        
        //for company_commercial_license
        if ($request->hasFile('company_commercial_license')) {
            $file = $request->file('company_commercial_license');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $vendor->company_commercial_license = $fileName;
        }else{
            $vendor->company_commercial_license = "";
        }

        //for other_documents
        if ($request->hasFile('other_documents')) {
            $file = $request->file('other_documents');
            $fileName = time().$file->getClientOriginalName();
            Storage::put('public/vendor/'.$fileName,file_get_contents($file));
            $vendor->other_documents = $fileName;
        }else{
            $vendor->other_documents = "";
        }

        

        $user->fvendor()->save($vendor);
        
        /** ----------------------------------------------
         * record event [vendorrfq created]
         * ----------------------------------------------*/

        $data = [
            'event_creatorid' => $user->id,
            'event_item' => 'vendor_created',
            'event_item_id' => '',
            'event_item_lang' => 'vendor_created',
            'event_item_content' => $user->company_name,
            'event_item_content2' => '',
            'event_parent_type' => 'Vendor Registered',
            'event_parent_id' => $user->id,
            'event_parent_title' => $user->company_name ?? '',
            'event_show_item' => 'yes',
            'event_show_in_timeline' => 'yes',
            'event_clientid' => $user->id,
            'eventresource_type' => 'vendor',
            'eventresource_id' => $user->id,
            'event_notification_category' => 'notifications_vendor_activity',
        ];

        //record event
        if ($event_id = $this->eventrepo->create($data)) {
            //get users
            
        }

        $data = [
            'name' => $request->input('first_name') .' '. $request->input('last_name'),
            'email' => $request->input('email'), 
            'password' => $request->input('password'),
            'url'   => $url = env('APP_URL').'/front/vendor/login',
        ];
        Mail::to($request->input('email'))->send(new VendorRegisterMail($data));

        return redirect()->route('front.vendor.login')
        ->with('message','Please Wait Until Your Account Will Be Verified And Approved');
        
    }

   
}
