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
                <li class="sidenav-menu-item <?php echo e($page['mainmenu_home'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                    title="<?php echo e(cleanLang(__('lang.home'))); ?>">
                    <a class="waves-effect waves-dark" href="/home" aria-expanded="false" target="_self">
                        <i class="ti-home"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.dashboard'))); ?>

                        </span>
                    </a>
                </li>
                <!--home-->


                <!--users-->
                <?php if(auth()->user()->role->role_clients >= 1 || auth()->user()->role->role_contacts >= 1): ?>
                    <li class="sidenav-menu-item <?php echo e($page['mainmenu_customers'] ?? ''); ?>">
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                            <i class="sl-icon-people"></i>
                            <span class="hide-menu"><?php echo e(cleanLang(__('lang.customers'))); ?>

                            </span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <?php if(auth()->user()->role->role_clients >= 1): ?>
                                <li class="sidenav-submenu <?php echo e($page['submenu_customers'] ?? ''); ?>"
                                    id="submenu_clients">
                                    <a href="/clients"
                                        class="<?php echo e($page['submenu_customers'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.clients'))); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(auth()->user()->role->role_contacts >= 1): ?>
                                <li class="sidenav-submenu <?php echo e($page['submenu_contacts'] ?? ''); ?>"
                                    id="submenu_contacts">
                                    <a href="/users"
                                        class="<?php echo e($page['submenu_contacts'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.client_users'))); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <!--users-->


                <!--trustech code starts here for front end management-->
                <?php if(auth()->user()->role->role_vendorrfq >= 1 || auth()->user()->is_admin): ?>
                    <li class="sidenav-menu-item <?php echo e($page['mainmenu_vendors'] ?? ''); ?>">
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                            <i class="ti-wallet"></i>
                            <span class="hide-menu"><?php echo e(cleanLang(__('lang.vendors'))); ?>

                            </span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <?php if(auth()->user()->role->role_vendorrfq >= 1 || auth()->user()->is_admin): ?>
                                <li class="sidenav-submenu <?php echo e($page['submenu_vusers'] ?? ''); ?>" id="submenu_vusers">
                                    <a href="/vusers"
                                        class=" <?php echo e($page['submenu_vusers'] ?? ''); ?>"><?php echo e(cleanLang(__('Vendors List'))); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(auth()->user()->role->role_vendorrfq >= 1 || auth()->user()->is_admin): ?>
                                <li class="sidenav-submenu <?php echo e($page['submenu_vendorrfqs'] ?? ''); ?>"
                                    id="submenu_vendorrfqs">
                                    <a href="/vendorrfqs"
                                        class=" <?php echo e($page['submenu_vendorrfqs'] ?? ''); ?>"><?php echo e(cleanLang(__('RFQ'))); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(auth()->user()->role->role_vendorqtn >= 1 || auth()->user()->is_admin): ?>
                                <li class="sidenav-submenu <?php echo e($page['submenu_vendorqtns'] ?? ''); ?>"
                                    id="submenu_vendorqtns">
                                    <a href="/vendorqtns"
                                        class=" <?php echo e($page['submenu_vendorqtns'] ?? ''); ?>"><?php echo e(cleanLang(__('QTNs'))); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(auth()->user()->role->role_vendorpo >= 1 || auth()->user()->is_admin): ?>
                                <li class="sidenav-submenu <?php echo e($page['submenu_vendorpos'] ?? ''); ?>"
                                    id="submenu_vendorpos">
                                    <a href="/vendorpos"
                                        class=" <?php echo e($page['submenu_vendorpos'] ?? ''); ?>"><?php echo e(cleanLang(__('POs'))); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(auth()->user()->role->role_vendorinvoice >= 1 || auth()->user()->is_admin): ?>
                                <li class="sidenav-submenu <?php echo e($page['submenu_vendorinvoices'] ?? ''); ?>"
                                    id="submenu_vendorinvoices">
                                    <a href="/vendorinvoices"
                                        class=" <?php echo e($page['submenu_vendorinvoices'] ?? ''); ?>"><?php echo e(cleanLang(__('INVOICES'))); ?></a>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </li>
                <?php endif; ?>
                <!--trustech code ends here for front end management-->

                <!--projects-->
                <!--front project and client-->
                <?php if(auth()->user()->role->role_project_client >= 1 || auth()->user()->is_admin): ?>
                   <li class="sidenav-menu-item <?php echo e($page['mainmenu_fronts'] ?? ''); ?>">
                      <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                          <i class="ti-image"></i>
                          <span class="hide-menu"><?php echo e(cleanLang(__('Front View'))); ?>

                          </span>
                      </a>
                      <ul aria-expanded="false" class="collapse">
                          <li class="sidenav-submenu <?php echo e($page['submenu_fproducts'] ?? ''); ?>" id="submenu_fproducts">
                              <a href="/fproducts"
                                  class=" <?php echo e($page['submenu_fproducts'] ?? ''); ?>"><?php echo e(cleanLang(__('Products'))); ?></a>
                          </li>

                          <li class="sidenav-submenu <?php echo e($page['submenu_fprojects'] ?? ''); ?>" id="submenu_fprojects">
                              <a href="/frontprojects"
                                  class=" <?php echo e($page['submenu_fprojects'] ?? ''); ?>"><?php echo e(cleanLang(__('Project'))); ?></a>
                          </li>

                          <li class="sidenav-submenu <?php echo e($page['submenu_clients'] ?? ''); ?>" id="submenu_clients">
                              <a href="/frontclients"
                                  class=" <?php echo e($page['submenu_clients'] ?? ''); ?>"><?php echo e(cleanLang(__('Clients'))); ?></a>
                          </li>
                          
                          <li class="sidenav-submenu <?php echo e($page['submenu_banners'] ?? ''); ?>" id="submenu_banners">
                              <a href="/frontbanners"
                                  class=" <?php echo e($page['submenu_banners'] ?? ''); ?>"><?php echo e(cleanLang(__('Banners'))); ?></a>
                          </li>
                          
                        </ul>
                    </li>
                     <?php endif; ?>
                
                <?php if(auth()->user()->role->role_project_client >= 1 || auth()->user()->is_admin): ?>
                   <li class="sidenav-menu-item <?php echo e($page['mainmenu_careers'] ?? ''); ?>">
                      <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                          <i class="ti-briefcase"></i>
                          <span class="hide-menu"><?php echo e(cleanLang(__('Careers'))); ?>

                          </span>
                      </a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="sidenav-submenu <?php echo e($page['submenu_careers'] ?? ''); ?>" id="submenu_careers">
                                <a href="/frontcareers"
                                    class=" <?php echo e($page['submenu_careers'] ?? ''); ?>"><?php echo e(cleanLang(__('Careers'))); ?></a>
                            </li>

                            <li class="sidenav-submenu <?php echo e($page['submenu_careersapply'] ?? ''); ?>" id="submenu_careersapply">
                                <a href="/careersapply"
                                class=" <?php echo e($page['submenu_careersapply'] ?? ''); ?>"><?php echo e(cleanLang(__('Career Applies List'))); ?></a>
                            </li>
                        </ul>
                    </li>
                     <?php endif; ?>
                

                
                <?php if(auth()->user()->role->role_project_client >= 1 || auth()->user()->is_admin): ?>
                   <li class="sidenav-menu-item <?php echo e($page['mainmenu_fproducts'] ?? ''); ?>">
                      <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                          <i class="ti-shopping-cart-full"></i>
                          <span class="hide-menu"><?php echo e(cleanLang(__('F Products'))); ?>

                          </span>
                      </a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="sidenav-submenu <?php echo e($page['submenu_fproducts'] ?? ''); ?>" id="submenu_fproducts">
                                <a href="/fproducts"
                                    class=" <?php echo e($page['submenu_fproducts'] ?? ''); ?>"><?php echo e(cleanLang(__('Products'))); ?></a>
                            </li>

                            <li class="sidenav-submenu <?php echo e($page['submenu_subproducts'] ?? ''); ?>" id="submenu_subproducts">
                                <a href="/subproducts" class=" <?php echo e($page['submenu_subproducts'] ?? ''); ?>">
                                <?php echo e(cleanLang(__('Sub Products'))); ?></a>
                            </li>
                        </ul>
                    </li>
                     <?php endif; ?>
                

                <!--properties-->
                <?php if(auth()->user()->role->role_property >= 1 || auth()->user()->is_admin): ?>
                   <li class="sidenav-menu-item <?php echo e($page['mainmenu_properties'] ?? ''); ?>">
                      <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                          <i class="ti-home"></i>
                          <span class="hide-menu"><?php echo e(cleanLang(__('lang.properties'))); ?>

                          </span>
                      </a>
                        <ul aria-expanded="false" class="collapse">
                            <li class="sidenav-submenu <?php echo e($page['submenu_properties'] ?? ''); ?>" id="submenu_properties">
                                <a href="/properties" class=" <?php echo e($page['submenu_properties'] ?? ''); ?>">
                                    <?php echo e(cleanLang(__('All Properties'))); ?>

                                </a>
                            </li>
                            
                            <li class="sidenav-submenu <?php echo e($page['submenu_frontusers'] ?? ''); ?>" id="submenu_frontusers">
                                <a href="/frontusers" class=" <?php echo e($page['submenu_frontusers'] ?? ''); ?>">
                                    <?php echo e(cleanLang(__('Users'))); ?>

                                </a>
                            </li>

                            
                        </ul>
                    </li>
                     <?php endif; ?>
                <!--properties-->

              

                <li class="sidenav-menu-item  <?php echo e($page['mainmenu_RFM'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-user"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('RFM / PO'))); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <?php if(auth()->user()->role->role_rfms >= 1): ?>
                            <li class="sidenav-submenu" id="submenu_rfms" title="<?php echo e(cleanLang(__('lang.rfms'))); ?>">
                                <a class="<?php echo e($page['submenu_rfms'] ?? ''); ?>" href="/rfms" aria-expanded="false"
                                    target="_self">
                                    RFM
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->role->role_lpos >= 1 || auth()->user()->is_admin): ?>
                            <li class="sidenav-submenu" id="submenu_lpos">
                                <a href="/lpos" class="<?php echo e($page['submenu_lpos'] ?? ''); ?>">
                                    PO
                                </a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>
                <!--vendors-->

                <!--trustech code starts here for front end management-->
                <li class="sidenav-menu-item  <?php echo e($page['mainmenu_control'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="sl-icon-screen-desktop"></i>
                        <span class="hide-menu">
                            DCM
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <?php if(auth()->user()->role->role_documents >= 1 || auth()->user()->is_admin): ?>
                            <li class="sidenav-submenu " id="submenu_document">
                                <a href="/documents" class="<?php echo e($page['submenu_documents'] ?? ''); ?>">
                                    Doc Mgt
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->role->role_contracts >= 1 || auth()->user()->is_admin): ?>
                            <li class="sidenav-submenu " id="submenu_contracts">
                                <a href="/contractsmgt" class="<?php echo e($page['submenu_contracts'] ?? ''); ?>">
                                    Contract
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if(auth()->user()->role->role_quotations >= 1 || auth()->user()->is_admin): ?>
                            <li class="sidenav-submenu" id="submenu_quotations">
                                <a href="/quotations" class="<?php echo e($page['submenu_quotations'] ?? ''); ?>">
                                    Quotation
                                </a>
                            </li>
                        <?php endif; ?>


                        <?php if(auth()->user()->role->role_govtdocs >= 1 || auth()->user()->is_admin): ?>
                            <li class="sidenav-submenu" id="submenu_govtdocuments">
                                <a href="/govtdocuments" class="<?php echo e($page['submenu_govtdocuments'] ?? ''); ?>">
                                    Govt Documents
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(auth()->user()->role->role_employee_legal_documents >= 1 || auth()->user()->is_admin): ?>
                            <li class="sidenav-submenu " id="submenu_employeedocument">
                                <a href="/employeedocument" class="<?php echo e($page['submenu_employeedocument'] ?? ''); ?>">
                                    Employee Legal Docs
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                

                
                <?php if(auth()->user()->role->role_tasks >= 1): ?>
                    <li class="sidenav-menu-item <?php echo e($page['mainmenu_materials'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                        title="<?php echo e(cleanLang(__('Material'))); ?>">
                        <a class="waves-effect waves-dark" href="/materials" aria-expanded="false" target="_self">
                            <i class="sl-icon-docs"></i>
                            <span class="hide-menu"><?php echo e(cleanLang(__('Materials'))); ?>

                            </span>
                        </a>
                    </li>
                <?php endif; ?>
                <!--tasks-->


                <!--[upcoming]subscriptions-->
                <li class="sidenav-menu-item <?php echo e($page['mainmenu_kb'] ?? ''); ?> menu-tooltip menu-with-tooltip hidden"
                    title="<?php echo e(cleanLang(__('lang.subscriptions'))); ?>">
                    <a class="waves-effect waves-dark p-r-20" href="/subscriptions" aria-expanded="false"
                        target="_self">
                        <i class="sl-icon-docs"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('lang.subscriptions'))); ?>

                        </span>
                    </a>
                </li>

                <?php if(auth()->user()->isAdmin): ?>
                   <li class="sidenav-menu-item  <?php echo e($page['mainmenu_bookings'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-package"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('Services'))); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">

                            <li class="sidenav-submenu <?php echo e($page['submenu_services'] ?? ''); ?>" >
                                <a class="<?php echo e($page['submenu_services'] ?? ''); ?>" href="/services" aria-expanded="false"
                                    target="_self">
                                  <?php echo e(cleanLang(__('All Services'))); ?>

                                </a>
                            </li>
                            <li class="sidenav-submenu <?php echo e($page['submenu_bookings'] ?? ''); ?>" >
                                <a class="<?php echo e($page['submenu_bookings'] ?? ''); ?>" href="/bookings" aria-expanded="false"
                                    target="_self">
                                  <?php echo e(cleanLang(__('Bookings'))); ?>

                                </a>
                            </li>

                            <li class="sidenav-submenu <?php echo e($page['submenu_employees'] ?? ''); ?>">
                                <a href="/employees" class="<?php echo e($page['submenu_employees'] ?? ''); ?>">
                                  <?php echo e(cleanLang(__('Employee'))); ?>

                                </a>
                            </li>

                            <li class="sidenav-submenu <?php echo e($page['submenu_corporateservices'] ?? ''); ?>" id="submenu_corporateservices">
                            <a href="/corporateservices"
                                class=" <?php echo e($page['submenu_corporateservices'] ?? ''); ?>"><?php echo e(cleanLang(__('Corporate Services'))); ?></a>
                            </li>
                          
                            <li class="sidenav-submenu <?php echo e($page['submenu_subcorporateservices'] ?? ''); ?>" id="submenu_subcorporateservices">
                            <a href="/subcorporateservices"
                                class=" <?php echo e($page['submenu_subcorporateservices'] ?? ''); ?>"><?php echo e(cleanLang(__('Sub Corporate Services'))); ?></a>
                            </li>

                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(auth()->user()->isAdmin): ?>
                   <li class="sidenav-menu-item  <?php echo e($page['mainmenu_crms'] ?? ''); ?>">
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="ti-user"></i>
                        <span class="hide-menu"><?php echo e(cleanLang(__('CRM'))); ?>

                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse">

                            <li class="sidenav-submenu <?php echo e($page['submenu_projects'] ?? ''); ?>"  id="submenu_projects">
                                <a href="/projects" class=" <?php echo e($page['submenu_projects'] ?? ''); ?>">
                                   <?php echo e(cleanLang(__('lang.projects'))); ?>

                                </a>
                            </li>
                            
                            <li class="sidenav-submenu <?php echo e($page['submenu_tickets'] ?? ''); ?>"  id="submenu_tickets">
                                <a href="/tickets" class=" <?php echo e($page['submenu_tickets'] ?? ''); ?>">
                                   <?php echo e(cleanLang(__('lang.tickets'))); ?>

                                </a>
                            </li>

                            <li class="sidenav-submenu <?php echo e($page['submenu_leads'] ?? ''); ?>"  id="submenu_leads">
                                <a href="/leads" class=" <?php echo e($page['submenu_leads'] ?? ''); ?>">
                                   <?php echo e(cleanLang(__('lang.leads'))); ?>

                                </a>
                            </li>

                           
                            <li class="sidenav-submenu <?php echo e($page['submenu_tasks'] ?? ''); ?>"  id="submenu_tasks">
                                <a href="/tasks" class=" <?php echo e($page['submenu_tasks'] ?? ''); ?>">
                                   <?php echo e(cleanLang(__('lang.tasks'))); ?>

                                </a>
                            </li>
                            
                            <li class="sidenav-submenu <?php echo e($page['submenu_invoices'] ?? ''); ?>"  id="submenu_invoices">
                                <a href="/invoices" class=" <?php echo e($page['submenu_invoices'] ?? ''); ?>">
                                   <?php echo e(cleanLang(__('lang.invoices'))); ?>

                                </a>
                            </li>
                        
                            <li class="sidenav-submenu <?php echo e($page['submenu_products'] ?? ''); ?>"  id="submenu_products">
                                <a href="/products" class=" <?php echo e($page['submenu_products'] ?? ''); ?>">
                                   <?php echo e(cleanLang(__('lang.products'))); ?>

                                </a>
                            </li>
                        
                            <li class="sidenav-submenu <?php echo e($page['submenu_expenses'] ?? ''); ?>"  id="submenu_expenses">
                                <a href="/expenses" class=" <?php echo e($page['submenu_expenses'] ?? ''); ?>">
                                   <?php echo e(cleanLang(__('lang.expenses'))); ?>

                                </a>
                            </li>

                        </ul>
                    </li>
                <?php endif; ?>

                <!--team-->
                <?php if(auth()->user()->is_admin): ?>
                    <li
                        class="sidenav-menu-item <?php echo e($page['mainmenu_settings'] ?? ''); ?> <?php echo e(request()->is('show-event') ? 'active' : ''); ?>">
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                            <i class="ti-archive"></i>
                            <span class="hide-menu"><?php echo e(cleanLang(__('lang.other'))); ?>

                            </span>
                        </a>
                        <ul aria-expanded="false" class="position-top collapse">

                            <li class="sidenav-submenu <?php echo e(request()->is('mails') ? 'active' : ''); ?> menu-tooltip menu-with-tooltip"
                                title="<?php echo e(cleanLang(__('Add Emails For Services'))); ?>" id="submenu_addmails">
                                <a class="waves-effect waves-dark <?php echo e(request()->is('mails') ? 'active' : ''); ?>"
                                    href="/mails" aria-expanded="false" target="_self">
                                    <span class="hide-menu"><?php echo e(cleanLang(__('Add Emails'))); ?>

                                    </span>
                                </a>
                            </li>

                            <li class="sidenav-submenu mainmenu_team <?php echo e($page['submenu_team'] ?? ''); ?> "
                                id="submenu_team">
                                <a href="/team"
                                    class="<?php echo e($page['submenu_team'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.team_members'))); ?></a>
                            </li>

                            <li class="sidenav-submenu mainmenu_team <?php echo e(request()->is('show-event') ? 'active' : ''); ?>"
                                id="submenu_team">
                                <a href="/show-event"
                                    class="<?php echo e(request()->is('show-event') ? 'active' : ''); ?>"><?php echo e(cleanLang(__('Activities'))); ?></a>
                            </li>

                            <li class="sidenav-submenu mainmenu_timesheets <?php echo e($page['submenu_timesheets'] ?? ''); ?>"
                                id="submenu_timesheets">
                                <a href="/timesheets"
                                    class="<?php echo e($page['submenu_timesheets'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.time_sheets'))); ?></a>
                            </li>
                            <!--[UPCOMING]-->
                            <li class="sidenav-submenu mainmenu_reports <?php echo e($page['submenu_reports'] ?? ''); ?> hidden"
                                id="submenu_reports">
                                <a href="/reports"
                                    class="<?php echo e($page['submenu_reports'] ?? ''); ?>"><?php echo e(cleanLang(__('lang.reports'))); ?></a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <?php if(auth()->user()->role->role_timesheets >= 1): ?>
                        <li class="sidenav-menu-item <?php echo e($page['mainmenu_timesheets'] ?? ''); ?> menu-tooltip menu-with-tooltip"
                            title="<?php echo e(cleanLang(__('lang.time_sheets'))); ?>">
                            <a class="waves-effect waves-dark" href="/timesheets" aria-expanded="false" target="_self">
                                <i class="ti-timer"></i>
                                <span class="hide-menu"><?php echo e(cleanLang(__('lang.time_sheets'))); ?>

                                </span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <!--team-->


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<?php /**PATH H:\wamp64\www\application\resources\views/nav/leftmenu-team.blade.php ENDPATH**/ ?>