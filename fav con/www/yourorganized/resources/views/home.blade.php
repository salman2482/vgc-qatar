@extends('layouts.app')
@section('title', 'Home / Tour Page')
	

@section('content')


<!-- Slider and Form -->
	{{-- <section id="menu-slider" class="header">
        <div class="container">
            <div class="col-md-12 col-xs-12 col-sm-12 content_slider">
                <h1 id="fittext3" class="title-head text-center white">
                   Be a pro Sportsman
                </h1>
                
                <p class="sub-title-head text-center white">
                   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                   tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <div class="top-info text-center">
	                <button class="info">Learn More</button>
	                <button class=" info2">Purchase</button>
	            </div>
            </div>
            
            
        
        </div>
            
            
	</section> --}}
	<section id="menu-slider" class="header">
        {{-- <div class="container"> --}}
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
		@foreach($homesliders as $homeslider)
		<div class="item @if($loop->first) active @endif">
			<img src="{{url('assets/uploads/homesliders/'.$homeslider->id)}}.jpg" alt="..." style="width: 100%;">
			<div class="carousel-caption">
			  <span class="text-center head-text">{{ $homeslider->title }}</span><br />
			  {{-- <i class="fa fa-quote-left"></i> Gregor then turned to look out the window at the dull weather. Drops of rain.<i class="fa fa-quote-right"></i> --}}
			</div>
		</div>
		@endforeach
	  
	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="fa fa-angle-left fa-2x" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="fa fa-angle-right fa-2x" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	  </a>
	  </div> 
	{{-- </div> --}}
