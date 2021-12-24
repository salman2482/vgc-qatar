<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Visitor;
use App\Models\Drill;
use App\Models\Plan;
use App\Models\User;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Association;
use App\Models\AssociationTeam;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Auth;
Use File;

use Session;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        
         $this->middleware('auth');  
    }


    protected function drills(Request $request)
    {
    $user = Auth::user();
    
    Visitor::_save();
    
    
    
    if ($request->isMethod('post')) {
    
    $rules = array(
    'name' => 'required',
    'mins' => 'required',
    'surface' => 'required',
    'sketchpad_data' =>'required',
    'age_group' =>'required',
    'description' =>'required',
    'notes' =>'required'
    
    );
    
    
    
    $validator = validator()->make(request()->all(), $rules);
    
    // check if the validator failed -----------------------
    if ($validator->fails()) {
    
    // get the error messages from the validator
    
    return redirect()->back()->withErrors($validator)->withInput();
    
    } else
    {
    $tags=$age_group="";
    if(!empty($request->tags))
    {
    
    $tags=implode(", ",$request->tags);
    
    }
    
    if(!empty($request->age_group))
    {
    
    $age_group=implode(", ",$request->age_group);
    
    }
    
    $data = new Drill;
    $data->name = $request->input('name');
    $data->mins = $request->input('mins');
    $data->surface = $request->input('surface');
    $data->sketchpad_data = $request->input('sketchpad_data');
    $data->age_group = $age_group;
    $data->notes = $request->input('notes');
    $data->description = $request->input('description');
    $data->created_at = now();
    $data->user_id = $user->id;
    $data->tags = $tags;
    
    
    if( $data->save())
    
    {
    
    Session::flash('message', "Drills added Successfully !");
    return redirect('drill/'.$data->id);
    }
    
    
    
    }
    
    
    }
    
    $tags=DB::table('drill_tags')->orderby('name','asc')->get();
    $taggedDrills="";
    
    return view('user.drills',compact(['user','taggedDrills','tags']));
    
    
    }

    protected function viewdrill(Request $request)


{
$user = Auth::user();

Visitor::_save();


if ($request->isMethod('post')) {

$rules = array(
'name' => 'required',
'mins' => 'required',
'surface' => 'required',
'sketchpad_data' =>'required',
'age_group' =>'required',
'description' =>'required',
'notes' =>'required'

);



$validator = validator()->make(request()->all(), $rules);

// check if the validator failed -----------------------
if ($validator->fails()) {

// get the error messages from the validator

return redirect()->back()->withErrors($validator)->withInput();

} else
{



$tags=$age_group="";
if(!empty($request->tags))
{

$tags=implode(", ",$request->tags);

}

if(!empty($request->age_group))
{

$age_group=implode(", ",$request->age_group);

}


$data = Drill::find($request->id);
$data->name = $request->input('name');
if($request->new_name!=NULL) //Check whether new Drill
{

$data = new Drill;
$data->name = $request->input('new_name');

}


$data->mins = $request->input('mins');
$data->surface = $request->input('surface');
$data->sketchpad_data = $request->input('sketchpad_data');
$data->age_group = $age_group;
$data->notes = $request->input('notes');
$data->description = $request->input('description');
$data->created_at = now();
$data->user_id = $user->id;
$data->tags = $tags;

if( $data->save())
{


Session::flash('message', "Drill added Successfully !");
return redirect('drill/'.$data->id);
}



}






}


$tags=DB::table('drill_tags')->orderby('name','asc')->get();
$taggedDrills="";
$drill=Drill::find($request->id);

return view('user.viewdrill',compact(['user','taggedDrills','tags','drill']));


}




    protected function plans(Request $request)
{

$user = Auth::user();

Visitor::_save();

if ($request->isMethod('post')) {

    $rules = array(
        'name'      => 'required',
        'plan_time' => 'required',         
        'age_group' => 'required',       
       
    );



    $validator = validator()->make(request()->all(), $rules);

    // check if the validator failed -----------------------
    if ($validator->fails()) {

        // get the error messages from the validator
       
        return redirect()->back()->withErrors($validator)->withInput();
      
    } else 
    { 


       
        $tags=$age_group="";
        if(!empty($request->tags)) 
        {                  
         
          $tags=implode(", ",$request->tags);
          
        }

        if(!empty($request->age_group)) 
        {                  
         
        $age_group=implode(", ",$request->age_group);
          
        }

        $data = new Plan;
        $data->name = $request->input('name');       
        $data->age_group = $age_group;
        $data->plan_time = $request->input('plan_time');
        $data->created_at = now();                
        $data->user_id = $user->id;
        $data->tags = $tags;
        

       if( $data->save())
        
    {

        if(!empty($request->quicknote)) 

        {

$i=0; 
$quicknote=$request->quicknote;
$quicknotemin=$request->quicknotemin;
            foreach ($quicknote as $key)
         {

           if($quicknote[$i])  
           {  
          
         DB::table('plans_quick_notes')->insert(
             ['user_id' =>$user->id,'plan_id' =>$data->id,
              'notes' =>$quicknote[$i],'mins' =>$quicknotemin[$i]
             ]
         );
        }
$i++;
        }

        }

            Session::flash('message', "Plan added Successfully !");
            return redirect('plan/'.$data->id);
    }

  

    }



    


}



$tags=DB::table('plan_tags')->orderby('name','asc')->get();
$taggedDrills="";

//$mytags=

 return view('user.plans',compact(['user','taggedDrills','tags']));

}


