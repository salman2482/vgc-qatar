<?php $__env->startSection('styles'); ?>
<?php echo NoCaptcha::renderJs(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('front-end-content'); ?>
    <section class="register-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Form Column-->
                <div class="form-column column col-lg-6 col-md-12 col-sm-12 offset-lg-3">

                    <div class="sec-title">
                        <h2>Register Here</h2>
                    </div>

                    <!--Login Form-->
                    <div class="styled-form register-form">
                        <form action="<?php echo e(route('front.user.store')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-user"></span></span>
                                <input type="text" name="first_name" placeholder="First Name" required
                                    value="<?php echo e(old('first_name')); ?>">
                                <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-user"></span></span>
                                <input type="text" name="last_name" placeholder="Last Name"
                                    value="<?php echo e(old('last_name')); ?>">
                                <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                                <input type="email" name="email" id="email" autocomplete="false" readonly
                                    onfocus="this.removeAttribute('readonly')" placeholder="Enter Email" required
                                    value="<?php echo e(old('email')); ?>">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="error text-danger" id="email_error"></div>
                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="password" placeholder="**********">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="password_confirmation" placeholder="**********">
                                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-user-secret"></span></span>
                                <input type="text" name="company_name" placeholder="Company Name"
                                    value="<?php echo e(old('company_name')); ?>">
                                <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-file"></span></span>
                                <input type="text" name="company_license_number" placeholder="Company License Number"
                                    value="<?php echo e(old('company_license_number')); ?>">
                                <?php $__errorArgs = ['company_license_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-phone"></span></span>
                                <input type="text" name="mobile_number" placeholder="Mobile Number"
                                    value="<?php echo e(old('mobile_number')); ?>">
                                <?php $__errorArgs = ['mobile_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-adjust"></span></span>
                                <input type="text" name="address" placeholder="Address" value="<?php echo e(old('address')); ?>">
                                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="error text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            <div class="form-group">

                                <?php if($errors->has('g-recaptcha-response')): ?>
                                <span class="help-block">
                                    <strong class="text-danger">
                                        <?php echo e($errors->first('g-recaptcha-response')); ?>

                                    </strong>
                                </span>
                                <?php endif; ?>
                                <?php echo app('captcha')->display(); ?>

                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="conditions">
                                        <input type="checkbox" required class="form-contorl mt-1" id="conditions" value="0" style="zoom: 1.4; margin-left: -10px !important;">
                                        <span class="ml-1" style="font-size: 15px;font-weight:bold">  
                                        I agree service terms and condition 
                                        <a href="#" data-toggle="modal" data-target="#exampleModalLong">Read Here</a> </span>
                                    </label>
                                </div>
                                <div id=msg_terms name=msg_terms>
                                </div>
                            </div>

                            <div class="clearfix">
                                <div class="form-group pull-left">
                                    <button type="submit" class="theme-btn btn-style-one"><span class="txt">Register
                                            here</span></button>
                                </div>
                                <div class="form-group submit-text pull-right">
                                    * You must be a free registered to submit content.
                                </div>
                                
                            </div>
                            
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>

        <?php $rec = \App\Models\FrontBanner::where('id', 65)->first(); ?>
<?php if(isset($rec)): ?>

    <div class="modal" id="exampleModalLong" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-danger">
                        <?php if(App::isLocale('ar')): ?>
                            <h2><?php echo $rec->title_ar; ?></h2>
                        <?php else: ?>
                            <h2><?php echo $rec->title; ?></h2>
                        <?php endif; ?>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if(App::isLocale('ar')): ?>
                    <p><?php echo $rec->description_ar; ?></p>
                <?php else: ?>
                    <p><?php echo $rec->description; ?></p>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#email').blur(function() {
                $('#email_error').text('');

                var final = $('#email').val();

                //
                $.ajax({
                    url: "<?php echo e(url('checkemail')); ?>",
                    type: 'GET',
                    data: {
                        id: final
                    },
                    success: function(response) {
                        console.log(response);
                        $('#email_error').text(response);
                        if (response == true) {
                            $('#email_error').text('The Email is already taken');
                            $(':input[type="submit"]').prop('disabled', true);
                        } else {
                            $('#email_error').text('');
                        }
                    }
                });
            });
        });
        
        $(document).ready(function() {
        $("#property-use-terms").click(function(e) {
            e.preventDefault();
            $('#exampleModalLong').modal('show');
        });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/FrontEndUser/user-registration.blade.php ENDPATH**/ ?>