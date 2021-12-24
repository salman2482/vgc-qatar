<?php $__env->startSection('styles'); ?>
<style>
    #catCheck{
        zoom: 2.5;
    }
    .error{
        color: red;
        font-weight: 700;
        font-weight: 700;
        font-size: 15px;
    }
    .modal-body{
        padding-left: 45px !important;
        padding-right: 45px !important;
    }
    </style>
    <?php echo NoCaptcha::renderJs(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('front-end-content'); ?>

    <!--About Section-->
    <section class="register-section ">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Form Column-->
                <div class="form-column col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column p-3">
                        
                        <div class="sec-title">
                            <h2><?php echo e(__('fl.Vendor Registeration')); ?> </h2>
                        </div>
                        <div class="contact-form">
                            <form action="<?php echo e(route('front.vendor.store')); ?>" method="POST" enctype="multipart/form-data" >
                                <?php echo csrf_field(); ?>
                                <div class="row clearfix">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="vendor_company_name" value="<?php echo e(old('vendor_company_name')); ?>"
                                            placeholder="VENDOR COMPANY NAME" required >
                                            
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
    
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="commercial_registration_no" placeholder="COMMERCIAL REGISTRATION NO" required value="<?php echo e(old('commercial_registration_no')); ?>">
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
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="trade_license_no" required placeholder="TRADE LICENSE NO" value="<?php echo e(old('trade_license_no')); ?>">
                                        <?php $__errorArgs = ['trade_license_no'];
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

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <select name="title">
                                            <option value="Mr" <?php echo e(old('title') == 'Mr' ? 'selected' : ''); ?>>Mr</option>
                                        <option value="Madam" <?php echo e(old('title') == 'Madam' ? 'selected' : ''); ?>>Madam</option>
                                            <option value="Ms" <?php echo e(old('title') == 'Ms' ? 'selected' : ''); ?>>Ms</option>
                                            <option value="Dr" <?php echo e(old('title') == 'Dr' ? 'selected' : ''); ?>>Dr</option>
                                            <option value="Engr" <?php echo e(old('title') == 'Engr' ? 'selected' : ''); ?>>Engr</option>
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

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="first_name" required placeholder="CONTACT PERSON FIRST NAME" value="<?php echo e(old('first_name')); ?>">
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
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="last_name" required placeholder="CONTACT PERSON LAST NAME" value="<?php echo e(old('last_name')); ?>">
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
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="position" required placeholder="POSITION" value="<?php echo e(old('position')); ?>">
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
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="email" required readonly onfocus="this.removeAttribute('readonly');" name="email" placeholder="example@example.com" value="<?php echo e(old('email')); ?>">
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
                                        <div class="error" id="email_error"></div>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" name="password" placeholder="PASSWORD" value="<?php echo e(old('password')); ?>">
                                        <?php $__errorArgs = ['password'];
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

                                    

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  name="office_telephone_no" placeholder="OFFICE TELEPHONE NUMBER" value="<?php echo e(old('office_telephone_no')); ?>">
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

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="phone" placeholder="MOBILE NUMBER" value="<?php echo e(old('phone')); ?>">
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

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" required name="address" placeholder="ADDRESS" value="<?php echo e(old('address')); ?>">
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

                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="po_box" placeholder="PO-BOX" value="<?php echo e(old('po_box')); ?>">
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

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <p class="text-center text-capitalize"
                                            style="color: seagreen !important; font-weight: 550">
                                            <?php echo e(__('fl.business category (please tick on the respective box and indicate additional remarks/specifications if any)')); ?> <span class="text-center">*</span>
                                        </p>
                                    </div>

                                    <?php
                                            $cats = [
                                                'Battery Supplier',
                                                'Carpentry Equipment Supplier',
                                                'Carpentry Material Supplier',
                                                'Cctv Maintenance Contractor',
                                                'Civil Contractor',
                                                'Civil Maintenance Contractor',
                                                'Cleaning Equipment Supplier',
                                                'Cleaning Material Supplier',
                                                'Cleaning Services',
                                                'Electrical Contractor',
                                                'Electrical Equipment Supplier',
                                                'Electrical Material Supplier',
                                                'Electromechanical Contractor',
                                                'Electromechanical Maintenance Contractor',
                                                'Elv Equipment Supplier',
                                                'Elv Maintenance Contractor',
                                                'Elv Material Supplier',
                                                'Ff & Fa Contractor',
                                                'Ff & Fa Maintenance Contractor',
                                                'Fire Alarm Equipment Supplier',
                                                'Fire Alarm Material Supplier',
                                                'Fire Fighting Equipment Supplier',
                                                'Fire Fighting Material Supplier',
                                                'Fit-Out Contractor',
                                                'Generator Contractor',
                                                'Hvac Contractor',
                                                'Hvac Material Supplier',
                                                'Industrial Oil Supplier',
                                                'Joinery',
                                                'Joinery Equipment Supplier',
                                                'Joinery Material Supplier',
                                                'Landscaping Contractor',
                                                'Manpower Supplier',
                                                'Mechanical Contractor',
                                                'Office Supplies',
                                                'Others',
                                                'Pest Control Services',
                                                'Plumbing Equipment Supplier',
                                                'Plumbing Material Supplier',
                                                'Security Services',
                                                'Vehicle Maintenance & Garage Services ',
                                                'Vehicle Spare parts Supplier',
                                            ];
                                        ?>
                                        <br><br>
                                    <?php $__errorArgs = ['category'];
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

                                    <div class="row" style="margin-top: 10px; margin-left: 36px;">
                                    <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <input type="checkbox" value="<?php echo e($cat); ?>" id="catCheck"  name="category[]" style="position: absolute; margin-left: -15px; margin-top: -3px;" 
                                    <?php echo e((is_array(old('category')) && in_array($cat, old('category'))) ? ' checked' : ''); ?>>
                                        <span>
                                            <?php echo e($cat); ?>

                                        </span>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 mt-2 d-flex">
                                        <span class="h6">
                                            <?php echo e(__('fl.IS YOUR COMPANY ASSOCIATED WITH OUR FIRM ?')); ?>

                                        </span>
                                        <span>
                                            <input type="checkbox" value="yes" style="zoom: 2.5; margin-top: -3px !important; margin-left: 10px !important;" name="company_association"
                                            <?php echo e(old('company_association') == 'yes' ? 'checked' : ''); ?> >
                                        </span>
                                    </div>
                                    <hr style="width: 100%">

                                    
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <textarea name="learn_about_compnay" placeholder="HOW DID YOU LEARN ABOUT OUR COMPANY ?" cols="30" rows="10"><?php echo e(old('learn_about_compnay')); ?></textarea>
                                    </div>
                                    
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-2 col-sm-12">
                                            <label class="h5"><?php echo e(__('fl.Company Profile')); ?></label>
                                        </div>
                                        <div class="col-md-10 col-sm-12">
                                            <input type="file" name="company_profile" required>
                                            <?php $__errorArgs = ['company_profile'];
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

                                
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-4 col-sm-12">
                                        <label class="h5"><?php echo e(__('fl.Company Commercial License')); ?></label>
                                        </div>
                                        <div class="col-md-10 col-sm-12">
                                            <input type="file" name="company_commercial_license" required>
                                        <?php $__errorArgs = ['company_commercial_license'];
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

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-2 col-sm-12">
                                            <label class="h5"><?php echo e(__('fl.Other Documents')); ?></label>
                                        </div>
                                        <div class="col-md-10 col-sm-12">
                                            <input type="file" name="other_documents">
                                        <?php $__errorArgs = ['other_documents'];
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
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 mt-2 d-flex">
                                        <span>
                                            <input required type="checkbox" value="yes" style="zoom: 2.5; margin-top: -3px !important; margin-left: 0px !important;" name="company_association"
                                            <?php echo e(old('company_association') == 'yes' ? 'checked' : ''); ?> >
                                        </span>

                                        <span class="h6" style="margin-right: 10px !important">
                                            I agree terms and condition 
                                            <a id="vendor-use-terms" href="#">Read Here</a>
                                        </span>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" class="theme-btn btn-style-one">
                                            <span class="txt"><?php echo e(__('fl.Submit')); ?></span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </section>

    
<?php $rec = \App\Models\FrontBanner::where('id', 50)->first(); ?>
<?php if(isset($rec)): ?>

    <div class="modal" id="vendor-use-term-modal" tabindex="-1" role="dialog">
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



    <!--End About Section-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
          $("#email").blur(function(){
            $('#email_error').text("");

            var final = $("#email").val();
                // threefull flag works for both
                $.ajax({
                url: "<?php echo e(url('testUrl')); ?>",
                type: 'GET',
                data:{id: final},
                success:function(response) {     
                
                var cities = response;
                console.log(cities);  
                $('#email_error').text(cities[0].email);
                    
                    if(cities == 1){
                        $('#email_error').text("The Email Is Already Taken");
                        $(':input[type="submit"]').prop('disabled', true);
                        $('html, body').animate({ scrollTop: $('#email_error').offset().top }, 'slow');
                    }else{
                        $('#email_error').text("");
                    }

                }
            });        
            
          });
        });

        $(document).ready(function() {
        $("#vendor-use-terms").click(function(e) {
            e.preventDefault();
            $('#vendor-use-term-modal').modal('show');
        });
        });
        </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/register/vendor-registration.blade.php ENDPATH**/ ?>