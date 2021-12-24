@extends('front-end.layouts.master')
@section('styles')
{!! NoCaptcha::renderJs() !!}
@endsection

@section('front-end-content')

@if ($attachment->attachment_unique_input === 'frontbanner')
        <img class="img-fluid" src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" style="height: " alt="">
    @endif


    <!--About Section-->
    <section class="about-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Column-->
                <div class="content-column col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 20px !important;"> 
                    <div class="inner-column">
                        <div class="content-column col-lg-12 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="sec-title">
                                    @if(App::isLocale('ar'))
                                    <h2>{!! ($banner->title_ar) !!}</h2>
                                    @else
                                    <h2>{!! ($banner->title) !!}</h2>
                                    @endif
                                </div>
                                <div class="text">
                                    @if(App::isLocale('ar'))
                                    <p>{!! ($banner->description_ar) !!}</p>
                                    @else
                                    <p>{!! ($banner->description) !!}</p>
                                    @endif
                                </div>    
                            </div>
                        </div>
                        <div class="text">
                            <section class="contact-location-section" style="padding: 0px !important">
                                <div class="auto-container">
                                    <div class="row clearfix">
                                        
                                        <!--Column-->
                                        <div class="info-column col-lg-4 col-md-6 col-sm-12">
                                            <div class="column-inner" style="height: 180px">
                                                <div>
                                                    <a href='https://www.google.com/maps/@25.250661,51.563096,16z?hl=en-GB'>
                                                    <i class="flaticon-pin" style="font-size: 50px;" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="text"> 
                                                   {{__('fl.site_address')}}
                                                </div>

                                            </div>
                                        </div>
                                        
                                         <!--Column-->
                                        <div class="info-column col-lg-4 col-md-6 col-sm-12">
                                            <div class="column-inner" style="height: 180px">
                                                <div >
                                                    <a href="javaScript::void()" id="contact-focus">
                                                        <i class="fa fa-envelope" style="font-size: 50px" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="text">
                                                    Contact US
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                         <!--Column-->
                                        <div class="info-column col-lg-4 col-md-6 col-sm-12">
                                            <div class="column-inner" style="height: 180px">
                                                <div>
                                                    <a href="">
                                                        <i class="fa fa-phone" style="font-size: 50px" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <ul>
                                                    <li>Phone: +974 44441061</li>
                                                    <li>Fax: +974 44441062</li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>
                            <!--End Contact Location Section-->
                            
                            <!--Contact Section-->
                            <section class="contact-page-section" style="padding: 0px !important;">
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
                                            
                                                <!--Sec Title-->
                                                   <div class="sec-title">
                                                   <h2>{{__('fl.Any Question? Leave Us a Message')}}</h2>
                                                </div>
                                                <!--Contact Form-->
                                                <div class="contact-form">
                                                    <form method="POST" 
                                                    action="{{route('front.submit-usercomplain','Contact Us')}}" id="contact-forma">
                                                        @csrf
                                                        <div class="row clearfix">
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="name" name="name" required
                                                                value="{{ old('name') }}" placeholder="Your name"  autofocus>
                                                            </div>
                                                            @error('name')
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <div class="error">{{ $message }}</div>
                                                            </div>
                                                            @enderror
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="email" placeholder="Your email address" required value="{{ old('email') }}">
                                                            </div>
                                                            @error('email')
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <div class="error">{{ $message }}</div>
                                                            </div>
                                                            @enderror
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="phone" placeholder="Phone number" required value="{{ old('phone') }}">
                                                            </div>
                                                            @error('phone')
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <div class="error">{{ $message }}</div>
                                                            </div>
                                                            @enderror
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="subject" placeholder="Subject" required value="{{ old('subject') }}">
                                                            </div>
                                                            @error('subject')
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <div class="error">{{ $message }}</div>
                                                            </div>
                                                            @enderror
                                                            
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <textarea name="message" placeholder="Type your massage here...">{{ old('message') }}</textarea>
                                                            </div>
                                                            @error('message')
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <div class="error">{{ $message }}</div>
                                                            </div>
                                                            @enderror

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
                                                            
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <button type="submit" class="theme-btn btn-style-one"><span class="txt">{{__('fl.Submit')}}</span></button>
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
