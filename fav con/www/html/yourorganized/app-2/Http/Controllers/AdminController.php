<?php

namespace App\Http\Controllers;
Use Auth;
use DB;
use App\Models\Visitor;
use App\Models\Admin;
use App\Models\Faq;
use App\Models\User;
use App\Models\Plan;
use App\Models\Drill;
use App\Models\Association;
use App\Models\Team;
use App\Models\TeamMember;

use App\Models\AssociationTeam;

use Session;
use Illuminate\Support\Str;


use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function __construct()
    {
        
        $this->middleware('auth:admin');  
    }


    
    protected function dashboard(Request $request)
    
    {
 
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
      
        Visitor::_save();

   
      

        return view('admin.dashboard_admin',compact(['user','admin_url']) );
 
    }


    protected function addfaq(Request $request)
    
    {
 
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');       
        Visitor::_save();


        
        if ($request->isMethod('post')) 
        {
    
            $rules = array(
                'category_id'         => 'required|integer',     
                'answer'              => 'required',
                'question'            => 'required'
                
            );
    
    
    
            $validator = validator()->make(request()->all(), $rules);
    
            // check if the validator failed -----------------------
            if ($validator->fails()) 
            {
        
                // get the error messages from the validator
               
            return redirect()->back()->withErrors($validator)->withInput();
              
            } 
            else 
            
            {       
                   


     
        
            }


        }
      
        $categories=DB::table('faq_category')->get(); 
        return view('admin.addfaq_admin',compact(['user','admin_url','categories']) );



}



protected function manage_faq(Request $request)
    
{

    $user = Auth::guard('admin')->user();
    $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

    if ($request->isMethod('post')) 
    
    {

        $rules = array(
            
            'title'   => 'required|max:100',           
                 
                        
        );



        $validator = validator()->make(request()->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {
    
            // get the error messages from the validator
           
            return redirect()->back()->withErrors($validator)->withInput();
          
        }

    else
    {
       DB::table('faq_category')->insert(['title' =>$request->title]); 
        
        return back()->with('message', 'FAQ Added Successfully !');
    }

} 
  

    return view('admin.manage_faq',compact(['user','admin_url']) );

}

protected function faq_categrory_list()

{
    $user = Auth::guard('admin')->user();
    $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   

    $datatable = DB::table('faq_category')->select('*');
    return datatables()->of($datatable)
    ->editColumn('title', function ($datatable) 
    {
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   
    return  '<a href="'.url($admin_url.'view/faqs/'.$datatable->id).'">'.$datatable->title.'</a>';
      
    })

  
    ->editColumn('id', function ($datatable) 

    {
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
        $count=Faq::where('category_id',$datatable->id)->count();
        return '<a href="'.url($admin_url.'view/faqs/'.$datatable->id).'" class="" >'.$count.'</a>';
       

    })
    ->addColumn('count', function ($datatable) 

    {
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
        $count=Faq::where('category_id',$datatable->id)->count();

        return '<a href="'.url($admin_url.'view/faqs/'.$datatable->id).'" class="" >'.$count.'</a>';
       

    })
    ->escapeColumns([])->make(true);
}

protected function delete_faq_category(Request $request,$id)

{

    

    DB::table('faq_category')->where('id',$id)->delete(); 
   
    Faq::where(['category_id'=>$id])->delete();

    $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

    return redirect($admin_url."manage/faq");
}


protected function delete_faq(Request $request,$id,$faq_id)

{

    Faq::where(['category_id'=>$id,'id'=>$faq_id])->delete();

    return back()->with('message', 'FAQ Added Successfully !');
}

protected function faq_list(Request $request,$id)
    
{

    $user = Auth::guard('admin')->user();
    $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

    if ($request->isMethod('post')) 
    
    {

        $rules = array(
            
                           
                        
        );



        $validator = validator()->make(request()->all(), $rules);

        // check if the validator failed -----------------------
        if ($validator->fails()) {
    
            // get the error messages from the validator
           
            return redirect()->back()->withErrors($validator)->withInput();
          
        }

    else
    {
       

        $description=$request->answer;

        $dom = new \DomDocument();

        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    

        $images = $dom->getElementsByTagName('img');

        
        foreach($images as $k => $img){

            $data = $img->getAttribute('src');


            list($type, $data) = explode(';', $data);

            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);


            $image_name= "upload/" . time().$k.'.png';

            $path = $image_name;



            file_put_contents($path, $data);

            

            $img->removeAttribute('src');

            $img->setAttribute('src', $image_name);

        }


        $description = $dom->saveHTML();


        $faq=new Faq;
        $faq->category_id=$request->category_id;
        $faq->question=$request->question;
        $faq->answer=$description;
        $faq->created_at=now();
        $faq->save();

        $id=$faq->id;

        //dd($description);



        
        return back()->with('message', 'FAQ Added Successfully !');
    }

} 
    $faq_lists=DB::table('faq_category')->where('id',$id )->first(); 

    return view('admin.faq_list',compact(['user','admin_url','faq_lists']) );

}

