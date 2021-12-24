<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use App\Models\Visitor;
use App\Models\Admin;
use App\Models\User;
Use DB;
use Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     // $this->middleware('guest')->except('logout');
    }




    protected function user(Request $request)
    
    {

       
        Visitor::_save();


        if ($request->isMethod('post')) 
        {
    
            $rules = array(
                'email'                 => 'required|email|string|max:255|exists:App\Models\User,email',     
                'password'              => 'required|max:500'
                
            );
    
    
    
            $validator = validator()->make(request()->all(), $rules);
    
            // check if the validator failed -----------------------
            if ($validator->fails()) 
            {      
                // get the error messages from the validator
               
                return redirect()->back()->withErrors($validator)->withInput()->with('message', 'signin-modal');
              
            } 
            else
             {
    
                   
                    $email = $request->email;
                    $password = $request->password;
                    $remember=true;
                    if($request->remember!=1)
                    {
                        $remember=false;
                    }
    
                    if (Auth::attempt(['email' => $email ,'password' => $password],$remember))
                     {

                        $user = Auth::user();

                        User::where('id', $user->id)->increment('login_count');

                        DB::table('login_log')->insert(
                            ['user_id' =>$user->id,'ip_address' =>$_SERVER['REMOTE_ADDR'],
                            'location' =>session('city'), 'device' =>$_SERVER['HTTP_USER_AGENT'],'created_at' =>now()
                            ]
                        );

                        return redirect('drills');
                     }

                     else
                     {
                        
                        return redirect()->back()->withErrors('Wrong Password')->withInput()->with('message', 'signin-modal');
                     }
                     
                   
               
                   
        
            } 
        
            }

       
        return view('user.login_user');
 
    }


    protected function admin(Request $request)
    
    {

        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');
        Visitor::_save();


        if ($request->isMethod('post')) 
        {
    
            $rules = array(
                'email'                 => 'required|email|string|max:255|exists:App\Models\Admin,email',     
                'password'              => 'required|max:500'
                
            );
    
    
    
            $validator = validator()->make(request()->all(), $rules);
    
            // check if the validator failed -----------------------
            if ($validator->fails()) 
            {
        
                // get the error messages from the validator
               
                return redirect()->back()->withErrors($validator)->withInput();
              
            } else {
    
                   
                    $email = $request->email;
                    $password = $request->password;
                    $remember=true;
                    if($request->remember!=1)
                    {
                        $remember=false;
                    }
    
                    if (Auth::guard('admin')->attempt(['email' => $email ,'password' => $password],$remember))
                     {

                        $user = Auth::guard('admin')->user();

                        Admin::where('id', $user->id)->increment('login_count');

                        DB::table('login_log')->insert(
                            ['admin_id' =>$user->id,'ip_address' =>htmlspecialchars($_SERVER['REMOTE_ADDR']),
                             'device' =>htmlspecialchars($_SERVER['HTTP_USER_AGENT']),'created_at' =>now()
                            ]
                        );

                      
                        return redirect($admin_url.'dashboard');
                        //echo "Success";
                     }

                     else
                     {
                        
                        return redirect()->back()->withErrors('Wrong Password')->withInput();
                     }
                     
                   
               
                   
        
            } 
        
            }

       
        return view('admin.login_admin',compact(['admin_url']) );
 
    }

}
