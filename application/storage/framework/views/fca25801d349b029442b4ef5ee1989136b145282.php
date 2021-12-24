<?php $__env->startSection('styles'); ?>
<?php echo NoCaptcha::renderJs(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('front-end-content'); ?>

<?php if($attachment->attachment_unique_input === 'frontbanner'): ?>
        <img class="img-fluid" src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" style="height: " alt="">
    <?php endif; ?>


    <!--About Section-->
    <section class="about-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Column-->
                <div class="content-column col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 20px !important;"> 
                    <div class="inner-column">
                        <div class="content-column col-lg-12 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="sec-title">
                                    <?php if(App::isLocale('ar')): ?>
                                    <h2><?php echo ($banner->title_ar); ?></h2>
                                    <?php else: ?>
                                    <h2><?php echo ($banner->title); ?></h2>
                                    <?php endif; ?>
                                </div>
                                <div class="text">
                                    <?php if(App::isLocale('ar')): ?>
                                    <p><?php echo ($banner->description_ar); ?></p>
                                    <?php else: ?>
                                    <p><?php echo ($banner->description); ?></p>
                                    <?php endif; ?>
                                </div>    
                            </div>
                        </div>
                        <div class="text">
                            <section class="contact-location-section" style="padding: 0px !important">
                                <div class="auto-container">
                                    <div class="row clearfix">
                                        
                                        <!--Column-->
                                        <div class="info-column col-lg-4 col-md-6 col-sm-12">
                                            <div class="column-inner" style="height: 180px">
                                                <div>
                                                    <a href='https://www.google.com/maps/@25.250661,51.563096,16z?hl=en-GB'>
                                                    <i class="flaticon-pin" style="font-size: 50px;" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="text"> 
                                                   <?php echo e(__('fl.site_address')); ?>

                                                </div>

                                            </div>
                                        </div>
                                        
                                         <!--Column-->
                                        <div class="info-column col-lg-4 col-md-6 col-sm-12">
                                            <div class="column-inner" style="height: 180px">
                                                <div >
                                                    <a href="javaScript::void()" id="contact-focus">
                                                        <i class="fa fa-envelope" style="font-size: 50px" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="text">
                                                    Contact US
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                         <!--Column-->
                                        <div class="info-column col-lg-4 col-md-6 col-sm-12">
                                            <div class="column-inner" style="height: 180px">
                                                <div>
                                                    <a href="">
                                                        <i class="fa fa-phone" style="font-size: 50px" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <ul>
                                                    <li>Phone: +974 44441061</li>
                                                    <li>Fax: +974 44441062</li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>
                            <!--End Contact Location Section-->
                            
                            <!--Contact Section-->
                            <section class="contact-page-section" style="padding: 0px !important;">
                                <div class="auto-container">
                                    <div class="row clearfix">
                                       
                                        <!--Form Column-->
                                        <div class="form-column col-lg-12 col-md-12 col-sm-12">
                                            <div class="inner-column">
                                                <?php if(session()->has('success')): ?>
                                                    <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                                                    <strong><?php echo e(session()->get('success')); ?></strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                <?php endif; ?>
                                            
                                                <!--Sec Title-->
                                                   <div class="sec-title">
                                                   <h2><?php echo e(__('fl.Any Question? Leave Us a Message')); ?></h2>
                                                </div>
                                                <!--Contact Form-->
                                                <div class="contact-form">
                                                    <form method="POST" 
                                                    action="<?php echo e(route('front.submit-usercomplain','Contact Us')); ?>" id="contact-forma">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row clearfix">
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="name" name="name" required
                                                                value="<?php echo e(old('name')); ?>" placeholder="Your name"  autofocus>
                                                            </div>
                                                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <div class="error"><?php echo e($message); ?></div>
                                                            </div>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="email" placeholder="Your email address" required value="<?php echo e(old('email')); ?>">
                                                            </div>
                                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <div class="error"><?php echo e($message); ?></div>
                                                            </div>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="phone" placeholder="Phone number" required value="<?php echo e(old('phone')); ?>">
                                                            </div>
                                                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <div class="error"><?php echo e($message); ?></div>
                                                            </div>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="subject" placeholder="Subject" required value="<?php echo e(old('subject')); ?>">
                                                            </div>
                                                            <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <div class="error"><?php echo e($message); ?></div>
                                                            </div>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <textarea name="message" placeholder="Type your massage here..."><?php echo e(old('message')); ?></textarea>
                                                            </div>
                                                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <div class="error"><?php echo e($message); ?></div>
                                                            </div>
                                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <?php if($errors->has('g-recaptcha-response')): ?>
                                                                <span class="help-block">
                                                                    <strong class="text-danger">
                                                                        <?php echo e($errors->first('g-recaptcha-response')); ?>

                                                                    </strong>
                                                                </span>
                                                                <?php endif; ?>
                                                                <?php echo app('captcha')->display(); ?>

                                                            </div>  
                                                            
                                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                                <button type="submit" class="theme-btn btn-style-one"><span class="txt"><?php echo e(__('fl.Submit')); ?></span></button>
                                                            </div>  

                                                            
                                                           
                                                        </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    $(function() {
        $('#contact-focus').click(function(){
            $("#firstname").focus();
        });
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/contact-us/contact-us.blade.php ENDPATH**/ ?>