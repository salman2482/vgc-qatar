<?php $__env->startSection('front-end-content'); ?>
<?php if($attachment->attachment_unique_input === 'frontbanner'): ?>
        <img class="img-fluid" src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" style="height: " alt="">
    <?php endif; ?>
    <section class="register-section">
        <div class="auto-container">
            <div class="row clearfix">

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
                        <?php if($message = Session::get('message')): ?>
                            <p class="text-center alert alert-warning"><?php echo e($message); ?></p>
                        <?php endif; ?>

                        <div class="text">
                            <?php if(App::isLocale('ar')): ?>
                            <p><?php echo ($banner->description_ar); ?></p>
                            <?php else: ?>
                            <p><?php echo ($banner->description); ?></p>
                            <?php endif; ?>
                        </div>
                        
                    </div>

                    <!--Login Form-->
                    <div class="styled-form login-form">
                        <form method="post" action="<?php echo e(route('front.user.loggedin')); ?>">
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
                                    <button type="submit" class="theme-btn btn-style-one"><span class="txt">
                                        Login Now</span></button>
                                </div>

                            </div>

                            <div class="clearfix">
                                <div class="pull-left">
                                    <input type="checkbox" id="remember-me" name="remember_me"><label class="remember-me"
                                        for="remember-me">&nbsp; Remember Me</label>
                                </div>
                            </div>
                            <?php if($loginTitle != 'Employee' && $loginTitle != 'Client' ): ?>
                            <p>Dont have account ? Please <a href="<?php echo e(route('front.user.register')); ?>">Regsiter here</a>
                            </p>
                            <?php endif; ?>

                        </form>
                    </div>

                </div>


            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/FrontEndUser/user-login.blade.php ENDPATH**/ ?>