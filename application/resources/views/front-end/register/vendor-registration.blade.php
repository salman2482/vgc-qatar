@extends('front-end.layouts.master')
@section('styles')
<style>
    #catCheck{
        zoom: 2.5;
    }
    .error{
        color: red;
        font-weight: 700;
        font-weight: 700;
        font-size: 15px;
    }
    .modal-body{
        padding-left: 45px !important;
        padding-right: 45px !important;
    }
    </style>
    {!! NoCaptcha::renderJs() !!}
@endsection
@section('front-end-content')

    <!--About Section-->
    <section class="register-section ">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Form Column-->
                <div class="form-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column p-3">
                        
                        <div class="sec-title">
                            <h2>{{__('fl.Vendor Registeration')}} </h2>
                        </div>
                        <div class="contact-form">
                            <form action="{{ route('front.vendor.store') }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                <div class="row clearfix">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="vendor_company_name" value="{{ old('vendor_company_name') }}"
                                            placeholder="VENDOR COMPANY NAME" required >
                                            
                                            @error('vendor_company_name')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                    </div>
    
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="commercial_registration_no" placeholder="COMMERCIAL REGISTRATION NO" required value="{{ old('commercial_registration_no') }}">
                                        @error('commercial_registration_no')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="trade_license_no" required placeholder="TRADE LICENSE NO" value="{{ old('trade_license_no') }}">
                                        @error('trade_license_no')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <select name="title">
                                            <option value="Mr" {{ old('title') == 'Mr' ? 'selected' : '' }}>Mr</option>
                                        <option value="Madam" {{ old('title') == 'Madam' ? 'selected' : '' }}>Madam</option>
                                            <option value="Ms" {{ old('title') == 'Ms' ? 'selected' : '' }}>Ms</option>
                                            <option value="Dr" {{ old('title') == 'Dr' ? 'selected' : '' }}>Dr</option>
                                            <option value="Engr" {{ old('title') == 'Engr' ? 'selected' : '' }}>Engr</option>
                                        </select>
    
                                        @error('title')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="first_name" required placeholder="CONTACT PERSON FIRST NAME" value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="last_name" required placeholder="CONTACT PERSON LAST NAME" value="{{ old('last_name') }}">
                                        @error('last_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="position" required placeholder="POSITION" value="{{ old('position') }}">
                                        @error('position')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="email" required readonly onfocus="this.removeAttribute('readonly');" name="email" placeholder="example@example.com" value="{{ old('email') }}">
                                        @error('email')
                                        <div class="error" id="email_error">{{ $message }}</div>
                                        @enderror
                                        <div class="error" id="email_error"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" name="password" placeholder="PASSWORD" value="{{ old('password') }}">
                                        @error('password')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{--  --}}

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  name="office_telephone_no" placeholder="OFFICE TELEPHONE NUMBER" value="{{ old('office_telephone_no') }}">
                                        @error('office_telephone_no')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="phone" placeholder="MOBILE NUMBER" value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" required name="address" placeholder="ADDRESS" value="{{ old('address') }}">
                                        @error('address')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="po_box" placeholder="PO-BOX" value="{{ old('po_box') }}">
                                        @error('po_box')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <p class="text-center text-capitalize"
                                            style="color: seagreen !important; font-weight: 550">
                                            {{__('fl.business category (please tick on the respective box and indicate additional remarks/specifications if any)')}} <span class="text-center">*</span>
                                        </p>
                                    </div>

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
                                        <br><br>
                                    @error('category')
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="error">{{ $message }}</div>
                                    </div>
                                    @enderror

                                    <div class="row" style="margin-top: 10px; margin-left: 36px;">
                                    @foreach ($cats as $cat)
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="checkbox" value="{{ $cat }}" id="catCheck"  name="category[]" style="position: absolute; margin-left: -15px; margin-top: -3px;" 
                                    {{ (is_array(old('category')) && in_array($cat, old('category'))) ? ' checked' : '' }}>
                                        <span>
                                            {{ $cat }}
                                        </span>
                                    </div>
                                    @endforeach
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 mt-2 d-flex">
                                        <span class="h6">
                                            {{__('fl.IS YOUR COMPANY ASSOCIATED WITH OUR FIRM ?')}}
                                        </span>
                                        <span>
                                            <input type="checkbox" value="yes" style="zoom: 2.5; margin-top: -3px !important; margin-left: 10px !important;" name="company_association"
                                            {{ old('company_association') == 'yes' ? 'checked' : '' }} >
                                        </span>
                                    </div>
                                    <hr style="width: 100%">

                                    
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <textarea name="learn_about_compnay" placeholder="HOW DID YOU LEARN ABOUT OUR COMPANY ?" cols="30" rows="10">{{ old('learn_about_compnay') }}</textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-2 col-sm-12">
                                            <label class="h5">{{__('fl.Company Profile')}}</label>
                                        </div>
                                        <div class="col-md-10 col-sm-12">
                                            <input type="file" name="company_profile" required>
                                            @error('company_profile')
                                            <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-4 col-sm-12">
                                        <label class="h5">{{__('fl.Company Commercial License')}}</label>
                                        </div>
                                        <div class="col-md-10 col-sm-12">
                                            <input type="file" name="company_commercial_license" required>
                                        @error('company_commercial_license')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-2 col-sm-12">
                                            <label class="h5">{{__('fl.Other Documents')}}</label>
                                        </div>
                                        <div class="col-md-10 col-sm-12">
                                            <input type="file" name="other_documents">
                                        @error('other_documents')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            <strong class="text-danger">
                                                {{ $errors->first('g-recaptcha-response') }}
                                            </strong>
                                        </span>
                                        @endif
                                        {!! app('captcha')->display() !!}
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 mt-2 d-flex">
                                        <span>
                                            <input required type="checkbox" value="yes" style="zoom: 2.5; margin-top: -3px !important; margin-left: 0px !important;" name="company_association"
                                            {{ old('company_association') == 'yes' ? 'checked' : '' }} >
                                        </span>

                                        <span class="h6" style="margin-right: 10px !important">
                                            I agree terms and condition 
                                            <a id="vendor-use-terms" href="#">Read Here</a>
                                        </span>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" class="theme-btn btn-style-one">
                                            <span class="txt">{{__('fl.Submit')}}</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </section>

    {{-- vendor use terms --}}
