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
                                <h2><?php echo e(__('fl.Category')); ?> : <?php echo $banner->title_ar; ?></h2>
                            <?php else: ?>
                                <h2><?php echo e(__('fl.Category')); ?> : <?php echo $banner->title; ?></h2>
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
                    <!--MixitUp Galery-->
                    <div class="mixitup-gallery">
                        <!--Filter-->
                        <div class="filters clearfix">
                            <div class="filter-list row clearfix">
                                <!--Case block-->
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="case-block mix planning col-lg-4 col-md-4 col-sm-12 mb-2">
                                        <div class="inner-box" style="overflow: hidden !important;">
                                            <div class="image">
                                                <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($attachment->attachment_unique_input == 'fproduct'): ?>
                                                        <?php if($attachment->attachmentresource_id == $product->id): ?>
                                                            <img style="position: relative"
                                                                src="<?php echo e(asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename)); ?>"
                                                                style="height:400px; width:570px" alt="Product Pic" />

                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <div class="overlay-box">
                                                    <div class="overlay-inner">
                                                        <div class="content">
                                                            <h3>
                                                                <a
                                                                    href="<?php echo e(route('front.product.details', $product->id)); ?>"><?php echo e($product->title); ?></a>
                                                            </h3>
                                                            <div class="text">
                                                                <?php echo e($product->description); ?>

                                                            </div>
                                                            <a href="<?php echo e(route('front.product.details', $product->id)); ?>"
                                                                class="btn btn-veteran read-more">View Details
                                                                <span class="fa fa-long-arrow-right"></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

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

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/category-wise-proudcts/category-wise-proudcts.blade.php ENDPATH**/ ?>