@extends('layouts.app')
@push('styles')
<title>Frequently Asked Questions</title>
@endpush
@section('content')
<!-- start of banner -->
<section class="banner-3 has-overlay bg-cover" style="background-color:#1969a5;">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-9 .bloc-2">
            <div class="text-center text-white">
                <h1>
                    FAQ
                  </h1>
                <div class="input-group newsletter-input-group d-block d-sm-flex mx-auto mt-3 rounded-pill overflow-hidden bg-white" style="max-width:500px">
                  <input type="text" class="form-control px-4 border-0" placeholder="Have a Question?" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <div class="input-group-append ml-0">
                     <button class="btn btn-primary rounded-pill">SEARCH</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- end of banner -->


<section class="section-padding">
   <div class="container">
   
  
        <div class="row justify-content-center">
            
            @foreach($faqvideos as $faqvideo)
        <div class="col-lg-3 col-md-5 col-sm-6 mt-10 vp">
            <div class="text-center">
               <?php
             $link = $faqvideo->url;
$video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
if (empty($video_id[1]))
    $video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..

$video_id = explode("&", $video_id[1]); // Deleting any other params
$video_id = $video_id[0];
                ?>
                <a href="{{$faqvideo->url}}" class="d-block has-overlay has-video-popup tansform-none">
                  <img class="img-fluid vpimg" style="width: 600px; height: 300px" src="http://i4.ytimg.com/vi/{{$video_id}}/maxresdefault.jpg" alt="">
                 
                  <div class="px-15">
                    <div class="card-footer px-0 bg-transparent d-flex justify-content-between align-items-center">
                      
                      <p>{{Str::limit($faqvideo->title, 150, $end='...')}}</p>
                    </div>
                 </div>
               </a>
            </div>
         </div>
          
    @endforeach
          
         </div>
         

       
      </div>
</section>

<section class="section-padding">
   <div class="container">
      <div class="row justify-content-center">
        
            @foreach($faqcategories as $faqcategory)
             
             @php  $count=App\Models\Faq::where('category_id',$faqcategory->id)->count(); @endphp
             @if($count)
          
            <div class="col-lg-4 col-sm-6">
            <div class="mt-20  hover-grayscale">
              
               <h3 class="mt-20  mb-20 font-weight-300">{{Str::limit($faqcategory->title, 40, $end='...')." (".$count.")"}}</h3>
               
                @php $faqs=App\Models\Faq::where('category_id',$faqcategory->id)->get(); @endphp
                
                @foreach($faqs as $faq)
              
                    <p class="mt-10"><a href="{{url('faq/'.$faq->id.'/'.$faq->question)}}"> {{$faq->question}}</a></p>
                    
                @endforeach
                   
            </div>
         </div>
      
             @endif
         @endforeach
          
          
          
      </div>
   </div>
</section>


@endsection
