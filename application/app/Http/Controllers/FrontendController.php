<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use App\Models\FProduct;
use App\Mail\ComplainMail;
use App\Models\FCategory;
use App\Models\CareerApply;
use App\Models\CorporateService;
use App\Models\FrontBanner;
use App\Models\FrontCareer;
use App\Models\FrontClient;
use App\Models\FrontProject;
use Illuminate\Http\Request;
use App\Property as AppProperty;
use Illuminate\Support\Facades\Storage;
use App\Models\Service;
use Illuminate\Validation\Rules\Unique;
use App\Http\Controllers\User as ControllersUser;
use App\Mail\BookingEmailToEmployee;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingEmailToAdminuser;
use App\Mail\BookingEmailToClient;
use App\Models\EmployeeBooking;
use App\Models\FrontEndProperty;
use App\Models\UserSchedule;
use App\Models\Settings;
use Carbon\Carbon;
use DB;
use App\Models\EmailList;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mail\LegalRegistration;
use App\Models\SubCorporateService;
use App\Models\SubProduct;

class FrontendController extends Controller
{
    public function index()
    {
        $attachments = \App\Models\Attachment::Where('attachmentresource_type', 'frontclient')->get();
        $services = CorporateService::all();
        $data['veteranText'] = FrontBanner::find(78);
        $data['whyChooseText'] = FrontBanner::find(71);
        $data['bmps'] = FrontBanner::whereIn('id', [72, 73, 74, 75, 76, 77])->get();    
        return view('front-end.index',compact('attachments','services','data'));

    }

    public function know_us()
    {
        $banner = FrontBanner::find(19);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.know-us.know-us', compact('banner', 'attachment'));
    }

    public function vision_mission()
    {
        $banner = FrontBanner::find(18);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.vision-mission.vision-mission', compact('banner', 'attachment'));
    }

    public function board_members()
    {
        $banner = FrontBanner::find(17);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.board-members.board-members', compact('banner', 'attachment'));
    }

    public function board_members_message()
    {
        $banner = FrontBanner::find(16);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.board-members-message.board-members-message', compact('banner', 'attachment'));
    }

    public function why_choose_us()
    {
        $banner = FrontBanner::find(15);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.why-choose-us.why-choose-us', compact('banner', 'attachment'));
    }

    public function business_ethics()
    {
        $banner = FrontBanner::find(14);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.business-ethics.business-ethics', compact('banner', 'attachment'));
    }

    public function organization_chart()
    {
        $banner = FrontBanner::find(51);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.organization-chart.organization-chart', compact('banner', 'attachment'));
    }


    public function retail_services()
    {
        $banner = FrontBanner::find(52);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();

        $services = Service::paginate(25);
        $services_id = Service::pluck('id');
        $attachments = Attachment::where('attachmentresource_type', 'services')
            ->whereIn('attachmentresource_id', $services_id)
            ->get();
        return view('front-end.our-services.services', compact('services', 'attachments', 'banner', 'attachment'));
    }

    public function show_service($id)
    {
        
         $banner = FrontBanner::find(66);
        
        $service_id = $id;
        $service = Service::findOrFail($id);
        $user_services = DB::table('user_service')->where('service_id', $id)->pluck('user_id');
        $users = User::where('is_employee', 1)
            ->whereIn('id', $user_services)->get();

        return view('front-end.our-services.service-details', compact('users', 'service_id', 'service','banner'));
    }

        public function corporate_services()
    {
        $banner = FrontBanner::find(12);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();

        $services = CorporateService::all();
        $attachments = \App\Models\Attachment::Where('attachmentresource_type', 'corporateservice')
            ->get();
        return view('front-end.corporate-services.corporate-services', compact('services', 'attachments', 'banner', 'attachment'));
    }

    public function SingleCorporateServices($id)
    {
        $service = CorporateService::findOrFail($id);
        $subservices = SubCorporateService::where('corporateservice_id', $id)->get();
        $subattachments = \App\Models\Attachment::Where('attachmentresource_type', 'subcorporateservice')
        ->get();
        $attachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
            ->Where('attachmentresource_type', 'corporateservice')->get();

        return view('front-end.corporate-services.single-corporate-service', compact('service', 'attachments','subservices','subattachments'));
    }


