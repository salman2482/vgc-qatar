<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;
use Auth;
use Session;

class Visitor extends Model
{
    use HasFactory;

    
public function scope_save()

{


    $ip=$_SERVER['REMOTE_ADDR'];
  

    $user_name=NULL;

    

        if (Auth::guard('admin')->check())
    
        {
            $user = Auth::guard('admin')->user();
            Admin::where('id', $user->id)->update(['last_active' => now()]);
            $user_name='Admin/'.$user->name."/".$user->id;
        }
        if (Auth::check())
    
        {
            $user = Auth::user();
            User::where('id', $user->id)->update(['last_active' => now()]);
            $user_name='User/'.$user->firstname."/".$user->id;
        }
        


    $Visitor=new Visitor;
    $Visitor->ip=htmlspecialchars($ip); 
    $Visitor->location=  htmlspecialchars(session('city')); 
    $Visitor->page= htmlspecialchars(\Request::fullUrl()); 
    $Visitor->user=  $user_name;
    $Visitor->device=htmlspecialchars(substr($_SERVER['HTTP_USER_AGENT'],0,400));
    $Visitor->created_at=now();  
    $Visitor->updated_at=NULL;  
    $Visitor->save(); 
    
         

    }
}
