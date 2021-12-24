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

                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-capitalize">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form action="{{route('front.vendorInvoice.store')}}" method="POST" enctype="multipart/form-data"> 
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">LPO REF.</label>
                                            <select name="lpo_ref" id="lpo_ref_select" class="form-control">
                                                <option value="">Select LPO</option>
                                                @foreach ($pos as $item)
                                                    <option value="{{ $item->po_ref }}">
                                                        {{ $item->po_ref }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">DELIVERY DATE </label>
                                            <input type="date" name="delivery_date" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">CATEGORY</label>
                                            <input type="text" name="category" id="category" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">INVOICE REF NO.</label>
                                            <div class="mb-3">
                                            <input type="text" name="invoice_ref_no" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">TOTAL VALUE</label>
                                            <input type="text" id="total_value" name="total_value" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">UPLOAD INVOICE COPY</label>
                                            <input type="file" name="upload_invoice_copy" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">UPLOAD QTN COPY</label>
                                            <input type="file" name="upload_qtn_copy" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="">UPLOAD LPO  COPY</label>
                                            <input type="file" name="upload_lpo_copy" class="form-control">
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
        
        <footer class="footer text-center">
               
        </footer>
        
    </div>

    
@section('scripts')
<script>
   var cat = null;
    $("#lpo_ref_select").change(function() {
        var lpo = $("#lpo_ref_select").val();
        // alert(lpo);
        $.ajax({
            url: "{{url('poCatTotal')}}",
            type: 'GET',
            data:{id: lpo},
            success:function(response) {     
                cat = response.category;
                $('#category').val(cat);
                $('#total_value').val(response.total_value);
            }
        });
    });


</script>
@endsection

@endsection
