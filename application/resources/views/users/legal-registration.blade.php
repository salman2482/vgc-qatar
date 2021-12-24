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
            max-width: 800px;
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
            width: 100%;
        }

        .table-gray tr {
            height: 24px;
        }

        .table-gray .td-1 {
            background-color: #f1f3f7;
            width: 40%;
            border: solid 1px #e7e9ec;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .table-gray .td-2 {
            background-color: #f1f3f7;
            width: 70%;
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
            
            <tr>
                <td align="center">
                    <table class="table-1" border="0" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td align="left">
                                    <h1>{{ 'LEGAL REGISTRATION & LICENSE' }}</h1>
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
                                <td class="td-1">
                                </td>
                            </tr>
                            <tr>
                                <td class="td-1">
                                    <table class="table-gray" cellpadding="5">
                                        <tbody>
                                            <tr>
                                                <td class="td-1"><strong>VENDOR COMPANY NAME</strong></td>
                                                <td class="td-2">{{ $data['vendor_company_name'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>COMMERCIAL REGISTRATION NO</strong></td>
                                                <td class="td-2">{{ $data['commercial_registration_no'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>TITLE</strong></td>
                                                <td class="td-2">{{ $data['title'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>FIRST NAME</strong></td>
                                                <td class="td-2">{{ $data['first_name'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>LAST NAME</strong></td>
                                                <td class="td-2">{{ $data['last_name'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>POSITION</strong></td>
                                                <td class="td-2">{{ $data['position'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>EMAIL</strong></td>
                                                <td class="td-2">{{ $data['email'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                            <tr>
                                                <td class="td-1"><strong>TELEPHONE NUMBER</strong></td>
                                                <td class="td-2">{{ $data['office_telephone_no'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>MOBILE NUMBER</strong></td>
                                                <td class="td-2">{{ $data['phone'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>ADDRESS</strong></td>
                                                <td class="td-2">{{ $data['address'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>PO-BOX</strong></td>
                                                <td class="td-2">{{ $data['po_box'] ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td-1"><strong>PURPOSE OF REGISTRATION</strong></td>
                                                <td class="td-2">{{ $data['purpose'] ?? '' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td align="left" bgcolor="#ffffff">
                                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td class="td-button">
                                                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="signature">
                                    <p style="text-align: center">VETERAN GENERAL CONTRACTING</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

        </tbody>
    </table>
    <!-- end body -->
</body>


</html>