protected function viewplan(Request $request)


{
$user = Auth::user();

Visitor::_save();


if ($request->isMethod('post')) {

    $rules = array(
        'name'      => 'required',
        'plan_time' => 'required',         
        'age_group' => 'required',       
       
    );



    $validator = validator()->make(request()->all(), $rules);

    // check if the validator failed -----------------------
    if ($validator->fails()) {

        // get the error messages from the validator
       
        return redirect()->back()->withErrors($validator)->withInput();
      
    } else 
    { 


       
        $tags=$age_group="";
        if(!empty($request->tags)) 
        {                  
         
          $tags=implode(", ",$request->tags);
          
        }

        if(!empty($request->age_group)) 
        {                  
         
        $age_group=implode(", ",$request->age_group);
          
        }

        $flag=0;
        $data = Plan::find($request->id);
        $data->name = $request->input('name');
        if($request->new_name!=NULL)    //Check whether new plan
        { 
            $flag=1;
            $data = new Plan;
            $data->name = $request->input('new_name');  
         
        }
             
        $data->age_group = $age_group;
        $data->plan_time = $request->input('plan_time');
        $data->created_at = now();                
        $data->user_id = $user->id;
        $data->tags = $tags;
        

       if( $data->save())
        
    {

        if(!empty($request->quicknote)) 

        {

$i=0; 
$quicknote=$request->quicknote;
$quicknotemin=$request->quicknotemin;
            foreach ($quicknote as $key)
         {

           if($quicknote[$i])  
           {  
          
         DB::table('plans_quick_notes')->insert(
             ['user_id' =>$user->id,'plan_id' =>$data->id,
              'notes' =>$quicknote[$i],'mins' =>$quicknotemin[$i]
             ]
         );
        }
$i++;
        }

        }

        if($flag==1) //Copying Existing Quick Notes

        {
            $current_notes=  DB::table('plans_quick_notes')->where('plan_id',$request->id)->where('user_id',$user->id)->get();
            //dd($current_notes);
            foreach($current_notes as $current_note)

            {
                DB::table('plans_quick_notes')->insert(
                    ['user_id' =>$user->id,'plan_id' =>$data->id,
                     'notes' =>$current_note->notes,'mins' =>$current_note->mins
                    ]
                );
            }
        }

            Session::flash('message', "Plan added Successfully !");
            return redirect('plan/'.$data->id);
    }

  

    }
    

}


$tags=DB::table('plan_tags')->orderby('name','asc')->get();
$taggedDrills="";
$plan=Plan::find($request->id);
$quicknotes=DB::table('plans_quick_notes')->where('plan_id',$plan->id)->get();

$teams=Team::where('creator_id',$user->id)->get();

return view('user.viewplan',compact(['user','taggedDrills','tags','plan','quicknotes','teams']));


}


