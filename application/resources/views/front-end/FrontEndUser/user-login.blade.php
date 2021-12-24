@extends('front-end.layouts.master')


@section('front-end-content')
@if ($attachment->attachment_unique_input === 'frontbanner')
        <img class="img-fluid" src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" style="height: " alt="">
    @endif
    <section class="register-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Form Column-->
                <div class="form-column column col-lg-6 offset-lg-3 col-md-12 col-sm-12 shadow p-3 mb-5 bg-white rounded">

                    <div class="sec-title">
                        <div class="sec-title">
                            @if(App::isLocale('ar'))
                            <h2>{{ $loginTitle ?? '' }} {!! ($banner->title_ar) !!}</h2>
                            @else
                            <h2>{{ $loginTitle ?? '' }} {!! ($banner->title) !!}</h2>
                            @endif
                        </div>
                        @if ($message = Session::get('message'))
                            <p class="text-center alert alert-warning">{{ $message }}</p>
                        @endif

                        <div class="text">
                            @if(App::isLocale('ar'))
                            <p>{!! ($banner->description_ar) !!}</p>
                            @else
                            <p>{!! ($banner->description) !!}</p>
                            @endif
                        </div>
                        
                    </div>

                    <!--Login Form-->
                    <div class="styled-form login-form">
                        <form method="post" action="{{ route('front.user.loggedin') }}">
                            @csrf
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                                <input type="email" name="email" value="" placeholder="Emai Address*" required>
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="password" value="" placeholder="Enter Password" required>
                            </div>
                            <div class="clearfix">
                                <div class="form-group pull-left">
                                    <button type="submit" class="theme-btn btn-style-one"><span class="txt">
                                        Login Now</span></button>
                                </div>

                            </div>

                            <div class="clearfix">
                                <div class="pull-left">
                                    <input type="checkbox" id="remember-me" name="remember_me"><label class="remember-me"
                                        for="remember-me">&nbsp; Remember Me</label>
                                </div>
                            </div>
                            @if($loginTitle != 'Employee' && $loginTitle != 'Client' )
                            <p>Dont have account ? Please <a href="{{ route('front.user.register') }}">Regsiter here</a>
                            </p>
                            @endif

                        </form>
                    </div>

                </div>


            </div>
        </div>
    </section>
@endsection
