@extends('vendor-dashboard.layout.main')

@section('styles')
    <link href="{{ asset('public/fv/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <style>
        .cardcounter {
            box-shadow: 2px 2px 10px ##66bb6a;
            background-color: #fff;
            height: 100px;
            border-radius: 5px;
            transition: .3s linear all;
        }

        .cardcounter:hover {
            box-shadow: 4px 4px 20px yellowgreen;
            transition: .3s linear all;
        }

        .cardcounter.primary {
            background-color: #007bff;
            color: #FFF;
        }

        .cardcounter.danger {
            background-color: #ef5350;
            color: #FFF;
        }

        .cardcounter.success {
            background-color: #66bb6a;
            color: #FFF;
        }

        .cardcounter.info {
            background-color: #26c6da;
            color: #FFF;
        }

        .cardcounter i {
            font-size: 5em;
            opacity: 0.2;
        }

        .cardcounter .countnumbers {
            right: 35px;
            top: 20px;
            font-size: 32px;
        }

        .cname {
            margin-left: 10px;
            font-style: italic;
            text-transform: capitalize;
            opacity: 0.5;
            font-size: 18px;
        }

    </style>
@endsection


@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{ $payload['page_title'] }}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">{{ $payload['page_title'] }}</li>
                </ol>
            </div>
            <div class="col-md-7 col-12 align-self-center d-none d-md-block">

            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12 col-xl-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center mb-4">
                                <h4 class="card-title">{{ $payload['page_title'] }}</h4>
                            </div>
                            @include('vendor-dashboard.partials.alert')
                            <div class="table-responsive">
                                <div class="container">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <a href="{{route('front.vendorVgc.index')}}">
                                                <div class="cardcounter danger">
                                                    <i class="fa fa-ticket"></i>
                                                    <span class="countnumbers">
                                                        {{$rfqs_count ?? ''}}
                                                    </span>
                                                    <span class="cname">RFQ's</span>
                                                </div>    
                                            </a>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="{{route('front.vendorQuotation.index')}}">
                                                <div class="cardcounter success">
                                                    <i class="fa fa-database"></i>
                                                    <span class="countnumbers">
                                                        {{ $qtns_count ?? ''}}
                                                    </span>
                                                    <span class="cname">Quotation's</span>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="{{route('front.vendorPo.index')}}">
                                                <div class="cardcounter info">
                                                    <i class="fa fa-users"></i>
                                                    <span class="countnumbers">
                                                        {{$po_count ?? ''}}
                                                    </span>
                                                    <span class="cname">PO's</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{route('front.vendorInvoice.index')}}">
                                                <div class="cardcounter primary">
                                                    <i class="fa fa-code-fork"></i>
                                                    <span class="countnumbers">
                                                        {{ $invoices_count ?? ''}}
                                                    </span>
                                                    <span class="cname">Invoice's</span>
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
@endsection
@section('scripts')
    <!--This page plugins -->
    <script src="{{ asset('public/fv/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('public/fv/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>
@endsection
