@extends('front-end.layouts.master')
@section('styles')
{!! NoCaptcha::renderJs() !!}
@endsection

@section('front-end-content')
    <section class="register-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Form Column-->
                <div class="form-column column col-lg-6 col-md-12 col-sm-12 offset-lg-3">

                    <div class="sec-title">
                        <h2>Register Here</h2>
                    </div>

                    <!--Login Form-->
                    <div class="styled-form register-form">
                        <form action="{{ route('front.user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-user"></span></span>
                                <input type="text" name="first_name" placeholder="First Name" required
                                    value="{{ old('first_name') }}">
                                @error('first_name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-user"></span></span>
                                <input type="text" name="last_name" placeholder="Last Name"
                                    value="{{ old('last_name') }}">
                                @error('last_name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                                <input type="email" name="email" id="email" autocomplete="false" readonly
                                    onfocus="this.removeAttribute('readonly')" placeholder="Enter Email" required
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                                <div class="error text-danger" id="email_error"></div>
                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="password" placeholder="**********">
                                @error('password')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="password_confirmation" placeholder="**********">
                                @error('password_confirmation')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-user-secret"></span></span>
                                <input type="text" name="company_name" placeholder="Company Name"
                                    value="{{ old('company_name') }}">
                                @error('company_name')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-file"></span></span>
                                <input type="text" name="company_license_number" placeholder="Company License Number"
                                    value="{{ old('company_license_number') }}">
                                @error('company_license_number')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-phone"></span></span>
                                <input type="text" name="mobile_number" placeholder="Mobile Number"
                                    value="{{ old('mobile_number') }}">
                                @error('mobile_number')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-adjust"></span></span>
                                <input type="text" name="address" placeholder="Address" value="{{ old('address') }}">
                                @error('address')
                                    <div class="error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">

                                @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong class="text-danger">
                                        {{ $errors->first('g-recaptcha-response') }}
                                    </strong>
                                </span>
                                @endif
                                {!! app('captcha')->display() !!}
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="conditions">
                                        <input type="checkbox" required class="form-contorl mt-1" id="conditions" value="0" style="zoom: 1.4; margin-left: -10px !important;">
                                        <span class="ml-1" style="font-size: 15px;font-weight:bold">  
                                        I agree service terms and condition 
                                        <a href="#" data-toggle="modal" data-target="#exampleModalLong">Read Here</a> </span>
                                    </label>
                                </div>
                                <div id=msg_terms name=msg_terms>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="form-group pull-left">
                                    <button type="submit" class="theme-btn btn-style-one"><span class="txt">Register
                                            here</span></button>
                                </div>
                                <div class="form-group submit-text pull-right">
                                    * You must be a free registered to submit content.
                                </div>
                                
                            </div>
                            
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>

        <?php $rec = \App\Models\FrontBanner::where('id', 65)->first(); ?>
@isset($rec)

    <div class="modal" id="exampleModalLong" tabindex="-1" role="dialog">
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

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#email').blur(function() {
                $('#email_error').text('');

                var final = $('#email').val();

                //
                $.ajax({
                    url: "{{ url('checkemail') }}",
                    type: 'GET',
                    data: {
                        id: final
                    },
                    success: function(response) {
                        console.log(response);
                        $('#email_error').text(response);
                        if (response == true) {
                            $('#email_error').text('The Email is already taken');
                            $(':input[type="submit"]').prop('disabled', true);
                        } else {
                            $('#email_error').text('');
                        }
                    }
                });
            });
        });
        
        $(document).ready(function() {
        $("#property-use-terms").click(function(e) {
            e.preventDefault();
            $('#exampleModalLong').modal('show');
        });
        });
    </script>
@endsection
