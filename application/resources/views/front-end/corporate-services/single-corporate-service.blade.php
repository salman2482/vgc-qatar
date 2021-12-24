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

        @media only screen and (min-width: 1000px) {
          .case-single-section {
            width: 82.3rem; margin: 0 auto;
            }
        }
    </style>
@endsection

@section('front-end-content')
    
        <!--Cases Section-->
        <section class="case-single-section row p-2" >
            <div class="col-md-6" >
                <div class="auto-container-fluid">
                    <!--Upper Section-->
                    <div class="upper-section">
                        <div class="row clearfix">
                            <!--Image Column-->
                            <div class="image-column col-lg-12 col-md-12 col-sm-12 container-fluid">
                                <div class="inner-column">
                                    <div class="image" style="height: 420px;">
                                        @foreach ($attachments as $attachment)
                                            @if ($attachment->attachment_unique_input === 'corporateservice')
                                            <img class="img-fluid" src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}" style="height: 400px"> 
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="auto-container p-4 ">
                    <!--Lower Section-->
                    <div class="lower-section">
                        <h2>{{$service->title}}</h2>
                            <div class="text">
                                {{$service->description}}
                            </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <section class="case-page-section" style="padding: 0px 0px 0px !important">
                    <div class="auto-container">
                        <!--MixitUp Galery-->
                        <div class="mixitup-gallery">
                            <div class="filter-list row clearfix">
                                <!--Case block-->
                                @if($subservices)
                                @forelse ($subservices as $subservice)
                                    <div class="case-block mix planning col-lg-4 col-md-6 col-sm-12" 
                                    style=" margin-bottom: 0px !important;">
                                        <div class="case-block services-div">
                                            <div class="card text-center">
                                                @foreach ($subattachments as $attachment)
                                                @if ($attachment->attachment_unique_input == 'subcorporateservice' && $attachment->attachmentresource_id == $subservice->id)

                                                        <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"
                                                            class="x-logo justify-content-center" style="background-size: cover;background-position: center; height: 300px;">
                                                    @endif
                                                @endforeach
                                                <div class="card-body">
                                                    <h5 >{{ $subservice->title }}</h5>

                                                    <p >
                                                        {{$subservice->description}}
                                                    </p>
                                                   <a  class="theme-btn btn-style-one" href="{{ route('front.contact-us') }}" type="submit" class="theme-btn btn-style-one">
                                                        <span class="txt">{{__('fl.Contact us')}}</span> 
                                                        <span class="icon flaticon-share-option"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <a  class="theme-btn btn-style-one" 
                                        href="{{ route('front.contact-us') }}" class="text-center theme-btn btn-style-one">
                                        <span class="txt">{{__('fl.Contact us')}}</span> 
                                        <span class="icon flaticon-share-option"></span>
                                    </a>
                                    </div>
                                @endforelse
                                
                                @endif
                            </div>
                        </div>

                    </div>
                </section>
            </div>

            
        </section>
        <!--End Cases Section-->
@endsection
