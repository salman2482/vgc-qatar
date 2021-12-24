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
                            <form action="{{route('front.vendorVgc.update',$payload['vgc']->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')   
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">CHANGE STATUS</label>
                                            @php
    $status = App\EachRfq::select('status')->where('user_id', auth()->user()->id)->where('vendor_rfq_id',$payload['vgc']->id)->first();
                                        @endphp 
                                                <select name="status" id="status" class="form-control">
                                            <option value="WAITING FOR APPROVAL" 
                                            {{$status->status == 'WAITING FOR APPROVAL' ? 'selected' : ''}}>
                                                        WAITING FOR ACCEPTANCE
                                            </option>

                                            <option value="APPROVED"
                                            {{$status->status == 'APPROVED' ? 'selected' : ''}}>
                                            APPROVED
                                            </option>
                                            
                                            <option value="REJECTED" 
                                            {{$status->status == 'REJECTED' ? 'selected' : ''}}>
                                                REJECTED
                                            </option>
                                                </select>
                                        </div>
                                        
                                    </div>
                                    
                                    {{-- <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">PRIORITY</label>
                                            <input type="text" name="priority" value="{{$status->priority}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">DUE DATE OF REQUEST</label>
                                            <input type="date" name="due_date_request" value="{{$payload['vgc']->due_date_request}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">SN</label>
                                            <input type="text" name="sn" value="{{$payload['vgc']->sn}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">DESCRIPTION</label>
                                            <input type="text" name="description" value="{{$payload['vgc']->description}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">UOM</label>
                                            <input type="text" name="uom" value="{{$payload['vgc']->uom}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">QTY</label>
                                            <input type="text" name="qty" value="{{$payload['vgc']->qty}}" class="form-control">
                                            </div> --}}
                                        {{-- </div> --}}
                                    {{-- </div> --}}
                                    
                                </div>
                                <div class="form-actions">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-light-info text-info font-weight-medium">Submit</button>
                                        <button type="reset" class="btn btn-light-danger text-danger font-weight-medium">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      
    </div>
@endsection
