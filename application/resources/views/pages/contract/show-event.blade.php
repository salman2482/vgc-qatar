@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Contract Details</div>
                <div class="card-body">
                    <label >Ref No</label>
                    <p class="text-muted">{{ $contract->ref_no }}</p>
                    <label>Category</label>
                    <p class="text-muted">{{ $contract->category }}</p>
                    <label>Signed By</label>
                    <p class="text-muted">{{ $contract->signed_by }}</p>
                    <label>Starting Date</label>
                    <p class="text-muted">{{ $contract->sarting_date }}</p>
                    <label>Expiry Date</label>
                    <p class="text-muted">{{ $contract->expiray_date }}</p>
                    <label>Renewal Date</label>
                    <p class="text-muted">{{ $contract->renewal_date }}</p>
                    <label>Remarks</label>
                    <p class="text-muted">{{ $contract->remarks }}</p>
                    <label>Description</label>
                    <p class="text-muted">{{ $contract->description }}</p>
                    <label class="d-block">Attachments</label>
                    @foreach($attachments as $attachment)
                    @if ($attachment->attachment_unique_input === 'lpo')
                            <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
                        @endif
<br>
                        @if ($attachment->attachment_unique_input === 'contract')
                        <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
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