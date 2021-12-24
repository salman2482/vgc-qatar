@extends('front-end.layouts.master')
@section('styles')

    {!! NoCaptcha::renderJs() !!}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

    <style>
        .experience-select option {
            font-size: 16px;
        }

        @media screen and (min-width : 1000px) {
            .div-name {
                display: flex !important;
                margin-bottom: 10px;
            }
        }

        @media screen and (min-width : 1000px) {
            .mbl-label{
                display: none !important;
            }
            .label3 {
                display: block;
            }
        }
        @media screen and (max-width : 1000px) {
            .mbl-label{
                display: block !important;
            }
            
            .label3 {
                display: none;
            }
        }
         

        @media screen and (max-width : 700px) {
            
            .mobile-personal-label {
                display: block !important;
                font-size: 18px;
                background: #f9e7eb;
                line-height: 20px;
                margin: 21px 0px 26px 0px;
                color: #dc3545 !important;
                display: inline-block;
                display: inline-block;
                padding: .25em .4em;
                font-weight: 700;
                border-radius: .25rem;
            }

            .emp-div {
                margin-bottom: 10px;
            }
        }

        form input[type="text"] {
            border: 1px solid #2ECC40 !important
        }

        .einput {
            border: 1px solid #2ECC40 !important
        }

        select {
            border: 1px solid #2ECC40 !important
        }

        label {
            color: black;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 16px
        }

        .docs-ol li {
            list-style-type: decimal !important;
        }

    </style>
@endsection

