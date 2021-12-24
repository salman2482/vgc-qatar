<?php $__env->startSection('styles'); ?>

    <?php echo NoCaptcha::renderJs(); ?>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

    <style>
        .experience-select option {
            font-size: 16px;
        }

        @media  screen and (min-width : 1000px) {
            .div-name {
                display: flex !important;
                margin-bottom: 10px;
            }
        }

        @media  screen and (min-width : 1000px) {
            .mbl-label{
                display: none !important;
            }
            .label3 {
                display: block;
            }
        }
        @media  screen and (max-width : 1000px) {
            .mbl-label{
                display: block !important;
            }
            
            .label3 {
                display: none;
            }
        }
         

        @media  screen and (max-width : 700px) {
            
            .mobile-personal-label {
                display: block !important;
                font-size: 18px;
                background: #f9e7eb;
                line-height: 20px;
                margin: 21px 0px 26px 0px;
                color: #dc3545 !important;
                display: inline-block;
                display: inline-block;
                padding: .25em .4em;
                font-weight: 700;
                border-radius: .25rem;
            }

            .emp-div {
                margin-bottom: 10px;
            }
        }

        form input[type="text"] {
            border: 1px solid #2ECC40 !important
        }

        .einput {
            border: 1px solid #2ECC40 !important
        }

        select {
            border: 1px solid #2ECC40 !important
        }

        label {
            color: black;
            font-family: 'Montserrat', sans-serif !important;
            font-size: 16px
        }

        .docs-ol li {
            list-style-type: decimal !important;
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('front-end-content'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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


                        <div class="text">
                            <div class="contact-form">
                                <form action="<?php echo e(route('careersapply.store')); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="row clearfix">

                                        <?php
                                            $cats = ['ACCOUNTING', 'ADMINISTRATION', 'CIVIL', 'CLEANING', 'DISINFECTION', 'ELECTRICAL', 'ELECTRO-MECHANICAL', 'ELEVATORS', 'ESCALATORS', 'FACILITY MANAGEMENT', 'FINANCE', 'FIRE ALARM', 'FIRE FIGHTING', 'HOSPITALITY', 'HVAC', 'INSURANCE', 'IT', 'JOINERY', 'LOGISTICS', 'MAINTENANCE', 'MANAGEMENT', 'MARKETING', 'MECHANICAL', 'OPERATIONS', 'OTHERS', 'PEST CONTROL', 'PROCUREMENT', 'PROPERTY MANAGEMENT', 'PUBLIC RELATION', 'QUALITY CONTROL', 'QUANTITY SURVEY', 'SALES', 'TRANSPORTATION'];
                                        ?>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="field"><strong><?php echo e(__('fl.Select Field')); ?></strong></label>
                                            <select class="experience-select" name="field">

                                                <?php if($category != ''): ?>
                                                    <option value="<?php echo e($category); ?>" selected><?php echo e($category); ?>

                                                    </option>
                                                <?php else: ?>

                                                    <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php echo e(old('field') == $single ? 'selected' : ''); ?>

                                                            value="<?php echo e($single); ?>"> <?php echo e($single); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php endif; ?>
                                            </select>

                                            <?php $__errorArgs = ['field'];
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

                                        <input type="hidden" name="type"
                                            value="<?php echo e($category ? 'Current Openings' : 'Open Apply'); ?>">

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label><strong><?php echo e(__('fl.Position Applied For')); ?></strong></label>

                                            <?php if($position != ''): ?>
                                                <input type="text" name="position" value="<?php echo e($position); ?>"
                                                 required readonly>

                                            <?php else: ?>
                                                <input type="text" name="position"
                                                    required value="<?php echo e(old('position')); ?>">
                                            <?php endif; ?>
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
                                            <label
                                                for="field"><strong><?php echo e(__('fl.Years Of Experience')); ?></strong></label>
                                            <select name="experience">

                                                <option value="1 Year"
                                                    <?php echo e(old('experience') == '1 Year' ? 'selected' : ''); ?>>1</option>
                                                <option value="2 Years"
                                                    <?php echo e(old('experience') == '2 Years' ? 'selected' : ''); ?>>2</option>
                                                <option value="3 Years"
                                                    <?php echo e(old('experience') == '3 Years' ? 'selected' : ''); ?>>3</option>
                                                <option value="4 Years"
                                                    <?php echo e(old('experience') == '4 Years' ? 'selected' : ''); ?>>4</option>
                                                <option value="5 Years"
                                                    <?php echo e(old('experience') == '5 Years' ? 'selected' : ''); ?>>5</option>
                                                <option value="6 Years"
                                                    <?php echo e(old('experience') == '6 Years' ? 'selected' : ''); ?>>6</option>
                                                <option value="7 Years"
                                                    <?php echo e(old('experience') == '7 Years' ? 'selected' : ''); ?>>7</option>
                                                <option value="8 Years"
                                                    <?php echo e(old('experience') == '8 Years' ? 'selected' : ''); ?>>8</option>
                                                <option value="9 Years"
                                                    <?php echo e(old('experience') == '9 Years' ? 'selected' : ''); ?>>9</option>
                                                <option value="10 Years"
                                                    <?php echo e(old('experience') == '10 Years' ? 'selected' : ''); ?>>
                                                    10
                                                </option>
                                                <option value="More Than 10 Years"
                                                    <?php echo e(old('experience') == 'More Than 10 Years' ? 'selected' : ''); ?>>
                                                    More Than 10 Years
                                                </option>
                                            </select>

                                            <?php $__errorArgs = ['experience'];
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
                                            <label
                                                for="field"><strong><?php echo e(__('fl.Best Time To Receive Calls')); ?></strong></label>
                                            <select class="experience-select" name="time_to_receive_calls">
                                                <option <?php echo e(old('time_to_receive_calls') == 'Morning' ? 'selected' : ''); ?>

                                                    value="Morning">Morning</option>
                                                <option
                                                    <?php echo e(old('time_to_receive_calls') == 'After Noon' ? 'selected' : ''); ?>

                                                    value="After Noon">After Noon</option>
                                                <option <?php echo e(old('time_to_receive_calls') == 'Evening' ? 'selected' : ''); ?>

                                                    value="Evening">Evening</option>
                                            </select>
                                            <?php $__errorArgs = ['time_to_receive_calls'];
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
                                            <label><strong><?php echo e(__('fl.First Name')); ?></strong></label>

                                            <input value="<?php echo e(old('first_name')); ?>" type="text" name="first_name"
                                                 required>
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
                                            <label><strong><?php echo e(__('fl.Middle Name')); ?></strong></label>

                                            <input value="<?php echo e(old('middle_name')); ?>" type="text" name="middle_name"
                                                 required>
                                            <?php $__errorArgs = ['middle_name'];
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
                                            <label><strong><?php echo e(__('fl.Last Name')); ?></strong></label>

                                            <input value="<?php echo e(old('last_name')); ?>" type="text" name="last_name"
                                                 required>
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
                                            <label><strong><?php echo e(__('fl.Date Of Birth')); ?></strong></label>

                                            <input type="text" name="dob" id="dob" 
                                                value="<?php echo e(old('dob')); ?>">
                                            <?php $__errorArgs = ['dob'];
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
                                            <label for="field"><strong><?php echo e(__('fl.Gender')); ?></strong></label>
                                            <select class="experience-select" name="gender">
                                                <option <?php echo e(old('gender') == 'Male' ? 'selected' : ''); ?> value="Male">Male
                                                </option>
                                                <option <?php echo e(old('gender') == 'Female' ? 'selected' : ''); ?> value="Female">
                                                    Female</option>
                                            </select>
                                            <?php $__errorArgs = ['gender'];
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
                                            <label for="field"><strong><?php echo e(__('fl.Marital Status')); ?></strong></label>
                                            <select class="experience-select" name="marital_status">
                                                <option <?php echo e(old('marital_status') == 'Single' ? 'selected' : ''); ?>

                                                    value="Single">Single</option>
                                                <option <?php echo e(old('marital_status') == 'Married' ? 'selected' : ''); ?>

                                                    value="Married">Married</option>
                                            </select>
                                            <?php $__errorArgs = ['marital_status'];
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
                                            <label
                                                for="field"><strong><?php echo e(__('fl.Educational Attainment')); ?></strong></label>
                                            <select class="experience-select" name="education">
                                                <option <?php echo e(old('education') == 'Under Graduate' ? 'selected' : ''); ?>

                                                    value="Under Graduate">
                                                    Under Graduate
                                                </option>
                                                <option <?php echo e(old('education') == 'High School' ? 'selected' : ''); ?>

                                                    value="High School">High School</option>
                                                <option <?php echo e(old('education') == 'College' ? 'selected' : ''); ?>

                                                    value="College">College</option>
                                                <option <?php echo e(old('education') == 'Bachelor’s Degree' ? 'selected' : ''); ?>

                                                    value="Bachelor’s Degree">Bachelor’s
                                                    Degree</option>
                                                <option <?php echo e(old('education') == 'Masters' ? 'selected' : ''); ?>

                                                    value="Masters">Masters</option>
                                                <option <?php echo e(old('education') == 'Doctorate' ? 'selected' : ''); ?>

                                                    value="Doctorate">Doctorate</option>
                                                <option <?php echo e(old('education') == 'N/A' ? 'selected' : ''); ?> value="N/A">N/A
                                                </option>
                                            </select>
                                            <?php $__errorArgs = ['education'];
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
                                            <label><strong><?php echo e(__('fl.Nationality')); ?></strong></label>

                                            <input type="text" name="nationality"  required
                                                value="<?php echo e(old('nationality')); ?>">
                                            <?php $__errorArgs = ['nationality'];
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
                                            <label><strong><?php echo e(__('fl.Other Nationality')); ?></strong></label>

                                            <input type="text" name="other_nationality" 
                                                required value="<?php echo e(old('other_nationality')); ?>">
                                            <?php $__errorArgs = ['other_nationality'];
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
                                            <label><strong><?php echo e(__('fl.Current Country')); ?> </strong></label>

                                            <input type="text" name="current_country" 
                                                required value="<?php echo e(old('current_country')); ?>">
                                            <?php $__errorArgs = ['current_country'];
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
                                            <label><strong><?php echo e(__('fl.Address')); ?></strong></label>

                                            <input type="text" name="address"  required
                                                value="<?php echo e(old('address')); ?>">
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
                                            <label><strong><?php echo e(__('fl.Primary Email')); ?></strong></label>

                                            <input type="email" name="primary_email" class="einput"
                                                 required value="<?php echo e(old('primary_email')); ?>">
                                            <?php $__errorArgs = ['primary_email'];
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
                                            <label><strong><?php echo e(__('fl.Secondary Email')); ?></strong></label>

                                            <input type="email" name="secondary_email" class="einput"
                                                required
                                                value="<?php echo e(old('secondary_email')); ?>">
                                            <?php $__errorArgs = ['secondary_email'];
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
                                            <label><strong><?php echo e(__('fl.Mobile')); ?></strong></label>

                                            <input type="text" name="mobile"  required
                                                value="<?php echo e(old('mobile')); ?>">
                                            <?php $__errorArgs = ['mobile'];
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
                                            <label><strong><?php echo e(__('fl.Land Line')); ?></strong></label>

                                            <input type="text" name="land_line" required
                                                value="<?php echo e(old('land_line')); ?>">
                                            <?php $__errorArgs = ['land_line'];
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
                                            <label>

                                                <strong><?php echo e(__('fl.Why are you leaving your current job (if presently employed)?')); ?></strong>
                                            </label>
                                            <select class="experience-select" name="why_current_job">
                                                <option value="Looking for better job opportunity" <?php echo e(old('why_current_job') == 'Looking for better job opportunity' ? 'selected' : ''); ?>>
                                                    Looking for better job opportunity
                                                </option>

                                                <option value="No growth in my present job" <?php echo e(old('why_current_job') == 'No growth in my present job' ? 'selected' : ''); ?>>
                                                    No growth in my present job
                                                </option>

                                                <option value="Working environment" <?php echo e(old('why_current_job') == 'Working environment' ? 'selected' : ''); ?>>
                                                    Working environment
                                                </option>

                                                <option value="Others" <?php echo e(old('why_current_job') == 'Others' ? 'selected' : ''); ?>>
                                                    Others
                                                </option>

                                            </select>
                                            <?php $__errorArgs = ['why_current_job'];
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
                                            <label>
                                                <strong><?php echo e(__('fl.If you were terminated, what is the reason of termination?')); ?></strong>
                                            </label>
                                            <select class="experience-select" name="termination">
                                                <option <?php echo e(old('termination') == 'End of contract' ? 'selected' : ''); ?> value="End of contract">
                                                    End of contract
                                                </option>

                                                <option value="No business" <?php echo e(old('termination') == 'No business' ? 'selected' : ''); ?>>
                                                    No business
                                                </option>

                                                <option value="Administrative issues" <?php echo e(old('termination') == 'Administrative issues' ? 'selected' : ''); ?>> 
                                                    Administrative issues
                                                </option>

                                                <option value="Others" <?php echo e(old('termination') == 'Others' ? 'selected' : ''); ?>>
                                                    Others
                                                </option>

                                            </select>
                                            <?php $__errorArgs = ['termination'];
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
                                            <label>

                                                <strong><?php echo e(__('fl.Joining Date')); ?>: </strong>
                                            </label>
                                            <select class="experience-select" name="joining_date">
                                                <option value="Immediately" <?php echo e(old('joining_date') == 'Immediately' ? 'selected' : ''); ?>>
                                                    Immediately
                                                </option>

                                                <option value="1 Month Notice" <?php echo e(old('joining_date') == '1 Month Notice' ? 'selected' : ''); ?>>
                                                    1 Month Notice
                                                </option>

                                                <option value="2 Month Notice" <?php echo e(old('joining_date') == '2 Month Notice' ? 'selected' : ''); ?>>
                                                    2 Month Notice
                                                </option>

                                                <option value="3 Month Notice" <?php echo e(old('joining_date') == '3 Month Notice' ? 'selected' : ''); ?>>
                                                    3 Month Notice
                                                </option>

                                            </select>
                                            <?php $__errorArgs = ['joining_date'];
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
                                            <label>
                                                <strong><?php echo e(__('fl.Qatar Governmental Official Permits')); ?> </strong>
                                            </label>
                                            <select class="experience-select" name="governmental_permits">
                                                <option value="Valid RP" <?php echo e(old('governmental_permits') == 'Valid RP' ? 'selected' : ''); ?>>Valid RP
                                                </option>

                                                <option value="InValid RP" <?php echo e(old('governmental_permits') == 'InValid RP' ? 'selected' : ''); ?>>
                                                    InValid RP
                                                </option>

                                                <option value="Work Visa" <?php echo e(old('governmental_permits') == 'Work Visa' ? 'selected' : ''); ?>>
                                                    Work Visa
                                                </option>

                                                <option value="Other Visas" <?php echo e(old('governmental_permits') == 'Other Visas' ? 'selected' : ''); ?>>
                                                    Other Visas
                                                </option>

                                            </select>
                                            <?php $__errorArgs = ['governmental_permits'];
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
                                            <label>

                                                <strong><?php echo e(__('fl.Non Governmental Official Permits')); ?> </strong>
                                            </label>
                                            <select class="experience-select" name="nongovernmental_permits">
                                                <option value="UPDA" <?php echo e(old('nongovernmental_permits') == 'UPDA' ? 'selected' : ''); ?>>
                                                    UPDA
                                                </option>

                                                <option value="QCDD" <?php echo e(old('nongovernmental_permits') == 'QCDD' ? 'selected' : ''); ?>>
                                                    QCDD
                                                </option>
                                                <option value="Others" <?php echo e(old('nongovernmental_permits') == 'Others' ? 'selected' : ''); ?>>
                                                    Others
                                                </option>
                                                

                                            </select>
                                            <?php $__errorArgs = ['nongovernmental_permits'];
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
                                            <label>
                                                <strong><?php echo e(__('fl.Licences')); ?> </strong>
                                            </label>
                                            <select class="experience-select" name="license">
                                                <option value="Qatar Driving Licence" <?php echo e(old('license') == 'Qatar Driving Licence' ? 'selected' : ''); ?>> 
                                                    Qatar Driving Licence
                                                </option>

                                                <option value="GCC Driving Licence" <?php echo e(old('license') == 'GCC Driving Licence' ? 'selected' : ''); ?>>
                                                    GCC Driving Licence
                                                </option>
                                                <option value="Others" <?php echo e(old('license') == 'Others' ? 'selected' : ''); ?>>
                                                    Others
                                                </option>

                                            </select>
                                            <?php $__errorArgs = ['license'];
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
                                            <label>

                                                <strong><?php echo e(__('fl.Certificates')); ?> </strong>
                                            </label>
                                            <select class="experience-select" name="certificate">
                                                <option value="NEBOSH" <?php echo e(old('certificate') == 'NEBOSH' ? 'selected' : ''); ?>>
                                                    NEBOSH
                                                </option>

                                                <option value="IOSH" <?php echo e(old('certificate') == 'IOSH' ? 'selected' : ''); ?>>
                                                    IOSH
                                                </option>

                                                <option value="IMS" <?php echo e(old('certificate') == 'GCC Driving Licence' ? 'selected' : ''); ?>>
                                                    IMS
                                                </option>

                                                <option value="ISO" <?php echo e(old('certificate') == 'ISO' ? 'selected' : ''); ?>>
                                                    ISO
                                                </option>

                                                <option value="ISO AUDITOR" <?php echo e(old('certificate') == 'ISO AUDITOR' ? 'selected' : ''); ?>>
                                                    ISO AUDITOR
                                                </option>

                                                <option value="IRATA" <?php echo e(old('certificate') == 'IRATA' ? 'selected' : ''); ?>>
                                                    IRATA
                                                </option>

                                                <option value="BICSc" <?php echo e(old('certificate') == 'BICSc' ? 'selected' : ''); ?>>
                                                    BICSc
                                                </option>

                                                <option value="CMC/CMCI" <?php echo e(old('certificate') == 'CMC/CMCI' ? 'selected' : ''); ?>>
                                                    CMC/CMCI
                                                </option>
                                                <option value="Others" <?php echo e(old('certificate') == 'Others' ? 'selected' : ''); ?>>
                                                    Others
                                                </option>

                                            </select>
                                            <?php $__errorArgs = ['certificate'];
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
                                            <label>

                                                <strong><?php echo e(__('fl.NOC Availability')); ?>: </strong>
                                            </label>
                                            <select class="experience-select" name="noc">
                                                <option value="Yes" <?php echo e(old('noc') == 'Yes' ? 'selected' : ''); ?>>
                                                    Yes
                                                </option>

                                                <option value="No" <?php echo e(old('noc') == 'No' ? 'selected' : ''); ?>>
                                                    No
                                                </option>

                                                <option value="Secondment" <?php echo e(old('noc') == 'Secondment' ? 'selected' : ''); ?>>
                                                    Secondment
                                                </option>

                                            </select>
                                            <?php $__errorArgs = ['noc'];
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
                                            <label>
                                                <strong><?php echo e(__('fl.Expected monthly salary in QAR')); ?>:</strong>
                                            </label>
                                            <select class="experience-select" name="expected_salary">
                                                <option value="1000 To 2000 QAR" <?php echo e(old('expected_salary') == '1000 To 2000 QAR' ? 'selected' : ''); ?>>  
                                                    1000 To 2000 QAR
                                                </option>

                                                <option value="2000 To 3500 QAR" <?php echo e(old('expected_salary') == '2000 To 3500 QAR' ? 'selected' : ''); ?>>
                                                    2000 To 3500 QAR
                                                </option>

                                                <option value="3500 To 5500 QAR" <?php echo e(old('expected_salary') == '3500 To 5500 QAR' ? 'selected' : ''); ?>>
                                                    3500 To 5500 QAR
                                                </option>

                                                <option value="5500 To 7500 QAR" <?php echo e(old('expected_salary') == '5500 To 7500 QAR' ? 'selected' : ''); ?>>
                                                    5500 To 7500 QAR
                                                </option>

                                                <option value="7500 To 10000 QAR" <?php echo e(old('expected_salary') == '7500 To 10000 QAR' ? 'selected' : ''); ?>>
                                                    7500 To 10000 QAR
                                                </option>

                                                <option value="10000 To 15000 QAR" <?php echo e(old('expected_salary') == '10000 To 15000 QAR' ? 'selected' : ''); ?>>
                                                    10000 To 15000 QAR
                                                </option>

                                                <option value="15000 To 25000 QAR" <?php echo e(old('expected_salary') == '15000 To 25000 QAR' ? 'selected' : ''); ?>>
                                                    15000 To 25000 QAR
                                                </option>

                                                <option value="Others" <?php echo e(old('expected_salary') == 'Others' ? 'selected' : ''); ?>>
                                                    Others
                                                </option>

                                            </select>
                                            <?php $__errorArgs = ['expected_salary'];
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
                                            <label>

                                                <strong><?php echo e(__('fl.Do you have any objection if we contact your previous employer(s) for reference checking?')); ?></strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <select class="experience-select" name="objections">
                                                <option value="I disagree that you contact my employer." <?php echo e(old('objections') == 'I disagree that you contact my employer.' ? 'selected' : ''); ?>>
                                                    I disagree that you contact my employer.
                                                </option>

                                                <option value="I agree that you contact my employer." 
                                                <?php echo e(old('objections') == 'I agree that you contact my employer.' ? 'selected' : ''); ?>>
                                                    I agree that you contact my employer.
                                                </option>
                                            </select>
                                        </div>
                                        <?php $__errorArgs = ['objections'];
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
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12"></div>



                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label>

                                            <strong> <?php echo e(__('fl.Mention your last 3 employers')); ?> </strong>
                                        </label>
                                    </div>

                                    
                                    <div class="div-name text-center">
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mobile-personal-label text-center" style="display: none;">
                                                <?php echo e(__('fl.First Employer Record')); ?>

                                            </label>
                                            <label class="label3"><strong><?php echo e(__('fl.Employers')); ?></strong></label>
                                            <label class="mbl-label">Employer</label>
                                            <input type="text" name="employer_1"   value="<?php echo e(old('employer_1')); ?>">
                                            <?php $__errorArgs = ['employer_1'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="label3"><strong><?php echo e(__('fl.Department')); ?></strong></label>
                                            <label class="mbl-label">Department</label>
                                            <input type="text" name="department_1"   value="<?php echo e(old('department_1')); ?>">
                                            <?php $__errorArgs = ['department_1'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="label3"><strong><?php echo e(__('fl.Designation')); ?></strong></label>
                                            <label class="mbl-label">Designation</label>
                                            <input type="text" name="designation_1"   
                                            value="<?php echo e(old('designation_1')); ?>">
                                            <?php $__errorArgs = ['designation_1'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label
                                                class="label3"><strong><?php echo e(__('fl.In line Manager')); ?></strong></label>
                                            <label class="mbl-label">In Line Manager</label>
                                            <input type="text" name="in_line_manager_1"  
                                            value="<?php echo e(old('in_line_manager_1')); ?>">
                                            <?php $__errorArgs = ['in_line_manager_1'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label
                                                class="label3"><strong><?php echo e(__('fl.Service Duration')); ?></strong></label>
                                            <label class="mbl-label">Service Duration</label>
                                            <input type="text" name="service_duration_1" 
                                                 value="<?php echo e(old('service_duration_1')); ?>">
                                            <?php $__errorArgs = ['service_duration_1'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="label3"><strong><?php echo e(__('fl.Salary')); ?> (QAR)</strong></label>
                                            <label class="mbl-label">Salary</label>
                                            <input type="text" name="salary_1"  
                                            value="<?php echo e(old('salary_1')); ?>">
                                            <?php $__errorArgs = ['salary_1'];
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


                                    
                                    <div class="div-name text-center">
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label
                                                class="badge-font badge bg-light-danger text-danger mobile-personal-label text-center"
                                                style="display: none;">
                                                <?php echo e(__('fl.Second Employer Record')); ?>

                                            </label>
                                            <label class="mbl-label">Employer</label>
                                            <input type="text" name="employer_2"   
                                            value="<?php echo e(old('employer_2')); ?>">
                                            <?php $__errorArgs = ['employer_2'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Department</label>
                                            <input type="text" name="department_2"  
                                            value="<?php echo e(old('department_2')); ?>">
                                            <?php $__errorArgs = ['department_2'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Designation</label>
                                            <input type="text" name="designation_2"  
                                            value="<?php echo e(old('designation_2')); ?>">
                                            <?php $__errorArgs = ['designation_2'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mbl-label">In Line Manager</label>
                                            <input type="text" name="in_line_manager_2"  
                                            value="<?php echo e(old('in_line_manager_2')); ?>">
                                            <?php $__errorArgs = ['in_line_manager_2'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Service Duration</label>
                                        <input type="text" name="service_duration_2" 
                                                 value="<?php echo e(old('service_duration_2')); ?>">
                                            <?php $__errorArgs = ['service_duration_2'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Salary</label>
                                        <input type="text" name="salary_2"  value="<?php echo e(old('salary_2')); ?>">
                                            <?php $__errorArgs = ['salary_2'];
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


                                    
                                    <div class="div-name text-center">
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mobile-personal-label text-center" style="display: none;">
                                                <?php echo e(__('fl.Third Employer Record')); ?>

                                            </label>
                                            <label class="mbl-label">Employer</label>
                                            <input type="text" name="employer_3"   value="<?php echo e(old('employer_3')); ?>">
                                            <?php $__errorArgs = ['employer_3'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Department</label>
                                            <input type="text" name="department_3"   value="<?php echo e(old('department_3')); ?>">
                                            <?php $__errorArgs = ['department_3'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Designation</label>
                                        <input type="text" name="designation_3"   value="<?php echo e(old('designation_3')); ?>">
                                            <?php $__errorArgs = ['designation_3'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <label class="mbl-label">In Line Manager</label>
                                        <input type="text" name="in_line_manager_3"   value="<?php echo e(old('in_line_manager_3')); ?>">
                                            <?php $__errorArgs = ['in_line_manager_3'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Service Duration</label>
                                        <input type="text" name="service_duration_3"   value="<?php echo e(old('service_duration_3')); ?>">
                                            <?php $__errorArgs = ['service_duration_3'];
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
                                        <div class="emp-div col-lg-2 col-md-6 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Salary</label>
                                            <input type="text" name="salary_3"  value="<?php echo e(old('salary_3')); ?>">
                                            <?php $__errorArgs = ['salary_3'];
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
                                        <label>

                                            <strong>
                                        <?php echo e(__('fl.Please list down at least three (3) personal references:')); ?>

                                            </strong>
                                        </label>
                                    </div>

                                    
                                    <div class="div-name">
                                        <label class="mobile-personal-label text-center" style="display: none;">
                                            <?php echo e(__('fl.First Personal Reference')); ?>

                                        </label>
                                        <div class="text-center emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="label3"><strong><?php echo e(__('fl.Name')); ?></strong></label>

                                            <label class="mbl-label">Reference Name</label>
                                            <input type="text" name="references_name_1"  value="<?php echo e(old('references_name_1')); ?>">
                                            <?php $__errorArgs = ['references_name_1'];
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
                                        <div class="text-center emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="label3"><strong><?php echo e(__('fl.Contact No')); ?></strong></label>
                                            <label class="mbl-label">Contact No</label>
                                            <input type="text" name="references_contact_1" 
                                                 value="<?php echo e(old('references_contact_1')); ?>">
                                            <?php $__errorArgs = ['references_contact_1'];
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
                                        <div class="text-center emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="label3"><strong><?php echo e(__('fl.Email')); ?></strong></label>
                                            
                                            <label class="mbl-label">Email</label>
                                            <input type="text" name="references_email_1"  value="<?php echo e(old('references_email_1')); ?>">
                                            <?php $__errorArgs = ['references_email_1'];
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
                                        <div class="text-center emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="label3">
                                                <strong><?php echo e(__('fl.Relationship')); ?></strong>
                                            </label>

                                            <label class="mbl-label">Relationship</label>
                                            <input type="text" name="references_relationship_1"
                                                 value="<?php echo e(old('references_relationship_1')); ?>">
                                            <?php $__errorArgs = ['references_relationship_1'];
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


                                    
                                    <div class="div-name text-center">
                                        <label class="mobile-personal-label text-center" style="display: none;">
                                            <?php echo e(__('fl.Second Personal Reference')); ?>

                                        </label>
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Reference Name</label><input type="text" name="references_name_2"   value="<?php echo e(old('references_name_2')); ?>">
                                            <?php $__errorArgs = ['references_name_2'];
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
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Contact No</label><input type="text" name="references_contact_2" 
                                                 value="<?php echo e(old('references_contact_2')); ?>">
                                            <?php $__errorArgs = ['references_contact_2'];
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
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Email</label><input type="text" name="references_email_2"   value="<?php echo e(old('references_email_2')); ?>">
                                            <?php $__errorArgs = ['references_email_2'];
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
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                        <label class="mbl-label">Relationship</label><input type="text" name="references_relationship_2"
                                                  value="<?php echo e(old('references_relationship_2')); ?>">
                                            <?php $__errorArgs = ['references_relationship_2'];
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


                                    
                                    <div class="div-name text-center">
                                        <label class="mobile-personal-label text-center" style="display: none;">
                                            <?php echo e(__('fl.Third Personal Reference')); ?>

                                        </label>
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Reference Name</label><input type="text" name="references_name_3"  value="<?php echo e(old('references_name_3')); ?>">
                                            <?php $__errorArgs = ['references_name_3'];
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
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Contact No</label><input type="text" name="references_contact_3" 
                                                 value="<?php echo e(old('references_contact_3')); ?>">
                                            <?php $__errorArgs = ['references_contact_3'];
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
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Email</label><input type="text" name="references_email_3"   value="<?php echo e(old('references_email_3')); ?>">
                                            <?php $__errorArgs = ['references_email_3'];
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
                                        <div class="emp-div col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <label class="mbl-label">Relationship</label><input type="text" name="references_relationship_3"
                                                  value="<?php echo e(old('references_relationship_3')); ?>">
                                            <?php $__errorArgs = ['references_relationship_3'];
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
                                        <label>

                                            <strong><?php echo e(__('fl.Kindly note that you are obliged to provide us with the following documents in case you are nominated or selected for the job you are applying for:')); ?>

                                            </strong>
                                        </label>
                                        <ol class="docs-ol ml-4">
                                            <li>
                                                <?php echo e(__('fl.last 3 months earned salary proof, (i.e. payslip, bank statement etc.)')); ?>

                                            </li>
                                            <li><?php echo e(__('fl.Working experience certificates.')); ?></li>
                                            <li><?php echo e(__('fl.Attested copy of educational certificates.')); ?></li>
                                            <li>
                                                <?php echo e(__('fl.If you are Terminated from Job termination letter Copy to be submitted')); ?>

                                            </li>
                                        </ol>
                                        <?php $__errorArgs = ['joining_date'];
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
                                        <label><strong><?php echo e(__('fl.Upload Updated Resume')); ?></strong> </label>
                                        <input type="file" name="updated_resume" id="updated_resume" style="display: block" required>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label><strong><?php echo e(__('fl.Upload Certificates')); ?></strong></label>
                                        <input type="file" name="certficates" id="certficates" style="display: block" required>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label><strong><?php echo e(__('fl.Upload Others')); ?></strong></label>
                                        <input type="file" name="other_doc" id="other_doc" style="display: block">
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <span>
                                            <input type="checkbox"  required style="zoom: 2; position: absolute; ">
                                            <span style="font-size: 18px; margin-left: 30px">
                                                <?php echo e(__('fl.I hereby certify that all the submitted information and documents are true.')); ?>

                                            </span>
                                        </span>
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

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <button type="submit" class="theme-btn btn-style-one">
                                            <span class="txt"><?php echo e(__('fl.Submit')); ?></span>
                                            <span class="icon flaticon-share-option"></span>
                                        </button>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--End About Section-->


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $("#dob").flatpickr({
            dateFormat: "Y-m-d",
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/careers/career-apply.blade.php ENDPATH**/ ?>