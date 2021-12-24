<?php $__env->startSection('styles'); ?>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Ubuntu" rel="stylesheet">
    <style>
        .services-div {
            padding: 10px;
            margin-left: 10px;
        }

        .card-title {
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-text {
            line-height: 20px;
            height: 160px;
            overflow: hidden;
            margin-top: 45px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('front-end-content'); ?>

<?php if($attachment->attachment_unique_input === 'frontbanner'): ?>
        <img class="img-fluid" src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" style="height: " alt="">
    <?php endif; ?>

</section>
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

                            <section class="case-page-section" style="padding: 0px !important;">
                                <div class="auto-container">
                                    <!--MixitUp Galery-->
                                    <div class="mixitup-gallery">
                                        <div class="filter-list row clearfix">
                                            <!--Case block-->
                                            <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <div class="case-block mix planning col-lg-4 col-md-6 col-sm-12" style="margin-bottom: 0px !important;">
                                                    <div class="case-block services-div">
                                                        <div class="card text-center">
                                                            <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php if($attachment->attachment_unique_input === 'corporateservice'): ?>
                                                                <?php if($attachment->attachmentresource_id == $service->id): ?>
                                                                <div class="image">
                                                                    <img src="<?php echo e(asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename)); ?>"
                                                                        class="" style="background-size: cover;background-position: center;height:230px;">
                                                                        </div>
                                                                        <?php endif; ?>
                                                                        <?php endif; ?>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <div >
                                                                <h5 class="card-title"><?php echo e($service->title); ?></h5>

                                                                <p >
                                                                    <?php echo str_limit($service->description, 400); ?>

                                                                </p>
                                                    <a href="<?php echo e(route('front.single-corporate-services',$service->id )); ?>"
                                                                    class="theme-btn btn-style-one">
                                                                    <span class="txt">View Details</span> 
                                                                    <span class="icon flaticon-share-option"></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <a  class="theme-btn btn-style-one" href="<?php echo e(route('front.contact-us')); ?>" type="submit" class="theme-btn btn-style-one">
                                                    <span class="txt"><?php echo e(__('fl.Contact us')); ?></span> 
                                                    <span class="icon flaticon-share-option"></span>
                                                </a>
                                            <?php endif; ?>

                                        </div>
                                    </div>

                                </div>
                            </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/corporate-services/corporate-services.blade.php ENDPATH**/ ?>