<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    @include('vendor-dashboard.partials.head')
</head>

<body>

    <div id="main-wrapper">

        @include('vendor-dashboard.partials.top-header')

        @include('vendor-dashboard.partials.left-sidebar')

        @yield('content')

    </div>

    @include('vendor-dashboard.partials.scripts')
</body>

</html>
