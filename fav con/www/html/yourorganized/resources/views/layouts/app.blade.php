<!doctype html>
<html lang="en">
<head>
	<!-- Define Charset -->
	<meta charset="UTF-8">
	<!-- Page Title -->
	  <title> @yield('title')</title>
	
	<!-- Responsive Metatag --> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
	<!-- Stylesheet
	===================================================================================================  -->
	<link rel="stylesheet" href="{!! asset('assets/main/font/fontello.css') !!}">
	<link rel="stylesheet" href="{!! asset('assets/main/css/bootstrap.min.css') !!}">
	<link rel="stylesheet" href="{!! asset('assets/main/css/style.css') !!}">
	<link rel="stylesheet" href="{!! asset('assets/main/css/media-queries.css') !!}">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{!! asset('assets/main/css/countdown.demo.css') !!}" type="text/css">
  <!-- slider -->  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

         @stack('styles') 
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
    <![endif]-->      
	</head>	
	<body>

	<!-- Header -->
	<div class="homepage">
	<header>
	    <div class="navbar navbar-default" role="navigation">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="#">Your Organized</a>
	        </div>
	        <div class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li class="active"><a href="{{url('/')}}">Home</a></li>
                    @if(request()->is('/'))
	            <li><a href="#menu-features">About us</a></li>
                    @php /*   
                    <li><a href="#menu-information">Courses</a></li>
	            <li><a href="#menu-countdown">Countdown</a></li>
                    
                    */ @endphp
	            <li><a href="#menu-price">Pricing</a></li>
	            <li><a href="#menu-testimonial">Testimonials</a></li>
	            <li><a href="#menu-contact">Contact</a></li>
                    @endif
                    
                    @if(!Auth::user())
                    
                     <li><a class="btn-success" data-toggle="modal" data-target="#signin-modal" href="#">Login</a></li>
                       <li><a class="btn-primary" data-toggle="modal" data-target="#signup-modal" href="#">Register</a></li>
                       @else
                       
                          <li><a class="btn-danger" data-toggle="modal" data-target="#Logout" href="#">Logout</a></li>
                        @endif
                       
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
	</header>
	<!-- end Header -->
