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
            <div class="col-md-6">
                <div class="auto-container-fluid">
                    <!--Upper Section-->
                    <div class="upper-section">
                        <div class="row clearfix">
                            <!--Image Column-->
                            <div class="image-column col-lg-12 col-md-12 col-sm-12 container-fluid">
                                <div class="inner-column">
                                    <div class="image" style="height: 420px;">
                                        @foreach ($subattachments as $attachment)
                                            @if ($attachment->attachment_unique_input === 'subcorporateservice')
                                                <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}" style="height: 400px"> 
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
                        <h2>{{$subservice->title}}</h2>
                        <h4> Corporate Service : 
                            <a href="{{ route('front.single-corporate-services', $subservice->corporateservice->id) }}">
                                {{$subservice->corporateservice->title ?? ''}}</a>
                        </h4>
                            <div class="text">
                                {{$subservice->description}}
                            </div>
                    </div>
                </div>
            </div>
        
        </section>
        <!--End Cases Section-->
@endsection