<?php $rec = \App\Models\FrontBanner::where('id', 50)->first(); ?>
@isset($rec)

    <div class="modal" id="vendor-use-term-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-danger">
                        @if (App::isLocale('ar'))
                            <h2>{!! $rec->title_ar !!}</h2>
                        @else
                            <h2>{!! $rec->title !!}</h2>
                        @endif
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (App::isLocale('ar'))
                    <p>{!! $rec->description_ar !!}</p>
                @else
                    <p>{!! $rec->description !!}</p>
                @endif
                </div>
            </div>
        </div>
    </div>
@endisset



    <!--End About Section-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
          $("#email").blur(function(){
            $('#email_error').text("");

            var final = $("#email").val();
                // threefull flag works for both
                $.ajax({
                url: "{{url('testUrl')}}",
                type: 'GET',
                data:{id: final},
                success:function(response) {     
                
                var cities = response;
                console.log(cities);  
                $('#email_error').text(cities[0].email);
                    
                    if(cities == 1){
                        $('#email_error').text("The Email Is Already Taken");
                        $(':input[type="submit"]').prop('disabled', true);
                        $('html, body').animate({ scrollTop: $('#email_error').offset().top }, 'slow');
                    }else{
                        $('#email_error').text("");
                    }

                }
            });        
            
          });
        });

        $(document).ready(function() {
        $("#vendor-use-terms").click(function(e) {
            e.preventDefault();
            $('#vendor-use-term-modal').modal('show');
        });
        });
        </script>

@endsection


