
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
                                        <th>SN</th>
                                        <th>RFQ. REF</th>
                                        <th>RECEIVING DATE</th>
                                        <th>CATEGORY</th>
                                        <th>PRIORITY</th>
                                        <th>DUE DATE OF SUBMISSION</th>
                                        <th>REQUESTOR</th>
                                        <th>REQUIRED QTN VALIDITY</th>
                                        <th>STATUS</th>
                                        <th>RFQ COPY</th>
                                        <th>DOWNLOAD PDF</th>
                                        <th>IMAGE</th>
                                        <th>CHANGE STATUS</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @dd($userId) --}}
                                    @foreach ($vgcs as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>
                                            <strong>
                                                <a href="{{route('front.vendorVgc.show', $item->id)}}">{{$item->rfq_ref}}</a>
                                            </strong>
                                        </td>
                                        <td>{{$item->receiving_date}}</td>
                                        <td>{!! str_limit($item->category, 20) !!}</td>
                                        <td>{{$item->priority}}</td>
                                        <td>{{$item->due_date_request}}</td>
                                        <td>{{$item->requestor}}</td>
                                        <td>{{$item->required_quotation_validity}}</td>
                                        @php
  $status   = App\EachRfq::select('status')->where('user_id', auth()->user()->id)->where('vendor_rfq_id',$item->id)->first();
                                        $TodayDate = Date('Y-m-d'); 
                                        @endphp 

                                        @if($TodayDate > $item->due_date_request)
                                        <td> <span class="badge-font badge bg-light-danger text-danger">EXPIRED</span>  </td>
                                        @else
                                        <td>
                                            @if ( $status->status == 'WAITING FOR APPROVAL')
                                            <span class="badge-font badge bg-light-info text-info font-weight-medium"> {{'WAITING FOR ACCEPTANCE' ?? ''}} </span>
                                            @elseif ( $status->status == 'APPROVED')
    <?php $qtn = App\Models\VendorQuotation::where('rfq_ref', $item->rfq_ref)->first(); ?>
                                            @if($qtn)
                                            <span class="badge-font badge bg-light-primary text-primary font-weight-medium"> {{$status->status ?? ''}} </span>
                                            @else
                                            <span class="badge-font badge bg-light-primary text-primary font-weight-medium"> 
                                                Waiting For Quotation </span>
                                            @endif   

                                            @elseif ($status->status == 'REJECTED')
                                            <span class="badge-font badge bg-light-warning text-warning font-weight-medium"> {{$status->status ?? ''}} </span>

                                            @endif

                                        </td>
                                        @endif
                                        <td>
                                            <?php $attachments =
                                            \App\Models\Attachment::Where('attachmentresource_id', $item->id)
                                            ->Where('attachmentresource_type', 'vendorrfq')
                                            ->get(); ?>
                                           {{-- @dd($attachments) --}}
                                            @forelse ($attachments as $attachment)
                                                @if ($attachment->attachment_unique_input == 'rfq_attachments')
                                                    <ul class="p-l-0">
                                                        <li id="fx-vendorrfqs-files-attached"
                                                            style="list-style: none">
                                                            <a href="vendorrfqs/attachments/download/{{ $attachment->attachment_uniqiueid }}"
                                                                >
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
                                        <a href="{{ url('vendor/pdf/'.$item->id.'/'.$userId)}}">Download 
                                            <i class="ti-download"></i>
                                        </a>
                                        </td>

                                        <td>
                                            <?php $attachments =
                                                    \App\Models\Attachment::Where('attachmentresource_id', $item->id)
                                                    ->Where('attachmentresource_type', 'vendorrfq')
                                                    ->get(); ?>
                                                   
                                                    @forelse ($attachments as $attachment)
                                                        @if ($attachment->attachment_unique_input == 'video_attachments')
                                                            <ul class="p-l-0">
                                                                <li id="fx-vendorrfqs-files-attached"
                                                                    style="list-style: none">
                                                                    <a href="vendorrfqs/attachments/download/{{ $attachment->attachment_uniqiueid }}"
                                                                        >
                                                                        Download <i class="ti-download"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            
                                                        @endif
                                                        @empty
                                                        Not Available
                                                    @endforelse
                                        </td>
                                        <td style="text-align: center !important;">
                                            @if($TodayDate > $item->due_date_request)
                                            
                                            @else
                                            @if($status->status == 'WAITING FOR APPROVAL' )
                                            <a href="{{ route('front.vendorVgc.edit', $item->id) }}">
                                                <i class="fas fa-edit" style="font-size: 25px;"></i>
                                            </a>
                                            @endif
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
