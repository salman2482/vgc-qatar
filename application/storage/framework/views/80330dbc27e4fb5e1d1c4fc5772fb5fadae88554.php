<?php $__env->startSection('front-end-content'); ?>

<?php if($attachment->attachment_unique_input === 'frontbanner'): ?>
        <img class="img-fluid" src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" style="height: " alt="">
    <?php endif; ?>
    
    <!--About Section-->
    <section class="register-section ">
        <div class="auto-container">
            <div class="row clearfix ">

                <!--Form Column-->
                <div class="form-column column col-lg-6 offset-lg-3 col-md-12 col-sm-12 shadow p-3 mb-5 bg-white rounded">

                    <div class="sec-title">
                        <div class="sec-title">
                            <?php if(App::isLocale('ar')): ?>
                            <h2><?php echo e($loginTitle ?? ''); ?> <?php echo ($banner->title_ar); ?></h2>
                            <?php else: ?>
                            <h2><?php echo e($loginTitle ?? ''); ?> <?php echo ($banner->title); ?></h2>
                            <?php endif; ?>
                        </div>
                        <div class="text">
                            <?php if(App::isLocale('ar')): ?>
                            <p><?php echo ($banner->description_ar); ?></p>
                            <?php else: ?>
                            <p><?php echo ($banner->description); ?></p>
                            <?php endif; ?>
                        </div>
                    
                        <?php if($message = Session::get('message')): ?>
                            <p class="text-center alert alert-warning"><?php echo e($message); ?></p>
                        <?php endif; ?>
                    </div>

                    <!--Login Form-->
                    <div class="styled-form login-form">
                        <form method="post" action="<?php echo e(route('front.vendor.loggedin')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                                <input type="email" name="email" value="" placeholder="Emai Address*" required>
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="password" value="" placeholder="Enter Password" required>
                            </div>
                            <div class="clearfix">
                                <div class="form-group pull-left">
                                    <button type="submit" class="theme-btn btn-style-one">
                                        <span class="txt"><?php echo e(__('fl.Login Now')); ?></span></button>
                                </div>

                            </div>

                            <div class="clearfix">
                                <div class="pull-left">
                                    <input type="checkbox" id="remember-me" name="remember_me"><label class="remember-me"
                                        for="remember-me"><?php echo e(__('fl.Remember Me')); ?></label>
                                </div>
                            </div>
                            <p><?php echo e(__('fl.Dont have account ? Please')); ?> <a href="<?php echo e(route('front.vendor.register')); ?>">
                                <?php echo e(__('fl.Regsiter here')); ?>

                            </a>
                            </p>

                        </form>
                    </div>

                </div>


            </div>
        </div>
    </section>
    <!--End About Section-->
<?php $__env->stopSection(); ?>



<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/login/vendor-login.blade.php ENDPATH**/ ?>