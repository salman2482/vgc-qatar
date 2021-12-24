@extends('vendor-dashboard.layout.main')

@section('styles')
    <link href="{{ asset('public/fv/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}"
        rel="stylesheet">
@endsection


@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
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
            <!-- -------------------------------------------------------------- -->
            <!-- Start Page Content -->
            <!-- -------------------------------------------------------------- -->
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
                                <table id="file_export" class="table table-bordered nowrap display">
                                    <thead>
                                        <tr>
                                            <th>QTN REF NO</th>
                                            <th>RFQ. REF</th>
                                            <th>RECEIVING DATE</th>
                                            <th>CATEGORY</th>
                                            <th>TOTAL VALUE</th>
                                            <th>DELIVERY TIME</th>
                                            <th>STATUS</th>
                                            <th>UPLOAD QTN COPY</th>
                                            <th>UPLOAD RFQ COPY</th>
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payload['quotations'] as $item)
                                            <tr>
                                                <td>{{ $item->qtn_ref_no }} </td>
                                                <td>
                                                    <strong>
                                                        <a href="{{route('front.vendorVgc.show', $item->rfq_ref)}}">{{$item->rfq_ref}}</a>
                                                    </strong>
                                                </td>
                                                <td>{{ $item->receiving_date }}</td>
                                                <td>{{ $item->category }}</td>
                                                <td>{{ $item->total_value }}</td>
                                                <td>{{ $item->devlivery_time }}</td>
                                                <td>
                                                @if ( $item->status == 'WAITING FOR APPROVAL')
                                                    <span class="badge-font badge bg-light-info text-info font-weight-medium"> {{$item->status ?? ''}} </span>
                                                    
                                                    @elseif ( $item->status == 'APPROVED')
                                                    <span class="badge-font badge bg-light-primary text-primary font-weight-medium"> {{$item->status ?? ''}} </span>

                                                    @elseif ($item->status == 'CANCELLED')
                                                    <span class="badge-font badge bg-light-danger text-danger font-weight-medium"> {{$item->status ?? ''}} </span>

                                                    @elseif ($item->status == 'REQUESTING FOR DISCOUNT')
                                                    <span class="badge-font badge bg-light-warning text-warning font-weight-medium"> {{$item->status ?? ''}} </span>

                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->upload_qtn_copy != null)
                                                        <a href="{{ asset('storage/public/vendor/' . $item->upload_qtn_copy) }}"
                                                            download>Download</a>
                                                    @else
                                                        Not Available
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->upload_rfq_copy != null)
                                                        <a href="{{ asset('storage/public/vendor/' . $item->upload_rfq_copy) }}"
                                                            download>Download</a>
                                                    @else
                                                        Not Available
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->status == 'REQUESTING FOR DISCOUNT')
                                                    <a href="{{ route('front.vendorQuotation.edit', $item->id) }}"><i
                                                            class="fas fa-edit" style="font-size: 25px;"></i></a>
                                                            &nbsp;&nbsp;&nbsp;
                                                    {{-- <a href="{{ route('front.vendor.Quotation.delete', $item->id) }}"><i
                                                            class="text-danger fas fa-trash" style="font-size: 25px;"></i></a> --}}
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
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
