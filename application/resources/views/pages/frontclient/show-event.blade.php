@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Front Client Details</div>
                <div class="card-body">
                    <label >Front Client ID</label>
                    <p class="text-muted">{{ $frontclient->id }}</p>
                    <label>Front Client Title</label>
                    <p class="text-muted">{{ $frontclient->name ?? 'not found'}}</p>
                    <label>Front Client Description</label>
                    <p class="text-muted">{{ $frontclient->description ?? 'not found'}}</p>
                    @foreach($attachments as $attachment)
                        @if ($attachment->attachment_unique_input === 'frontclient')
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