protected function deletePlan(Request $request)
{


    $user = Auth::user();

    if($id=$request->plan_id)
     {

        Plan::where('id',$id)->delete();

      $delete=DB::table('plans_quick_notes')->where('user_id', $user->id)->where('plan_id', $id)->delete();
      return redirect('plans');
   

    }
}



protected function deleteNote(Request $request)
{


    $user = Auth::user();

    if($id=$request->id) {

      $delete=DB::table('plans_quick_notes')->where('user_id', $user->id)->where('id', $id)->delete();
    if($delete) 
    {
        
        session()->flash('success', 'Note removed successfully');
        
 
    }

    }
}


protected function deleteDrill(Request $request)
{


$user = Auth::user();

if($id=$request->drill_id)
{

Drill::where(['id' => $id, 'user_id' => $user->id])->delete();


return redirect('drills');


}
}


protected function myprofile(Request $request)
{
$user = Auth::user();

Visitor::_save();



if($request->isMethod('post')){

$rules = array(
'firstname' => 'required',
'lastname' => 'required',
'sports' => 'required',
'country' => 'required',
);

$validator = validator()->make(request()->all(), $rules);

    // check if the validator failed -----------------------
    if ($validator->fails()) {

        // get the error messages from the validator
        
        return redirect()->back()->withErrors($validator)->withInput();
      
    } else 
    { 


$tags = User::where('id',$user->id)->update(
['firstname' =>$request->firstname,'lastname' =>$request->lastname,
'sports' =>$request->sports,'country'=>$request->country
]
);
return redirect()->back();
    }

}
$tags=DB::table('plan_tags')->orderby('name','asc')->get();
$taggedDrills="";

return view('user.myprofile',compact(['user','taggedDrills','tags']));


}



protected function addTeam(Request $request)
{


    $user = Auth::user();

   
if($request->isMethod('post'))
{

    $rules = array(
    'team_name' => 'required',
    
    );
    
    $validator = validator()->make(request()->all(), $rules);
    
        // check if the validator failed -----------------------
        if ($validator->fails()) {
    
            // get the error messages from the validator
            
            return redirect()->back()->withErrors($validator)->withInput();
          
        } else 
        { 
    
    

            $team=new Team;
            $team->name=$request->team_name;
            $team->creator_id=$user->id;
            $team->save();

            return redirect('team/'.$team->id);
        }
    }
}





protected function addToTeam(Request $request)
{


    $user = Auth::user();

   
if($request->isMethod('post'))
{

    $rules = array(
    'coach_id' => 'required',
    'team_id'  => 'required'
    
    );
    
    $validator = validator()->make(request()->all(), $rules);
    
        // check if the validator failed -----------------------
        if ($validator->fails()) {
    
            // get the error messages from the validator
            
            return redirect()->back()->withErrors($validator)->withInput();
          
        } else 
        { 


            $coachids=$request->coach_id;
            foreach ($coachids as $key)

            {
    

            $teammember=new TeamMember;
            $teammember->team_id=$request->team_id;
            $teammember->member_id=$key;
            $teammember->creator_id=$user->id;
            $teammember->save();


            }
            
            return redirect('team/'.$request->team_id);
        }
    }
}






protected function deleteFromTeam(Request $request,$team_id,$member_id)
{
    $user = Auth::user();
    TeamMember::where(['creator_id'=>$user->id,'member_id'=>$member_id])->delete();
    return back();   
}






protected function viewTeam(Request $request,$id)

