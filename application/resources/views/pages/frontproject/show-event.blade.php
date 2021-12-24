@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">frontproject Details</div>
                <div class="card-body">
                    <label >Front View Project ID</label>
                    <p class="text-muted">{{ $frontproject->id }}</p>
                    <label>Title</label>
                    <p class="text-muted">{{ $frontproject->title ?? 'not found'}}</p>
                    <label>Contractor</label>
                    <p class="text-muted">{{ $frontproject->contractor ?? 'not found'}}</p>
                    <label>Client</label>
                    <p class="text-muted">{{ $frontproject->client ?? 'not found'}}</p>
                    <label>Status</label>
                    <p class="text-muted">{{ $frontproject->status ?? 'not found'}}</p>
                    
                    @foreach($attachments as $attachment)
                        @if ($attachment->attachment_unique_input === 'frontproject')
                            <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="250px" height="250px" style="margin-top:30px">
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