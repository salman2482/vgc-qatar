@extends('front-end.layouts.master')
@section('styles')
<style>
    @media screen and (min-width: 800px){
        .mt-1{
            margin-top: 95px !important;
        }
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
                <div class="content-column col-lg-6 col-md-6 col-sm-12">
                    <div class="inner-column">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                                <strong>{{ session()->get('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
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
                             <div class="col-lg-6 col-md-6 col-sm-12 p-1">
                                <div class="card" >
                                    <div class="card-body">
                                      <h5 class="card-title">{{__('fl.Career Apply')}}</h5>
                                      <p class="card-text">{{__('fl.APPLY NOW')}}</p>
                                      <a href="{{route('front.careerApply')}}" 
                                      style="font-size: 14px" class="theme-btn btn-style-one">
                                        <span class="txt">{{__('fl.APPLY NOW')}}</span> 
                                    </a>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 p-1">
                                <div class="card" >
                                    <div class="card-body">
                                      <h5 class="card-title">{{__('fl.Career Apply')}}</h5>
                                      <p class="card-text">{{__('CURRENT OPENINGS')}}</p>
                                      <a href="{{route('front.careerOpenings')}}" 
                                      style="font-size: 14px" class="theme-btn btn-style-one">
                                        <span class="txt">{{__('CURRENT OPENINGS')}}</span> 
                                    </a>
                                    </div>
                                  </div>
                            </div> 
                             
                        </div>

                    </div>
                </div>
                {{-- <div class="col-md-6 col-lg-6 col-sm-12">
                    <div class="row utube-div" style="display: block; margin-left: auto; margin-right: auto;">
                        <iframe  width="660" height="372" src="https://www.youtube.com/embed/WDX0wGmN9x8" 
                        title="YouTube video player" frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen></iframe> 
                    </div>
                </div> --}}
                <div class="col-md-6 col-lg-6 col-sm-12 mt-1">
                    <div class="image-box">
                        <iframe width="600" height="413" class="index-iframe" src="https://www.youtube.com/embed/WDX0wGmN9x8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section-->
@endsection
@section('scripts')
<script>
    // trustech
      $(document).ready(function() {
      $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
      $("#success-alert").slideUp(500);
    });
  });
  </script>
@endsection