{

$user = Auth::user();

Visitor::_save();




$team=Team::find($id);
$teams=Team::where('creator_id',$user->id)->get();

$teamMembers=TeamMember::where(['creator_id'=>$user->id,'team_id'=>$team->id])->get('member_id');
    $user_id=[];
    $user_id[0]=$user->id;
    $i=0;
    foreach($teamMembers as $team_member)
    {
        $i++;
        $user_id[$i]=$team_member->member_id;       

    }
//dd($id);
    
    $coaches=User::all();
   $coaches=User::whereNotIn('id',$user_id)->get();



return view('user.viewteam',compact(['user','team','teams','teamMembers','coaches']));

}



protected function my_coaches_list($team_id)

{
    $user = Auth::user();

    $team_members=TeamMember::where(['creator_id'=>$user->id,'team_id'=>$team_id])->get('member_id');
    $id=[];
    $i=0;
    foreach($team_members as $team_member)
    {
        $id[$i]=$team_member->member_id;

        $i++;

    }
//dd($id);
    

    $datatable =User::whereIn('id',$id)->select('*');
    return datatables()->of($datatable)
    ->editColumn('firstname', function ($datatable) 
    {
         
    return  '<a href="'.url('viewcoach/'.$datatable->id).'">'.$datatable->firstname.' '.$datatable->lastname.'</a>';
      
    })

  

    ->editColumn('created_at', function ($datatable) 
    {
            return date( 'jS M Y- h:i:s a', strtotime($datatable->created_at));
    })
    
    ->editColumn('id', function ($datatable) use ($team_id)

    {
        $confirm='  onclick="return confirm(\'Are you sure you want to remove this Coach?\');" ';
        return '<a '.$confirm.' href="'.url('delete/from/team/'.$team_id.'/'.$datatable->id).'" class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Delete"><i class="nav-icon fas fa-trash"></i></a>';
       

    })->escapeColumns([])->make(true);
}






protected function addAssociation(Request $request)
{


    $user = Auth::user();

   
if($request->isMethod('post'))
{

    $rules = array(
    'association_name'       => 'required',
    'association_sports'     => 'required',
    'association_phone'      => 'required',
    'association_email'      => 'required|email',
    'association_start_date' => 'required|date',
    'association_end_date'   => 'nullable|date|after:association_start_date',
    'association_image'      => 'mimes:jpeg,png,jpg,gif,svg|max:4096',
    
    );
    
    $validator = validator()->make(request()->all(), $rules);
    
        // check if the validator failed -----------------------
        if ($validator->fails()) {
    
            // get the error messages from the validator
            
            return redirect()->back()->withErrors($validator)->withInput()->with('add', 'add');
          
        } else 
        { 
    
    

            $data= new Association;
            $data->name=$request->association_name;
            $data->sports=$request->association_sports;
            $data->phone=$request->association_phone;
            $data->email=$request->association_email;
            $data->season_start=$request->association_start_date;
            $data->season_end=$request->association_end_date;
            $data->address=$request->association_address;
           
            $data->creator_id=$user->id;
            $data->save();
            $id=$data->id;
            if($id)
            {
               if ($request->file('association_image'))
               {
   
                   $folderPath = storage_path('app/public/images/association/');
                   
                  
                    File::isDirectory($folderPath) or File::makeDirectory($folderPath, 0777, true, true);
                            
                   $request->association_image->move($folderPath, $id.'.png');
                 
                    
                     $file = $folderPath . $id.'.png';
                        
                    imagejpeg(imagecreatefromstring(file_get_contents($file)), $folderPath . $id.'.jpg');
                    unlink($file);                                  
              
               }
   
               return redirect('association/'.$data->id);
            }

           
        }
    }
}


protected function viewAssociation(Request $request,$id)
{


    $user = Auth::user();

   

    $Association= Association::where(['id'=>$id,'creator_id'=>$user->id])->first();
    $AssociationTeams= AssociationTeam::where(['association_id'=>$Association->id,'creator_id'=>$user->id])->get();
    $coaches=User::all();
    

    return view('user.view_association',compact(['user','Association','coaches','AssociationTeams']));

}

