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
                <div class="content-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <?php if(App::isLocale('ar')): ?>
                                <h2><?php echo $banner->title_ar; ?></h2>
                            <?php else: ?>
                                <h2><?php echo $banner->title; ?></h2>
                            <?php endif; ?>
                        </div>
                        <div class="text">
                            <?php if(App::isLocale('ar')): ?>
                                <p><?php echo $banner->description_ar; ?></p>
                            <?php else: ?>
                                <p><?php echo $banner->description; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="contact-form">
                        <?php if(session()->has('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                                <strong><?php echo e(session()->get('success')); ?></strong>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('front.legalRegistration.mail')); ?>" method="POST"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="vendor_company_name" value="<?php echo e(old('vendor_company_name')); ?>"
                                            placeholder="COMPANY NAME" required>
    
                                        <?php $__errorArgs = ['vendor_company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
    
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <select name="title">
                                            <option value="Mr">Mr</option>
                                            <option value="Madam">Madam</option>
                                            <option value="Ms">Ms</option>
                                            <option value="Dr">Dr</option>
                                            <option value="Engr">Engr</option>
                                        </select>
    
                                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
    
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="first_name" required placeholder="FIRST NAME">
                                        <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="last_name" required placeholder="LAST NAME">
                                        <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="position" required placeholder="POSITION">
                                        <?php $__errorArgs = ['position'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="email" id="email" name="email" placeholder="example@example.com">
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error" id="email_error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="phone" placeholder="MOBILE NUMBER">
                                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="commercial_registration_no"
                                            placeholder="COMMERCIAL REGISTRATION NO" required>
                                        <?php $__errorArgs = ['commercial_registration_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="purpose" placeholder="PURPOSE OF REGISTRATION">
                                        <?php $__errorArgs = ['purpose'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="office_telephone_no" placeholder="OFFICE TELEPHONE NUMBER">
                                        <?php $__errorArgs = ['office_telephone_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
    
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" required name="address" placeholder="ADDRESS">
                                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
    
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <input type="text" name="po_box" placeholder="PO-BOX">
                                        <?php $__errorArgs = ['po_box'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="error"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
    
                                </div>
                                
                                <div class="col-md-12 mt-3">
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
                                        <button type="submit" class="theme-btn btn-style-one">
                                            <span class="txt"><?php echo e(__('fl.Submit')); ?></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--End About Section-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/legal-registration/legal-registration.blade.php ENDPATH**/ ?>