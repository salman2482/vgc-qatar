<div class="sticky-header">
    <div class="auto-container clearfix">
        <!--Logo-->
        <div class="logo pull-left">
            
        </div>
        
        <!--Right Col-->
        <div class="right-col pull-right">
            <!-- Main Menu -->
            <nav class="main-menu navbar-expand-md">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent1">
                    <ul class="navigation clearfix">
                        <li class=""><a href="<?php echo e(route('front.index')); ?>"><?php echo e(__('fl.Home')); ?></a>
                        </li>
                        <li class="dropdown"><a><?php echo e(__('fl.About')); ?></a>
                            <ul>
                                <li>
                                    <a href="<?php echo e(route('front.know-us')); ?>"><?php echo e(__('fl.Know Us')); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('front.vision-mission')); ?>"><?php echo e(__('fl.Mission Vision Statement')); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('front.board-members')); ?>"><?php echo e(__('fl.Board Members')); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('front.board-members-message')); ?>"> <?php echo e(__('fl.The Board Message')); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('front.why-choose-us')); ?>"><?php echo e(__('fl.Why Choose Veteran')); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('front.business-ethics')); ?>"><?php echo e(__('fl.Business Ethics')); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('front.organization-chart')); ?>"><?php echo e(__('fl.Organization Chart')); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a><?php echo e(__('fl.Services')); ?></a>
                            <ul>
                                <li><a href="<?php echo e(route('front.corporate-services')); ?>"><?php echo e(__('fl.Corporate Services')); ?></a></li>
                                <li><a href="<?php echo e(route('front.retail-services')); ?>"><?php echo e(__('fl.Retail Services')); ?></a></li>
                                <li><a href="<?php echo e(route('front.our-clients')); ?>"><?php echo e(__('fl.Our Clients')); ?></a></li>
                                <li><a href="<?php echo e(route('front.our-projects')); ?>"><?php echo e(__('fl.Our Projects')); ?></a></li>
                                
                            </ul>
                        </li>
                        <li class="dropdown"><a><?php echo e(__('fl.Properties')); ?></a>
                            <ul>
                               <li><a href="<?php echo e(route('front.property.index')); ?>"><?php echo e(__('fl.All Properties')); ?></a>
                                </li>
                                <?php if(auth()->guard()->check()): ?>
                                    <li><a
                                            href="<?php echo e(route('front.property.create')); ?>"><?php echo e(__('fl.Create Property')); ?></a>
                                    </li>
                                    <li><a href="<?php echo e(route('front.user.dashboard')); ?>"><?php echo e(__('fl.My Listings')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(auth()->guard()->guest()): ?>
                                    <li><a href="<?php echo e(route('front.user.login','Property')); ?>"><?php echo e(__('fl.Login Now')); ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="dropdown"><a><?php echo e(__('fl.Products')); ?></a>
                            <?php $cats = App\Models\FCategory::get(); ?>
                            <ul>
                                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(route('front.category.products', $item->id)); ?>"><?php echo e($item->name); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </li>
                        <li class="dropdown"><a><?php echo e(__('fl.Our Policies')); ?></a>
                            <ul>
                                <li><a href="<?php echo e(url('/enivromental-policy')); ?>"><?php echo e(__('fl.Environmental Policy')); ?></a></li>
                                <li><a href="<?php echo e(route('front.health-safety-policy')); ?>"><?php echo e(__('fl.Health Safety Policy')); ?></a></li>
                                <li><a href="<?php echo e(route('front.quality-assurance-policy')); ?>">
                                    <?php echo e(__('fl.Quality Assurance Policy')); ?></a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?php echo e(route('front.career')); ?>"><?php echo e(__('fl.Careers')); ?></a></li>
                        <li><a href="<?php echo e(route('front.contact-us')); ?>"><?php echo e(__('fl.Contact us')); ?></a></li>
                        <?php if(auth()->guard()->guest()): ?>
                        <li class="dropdown"><a><?php echo e(__('fl.Login Now')); ?></a>
                            <ul>
                                <li>
                                    <a href="<?php echo e(route('front.user.login','Client')); ?>"><?php echo e(__('fl.Client Portal')); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('front.vendor.index')); ?>"><?php echo e(__('fl.Vendor Portal')); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('front.user.login','Employee')); ?>"><?php echo e(__('fl.User / Employee')); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('front.CAFM.portal')); ?>"><?php echo e(__('fl.CAFM portal')); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(auth()->guard()->check()): ?>
                    <li>
                        <a href="<?php echo e(route('front.vendor.logout')); ?>"><?php echo e(__('fl.Logout')); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if(auth()->guard()->check()): ?>
                        <li><a href="<?php echo e(route('front.employee-dashboard')); ?>">Dashboard</a></li>
                    <?php endif; ?>
                    </ul>
                </div>
            </nav><!-- Main Menu End-->
        </div>
        
    </div>
</div><?php /**PATH H:\wamp64\www\application\resources\views/front-end/partials/navbar/sticky-nav.blade.php ENDPATH**/ ?>