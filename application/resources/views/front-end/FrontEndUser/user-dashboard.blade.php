@extends('front-end.layouts.master')
@section('styles')
    <style>
       .status-img {
            z-index: 1000;
            top: -1px !important;
            left: 13px;
            position: absolute;
            display: inline !important;
            width: 160px;
        }

    </style>
@endsection

@section('front-end-content')
    <section class="page-title" style="background-image:url({{ asset('public/front-end') }}/images/background/2.jpg);">
        <div class="auto-container">
            <h2>My Listings</h2>
        </div>
    </section>
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Side-->
                <div class="content-side col-lg-10 col-md-12 col-sm-12">
                    <!--Shop Single-->
                    @if (session()->has('message'))
                        <div class="alert alert-success" style="color:#28a745;">{{ session('message') }}</div>
                    @endif
                    <div class="shop-section">

                        <div class="our-shops">

                            <div class="row clearfix">
                                <!--Shop Item-->
                                <div class="mixitup-gallery">
                                    <!--Filter-->
                                    <div class="filters clearfix">
                                        <div class="filter-list row clearfix">
                                            <!--Case block-->
                                            @foreach ($properties as $item)
        
                                            @php
                                            $attachment = explode(',', $item->images);
                                            @endphp
        
                                                <div class="case-block mix planning col-lg-4 col-md-4 col-sm-12 mb-2">
                                                    <div class="inner-box" style="overflow: hidden !important;">
                                                        <div class="image">
                                                            @if (isset($attachment))
                                                            <img src="{{ asset('storage/public/frontuser/' . $attachment[0]) }}"
                                                                alt="" 
                                                                style="height:350px !important"
                                                                >
                                                            @else
                                                            <img src="#" alt="No found">
                                                            @endif
                                                            <div class="overlay-box">
                                                                <div class="overlay-inner">
                                                                    <div class="content">
                                                                        <h3>
                                                                            <a href="{{ route('front.property.details', $item->id) }}">{{ $item->title }}</a>
                                                                        </h3>
                                                                        <div class="text">
                                                                            {{-- {{ $item->property_status }} --}}
                                                                        </div>
                                                                        <a href="{{ route('front.property.details', $item->id) }}"
                                                                            class="btn btn-veteran read-more">View Details
                                                                            <span class="fa fa-long-arrow-right"></span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
        
                                                        </div>
                                                    </div>
                                                    <img class="status-img" src="{{asset('storage/public/product_status/'.$item->property_status.'.png')}}" alt="" style="display:inline !important;">
                                                    <div class="mt-2" style="text-align: center;disply:flex;align-items: center;">
                                                        <a href="{{ route('front.user.property.edit', $item->id) }}"><i
                                                                class="fa fa-edit"
                                                                style="margin-left: 10px;font-size:22px !important;color:#28a745"></i></a>
                                                        <a href="{{ route('front.user.property.delete', $item->id) }}"
                                                            onclick="return confirm('Are you sure to delete this property')">
                                                            <i class="fa fa-trash-o" aria-hidden="true"
                                                                style="margin-left: 5px;font-size:22px !important;color:#eb2e0d"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                            @endforeach
        
                                        </div>
                                    </div>
                                </div>
                                    

                            </div>

                        </div>

                        <!--Styled Pagination-->
                        {{ $properties->links() }}
                        {{-- <ul class="styled-pagination text-center"> --}}
                        {{-- <li class="prev"><a href="#"><span class="fa fa-angle-left"></span></a></li>
                            <li><a href="#" class="active">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li class="next"><a href="#"><span class="fa fa-angle-right"></span></a></li> --}}
                        {{-- </ul> --}}
                        <!--End Styled Pagination-->

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
