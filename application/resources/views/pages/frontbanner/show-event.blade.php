@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Front Banner Details</div>
                <div class="card-body">
                    <label>Front Banner ID</label>
                    <p class="text-muted">{{ $frontbanner->id }}</p>
                    <label>Title </label>
                    <p class="text-muted">{{ $frontbanner->title ?? 'not found'}}</p>
                    <label>Title Aabic</label>
                    <p class="text-muted">{{ $frontbanner->title ?? 'not found'}}</p>
                    <label>Description </label>
                    <p class="text-muted">{{ $frontbanner->description ?? 'not found'}}</p>
                    <label>Description Aabic</label>
                    <p class="text-muted">{{ $frontbanner->description ?? 'not found'}}</p>
                    @foreach($attachments as $attachment)
                        @if ($attachment->attachment_unique_input === 'frontbanner')
                            <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="100%" style="margin-top:30px">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
@endsection