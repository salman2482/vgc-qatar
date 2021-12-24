f<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" id="js-trigger-nav-team">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" id="main-scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" id="main-sidenav">
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


                <!--users-->
                @if (auth()->user()->role->role_clients >= 1 || auth()->user()->role->role_contacts >= 1)
                    <li class="sidenav-menu-item {{ $page['mainmenu_customers'] ?? '' }}">
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                            <i class="sl-icon-people"></i>
                            <span class="hide-menu">{{ cleanLang(__('lang.customers')) }}
                            </span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            @if (auth()->user()->role->role_clients >= 1)
                                <li class="sidenav-submenu {{ $page['submenu_customers'] ?? '' }}"
                                    id="submenu_clients">
                                    <a href="/clients"
                                        class="{{ $page['submenu_customers'] ?? '' }}">{{ cleanLang(__('lang.clients')) }}</a>
                                </li>
                            @endif
                            @if (auth()->user()->role->role_contacts >= 1)
                                <li class="sidenav-submenu {{ $page['submenu_contacts'] ?? '' }}"
                                    id="submenu_contacts">
                                    <a href="/users"
                                        class="{{ $page['submenu_contacts'] ?? '' }}">{{ cleanLang(__('lang.client_users')) }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                <!--users-->


                <!--trustech code starts here for front end management-->
                @if (auth()->user()->role->role_vendorrfq >= 1 || auth()->user()->is_admin)
                    <li class="sidenav-menu-item {{ $page['mainmenu_vendors'] ?? '' }}">
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                            <i class="ti-wallet"></i>
                            <span class="hide-menu">{{ cleanLang(__('lang.vendors')) }}
                            </span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            @if (auth()->user()->role->role_vendorrfq >= 1 || auth()->user()->is_admin)
                                <li class="sidenav-submenu {{ $page['submenu_vusers'] ?? '' }}" id="submenu_vusers">
                                    <a href="/vusers"
                                        class=" {{ $page['submenu_vusers'] ?? '' }}">{{ cleanLang(__('Vendors List')) }}</a>
                                </li>
                            @endif

                            @if (auth()->user()->role->role_vendorrfq >= 1 || auth()->user()->is_admin)
                                <li class="sidenav-submenu {{ $page['submenu_vendorrfqs'] ?? '' }}"
                                    id="submenu_vendorrfqs">
                                    <a href="/vendorrfqs"
                                        class=" {{ $page['submenu_vendorrfqs'] ?? '' }}">{{ cleanLang(__('RFQ')) }}</a>
                                </li>
                            @endif

                            @if (auth()->user()->role->role_vendorqtn >= 1 || auth()->user()->is_admin)
                                <li class="sidenav-submenu {{ $page['submenu_vendorqtns'] ?? '' }}"
                                    id="submenu_vendorqtns">
                                    <a href="/vendorqtns"
                                        class=" {{ $page['submenu_vendorqtns'] ?? '' }}">{{ cleanLang(__('QTNs')) }}</a>
                                </li>
                            @endif
                            @if (auth()->user()->role->role_vendorpo >= 1 || auth()->user()->is_admin)
                                <li class="sidenav-submenu {{ $page['submenu_vendorpos'] ?? '' }}"
                                    id="submenu_vendorpos">
                                    <a href="/vendorpos"
                                        class=" {{ $page['submenu_vendorpos'] ?? '' }}">{{ cleanLang(__('POs')) }}</a>
                                </li>
                            @endif
                            @if (auth()->user()->role->role_vendorinvoice >= 1 || auth()->user()->is_admin)
                                <li class="sidenav-submenu {{ $page['submenu_vendorinvoices'] ?? '' }}"
                                    id="submenu_vendorinvoices">
                                    <a href="/vendorinvoices"
                                        class=" {{ $page['submenu_vendorinvoices'] ?? '' }}">{{ cleanLang(__('INVOICES')) }}</a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
                <!--trustech code ends here for front end management-->

                <!--projects-->
                <!--front project and client-->
                @if(auth()->user()->role->role_project_client >= 1 || auth()->user()->is_admin)
                   <li class="sidenav-menu-item {{ $page['mainmenu_fronts'] ?? '' }}">
                      <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                          <i class="ti-image"></i>
                          <span class="hide-menu">{{ cleanLang(__('Front View')) }}
                          </span>
                      </a>
                      <ul aria-expanded="false" class="collapse">
                          <li class="sidenav-submenu {{ $page['submenu_fproducts'] ?? '' }}" id="submenu_fproducts">
                              <a href="/fproducts"
                                  class=" {{ $page['submenu_fproducts'] ?? '' }}">{{ cleanLang(__('Products')) }}</a>
                          </li>

                          <li class="sidenav-submenu {{ $page['submenu_fprojects'] ?? '' }}" id="submenu_fprojects">
                              <a href="/frontprojects"
                                  class=" {{ $page['submenu_fprojects'] ?? '' }}">{{ cleanLang(__('Project')) }}</a>
                          </li>

                          <li class="sidenav-submenu {{ $page['submenu_clients'] ?? '' }}" id="submenu_clients">
                              <a href="/frontclients"
                                  class=" {{ $page['submenu_clients'] ?? '' }}">{{ cleanLang(__('Clients')) }}</a>
                          </li>
                          
                          <li class="sidenav-submenu {{ $page['submenu_banners'] ?? '' }}" id="submenu_banners">
                              <a href="/frontbanners"
                                  class=" {{ $page['submenu_banners'] ?? '' }}">{{ cleanLang(__('Banners')) }}</a>
                          </li>
                          
                        </ul>
                    </li>
                     @endif
                {{-- front careers --}}
                @if(auth()->user()->role->role_project_client >= 1 || auth()->user()->is_admin)
                   <li class="sidenav-menu-item {{ $page['mainmenu_careers'] ?? '' }}">
                      <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                          <i class="ti-briefcase"></i>
                          <span class="hide-menu">{{ cleanLang(__('Careers')) }}
                          </span>
                      </a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="sidenav-submenu {{ $page['submenu_careers'] ?? '' }}" id="submenu_careers">
                                <a href="/frontcareers"
                                    class=" {{ $page['submenu_careers'] ?? '' }}">{{ cleanLang(__('Careers')) }}</a>
                            </li>

                            <li class="sidenav-submenu {{ $page['submenu_careersapply'] ?? '' }}" id="submenu_careersapply">
                                <a href="/careersapply"
                                class=" {{ $page['submenu_careersapply'] ?? '' }}">{{ cleanLang(__('Career Applies List')) }}</a>
                            </li>
                        </ul>
                    </li>
                     @endif
                {{-- front careers --}}

                {{-- front product and sub product --}}
                @if(auth()->user()->role->role_project_client >= 1 || auth()->user()->is_admin)
                   <li class="sidenav-menu-item {{ $page['mainmenu_fproducts'] ?? '' }}">
                      <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                          <i class="ti-shopping-cart-full"></i>
                          <span class="hide-menu">{{ cleanLang(__('F Products')) }}
                          </span>
                      </a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="sidenav-submenu {{ $page['submenu_fproducts'] ?? '' }}" id="submenu_fproducts">
                                <a href="/fproducts"
                                    class=" {{ $page['submenu_fproducts'] ?? '' }}">{{ cleanLang(__('Products')) }}</a>
                            </li>

                            <li class="sidenav-submenu {{ $page['submenu_subproducts'] ?? '' }}" id="submenu_subproducts">
                                <a href="/subproducts" class=" {{ $page['submenu_subproducts'] ?? '' }}">
                                {{ cleanLang(__('Sub Products')) }}</a>
                            </li>
                        </ul>
                    </li>
                     @endif
                {{-- front product and sub product --}}

                <!--properties-->
                @if (auth()->user()->role->role_property >= 1 || auth()->user()->is_admin)
                   <li class="sidenav-menu-item {{ $page['mainmenu_properties'] ?? '' }}">
                      <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                          <i class="ti-home"></i>
                          <span class="hide-menu">{{ cleanLang(__('lang.properties')) }}
                          </span>
                      </a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="sidenav-submenu {{ $page['submenu_properties'] ?? '' }}" id="submenu_properties">
                                <a href="/properties" class=" {{ $page['submenu_properties'] ?? '' }}">
                                    {{ cleanLang(__('All Properties')) }}
                                </a>
                            </li>
                            
                            <li class="sidenav-submenu {{ $page['submenu_frontusers'] ?? '' }}" id="submenu_frontusers">
                                <a href="/frontusers" class=" {{ $page['submenu_frontusers'] ?? '' }}">
                                    {{ cleanLang(__('Users')) }}
                                </a>
                            </li>

                            
                        </ul>
                    </li>
                     @endif
                <!--properties-->

              

                <li class="sidenav-menu-item  {{ $page['mainmenu_RFM'] ?? '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-user"></i>
                        <span class="hide-menu">{{ cleanLang(__('RFM / PO')) }}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        @if (auth()->user()->role->role_rfms >= 1)
                            <li class="sidenav-submenu" id="submenu_rfms" title="{{ cleanLang(__('lang.rfms')) }}">
                                <a class="{{ $page['submenu_rfms'] ?? '' }}" href="/rfms" aria-expanded="false"
                                    target="_self">
                                    RFM
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role->role_lpos >= 1 || auth()->user()->is_admin)
                            <li class="sidenav-submenu" id="submenu_lpos">
                                <a href="/lpos" class="{{ $page['submenu_lpos'] ?? '' }}">
                                    PO
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
                <!--vendors-->

                <!--trustech code starts here for front end management-->
                <li class="sidenav-menu-item  {{ $page['mainmenu_control'] ?? '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="sl-icon-screen-desktop"></i>
                        <span class="hide-menu">
                            DCM
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        @if (auth()->user()->role->role_documents >= 1 || auth()->user()->is_admin)
                            <li class="sidenav-submenu " id="submenu_document">
                                <a href="/documents" class="{{ $page['submenu_documents'] ?? '' }}">
                                    Doc Mgt
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->role->role_contracts >= 1 || auth()->user()->is_admin)
                            <li class="sidenav-submenu " id="submenu_contracts">
                                <a href="/contractsmgt" class="{{ $page['submenu_contracts'] ?? '' }}">
                                    Contract
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->role->role_quotations >= 1 || auth()->user()->is_admin)
                            <li class="sidenav-submenu" id="submenu_quotations">
                                <a href="/quotations" class="{{ $page['submenu_quotations'] ?? '' }}">
                                    Quotation
                                </a>
                            </li>
                        @endif


                        @if (auth()->user()->role->role_govtdocs >= 1 || auth()->user()->is_admin)
                            <li class="sidenav-submenu" id="submenu_govtdocuments">
                                <a href="/govtdocuments" class="{{ $page['submenu_govtdocuments'] ?? '' }}">
                                    Govt Documents
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role->role_employee_legal_documents >= 1 || auth()->user()->is_admin)
                            <li class="sidenav-submenu " id="submenu_employeedocument">
                                <a href="/employeedocument" class="{{ $page['submenu_employeedocument'] ?? '' }}">
                                    Employee Legal Docs
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                {{-- @endif --}}

                
                @if (auth()->user()->role->role_tasks >= 1)
                    <li class="sidenav-menu-item {{ $page['mainmenu_materials'] ?? '' }} menu-tooltip menu-with-tooltip"
                        title="{{ cleanLang(__('Material')) }}">
                        <a class="waves-effect waves-dark" href="/materials" aria-expanded="false" target="_self">
                            <i class="sl-icon-docs"></i>
                            <span class="hide-menu">{{ cleanLang(__('Materials')) }}
                            </span>
                        </a>
                    </li>
                @endif
                <!--tasks-->


                <!--[upcoming]subscriptions-->
                <li class="sidenav-menu-item {{ $page['mainmenu_kb'] ?? '' }} menu-tooltip menu-with-tooltip hidden"
                    title="{{ cleanLang(__('lang.subscriptions')) }}">
                    <a class="waves-effect waves-dark p-r-20" href="/subscriptions" aria-expanded="false"
                        target="_self">
                        <i class="sl-icon-docs"></i>
                        <span class="hide-menu">{{ cleanLang(__('lang.subscriptions')) }}
                        </span>
                    </a>
                </li>

                @if (auth()->user()->isAdmin)
                   <li class="sidenav-menu-item  {{ $page['mainmenu_bookings'] ?? '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-package"></i>
                        <span class="hide-menu">{{ cleanLang(__('Services')) }}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">

                            <li class="sidenav-submenu {{ $page['submenu_services'] ?? '' }}" >
                                <a class="{{ $page['submenu_services'] ?? '' }}" href="/services" aria-expanded="false"
                                    target="_self">
                                  {{ cleanLang(__('All Services')) }}
                                </a>
                            </li>
                            <li class="sidenav-submenu {{ $page['submenu_bookings'] ?? '' }}" >
                                <a class="{{ $page['submenu_bookings'] ?? '' }}" href="/bookings" aria-expanded="false"
                                    target="_self">
                                  {{ cleanLang(__('Bookings')) }}
                                </a>
                            </li>

                            <li class="sidenav-submenu {{ $page['submenu_employees'] ?? '' }}">
                                <a href="/employees" class="{{ $page['submenu_employees'] ?? '' }}">
                                  {{ cleanLang(__('Employee')) }}
                                </a>
                            </li>

                            <li class="sidenav-submenu {{ $page['submenu_corporateservices'] ?? '' }}" id="submenu_corporateservices">
                            <a href="/corporateservices"
                                class=" {{ $page['submenu_corporateservices'] ?? '' }}">{{ cleanLang(__('Corporate Services')) }}</a>
                            </li>
                          
                            <li class="sidenav-submenu {{ $page['submenu_subcorporateservices'] ?? '' }}" id="submenu_subcorporateservices">
                            <a href="/subcorporateservices"
                                class=" {{ $page['submenu_subcorporateservices'] ?? '' }}">{{ cleanLang(__('Sub Corporate Services')) }}</a>
                            </li>

                        </ul>
                    </li>
                @endif

                @if (auth()->user()->isAdmin)
                   <li class="sidenav-menu-item  {{ $page['mainmenu_crms'] ?? '' }}">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-user"></i>
                        <span class="hide-menu">{{ cleanLang(__('CRM')) }}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">

                            <li class="sidenav-submenu {{ $page['submenu_projects'] ?? '' }}"  id="submenu_projects">
                                <a href="/projects" class=" {{ $page['submenu_projects'] ?? '' }}">
                                   {{ cleanLang(__('lang.projects')) }}
                                </a>
                            </li>
                            
                            <li class="sidenav-submenu {{ $page['submenu_tickets'] ?? '' }}"  id="submenu_tickets">
                                <a href="/tickets" class=" {{ $page['submenu_tickets'] ?? '' }}">
                                   {{ cleanLang(__('lang.tickets')) }}
                                </a>
                            </li>

                            <li class="sidenav-submenu {{ $page['submenu_leads'] ?? '' }}"  id="submenu_leads">
                                <a href="/leads" class=" {{ $page['submenu_leads'] ?? '' }}">
                                   {{ cleanLang(__('lang.leads')) }}
                                </a>
                            </li>

                           
                            <li class="sidenav-submenu {{ $page['submenu_tasks'] ?? '' }}"  id="submenu_tasks">
                                <a href="/tasks" class=" {{ $page['submenu_tasks'] ?? '' }}">
                                   {{ cleanLang(__('lang.tasks')) }}
                                </a>
                            </li>
                            
                            <li class="sidenav-submenu {{ $page['submenu_invoices'] ?? '' }}"  id="submenu_invoices">
                                <a href="/invoices" class=" {{ $page['submenu_invoices'] ?? '' }}">
                                   {{ cleanLang(__('lang.invoices')) }}
                                </a>
                            </li>
                        
                            <li class="sidenav-submenu {{ $page['submenu_products'] ?? '' }}"  id="submenu_products">
                                <a href="/products" class=" {{ $page['submenu_products'] ?? '' }}">
                                   {{ cleanLang(__('lang.products')) }}
                                </a>
                            </li>
                        
                            <li class="sidenav-submenu {{ $page['submenu_expenses'] ?? '' }}"  id="submenu_expenses">
                                <a href="/expenses" class=" {{ $page['submenu_expenses'] ?? '' }}">
                                   {{ cleanLang(__('lang.expenses')) }}
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif

                <!--team-->
                @if (auth()->user()->is_admin)
                    <li
                        class="sidenav-menu-item {{ $page['mainmenu_settings'] ?? '' }} {{ request()->is('show-event') ? 'active' : '' }}">
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                            <i class="ti-archive"></i>
                            <span class="hide-menu">{{ cleanLang(__('lang.other')) }}
                            </span>
                        </a>
                        <ul aria-expanded="false" class="position-top collapse">

                            <li class="sidenav-submenu {{ request()->is('mails') ? 'active' : '' }} menu-tooltip menu-with-tooltip"
                                title="{{ cleanLang(__('Add Emails For Services')) }}" id="submenu_addmails">
                                <a class="waves-effect waves-dark {{ request()->is('mails') ? 'active' : '' }}"
                                    href="/mails" aria-expanded="false" target="_self">
                                    <span class="hide-menu">{{ cleanLang(__('Add Emails')) }}
                                    </span>
                                </a>
                            </li>

                            <li class="sidenav-submenu mainmenu_team {{ $page['submenu_team'] ?? '' }} "
                                id="submenu_team">
                                <a href="/team"
                                    class="{{ $page['submenu_team'] ?? '' }}">{{ cleanLang(__('lang.team_members')) }}</a>
                            </li>

                            <li class="sidenav-submenu mainmenu_team {{ request()->is('show-event') ? 'active' : '' }}"
                                id="submenu_team">
                                <a href="/show-event"
                                    class="{{ request()->is('show-event') ? 'active' : '' }}">{{ cleanLang(__('Activities')) }}</a>
                            </li>

                            <li class="sidenav-submenu mainmenu_timesheets {{ $page['submenu_timesheets'] ?? '' }}"
                                id="submenu_timesheets">
                                <a href="/timesheets"
                                    class="{{ $page['submenu_timesheets'] ?? '' }}">{{ cleanLang(__('lang.time_sheets')) }}</a>
                            </li>
                            <!--[UPCOMING]-->
                            <li class="sidenav-submenu mainmenu_reports {{ $page['submenu_reports'] ?? '' }} hidden"
                                id="submenu_reports">
                                <a href="/reports"
                                    class="{{ $page['submenu_reports'] ?? '' }}">{{ cleanLang(__('lang.reports')) }}</a>
                            </li>
                        </ul>
                    </li>
                @else
                    @if (auth()->user()->role->role_timesheets >= 1)
                        <li class="sidenav-menu-item {{ $page['mainmenu_timesheets'] ?? '' }} menu-tooltip menu-with-tooltip"
                            title="{{ cleanLang(__('lang.time_sheets')) }}">
                            <a class="waves-effect waves-dark" href="/timesheets" aria-expanded="false" target="_self">
                                <i class="ti-timer"></i>
                                <span class="hide-menu">{{ cleanLang(__('lang.time_sheets')) }}
                                </span>
                            </a>
                        </li>
                    @endif
                @endif
                <!--team-->


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