protected function users(Request $request)
    
{

    $user = Auth::guard('admin')->user();
    $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
  

    return view('admin.users',compact(['user','admin_url']) );

}

protected function users_list()

{
    
    $user = Auth::guard('admin')->user();
    $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   

    $datatable = User::latest()->select('*');
    return datatables()->of($datatable)
    ->editColumn('firstname', function ($datatable) 
    {
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   
    return  '<a href="'.url($admin_url.'viewuser/'.$datatable->id).'">'.$datatable->firstname.' '.$datatable->lastname.'</a>';
      
    })

  

    ->editColumn('created_at', function ($datatable) 
    {
            return date( 'jS M Y- h:i:s a', strtotime($datatable->created_at));
    })
    
    ->editColumn('id', function ($datatable) 

    {
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
        return '<a href="'.url($admin_url.'viewuser/'.$datatable->id).'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="nav-icon fas fa-eye"></i></a>';
       

    })->escapeColumns([])->make(true);
}

protected function viewuser(Request $request,$id)
    
{

    $user = Auth::guard('admin')->user();
    $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
    $user2=User::find($id);

    return view('admin.viewuser',compact(['user','admin_url','user2']) );

    $datatable = Drill::latest()->where('user_id', $user2)->select('*');

    return datatables()->of($datatable)
    
    ->editColumn('created_at', function ($datatable) 
    {
            return date( 'jS M Y- h:i:s a', strtotime($datatable->created_at));
    })
    ->editColumn('id', function ($datatable) 

    {
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
        return '<a href="'.url($admin_url.'viewuser/'.$datatable->id).'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="nav-icon fas fa-eye"></i></a>';
       

    })->escapeColumns([])->make(true);

    

}



protected function coaches(Request $request)
    
{

    $user = Auth::guard('admin')->user();
    $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
  

    return view('admin.coaches',compact(['user','admin_url']) );

}

protected function coaches_list()

{
    $user = Auth::guard('admin')->user();
    $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   

    $datatable =DB::table('coaches')->select('*');
    return datatables()->of($datatable)
    ->editColumn('firstname', function ($datatable) 
    {
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   
    return  '<a href="'.url($admin_url.'viewcoach/'.$datatable->id).'">'.$datatable->firstname.' '.$datatable->lastname.'</a>';
      
    })

  

    ->editColumn('created_at', function ($datatable) 
    {
            return date( 'jS M Y- h:i:s a', strtotime($datatable->created_at));
    })
    
    ->editColumn('id', function ($datatable) 

    {
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
        return '<a href="'.url($admin_url.'viewcoach/'.$datatable->id).'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="nav-icon fas fa-eye"></i></a>';
       

    })->escapeColumns([])->make(true);
}

protected function viewcoach(Request $request,$id)
    
{

    $user = Auth::guard('admin')->user();
    $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
  $user2=DB::table('coaches')->where('id',$id)->first();

   return view('admin.viewcoach',compact(['user','admin_url','user2']) );

}

protected function faqvideos(Request $request)
    
    {
 
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        if ($request->isMethod('post')) 
    
        {
    
            $rules = array(
                
                'url'   => 'required|url',           
                'title' => 'required|max:200',        
                            
            );
    
    
    
            $validator = validator()->make(request()->all(), $rules);
    
            // check if the validator failed -----------------------
            if ($validator->fails()) {
        
                // get the error messages from the validator
               
                return redirect()->back()->withErrors($validator)->withInput();
              
            }
    
        else
        {
            $faqvideos=DB::table('faq_youtube_videos')->insert(['url' =>$request->url ,'title' =>$request->title]); 
            
            return redirect()->back()->with('message', 'Video Added Successfully !');
        }
    
    }    
      
        $faqvideos=DB::table('faq_youtube_videos')->orderby('id','desc')->paginate(20);  

        return view('admin.faqvideos_admin',compact(['user','admin_url','faqvideos']) );
 
    }


