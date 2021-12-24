@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Quotation Details</div>
                <div class="card-body">
                    <label >Ref No</label>
                    <p class="text-muted">{{ $quotation->ref_no }}</p>
                    <label>Client RFQ Ref</label>
                    <p class="text-muted">{{ $quotation->client_rfq_ref }}</p>
                    <label>Client Name</label>
                    <p class="text-muted">{{ $quotation->client_name ?? 'test' }}</p>
                    <label>Issuance Date</label>
                    <p class="text-muted">{{ $quotation->issuance_date }}</p>
                    <label>Expiration</label>
                    <p class="text-muted">{{ $quotation->expiraton }}</p>
                    <label>Delivery Date</label>
                    <p class="text-muted">{{ $quotation->delivery_date }}</p>
                    <label>Estimate By</label>
                    <p class="text-muted">{{ $quotation->estimated_by }}</p>
                    <label>Delivered By</label>
                    <p class="text-muted">{{ $quotation->delivered_by }}</p>
                    <label>delivery_method</label>
                    <p class="text-muted">{{ $quotation->delivery_method }}</p>
                    <label>Status</label>
                    <p class="text-muted">{{ $quotation->status }}</p>
                    <label class="d-block">Attachments</label>
                    @foreach($attachments as $attachment)
                            <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
@endsection