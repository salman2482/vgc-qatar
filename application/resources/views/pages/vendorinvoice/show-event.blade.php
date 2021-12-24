@extends('layout.wrapper') 
<title>Vendor Invoice Details</title>
@section('content')
<!-- main content -->
<div class="container-fluid">
    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Vendor Invoice Details</div>
                <div class="card-body">
                    <label class="strong">Vendor Company</label>
                    <p class="text-muted">{{ $vendorinvoice->user->company_name }}</p>
                    <label class="strong">Category</label>
                    <label class="strong">PO_REF</label>
                    <p class="text-muted">{{ $vendorinvoice->lpo_ref }}</p>
                    <label class="strong">Category</label>
                    <p class="text-muted">{{ $vendorinvoice->category ?? 'not found'}}</p>
                    <label class="strong">Delivery Date</label>
                    <p class="text-muted">{{ $vendorinvoice->delivery_date ?? 'not found'}}</p>
                    <label class="strong">Invoice Ref No</label>
                    <p class="text-muted">{{ $vendorinvoice->invoice_ref_no ?? 'not found'}}</p>
                    <label class="strong">Total Value</label>
                    <p class="text-muted">{{ $vendorinvoice->total_value ?? 'not found'}}</p>
                    <label class="strong">Status</label>
                    <p class="text-muted">{{ $vendorinvoice->status ?? 'not found'}}</p>
                    <label class="strong">Reason</label>
                    <p class="text-muted">{{ $vendorinvoice->reason ?? 'None'}}</p>
                    <label class="d-block">Attachments</label>

                            <td>
                    @if ($vendorinvoice->upload_invoice_copy != null)
                    <img src="{{asset('storage/public/vendor/'.$vendorinvoice->upload_invoice_copy)}}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px"><br>
                <a href="{{asset('storage/public/vendor/'.$vendorinvoice->upload_invoice_copy)}}" download>Download</a>
                            @else
                            Not Available
                            @endif
                        </td>
                        <hr>
                                {{-- qtn copy  --}}
                                <td>

                                @if ($vendorinvoice->upload_qtn_copy != null)
                    <img src="{{asset('storage/public/vendor/'.$vendorinvoice->upload_qtn_copy)}}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
                    <br>
                    <a href="{{asset('storage/public/vendor/'.$vendorinvoice->upload_qtn_copy)}}" download>Download</a>
                                @else
                                Not Available
                                @endif
                                </td>
                                <hr>
                                {{-- lpo copy --}}
                                <td>
                @if ($vendorinvoice->upload_lpo_copy != null)
                <img src="{{asset('storage/public/vendor/'.$vendorinvoice->upload_lpo_copy)}}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
                <br>
                <a href="{{asset('storage/public/vendor/'.$vendorinvoice->upload_lpo_copy)}}" download>Download</a>
                                @else
                                Not Available
                                @endif
                                </td>
                                        
                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
@endsection