@extends('front-end.layouts.master')
@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

    <style>
        .apply-button {
            background-color: #2ECC40 !important;
            color: white;
        }

        .card-text {
            font-family: 'Montserrat', sans-serif !important;
            font-size: 16px
        }

    </style>
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

                        <div class="row">

                            @foreach ($careers as $career)
                                <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title" style="color: #2ECC40!important;">{{ $career->title }}
                                            </h5>
                                            <p class="card-text">
                                                <strong>{{ __('fl.Position') }} : </strong>{{ $career->position }}
                                            </p>
                                            <p class="card-text">
                                                <strong>{{ __('fl.Experience') }} : </strong>{{ $career->experience }}
                                            </p>

                                            <p class="card-text">
                                                <strong>{{ __('fl.Category') }} : </strong>{{ $career->category }}
                                            </p>

                                            {{--
                                            <p class="card-text">
                                                <strong>{{ __('fl.Salary') }} : </strong>{{ $career->salary }}
                                            </p> --}}

                                            <a href="{{ url('/career/apply/now/' . $career->category . '/' . $career->position) }}"
                                                class="btn apply-button">
                                                {{ __('fl.Apply Now') }}
                                            </a>
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
