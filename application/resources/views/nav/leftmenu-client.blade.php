<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" id="js-trigger-nav-client">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <!--home-->
                <li class="sidenav-menu-item {{ $page['mainmenu_home'] ?? '' }} menu-tooltip menu-with-tooltip"
                title="{{ cleanLang(__('lang.home')) }}">
                    <a class="waves-effect waves-dark" href="/home" aria-expanded="false" target="_self">
                        <i class="ti-home"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.dashboard')) }}
                        </span>
                    </a>
                </li>
                <!--home-->


                <!--projects-->
                <li class="sidenav-menu-item {{ $page['mainmenu_projects'] ?? '' }} menu-tooltip menu-with-tooltip"
                title="{{ cleanLang(__('lang.projects')) }}">
                    <a class="waves-effect waves-dark" href="/projects" aria-expanded="false" target="_self">
                        <i class="ti-folder"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.projects')) }}
                        </span>
                    </a>
                </li>
                <!--projects-->
            {{-- quotations --}}
                <li class="sidenav-menu-item {{ $page['mainmenu_quotations'] ?? '' }} menu-tooltip menu-with-tooltip"
                title="{{ cleanLang(__('lang.quotations')) }}">
                <a class="waves-effect waves-dark" href="/quotations" aria-expanded="false" target="_self">
                    <i class="ti-folder"></i>
                    <span class="hide-menu">{{ cleanLang(__('Quotations')) }}
                    </span>
                </a>

                <!--invoices-->
                @if(auth()->user()->is_client_owner)
                <li class="sidenav-menu-item {{ $page['mainmenu_invoices'] ?? '' }} menu-tooltip menu-with-tooltip"
                title="{{ cleanLang(__('lang.invoices')) }}">
                    <a class="waves-effect waves-dark" href="/invoices" aria-expanded="false" target="_self">
                        <i class="ti-receipt"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.invoices')) }}
                        </span>
                    </a>
                </li>
                @endif
                <!--invoices-->

                <!--payments-->
                @if(auth()->user()->is_client_owner)
                <li class="sidenav-menu-item {{ $page['mainmenu_payments'] ?? '' }} menu-tooltip menu-with-tooltip"
                title="{{ cleanLang(__('lang.payments')) }}">
                    <a class="waves-effect waves-dark" href="/payments" aria-expanded="false" target="_self">
                        <i class="sl-icon-credit-card"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.payments')) }}
                        </span>
                    </a>
                </li>
                @endif
                <!--payments-->
             {{-- client rfm --}}
              @if (auth()->user()->is_employee != 1)
                    <li class="sidenav-menu-item  {{ $page['mainmenu_RFM'] ?? '' }}">
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                            <i class="ti-user"></i>
                            <span class="hide-menu">{{ cleanLang(__('RFM / PO')) }}
                            </span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            @if (auth()->user()->is_client)
                                <li class="sidenav-submenu" id="submenu_rfms"
                                    title="{{ cleanLang(__('lang.rfms')) }}">
                                    <a class="{{ $page['submenu_rfms'] ?? '' }}" href="/rfms" aria-expanded="false"
                                        target="_self">
                                        RFM
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!--users-->
                @if(auth()->user()->is_client_owner)
                <li class="sidenav-menu-item {{ $page['mainmenu_contacts'] ?? '' }} menu-tooltip menu-with-tooltip"
                title="{{ cleanLang(__('lang.users')) }}">
                    <a class="waves-effect waves-dark" href="/users" aria-expanded="false" target="_self">
                        <i class="sl-icon-people"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.users')) }}
                        </span>
                    </a>
                </li>
                @endif
                <!--users-->

                <!--tickets-->
                <li class="sidenav-menu-item {{ $page['mainmenu_tickets'] ?? '' }} menu-tooltip menu-with-tooltip"
                title="{{ cleanLang(__('lang.support_tickets')) }}">
                    <a class="waves-effect waves-dark" href="/tickets" aria-expanded="false" target="_self">
                        <i class="ti-comments"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.support')) }}
                        </span>
                    </a>
                </li>
                <!--tickets-->

                <!--knowledgebase-->
                <li class="sidenav-menu-item {{ $page['mainmenu_kb'] ?? '' }} menu-tooltip menu-with-tooltip"
                title="{{ cleanLang(__('lang.knowledgebase')) }}">
                    <a class="waves-effect waves-dark p-r-20" href="/knowledgebase" aria-expanded="false" target="_self"
                        >
                        <i class="sl-icon-docs"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.knowledgebase')) }}
                        </span>
                    </a>
                </li>
                <!--knowledgebase-->

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>