@extends('layout.wrapper') 
<title>Vendor PO Details</title>
@section('content')
<!-- main content -->
<div class="container-fluid">
    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Vendor PO Details</div>
                <div class="card-body">
                    <label class="strong">Vendor Company</label>
                    <p class="text-muted">
                    <?php 
                    if($vendorpo->user_id){
                        $user = DB::table('front_vendor_registrations')->where('user_id', $vendorpo->user_id)->first();
                        echo $user->vendor_company_name;
                    }
                    ?> 
                    </p>
                    <label class="strong">PO_REF</label>
                    <p class="text-muted">{{ $vendorpo->po_ref }}</p>
                    <label class="strong">Category</label>
                    <p class="text-muted">{{ $vendorpo->category ?? 'not found'}}</p>
                    <label class="strong">QTN-REF-NO</label>
                    <p class="text-muted">{{ $vendorpo->qtn_ref_no ?? 'not found'}}</p>
                    <label class="strong">Issuing Date</label>
                    <p class="text-muted">{{ $vendorpo->issuing_date ?? 'not found'}}</p>
                    <label class="strong">Total Value</label>
                    <p class="text-muted">{{ $vendorpo->total_value ?? 'not found'}}</p>
                    <label class="strong">Payment Method</label>
                    <p class="text-muted">{{ $vendorpo->payment_method ?? 'None'}}</p>
                    <label class="strong">Status</label>
                    <p class="text-muted">{{ $vendorpo->status ?? 'None'}}</p>
                    
                    <label class="strong">Status</label>
                    <p class="text-muted">{{ $vendorpo->status ?? 'None'}}</p>
                    
                    <label class="d-block">Attachments</label>

                    @foreach($attachments as $attachment)
                    @if ($attachment->attachment_unique_input == 'qtn_attachments') 
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
            @if ($attachment->attachment_unique_input == 'po_attachments') 
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