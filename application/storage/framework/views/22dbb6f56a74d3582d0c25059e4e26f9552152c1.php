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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/vision-mission/vision-mission.blade.php ENDPATH**/ ?>