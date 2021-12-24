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
        @media  only screen and (min-width: 1000px) {
          .case-single-section {
            width: 82.3rem; margin: 0 auto;
            }
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('front-end-content'); ?>
    
        <!--Cases Section-->
        <section class="case-single-section row p-2" >
            <div class="col-md-6">
                <div class="auto-container-fluid">
                    <!--Upper Section-->
                    <div class="upper-section">
                        <div class="row clearfix">
                            <!--Image Column-->
                            <div class="image-column col-lg-12 col-md-12 col-sm-12 container-fluid">
                                <div class="inner-column">
                                    <div class="image" style="height: 420px;">
                                        <?php $__currentLoopData = $subattachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($attachment->attachment_unique_input === 'subproduct'): ?>
                                                <img src="<?php echo e(asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename)); ?>" style="height: 400px"> 
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="auto-container p-4 ">
                    <!--Lower Section-->
                    <div class="lower-section">
                        <h2><?php echo e($subproduct->title); ?></h2>
                        <h4> Product : 
                            <a href="<?php echo e(route('front.product.details', $subproduct->fproduct->id)); ?>">
                                <?php echo e($subproduct->fproduct->title ?? ''); ?></a>
                        </h4>
                            <div class="text">
                                <?php echo e($subproduct->description); ?>

                            </div>
                    </div>
                </div>
            </div>
        
        </section>
        <!--End Cases Section-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/category-wise-proudcts/subproduct-details.blade.php ENDPATH**/ ?>