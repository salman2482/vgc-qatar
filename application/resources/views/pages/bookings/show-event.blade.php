@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Document Details</div>
                <div class="card-body">
                    <label >Ref No</label>
                    <p class="text-muted">{{ $contract->ref_no }}</p>
                    <label>Issue Date</label>
                    <p class="text-muted">{{ $contract->issue_date }}</p>
                    <label>Category</label>
                    <p class="text-muted">{{ $contract->category }}</p>
                    <label>Subject</label>
                    <p class="text-muted">{{ $contract->subject }}</p>
                    <label>Delivered By</label>
                    <p class="text-muted">{{ $contract->delivered_by }}</p>
                    <label>Delivery Method</label>
                    <p class="text-muted">{{ $contract->delivery_method }}</p>
                    <label>Remarks</label>
                    <p class="text-muted">{{ $contract->remarks }}</p>
                    <label>Delivery Date</label>
                    <p class="text-muted">{{ $contract->delivery_date }}</p>
                    <label>Expiration</label>
                    <p class="text-muted">{{ $contract->expiration }}</p>
                    <label>Status</label>
                    <p class="text-muted">{{ $contract->status }}</p>

                    <label class="d-block">Attachments</label>
                    @foreach($attachments as $attachment)
                    @if ($attachment->attachment_unique_input === 'document_doc_file')
                            <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
                        @endif
<br>
                        @if ($attachment->attachment_unique_input === 'document_submital_copy')
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