protected function faqvideosedit(Request $request)
    
    {
 
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        if ($request->isMethod('post')) 
    
        {
    
            $rules = array(
                
                'url'   => 'required|url',           
                'title' => 'required|max:200',
                'id'    => 'required|numeric',       
                            
            );
    
    
    
            $validator = validator()->make(request()->all(), $rules);
    
            // check if the validator failed -----------------------
            if ($validator->fails()) {
        
                // get the error messages from the validator
               
                return redirect()->back()->withErrors($validator)->withInput();
              
            }
    
        else
        {
            $faqvideos=DB::table('faq_youtube_videos')->where('id',$request->id)->update(['url' =>$request->url ,'title' =>$request->title]);
            
            return redirect()->back()->with('message', 'Video Updated Successfully !');
        }
    
    }    
      
       
 
    }

    protected function faqvideosdelete(Request $request,$id)
    
    {
 
        $faqvideos=DB::table('faq_youtube_videos')->where('id',$id)->delete(); 
            
         return redirect()->back()->with('message', 'Video Deleted Successfully !');
 
    }



    protected function homesliders(Request $request)
    
    {
 
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        if ($request->isMethod('post')) 
    
        {
    
            $rules = array(
                
                           
                'title' => 'max:200',
                'file' => 'mimes:jpeg,png,jpg,bmp|max:1024',
                'url'   => 'nullable|url',        
                            
            );
    
    
    
            $validator = validator()->make(request()->all(), $rules);
    
            // check if the validator failed -----------------------
            if ($validator->fails()) {
        
                // get the error messages from the validator
               
                return redirect()->back()->withErrors($validator)->withInput();
              
            }
    
        else
        {
            $id=DB::table('home_sliders')->insertGetId(['url' =>$request->url ,'title' =>$request->title]); 

            
    if ($request->hasFile('file')) {
        $image = $request->file('file');
        $name = $id.".jpg";
        $destinationPath = 'assets/uploads/homesliders/';
        $image->move($destinationPath, $name);
       // $this->save();

        return redirect()->back()->with('message', 'Slider Added Successfully !');
    }
            
            
        }
    
    }    
      
        $homesliders=DB::table('home_sliders')->orderby('id','desc')->paginate(20);  

        return view('admin.home_sliders',compact(['user','admin_url','homesliders']) );
 
    }


