<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="meta-csrf" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('system.settings_company_name') }}</title>

    <style>
        .row {
            display: flex;
        }

        .justify-content-center {
            margin-top: 20px;
            justify-content: center;
            text-align: center;
        }

        .invoice-table th {
            border-top: 2px solid black !important;
            border-bottom: 2px solid black !important;
        }

        .text-black {
            color: black;
        }

        h5 {
            font-weight: bold !important;
        }

    </style>
    <link href="{{ asset('public/vendor/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/themes/default/css/bill-pdf.css?v=1 ') }} " rel="stylesheet">
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
                                <div class="x-line">{{ config('system.settings_company_address_line_1') }}
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
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="bill-header">
            <!--INVOICE HEADER-->
            <table style="border-bottom: 2px solid #dee2e6;">
                <tbody>
                    <tr>
                        <td class="x-left">
                        </td>
                        <td class="x-right">
                            <div class="x-bill-type">
                                <h4><strong>{{ cleanLang(__('System RFM')) }}</strong></h4>
                                <h5>{{ $rfm->ref_num ?? '' }}</h5>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="col-12">
            <div class="table-responsive invoice-table-wrapper {{ config('css.bill_mode') }} clear-both">
                <h5 class="text-center text-black">In-House Request For Material </h5>
                <table class="table table-hover invoice-table {{ config('css.bill_mode') }}">
                    <thead>
                        <tr>
                            <!--description-->
                            <th class="text-left x-description bill_col_description">{{ cleanLang(__('RFM# ')) }}
                            </th>
                            <th class="text-left x-quantity bill_col_quantity">{{ cleanLang(__('Department')) }}</th>
                            <th class="text-left x-unit bill_col_unit">{{ cleanLang(__('Location     ')) }}</th>
                            <th class="text-left x-rate bill_col_rate">{{ cleanLang(__('Remarks')) }}</th>
                            <th class="text-left x-rate bill_col_rate">{{ cleanLang(__('Requestor')) }}</th>
                            <th class="text-left x-rate bill_col_rate">{{ cleanLang(__('Date of Request')) }}</th>
                            <th class="text-left x-rate bill_col_rate">{{ cleanLang(__('Status')) }}</th>

                        </tr>
                    </thead>

                    <tbody id="billing-items-container">
                        <td>{{ $rfm->ref_num }}</td>
                        <td>{{ $rfm->department }}</td>
                        <td>{{ $rfm->site ?? 'not found' }}</td>
                        <td>{{ $rfm->remarks ?? 'not found' }}</td>
                        <td>{{ $rfm->requestor ?? 'not found' }}</td>
                        <td>{{ $rfm->created_at->format('d/m/Y') }}</td>
                        <td>{{ $rfm->status ?? '' }}</td>
                    </tbody>
                </table>
                <h5 class="row justify-content-center text-black">Materials</h5>

                <table class="table table-hover invoice-table {{ config('css.bill_mode') }}">
                    <thead>
                        <tr>
                            <th>SI</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Available Stock</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materials as $material)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $material->material->title ?? 'not found' }}</td>
                                <td>{{ $material->qty ?? 'not found' }}</td>
                                <td>{{ $material->material->available_stock ?? 'not found' }}</td>
                                <td>{{ $material->material->amount ?? 'not found' }}</td>
                                <td>{{ $material->qty ?? 'not found' * $material->material->amount ?? 'not found' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5 class="row justify-content-center text-black">Approval</h5>
                <table class="table table-hover invoice-table {{ config('css.bill_mode') }}">
                    <thead>
                        <tr>
                            <th>Work Flow</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($supervisor)
                            <tr>
                                <td><strong>Supervisor: <strong></td>
                                <td>{{ ucfirst($supervisor->first_name)  }}</td>
                                <td>{{ 'Approved' }}</td>
                                <td>{{ $rfm->updated_at->format('d/m/Y') }}</td>
                            </tr>
                        @endisset
                        @isset($manager)
                            <tr>
                                <td><strong>Manager: <strong></td>
                                <td>{{ ucfirst($manager->first_name ?? '') }}</td>
                                <td>{{ 'Approved' }}</td>
                                <td>{{ $rfm->updated_at->format('d/m/Y') }}</td>
                            </tr>
                        @endisset
                        @isset($hoa)
                            <tr>
                                <td><strong>Head Of Accounts: <strong></td>
                                <td>{{ ucfirst($hoa->first_name ?? '') }}</td>
                                <td>{{ 'Approved' }}</td>
                                <td>{{ $rfm->updated_at->format('d/m/Y') }}</td>
                            </tr>
                        @endisset

                    </tbody>
                </table>
                {{-- <h5><strong>Approved By</strong></h5>
                @isset($supervisor)
                    <h6>Supervisor: <strong>{{ ucfirst($supervisor->first_name) }}</strong></h6>
                @endisset
                @isset($manager)
                    <h6>Manager: <strong>{{ ucfirst($manager->first_name) }}</strong></h6>
                @endisset
                @isset($hoa)
                    <h6>Head Of Accounts: <strong>{{ ucfirst($hoa->first_name) }}</strong></h6>
                @endisset
                <br>
                <h3><strong>Client Signature</strong></h3> --}}
                {{-- @forelse($attachments as $attachment)
                    @if ($attachment->attachment_unique_input === 'client_stamp')
                        <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"
                            class="x-logo justify-content-center" width="250px" height="250px" style="margin-top:30px">
                    @endif
                @empty
                    <strong>Not Found</strong>
                @endforelse --}}
            </div>
        </div>
    </div>


</body>

</html>
