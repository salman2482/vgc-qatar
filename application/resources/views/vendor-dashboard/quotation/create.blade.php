@extends('vendor-dashboard.layout.main')

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
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('front.vendorQuotation.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">RFQ REF.</label>
                                                <select name="rfq_ref" id="rfq_ref_select" class="form-control">
                                                    <option value="">Select RFQ</option>
                                                    @foreach ($rfqs as $item)

                                                        <option value="{{ $item->rfq_ref }}">
                                                            {{ $item->rfq_ref }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">RECEIVING DATE </label>
                                                <input type="date" name="receiving_date" class="form-control" id="receiving_date" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">CATEGORY</label>
                                                <input type="text" name="category" class="form-control" id="category" readonly>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">DELIVERY TIME</label>
                                                <input type="date" name="devlivery_time" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">TOTAL VALUE</label>
                                                <input type="text" name="total_value" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">UPLOAD QTN COPY</label>
                                                <input type="file" name="upload_qtn_copy" class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">UPLOAD RFQ COPY</label>
                                                <input type="file" name="upload_rfq_copy" class="form-control">
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="form-actions">
                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-light-info text-info font-weight-medium">Submit</button>
                                        <button type="reset"
                                            class="btn btn-light-danger text-danger font-weight-medium">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <footer class="footer text-center">
        </footer>
        
    </div>

@section('scripts')
    <script>
       var cat = null;
        $("#rfq_ref_select").change(function() {
            var rfq = $("#rfq_ref_select").val();
            $.ajax({
                url: "{{url('rfqCategory')}}",
                type: 'GET',
                data:{id: rfq},
                success:function(response) {     
                    cat = response.category;
                    $('#category').val(cat);
                    $('#receiving_date').val(response.receiving_date);
                }
            });
        });


    </script>
@endsection

@endsection