</section>
	<!-- Features -->
	<section id="menu-features" class="features">
       <h2 id="fittext2" class="title-start">About us</h2>
       <p class="sub-title">Featured PROJECTS THAT WE LOVE.</p>  
       <div class="container column-section">
	       <div class="item-section col-md-4">
	            <div class="icon text-center"><i class="fa fa-3x fa-circle-o-notch"></i></div>
	            <h4 class="item-title text-center">A visit back to The Vedas</h4>
	            <p class="featured-text">Gregor then turned to look out the window at the dull one. weather. Drops of rain could the dull one. the dull one. weather. Drops of rain could the dull one. </p>
	       </div>
	       <div class="item-section col-md-4">
	            <div class="icon text-center"><i class="fa fa-3x fa-life-ring"></i></div>
	            <h4 class="item-title text-center">A visit back to The Vedas</h4>
	            <p class="featured-text">Gregor then turned to look out the window at the dull one. weather. Drops of rain could the dull one. the dull one. weather. Drops of rain could the dull one. </p>
	       </div>
	       <div class="item-section col-md-4">
	            <div class="icon text-center"><i class="fa fa-3x fa-star"></i></div>
	            <h4 class="item-title text-center">A visit back to The Vedas</h4>
	            <p class="featured-text">Gregor then turned to look out the window at the dull one. weather. Drops of rain could the dull one. the dull one. weather. Drops of rain could the dull one. </p>
	       </div>
       </div>

	</section>
	<!-- end Features -->


	<!-- Information -->
   <section id="menu-information"  class="container information generic">
       <h2 id="fittext2" class="title-start">Courses</h2>
       <p class="sub-title">Featured Courses THAT WE Take.</p>  
				<div class="item col-md-4">
           <div class="blok-read-sm">
             <a href="#" class="hover-image">
                <img src="{{url('assets/main/img/cricket.jpg')}}" alt="image">
                <span class="layer-block">Registration Available</span>
             </a>
             <div class="info-text visible-md visible-lg">
             	<span class="left-text">45 Min</span>
             	<span class="right-text">Intermediate</span>
             </div>
            <div class="content-block">
              <span class="point-caption bg-blue-point"></span>
              <span class="bottom-line bg-blue-point"></span>
                <h4>Cricket Coach</h4>
                <p>Gregor then turned to look out the window at the dull weather. Drops of rain could pane,which made..</p>
                <div class="button-main bg-fio-point">Enroll now</div>
                 <div class="like-wrap">
                     <a href="#"><i class="fa fa-heart col-red"></i></a><span>224</span>
                     <a href="#"><i class="fa fa-comment col-green"></i></a><span>89</span>
                 </div>
            	</div>
            </div>
          </div>
            <div class="item col-md-4">
               <div class="blok-read-sm">
                 <a href="#" class="hover-image">
                    <img src="{{url('assets/main/img/sports.jpg')}}" alt="image">
                    <span class="layer-block">Registration Available</span>
                 </a>
                 <div class="info-text visible-md visible-lg">
	             	<span class="left-text">45 Min</span>
	             	<span class="right-text">Intermediate</span>
             	</div>
                <div class="content-block">
                  <span class="point-caption bg-blue-point"></span>
                  <span class="bottom-line bg-blue-point"></span>
                    <h4>Football Coach</h4>
                    <p>Gregor then turned to look out the window at the dull weather. Drops of rain could pane,which made..</p>
                    <div class="button-main bg-fio-point">Enroll now</div>
                       <div class="like-wrap">
                           <a href="#"><i class="fa fa-heart col-red"></i></a><span>224</span>
                           <a href="#"><i class="fa fa-comment col-green"></i></a><span>89</span>
                       </div>
                	   </div>
                    </div>
                 </div>
                <div class="item col-md-4">
                   <div class="blok-read-sm">
                       <a href="#" class="hover-image">
                          <img src="{{url('assets/main/img/baseball.jpg')}}" alt="image">
                          <span class="layer-block">Registration Available</span>
                       </a>
                        <div class="info-text visible-md visible-lg">
			             	<span class="left-text">45 Min</span>
			             	<span class="right-text">Intermediate</span>
		             	</div>
                    <div class="content-block">
                      <span class="point-caption bg-blue-point"></span>
                      <span class="bottom-line bg-blue-point"></span>
                        <h4>Baseball Coach</h4>
                        <p>Gregor then turned to look out the window at the dull weather. Drops of rain could pane,which made..</p>
                        <div class="button-main bg-fio-point">Enroll now</div>
                         <div class="like-wrap">
                             <a href="#"><i class="fa fa-heart col-red"></i></a><span>224</span>
                             <a href="#"><i class="fa fa-comment col-green"></i></a><span>89</span>
                         </div>
                    	</div>
                    </div>
                </div>
            </section>
	<!-- end Information -->
	<!-- Countdown -->
    <section id="menu-countdown" class="countdown generic examples examples--styled">
         <h2 id="fittext2" class="title-start white">Countdown</h2>
         <p class="sub-title white">It's never too late, Get yourself Registered</p>
       	 <div class="container">
       	 	<div class="contents">
         <!-- Valid global date and time string -->
         		<div>
         			<time id="fittext2" >2015-06-08T17:47:00+0100</time>
         		</div><!-- Paris (winter) -->
         	</div>	
        </div>
    </section>
	<!-- end Countdown -->


	<!-- Pricing Table -->
	<section id="menu-price" class="container price generic">
		<h2 id="fittext2" class="title-start">Pricing</h2>
        <p class="sub-title">Most Affordable pricing</p>

        <div class="pricing-table-col col-md-4">
	        <ul>
	            <li class="head">
	                <h2>Basic</h2>
	                <p class="price"><span>$29.90</span> /month</p>
	            </li>
	            <li>
	                Pro Coach
	            </li>
	            <li>
	                No support
	            </li>
	            <li>
	                Sports Materials Support
	            </li>
	            <li>
	                10 Video Files
	            </li>
	            <li>
	                Chance to play around the world
	            </li>
	            <li>
	                Live Interview with players
	            </li>

	            <li class="pricing-footer">
	                <a href="#" class="btn-medium empty">
	                    <span>Sign up</span>
	                </a>
	            </li>
	        </ul>
	    </div>
	    <div class="pricing-table-col featured-price col-md-4">
	    
	        <ul>
	            <li class="head">
	                <h2>Professional</h2>
	                <p class="price"><span>$29.90</span> /month</p>
	            </li>
	            <li>
	                Pro Coach
	            </li>
	            <li>
	                No support
	            </li>
	            <li>
	                Sports Materials Support
	            </li>
	            <li>
	                10 Video Files
	            </li>
	            <li>
	                Chance to play around the world
	            </li>
	            <li>
	                Live Interview with players
	            </li>

	            <li class="pricing-footer">
	                <a href="#" class="btn-medium empty">
	                    <span>Sign up</span>
	                </a>
	            </li>
	        </ul>
	    </div>
	    <div class="pricing-table-col col-md-4">
	        <ul>
	            <li class="head">
	                <h2>Basic</h2>
	                <p class="price"><span>$29.90</span> /month</p>
	            </li>
	            <li>
	                Pro Coach
	            </li>
	            <li>
	                No support
	            </li>
	            <li>
	                Sports Materials Support
	            </li>
	            <li>
	                10 Video Files
	            </li>
	            <li>
	                Chance to play around the world
	            </li>
	            <li>
	                Live Interview with players
	            </li>

	            <li class="pricing-footer">
	                <a href="#" class="btn-medium empty">
	                    <span>Sign up</span>
	                </a>
	            </li>
	        </ul>
	    </div>
	</section>
	<!-- end Pricing Table -->
	<!-- Testimonials -->
	<section id="menu-testimonial" class="testimonial">
		<div class="container">
		    <h2 id="fittext2" class="title-start white">Testimonial</h2>
	        <p class="sub-title white">Clients Feedback about us</p>
	        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			    <div class="item active">
				    <div class="item-image">
				      <img src="{{url('assets/main/img/client3.jpg')}}" class="img-circle" width="150" height="150" alt="...">
				    </div>  
				    <div class="carousel-caption">
				    	<span class="text-center head-text">Jane Doe</span><br />
				        <i class="fa fa-quote-left"></i> Gregor then turned to look out the window at the dull weather. Drops of rain.<i class="fa fa-quote-right"></i>
				    </div>
			    </div>
			    <div class="item">
			      <div class="item-image">
				      <img src="{{url('assets/main/img/client1.jpg')}}" class="img-circle" width="150" height="150" alt="...">
				    </div>  
				    <div class="carousel-caption">
				    <span class="text-center head-text">Jane Doe</span><br />
				        <i class="fa fa-quote-left"></i> Gregor then turned to look out the window at the dull weather. Drops of rain.<i class="fa fa-quote-right"></i>
				    </div>
			    </div>
			    <div class="item">
			      <div class="item-image">
				      <img src="{{url('assets/main/img/client2.jpg')}}" class="img-circle" width="150" height="150" alt="...">
				    </div>  
				    <div class="carousel-caption">
				    <span class="text-center head-text">Jane Doe</span><br />
				        <i class="fa fa-quote-left"></i> Gregor then turned to look out the window at the dull weather. Drops of rain.<i class="fa fa-quote-right"></i>
				    </div>
			    </div>
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <span class="fa fa-angle-left fa-2x" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <span class="fa fa-angle-right fa-2x" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
	</section>
	<!-- end Testimonials -->

	<!-- Contact-->
	<section id="menu-contact" class="container contact generic">
		<h2 id="fittext2" class="title-start">Contact us</h2>
	    <p class="sub-title">Contact us for everything you need..</p>
		<div class="map col-md-6 col-sm-6 col-xs-12">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2825.211958629328!2d91.83379900000003!3d24.909438007883935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x37505558dd0be6a1%3A0x65c7e47c94b6dc45!2sTechnext!5e1!3m2!1sen!2s!4v1425297675833" width="100%" height="354" frameborder="0" style="border:0">
          </iframe>
		</div>	
       <div class="contact-form-full col-md-6 col-sm-6 col-xs-12">
            <div class="inner contact">
                <!-- Form Area -->
                <div class="contact-form">
                    <!-- Form -->
                    <form id="contact-us" method="post" action="#">
                        <!-- Left Inputs -->
                        <div class="col-xs-12 wow animated slideInLeft" data-wow-delay=".5s">
                            <!-- Name -->
                            <input type="text" name="name" id="name" required="required" class="form" placeholder="Name" />
                            <!-- Email -->
                            <input type="email" name="mail" id="mail" required="required" class="form" placeholder="Email" />

                        </div><!-- End Left Inputs -->
                        <!-- Right Inputs -->
                        <div class="col-xs-12 wow animated slideInRight" data-wow-delay=".5s">
                            <!-- Message -->
                            <textarea name="message" id="message" class="form textarea"  placeholder="Message"></textarea>
                        </div><!-- End Right Inputs -->
                        <!-- Bottom Submit -->
                        <div class="relative fullwidth col-xs-12">
                            <!-- Send Button -->
                            <button type="submit" id="submit" name="submit" class="form-btn semibold">Send Message</button>
                        </div><!-- End Bottom Submit -->
                        <!-- Clear -->
                        <div class="clear"></div>
                    </form>

                    <!-- Your Mail Message -->
                    <div class="mail-message-area">
                        <!-- Message -->
                        <div class="alert gray-bg mail-message not-visible-message">
                            <strong>Thank You !</strong> Your email has been delivered.
                        </div>
                    </div>

                </div><!-- End Contact Form Area -->
            </div><!-- End Inner -->
          </div>
	</section>
	<!-- end Contact -->

@endsection
