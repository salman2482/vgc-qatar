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
                            <form action="{{route('front.vendorVgc.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf   
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">RFQ. REF.</label>
                                            <input type="text" name="rfq_ref" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">CATEGORY</label>
                                            <input type="date" name="category" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">PRIORITY</label>
                                            <input type="text" name="priority" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">DUE DATE OF REQUEST</label>
                                            <input type="date" name="due_date_request" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">SN</label>
                                            <input type="text" name="sn" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">DESCRIPTION</label>
                                            <input type="text" name="description" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">UOM</label>
                                            <input type="text" name="uom" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">QTY</label>
                                            <input type="text" name="qty" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
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
