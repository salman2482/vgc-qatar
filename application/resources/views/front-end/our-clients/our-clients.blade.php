@extends('front-end.layouts.master')

@section('styles')
    <style>
        @media screen and (max-width: 560px) {
            .partner-block {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }

        @media screen and (min-width: 600px) {
            .textual-div {
                margin-left: -100px !important;
            }
        }

    </style>
@endsection

@section('front-end-content')
    <!--Page Title-->

    @if ($attachment->attachment_unique_input === 'frontbanner')
        <img class="img-fluid" src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" style="height: " alt="">
    @endif

    <!--Testimonial Page Section-->
    <section class="partners-page-section" style="padding: 20px 0px 6px !important;">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Column-->
                <div class="content-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
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
                        <div class="row">
                            @foreach ($clients as $client)
                                <div class="icon col-md-4 p-3">
                                    @foreach ($attachments as $attachment)
                                        @if ($attachment->attachment_unique_input == 'frontclient')
                                            @if ($attachment->attachmentresource_id == $client->id)
                                                {{-- <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"  style="height: 190px; width: 100%;" alt="Client Pic" />
                                                 --}}
                                                <div class="image-box">
                                                <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"
                                                    alt="Client Pic">

                                            </div>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
