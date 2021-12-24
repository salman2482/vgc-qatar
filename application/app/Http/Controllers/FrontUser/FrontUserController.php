<?php

namespace App\Http\Controllers\FrontUser;

use App\Models\User;
use App\Models\Settings;
use App\Models\FrontUser;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use App\Models\FrontBanner;
use App\Mail\RegisterAdminMail;
use App\Mail\VendorRegisterMail;
use App\Models\FrontEndProperty;
use App\Http\Controllers\Property;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FrontUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userLoginForm($loginTitle = null) //show login form
    {
        $banner = FrontBanner::find(60);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')->first();
        return view('front-end.FrontEndUser.user-login',compact('banner','attachment','loginTitle'));
    }

    public function userLoginAction(Request $request) //login action
    {
      
        $user = User::where('email', $request->email)->firstOrFail();
        if ($user->clientid != null || $user->clientid != '') {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                if (auth()->user()->is_client) {
                    if ($client = \App\Models\Client::Where('client_id', auth()->user()->clientid)->first()) {
                        if ($client->client_status != 'active') {
                            abort(409, __('lang.account_has_been_suspended'));
                        }
                        return redirect('/home');
                    }
                }
            }
        }

        if ($user) {
            if ($user->is_employee == 1) {
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    return redirect('/');
                }
            } else {
                return redirect()->route('front.user.login')->with('message', 'Invalid Credentials');
            }
        }

        $front_user = FrontUser::where('user_id', $user->id)->firstOrFail();

        if ($front_user->status == 'inactive') {
            return redirect()->back()->with('message', 'Your Account Is Not Verified Yet !! Please Wait');
        }

        if ($front_user->status == 'suspended') {
            return redirect()->back()->with('message', 'Your Account Has Been Suspended By The Administration');
        }

        if ($front_user->status == 'active') {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->route('front.property.index');
            }
            // if the credentials are not true then return
            else {
                return redirect()->route('front.user.login')->with('message', 'Invalid Credentials');
            }
        }
        // if there is no records found
        else {
            abort(404);
        }
    }

    public function register() //show registration form
    {
        return view('front-end.FrontEndUser.user-registration');
    }

    public function registerAction(Request $request) // registration action
    {
        $data = $this->validate(request(), [
            'first_name' => 'required',
            'g-recaptcha-response' => 'required|captcha',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'address' => 'required',
            'mobile_number' => 'required',
        ],[ 'g-recaptcha-response.required'=> trans('fl.Captcha Required'), ]);

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->company_name  = request('company_name');
        $user->phone = $request->input('mobile_number');
        $user->email  = $request->input('email');
        $user->password = Hash::make(request('password'));
        $user->is_user = 1;
        $user->status = 'inactive';
        $user->save();

        // dd($user);
        FrontUser::create([
            'company_license_number' => request('company_license_number'),
            'address' => request('address'),
            'user_id' => $user->id,
        ]);

        $data = [
            'name' => $request->input('first_name') . ' ' . $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'first_name' => $request->input('first_name'),
            'url'   => $url = env('APP_URL') . '/front/user/login',
        ];

        // send mail to user
        Mail::to($data['email'])->send(new RegistrationMail($data));

        $admin_mail = Settings::select('settings_email_from_address')->first()->settings_email_from_address;
        Mail::to($admin_mail)->send(new RegisterAdminMail($data));

        return redirect('front/user/login')
            ->with('message', 'you will receive an email once your account is verified and approved');
    }


    public function userDashboard()
    {
        $properties = FrontEndProperty::where('user_id', auth()->user()->id)->where('is_approved', 1)->paginate(20);
        return view('front-end.FrontEndUser.user-dashboard', compact('properties'));
    }

    public function editProperty($id)
    {
        $property = FrontEndProperty::find($id);
        if (auth()->user()->id != $property->user_id) {
            // return redirect()->route('front.property.index')->with('error', 'UnAuthorised Access');
            abort(403);
        }
        return view('front-end/FrontEndUser/edit-property', compact('property'));
    }

    public function updateProperty(Request $request, $id)
    {
        $data = $this->validate(request(), [
            'title' => 'required',
            'rent_or_sale' => 'required',
            'property_type' => 'required',
            'bedrooms' => 'required',
            'price' => 'required',
            'builtup_area' => 'required',
            'description' => 'required',
            'reference_no' => 'required',
            'community' => 'required',
            'sub_community' => 'required',
            'parking' => 'required',
            'primary_unit_view' => 'required',
            'status' => 'required',
            'amminities' => 'required',
        ]);

        $property = FrontEndProperty::find($id);
        // print_r($property);

        if (auth()->user()->id != $property->user_id) {
            return redirect()->route('front.property.index')->with('error', 'UnAuthorised Access');
        }

        if (request()->hasFile('images')) {
            $property->images = '';
            foreach (request()->file('images') as $file) {
                $fileName = time() . $file->getClientOriginalName();
                Storage::put('public/frontuser/' . $fileName, file_get_contents($file));
                $image[] = $fileName;
            }
        }

        $property->user_id = auth()->user()->id;
        $property->title = request()->input('title');
        $property->rent_or_sale = request()->input('rent_or_sale');
        $property->property_type = request()->input('property_type');
        $property->bedroom = request()->input('bedrooms');
        $property->price = request()->input('price');
        $property->builtup_area = request()->input('builtup_area');
        $property->description = request()->input('description');
        $property->reference_no = request()->input('reference_no');
        $property->community = request()->input('community');
        $property->sub_community = request()->input('sub_community');
        $property->parking = request()->input('parking');
        $property->primary_unit_view = request()->input('primary_unit_view');
        $property->images = isset($image) == true ? implode(',', $image) : $property->images;
        $property->amminities = implode(',', request()->input('amminities'));
        $property->property_status = request()->input('property_status');
        $property->update();
        return redirect()->route('front.user.dashboard')->with('message', 'Property updated successfully');
    }

    public function deleteProperty($id)
    {
        $property = FrontEndProperty::findOrFail($id);
        if (auth()->user()->id != $property->user_id) {
            return redirect('front.user.dashboard');
        }
        $property->delete();
        return redirect()->route('front.user.dashboard')->with('message', 'Property Deleted Successfully');
    }
}