    public function categoryWiseProducts($id)
    {
        $products = FProduct::where('f_category_id', $id)->get();
        $category = FCategory::find($id);

        $banner = FrontBanner::where('title', $category->name)->first();
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();


        $attachments = \App\Models\Attachment::Where('attachmentresource_type', 'fproduct')
            ->get();
        return view('front-end.category-wise-proudcts.category-wise-proudcts', compact('products', 'category', 'attachments', 'banner', 'attachment'));
    }

    public function frontProductDetails($id)
    {
        $product = FProduct::find($id);
        $product_attachment = \App\Models\Attachment::select('attachment_uniqiueid', 'attachment_filename')->Where('attachmentresource_id', $product->id)->Where('attachmentresource_type', 'fproduct')->first();

        $subproducts = SubProduct::where('f_product_id', $id)->get();
        $subattachments = \App\Models\Attachment::Where('attachmentresource_type', 'subproduct')->get();
        return view('front-end.category-wise-proudcts.detail-product',compact('product',
        'product_attachment','subproducts', 'subattachments'));
    }

    public function enivromental_policy()
    {
        $banner = FrontBanner::find(4);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.our-policies.enviromental-policy.enviromental-policy', compact('banner', 'attachment'));
    }

    public function health_safety_policy()
    {
        $banner = FrontBanner::find(3);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.our-policies.health-safety-policy.health-safety-policy', compact('banner', 'attachment'));
    }

    public function quality_assurance_policy()
    {
        $banner = FrontBanner::find(2);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.our-policies.quality-assurance-policy.quality-assurance-policy', compact('banner', 'attachment'));
    }

    public function contact_us()
    {
        $banner = FrontBanner::find(21);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.contact-us.contact-us', compact('banner', 'attachment'));
    }

    public function career()
    {
        $banner = FrontBanner::find(42);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.careers.career', compact('banner', 'attachment'));
    }


    public function careerApplyNow($category = '', $position = '')
    {
        $banner = FrontBanner::find(1);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();

        $category = $category;
        $position = $position;
        return view('front-end.careers.career-apply', compact('category', 'position', 'banner', 'attachment'));
    }


    public function careerApplyNowSubmit(Request $request)
    {
    }

    public function careerCurrentOpennings()
    {
        $banner = FrontBanner::find(20);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();

        $careers  = FrontCareer::where('status', 'OPEN')->get();
        return view('front-end.careers.career-current-openning', compact('careers', 'banner', 'attachment'));
    }


    public function about_us()
    {
        return view('frontEnd.about-us.about-us');
    }

    public function our_clients()
    {
        $banner = FrontBanner::find(11);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();


        $clients = FrontClient::all();
        $attachments = \App\Models\Attachment::Where('attachmentresource_type', 'frontclient')
            ->get();
        return view('front-end.our-clients.our-clients', compact('clients', 'attachments', 'banner', 'attachment'));
    }

    public function our_projects()
    {
        $banner = FrontBanner::find(10);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();

        $projects = FrontProject::where('contractor', '!=', 'addImgDesc')->get();
        $main = FrontProject::where('contractor', 'addImgDesc')->first();
        $attachments = \App\Models\Attachment::Where('attachmentresource_type', 'frontproject')
            ->get();
        return view('front-end.our-projects.our-projects', compact('projects', 'main', 'attachments', 'banner', 'attachment'));
    }


    // front properties routes
    public function frontProperties()
    {
        
        $properties = FrontEndProperty::with('user')
            ->where('is_approved', 1)
            ->latest()
            ->paginate(20);
        $banner = FrontBanner::where('id', 64)->first();
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.properties-managment.front-properties', compact('properties', 'attachment', 'banner'));
    }
    public function frontPropertyDetails($id)
    {
        $banner = FrontBanner::where('id', 64)->first();
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        $property = FrontEndProperty::with('user')->find($id);
        return view('front-end.properties-managment.detail-property', compact('property','banner','attachment'));
    }

    // properties create form
    public function createProperty()
    {
        return view('front-end.properties-managment.create-property');
    }

