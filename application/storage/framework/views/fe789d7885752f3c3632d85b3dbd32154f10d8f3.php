<?php $__env->startSection('styles'); ?>
<?php echo NoCaptcha::renderJs(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('front-end-content'); ?>

    <!--Page Title-->
    <img src="<?php echo e(asset('/public/front-end/images/resource/contact.jpg')); ?>" alt="">
    


    <!--About Section-->
    <section class="about-section" style="padding: 0px !important;">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Column-->
                <div class="content-column col-lg-12 col-md-12 col-sm-12" > 
                    <div class="inner-column">  
                            <!--Contact Section-->
                            <section class="contact-page-section" style="padding: 20px 0px 10px !important;">
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

                                                   <div class="sec-title">
                                                   <h2><?php echo e(__('fl.Any Complain? Leave Us a Message')); ?></h2>
                                                </div>
                                                <!--Contact Form-->
                                                <div class="contact-form">
                                                  

                                                    <form method="POST" action="<?php echo e(route('front.submit-usercomplain','Complain')); ?>" id="contact-form" enctype="multipart/form-data">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="row clearfix">
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" id="name" name="name" placeholder="Your name" required autofocus value="<?php echo e(old('name')); ?>">
                                                            </div>
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="email" placeholder="Your email address" required value="<?php echo e(old('email')); ?>">
                                                            </div>
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="phone" placeholder="Phone number" required value="<?php echo e(old('phone')); ?>">
                                                            </div>
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="text" name="subject" placeholder="Subject" required value="<?php echo e(old('subject')); ?>">
                                                            </div>
                                                            
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <textarea name="message" placeholder="Type your massage here..."><?php echo e(old('message')); ?></textarea>
                                                            </div>
                                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                                <input type="file" name="attachment" placeholder="attachment" required>
                                                            </div>
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
                                                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                                <button type="submit" class="theme-btn btn-style-one"><span class="txt"><?php echo e(__('fl.Submit')); ?></span></button>
                                                            </div>  

                                                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                                                
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

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/complain/complain.blade.php ENDPATH**/ ?>