<header class="topbar" style="background-color:  #3AB276 !important;">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark" style="background-color:  #3AB276 !important;">
        <div class="navbar-header" style="background-color: white ; height: 70px !important;">
            <style>
                @media screen and (max-width: 600px) {
                .navbar-header {
                background-color: white !important;
                }
            }

            </style>
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" style="background-color: #3AB276 !important;" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
                </a>
                
            <a class="navbar-brand" href="{{route('front.vendor.index')}}">
                <!-- Logo icon -->
                <b class="logo-icon">
                    
                    <!--desktop  Dark Logo icon -->
                    <img src="{{ asset('storage/logos/app/logo.png') }}" height="70px;" alt="homepage" class=" dark-logo" />
                    
                    
                    <!-- mobile version Light Logo icon -->
                    <img src="{{ asset('storage/logos/app/logo.png') }}" height="70px;" alt="homepage" class="p-3 light-logo" />
                </b>

                <!-- Logo text -->
                <span class="logo-text">
                    {{-- <img src="{{ asset('public/fv/assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" /> --}}
                </span>
            </a>
            <!-- Toggle which is visible on mobile only -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                {{-- <i class="ti-more"></i> --}}
            </a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent" style="background-color:  #3AB276 !important;">
            <ul class="navbar-nav me-auto">
                <!-- This is  -->
                <li class="nav-item"> <a
                        class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark"
                        href="javascript:void(0)"><i class="ti-menu"></i></a>
                </li>

            </ul>
            
            <ul class="navbar-nav">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('public/fv/assets/images/users/1.jpg') }}" alt="user" width="30" class="profile-pic rounded-circle" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                        <div class="d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                            <div class=""><img src="{{ asset('public/fv/assets/images/users/1.jpg') }}" alt="user" class="rounded-circle" width="60"></div>
                            <div class="ms-2">
                                <h4 class="mb-0 text-white">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</h4>
                                <p class=" mb-0">{{Auth::user()->email}}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{route('front.vendor.profile')}}"><i data-feather="user" class="feather-sm text-info me-1 ms-1"></i> My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('front.vendor.logout')}}"><i data-feather="log-out"
                                class="feather-sm text-danger me-1 ms-1"></i> Logout</a>
                        <div class="dropdown-divider"></div>
                       
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== -->
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                            class="flag-icon flag-icon-us"></i></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"> <a
                            class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a
                            class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a
                            class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a
                            class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a>
                    </div>
                </li> --}}
            </ul>
        </div>
    </nav>
</header>
