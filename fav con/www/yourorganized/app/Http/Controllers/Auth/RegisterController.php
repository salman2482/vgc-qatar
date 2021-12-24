<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
Use DB;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
 //   protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
  /*  protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

   
    protected function user(Request $request)
    {  
        
        if ($request->isMethod('post')) 
        {
            $messages = [
               
                'captcha.captcha' => 'Wrong Captcha',
              ];
            $rules = array(
                'firstname'             => 'required|string|min:2|max:255|regex:/^[a-zA-Z]+$/u',  
                'lastname'              => 'required|string|min:1|max:255|regex:/^[a-zA-Z]+$/u', 
                'country'               => 'required|string|min:3|max:255',                    
                'email'                 => 'required|email|max:255|unique:App\Models\User,email',     
                'sports'                => 'required|string|min:3|max:255',
                'code'                  => 'max:255',              
                'password'              => 'min:7|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:7',
                'captcha'               => 'captcha',
                'terms'                 => 'required'
            );
    
        
            $validator = validator()->make(request()->all(), $rules,$messages);
    
            // check if the validator failed -----------------------
            if ($validator->fails()) 
            {     
                // get the error messages from the validator
                return redirect()->back()->withErrors($validator)->withInput()->with('message', 'signup-modal');
              
            } 
            else 
            {
    
                     
    
                $user=new User;

                $user->firstname=$request->firstname;
                $user->lastname=$request->lastname;
                $user->country=$request->country;
                $user->email=$request->email;
                $user->sports=$request->sports;
                $user->code=$request->code;
                $user->password=Hash::make($request->password);
                $user->save();
              
                $id=$user->id;

                if($id)
                {
                  Auth::loginUsingId($id);
                  $user = Auth::user();
                  DB::table('login_log')->insert(
                    ['user_id' =>$user->id,'ip_address' =>htmlspecialchars($_SERVER['REMOTE_ADDR']),
                     'device' =>htmlspecialchars($_SERVER['HTTP_USER_AGENT']),'created_at' =>now()
                    ]
                );
                   return redirect('drills');
                }
        
            
        
            }
        

        }

        Visitor::_save();

        return view('user.register_user');
    }


}
