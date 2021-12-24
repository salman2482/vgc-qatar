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
                    <li class="breadcrumb-item"><a href="{{route('front.vendorPo.index')}}">PO's List</a></li>
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
                                            <label for="">PO-REF</label>
                                           <input type="text" readonly value="{{$payload['vendorpo']->po_ref}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">QTN-REF-NO</label>
                                           <input type="text" readonly value="{{$payload['vendorpo']->qtn_ref_no}}" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">CATEGORY</label>
                                            <input type="text" readonly value="{{$payload['vendorpo']->category}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">ISSUING DATE</label>
                                            <input type="text" readonly value="{{$payload['vendorpo']->issuing_date}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">TOTAL VALUE</label>
                                            <input type="text" readonly value="{{$payload['vendorpo']->total_value}}" class="form-control">
                                            </div>
                                        </div>
                                        
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">PAYMENT METHOD</label>
                                            <input type="text" readonly value="{{$payload['vendorpo']->payment_method}}" class="form-control">
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="">TERMS AND CONDITION</label>
                                            <textarea readonly class="form-control" cols="30" rows="5">{{$payload['vendorpo']->terms_condition}}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 d-flex">
                                        <div class="mb-3 ">
                                        <label for="">QTN COPY</label>
                                        <?php $attachments =
                                        \App\Models\Attachment::Where('attachmentresource_id', $payload['vendorpo']->id)
                                        ->Where('attachmentresource_type', 'vendorpo')
                                        ->get(); ?>
                                       
                                        @forelse ($attachments as $attachment)
                                            
                                        @if ($attachment->attachment_unique_input == 'qtn_attachments')
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
                                            <label for="">PO COPY</label>
                                            <?php $attachments =
                                            \App\Models\Attachment::Where('attachmentresource_id', $payload['vendorpo']->id)
                                            ->Where('attachmentresource_type', 'vendorpo')
                                            ->get(); ?>
                                           
                                            @forelse ($attachments as $attachment)
                                                
                                            @if ($attachment->attachment_unique_input == 'po_attachments')
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

                                    
                                    </div>
                                </div>
                              
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      
    </div>
@endsection