protected function viewAssociationImage(Request $request,$id)
{


    $user = Auth::user();

    $file= storage_path('app/public/images/association/'.$id).'.jpg'; 
      
      

    $required_width=$w=300;
    $required_height=$h=300;

   if (!file_exists($file)) {
    $file= 'assets/images/no.jpg';
   }

   $img = file_get_contents($file);
   return response($img)->header('Content-type','image/jpeg');



   list($width, $height) = getimagesize($file);

    $image = imagecreatefromjpeg($file);
    $thumbImage = imagecreatetruecolor($required_width, $required_height);
    imagecopyresized($thumbImage, $image, 0, 0, 0, 0, $required_width,$required_height, $width, $height);
    imagedestroy($image);
    //imagedestroy($thumbImage); do not destroy before display :)
    ob_end_clean();  // clean the output buffer ... if turned on.
    header('Content-Type: image/jpeg');  
    imagejpeg($thumbImage); //you does not want to save.. just display
    imagedestroy($thumbImage); //but not needed, cause the script exit in next line and free the used memory
    exit;
/*
 
    
    */

}




protected function updateAssociation(Request $request)
{


    $user = Auth::user();



   
if($request->isMethod('post'))
{

    $rules = array(
    'association_name'       => 'required',
    'association_id'         => 'required',
   // 'association_sports'     => 'required',
    'association_phone'      => 'required',
    'association_email'      => 'required|email',
    'association_start_date' => 'required|date',
    'association_end_date'   => 'nullable|date|after:association_start_date',
    'association_image'      => 'mimes:jpeg,png,jpg,gif,svg|max:4096',
    
    );
    
    $validator = validator()->make(request()->all(), $rules);
    
        // check if the validator failed -----------------------
        if ($validator->fails()) {
    
            // get the error messages from the validator
            
            return redirect()->back()->withErrors($validator)->withInput()->with('update', 'update');
          
        } else 
        { 
    
    

            $data= Association::where(['id'=>$request->association_id,'creator_id'=>$user->id])->first();
            $data->name=$request->association_name;
           // $data->sports=$request->association_sports;
            $data->phone=$request->association_phone;
            $data->email=$request->association_email;
            $data->season_start=$request->association_start_date;
            $data->season_end=$request->association_end_date;
            $data->address=$request->association_address;
           
            $data->creator_id=$user->id;
            $data->save();
            $id=$data->id;
            if($id)
            {
               if ($request->file('association_image'))
               {
   
                   $folderPath = storage_path('app/public/images/association/');
                   
                  
                    File::isDirectory($folderPath) or File::makeDirectory($folderPath, 0777, true, true);
                            
                   $request->association_image->move($folderPath, $id.'.png');
                 
                    
                     $file = $folderPath . $id.'.png';
                        
                    imagejpeg(imagecreatefromstring(file_get_contents($file)), $folderPath . $id.'.jpg');
                    unlink($file);                                  
              
               }
   
               return redirect('association/'.$data->id);
            }

           
        }
    }
}







protected function addAssociationTeam(Request $request)
{


    $user = Auth::user();

   
if($request->isMethod('post'))
{

    $rules = array(
    'skill_level'  => 'required',
    'age_level'    => 'required',
    'from_year'    => 'required',
    'to_year'      => 'required',    
    
    );
    
    $validator = validator()->make(request()->all(), $rules);
    
        // check if the validator failed -----------------------
        if ($validator->fails()) {
    
            // get the error messages from the validator
            
            return redirect()->back()->withErrors($validator)->withInput();
          
        } else 
        { 
    
    

            $data= new AssociationTeam;
            $data->skill_level=$request->skill_level;
            $data->age_level=$request->age_level;
            $data->from_year=$request->from_year;
            $data->to_year=$request->to_year; 
            $data->association_id=$request->association_id;      
            $data->creator_id=$user->id;
            $data->save();
            $id=$data->id;
            if($id)
            {
               return back();
   
               return redirect('association/'.$data->id);
            }

           
        }
    }
}




