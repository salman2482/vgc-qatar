@extends('layouts.app')
@push('styles')
<title>Upgrade</title>
@endpush
@section('content')
<!-- start of banner -->
    <section class="banner-5 has-overlay bg-cover" style="background-color:#1969a5;">
   <div class="container">
     <div class="bannerupdate-slider-text">
  
      <h2>
        Lorem ipsum        Lorem ipsum
      </h2>
      <h3 class="text-left mg-lg lake-hero-text-sub-s tc-white">
         Lorem ipsum  Lorem ipsum
       


          <p class="banner-para1"  style="margin-top: 18px;">*     Lorem ipsum  Lorem ipsum   Lorem ipsum  Lorem ipsum</p>
      </h3>
       
       
<a href="#!" class="btn btn-sm btn-secondary">Start your  Free Trial</a>
      
    
    </div>
   </div>
</section>


<section class="section-padding">
   <div class="container">
      <div class="row justify-content-center">
        
            <div class="col-12 col-md-4">
            <div class="mt-20  hover-grayscale">
              
             
                <h6 class="mt-20 mb-20 font-weight-100"><span class="fa fa-check" aria-hidden="true"></span>
Effortlessly create lorem ipsum </h6>
              
                    
            </div>
         </div>
              <div class="col-12 col-md-4">
            <div class="mt-20  hover-grayscale">
              
             
              <h6 class="mt-20 mb-20 font-weight-100"><span class="fa fa-check" aria-hidden="true"></span>
Effortlessly create lorem ipsum </h6>
              
                    
            </div>
         </div>
                <div class="col-12 col-md-4">
            <div class="mt-20  hover-grayscale">
              
             
                <h6 class="mt-20 mb-20 font-weight-100"><span class="fa fa-check" aria-hidden="true"></span>
Effortlessly create lorem ipsum </h6>
              
                    
            </div>
         </div>
          
         
          
          
          
          
      </div>
   </div>
</section>
    
    <section class="section-padding bg-grey payment-container">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8 paymnt-table table-responsive">
          <table class="table table-striped table-bordered paymnt-tbl">
          <thead>
            <tr>
              <td class="paymnt-row" style="border-top: 1px solid transparent !important;border-left: 1px solid transparent !important;"></td>
              <td class="paymnt-title ct-font-family">Trial</td>
              <td class="paymnt-title ct-font-family">Free</td>
              <td class="paymnt-pro ct-font-family">Pro</td>
              <td class="paymnt-pro ct-font-family">Association</td>
            </tr>
          </thead>
          <tbody style="background-color:#ffffff;">
            <tr>
              <td><strong>Features</strong></td>
              <td>Lorem ipsum</td>
              <td>Free</td>
              <td>$5 per month*</td>
              <td>
                $8.33 per Team, per Month*
                <br>
                <small><b>4</b> Coaches Per Team</small>
              </td>
            </tr>
            <tr>
              <td>Create ipsum</td>
              <td>Unlimited</td>
              <td>5</td>
              <td>Unlimited</td>
              <td>Unlimited</td>
            </tr>
            <tr>
              <td>Create ipsum</td>
              <td>Unlimited</td>
              <td>2</td>
              <td>Unlimited</td>
              <td>Unlimited</td>
            </tr>
            <tr>
              <td>Discover ipsum ipsum</td>
              <td>5</td>
              <td>5</td>
              <td>Unlimited</td>
              <td>Unlimited</td>
            </tr>
            <tr>
              <td>Discover ipsum lorem</td>
              <td>5</td>
              <td>2</td>
              <td>Unlimited</td>
              <td>Unlimited</td>
            </tr>
            <tr>
              <td>Share ipsum &amp; lorem</td>
              <td>Unlimited</td>
              <td>No</td>
              <td>Unlimited</td>
              <td>Unlimited</td>
            </tr>
            <tr>
              <td class="ct-font-family upgrade-td"></td>
               <td class="paymnt-header text-center upgrade-td upgrade-no-border">
                                     
                   
 <a  href="#!"  class="btn btn-primary upgrade-link upgrade-pay-btn btn-block" data-toggle="modal" data-target="#signup-modal">Start Trial</a> 
              
              </td>
              <td class="upgrade-td"></td>
              <td class="paymnt-header text-center upgrade-td upgrade-no-border">
                                     
                   
 <a  href="#!"  class="btn btn-primary upgrade-link upgrade-pay-btn btn-block" data-toggle="modal" data-target="#billing-modal">
     Upgrade</a>
              </td>
             <td class="paymnt-header text-center upgrade-td">
                <div class="multi-btn-wrapper">
                <a  href="#!" class="btn btn-primary upgrade-trial-btn" data-toggle="modal" data-target="#signup-modal">
                    Sign Up
                  </a>
                  <div class="video-gallery">
                      
                      <a href="https://www.youtube.com/watch?v=raSvts64wNg" class=" btn btn-primary upgrade-trial-btn d-block has-overlay has-video-popup tansform-none">
                <i class="fa fa-info-circle" aria-hidden="true"></i> Learn More
                 
               </a>
                      
                      
                     <!-- 
                      
                    <button class="btn btn-primary upgrade-trial-btn" title="" href="#" data-poster="#">
                      <i class="fa fa-info-circle" aria-hidden="true"></i> Learn More
                    </button>-->
                  </div>
                </div>
                <script type="text/javascript">
                   $(document).ready(function(){
                    $(".video-gallery").lightGallery({
                      youtubePlayerParams: {
                        modestbranding: 1,
                        rel: 0,
                      },
                      loadYoutubeThumbnail:false,
                    });
                  });
                </script>
              </td>
            </tr>
          </tbody>
        </table>
          </div>
          
      </div></div>
