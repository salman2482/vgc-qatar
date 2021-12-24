<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Email Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }

            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 700;
                src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }

        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            padding: 24px;
            font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
            font-size: 16px;
            background-color: #f9fafc;
            color: #60676d;
        }

        table {
            border-collapse: collapse !important;
        }

        a {
            color: #1a82e2;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }

        .table-1 {
            max-width: 900px;
        }

        .table-1 td {
            padding: 36px 24px 40px;
            text-align: center;
        }

        .table-1 h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 600;
            letter-spacing: -1px;
            line-height: 48px;
        }

        .table-2 {
            max-width: 900px;
        }

        .table-2 td {
            padding: 36px 24px 0;
            border-top: 3px solid #d4dadf;
            background-color: #ffffff;
        }

        .table-2 h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: -1px;
            line-height: 48px;
        }

        .table-3 {
            max-width: 900px;
        }

        .table-2 td {

            background-color: #ffffff;
        }

        .td-1 {
            padding: 24px;
            font-size: 16px;
            line-height: 24px;
            background-color: #ffffff;
            text-align: left;
            padding-bottom: 10px;
            padding-top: 0px;
        }

        .table-gray {
            width: 90%;
            margin: auto;
            margin-bottom: 20px;
        }

        .table-gray tr {
            height: 24px;
        }

        .table-gray .td-1 {
            background-color: #f1f3f7;
            width: 30%;
            border: solid 1px #e7e9ec;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .table-gray .td-2 {
            background-color: #f1f3f7;
            width: 40%;
            border: solid 1px #e7e9ec;
        }

        .button {
            display: inline-block;
            padding: 16px 36px;
            font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
            font-size: 16px;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            background-color: #1a82e2;
            border-radius: 6px;
        }

        .signature {
            padding: 24px;
            font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
            font-size: 16px;
            line-height: 24px;
            border-bottom: 3px solid #d4dadf;
            background-color: #ffffff;
        }

        .footer {
            max-width: 900px;
        }

        .footer td {
            padding: 12px 24px;
            font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 20px;
            color: #666;
        }

        .td-button {
            padding: 12px;
            background-color: #ffffff;
            text-align: center;
        }

        .p-24 {
            padding: 24px;
        }

    </style>

</head>

<body>
    <!-- start body -->
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <!-- start hero -->
        <tbody>
            <tr>
                <td align="center">
                    <table class="table-1" border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td align="left">
                                    <h1><img src="{{ asset('storage/public/email-logo.png') }}"  width="150px" alt=""></h1>
                                    <h1>Welcome To VGC</h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- end hero -->
            <!-- start hero -->
            <tr>
                <td align="center">
                    <table class="table-2" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td align="center">
                                    <h1>Dear Vendor,</h1>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>
                                        May we request you to please check your account to review our inquiries in relation to your business services.
                                        <br> <br>
                                        For further information, please contact our Procurement Team directly thru 4444-1061.
                                        <br><br>
                                        Best Regards, <br> Veteran
                                    </p>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- end hero -->
            <!-- start copy block -->
            <tr>
                <td align="center">
                    <table class="table-3" border="0" width="100%" cellspacing="0" cellpadding="0">
                        <!-- start copy -->
                        <tbody>
                            <tr>
                            </tr>
                            <tr>
                                <td class="td-1" style="padding-top: 30px">
                                    <table class="table-gray" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td class="td-1"><strong>RFQ REF. NO.</strong></td>
                                                <td class="td-2">{{ $rfq->rfq_ref ?? 'Not Available' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>SELECTED CATEGORY</strong></td>
                                                <td class="td-2">{{ $rfq->category ?? 'Not Available' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>DATE</strong></td>
                                                <td class="td-2">{{ $rfq->due_date_request ?? 'Not Available' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>VENDOR COMPANY NAME</strong></td>
                                                <td class="td-2">
                                                    {{ $user->fvendor->vendor_company_name ?? 'Not Available' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>NAME OF CONTACT PERSON</strong></td>
                                                <td class="td-2">{{ $rfq->requestor ?? 'Not Available' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>DESIGNATION</strong></td>
                                                <td class="td-2">{{ $user->position ?? 'Not Available' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>TELEPHONE:</strong></td>
                                                <td class="td-2">
                                                    {{ $user->fvendor->office_telephone_no ?? 'Not Available' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>FAX:</strong></td>
                                                <td class="td-2">{{ $user->fvendor->po_box ?? 'Not Available' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>MOBILE NO.</strong></td>
                                                <td class="td-2">{{ $user->phone ?? 'Not Available' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>EMAIL</strong></td>
                                                <td class="td-2">{{ $user->email ?? 'Not Available' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p style="margin: auto; width: 90%;" class="mt-2">
                                        Dear
                                        <Strong>
                                            {{ $user->fvendor->title ?? '' }} {{ $user->first_name ?? '' }}
                                            {{ $user->last_name ?? '' }}
                                        </Strong>
                                        This is with reference to the abovementioned subject, we are kindly requesting
                                        you to provide your best proposal/quotation on the below requirement. Your Early
                                        response is highly appreciated.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-1" style="padding-top: 30px">
                                    <table class="table-gray" cellpadding="5">
                                        <thead>
                                            <tr>
                                                <th class="td-1">SN</th>
                                                <th class="td-1">DESCRIPTION</th>
                                                <th class="td-1">UOM</th>
                                                <th class="td-1">QUANTITY</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($materials2 as $material)
                                                <tr>
                                                <td class="td-1">{{$loop->index + 1}}</td>
                                                <td class="td-1">{{$material->description}}</td>
                                                <td class="td-1">{{$material->uom}}</td>
                                                <td class="td-1">{{$material->qty}}</td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="signature">
                                    <i style="text-align: center">
                “This is an auto-generated email. For clarification, please contact us through info@vgc-qatar.com”
                                    </i>
                                    <br>
                                    <p style="text-align: center">VETERAN GENERAL CONTRACTING</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- end copy block -->
            <!-- start footer -->
            <tr>
                <td class="p-24" align="center">
                    <table class="footer" border="0" width="90%" cellspacing="0" cellpadding="0">
                        <!-- start permission -->
                        <tbody>
                            <tr>
                                <td align="center">
                                    {{-- <p>{email_footer}</p> --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- end footer -->
        </tbody>
    </table>
    <!-- end body -->
</body>

</html>
