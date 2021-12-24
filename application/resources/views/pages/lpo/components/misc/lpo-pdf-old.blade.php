<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="meta-csrf" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('system.settings_company_name') }}</title>


    <!--
        web preview example
        http://example.com/invoices/29/pdf?view=preview
        {{ BASE_DIR.'/' }}
    -->

    @if(request('view') == 'preview')
    <!--baseurl-->
    <base href="{{ url('/') }}" target="_self">
    @else
    <!--basepath-->
    <base href="" target="_self">
    @endif


    <link href="{{ asset('public/vendor/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <!--selected theme - pdf css-->
    <link href="{{ asset('public/themes/default/css/bill-pdf.css?v=1 ') }} " rel="stylesheet">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon.png">
</head>

<body class="pdf-page">

    <div class="bill-pdf {{ config('css.bill_mode') }} {{ @page['bill_mode'] }}">

        <!--HEADER-->
        <div class="bill-header">
            <!--INVOICE HEADER-->
            <table>
                <tbody>
                    <tr>
                        <td class="x-left">
                            <div class="x-logo">
                                <img src="{{ asset('storage/logos/app/logo.png') }}">
                            </div>
                        </td>
                        <td class="x-right">
                            <div class="x-bill-type">
                                <h4><strong>{{ cleanLang(__('PO Copy')) }}</strong></h4>
                                <h5>#{{ $lpo->ref_no ?? '' }}</h5>
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
                                <h5 class="p-b-0 m-b-0"><strong>{{ config('system.settings_company_name') }}</strong></h5>
                            </div>
                            @if(config('system.settings_company_address_line_1'))
                            <div class="x-line">{{ config('system.settings_company_address_line_1') }}
                            </div>
                            @endif
                            @if(config('system.settings_company_state'))
                            <div class="x-line">
                                {{ config('system.settings_company_state') }}
                            </div>
                            @endif
                            @if(config('system.settings_company_city'))
                            <div class="x-line">
                                {{ config('system.settings_company_city') }}
                            </div>
                            @endif
                            @if(config('system.settings_company_zipcode'))
                            <div class="x-line">
                                {{ config('system.settings_company_zipcode') }}
                            </div>
                            @endif
                            @if(config('system.settings_company_country'))
                            <div class="x-line">
                                {{ config('system.settings_company_country') }}
                            </div>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="col-12">
            <div class="table-responsive m-t-40 invoice-table-wrapper {{ config('css.bill_mode') }} clear-both">
                <table class="table table-hover invoice-table {{ config('css.bill_mode') }}">
                    <thead>
                        <tr>
                            <!--description-->
                            <th class="text-left x-description bill_col_description">{{ cleanLang(__('PO Ref #')) }}</th>
                            {{-- trustech code starts here --}}
                            <!--receipt-->
                            <th class="text-left x-quantity bill_col_quantity">{{ cleanLang(__('Rfm Ref #')) }}</th>
                            {{-- trustech code ends here --}}
                            <!--quantity-->
                            <th class="text-left x-quantity bill_col_quantity">{{ cleanLang(__('Department')) }}</th>
                            <!--unit price-->
                            <th class="text-left x-unit bill_col_unit">{{ cleanLang(__('Subject')) }}</th>
                            <!--rate-->
                            <th class="text-left x-rate bill_col_rate">{{ cleanLang(__('Value')) }}</th>
                            <th class="text-left x-rate bill_col_rate">{{ cleanLang(__('Remarks')) }}</th>
                            
                        </tr>
                    </thead>
                  
                    <tbody id="billing-items-container">
                        <td >{{ $lpo->ref_no }}</td>
                        <td >{{ $lpo->rfm_ref_no }}</td>
                        <td >{{ $lpo->department }}</td>
                        <td >{{ $lpo->subject }}</td>
                        <td >{{ $lpo->value }}</td>
                        <td >{{ $lpo->remarks }}</td>
                    </tbody>
                </table>
                <h3 style="margin-top: 10px">Client Signature</h3>
                @foreach($attachments as $attachment)
                @if ($attachment->attachment_unique_input === 'client_stamp')
                    <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="250px" height="250px" style="margin-top:30px">
                @endif
            @endforeach
            </div>
        </div>
    </div>
</body>

</html>