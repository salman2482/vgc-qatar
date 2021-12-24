@extends('front-end.layouts.master')
@section('styles')
{!! NoCaptcha::renderJs() !!}
    <style>
        .sec-title .service-h2:after{
	        content:none;
            padding-bottom: 15px;
        }

        .fact-counter .column .inner:before {
            content: none;
        }

        .sec-title h2:after {
            position: absolute !important;
            content: '' !important;
            left: 0px !important;
            bottom: 0px !important;
            height: 0px !important;
            width: 0p !important;
            background-color: none !important; 
            display: none !important;
        }

        .map-info-section .outer-container .right-column .content {
            position: relative;
            max-width: 600px;
            float: left;
            width: 100%;
            padding: 5px 20px 5px 20px;
        }

        @media screen and (max-width: 1000px){
            .wp-video-shortcode{
                width: 100%;
            }
            
        }
       

        @media screen and (max-width: 1100px) and (min-width: 710px){
            .carousel-caption{
                top: 50px !important;
                position: absolute !important;
                right: 15% !important;
                left: 15% !important;
                z-index: 10 !important;
                padding-top: 50px !important;
                color: #fff !important;
                text-align: center !important;
            }
            #carousel-h1{
                font-size: 35px !important;
            }
            #carousel-h2{
                font-size: 18px !important;
            }
        }

        /* On screens that are 600px wide or less, the background color is olive */
        @media screen and (max-width: 700px) {
            .carousel-caption{
                position: absolute !important;
                right: 15% !important;
                left: 15% !important;
                z-index: 10 !important;
                padding-top: 50px !important;
                color: #fff !important;
                text-align: center !important;
            }
            #carousel-h1{
                font-size: 35px !important;
            }
            #carousel-h2{
                font-size: 18px !important;
            }
        }

        @media screen and (min-width: 1200px){

            .carousel-caption{
                top: 200px !important;
                position: absolute !important;
                right: 15% !important;
                left: 15% !important;
                z-index: 10 !important;
                padding-top: 50px !important;
                color: #fff !important;
                text-align: center !important;
            }
            #carousel-h1{
                font-size: 55px !important;
            }
            #carousel-h2{
                font-size: 38px !important;
            }
        }
        .carousel-control-next-icon, .carousel-control-prev-icon {
            width: 60px;
            height: 46px;
        }

        .img-wrap {
        display: block !important;
        position: relative !important;
        height: auto !important;
        }

        .img-wrap:before {
        display: block !important;
        content: '' !important;
        position: absolute !important;
        width: 100% !important;
        height: 100% !important;
        background:linear-gradient(0deg, rgb(25 24 25 / 30%), rgb(12 11 12 / 30%) )!important;
        }

        .carousel-img {
        display: block !important;
        width: 100% !important;
        height: auto !important;
        }

    </style>
