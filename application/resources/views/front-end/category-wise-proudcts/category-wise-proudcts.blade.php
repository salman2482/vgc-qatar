@extends('front-end.layouts.master')

@section('front-end-content')

@if ($attachment->attachment_unique_input === 'frontbanner')
<img class="img-fluid" src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" style="height: " alt="">
@endif


    <!--About Section-->
    <section class="about-section">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Content Column-->
                <div class="content-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            @if (App::isLocale('ar'))
                                <h2>{{ __('fl.Category') }} : {!! $banner->title_ar !!}</h2>
                            @else
                                <h2>{{ __('fl.Category') }} : {!! $banner->title !!}</h2>
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
                    <!--MixitUp Galery-->
                    <div class="mixitup-gallery">
                        <!--Filter-->
                        <div class="filters clearfix">
                            <div class="filter-list row clearfix">
                                <!--Case block-->
                                @foreach ($products as $product)
                                    <div class="case-block mix planning col-lg-4 col-md-4 col-sm-12 mb-2">
                                        <div class="inner-box" style="overflow: hidden !important;">
                                            <div class="image">
                                                @foreach ($attachments as $attachment)
                                                    @if ($attachment->attachment_unique_input == 'fproduct')
                                                        @if ($attachment->attachmentresource_id == $product->id)
                                                            <img style="position: relative"
                                                                src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"
                                                                style="height:400px; width:570px" alt="Product Pic" />

                                                        @endif
                                                    @endif
                                                @endforeach
                                                <div class="overlay-box">
                                                    <div class="overlay-inner">
                                                        <div class="content">
                                                            <h3>
                                                                <a
                                                                    href="{{ route('front.product.details', $product->id) }}">{{ $product->title }}</a>
                                                            </h3>
                                                            <div class="text">
                                                                {{ $product->description }}
                                                            </div>
                                                            <a href="{{ route('front.product.details', $product->id) }}"
                                                                class="btn btn-veteran read-more">View Details
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
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!--End About Section-->
@endsection
