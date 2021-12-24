<div class="header-lower">

    <div class="auto-container mobile-menu-header">
        <div class="nav-outer clearfix">
            <!-- Main Menu -->
            <nav class="main-menu navbar-expand-md">
                <div class="navbar-header">
                    <!-- Toggle Button -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                    <ul class="navigation clearfix">
                        <li class=""><a href="{{ route('front.index') }}">{{ __('fl.Home') }}</a>
                        </li>
                        <li class="dropdown"><a >{{ __('fl.About') }}</a>
                            <ul>
                                <li>
                                    <a href="{{ route('front.know-us') }}">{{ __('fl.Know Us') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('front.vision-mission') }}">{{ __('fl.Mission Vision Statement') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('front.board-members') }}">{{ __('fl.Board Members') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('front.board-members-message') }}"> {{ __('fl.The Board Message') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('front.why-choose-us') }}">{{ __('fl.Why Choose Veteran') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('front.business-ethics') }}">{{ __('fl.Business Ethics') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('front.organization-chart') }}">{{ __('fl.Organization Chart') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a >{{ __('fl.Services') }}</a>
                            <ul>
                                <li><a
                                        href="{{ route('front.corporate-services') }}">{{ __('fl.Corporate Services') }}</a>
                                </li>
                                <li><a
                                        href="{{ route('front.retail-services') }}">{{ __('fl.Retail Services') }}</a>
                                </li>
                                <li><a href="{{ route('front.our-clients') }}">{{ __('fl.Our Clients') }}</a></li>
                                <li><a href="{{ route('front.our-projects') }}">{{ __('fl.Our Projects') }}</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="dropdown"><a>{{ __('fl.Properties') }}</a>
                            <ul>
                                <li><a
                                        href="{{ route('front.property.index') }}">{{ __('fl.All Properties') }}</a>
                                </li>
                                @auth
                                    <li><a
                                            href="{{ route('front.property.create') }}">{{ __('fl.Create Property') }}</a>
                                    </li>
                                    <li><a href="{{ route('front.user.dashboard') }}">{{ __('fl.My Listings') }}</a>
                                    </li>
                                @endauth
                                @guest
                                    <li><a href="{{ route('front.user.login','Property') }}">{{ __('fl.Login Now') }}</a></li>
                                @endguest
                            </ul>
                        </li>
                        <li class="dropdown"><a >{{ __('fl.Products') }}</a>
                            <?php $cats = App\Models\FCategory::get(); ?>
                            <ul>
                                @foreach ($cats as $item)
                                    <li><a
                                            href="{{ route('front.category.products', $item->id) }}">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown"><a >{{ __('fl.Our Policies') }}</a>
                            <ul>
                                <li><a
                                        href="{{ url('/enivromental-policy') }}">{{ __('fl.Environmental Policy') }}</a>
                                </li>
                                <li><a
                                        href="{{ route('front.health-safety-policy') }}">{{ __('fl.Health Safety Policy') }}</a>
                                </li>
                                <li><a href="{{ route('front.quality-assurance-policy') }}">
                                        {{ __('fl.Quality Assurance Policy') }}</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{ route('front.career') }}">{{ __('fl.Careers') }}</a></li>
                        <li><a href="{{ route('front.contact-us') }}">{{ __('fl.Contact us') }}</a></li>
                        @guest
                            <li class="dropdown"><a >{{ __('fl.Login Now') }}</a>
                                <ul>
                                    <li>
                                        <a href="{{ route('front.user.login','Client') }}">{{ __('fl.Client Portal') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.vendor.index') }}">{{ __('fl.Vendor Portal') }}</a>
                                    </li>
                                    <li>
                                    <a href="{{ route('front.user.login','Employee') }}">{{ __('fl.User / Employee') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('front.CAFM.portal') }}">{{ __('fl.CAFM portal') }}</a>
                                    </li>
                                </ul>
                            </li>
                        @endguest

                        @auth
                        <li>
                            <a href="{{ route('front.vendor.logout') }}">{{ __('fl.Logout') }}</a>
                        </li>
                        @endauth
                        @auth
                        <li>
                            <a href="{{ route('front.employee-dashboard') }}">{{'Dashboard'}}</a>
                        </li>
                    @endauth
                    </ul>
                </div>
            </nav>

            <!-- Main Menu End-->
            <div class="outer-box clearfix">
            </div>
            <div class="side-curve"></div>
        </div>
    </div>
</div>
