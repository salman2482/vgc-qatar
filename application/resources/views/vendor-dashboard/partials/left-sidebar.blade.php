<aside class="left-sidebar">

    <style>
        .sidebar-link.has-arrow.waves-effect.waves-dark.active{
        background-color: #3AB276 !important;
    }
    .sidebar-link.waves-effect.waves-dark.active{
        background-color: #3AB276 !important;
    }
    
    </style>
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile position-relative"
            style="background: url({{ asset('public/fv/assets/images/background/user-info.jpg') }}) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{ asset('storage/avatars/system/user-avatar.png') }}" alt="user"
                    class="w-100" /> </div>
            <!-- User profile text-->
            <div class="profile-text pt-1 dropdown">
                <a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative"
                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                {{str_limit(Auth::user()->first_name.' '.Auth::user()->last_name, 22)}}
            </a>
                <div class="dropdown-menu animated flipInY" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('front.vendor.profile')}}"><i data-feather="user" class="feather-sm text-info me-1 ms-1"></i>
                        My Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('front.vendor.logout')}}"><i data-feather="log-out"
                            class="feather-sm text-danger me-1 ms-1"></i> Logout</a>
                    <div class="dropdown-divider"></div>
                    
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <!-- <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Personal</span> -->
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark
                    {{ Request::path() == 'vendor-dashboard' ? 'active' : '' }}"
                        href="{{ route('front.vendor.index') }}" aria-expanded="false">
                        <i class="mdi mdi-gauge"></i>
                        <span class="hide-menu">Dashboard </span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark
                    <?php if (in_array('mainmenu_user', $payload)) {
                        echo $payload['mainmenu_user'];
                    } ?>"
                    href="javascript:void(0)" aria-expanded="false">
                    <i class="mdi mdi-alert-box"></i>
                    <span class="hide-menu">RFQ</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('front.vendorVgc.index') }}" class="sidebar-link">
                                <i class="mdi mdi-credit-card-scan"></i>
                                <span class="hide-menu">RFQ's List</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-item">
                            <a href="{{ route('front.vendorVgc.create') }}" class="sidebar-link"><i
                                    class="mdi mdi-credit-card-plus"></i><span class="hide-menu">Add New VGC</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark
                    <?php if (in_array('mainmenu_user', $payload)) {
                        echo $payload['mainmenu_user'];
                    } ?> "
                    href="javascript:void(0)" aria-expanded="false">
                    <i class="mdi mdi-alert-box"></i>
                    <span class="hide-menu">Quotations</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('front.vendorQuotation.create') }}" class="sidebar-link"><i
                                class="mdi mdi-credit-card-plus"></i><span class="hide-menu">Submit Quotation</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ route('front.vendorQuotation.index') }}" class="sidebar-link"><i
                                class="mdi mdi-credit-card-scan"></i><span class="hide-menu">Quotations List </span>
                            </a>
                        </li>
                        
                    </ul>
                </li>


                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark
                    <?php if (in_array('mainmenu_user', $payload)) {
                        echo $payload['mainmenu_user'];
                    } ?>"
                    href="javascript:void(0)" aria-expanded="false">
                    <i class="mdi mdi-alert-box"></i>
                    <span class="hide-menu">PO</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('front.vendorPo.index') }}" class="sidebar-link">
                                <i class="mdi mdi-credit-card-scan"></i>
                                <span class="hide-menu">PO's List</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-item">
                            <a href="{{ route('front.vendorPo.create') }}" class="sidebar-link"><i
                                    class="mdi mdi-credit-card-plus"></i><span class="hide-menu">Add New PO</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark
                    <?php if (in_array('mainmenu_user', $payload)) {
                        echo $payload['mainmenu_user'];
                    } ?> "
                    href="javascript:void(0)" aria-expanded="false">
                    <i class="mdi mdi-alert-box"></i>
                    <span class="hide-menu">Invoices</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        
                        <li class="sidebar-item">
                            <a href="{{ route('front.vendorInvoice.create') }}" class="sidebar-link"><i
                                    class="mdi mdi-credit-card-plus"></i><span class="hide-menu">Submit  Invoice</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item">
                            <a href="{{ route('front.vendorInvoice.index') }}" class="sidebar-link"><i
                                    class="mdi mdi-credit-card-scan"></i><span class="hide-menu">Invoices List</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>


                <li class="sidebar-item">
                    <a class="sidebar-link  waves-effect waves-dark
                    <?php if (in_array('mainmenu_user', $payload)) {
                        echo $payload['mainmenu_user'];
                    } ?>"
                    href="{{route('front.vendor.help')}}" aria-expanded="false">
                    <i class="mdi mdi-help"></i>
                    <span class="hide-menu">Help</span>
                    </a>
                   
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    
</aside>
