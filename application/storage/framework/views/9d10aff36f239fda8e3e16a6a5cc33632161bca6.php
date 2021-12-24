<?php $__env->startSection('styles'); ?>
<style>
    .a li{
        list-style: circle;
        margin-left: 15px;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('front-end-content'); ?>

<?php if($attachment->attachment_unique_input === 'frontbanner'): ?>
        <img class="img-fluid" src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" style="height: " alt="">
    <?php endif; ?>


<!--Testimonial Page Section-->
<section class="partners-page-section" style="padding: 20px 0px 20px !important;">
    <div class="auto-container">
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
</section>
<!--End Market Section-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/our-policies/health-safety-policy/health-safety-policy.blade.php ENDPATH**/ ?>