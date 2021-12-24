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
                
            </div>
        </div>
    </section>
    <!--End About Section-->
@endsection
