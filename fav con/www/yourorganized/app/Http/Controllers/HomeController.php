<?php

namespace App\Http\Controllers;
use App\Models\Visitor;
use App\Models\Faq;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    protected function home()
    {
        Visitor::_save();

        $homesliders=DB::table('home_sliders')->orderby('id','desc')->paginate(20);  
        return view('home',compact(['homesliders']));

       
    }


    protected function blog()
    {
        return view('blog');

        
    }

    
    protected function faq()
    {

        $faqvideos=DB::table('faq_youtube_videos')->orderby('id','desc')->get();   
        $faqcategories=DB::table('faq_category')->get();

        return view('faq',compact(['faqvideos','faqcategories']));

        
    }

    protected function viewfaq($id)
    {

        $faq=Faq::where('id',$id)->first();
        return view('viewfaq',compact(['faq']));

        
    }

    protected function upgrade()
    {
        return view('upgrade');

        
    }


    
}
