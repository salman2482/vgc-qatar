@extends('vendor-dashboard.layout.main')
@section('styles')
    <style>
        label {
            color: black !important;
        }

        ::placeholder {
            color: grey !important;
            opacity: 1;
            /* Firefox */
        }

        :-ms-input-placeholder {
            /* Internet Explorer 10-11 */
            color: grey !important;

        }

        ::-ms-input-placeholder {
            /* Microsoft Edge */
            color: grey !important;

        }

        .daysCheckbox4 {
            zoom: 2.5;

        }

        .cat-check1{
            margin-left: 25px;

        }
        @media screen and (max-width: 600px) {
            .cat-check1 {
                margin-left: 25px;
            }

            .download-a{
                margin-top: -25px !important;
                margin-bottom: 50px;
            }
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
                            <form action="{{ route('front.vendor.profile.update', $payload['user']->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">First Name</label>
                                                <input type="text" name="first_name"
                                                    value="{{ $payload['user']->first_name }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Last Name </label>
                                                <input type="text" name="last_name"
                                                    value="{{ $payload['user']->last_name }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Mobile</label>
                                                <input type="text" name="phone" value="{{ $payload['user']->phone }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Email</label>
                                                <input type="text" name="email" readonly value="{{ $payload['user']->email }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Phone</label>
                                            <div class="mb-3">
                                                <input type="text" name="office_telephone_no"
                                                    value="{{ $payload['user']->fvendor->office_telephone_no }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Position</label>
                                                <input type="text" name="position" value="{{ $payload['user']->position }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Commercial Reg No</label>
                                                <input type="text" name="commercial_registration_no"
                                                    value="{{ $payload['user']->fvendor->commercial_registration_no }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Trade License #</label>
                                                <input type="text" name="trade_license_no" class="form-control"
                                                    value="{{ $payload['user']->fvendor->trade_license_no }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Company Name</label>
                                                <input type="text" name="vendor_company_name"
                                                    value="{{ $payload['user']->fvendor->vendor_company_name }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">Address</label>
                                                <input type="text" name="address" class="form-control"
                                                    value="{{ $payload['user']->fvendor->address }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="">PO - Box</label>
                                                <input type="text" name="po_box" class="form-control"
                                                    value="{{ $payload['user']->fvendor->po_box }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        {{-- company profile documents --}}
                                        <div class="col-md-6 ">
                                            <div class="mb-3">
                                                <label for="">Company Profile</label>
                                                <input type="file" name="company_profile" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            @if ($payload['user']->fvendor->company_profile != null)
                                                <label for=""></label>
                                                <a href="{{ asset('storage/public/vendor/' . $payload['user']->fvendor->company_profile) }}"
                                                    download class="mt-1 form-control btn btn-outline-primary download-a">
                                                    Download Old Company Profile
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- company_commercial_license documents --}}
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div class="mb-3">
                                                <label for="">Company Commercial License</label>
                                                <input type="file" name="company_commercial_license" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            @if ($payload['user']->fvendor->company_commercial_license != null)
                                                <label for=""></label>
                                                <a href="{{ asset('storage/public/vendor/' . $payload['user']->fvendor->company_commercial_license) }}"
                                                    download class="mt-1 form-control btn btn-outline-primary download-a">
                                                    Download Old Company License
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- other documents --}}
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div class="mb-3">
                                                <label for="">Other Documents</label>
                                                <input type="file" name="other_documents" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            @if ($payload['user']->fvendor->other_documents != null)
                                                <label for=""></label>
                                                <a href="{{ asset('storage/public/vendor/' . $payload['user']->fvendor->other_documents) }}"
                                                    download class="mt-1 form-control btn btn-outline-primary download-a">
                                                    Download Old Other Documents
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        @php
                                            $cats = [
                                                'Battery Supplier',
                                                'Carpentry Equipment Supplier',
                                                'Carpentry Material Supplier',
                                                'Cctv Maintenance Contractor',
                                                'Civil Contractor',
                                                'Civil Maintenance Contractor',
                                                'Cleaning Equipment Supplier',
                                                'Cleaning Material Supplier',
                                                'Cleaning Services',
                                                'Electrical Contractor',
                                                'Electrical Equipment Supplier',
                                                'Electrical Material Supplier',
                                                'Electromechanical Contractor',
                                                'Electromechanical Maintenance Contractor',
                                                'Elv Equipment Supplier',
                                                'Elv Maintenance Contractor',
                                                'Elv Material Supplier',
                                                'Ff & Fa Contractor',
                                                'Ff & Fa Maintenance Contractor',
                                                'Fire Alarm Equipment Supplier',
                                                'Fire Alarm Material Supplier',
                                                'Fire Fighting Equipment Supplier',
                                                'Fire Fighting Material Supplier',
                                                'Fit-Out Contractor',
                                                'Generator Contractor',
                                                'Hvac Contractor',
                                                'Hvac Material Supplier',
                                                'Industrial Oil Supplier',
                                                'Joinery',
                                                'Joinery Equipment Supplier',
                                                'Joinery Material Supplier',
                                                'Landscaping Contractor',
                                                'Manpower Supplier',
                                                'Mechanical Contractor',
                                                'Office Supplies',
                                                'Others',
                                                'Pest Control Services',
                                                'Plumbing Equipment Supplier',
                                                'Plumbing Material Supplier',
                                                'Security Services',
                                                'Vehicle Maintenance & Garage Services ',
                                                'Vehicle Spare parts Supplier',
                                            ];
                                        @endphp
                                        @php $selected = explode(',',$payload['user']->fvendor->category) @endphp

                                        <div class="row cat-check1">
                                            @error('category')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                          
                                            @foreach ($cats as $cat)
                                                <div class="col-md-6 col-sm-6" style="margin-top: 18px;">
                                                    <input 
                                            @foreach ($selected as $item)
                                                {{$cat == $item ? 'checked' :''}}
                                            @endforeach
                                                            type="checkbox" 
                                                            value="{{ $cat }}"
                                                            class="daysCheckbox4" 
                                                            name="category[]"
                                                            style="position: absolute; margin-left: -15px; margin-top: -3px;"
                                                        >
                                                    <span class="wpcf7-form-control-wrap your-fname">
                                                        {{ $cat }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- <div class="row cat-check2" style="display: none;">
                                            @foreach ($cats as $cat)
                                                <div class="col-md-6 col-sm-6" style="margin-top: 18px;">
                                                    <input 
                                            @foreach ($selected as $item)
                                                {{$cat == $item ? 'checked' :''}}
                                            @endforeach
                                                            type="checkbox" 
                                                            value="{{ $cat }}"
                                                            class="daysCheckbox4" 
                                                            name="category[]"
                                                            style="position: absolute; margin-left: -15px; margin-top: -3px;"
                                                        >
                                                    <span class="wpcf7-form-control-wrap your-fname">
                                                        {{ $cat }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div> --}}

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
@endsection
