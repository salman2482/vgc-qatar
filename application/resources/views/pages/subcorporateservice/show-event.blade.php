@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Sub Corporate Service Details</div>
                <div class="card-body">
                    <label >ID</label>
                    <p class="text-muted">{{ $subcorporateservice->id }}</p>
                    <label>Title</label>
                    <p class="text-muted">{{ $subcorporateservice->title ?? 'not found'}}</p>
                    <label>Description</label>
                    <p class="text-muted">{{ $subcorporateservice->description ?? 'not found'}}</p>
                    
                    @foreach($attachments as $attachment)
                        @if ($attachment->attachment_unique_input === 'subcorporateservice')
                            <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="400px" height="250px" style="margin-top:30px; align-item: center;">
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