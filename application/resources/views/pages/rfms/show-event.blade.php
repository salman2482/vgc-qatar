@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">RFM Details</div>
                <div class="card-body">
                    <label class="strong">Ref no</label>
                    <p class="text-muted">{{ $rfm->ref_num }}</p>
                    <label class="strong">Department</label>
                    <p class="text-muted">{{ $rfm->department ?? 'not found'}}</p>
                    <label class="strong">Inline Manager</label>
                    <p class="text-muted">{{ $rfm->inline_manager_id ?? 'not found'}}</p>
                    <label class="strong">Head Of Accounts</label>
                    <p class="text-muted">{{ $rfm->hoc_id ?? 'not found'}}</p>
                    <label class="strong">Materials</label>
                    <p class="text-muted">{{ $rfm->material_id ?? 'not found'}}</p>
                    <label class="strong">Subject</label>
                    <p class="text-muted">{{ $rfm->subject ?? 'not found'}}</p>
                    <label class="strong">Site</label>
                    <p class="text-muted">{{ $rfm->site ?? 'not found'}}</p>
                    <label class="strong">Due Date</label>
                    <p class="text-muted">{{ $rfm->due_date ?? 'not found'}}</p>
                    <label class="d-block">Attachments</label>
                    @foreach($attachments as $attachment)
                    @if ($attachment->attachment_unique_input === 'rfm_image')
                            <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
                        @endif
<br>
                        @if ($attachment->attachment_unique_input === 'rfm_video')
                            <video class="mt-3" src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" width="400px" height="300px" controls></video>
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