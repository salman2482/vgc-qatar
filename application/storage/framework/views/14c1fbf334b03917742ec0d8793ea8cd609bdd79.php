<?php $__env->startSection('styles'); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

    <style>
        .apply-button {
            background-color: #2ECC40 !important;
            color: white;
        }

        .card-text {
            font-family: 'Montserrat', sans-serif !important;
            font-size: 16px
        }

    </style>
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

                        <div class="row">

                            <?php $__currentLoopData = $careers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $career): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-md-4 col-sm-4 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title" style="color: #2ECC40!important;"><?php echo e($career->title); ?>

                                            </h5>
                                            <p class="card-text">
                                                <strong><?php echo e(__('fl.Position')); ?> : </strong><?php echo e($career->position); ?>

                                            </p>
                                            <p class="card-text">
                                                <strong><?php echo e(__('fl.Experience')); ?> : </strong><?php echo e($career->experience); ?>

                                            </p>

                                            <p class="card-text">
                                                <strong><?php echo e(__('fl.Category')); ?> : </strong><?php echo e($career->category); ?>

                                            </p>

                                            

                                            <a href="<?php echo e(url('/career/apply/now/' . $career->category . '/' . $career->position)); ?>"
                                                class="btn apply-button">
                                                <?php echo e(__('fl.Apply Now')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/careers/career-current-openning.blade.php ENDPATH**/ ?>