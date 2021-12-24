@extends('layout.wrapper') 
<title>Vendor RFQ Details</title>
@section('content')
<!-- main content -->
<div class="container-fluid">
    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Vendor RFQ Details</div>
                <div class="card-body">
                    
                    <label class="strong">Category</label>
                    <p class="text-muted">{{ $vendorrfq->category }}</p>
                    <label class="strong">RFQ-REF</label>
                    <p class="text-muted">{{ $vendorrfq->rfq_ref }}</p>
                    <label class="strong">Category</label>
                    <p class="text-muted">{{ $vendorrfq->category ?? 'not found'}}</p>
                    <label class="strong">Company Category</label>
                    <p class="text-muted">{{ $vendorrfq->company_category ?? 'not found'}}</p>
                    <label class="strong">Priority</label>
                    <p class="text-muted">{{ $vendorrfq->priority ?? 'not found'}}</p>
                    <label class="strong">Receiving Date</label>
                    <p class="text-muted">{{ $vendorrfq->receiving_date ?? 'not found'}}</p>
                    <label class="strong">Due Date Request</label>
                    <p class="text-muted">{{ $vendorrfq->due_date_request ?? 'not found'}}</p>
                    <label class="strong">Requestor</label>
                    <p class="text-muted">{{ $vendorrfq->requestor ?? 'not found'}}</p>
                    <label class="strong">Status</label>
                    <p class="text-muted">{{ $vendorrfq->status ?? 'None'}}</p>
                    <label class="strong">Required Quotation Validity</label>
                    <p class="text-muted">{{ $vendorrfq->required_quotation_validity ?? 'None'}}</p>
                    <label class="d-block">Attachments</label>

                    @foreach($attachments as $attachment)
                    @if ($attachment->attachment_unique_input == 'video_attachments') 
                    <ul class="p-l-0">
                        
                        <li>
                            <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
                        </li>
                        <li  id="fx-govtdocuments-files-attached" style="list-style: none">
                            <a href="govtdocuments/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                            </a>
                        </li>
                    </ul>
                    @endif
            @endforeach
            <hr>
            @foreach($attachments as $attachment)
            @if ($attachment->attachment_unique_input == 'rfq_attachments') 
            <ul class="p-l-0">
                
                <li>
                    <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
                </li>
                <li  id="fx-govtdocuments-files-attached" style="list-style: none">
                    <a href="govtdocuments/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                    </a>
                </li>
                
            </ul>
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