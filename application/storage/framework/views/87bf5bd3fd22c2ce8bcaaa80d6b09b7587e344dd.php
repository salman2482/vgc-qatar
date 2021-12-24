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
        .status-img {
            z-index: 1;
            top: 10px !important;
            left: 30px;
            position: absolute;
            display: inline !important;
            width: 145px;
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
            <div class="col-md-6" >
                <div class="auto-container-fluid">
                    <!--Upper Section-->
                    <div class="upper-section">
                        <div class="row clearfix">
                            <!--Image Column-->
                            <div class="image-column col-lg-12 col-md-12 col-sm-12 container-fluid">
                                <div class="inner-column">
                                    <div class="image" style="height: 420px;">
                                            <img 
                                    src="<?php echo e(asset('storage/files/'.$product_attachment->attachment_uniqiueid.'/'.$product_attachment->attachment_filename)); ?>" style="height: 400px" alt="" /> 
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
                        <h2><?php echo e($product->title); ?></h2>
                            <div class="text">
                                <?php echo e($product->description); ?>

                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                
                <section class="case-page-section" style="padding: 30px 0px 0px !important;">
                    <div class="auto-container">
                        <!--MixitUp Galery-->
                        <div class="mixitup-gallery">
                            <div class="filter-list row clearfix">
                                <!--Case block-->
                                <?php if($subproducts): ?>
                                <?php $__empty_1 = true; $__currentLoopData = $subproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subproduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="case-block mix planning col-lg-4 col-md-6 col-sm-12" 
                                    style=" margin-bottom: 0px !important;">
                                        <div class="case-block services-div">
                                            <div class="card text-center">
                                                <?php $__currentLoopData = $subattachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($attachment->attachment_unique_input == 'subproduct' && $attachment->attachmentresource_id == $subproduct->id): ?>

                                                        <img src="<?php echo e(asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename)); ?>"
                                                            class="x-logo justify-content-center" style="background-size: cover;background-position: center; height: 300px;">
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <div class="card-body">
                                                    <h5 ><?php echo e($subproduct->title); ?></h5>

                                                    <p>
                                                        <?php echo e($subproduct->description); ?>

                                                    </p>
                                                    <a href="<?php echo e(route('front.single-subproduct', $subproduct->id)); ?>"
                                                        class="theme-btn btn-style-one">
                                                        <span class="txt">View Details</span>
                                                        <span class="icon flaticon-share-option"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                         <img class="status-img"
                                            src="<?php echo e(asset('storage/public/product_status/' . $subproduct->status . '.png')); ?>"
                                            alt="" style="display:inline !important;">

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <a  class="theme-btn btn-style-one" href="<?php echo e(route('front.contact-us')); ?>" type="submit" class="theme-btn btn-style-one">
                                        <span class="txt"><?php echo e(__('fl.Contact us')); ?></span> 
                                        <span class="icon flaticon-share-option"></span>
                                    </a>
                                <?php endif; ?>
                                
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

            
        </section>
        <!--End Cases Section-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/category-wise-proudcts/detail-product.blade.php ENDPATH**/ ?>