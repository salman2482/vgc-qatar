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
                                            <th>PO REF.</th>
                                            <th>QTN REF NO.</th>
                                            <th>ISSUING DATE</th>
                                            <th>CATEGORY</th>
                                            <th>TOTAL VALUE</th>
                                            <th>TERMS CONDITION</th>
                                            <th>PAYMENT METHOD</th>
                                            <th>QTN COPY</th>
                                            <th>PO COPY</th>
                                            {{-- <th>ACTIONS</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payload['pos'] as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{route('front.vendorPo.show', $item->po_ref)}}">
                                                        <strong>
                                                            {{ $item->po_ref }}
                                                        </strong>
                                                    </a>
                                                </td>
                                                <td>{{ $item->qtn_ref_no }}</td>
                                                <td>{{ $item->issuing_date }}</td>
                                                <td>
                                                    {{-- <span class="badge bg-light-danger text-danger font-weight-medium"> --}}
                                                    {{ $item->category }}
                                                    {{-- </span> --}}
                                                </td>
                                                <td>{{ $item->total_value }}</td>
                                                <td>{!! str_limit($item->terms_condition, 20)  !!}</td>
                                                <td>{{ $item->payment_method }}</td>
                                                <td>
                                                    <?php $attachments =
                                                    \App\Models\Attachment::Where('attachmentresource_id', $item->id)
                                                    ->Where('attachmentresource_type', 'vendorpo')
                                                    ->get(); ?>
                                                   
                                                    @forelse ($attachments as $attachment)
                                                        @if ($attachment->attachment_unique_input == 'qtn_attachments')
                                                            <ul class="p-l-0">
                                                                <li id="fx-vendorpos-files-attached"
                                                                    style="list-style: none">
                                                                    <a href="vendorpos/attachments/download/{{ $attachment->attachment_uniqiueid }}"
                                                                        download>
                                                                        Download <i class="ti-download"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            
                                                        @endif
                                                        @empty
                                                        Not Available
                                                    @endforelse


                                                </td>
                                                <td>
                                                    @forelse ($attachments as $attachment)
                                                        @if ($attachment->attachment_unique_input == 'po_attachments')
                                                            <ul class="p-l-0">
                                                                <li id="fx-vendorpos-files-attached"
                                                                    style="list-style: none;">
                                                                    <a href="vendorpos/attachments/download/{{ $attachment->attachment_uniqiueid }}" download> Download <i class="ti-download"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        
                                                        @endif


                                                        @empty
                                                        Not Available
                                                    @endforelse
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
