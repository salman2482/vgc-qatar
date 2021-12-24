<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="meta-csrf" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('system.settings_company_name') }}</title>

    <link href="{{ asset('public/vendor/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/themes/default/css/bill-pdf.css?v=1 ') }} " rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon.png">
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
                                <img src="{{ asset('storage/logos/app/logo.png') }}" width="120px">

                            </div>
                        </td>
                        <td class="x-right">
                            {{-- <div class="x-bill-type">
                                <h4><strong>{{ cleanLang(__('RFM Copy')) }}</strong></h4>
                                <h5>#{{ $rfm->ref_num ?? '' }}</h5>
                            </div> --}}
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
                                <h4 class="p-b-0 m-b-0"><strong>{{ config('system.settings_company_name') }}</strong>
                                </h4>
                            </div>
                            @if (config('system.settings_company_address_line_1'))
                                <div class="x-line">
                                    <span>
                                        {!! wordwrap(config('system.settings_company_address_line_1'),50,"<br>") !!}
                                    </span>
                                </div>
                            @endif
                            @if (config('system.settings_company_state'))
                                <div class="x-line">
                                    {{ config('system.settings_company_state') }}
                                </div>
                            @endif
                            @if (config('system.settings_company_city'))
                                <div class="x-line">
                                    {{ config('system.settings_company_city') }}
                                </div>
                            @endif
                            @if (config('system.settings_company_zipcode'))
                                <div class="x-line">
                                    {{ config('system.settings_company_zipcode') }}
                                </div>
                            @endif
                            @if (config('system.settings_company_country'))
                                <div class="x-line">
                                    {{ config('system.settings_company_country') }}
                                </div>
                            @endif
                        </td>
                        <td class="x-right">
                            <div class="x-bill-type">
                                {{ $userBooking->full_name ?? '' }}
                            </div>
                            <div class="x-bill-type">
                                {{ $userBooking->email ?? '' }}
                            </div>
                            <div class="x-bill-type">
                                {{ $userBooking->phone ?? '' }}
                            </div>
                            <div class="x-bill-type">
                                <h4><strong>{{ cleanLang(__('Booking Invoice')) }}</strong></h4>
                                <h5>#{{ $userBooking->id ?? '' }}</h5>
                            </div>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="bill-header">
            <!--INVOICE HEADER-->
            <table>
                <tbody>
                    <tr>
                        <td class="x-left">
                        </td>
                        
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12">
            <div class="table-responsive invoice-table-wrapper {{ config('css.bill_mode') }} clear-both">
                <h5 class="text-center text-black">Booking Invoice</h5>
                <table class="table table-hover invoice-table {{ config('css.bill_mode') }}">
                    <thead>
                        <tr>
                            <!--description-->
                            <th class="text-left x-quantity bill_col_quantity">{{ cleanLang(__('Service Name')) }}</th>
                            <th class="text-left x-unit bill_col_unit">{{ cleanLang(__('description')) }}</th>
                            <th class="text-left x-rate bill_col_rate">{{ cleanLang(__('Provider')) }}</th>
                            <th class="text-left x-rate bill_col_rate">{{ cleanLang(__('Value')) }}</th>
                        </tr>
                    </thead>

                    <tbody id="billing-items-container">
                        <td>{{ $userBooking->service->title ?? 'not found' }}</td>
                        <td>{{ $userBooking->description }}</td>
                        @php
                            $employee = App\Models\User::where('id',$userBooking->employee_id)->select('first_name','last_name')->first();
                        @endphp
                        <td>{{ $employee->first_name .' '.$employee->last_name ?? 'not found' }}</td>
                        <td>{{ $userBooking->price ?? 'not found' }}</td>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="col">
            <h4 class="text-center">
                This Invoice is system generated ..     
            </h4>
        </div>
    </div>


</body>

</html>
