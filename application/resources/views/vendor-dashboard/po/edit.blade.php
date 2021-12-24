@extends('vendor-dashboard.layout.main')
@section('styles')
<style>
    label{
        color: black !important;
    }
</style>

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
                <div class="col-12">
                    <div class="card">
                        <div class="border-bottom title-part-padding">
                            <h4 class="card-title mb-0">{{ $payload['page_title'] }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('front.vendorPo.update',$payload['po']->id) }}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">PO REF.</label>
                                            <input type="text" name="po_ref" value="{{$payload['po']->po_ref}}" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">ISSUING DATE </label>
                                            <input type="date" name="issuing_date" value="{{$payload['po']->issuing_date}}" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">CATEGORY</label>
                                            <input type="text" name="category" value="{{$payload['po']->category}}" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">QTN REF NO.</label>
                                            <div class="mb-3">
                                            <input type="text" name="qtn_ref_no" value="{{$payload['po']->qtn_ref_no}}" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">TOTAL VALUE</label>
                                            <input type="text" name="total_value" value="{{$payload['po']->total_value}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">TERMS & CONDITION</label>
                                            <input type="text" name="terms_condition" value="{{$payload['po']->terms_condition}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">PAYMENT METHOS</label>
                                            <input type="text" name="payment_method" value="{{$payload['po']->payment_method}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">UPLOAD QTN  COPY</label>
                                            <input type="file" name="upload_qtn_copy" class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">UPLOAD PO COPY</label>
                                            <input type="file" name="upload_po_copy" class="form-control">
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
            <!-- -------------------------------------------------------------- -->
            <!-- End PAge Content -->
            <!-- -------------------------------------------------------------- -->
        </div>
        <!-- -------------------------------------------------------------- -->
        <!-- End Container fluid  -->
        <!-- -------------------------------------------------------------- -->
        <!-- -------------------------------------------------------------- -->
        <!-- footer -->
        <!-- -------------------------------------------------------------- -->
        <footer class="footer text-center">
        </footer>
        <!-- -------------------------------------------------------------- -->
        <!-- End footer -->
        <!-- -------------------------------------------------------------- -->
    </div>
@endsection