protected function homeslidersedit(Request $request)
    
    {
 
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        if ($request->isMethod('post')) 
    
        {
    
            $rules = array(
                
                'url'   => 'nullable|url',           
                'title' => 'max:200',
                'id'    => 'required|numeric',       
                            
            );
    
    
    
            $validator = validator()->make(request()->all(), $rules);
    
            // check if the validator failed -----------------------
            if ($validator->fails()) {
        
                // get the error messages from the validator
               
                return redirect()->back()->withErrors($validator)->withInput();
              
            }
    
        else
        {
            DB::table('home_sliders')->where('id',$request->id)->update(['url' =>$request->url ,'title' =>$request->title]);
            
            return redirect()->back()->with('message', 'Video Updated Successfully !');
        }
    
    }    
      
       
 
    }

    protected function homeslidersdelete(Request $request,$id)
    
    {
 
        DB::table('home_sliders')->where('id',$id)->delete(); 
        unlink('assets/uploads/homesliders/'.$id.'.jpg');
            
         return redirect()->back()->with('message', 'Slider Deleted Successfully !');
 
    }


    protected function viewuserimage (Request $request,$id)
{

    //$folderPath = storage_path('app/public/images/user_images/');

    $file= storage_path('app/public/images/user_images/'.$id).'.jpg'; 
      
      

    $required_width=$w=300;
    $required_height=$h=300;

   if (!file_exists($file)) {
    $file= 'assets/images/no.jpg';
   }

   $img = file_get_contents($file);
   return response($img)->header('Content-type','image/jpeg');


}



    protected function visitors()
    {
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
        $user = Auth::guard('admin')->user();
        return view('admin.visitors',compact(['user','admin_url']));
    } 

    protected function visitors_list()
    {
        $admin = Auth::guard('admin')->user();
       // $admin_url=$this->admin_url;
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
        $visitors = Visitor::latest()->select('*');
        return datatables()->of($visitors)
        ->editColumn('created_at', function ($visitors) 
        {
            //change over here
            //return date('d-m-Y ,hh:mm', strtotime($user->created_at) );
            return date( 'jS M Y- h:i:s a', strtotime($visitors->created_at));
        })->make(true);
    } 

    protected function tags(Request $request){
        
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        if($request->tag == "plan")
        {

            DB::table('plan_tags')->insert(
                ['name' => $request->name
                ]
            );

            return redirect()->back();

        }
        if($request->tag == "drill")
        {

            DB::table('drill_tags')->insert(
                ['name' => $request->name
                ]
            );

            return redirect()->back();


        }
        
        return view('admin.tags',compact(['user','admin_url']) );

        }

    protected function view_drilltags(){

        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');

        $datatable = DB::table('drill_tags')->select('*');

        return datatables()->of($datatable)
    
        ->editColumn('id', function ($datatable) 

        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

            $confirm=' onclick="return confirm(\'Are you sure you want to remove this record?\');" ';
            return '<a '.$confirm.' href="'.url($admin_url.'delete_drilltag/'.$datatable->id).'" class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Delete"><i class="nav-icon fas fa-trash"></i></a>';

        })->escapeColumns([])->make(true);
        
    }

    protected function delete_drilltag($id){

        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');  

        DB::table('drill_tags')->where('id',$id)->delete();
        return redirect()->back();
    }

    protected function view_plantags(){

        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');
        
        $datatable = DB::table('plan_tags')->select('*');

        return datatables()->of($datatable)
    
        ->editColumn('id', function ($datatable) 

        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
            $confirm=' onclick="return confirm(\'Are you sure you want to remove this record?\');" ';
            return '<a '.$confirm.' href="'.url($admin_url.'delete_plantag/'.$datatable->id).'" class="btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Delete"><i class="nav-icon fas fa-trash"></i></a>';
            

        })->escapeColumns([])->make(true);
    }

    protected function delete_plantag($id){

        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');

        DB::table('plan_tags')->where('id',$id)->delete();
        return redirect()->back();
    }

    protected function manage_plans(Request $request)

    {

        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 


        return view('admin.manage_plans',compact(['user','admin_url']) );

    }




    protected function plans_list()

    {
    
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   

        $datatable = Plan::select('*');

        return datatables()->of($datatable)

        ->editColumn('name', function ($datatable) 
        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   
            return  '<a href="'.url($admin_url.'viewplans/'.$datatable->id).'">'.$datatable->name.'</a>';
        
        })

        ->editColumn('plan_time', function ($datatable) 
        {
            return date( 'jS M Y- h:i:s a', strtotime($datatable->plan_time));
        })
        
        ->editColumn('created_at', function ($datatable) 
        {
            return date( 'jS M Y- h:i:s a', strtotime($datatable->created_at));
        })
        ->editColumn('id', function ($datatable) 

        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
            return '<a href="'.url($admin_url.'viewplans/'.$datatable->id).'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="nav-icon fas fa-eye"></i></a>';
        
        })
        
        ->addColumn('created_by', function ($datatable) 

        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
            $name=User::find($datatable->user_id);
            $name=$name->firstname." ".$name->lastname;
    
            return '<a href="'.url($admin_url.'viewuser/'.$datatable->user_id).'"  >'.$name.'</a>';
           
    
        })->escapeColumns([])->make(true);

    
    }
    protected function manage_drills(Request $request)
    {

        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        return view('admin.manage_drills',compact(['user','admin_url']) );
    }
    protected function drills_list()
    {

        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   

        $datatable = Drill::select('*');

        return datatables()->of($datatable)

        ->editColumn('name', function ($datatable) 
        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   
            return  '<a href="'.url($admin_url.'viewdrills/'.$datatable->id).'">'.$datatable->name.'</a>';

        })

        ->editColumn('created_at', function ($datatable) 
        {
            return date( 'jS M Y- h:i:s a', strtotime($datatable->created_at));
        })
        ->editColumn('id', function ($datatable) 

        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
            return '<a href="'.url($admin_url.'viewdrills/'.$datatable->id).'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="nav-icon fas fa-eye"></i></a>';

        })
        ->addColumn('created_by', function ($datatable) 

        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
            $name=User::find($datatable->user_id);
            $name=$name->firstname." ".$name->lastname;
    
            return '<a href="'.url($admin_url.'viewuser/'.$datatable->user_id).'"  >'.$name.'</a>';
           
    
        })->escapeColumns([])->make(true);
    }
    public function user_drills($id)
    {
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
        
        $datatable = Drill::where('user_id', $id)->select('*');

        return datatables()->of($datatable)
        
        ->editColumn('created_at', function ($datatable) 
        {
                return date( 'jS M Y- h:i:s a', strtotime($datatable->created_at));
        })
        ->editColumn('name', function ($datatable) 
        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   
            return  '<a href="'.url($admin_url.'viewdrills/'.$datatable->id).'">'.$datatable->name.'</a>';
        
        })->escapeColumns([])->make(true);
    }

    public function user_plans($id)
    {

        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        $datatable = Plan::where('user_id', $id)->select('*');

        return datatables()->of($datatable)

        ->editColumn('created_at', function ($datatable) 
        {
                return date( 'jS M Y- h:i:s a', strtotime($datatable->created_at));
        })->editColumn('name', function ($datatable) 
        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');   
            return  '<a href="'.url($admin_url.'viewplans/'.$datatable->id).'">'.$datatable->name.'</a>';
        
        })
    
  ->escapeColumns([])->make(true);
    }

    protected function viewplans(Request $request,$id)
    {
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        $tags=DB::table('plan_tags')->orderby('name','asc')->get();
        $taggedDrills="";
        $plan=Plan::find($request->id);
        $quicknotes=DB::table('plans_quick_notes')->where('plan_id',$plan->id)->get();

        return view('admin.viewplans',compact(['user','admin_url','taggedDrills','tags','plan','quicknotes']));

    }
    protected function delete_plan(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        $id=$request->plan_id;
        DB::table('plans')->where('id',$id)->delete();
        DB::table('plans_quick_notes')->where('user_id', $user->id)->where('plan_id', $id)->delete();
        return redirect($admin_url."manage_plans");
        

    }

    protected function viewdrills(Request $request,$id)

    {
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        $tags=DB::table('drill_tags')->orderby('name','asc')->get();
        $taggedDrills="";
        $drill=Drill::find($request->id);

        return view('admin.viewdrills',compact(['user','admin_url','taggedDrills','tags','drill']));
    }

    protected function delete_drill(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        $id=$request->drill_id;
        DB::table('drills')->where('id',$id)->delete();
       return redirect($admin_url."manage_drills");

    }
    protected function manage_associations(Request $request)

    {

        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 


        return view('admin.manage_associations',compact(['user','admin_url']) );

        

    }

    protected function associations_list()
    {
    
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        $datatable = DB::table('associations')->select('*');

        return datatables()->of($datatable)


        ->editColumn('created_at', function ($datatable) 
        {
            return date( 'jS M Y- h:i:s a', strtotime($datatable->created_at));
        })
        ->editColumn('id', function ($datatable) 

        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
            return '<a href="'.url($admin_url.'viewassociation/'.$datatable->id).'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="nav-icon fas fa-eye"></i></a>';

        })
        
        ->editColumn('name', function ($datatable) 

        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
            return '<a href="'.url($admin_url.'viewassociation/'.$datatable->id).'" >'.$datatable->name.'</a>';

        })->escapeColumns([])->make(true);


    }


    protected function viewAssociation(Request $request,$id)
    {
    
    
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
    
       
    
        $Association= Association::where(['id'=>$id])->first();
        $AssociationTeams= AssociationTeam::where(['association_id'=>$Association->id])->get();
        $coaches=User::all();
        
    
        return view('admin.viewassociation',compact(['user','Association','coaches','AssociationTeams','admin_url']));
    
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



    protected function user_teams($id)
    {
    
        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        $datatable = DB::table('teams')->where('creator_id',$id)->select('*');

        return datatables()->of($datatable)

        ->editColumn('name', function ($datatable) 
        {
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url');
        return $datatable->name;   
        return  '<a href="'.url($admin_url.'viewteam/'.$datatable->id).'">'.$datatable->name.'</a>';
        })

        ->addColumn('members', function ($datatable) 
        {
            $teamMembers=TeamMember::where(['team_id'=>$datatable->id])->get('member_id');

            $members="";

            foreach($teamMembers as $team_member)
            {
               
                $members.="  ".User::where('id',$team_member->member_id)->value('firstname');       
        
            }

            return  $members;
        })
        ->editColumn('id', function ($datatable) 

        {
            $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 
            return '<a href="'.url($admin_url.'viewteam/'.$datatable->id).'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit"><i class="nav-icon fas fa-eye"></i></a>';

        })->escapeColumns([])->make(true);


    }
    protected function viewteam($id)
    {

        $user = Auth::guard('admin')->user();
        $admin_url=DB::table('url_settings')->where('id',1)->value('admin_url'); 

        $datatable = DB::table('team_members')->select('*');

        return datatables()->of($datatable)


        ->editColumn('created_at', function ($datatable) 
        {
            return date( 'jS M Y- h:i:s a', strtotime($datatable->created_at));
        })->escapeColumns([])->make(true);

    }

}