@endsection
@section('front-end-content')
    <!--Main Slider-->
    <?php $sliders = \App\Models\FrontBanner::whereIn('id', [67, 68, 70, 69])->get(); ?>
    
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        
        <div class="carousel-inner">
        
        @foreach ($sliders as $slider)
        <?php $attachment = \App\Models\Attachment::Where('attachmentresource_id', $slider->id)
            ->Where('attachmentresource_type', 'frontbanner')->first();
        ?>
          <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
            
            <div class="img-wrap">
                <img class="d-block w-100 carousel-img" src="{{asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)}}" alt="First slide" >
            
            </div>
            <div class="carousel-caption">
                <h1 id="carousel-h1">
                    @if(App::isLocale('ar'))
                    {{ $slider->title_ar}}
                    @else
                    {{ $slider->title}}
                    @endif
                </h1>
                <h2 id="carousel-h2"> 
                    @if(App::isLocale('ar'))
                    {!! ($slider->description_ar) !!}
                    @else
                    {!! ($slider->description) !!}
                    @endif 
                </h2>
              </div>
          </div>
        @endforeach

         
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    <!--End Main Slider-->


    <section class="about-section-two about-company">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Column-->
                <div class="column col-lg-6 col-md-6 col-sm-12">
                    <div class="text-dark" style="padding-bottom: 40px;">
                        <div class="text">
                            <h4>
                                <span style="font-weight: 700;">
                                    @if(App::isLocale('ar'))
                                    {!! ($data['veteranText']->title_ar) !!}
                                    @else
                                    {!! ($data['veteranText']->title) !!}
                                    @endif
                                    
                                </span>
                            </h4>
                            <p>

                                @if(App::isLocale('ar'))
                                <p>{!! ($data['veteranText']->description_ar) !!}</p>
                                @else
                                <p>{!! ($data['veteranText']->description) !!}</p>
                                @endif  
                            </p>
                            <a  class="theme-btn btn-style-one" href="{{ route('front.contact-us') }}" type="submit" class="theme-btn btn-style-one">
                                <span class="txt">{{__('fl.Contact us')}}</span> 
                                <span class="icon flaticon-share-option"></span>
                            </a>
                        </div>


                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 mt-1">
                    <div class="image-box">
                        <iframe width="600" height="413" class="index-iframe" src="https://www.youtube.com/embed/-N_UAwPaMNg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Fluid Section One-->
    <section class="fluid-section-one">
        <div class="outer-container clearfix">

            <!--Image Column-->
            <div class="image-column" style="background-image:url('/public/front-end/images/resource/image-1.jpg');">
                <figure class="image-box"><img src="{{ asset('public/front-end/images/resource/image-1.jpg') }}" alt="">
                </figure>
            </div>

            <!--Content Column-->
            <div class="content-column">
                <div class="inner-column">
                    <h2>
                        @if(App::isLocale('ar'))
                        {!! $data['whyChooseText']->title_ar !!}
                        @else
                        {!! $data['whyChooseText']->title !!}
                        @endif
                    </h2>
                    <div class="text">
                        @if(App::isLocale('ar'))
                        {!! $data['whyChooseText']->description_ar !!}
                        @else
                        {!! $data['whyChooseText']->description !!}
                        @endif    
                    </div>
                    <div class="row clearfix">

                        @foreach ($data['bmps'] as $item)
                        <div class="column col-lg-6 col-md-6 col-sm-12">
                            <!--Featured Block-->
                            <div class="featured-block">
                                <div class="feature-inner">
                                    <div class="icon-box">
                                        <?php $attachment = \App\Models\Attachment::Where('attachmentresource_id', $item->id)->Where('attachmentresource_type', 'frontbanner')->first(); ?>

                                        <img style="width: auto !important; height: 55px;"
                                            src="{{ url('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}"
                                            alt="" />
                                    </div>
                                    <h3>
                                        @if(App::isLocale('ar'))
                                            {!! ($item->title_ar) !!}
                                        @else
                                            {!! ($item->title) !!}
                                        @endif 
                                        <br> 
                                    </h3>
                                    <p>
                                        @if(App::isLocale('ar'))
                                        {!! ($item->description_ar) !!}
                                        @else
                                        {!! ($item->description) !!}
                                        @endif 
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach                        

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Fun Facts Section-->
    <div class="fact-counter-section">
        <div class="fact-counter">
            <div class="auto-container">
                <div class="row clearfix">
                
                    <!--Column-->
                    <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                        <div class="inner">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="2000" data-stop="468">0</span>
                                <h5 class="counter-title">{{__('fl.Employees')}}</h5>
                            </div>
                        </div>
                    </div>
            
                    <!--Column-->
                    <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                        <div class="inner">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="3500" data-stop="63">0</span>
                                <h5 class="counter-title">{{__('fl.Projects')}}</h5>
                            </div>
                        </div>
                    </div>
        
                    <!--Column-->
                    <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                        <div class="inner">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="2000" data-stop="27">0</span>
                                <h5 class="counter-title"> {{ __('fl.Services') }}</h5>
                            </div>
                        </div>
                    </div>
            
                    <!--Column-->
                    <div class="column counter-column col-lg-3 col-md-6 col-sm-12">
                        <div class="inner">
                            <div class="count-outer count-box">
                                <span class="count-text" data-speed="2000" data-stop="100">0</span>%
                                <h5 class="counter-title">{{__('fl.Satisfied Clients')}}</h5>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!--End Fun Facts Section-->

    <section class="case-section" style="padding: 20px 0px 20px;">
        <div class="auto-container">
            <div class="sec-title centered" style="margin-bottom: 0px !important;">
                <h2 class="service-h2" style="padding-bottom: 5px !important;">{{__('fl.Our Services')}}</h2>
            </div>
        </div>
        <!--Four Item Carousel-->
        <div class="four-item-carousel owl-carousel owl-theme">

            @foreach ($services as $service)
            <!--Case block-->
            <div class="case-block ml-2">
                <div class="inner-box">
                    <div class="image">
                        @foreach ($service->attachments as $attachment)
                        @if ($attachment->attachmentresource_id == $service->id)

                            <img class="services-image" src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}" 
                            style="height:230px !important; ">
                        @endif
                        @endforeach
                        <div class="overlay-box">
                            <div class="overlay-inner">
                                <div class="content">
                                    <h3><a href="{{ route('front.single-corporate-services',$service->id ) }}">
                                        {{$service->title}}
                                    </a></h3>
                                    <div class="text">
                                    {{ str_limit($service->description) }}    
                                    </div>
                                    <a href="{{ route('front.single-corporate-services',$service->id ) }}" 
                                        class="btn btn-success read-more">
                                        {{__('fl.READ MORE')}}
                                        <span class="fa fa-long-arrow-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--Lower Box-->
        
        
    </section>


    <!--Sponsors Section client logos-->
    <section class="sponsors-section" style="background-image:url(images/background/1.jpg); padding: 18px 0px 50px;" >
        <div class="auto-container" >
            <div class="carousel-outer">
                <!--Sponsors Slider-->
                <div class="sec-title centered" style="margin-bottom:0px !important;">
                    <h2 class="service-h2 text-light" style="padding-bottom:0px !important;">{{ __('fl.Our Clients') }}</h2>
                </div>
                <ul class="sponsors-carousel owl-carousel owl-theme">
                    @foreach ($attachments as $attachment)
                        @if ($attachment->attachment_unique_input == 'frontclient')
                            <li>
                                <div class="image-box">
                                    <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"
                                        alt="Client Pic">

                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!--End Sponsors Section-->

    <!--News Section iso-->
    <section class="news-section">
        <div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title centered">
                <h2 style="padding-bottom: 25px !important;">{{__('fl.ISO CERTIFIED')}}</h2>
            </div>
            
            <div class="row clearfix">
                
                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                        <a href="javascript:void(0)">
                            <img src="{{asset('public/front-end/images/icons/Iso-for-web.jpg')}}" alt="" 
                            style="width: 40% !important;
                            top: -30px !important;
                            left: 28%; !important" />
                        </a>
                        </div>
                        <div class="lower-content">
                            <h5><a href="javascript:void(0)">ISO 9001</a></h5>
                            <div class="text">{{__('fl.iso1')}}</div>
                            
                        </div>
                    </div>
                </div>
                
                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                        <a href="javascript:void(0)">
                            <img src="{{asset('public/front-end/images/icons/Iso-for-web.jpg')}}" alt="" 
                            style="width: 40% !important;
                            top: -30px !important;
                            left: 28%; !important" />
                        </a>
                        </div>
                        <div class="lower-content">
                            <h5><a href="javascript:void(0)">OHSAS 18001</a></h5>
                            <div class="text">{{__('fl.iso2')}}</div>
                            
                        </div>
                    </div>
                </div>
                
                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                        <a href="javascript:void(0)">
                            <img src="{{asset('public/front-end/images/icons/Iso-for-web.jpg')}}" alt="" 
                            style="width: 40% !important;
                            top: -30px !important;
                            left: 28%; !important" />
                        </a>
                        </div>
                        <div class="lower-content">
                            <h5><a href="javascript:void(0)">ISO 14001</a></h5>
                            <div class="text">{{__('fl.iso3')}}</div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </section>
    <!--End News Section iso-->


    <!--Map Info Section-->
    <section class="map-info-section">
        <div class="outer-container">
            <div class="clearfix">
                <!--Left Column-->
                <div class="left-column">
                    <!--Map Outer-->
                    <div class="map-outer">
                        <!--Map Canvas-->
                        <div class="map-canvas"
                            data-zoom="12"
                            data-lat="25.251581470305847"
                            data-lng="51.565075140425854"
                            data-type="roadmap"
                            data-hue="#ffc400"
                            data-title="Veteran General Contracting"
                            data-icon-path="{{asset('public/front-end/images/icons/map-marker.png')}}"
                            data-content="Al-Mannai Building,1st Floor Office N6, Old Airport road opposite of Q-jet 
                            P.O. Box 201455 Doha, Qatar<br><a href='https://www.google.com/maps/@25.250661,51.563096,16z?hl=en-GB'>{{__('fl.Doha')}} {{__('fl.Qatar')}}</a>">
                        </div>

                    </div>
                </div>
                <!--Right Column-->
                  <div class="right-column" style="background-image:url({{asset('public/front-end/images/resource/image-1.jpg')}})">
                    <div class="content">
                        <h3>{{__('fl.Contact us')}}</h3>
                        <div class="text">{{__('fl.If you have any query you can contact us')}}</div>
                        
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                            <strong>{{ session()->get('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                            
                        <!-- Quote Form -->
                        <div class="quote-form">
                            
                            <!--Contact Form-->
                            <form method="POST" action="{{route('front.submit-usercomplain','Contact Us')}}" id="contact-forma">
                                    @csrf
                                <div class="row clearfix">
                                
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your name" required {{ session('success') ? 'autofocus' : '' }} {{ $errors->has('g-recaptcha-response') ? 'autofocus' : ''}} >
                                    </div>
                                    
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" name="email" value="{{ old('email') }}" placeholder="Your email address" required>
                                    </div>
                                    
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone number" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Subject" required>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                        <textarea name="message" id="message" cols="30" rows="10" required placeholder="Type your massage here..." style="border-radius: 4px; background: #ffffff;">{{ old('message') }}</textarea>
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
                                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                        <button type="submit" class="theme-btn btn-style-one">
                                            <span class="txt">{{__('fl.Submit request')}}</span> 
                                            <span class="icon flaticon-share-option"></span>
                                        </button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!--End Map Info Section-->

    <?php $rec =  \App\Models\FrontBanner::where('id', 62)->first(); ?> 
@isset($rec)

    <div class="modal" id="pop-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-danger">
                        @if(App::isLocale('ar'))
                            <h2>{!! ($rec->title_ar) !!}</h2>
                            @else
                            <h2>{!! ($rec->title) !!}</h2>
                            @endif
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        @if(App::isLocale('ar'))
                            <p>{!! ($rec->description_ar) !!}</p>
                            @else
                            <p>{!! ($rec->description) !!}</p>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    @endisset

@endsection

@section('scripts')
<script>
    $(window).load(function() {
        if ( ! localStorage.getItem("showModal")) {
            $('#pop-modal').modal('show');
        localStorage.setItem('showModal', 'true');
    }

    });

</script>
@endsection
