<div class="header-top">
    <div class="auto-container">
        <div class="clearfix">
            <!--Top Left-->
            <div class="top-left">
               <div class="text">{{__('fl.WELCOME TO VETERAN GENERAL CONTRACTING')}}</div>
            </div>
            <!--Top Right-->
            <div class="top-right">
                <!--Social Box-->
                <ul class="social-box">
                    <li><a href="#"><span style="font-size: 20px" class="fa fa-facebook"></span></a></li>
                    <li><a href="#"><span style="font-size: 20px" class="fa fa-twitter"></span></a></li>
                    <li><a href="#"><span style="font-size: 20px" class="fa fa-instagram"></span></a></li>
                    <li><a href="#"><span style="font-size: 20px" class="fa fa-youtube-play"></span></a></li>
                    <li><a href="#"><span style="font-size: 20px" class="fa fa-linkedin"></span></a></li>
                </ul>
                <!--Language-->
                {{-- <div class="language dropdown">
                    <a href="#" class="btn btn-default dropdown-toggle text-veteran" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="javaScript:void"
                        style="height: 43px;">
                        <span class="flag-icon">
                        </span>
                        @if (App::getLocale() == 'english')
                            English
                        @else
                            عربي
                        @endif
                        <span class="icon fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu style-one" aria-labelledby="dropdownMenu2">
                        <li><a href="{{ url('/language/english') }}">English</a></li>
                        <li><a href="{{ url('/language/ar') }}">عربي</a></li>
                    </ul>
                </div>
                 --}}
            </div>
        </div>
    </div>
</div>

<!--Header-Upper-->
<div class="header-upper">
    <div class="auto-container">
        <div class="clearfix">

            <div class="pull-left logo-box">
                <div class="logo">
                    <a href="{{ route('front.index') }}">
                        <img src="{{ asset('public/front-end/images/logo-y.png') }}" width="300px" style="margin-top: -17px" alt="logo">
                    </a>
                </div>
            </div>

            <div class="pull-right upper-right clearfix">

                <div class="upper-column info-box">
                    <div class="icon-box"><span class="flaticon-pin"></span></div>
                    <ul>
                        <li>{{__('fl.Location')}} <br> <a class="text-dark" href="https://www.google.com/maps/@25.250661,51.563096,16z?hl=en-GB">{{__('fl.Doha')}} {{__('fl.Qatar')}} </a></li>
                    </ul>
                </div>
                
                <!--Info Box-->
                <div class="upper-column info-box">
                    <div class="icon-box"><span class="flaticon-technology-1"></span></div>
                    <ul>
                        <li>{{__('fl.Call US')}}: <br> <a class="text-dark" href="tel:+974 44441061">+974 44441061</a></li>
                    </ul>
                </div>
                {{-- whatsapp --}}
                <div class="upper-column info-box">
                    <div class="icon-box"><span class="fa fa-whatsapp"></span></div>
                    <ul>
                        <li>WhatsApp: <br> 
                            <a class="text-dark" href="https://wa.me/97474441060">+97474441060</a></li>
                    </ul>
                </div>
                
                <!--Info Box-->
                <div class="upper-column info-box">
                    <div class="icon-box"><span class="flaticon-web"></span></div>
                    <ul>
                        <a class="text-dark" href="{{route('front.contact-us')}}">
                            <li class="mt-2">{{__('fl.Contact us')}}: <br> 
                                <a class="text-dark" href="{{route('front.contact-us')}}"></a>
                            </li>
                        </a>
                    </ul>
                </div>

            </div>

        </div>
    </div>
</div>
