@extends('layout.wrapper') 
<title>Vendor QTN Details</title>
@section('content')
<!-- main content -->
<div class="container-fluid">
    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Vendor QTN Details</div>
                <div class="card-body">
                    <label class="strong">Vendor Cpmpany</label>
                    <p class="text-muted">
                    <?php 
                    if($vendorqtn->user_id){
                        $user = DB::table('front_vendor_registrations')->where('user_id', $vendorqtn->user_id)->first();
                        echo $user->vendor_company_name;
                    }
                    ?> 
                    </p>
                    <label class="strong">Category</label>
                    <p class="text-muted">{{ $vendorqtn->category }}</p>
                    <label class="strong">RFQ-REF</label>
                    <p class="text-muted">{{ $vendorqtn->rfq_ref }}</p>
                    <label class="strong">Receiving Date</label>
                    <p class="text-muted">{{ $vendorqtn->receiving_date ?? 'not found'}}</p>
                    <label class="strong">QTN-REF-NO</label>
                    <p class="text-muted">{{ $vendorqtn->qtn_ref_no ?? 'not found'}}</p>
                    <label class="strong">Devlivery Time</label>
                    <p class="text-muted">{{ $vendorqtn->devlivery_time ?? 'not found'}}</p>
                    <label class="strong">Total Value</label>
                    <p class="text-muted">{{ $vendorqtn->total_value ?? 'not found'}}</p>
                    <label class="strong">Status</label>
                    <p class="text-muted">{{ $vendorqtn->status ?? 'None'}}</p>
                    
                    <label class="d-block">Attachments</label>
                                {{-- qtn copy  --}}
                            <td>
                                @if ($vendorqtn->upload_qtn_copy != null)
                                <img src="{{asset('storage/public/vendor/'.$vendorqtn->upload_qtn_copy)}}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px"><br>
                            <a href="{{asset('storage/public/vendor/'.$vendorqtn->upload_qtn_copy)}}" download>Download</a>
                                    @else
                                    Not Available
                                    @endif
                                    </td>
                                    <hr>
                                {{-- rfq copy  --}}
                                    <td>
                                    @if ($vendorqtn->upload_rfq_copy != null)
                        <img src="{{asset('storage/public/vendor/'.$vendorqtn->upload_rfq_copy)}}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
                        <br>
                        <a href="{{asset('storage/public/vendor/'.$vendorqtn->upload_rfq_copy)}}" download>Download</a>
                                    @else
                                    Not Available
                                    @endif
                                    </td>
                                    <hr>
                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
@endsection