    // store property
    public function storeProperty()
    {
        $data = $this->validate(request(), [
            'title' => 'required',
            'g-recaptcha-response' => 'required|captcha',
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
            'images' => 'required',
            'status' => 'required',
            'amminities' => 'required',
        ], ['g-recaptcha-response.required' => trans('fl.Captcha Required'),]);


        if (request()->hasFile('images')) {
            foreach (request()->file('images') as $file) {
                $fileName = time() . $file->getClientOriginalName();
                Storage::put('public/frontuser/' . $fileName, file_get_contents($file));
                $image[] = $fileName;
            }
        }

        $user = FrontEndProperty::create([
            'user_id' => auth()->user()->id,
            'title' => $data['title'],
            'rent_or_sale' => $data['rent_or_sale'],
            'property_type' => $data['property_type'],
            'bedroom' => $data['bedrooms'],
            'price' => $data['price'],
            'builtup_area' => $data['builtup_area'],
            'description' => $data['description'],
            'reference_no' => $data['reference_no'],
            'community' => $data['community'],
            'sub_community' => $data['sub_community'],
            'parking' => $data['parking'],
            'primary_unit_view' => $data['primary_unit_view'],
            'images' => implode(',', $image),
            'amminities' => implode(',', request()->amminities),
            'status' => request('status'),
            'property_status' => request('property_status'),
        ]);
        return redirect()->route('front.property.index')->with('message', 'Property added successfully');
    }

    public function searchProperty(Request $request)
    {
        $banner = FrontBanner::where('id', 64)->first();
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        // dd(request()->all());
        $properties = FrontEndProperty::where('is_approved', 1)
            ->when(request()->rent_or_sale, function ($query) {
                $query->where('rent_or_sale', request()->rent_or_sale);
            })
            ->when(request()->property_type, function ($query) {
                $query->orWhere('property_type', 'LIKE', '%' . request()->property_type . '%');
            })
            ->when(request()->bedrooms, function ($query) {
                $query->orWhere('bedroom', 'LIKE', '%' . request()->bedrooms . '%');
            })
            ->when(request()->price_from, function ($query) {
                $query->orWhere('price', 'LIKE', '%' . request()->price_from . '%');
            })
            ->when(request()->price_to, function ($query) {
                $query->orWhere('price', 'LIKE', '%' . request()->price_to . '%');
            })
            ->when(request()->parking, function ($query) {
                $query->orWhere('parking', 'LIKE', '%' . request()->parking . '%');
            })->paginate();

        return view('front-end.properties-managment.front-properties', compact('properties', 'banner', 'attachment'));
    }

    public function fetchEmployee(Request $request)
    {
        $user = User::where('id', request('id'))
            ->select('first_name', 'email', 'phone', 'description')
            ->first();
        return response()->json($user);
    }

    public function fetchEmployeeSchedules(Request $request)
    {
        $date = Carbon::now();
        $current_date = Carbon::parse($date)->format('Y-m-d');
        dd($current_date);
        $user = UserSchedule::where('user_id', request('id'))
            ->where('is_booked', 0)
            ->whereDate('start', '>=', $current_date)
            ->select('id', 'start', 'end', 'end_time', 'start_time', 'user_id')
            ->get();
        dd($user);
        return response()->json($user);
    }

