<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="meta-csrf" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('system.settings_company_name') }}</title>

<style>
    *{
        font-family: "Montserrat", sans-serif;
    }
    .row{
        display: flex;
    }
    .justify-content-center{
        margin-top: 20px;
        justify-content: center;
        text-align: center;
    }
</style>
    <link href="{{ asset('public/vendor/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/themes/default/css/bill-pdf.css?v=1 ') }} " rel="stylesheet">
</head>

<body class="pdf-page">

    <div class="bill-pdf {{ config('css.bill_mode') }} {{ @page['bill_mode'] }}" style="width: 100%">

        <!--HEADER-->
        <div class="bill-header">
            <!--INVOICE HEADER-->
            <table>
                <tbody>
                    <tr>
                        <td class="x-left">
                            <div class="x-logo">
                            <img src="{{ asset('storage/logos/app/logo.png') }}" width="120px;">

                            </div>
                        </td>
                        <td class="x-mid">
                            <div class="x-bill-type" style="margin-left: -150px;">
                                <h1><strong>QUOTATION</strong></h1>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!--ADDRESSES & DATES-->
        <div class="bill-addresses">
            <table>
                <tbody>
                    <tr>
                        <!--company-->
                        <td class="x-left">
                            <div class="x-company-name">
                                <h5 class="p-b-0 m-b-0"><strong>{{ config('system.settings_company_name') }}</strong>
                                </h5>
                            </div>
                                <br>
                                <div class="x-line" >
                                    <p><strong>
                                        {{ "COMPANY NAME:" }}
                                    </strong>
                                        {{ $user->company_name }}
                                    </p>
                                </div>
                                
                                <div class="x-line">
                                    <p>
                                        <strong>
                                            {{ 'PHONE NUMBER:' }}
                                        </strong>
                                        {{ $user->phone }}
                                    </p>
                                </div>
                                <div class="x-line">
                                    <p><strong>
                                        {{ 'EMAIL ADDRESS:' }}
                                    </strong>
                                    {{ $user->email }}
                                </p>
                                </div>
                                <div class="x-line" >
                                    <p>
                                        <strong>
                                            {{ 'ADDRESS:' }}
                                        </strong>
                                        {{ $user->fvendor->address }}
                                    </p>
                                </div>
                        </td>
                        <td class="x-right">
                            
                            <div class="x-line">
                                <p><strong>
                                    {{ "QTN-REF:" }}
                                </strong>
                                    {{ $vendorqtn->qtn_ref_no }}
                                </p>
                            </div>
                            
                            <div class="x-line">
                                <p>
                                    <strong>
                                        {{ 'DATE:' }}
                                    </strong>
                                    {{ $vendorqtn->receiving_date }}
                                </p>
                            </div>
                            <div class="x-line">
                                <p>
                                    <strong>
                                    {{ 'DELIVERY:' }}
                                </strong>
                                {{ $vendorqtn->devlivery_time }}
                            </p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br><br>
        <div style="text-align: center; font-size: 18px; font-family: Montserrat, sans-serif !important; font-weight: 600;">
            <h6>
                Submitting hereto is our best quote for the following requirements:
            </h6>
        </div>
        <div class="col-12">
            <div class="table-responsive m-t-40 invoice-table-wrapper {{ config('css.bill_mode') }} clear-both">

                <table class="table table-hover invoice-table " >
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>DESCRIPTION</th>
                            <th>UOM</th>
                            <th>QTY</th>
                            <th>COST/UNIT</th>
                            <th>TOTAL COST</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materials as $material)
                        <tr>
                           <td>{{ $loop->index + 1  }}</td>
                           <td>{{ $material->description }}</td>
                           <td>{{ $material->uom }}</td>
                           <td>{{ $material->qty }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
                <h3><strong>For VETERAN GENERAL CONTRACTING</strong></h3>
               
                <br>
                <h3><strong>Manager</strong></h3>
               
            </div>
        </div>
    </div>


</body>

</html>
