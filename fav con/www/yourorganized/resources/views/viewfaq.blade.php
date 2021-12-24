@extends('layouts.app')
@push('styles')
<title>Frequently Asked Questions</title>
@endpush
@section('content')

<section class="banner-3 has-overlay bg-cover" style="background-color:#1969a5;">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-9 .bloc-2">
            <div class="text-center text-white">
                <h1>
                    FAQ
                  </h1>
              
            </div>
         </div>
      </div>
   </div>
</section>
<!-- end of banner -->


<!-- start of courses-details -->
<section class="section-padding">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 faq mt-40">
             <h4><a href="{{url('/')}}">Home </a>/ <a href="{{url('/faq')}}">FAQ</a> / <strong>{{$faq->question}} </strong></h4>
             <h1 class="mb-10"><b>{{$faq->question}}</b></h1>
            <div class="mb-35">
               {!!$faq->answer!!}
            </div>
           
             
            <div class="mt-3 mb-20">
        
            </div>
          
         
          
         </div>

         <div class="col-lg-4 mt-5 mt-lg-0">
     
          

            <div class="widget">
               <h4 class="widget-title">Categories</h4>
               <ul class="widget-list list-unstyled">
                  <li><a href="faq-category.html"><i class="fas fa-caret-right mr-2"></i>All</a></li>
                  <li><a href="faq-category.html"><i class="fas fa-caret-right mr-2"></i>Category 1 (4)</a></li>
                  <li><a href="faq-category.html"><i class="fas fa-caret-right mr-2"></i>Category 2 (4)</a></li>
                  <li><a href="faq-category.html"><i class="fas fa-caret-right mr-2"></i>Category 3 (6)</a></li>
                  <li><a href="faq-category.html"><i class="fas fa-caret-right mr-2"></i>Category 4 (3)</a></li>
                  <li><a href="faq-category.html"><i class="fas fa-caret-right mr-2"></i>Category 5 (5)</a></li>
               </ul>
            </div>
               

            <div class="widget">
               <h4 class="widget-title">Most Viewed</h4>
               <ul class="widget-list list-unstyled">
                  <li><a href=""><i class="fas fa-caret-right mr-2"></i>Lore ipsum ip</a></li>
                  <li><a href="#"><i class="fas fa-caret-right mr-2"></i>Lore ipsum ipsum lorem lorem</a></li>
                  <li><a href="#"><i class="fas fa-caret-right mr-2"></i>Lore ipsum</a></li>
                  <li><a href="#"><i class="fas fa-caret-right mr-2"></i>Lore ipsum lorem</a></li>
                  <li><a href="#"><i class="fas fa-caret-right mr-2"></i>Lore ipsum lorem ipsum</a></li>
               </ul>
            </div>

         
         </div>
      </div>
   </div>
</section>
<!-- end of courses-details -->
@endsection
