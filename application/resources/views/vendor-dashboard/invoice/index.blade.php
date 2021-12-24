@extends('vendor-dashboard.layout.main')

@section('styles')
<link href="{{ asset('public/fv/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
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
                                        <th>LPO REF.</th>
                                        <th>DELIVERY DATE</th>
                                        <th>CATEGORY</th>
                                        <th>INVOICE REF NO.</th>
                                        <th>TOTAL VALUE</th>
                                        <th>STATUS</th>
                                        <th>INVOICE COPY</th>
                                        <th>QTN COPY</th>
                                        <th>LPO COPY</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payload['invoices'] as $item)
                                    <tr>
                                        
                                        <td>
                                        <a>
                                        
                                            {{$item->lpo_ref}}
                                        </a>
                                        </td>
                                        <td>{{$item->delivery_date}}</td>
                                        <td>{{$item->category}}</td>
                                        <td>{{$item->invoice_ref_no}}</td>
                                        <td>{{$item->total_value}}</td>
                                        <td>
                                            @if ( $item->status == 'Ready For collection')
                                                    <span class="badge-font badge bg-light-info text-info font-weight-medium"> {{$item->status ?? ''}} </span>
                                                    
                                                    @elseif ( $item->status == 'Approved')
                                                    <span class="badge-font badge bg-light-primary text-primary font-weight-medium"> {{$item->status ?? ''}} </span>

                                                    @elseif ($item->status == 'Request For Amendment')
                                                    <span class="badge-font badge bg-light-warning text-warning font-weight-medium"> {{$item->status ?? ''}} </span>
                                                    
                                                    @elseif ($item->status == 'Received For Authentication')
                                                    <span class="badge-font badge bg-light-danger text-danger font-weight-medium"> {{$item->status ?? ''}} </span>

                                                    @endif
                                        </td>
                                        {{-- invoice --}}
                                        <td>
                                            @if ($item->upload_invoice_copy != null)
                            <a href="{{asset('storage/public/vendor/'.$item->upload_invoice_copy)}}" download>Download</a>
                                            @else
                                            Not Available
                                            @endif
                                        </td>
                                        {{-- qtn copy  --}}
                                        <td>
                                            @if ($item->upload_qtn_copy != null)
                            <a href="{{asset('storage/public/vendor/'.$item->upload_qtn_copy)}}" download>Download</a>
                                            @else
                                            Not Available
                                            @endif
                                            </td>

                                        {{-- lpo copy --}}
                                        <td>
                                            @if ($item->upload_lpo_copy != null)
                        <a href="{{asset('storage/public/vendor/'.$item->upload_lpo_copy)}}" download>Download</a>
                                        @else
                                        Not Available
                                        @endif
                                        </td>
                                        
                                        
                                        <td>
                                            @if($item->status == 'Request For Amendment')
                            <a href="{{route('front.vendorInvoice.edit',$item->id)}}"><i style="font-size: 25px;" class="fas fa-edit"></i></a>
                            &nbsp;&nbsp;&nbsp;
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
