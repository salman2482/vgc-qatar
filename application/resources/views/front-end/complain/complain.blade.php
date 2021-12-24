@extends('front-end.layouts.master')
@section('styles')
{!! NoCaptcha::renderJs() !!}
@endsection

@section('front-end-content')

    <!--Page Title-->
    <img src="{{ asset('/public/front-end/images/resource/contact.jpg') }}" alt="">
    


    <!--About Section-->
    <section class="about-section" style="padding: 0px !important;">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Column-->
                <div class="content-column col-lg-12 col-md-12 col-sm-12" > 
                    <div class="inner-column">  
                            <!--Contact Section-->
                            <section class="contact-page-section" style="padding: 20px 0px 10px !important;">
                                <div class="auto-container">
                                    <div class="row clearfix">
                                       
                                        <!--Form Column-->
                                        <div class="form-column col-lg-12 col-md-12 col-sm-12">
                                            <div class="inner-column">
                                                
                                                @if (session()->has('success'))
                                                    <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                                                    <strong>{{ session()->get('success') }}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                @endif

                                                   <div class="sec-title">
                                                   <h2>{{__('fl.Any Complain? Leave Us a Message')}}</h2>
                                                </div>
                                                <!--Contact Form-->
                                                <div class="contact-form">
                                                  

                                                    <form method="POST" action="{{route('front.submit-usercomplain','Complain')}}" id="contact-form" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row clearfix">
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="name" name="name" placeholder="Your name" required autofocus value="{{ old('name') }}">
                                                            </div>
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="email" placeholder="Your email address" required value="{{ old('email') }}">
                                                            </div>
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="phone" placeholder="Phone number" required value="{{ old('phone') }}">
                                                            </div>
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="subject" placeholder="Subject" required value="{{ old('subject') }}">
                                                            </div>
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <textarea name="message" placeholder="Type your massage here...">{{ old('message') }}</textarea>
                                                            </div>
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="file" name="attachment" placeholder="attachment" required>
                                                            </div>
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                @if ($errors->has('g-recaptcha-response'))
                                                                <span class="help-block">
                                                                    <strong class="text-danger">
                                                                        {{ $errors->first('g-recaptcha-response') }}
                                                                    </strong>
                                                                </span>
                                                                @endif
                                                                {!! app('captcha')->display() !!}
                                                            </div> 
                                                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                                <button type="submit" class="theme-btn btn-style-one"><span class="txt">{{__('fl.Submit')}}</span></button>
                                                            </div>  

                                                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                                
                                                            </div>  
                                                           
                                                        </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section-->
@endsection
@section('scripts')
<script type="text/javascript">
    $(function() {
        $('#contact-focus').click(function(){
            $("#firstname").focus();
        });
    });
</script>
@endsection