</div>
      
	 @yield('content')
         
	<!-- Footer -->
	<section class="footer">
	    <div class="footer-section container">
	       <div class="item-footer col-sm-6 col-xs-12 col-md-3">
	            <a class="navbar-logobrand" href="#">Your Organized</a>
	       </div>
	       <div class="item-footer col-sm-6 col-xs-12 col-md-3">
	            <h4 class="footer-title">Top Links</h4>
	            <ul class="gold links-footer">
	            	<li>Home</li>
	            	<li>About us</li>
	            	<li>Services</li>
	            	<li> Contact</li>
	            </ul>
	       </div>
	       <div class="item-footer col-sm-6 col-xs-12 col-md-3">
	            <h4 class="footer-title">Category</h4>
	            <ul class="gold links-footer">
	            	<li>Football</li>
	            	<li>Cricket</li>
	            	<li>Baseball</li>
	            	<li>Others</li>
	            </ul>
	       </div>
	       <div class="item-footer col-sm-6 col-xs-12 col-md-3">
	            <h4 class="footer-title footer-tags">Tags</h4>
	            <span class="fa fa-tag gold"> Cricket</span><span class="fa fa-tag gold"> Cricket</span><span class="fa fa-tag gold"> Cricket</span><br /><span class="fa fa-tag gold"> Cricket</span><span class="fa fa-tag gold"> Cricket</span><span class="fa fa-tag gold"> Cricket</span>
	       </div>
	   </div>
    </section>
    <section class="footer-bottom">
    	<p class="text-center copyright-text">&copy;Your Organized - All Rights Reserved</p>
    </section>
        
        
        
        @if(!Auth::user())
        
         <div class="modal fade" id="signin-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Login</h4>
        </div>
        <div class="modal-body">
         <div class="modal-body p-3 p-sm-4">
              
               <div class="tab-content" id="myTabContent">
             
                      
                        @foreach ($errors->all() as $error)
                       
                              <div class="alert alert-danger"> * {{ $error }} <br> </div>
                             @endforeach
                   <form  method="post" action="{{ url('login') }}" class="row">
                       @csrf
                         <div class="form-group mb-20 col-12">
                             <label class="text-secondary h6 font-weight-600 mb-2" for="email">Email Address*</label>
                             <input class="form-control shadow-none rounded-sm" required  type="email" name="email" valid  id="email" >
                         </div>
                         <div class="form-group mb-20 col-12">
                             <label class="text-secondary h6 font-weight-600 mb-2" for="passwordSignIn">Password*</label>
                             <input class="form-control shadow-none rounded-sm" autocomplete="off"  name="password" type="password" id="passwordSignIn" required>
                         </div>
                         <div class="form-group mb-20 col-12">
                            
                             <input type="checkbox" id="checkbox" value="1" name="remember"> Remember me
                         </div>
                         <div class="form-group col-12">
                             <button class="btn btn-primary w-100 rounded-sm" type="submit">LOGIN</button>
                         </div>
                           <div class="form-group mb-10 col-12">
                             <label class="text-secondary h6 font-weight-600 mb-2" for="email">Don't have an account?</label>
                            <a data-toggle="modal" data-target="#signup-modal" href="#" class="btn btn-info w-100 rounded-sm">SIGN UP</a>
                         </div>
                     
                         <div class="form-group mb-20 col-12">
                             <label class="text-secondary h6 font-weight-600 mb-2" for="passwordSignIn">Forgot your Password?</label>
                           <a href="#" class="btn btn-warning w-100 rounded-sm">RESET</a>
                         </div>
                     
                     </form>
                  </div>
               
               </div>
            </div>
        </div>
        
      </div>
      
    </div>
  
        
          <div class="modal fade" id="signup-modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Register</h4>
        </div>
       <div class="modal-body">
           
           <div class="modal-body p-3 p-sm-4">
                    @foreach ($errors->all() as $error)
                              <div class="alert alert-danger"> * {{ $error }} <br> </div>
                             @endforeach

     <form  method="post" action="{{ url('register') }}" autocomplete="off" class="row">
         @csrf
                    <div class="form-group mb-20 col-6">
                        <label class="text-secondary h6 mb-2" for="fname">First Name</label>
                        <input class="form-control shadow-none rounded-sm" required  type="text" value="{{old('firstname')}}" name="firstname" valid placeholder="First Name" id="fname" >
                    </div>
                    <div class="form-group mb-20 col-6">
                        <label class="text-secondary h6 mb-2" for="fname">Last Name</label>
                        <input class="form-control shadow-none rounded-sm"  id="fname" required  type="text" value="{{old('lastname')}}" name="lastname" valid placeholder="Last Name">
                    </div>
                       <div class="form-group mb-20 col-6">
                        <label class="text-secondary h6 mb-2" for="fname">Country</label>
                        <select class="form-control" required name="country" data-placeholder="Country">
                           @include('misc.country')
             <option selected value="{{old('country')}}" >{{old('country')}}</option>
                        </select>
                    </div>
                
                    <div class="form-group mb-20 col-6">
                        <label class="text-secondary h6 mb-2" for="email">Email Address</label>
                        <input class="form-control shadow-none rounded-sm" autocomplete="off"  required  type="email" value="{{old('email')}}" name="email" valid placeholder='Email' id="email2" >
                    </div>
                     <div class="form-group mb-20 col-6">
                        <label class="text-secondary h6 mb-2" for="">Password</label>
                        <input class="form-control shadow-none rounded-sm" value="{{old('password')}}"  id="password"  autocomplete="false" required name="password" minlength="7" type="password"  placeholder="Password">
                    </div>
                    <div class="form-group mb-20 col-6">
                        <label class="text-secondary h6 mb-2" for="">Repeat Password</label>
                        <input class="form-control shadow-none rounded-sm" autocomplete="new-password" id="password2" name="password_confirmation" type="password"  placeholder="Confirm Password" required minlength="7">
                    </div>
                   
                    <div class="form-group mb-20 col-6">
                        <label class="text-secondary h6 mb-2" for="pnumber">Sport</label>
                        <select class="form-control"  required name="sports" data-placeholder="Sports" >
          <option value="Volleyball">Volleyball</option>
          <option value="Soccer">Soccer</option>
          <option value="Basketball">Basketball</option>
          <option value="{{old('sports')}}" selected>{{old('sports')}}</option>
         </select>
                    </div>
                    <div class="form-group mb-20 col-6">
                        <label class="text-secondary h6 mb-2" for="email2">Code</label>
                        <input class="form-control shadow-none rounded-sm" autocomplete="off"   type="text" value="{{old('code')}}" name="code"  placeholder='Code' >
                    </div>
                       <div class="form-group mb-20 col-12">
                            
                           <input  id="checkbox" required type="checkbox" value="Accepted" name="terms"> I accept the <a href="#">Terms and Conditions</a>
                             
                         </div>
                          <div class="form-group mb-20 col-12">
                          
                    </div>
                    <div class="form-group col-12">
                        <button class="btn btn-primary w-100 rounded-sm" type="submit">REGISTER</button>
                    </div>
                </form>
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
          
      </div>
      
    </div>
  </div>
  
 @else
  
  <div class="modal" id="Logout">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h3 class="modal-title">Logout</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       Are you sure you want to logout? 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
         <a  href="{{url('logout')}}" class="btn btn-danger" >Logout</a>
      </div>

    </div>
  </div>
</div> 
  
  @endif
        
    <!--end Modal 6 img -->
    <!-- ======================= JQuery libs =========================== -->

        <!-- jQuery -->
        <script src="{!! asset('assets/main/js/jquery-1.9.1.min.js') !!}"></script>
        <!-- Bootstrap -->
        <script src="{!! asset('assets/main/js/bootstrap.min.js') !!}"></script>      
        <script src="{!! asset('assets/main/js/nav/jquery.scrollTo.js') !!}"></script> 
        {{-- <script src="{!! asset('assets/main/js/nav/jquery.nav.js') !!}"></script> --}}
        <script src="{!! asset('assets/main/js/jquery-scrolltofixed.js') !!}"></script> 
        <script src="{!! asset('assets/main/js/jquery.fittext.js') !!}"></script>
    	<script src="{!! asset('assets/main/js/modernizr.js" type="text/javascript') !!}"></script>
    	<!-- Custom -->
        <script src="{!! asset('assets/main/js/script.js') !!}"></script>
        <script src="{!! asset('assets/main/js/jquery.countdown.js') !!}"></script>
        <script type="text/javascript">
       		$("#fittext3,#fittext2").fitText(.95, { minFontSize: '35px', maxFontSize: '95px' });
        </script>
         
        
         @stack('scripts') 
    </body>
  @if(session()->has('message')) <script> $('#{{ session()->get('message') }}').modal('show');</script> @endif    
</html>