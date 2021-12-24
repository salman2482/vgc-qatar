@extends('front-end.layouts.master')
@section('front-end-content')

@if ($attachment->attachment_unique_input === 'frontbanner')
        <img class="img-fluid" src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" style="height: " alt="">
    @endif

   <!--Sidebar Page Container-->
<div class="sidebar-page-container" style="padding: 15px 0px 0px !important;">
    <div class="auto-container">
        <div class="sec-title">
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
        <div class="row clearfix">
            
            <!--Content Side-->
            <div class="content-side col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 10px !important;">
                <!--Blog List-->
                <div class="blog-list">
                    @foreach($projects as $project)
                    
                    <div class="news-block-two">
                        <div class="inner-box" style="overflow: hidden !important;">
                            <div class="row clearfix">
                                <!--Image Column-->
                                <div class="image-column col-lg-3 col-md-6 col-sm-12">
                                    <div class="image">
                                        <a >
                                            @foreach($attachments as $attachment)
                                            @if ($attachment->attachment_unique_input == 'frontproject') 
                                            @if($attachment->attachmentresource_id == $project->id)
                                                <img src="{{asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)}}" alt="Project Pic" style="width: 300px !important"/>
                                            </ul>
                                            @endif
                                            @endif
                                            @endforeach
                                        </a>
                                        <ul class="category">
                                            <li><a >Project</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--Content Column-->
                                <div class="content-column col-lg-3 col-md-6 col-sm-12">
                                    <div class="inner-column">
                                        <h6>  Title : {{$project->title}} </h6>
                                        
                                        <div class="author">
                                            Contractor : {{$project->contractor}}
                                        </div>
                                        <div class="author">
                                            Client : {{$project->client}}
                                        </div>
                                        <div class="author">
                                            Status : {{$project->status}}
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
@endsection
