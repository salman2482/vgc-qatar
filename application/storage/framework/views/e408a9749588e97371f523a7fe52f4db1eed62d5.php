<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Email Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        @media  screen {
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
            max-width: 600px;
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
            max-width: 600px;
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
            max-width: 600px;
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
            width: 30%;
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
            max-width: 600px;
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
                                    <h1><img src="<?php echo e(asset('storage/public/email-logo.png')); ?>"  width="150px" alt=""></h1>
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
                                <td align="left">
                                    <h1>Dear Candidate, <?php echo e($apply ?? ''->first_name); ?> <?php echo e($apply ?? ''->middle_name); ?>

                                        <?php echo e($apply ?? ''->last_name); ?> 
                                    </h1>
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
                                <td class="td-1">
                                </td>
                            </tr>
                            <tr>
                                <td class="td-1">
                                    <table class="table-gray" cellpadding="5">
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                        <p>
                                            Thank you for your application to Veteran. We shall review your application and will revert back to you soon.
                                        </p>
                                        <p>
                                            For further information, please contact Veteran directly thru 4444-1061.
                                        </p>
                                </td>
                               
                            </tr>
                            <tr>
                                 <td class="td-1">
                                    <p>Best Regards,</p> 
                                    <p>Veteran</p> 
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="signature">
                                    <i style="text-align: center">
                                    ???This is an auto-generated email. For clarification, please contact us through <br> 
                                    info@vgc-qatar.com???
                                    </i>
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
                    <table class="footer" border="0" width="100%" cellspacing="0" cellpadding="0">
                        <!-- start permission -->
                        <tbody>
                           
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
<?php /**PATH /home/alrifaig/public_html/application/resources/views/users/career-apply.blade.php ENDPATH**/ ?>