    public function storeBooking(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'email' => 'required',
            'full_name' => 'required',
            'telephone' => 'required',
        ]);
        try {
            $booking = EmployeeBooking::create([
                'service_id' => $request->service,
                'user_schedule_id' => $request->schedule_id,
                'employee_id' => $request->employee,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->telephone,
                'street_no' => $request->street_no,
                'service_address' => $request->service_address ?? '',
                'bldg_no' => $request->bldg_no,
                'unit_no' => $request->unit_no,
                'zone_no' => $request->zone_no,
                'payment_type' => $request->payment_type,
                'price' => $request->price ?? '',
                'description' => $request->description ?? '',
            ]);

            // get employe email
            $user = User::where('id', $booking->employee_id)->select('first_name', 'email')->first();
            $schedules = UserSchedule::where('id', $booking->user_schedule_id)->first();
            $schedules->is_booked = 1;
            $schedules->save();

            $service = Service::where('id', $booking->service_id)->first();
            $admin_mail = Settings::select('settings_email_from_address')->first()->settings_email_from_address;

            // send mail to user
            $url = $request->root();
            $user_data = [
                'service' => $service->title,
                'name' => $booking->full_name,
            ];
            $user_email = new \App\Mail\BookingEmailToClient($booking->email, $booking->id, $url, $user_data);
            $user_email->build();

            // send mail to employee
            $mail = new \App\Mail\BookingEmailToEmployee($booking, $schedules, $service, $user->email, $user->full_name, $url);
            $mail->build();

            // mail to admin
            $aministration_emails = EmailList::select('email')->get();
            if ($aministration_emails) {
                foreach ($aministration_emails as  $admin_email) {
                    $admin_e = new \App\Mail\BookingEmailToAdminuser($booking, $service, $admin_email->email, $user->first_name);
                    $admin_e->build();
                }
            }
            // $admin_e = new \App\Mail\BookingEmailToAdminuser($booking, $service, $admin_mail);
            // $admin_e->build();
        } catch (\Throwable $th) {
            return redirect()->route('front.retail-services')->with('error', $th->getMessage());
        }

        return redirect()->route('front.retail-services')->with('success', 'Your request has been submitted successfully please check your email, Our team will contact you soon');
    }


    public function updateBookingStatus(Request $request)
    {
        $id = $request->id;
        $booking = EmployeeBooking::where('id', $id)
            ->where('employee_id', auth()->id())
            ->first();
        $booking->status = $request->status;
        $booking->update();
        return back()->with('success', 'Status Changed Successfully');
    }


    public function employeeDashboard()
    {
        $user_schedules = EmployeeBooking::with('service', 'userSchedule')->where('employee_id', auth()->id())->latest()->get();
        return view('front-end.employee-dashboard.employee-dashboard', compact('user_schedules'));
    }

    public function ScheduleView(Request $request, $id = null, $serviceid = null)
    {
        $date = Carbon::now();
        $current_date = Carbon::parse($date)->format('Y-m-d');
        $service_id = $serviceid;
        if ($request->ajax()) {
            $user = $request->id;
            $data = UserSchedule::whereDate('start', '>=', $request->start)
                ->where('user_id', $user)
                ->where('is_booked', 0)
                ->whereDate('start', '>=', $current_date)
                ->get();
            foreach ($data as $d) {
                $d['start'] = $d->start . ' ' . $d->start_time;
                $d['end'] = $d->end . ' ' . $d->end_time;
                // $data['allDay'] = false;
            }
            // dd($data);
            return response()->json($data);
        }
        return view('front-end.our-services.employee-service-schedules', compact('id', 'service_id'));
    }


    public function storeSchedule(Request $request)
    {
        // dd($request->all());
        switch ($request->type) {
            case 'crseate':
                $event = UserSchedule::create([
                    'user_id' => $request->user_id,
                    'title' => $request->event_name,
                    'start' => $request->event_start,
                    'end' => $request->event_end,
                    'start_time' => $request->event_start_time,
                    'end_time' => $request->event_end_time,
                ]);

                return response()->json($event);
                break;

            case 'edist':
                $event = UserSchedule::find($request->id);
                $event->title = $request->title;
                $event->start = $request->start;
                $event->start_time = $request->event_start_time;
                $event->end_time = $request->event_end_time;
                $event->user_id = $request->user_id;
                $event->save();
                return response()->json($event);
                break;

            case 'delsete':
                $event = 'here';
                return response()->json($event);
                break;

            default:
                # ...
                break;
        }
    }

    public function pdfDownload($id)
    {
        try {
            $userBooking = EmployeeBooking::with('userSchedule', 'service')->where('id', $id)->firstOrFail();

            $pdf = PDF::loadView('front-end.our-services.booking-invoice', compact('userBooking'));
            $filename = 'booking-invoice-' . rand(3000, 9999) . '.pdf';
            return $pdf->download($filename);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        // return view('front-end.our-services.booking-invoice', compact('userBooking'));
    }

    public function submitComplain(Request $request, $type = null)
    {
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ], ['g-recaptcha-response.required' => trans('fl.Captcha Required'),]);

        $data = [
            'type' => $type,
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'subject' => request('subject'),
            'message' => request('message'),
        ];

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = time() . $file->getClientOriginalName();
            Storage::put('public/complain/' . $fileName, file_get_contents($file));
            $data += ['mime' => $file->getClientOriginalExtension()];
            $data += ['attachment' => $fileName];
        }


        $admin_mail = Settings::select('settings_email_from_address')->first()->settings_email_from_address;
        // Mail::to('complaint@vgc-qatar.com')->send(new ComplainMail($data));
        Mail::to($admin_mail)->send(new ComplainMail($data));
        if ($request->hasFile('attachment')) {
            Storage::delete('public/complain/' . $fileName);
        }
        return redirect()->back()->with('success', 'Email Has Been Successfully Sent');
    }

    public function footerOurPolicies()
    {
        $banner = FrontBanner::find(48);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.our-policies.our-policies', compact('banner', 'attachment'));
    }

    public function footerAllRightsReserved()
    {
        $banner = FrontBanner::find(46);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.all-rights-reserved.all-rights-reserved', compact('banner', 'attachment'));
    }

    public function footerTermsCondition()
    {
        $banner = FrontBanner::find(45);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.terms-condition.terms-condition', compact('banner', 'attachment'));
    }

    public function footerPrivacyPolicy()
    {
        $banner = FrontBanner::find(54);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.privacy-policy.privacy-policy', compact('banner', 'attachment'));
    }

    public function footerSubscribtionPolicy()
    {
        $banner = FrontBanner::find(50);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.subscription-policy.subscription-policy', compact('banner', 'attachment'));
    }

    public function footerCookiesPolicy()
    {
        $banner = FrontBanner::find(53);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.cookies-policy.cookies-policy', compact('banner', 'attachment'));
    }

    public function footerlegalRegistration()
    {
        $banner = FrontBanner::find(47);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.legal-registration.legal-registration', compact('banner', 'attachment'));
    }


    public function legalRegistrationMail(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
            'vendor_company_name' => 'required',
            'commercial_registration_no' => 'required',
            'title' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'position' => 'required',
            'email' => 'required',
            'office_telephone_no' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'po_box' => 'required',
            'purpose' => 'required',
        ], ['g-recaptcha-response.required' => trans('fl.Captcha Required'),]);

        $data = [
            'vendor_company_name' => request('vendor_company_name'),
            'commercial_registration_no' => request('email'),
            'title' => request('title'),
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'position' => request('position'),
            'email' => request('email'),
            'office_telephone_no' => request('office_telephone_no'),
            'phone' => request('phone'),
            'address' => request('address'),
            'po_box' => request('po_box'),
            'purpose' => request('purpose'),
        ];
        
        $admin_mail = Settings::select('settings_email_from_address')->first()->settings_email_from_address;
        // Mail::to('complaint@vgc-qatar.com')->send(new LegalRegistration($data));
        Mail::to($admin_mail)->send(new LegalRegistration($data));
        return redirect()->back()->with('success', 'Form Submitted Successfully');
    }

    public function CAFMportal()
    {
        $banner = FrontBanner::find(63);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.CAFM-login.CAFM-login', compact('banner', 'attachment'));
    }
    public function individualServicePolicy()
    {
        $banner = FrontBanner::find(59);
        $attachment = \App\Models\Attachment::Where('attachmentresource_id', $banner->id)
            ->Where('attachmentresource_type', 'frontbanner')
            ->first();
        return view('front-end.cookies-policy.cookies-policy', compact('banner', 'attachment'));
    }
    
    public function SingleSubcorporateServices($id)
    {
        $subservice = SubCorporateService::findOrFail($id);
        $subattachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
        ->Where('attachmentresource_type', 'subcorporateservice')->get();

        return view('front-end.corporate-services.single-subcorporate-service', compact('subattachments','subservice'));   
    }

    public function singleSubProduct($id)
    {
        $subproduct = SubProduct::findOrFail($id);
        $subattachments = \App\Models\Attachment::Where('attachmentresource_id', $id)
        ->Where('attachmentresource_type', 'subproduct')->get();

        return view('front-end.category-wise-proudcts.subproduct-details', compact('subattachments','subproduct'));
    }
}
