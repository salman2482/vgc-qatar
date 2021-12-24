@extends('front-end.layouts.master')
@section('styles')
@endsection
@section('front-end-content')
    <!--Page Title-->
    @if ($attachment->attachment_unique_input === 'frontbanner')
        <img class="img-fluid" src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" style="height: " alt="">
    @endif

    <div class="sidebar-page-container" style="padding: 30px 0px 0px !important;">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Shop Single-->
                @if (session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="col-lg-6 col-sm-12">
                    <div class="sec-title">
                        @if (App::isLocale('ar'))
                            <h2>{!! $banner->title_ar !!}</h2>
                        @else
                            <h2>{!! $banner->title !!}</h2>
                        @endif
                    </div>
                    <div class="text">
                        @if (App::isLocale('ar'))
                            <p>{!! $banner->description_ar !!}</p>
                        @else
                            <p>{!! $banner->description !!}</p>
                        @endif

                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 mt-1">
                    <div class="image-box">
                        <iframe width="600" height="413" class="index-iframe" src="https://www.youtube.com/embed/V-_-zAZnmxg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>

                    
                </div>

            </div>

            <!--Content Side-->
            <div class="content-side col-lg-12 col-md-12 col-sm-12 mt-5">
                <div class="shop-section">
                    <div class="our-shops" style="padding-bottom: 0px !important; margin-bottom: 0px !important;">
                        <div class="row clearfix">
                            <!--Shop Item-->
                            @foreach ($services as $item)
                                <div class="shop-item col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="inner-box">
                                        <div class="image" style="background-color:#fff">
                                            <img src="{{ asset('storage/public/service_image/' . $item->image) }}"
                                                    alt=""
                                                    style="background-size: cover;background-position: center;width:250px;">
                                        </div>
                                        <div class="lower-content clearfix">
                                            <div>
                                                <h6>
                                                    {{ $item->title }}
                                                </h6>
                                                <a href="{{ route('front.service.details', $item->id) }}" class="theme-btn btn-style-one p-2 mt-2 "><span class="txt">Book Now</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
   

@endsection

