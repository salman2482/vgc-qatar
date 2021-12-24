@extends('vendor-dashboard.layout.main')

@section('content')
<style>label{color: black;}</style>
<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">{{ $payload['page_title'] }}</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('front.vendorVgc.index')}}">RFQ's List</a></li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="border-bottom title-part-padding">
                            <h4 class="card-title mb-0">{{ $payload['page_title'] }}</h4>
                        </div>
                        <div class="card-body">
                            
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">RFQ. REF</label>
                                           <input type="text" readonly value="{{$payload['vgc']->rfq_ref}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">CATEGORY</label>
                                           <input type="text" readonly value="{{$payload['vgc']->category}}" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">RECEIVING DATE</label>
                                            <input type="text" readonly value="{{$payload['vgc']->receiving_date}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">PRIORITY</label>
                                            <input type="text" readonly value="{{$payload['vgc']->priority}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">DUE DATE OF SUBMISSION</label>
                                            <input type="text" readonly value="{{$payload['vgc']->due_date_request}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">REQUESTOR</label>
                                            <input type="text" readonly value="{{$payload['vgc']->requestor}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">REQUIRED QTN VALIDITY</label>
                                            <input type="text" readonly value="{{$payload['vgc']->required_quotation_validity}}" class="form-control">
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-6 d-flex">
                                            <div class="mb-3 ">
                                            <label for="">RFQ COPY</label>
                                            <?php $attachments =
                                            \App\Models\Attachment::Where('attachmentresource_id', $payload['vgc']->id)
                                            ->Where('attachmentresource_type', 'vendorrfq')
                                            ->get(); ?>
                                           
                                            @forelse ($attachments as $attachment)
                                                
                                            @if ($attachment->attachment_unique_input == 'rfq_attachments')
                                            <a href="{{route('rfq.attachment',$attachment->attachment_uniqiueid)}}"
                                                               class="form-control btn-outline-primary" >
                                                Download <i class="ti-download"></i>
                                                </a>
                                                
                                                @endif
                                                @empty
                                                Not Available
                                            @endforelse
                                            </div>
                                            
                                            <div class="mb-3 " style="margin-left: 30px">
                                                <label for="">IMAGE</label>
                                                <?php $attachments =
                                                \App\Models\Attachment::Where('attachmentresource_id', $payload['vgc']->id)
                                                ->Where('attachmentresource_type', 'vendorrfq')
                                                ->get(); ?>
                                               
                                                @forelse ($attachments as $attachment)
                                                    
                                                @if ($attachment->attachment_unique_input == 'video_attachments')
                                             <a href="{{route('rfq.attachment',$attachment->attachment_uniqiueid)}}"
                                                                   class="form-control btn-outline-primary" >
                                                    Download <i class="ti-download"></i>
                                                    </a>
                                                    
                                                    @endif
                                                    @empty
                                                    Not Available
                                                @endforelse
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <h2 class="text-center"><strong>Materials</strong></h2>
                                        </div>
                                        <div class="col-md-12">
                                            <table class="table table-hover invoice-table " >
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>DESCRIPTION</th>
                                                        <th>UOM</th>
                                                        <th>QTY</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($payload['rfqmaterials'] as $material)
                                                    <tr>
                                                       <td>{{ $loop->index + 1  }}</td>
                                                       <td>{{ $material->description }}</td>
                                                       <td>{{ $material->uom }}</td>
                                                       <td>{{ $material->qty }}</td>
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
            
        </div>
      
    </div>
@endsection