</section>
    
    <div class="modal fade rounded" id="billing-modal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" style="max-width:1400px">
<div class="modal-content">
<div class="modal-header">

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="row justify-content-center align-items-center">
<div class="col-lg-6">
<h4 class="upgrade-title">Billing </h4>
<div class="modal-body p-3 p-sm-4">
<form method="POST" class="row">
<div class="form-group mb-20 col-6">
<label class="text-secondary h6 mb-2" for="fname">First Name</label>
<input class="form-control shadow-none rounded-sm" type="text" placeholder="First NAme" id="fname" required>
</div>
<div class="form-group mb-20 col-6">
<label class="text-secondary h6 mb-2" for="fname">Last Name</label>
<input class="form-control shadow-none rounded-sm" type="text" placeholder="Last Nme" id="fname" required>
</div>
<div class="form-group mb-20 col-6">
<label class="text-secondary h6 mb-2" for="email2">Password</label>
<input class="form-control shadow-none rounded-sm" type="email" placeholder="" id="email2" required>
</div>
<div class="form-group mb-20 col-6">
<label class="text-secondary h6 mb-2" for="email2">Confirm Password</label>
<input class="form-control shadow-none rounded-sm" type="email" placeholder="" id="email2" required>
</div>

<div class="form-group mb-20 col-6">
<label class="text-secondary h6 mb-2" for="email2">Email </label>
<input class="form-control shadow-none rounded-sm" type="email" placeholder="jack@email.com" id="email2" required>
</div>
<div class="form-group mb-20 col-6">
<label class="text-secondary h6 mb-2" for="fname">Postal/ Zipcode</label>
<input class="form-control shadow-none rounded-sm" type="text" placeholder="Postal/ Zipcode" id="fname" required>
</div>
<div class="form-group mb-20 col-12">
<label class="text-secondary h6 mb-2" for="fname">Street Address</label>
<input class="form-control shadow-none rounded-sm" type="text" placeholder="" id="fname" required>
</div>
<div class="form-group mb-20 col-4">
<label class="text-secondary h6 mb-2" for="pnumber">City</label>
<input class="form-control shadow-none rounded-sm" type="text" placeholder="City" id="pnumber" required>
</div>
<div class="form-group mb-20 col-4">
<label class="text-secondary h6 mb-2" for="email2">State/Province</label>
<input class="form-control shadow-none rounded-sm" type="email" placeholder="State/Province" id="email2" required>
</div>
<div class="form-group mb-20 col-4">
<label class="text-secondary h6 mb-2" for="email2">Country</label>
<select class="form-control shadow-none rounded-sm" type="text" placeholder="" id="country" required>
<option>Please select One</option>
</select>
</div>



</form>
</div>
</div>
<div class="col-lg-6">
<h4 class="upgrade-title">Credit Card </h4>
<div class="modal-body p-3 p-sm-4">
<form method="POST" class="row">
<div class="form-group mb-20 col-8">
<label class="text-secondary h6 mb-2" for="fname">Credit Card Number</label>
<input class="form-control shadow-none rounded-sm" type="text" placeholder="Card Number" id="fname" required>
</div>
<div class="form-group mb-20 col-4">
<label class="text-secondary h6 mb-2" for="fname">CVC</label>
<input class="form-control shadow-none rounded-sm" type="text" placeholder="CVC Number" id="fname" required>
</div>
<div class="form-group mb-20 col-4">
<label class="text-secondary h6 mb-2" for="fname">Card Expiration(MM/YY)</label>

<input class="form-control shadow-none rounded-sm" type="text" placeholder="MM" id="fname" required>
</div>
<div class="form-group mb-20 col-4">
<label class="text-secondary h6 mb-2 hid" for="fname" > </label>
<input class="form-control shadow-none rounded-sm" type="text" placeholder="YY" id="fname" required>
</div>

<div class="form-group mb-20 col-4">
<label class="text-secondary h6 mb-2" for="fname">Code</label>
<input class="form-control shadow-none rounded-sm" type="text" placeholder="" id="fname" required>
</div>
<div class="form-group mb-20 col-12">
<label class="text-secondary h6 mb-2" for="fname">Sport</label>
<input class="form-control shadow-none rounded-sm" type="text" placeholder="Code(optional)" id="fname" required>
</div>
<div class="form-group mb-1 col-12">
<label class="text-secondary h6 mb-2" for="fname">Choose your Plan</label>
</div>
<div class="form-group col-6">
<button class="btn btn-primaryA w-100 rounded-sm" type="button"> YEARLY <span class="fa fa-check" aria-hidden="true"></span></button>
</div>
<div class="form-group col-6">
<button class="btn btn-primaryB w-100 rounded-sm" type="button">MONTHLY</button>
</div>
<div class="col-md-12">
<h5 class="text-success upgrade-head" style="margin-top:5px;margin-bottom:5px;">
<span id="coach_plan_amount"></span>
</h5>
<p class="text-success ct-font-family">Your plan will be renewed automatically.</p>
</div>
<div class="form-group col-12">
<button class="btn btn-primary w-100 rounded-sm" type="submit">REGISTER</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