protected function addAssociationTeamCoach(Request $request)
{


    $user = Auth::user();

   
if($request->isMethod('post'))
{

    $rules = array(
    'coach_id'               => 'required',
    'association_team_id'    => 'required',
    'association_id'         => 'required',
       
    
    );
    
    $validator = validator()->make(request()->all(), $rules);
    
        // check if the validator failed -----------------------
        if ($validator->fails()) {
    
            // get the error messages from the validator
            
            return redirect()->back()->withErrors($validator)->withInput();
          
        } else 
        { 
    
    

            $coachids=$request->coach_id;
            foreach ($coachids as $key)

            {
    

                $id=DB::table('association_team_coaches')->insert(['user_id'=>$key,'association_team_id'=>$request->association_team_id,'association_id'=>$request->association_id]);


            }


            if($id)
            {
               return back();
   
              // return redirect('association/'.$data->id);
            }

           
        }
    }
}

protected function changepassword(Request $request){
  
    $user = Auth::user();

    
    if ($request->isMethod('post')) 
    {
          
            $rules = array(
                  
                'current_password'       => 'required',
                'password'              => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6'
                
            );
            
        $validator = validator()->make(request()->all(), $rules);
             
        // check if the validator failed -----------------------
        if ($validator->fails()) {
            
            // get the error messages from the validator
           
            return redirect()->back()->withErrors($validator);
            
        } 
       
        else 
        
        {
            
           
            if($request->password_confirmation==$request->password && $request->password==$request->current_password && Hash::check($request->current_password, $user->password) )
            { 
            return redirect()->back()->with("error"," Current Password and New Passwords entered by you are same ");
            }
    
            if($request->password_confirmation==$request->password && Hash::check($request->current_password, $user->password) )
            {   
            User::where('id', $user->id)->update(['password'=> Hash::make($request->password)]);
            
            return redirect()->back()->with("success", "Your password has been changed successfully!");
            }
    
            else
            {
                
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            }

        }
    }   
    return redirect()->back();
}

protected function addProfilePic(Request $request){
    $user = Auth::user();
    $id=$user->id;
    if($id)
    {
        if ($request->file('profile_pic'))
        {

            $folderPath = storage_path('app/public/images/user_images/');
            
            
            File::isDirectory($folderPath) or File::makeDirectory($folderPath, 0777, true, true);
                    
            $request->profile_pic->move($folderPath, $id.'.png');
            
            
                $file = $folderPath . $id.'.png';
                
            imagejpeg(imagecreatefromstring(file_get_contents($file)), $folderPath . $id.'.jpg');
            unlink($file);                                  
        
        }

        return redirect('myprofile');
    }
}
protected function viewProfilePic(Request $request,$id)
{


    $user = Auth::user();

    $file= storage_path('app/public/images/user_images/'.$id).'.jpg'; 
      
      

    $required_width=$w=300;
    $required_height=$h=300;

   if (!file_exists($file)) {
    $file= 'assets/images/no.jpg';
   }

   $img = file_get_contents($file);
   return response($img)->header('Content-type','image/jpeg');



   list($width, $height) = getimagesize($file);

    $image = imagecreatefromjpeg($file);
    $thumbImage = imagecreatetruecolor($required_width, $required_height);
    imagecopyresized($thumbImage, $image, 0, 0, 0, 0, $required_width,$required_height, $width, $height);
    imagedestroy($image);
    //imagedestroy($thumbImage); do not destroy before display :)
    ob_end_clean();  // clean the output buffer ... if turned on.
    header('Content-Type: image/jpeg');  
    imagejpeg($thumbImage); //you does not want to save.. just display
    imagedestroy($thumbImage); //but not needed, cause the script exit in next line and free the used memory
    exit;
/*
 
    
    */

}

}
