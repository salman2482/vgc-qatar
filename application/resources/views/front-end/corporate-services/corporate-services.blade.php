@extends('front-end.layouts.master')
@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Ubuntu" rel="stylesheet">
    <style>
        .services-div {
            padding: 10px;
            margin-left: 10px;
        }

        .card-title {
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-text {
            line-height: 20px;
            height: 160px;
            overflow: hidden;
            margin-top: 45px;
        }
    </style>
@endsection

@section('front-end-content')

@if ($attachment->attachment_unique_input === 'frontbanner')
        <img class="img-fluid" src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" style="height: " alt="">
    @endif

</section>
    <!--About Section-->
    <section class="about-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Column-->
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

                            <section class="case-page-section" style="padding: 0px !important;">
                                <div class="auto-container">
                                    <!--MixitUp Galery-->
                                    <div class="mixitup-gallery">
                                        <div class="filter-list row clearfix">
                                            <!--Case block-->
                                            @forelse ($services as $service)
                                                <div class="case-block mix planning col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 0px !important;">
                                                    <div class="case-block services-div">
                                                        <div class="card text-center">
                                                            @foreach ($attachments as $attachment)
                                                                @if ($attachment->attachment_unique_input === 'corporateservice')
                                                                @if ($attachment->attachmentresource_id == $service->id)
                                                                <div class="image">
                                                                    <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"
                                                                        class="" style="background-size: cover;background-position: center;height:230px;">
                                                                        </div>
                                                                        @endif
                                                                        @endif

                                                            @endforeach
                                                            <div >
                                                                <h5 class="card-title">{{ $service->title }}</h5>

                                                                <p >
                                                                    {!! str_limit($service->description, 400) !!}
                                                                </p>
                                                    <a href="{{ route('front.single-corporate-services',$service->id ) }}"
                                                                    class="theme-btn btn-style-one">
                                                                    <span class="txt">View Details</span> 
                                                                    <span class="icon flaticon-share-option"></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <a  class="theme-btn btn-style-one" href="{{ route('front.contact-us') }}" type="submit" class="theme-btn btn-style-one">
                                                    <span class="txt">{{__('fl.Contact us')}}</span> 
                                                    <span class="icon flaticon-share-option"></span>
                                                </a>
                                            @endforelse

                                        </div>
                                    </div>

                                </div>
                            </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section-->
@endsection