@section('front-end-content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @if ($attachment->attachment_unique_input === 'frontbanner')
        <img class="img-fluid" src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" style="height: " alt="">
    @endif

    <!--About Section-->
    <section class="about-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Column-->
                <div class="content-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            @if (App::isLocale('ar'))
                                <h2>{!! $banner->title_ar !!}</h2>
                            @else
                                <h2>{!! $banner->title !!}</h2>
                            @endif
                        </div>
                        <div class="text">
                            @if (App::isLocale('ar'))
                                <p>{!! $banner->description_ar !!}</p>
                            @else
                                <p>{!! $banner->description !!}</p>
                            @endif

                        </div>


                        <div class="text">
                            <div class="contact-form">
                                <form action="{{ route('careersapply.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row clearfix">

                                        @php
                                            $cats = ['ACCOUNTING', 'ADMINISTRATION', 'CIVIL', 'CLEANING', 'DISINFECTION', 'ELECTRICAL', 'ELECTRO-MECHANICAL', 'ELEVATORS', 'ESCALATORS', 'FACILITY MANAGEMENT', 'FINANCE', 'FIRE ALARM', 'FIRE FIGHTING', 'HOSPITALITY', 'HVAC', 'INSURANCE', 'IT', 'JOINERY', 'LOGISTICS', 'MAINTENANCE', 'MANAGEMENT', 'MARKETING', 'MECHANICAL', 'OPERATIONS', 'OTHERS', 'PEST CONTROL', 'PROCUREMENT', 'PROPERTY MANAGEMENT', 'PUBLIC RELATION', 'QUALITY CONTROL', 'QUANTITY SURVEY', 'SALES', 'TRANSPORTATION'];
                                        @endphp
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="field"><strong>{{ __('fl.Select Field') }}</strong></label>
                                            <select class="experience-select" name="field">

                                                @if ($category != '')
                                                    <option value="{{ $category }}" selected>{{ $category }}
                                                    </option>
                                                @else

                                                    @foreach ($cats as $single)
                                                        <option {{ old('field') == $single ? 'selected' : '' }}
                                                            value="{{ $single }}"> {{ $single }}</option>
                                                    @endforeach

                                                @endif
                                            </select>

                                            @error('field')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <input type="hidden" name="type"
                                            value="{{ $category ? 'Current Openings' : 'Open Apply' }}">

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Position Applied For') }}</strong></label>

                                            @if ($position != '')
                                                <input type="text" name="position" value="{{ $position }}"
                                                 required readonly>

                                            @else
                                                <input type="text" name="position"
                                                    required value="{{ old('position') }}">
                                            @endif
                                            @error('position')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label
                                                for="field"><strong>{{ __('fl.Years Of Experience') }}</strong></label>
                                            <select name="experience">

                                                <option value="1 Year"
                                                    {{ old('experience') == '1 Year' ? 'selected' : '' }}>1</option>
                                                <option value="2 Years"
                                                    {{ old('experience') == '2 Years' ? 'selected' : '' }}>2</option>
                                                <option value="3 Years"
                                                    {{ old('experience') == '3 Years' ? 'selected' : '' }}>3</option>
                                                <option value="4 Years"
                                                    {{ old('experience') == '4 Years' ? 'selected' : '' }}>4</option>
                                                <option value="5 Years"
                                                    {{ old('experience') == '5 Years' ? 'selected' : '' }}>5</option>
                                                <option value="6 Years"
                                                    {{ old('experience') == '6 Years' ? 'selected' : '' }}>6</option>
                                                <option value="7 Years"
                                                    {{ old('experience') == '7 Years' ? 'selected' : '' }}>7</option>
                                                <option value="8 Years"
                                                    {{ old('experience') == '8 Years' ? 'selected' : '' }}>8</option>
                                                <option value="9 Years"
                                                    {{ old('experience') == '9 Years' ? 'selected' : '' }}>9</option>
                                                <option value="10 Years"
                                                    {{ old('experience') == '10 Years' ? 'selected' : '' }}>
                                                    10
                                                </option>
                                                <option value="More Than 10 Years"
                                                    {{ old('experience') == 'More Than 10 Years' ? 'selected' : '' }}>
                                                    More Than 10 Years
                                                </option>
                                            </select>

                                            @error('experience')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label
                                                for="field"><strong>{{ __('fl.Best Time To Receive Calls') }}</strong></label>
                                            <select class="experience-select" name="time_to_receive_calls">
                                                <option {{ old('time_to_receive_calls') == 'Morning' ? 'selected' : '' }}
                                                    value="Morning">Morning</option>
                                                <option
                                                    {{ old('time_to_receive_calls') == 'After Noon' ? 'selected' : '' }}
                                                    value="After Noon">After Noon</option>
                                                <option {{ old('time_to_receive_calls') == 'Evening' ? 'selected' : '' }}
                                                    value="Evening">Evening</option>
                                            </select>
                                            @error('time_to_receive_calls')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.First Name') }}</strong></label>

                                            <input value="{{ old('first_name') }}" type="text" name="first_name"
                                                 required>
                                            @error('first_name')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Middle Name') }}</strong></label>

                                            <input value="{{ old('middle_name') }}" type="text" name="middle_name"
                                                 required>
                                            @error('middle_name')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Last Name') }}</strong></label>

                                            <input value="{{ old('last_name') }}" type="text" name="last_name"
                                                 required>
                                            @error('last_name')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Date Of Birth') }}</strong></label>

                                            <input type="text" name="dob" id="dob" 
                                                value="{{ old('dob') }}">
                                            @error('dob')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="field"><strong>{{ __('fl.Gender') }}</strong></label>
                                            <select class="experience-select" name="gender">
                                                <option {{ old('gender') == 'Male' ? 'selected' : '' }} value="Male">Male
                                                </option>
                                                <option {{ old('gender') == 'Female' ? 'selected' : '' }} value="Female">
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="field"><strong>{{ __('fl.Marital Status') }}</strong></label>
                                            <select class="experience-select" name="marital_status">
                                                <option {{ old('marital_status') == 'Single' ? 'selected' : '' }}
                                                    value="Single">Single</option>
                                                <option {{ old('marital_status') == 'Married' ? 'selected' : '' }}
                                                    value="Married">Married</option>
                                            </select>
                                            @error('marital_status')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label
                                                for="field"><strong>{{ __('fl.Educational Attainment') }}</strong></label>
                                            <select class="experience-select" name="education">
                                                <option {{ old('education') == 'Under Graduate' ? 'selected' : '' }}
                                                    value="Under Graduate">
                                                    Under Graduate
                                                </option>
                                                <option {{ old('education') == 'High School' ? 'selected' : '' }}
                                                    value="High School">High School</option>
                                                <option {{ old('education') == 'College' ? 'selected' : '' }}
                                                    value="College">College</option>
                                                <option {{ old('education') == 'Bachelor’s Degree' ? 'selected' : '' }}
                                                    value="Bachelor’s Degree">Bachelor’s
                                                    Degree</option>
                                                <option {{ old('education') == 'Masters' ? 'selected' : '' }}
                                                    value="Masters">Masters</option>
                                                <option {{ old('education') == 'Doctorate' ? 'selected' : '' }}
                                                    value="Doctorate">Doctorate</option>
                                                <option {{ old('education') == 'N/A' ? 'selected' : '' }} value="N/A">N/A
                                                </option>
                                            </select>
                                            @error('education')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Nationality') }}</strong></label>

                                            <input type="text" name="nationality"  required
                                                value="{{ old('nationality') }}">
                                            @error('nationality')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Other Nationality') }}</strong></label>

                                            <input type="text" name="other_nationality" 
                                                required value="{{ old('other_nationality') }}">
                                            @error('other_nationality')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Current Country') }} </strong></label>

                                            <input type="text" name="current_country" 
                                                required value="{{ old('current_country') }}">
                                            @error('current_country')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Address') }}</strong></label>

                                            <input type="text" name="address"  required
                                                value="{{ old('address') }}">
                                            @error('address')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Primary Email') }}</strong></label>

                                            <input type="email" name="primary_email" class="einput"
                                                 required value="{{ old('primary_email') }}">
                                            @error('primary_email')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Secondary Email') }}</strong></label>

                                            <input type="email" name="secondary_email" class="einput"
                                                required
                                                value="{{ old('secondary_email') }}">
                                            @error('secondary_email')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Mobile') }}</strong></label>

                                            <input type="text" name="mobile"  required
                                                value="{{ old('mobile') }}">
                                            @error('mobile')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong>{{ __('fl.Land Line') }}</strong></label>

                                            <input type="text" name="land_line" required
                                                value="{{ old('land_line') }}">
                                            @error('land_line')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>

                                                <strong>{{ __('fl.Why are you leaving your current job (if presently employed)?') }}</strong>
                                            </label>
                                            <select class="experience-select" name="why_current_job">
                                                <option value="Looking for better job opportunity" {{ old('why_current_job') == 'Looking for better job opportunity' ? 'selected' : '' }}>
                                                    Looking for better job opportunity
                                                </option>

                                                <option value="No growth in my present job" {{ old('why_current_job') == 'No growth in my present job' ? 'selected' : '' }}>
                                                    No growth in my present job
                                                </option>

                                                <option value="Working environment" {{ old('why_current_job') == 'Working environment' ? 'selected' : '' }}>
                                                    Working environment
                                                </option>

                                                <option value="Others" {{ old('why_current_job') == 'Others' ? 'selected' : '' }}>
                                                    Others
                                                </option>

                                            </select>
                                            @error('why_current_job')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>
                                                <strong>{{ __('fl.If you were terminated, what is the reason of termination?') }}</strong>
                                            </label>
                                            <select class="experience-select" name="termination">
                                                <option {{ old('termination') == 'End of contract' ? 'selected' : '' }} value="End of contract">
                                                    End of contract
                                                </option>

                                                <option value="No business" {{ old('termination') == 'No business' ? 'selected' : '' }}>
                                                    No business
                                                </option>

                                                <option value="Administrative issues" {{ old('termination') == 'Administrative issues' ? 'selected' : '' }}> 
                                                    Administrative issues
                                                </option>

                                                <option value="Others" {{ old('termination') == 'Others' ? 'selected' : '' }}>
                                                    Others
                                                </option>

                                            </select>
                                            @error('termination')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>

                                                <strong>{{ __('fl.Joining Date') }}: </strong>
                                            </label>
                                            <select class="experience-select" name="joining_date">
                                                <option value="Immediately" {{ old('joining_date') == 'Immediately' ? 'selected' : '' }}>
                                                    Immediately
                                                </option>

                                                <option value="1 Month Notice" {{ old('joining_date') == '1 Month Notice' ? 'selected' : '' }}>
                                                    1 Month Notice
                                                </option>

                                                <option value="2 Month Notice" {{ old('joining_date') == '2 Month Notice' ? 'selected' : '' }}>
                                                    2 Month Notice
                                                </option>

                                                <option value="3 Month Notice" {{ old('joining_date') == '3 Month Notice' ? 'selected' : '' }}>
                                                    3 Month Notice
                                                </option>

                                            </select>
                                            @error('joining_date')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>
                                                <strong>{{ __('fl.Qatar Governmental Official Permits') }} </strong>
                                            </label>
                                            <select class="experience-select" name="governmental_permits">
                                                <option value="Valid RP" {{ old('governmental_permits') == 'Valid RP' ? 'selected' : '' }}>Valid RP
                                                </option>

                                                <option value="InValid RP" {{ old('governmental_permits') == 'InValid RP' ? 'selected' : '' }}>
                                                    InValid RP
                                                </option>

                                                <option value="Work Visa" {{ old('governmental_permits') == 'Work Visa' ? 'selected' : '' }}>
                                                    Work Visa
                                                </option>

                                                <option value="Other Visas" {{ old('governmental_permits') == 'Other Visas' ? 'selected' : '' }}>
                                                    Other Visas
                                                </option>

                                            </select>
                                            @error('governmental_permits')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>

                                                <strong>{{ __('fl.Non Governmental Official Permits') }} </strong>
                                            </label>
                                            <select class="experience-select" name="nongovernmental_permits">
                                                <option value="UPDA" {{ old('nongovernmental_permits') == 'UPDA' ? 'selected' : '' }}>
                                                    UPDA
                                                </option>

                                                <option value="QCDD" {{ old('nongovernmental_permits') == 'QCDD' ? 'selected' : '' }}>
                                                    QCDD
                                                </option>
                                                <option value="Others" {{ old('nongovernmental_permits') == 'Others' ? 'selected' : '' }}>
                                                    Others
                                                </option>
                                                

                                            </select>
                                            @error('nongovernmental_permits')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>
                                                <strong>{{ __('fl.Licences') }} </strong>
                                            </label>
                                            <select class="experience-select" name="license">
                                                <option value="Qatar Driving Licence" {{ old('license') == 'Qatar Driving Licence' ? 'selected' : '' }}> 
                                                    Qatar Driving Licence
                                                </option>

                                                <option value="GCC Driving Licence" {{ old('license') == 'GCC Driving Licence' ? 'selected' : '' }}>
                                                    GCC Driving Licence
                                                </option>
                                                <option value="Others" {{ old('license') == 'Others' ? 'selected' : '' }}>
                                                    Others
                                                </option>

                                            </select>
                                            @error('license')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>

                                                <strong>{{ __('fl.Certificates') }} </strong>
                                            </label>
                                            <select class="experience-select" name="certificate">
                                                <option value="NEBOSH" {{ old('certificate') == 'NEBOSH' ? 'selected' : '' }}>
                                                    NEBOSH
                                                </option>

                                                <option value="IOSH" {{ old('certificate') == 'IOSH' ? 'selected' : '' }}>
                                                    IOSH
                                                </option>

                                                <option value="IMS" {{ old('certificate') == 'GCC Driving Licence' ? 'selected' : '' }}>
                                                    IMS
                                                </option>

                                                <option value="ISO" {{ old('certificate') == 'ISO' ? 'selected' : '' }}>
                                                    ISO
                                                </option>

                                                <option value="ISO AUDITOR" {{ old('certificate') == 'ISO AUDITOR' ? 'selected' : '' }}>
                                                    ISO AUDITOR
                                                </option>

                                                <option value="IRATA" {{ old('certificate') == 'IRATA' ? 'selected' : '' }}>
                                                    IRATA
                                                </option>

                                                <option value="BICSc" {{ old('certificate') == 'BICSc' ? 'selected' : '' }}>
                                                    BICSc
                                                </option>

                                                <option value="CMC/CMCI" {{ old('certificate') == 'CMC/CMCI' ? 'selected' : '' }}>
                                                    CMC/CMCI
                                                </option>
                                                <option value="Others" {{ old('certificate') == 'Others' ? 'selected' : '' }}>
                                                    Others
                                                </option>

                                            </select>
                                            @error('certificate')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>

                                                <strong>{{ __('fl.NOC Availability') }}: </strong>
                                            </label>
                                            <select class="experience-select" name="noc">
                                                <option value="Yes" {{ old('noc') == 'Yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>

                                                <option value="No" {{ old('noc') == 'No' ? 'selected' : '' }}>
                                                    No
                                                </option>

                                                <option value="Secondment" {{ old('noc') == 'Secondment' ? 'selected' : '' }}>
                                                    Secondment
                                                </option>

                                            </select>
                                            @error('noc')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label>
                                                <strong>{{ __('fl.Expected monthly salary in QAR') }}:</strong>
                                            </label>
                                            <select class="experience-select" name="expected_salary">
                                                <option value="1000 To 2000 QAR" {{ old('expected_salary') == '1000 To 2000 QAR' ? 'selected' : '' }}>  
                                                    1000 To 2000 QAR
                                                </option>

                                                <option value="2000 To 3500 QAR" {{ old('expected_salary') == '2000 To 3500 QAR' ? 'selected' : '' }}>
                                                    2000 To 3500 QAR
                                                </option>

                                                <option value="3500 To 5500 QAR" {{ old('expected_salary') == '3500 To 5500 QAR' ? 'selected' : '' }}>
                                                    3500 To 5500 QAR
                                                </option>

                                                <option value="5500 To 7500 QAR" {{ old('expected_salary') == '5500 To 7500 QAR' ? 'selected' : '' }}>
                                                    5500 To 7500 QAR
                                                </option>

                                                <option value="7500 To 10000 QAR" {{ old('expected_salary') == '7500 To 10000 QAR' ? 'selected' : '' }}>
                                                    7500 To 10000 QAR
                                                </option>

                                                <option value="10000 To 15000 QAR" {{ old('expected_salary') == '10000 To 15000 QAR' ? 'selected' : '' }}>
                                                    10000 To 15000 QAR
                                                </option>

                                                <option value="15000 To 25000 QAR" {{ old('expected_salary') == '15000 To 25000 QAR' ? 'selected' : '' }}>
                                                    15000 To 25000 QAR
                                                </option>

                                                <option value="Others" {{ old('expected_salary') == 'Others' ? 'selected' : '' }}>
                                                    Others
                                                </option>

                                            </select>
                                            @error('expected_salary')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label>

                                                <strong>{{ __('fl.Do you have any objection if we contact your previous employer(s) for reference checking?') }}</strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <select class="experience-select" name="objections">
                                                <option value="I disagree that you contact my employer." {{ old('objections') == 'I disagree that you contact my employer.' ? 'selected' : '' }}>
                                                    I disagree that you contact my employer.
                                                </option>

                                                <option value="I agree that you contact my employer." 
                                                {{ old('objections') == 'I agree that you contact my employer.' ? 'selected' : '' }}>
                                                    I agree that you contact my employer.
                                                </option>
                                            </select>
                                        </div>
                                        @error('objections')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12"></div>



                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label>

                                            <strong> {{ __('fl.Mention your last 3 employers') }} </strong>
                                        </label>
                                    </div>

                                    {{-- first row --}}
                                    <div class="div-name text-center">
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mobile-personal-label text-center" style="display: none;">
                                                {{ __('fl.First Employer Record') }}
                                            </label>
                                            <label class="label3"><strong>{{ __('fl.Employers') }}</strong></label>
                                            <label class="mbl-label">Employer</label>
                                            <input type="text" name="employer_1"   value="{{ old('employer_1') }}">
                                            @error('employer_1')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="label3"><strong>{{ __('fl.Department') }}</strong></label>
                                            <label class="mbl-label">Department</label>
                                            <input type="text" name="department_1"   value="{{ old('department_1') }}">
                                            @error('department_1')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="label3"><strong>{{ __('fl.Designation') }}</strong></label>
                                            <label class="mbl-label">Designation</label>
                                            <input type="text" name="designation_1"   
                                            value="{{ old('designation_1') }}">
                                            @error('designation_1')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label
                                                class="label3"><strong>{{ __('fl.In line Manager') }}</strong></label>
                                            <label class="mbl-label">In Line Manager</label>
                                            <input type="text" name="in_line_manager_1"  
                                            value="{{ old('in_line_manager_1') }}">
                                            @error('in_line_manager_1')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label
                                                class="label3"><strong>{{ __('fl.Service Duration') }}</strong></label>
                                            <label class="mbl-label">Service Duration</label>
                                            <input type="text" name="service_duration_1" 
                                                 value="{{ old('service_duration_1') }}">
                                            @error('service_duration_1')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="label3"><strong>{{ __('fl.Salary') }} (QAR)</strong></label>
                                            <label class="mbl-label">Salary</label>
                                            <input type="text" name="salary_1"  
                                            value="{{ old('salary_1') }}">
                                            @error('salary_1')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> {{-- first row ends here --}}


                                    {{-- second row --}}
                                    <div class="div-name text-center">
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label
                                                class="badge-font badge bg-light-danger text-danger mobile-personal-label text-center"
                                                style="display: none;">
                                                {{ __('fl.Second Employer Record') }}
                                            </label>
                                            <label class="mbl-label">Employer</label>
                                            <input type="text" name="employer_2"   
                                            value="{{ old('employer_2') }}">
                                            @error('employer_2')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Department</label>
                                            <input type="text" name="department_2"  
                                            value="{{ old('department_2') }}">
                                            @error('department_2')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Designation</label>
                                            <input type="text" name="designation_2"  
                                            value="{{ old('designation_2') }}">
                                            @error('designation_2')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mbl-label">In Line Manager</label>
                                            <input type="text" name="in_line_manager_2"  
                                            value="{{ old('in_line_manager_2') }}">
                                            @error('in_line_manager_2')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Service Duration</label>
                                        <input type="text" name="service_duration_2" 
                                                 value="{{ old('service_duration_2') }}">
                                            @error('service_duration_2')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Salary</label>
                                        <input type="text" name="salary_2"  value="{{ old('salary_2') }}">
                                            @error('salary_2')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> {{-- second row ends here --}}


                                    {{-- third row --}}
                                    <div class="div-name text-center">
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mobile-personal-label text-center" style="display: none;">
                                                {{ __('fl.Third Employer Record') }}
                                            </label>
                                            <label class="mbl-label">Employer</label>
                                            <input type="text" name="employer_3"   value="{{ old('employer_3') }}">
                                            @error('employer_3')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Department</label>
                                            <input type="text" name="department_3"   value="{{ old('department_3') }}">
                                            @error('department_3')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Designation</label>
                                        <input type="text" name="designation_3"   value="{{ old('designation_3') }}">
                                            @error('designation_3')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <label class="mbl-label">In Line Manager</label>
                                        <input type="text" name="in_line_manager_3"   value="{{ old('in_line_manager_3') }}">
                                            @error('in_line_manager_3')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Service Duration</label>
                                        <input type="text" name="service_duration_3"   value="{{ old('service_duration_3') }}">
                                            @error('service_duration_3')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Salary</label>
                                            <input type="text" name="salary_3"  value="{{ old('salary_3') }}">
                                            @error('salary_3')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> {{-- third row ends here --}}



                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label>

                                            <strong>
                                        {{ __('fl.Please list down at least three (3) personal references:') }}
                                            </strong>
                                        </label>
                                    </div>

                                    {{-- first row --}}
                                    <div class="div-name">
                                        <label class="mobile-personal-label text-center" style="display: none;">
                                            {{ __('fl.First Personal Reference') }}
                                        </label>
                                        <div class="text-center emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="label3"><strong>{{ __('fl.Name') }}</strong></label>

                                            <label class="mbl-label">Reference Name</label>
                                            <input type="text" name="references_name_1"  value="{{ old('references_name_1') }}">
                                            @error('references_name_1')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="text-center emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="label3"><strong>{{ __('fl.Contact No') }}</strong></label>
                                            <label class="mbl-label">Contact No</label>
                                            <input type="text" name="references_contact_1" 
                                                 value="{{ old('references_contact_1') }}">
                                            @error('references_contact_1')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="text-center emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="label3"><strong>{{ __('fl.Email') }}</strong></label>
                                            
                                            <label class="mbl-label">Email</label>
                                            <input type="text" name="references_email_1"  value="{{ old('references_email_1') }}">
                                            @error('references_email_1')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="text-center emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="label3">
                                                <strong>{{ __('fl.Relationship') }}</strong>
                                            </label>

                                            <label class="mbl-label">Relationship</label>
                                            <input type="text" name="references_relationship_1"
                                                 value="{{ old('references_relationship_1') }}">
                                            @error('references_relationship_1')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> {{-- first row ends here --}}


                                    {{-- second row --}}
                                    <div class="div-name text-center">
                                        <label class="mobile-personal-label text-center" style="display: none;">
                                            {{ __('fl.Second Personal Reference') }}
                                        </label>
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Reference Name</label><input type="text" name="references_name_2"   value="{{ old('references_name_2') }}">
                                            @error('references_name_2')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Contact No</label><input type="text" name="references_contact_2" 
                                                 value="{{ old('references_contact_2') }}">
                                            @error('references_contact_2')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Email</label><input type="text" name="references_email_2"   value="{{ old('references_email_2') }}">
                                            @error('references_email_2')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Relationship</label><input type="text" name="references_relationship_2"
                                                  value="{{ old('references_relationship_2') }}">
                                            @error('references_relationship_2')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> {{-- second row ends here --}}


                                    {{-- third row --}}
                                    <div class="div-name text-center">
                                        <label class="mobile-personal-label text-center" style="display: none;">
                                            {{ __('fl.Third Personal Reference') }}
                                        </label>
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Reference Name</label><input type="text" name="references_name_3"  value="{{ old('references_name_3') }}">
                                            @error('references_name_3')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Contact No</label><input type="text" name="references_contact_3" 
                                                 value="{{ old('references_contact_3') }}">
                                            @error('references_contact_3')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Email</label><input type="text" name="references_email_3"   value="{{ old('references_email_3') }}">
                                            @error('references_email_3')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Relationship</label><input type="text" name="references_relationship_3"
                                                  value="{{ old('references_relationship_3') }}">
                                            @error('references_relationship_3')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> {{-- third row ends here --}}

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label>

                                            <strong>{{ __('fl.Kindly note that you are obliged to provide us with the following documents in case you are nominated or selected for the job you are applying for:') }}
                                            </strong>
                                        </label>
                                        <ol class="docs-ol ml-4">
                                            <li>
                                                {{ __('fl.last 3 months earned salary proof, (i.e. payslip, bank statement etc.)') }}
                                            </li>
                                            <li>{{ __('fl.Working experience certificates.') }}</li>
                                            <li>{{ __('fl.Attested copy of educational certificates.') }}</li>
                                            <li>
                                                {{ __('fl.If you are Terminated from Job termination letter Copy to be submitted') }}
                                            </li>
                                        </ol>
                                        @error('joining_date')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label><strong>{{ __('fl.Upload Updated Resume') }}</strong> </label>
                                        <input type="file" name="updated_resume" id="updated_resume" style="display: block" required>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label><strong>{{ __('fl.Upload Certificates') }}</strong></label>
                                        <input type="file" name="certficates" id="certficates" style="display: block" required>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label><strong>{{ __('fl.Upload Others') }}</strong></label>
                                        <input type="file" name="other_doc" id="other_doc" style="display: block">
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <span>
                                            <input type="checkbox"  required style="zoom: 2; position: absolute; ">
                                            <span style="font-size: 18px; margin-left: 30px">
                                                {{ __('fl.I hereby certify that all the submitted information and documents are true.') }}
                                            </span>
                                        </span>
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

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" class="theme-btn btn-style-one">
                                            <span class="txt">{{ __('fl.Submit') }}</span>
                                            <span class="icon flaticon-share-option"></span>
                                        </button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--End About Section-->


@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $("#dob").flatpickr({
            dateFormat: "Y-m-d",
        });
    </script>
@endsection
