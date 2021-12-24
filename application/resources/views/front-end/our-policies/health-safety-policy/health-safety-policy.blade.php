@extends('front-end.layouts.master')

@section('styles')
<style>
    .a li{
        list-style: circle;
        margin-left: 15px;
}
</style>
@endsection
@section('front-end-content')

@if ($attachment->attachment_unique_input === 'frontbanner')
        <img class="img-fluid" src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" style="height: " alt="">
    @endif


<!--Testimonial Page Section-->
<section class="partners-page-section" style="padding: 20px 0px 20px !important;">
    <div class="auto-container">
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
</section>
<!--End Market Section-->

@endsection