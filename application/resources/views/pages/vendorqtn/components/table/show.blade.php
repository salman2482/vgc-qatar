@extends('layout.wrapper') @section('content')
@if($vendorqtn)
    <div class="container-fluid " id="invoice-container">
<style>
    @media only screen and (min-width: 600px) {
  .status-form-div {
    width: 400px !important;
  }

}
</style>
        <!--HEADER SECTION-->
        <div class="row page-titles">

            <!--BREAD CRUMBS & TITLE-->
            <div class="col-md-12 col-lg-7 align-self-center list-pages-crumbs" id="breadcrumbs">
                <!--attached to project-->
                <a id="InvoiceTitleAttached" class="">
                    <h3 class="text-themecolor" id="InvoiceTitleProject">Quotation -
                        {{ $vendorqtn->user->first_name . ' ' . $vendorqtn->user->last_name }}</h3>
                </a>

                <!--crumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item ">Vendors</li>
                    <li class="breadcrumb-item ">Quotation</li>
                    <li class="breadcrumb-item  active active-bread-crumb ">{{ $vendorqtn->qtn_ref_no }}</li>
                </ol>
                <!--crumbs-->
            </div>

            <!--ACTIONS-->
            <!--CRUMBS CONTAINER (RIGHT)-->
            <div class="col-md-12  col-lg-5 align-self-center text-right p-b-9  " id="list-page-actions-container">
                <div id="list-page-actions">
      

                </div>
            </div>
        </div>
        <!--/#HEADER SECTION-->

        <!--BILL CONTENT-->
        <div class="row">
            <div class="col-md-12 p-t-30">
                <div id="bill-form-container">
                    <div class="card card-body invoice-wrapper box-shadow" id="invoice-wrapper">

                        <!--HEADER-->
                        <!--HEADER-->
                        <div>
                            <span class="pull-left">
                                <h3><b>Quotation</b>
                                    <!--recurring icon-->
                                    <i class="sl-icon-refresh text-danger cursor-pointer hidden" data-toggle="tooltip"
                                        id="invoice-recurring-icon" title="Recurring Invoice"></i>
                                    <!--child invoice-->
                                </h3>
                                <span>
                                    <h5>#{{ $vendorqtn->qtn_ref_no }}</h5>
                                </span>
                            </span>
                            <!--status-->

                            </span>
                            
                            <span class="pull-right">
                                <div class="col-md-12 status-form-div" >
                                <form action="{{url('/update/vendorquotation/'.$vendorqtn->id)}}" method="POST" >
                                    @csrf
                                    @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                                    Status
                                </label>
                                <div class="col-sm-12 col-lg-9">
                                        @php    
                                        $reqs = [
                                            'APPROVED',
                                            'REQUESTING FOR DISCOUNT',
                                            'CANCELLED',
                                            'WAITING FOR APPROVAL',
                                        ];
                                @endphp
                            
                                <select name="vendorqtn_status" id="vendorqtn_status" class="select2-basic form-control form-control-sm">
                                    {{-- <option>Select Status</option> --}}
                                    @foreach ($reqs as $req)
                                    
                                    <?php if(isset($vendorqtn->status)) { ?>
                                    <option value="{{$req}}"  {{$vendorqtn->status == $req ? 'selected' : ''}} > 
                                        {{$req}} 
                                    </option>
                                    <?php } else{ ?>
                    
                                    <option value="{{$req}}"  > 
                                        {{$req}} 
                                    </option>
                                    <?php }?>
                                    @endforeach
                                </select>
                    
                                </div>
                            </div>
                        </form>

                        </div>

                            </span>
                        </div>
                        <hr>
                        <div class="row">
                            <!--ADDRESSES-->
                            <div class="col-12 m-b-10">
                                <!--company address-->
                                <div class="pull-left">
                                    <address>
                                        <h3 class="x-company-name text-info">
                                            <strong>
                                                {{$vendorqtn->user->first_name.' '.$vendorqtn->user->last_name}}
                                            </h3>
                                            </strong>
                                        <p style="margin-top: 10px; margin-bottom: 0px;">
                                            {{$vendorqtn->user->company_name}}
                                        </p>
                                        <p style="margin-top: 10px; margin-bottom: 0px;">
                                            {{$vendorqtn->user->email}}
                                        </p>
                                        <p style="margin-top: 10px; margin-bottom: 0px;">
                                            {{$vendorqtn->user->phone}}
                                        </p>
                                        <p style="margin-top: 10px; margin-bottom: 0px;">
                                            {{$vendorqtn->user->fvendor->office_telephone_no}}
                                        </p>
                                        <p style="margin-top: 10px; margin-bottom: 0px; width: 500px;">
                                            {{$vendorqtn->user->fvendor->address}}
                                        </p>
                                    </address>
                                </div>
                                <!--client address-->
                                <div class="pull-right text-right">
                                    {{-- <address>
                                        <h3 class="">Bill To</h3>

                                        <h4 class="font-bold">{{ $vendorqtn->user->company_name }}</h4>
                                        </a>
                                        <p class="text-muted m-l-30">
                                        </p>
                                    </address> --}}
                                </div>
                            </div>

                            <!--DATES & AMOUNT DUE-->
                            <div class="col-12 m-b-10" id="invoice-dates-wrapper">
                                <!--dates-->
                                <div class="pull-left invoice-dates">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="x-date-lang" id="fx-invoice-date-lang">Receiving Date </td>
                                                <td class="x-date ml-1"> <strong>{{ $vendorqtn->receiving_date }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="x-date-due-lang">Delivery Date</td>
                                                <td class="x-date-due ml-1">
                                                    <strong>{{ $vendorqtn->devlivery_time }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--balances-->
                                <div class="pull-right invoice-dues">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="x-payments-lang" id="fx-payments-date-lang">TOTAL VALUE</td>

                                                <td class="x-payments"> <span class="p-l-20">
                                                        <strong>
                                                            {{ $vendorqtn->total_value }}
                                                        </strong>
                                                    </span> </td>
                                            </tr>
                                            <tr>
                                                <td class="x-balance-due-lang">STATUS </td>
                                                <td class="x-balance-due"> <span class="x-due-amount-label">
                                                        <label class="label label-rounded <?php if ($vendorqtn->status == 'WAITING FOR APPROVAL') {
                                                                echo 'label-info';
                                                            } elseif ($vendorqtn->status == 'APPROVED') {
                                                                echo 'label-success';
                                                            } elseif ($vendorqtn->status == 'REQUESTING FOR DISCOUNT') {
                                                                echo 'label-warning';
                                                            } else {
                                                                echo 'label-danger';
                                                            } ?>"
                                                            id="billing-details-amount-due">{{ $vendorqtn->status }}</label>
                                                    </span>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!--INVOICE TABLE-->
                            <div class="col-12">
                                <div class="table-responsive m-t-40 invoice-table-wrapper  clear-both">
                                    <table class="table table-hover invoice-table ">
                                        <thead>
                                            <tr>
                                                <!--action-->
                                                <!--description-->
                                                <th class="text-left x-description bill_col_description">RFQ-REF</th>

                                                <!--receipt-->
                                                <th class="text-left x-quantity bill_col_quantity">CATEGORY</th>

                                                <!--quantity-->
                                                <th class="text-left x-quantity bill_col_quantity">QTN-REF-NO</th>
                                                <!--unit price-->
                                                <th class="text-left x-unit bill_col_unit">TOTAL VALUE</th>
                                                <!--rate-->
                                                <th class="text-left x-rate bill_col_rate">QTN COPY</th>
                                                <!--tax-->
                                                <th class="text-left x-tax bill_col_tax">RFQ COPY</th>
                                                <!--total-->
                                                <th class="text-right x-total bill_col_total" id="bill_col_total">STATUS
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="billing-items-container">
                                            <tr>
                                                <!--description-->
                                                <td class="x-description">{{ $vendorqtn->rfq_ref }}</td>
                                                <td>
                                                    {{ $vendorqtn->category }}
                                                </td>
                                                <!--quantity-->
                                                <td class="x-quantity">{{ $vendorqtn->qtn_ref_no }}</td>
                                                <!--unit price-->
                                                <td class="x-unit">{{ $vendorqtn->total_value }}</td>
                                                <!--rate-->
                                                <td class="x-rate">
                                                    @if ($vendorqtn->upload_qtn_copy != null)
                                                        <a href="{{ asset('storage/public/vendor/' . $vendorqtn->upload_qtn_copy) }}"
                                                            download>Download</a>
                                                    @else
                                                        Not Available
                                                    @endif
                                                </td>
                                                <!--tax-->
                                                <td class="x-tax">
                                                    @if ($vendorqtn->upload_rfq_copy != null)
                                                        <a href="{{ asset('storage/public/vendor/' . $vendorqtn->upload_rfq_copy) }}"
                                                            download>Download</a>
                                                    @else
                                                        Not Available
                                                    @endif
                                                </td>
                                                <!--total-->
                                                <td class="x-total text-right ">{{ $vendorqtn->status }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!--INVOICE LOGIC-->

                </div>

                <!--ELEMENTS (invoice line item)-->
            </div>
        </div>
    </div>
@else
<div class="container-fluid " id="invoice-container">

<a class="h1" href="javascript:void(0);" >Quotation has not been submitted yet</a>

<a href="{{route('vendorrfqs.index')}}" class="btn btn-info float-right">Go Back To Vendor RFQ</a>
</div>
@endif

<script>
    $('#vendorqtn_status').on('change', function(){
    // alert();
    $(this).closest('form').submit();
});
</script>
@endsection
