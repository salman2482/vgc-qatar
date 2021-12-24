@extends('front-end.layouts.master')
@section('styles')
    {!! NoCaptcha::renderJs() !!}
@endsection

@section('front-end-content')
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
                    </div>
                    <div class="contact-form">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                                <strong>{{ session()->get('success') }}</strong>
                            </div>
                        @endif
                        <form action="{{ route('front.legalRegistration.mail') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="vendor_company_name" value="{{ old('vendor_company_name') }}"
                                            placeholder="COMPANY NAME" required>
    
                                        @error('vendor_company_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <select name="title">
                                            <option value="Mr">Mr</option>
                                            <option value="Madam">Madam</option>
                                            <option value="Ms">Ms</option>
                                            <option value="Dr">Dr</option>
                                            <option value="Engr">Engr</option>
                                        </select>
    
                                        @error('title')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="first_name" required placeholder="FIRST NAME">
                                        @error('first_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="last_name" required placeholder="LAST NAME">
                                        @error('last_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="position" required placeholder="POSITION">
                                        @error('position')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="email" id="email" name="email" placeholder="example@example.com">
                                        @error('email')
                                            <div class="error" id="email_error">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="phone" placeholder="MOBILE NUMBER">
                                        @error('phone')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="commercial_registration_no"
                                            placeholder="COMMERCIAL REGISTRATION NO" required>
                                        @error('commercial_registration_no')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="purpose" placeholder="PURPOSE OF REGISTRATION">
                                        @error('purpose')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="office_telephone_no" placeholder="OFFICE TELEPHONE NUMBER">
                                        @error('office_telephone_no')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" required name="address" placeholder="ADDRESS">
                                        @error('address')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="po_box" placeholder="PO-BOX">
                                        @error('po_box')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
    
                                </div>
                                
                                <div class="col-md-12 mt-3">
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
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--End About Section-->
@endsection
