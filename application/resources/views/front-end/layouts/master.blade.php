<!DOCTYPE html>
<html>

<head>
    @include('front-end.partials.styles')
    @yield('styles')

</head>

<body class="hidden-bar-wrapper">
    <div class="page-wrapper">


        <header class="main-header header-style-two">

            @include('front-end.partials.headers')

            
            @include('front-end.partials.navbar.desktop-nav')

        
            @include('front-end.partials.navbar.sticky-nav')

        </header>


        @yield('front-end-content')


        @include('cookieConsent::index')
        @include('front-end.partials.footer')

    </div>
    <!--End pagewrapper-->

    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>

    <!-- Color Palate / Color Switcher -->
    {{-- @include('front-end.partials.colors') --}}

    @include('front-end.partials.scripts')
    @yield('scripts')
</body>

</html>
