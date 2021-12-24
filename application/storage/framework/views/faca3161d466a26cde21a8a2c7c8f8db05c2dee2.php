<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('front-end-content'); ?>
    <!--Page Title-->
    <?php if($attachment->attachment_unique_input === 'frontbanner'): ?>
        <img class="img-fluid" src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" style="height: " alt="">
    <?php endif; ?>

    <div class="sidebar-page-container" style="padding: 30px 0px 0px !important;">
        <div class="auto-container">
            <div class="row clearfix">
                <!--Shop Single-->
                <?php if(session()->has('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <?php if(session()->has('error')): ?>
                    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
                <?php endif; ?>
                <div class="col-lg-6 col-sm-12">
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
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 mt-1">
                    <div class="image-box">
                        <iframe width="600" height="413" class="index-iframe" src="https://www.youtube.com/embed/V-_-zAZnmxg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>

                    
                </div>

            </div>

            <!--Content Side-->
            <div class="content-side col-lg-12 col-md-12 col-sm-12 mt-5">
                <div class="shop-section">
                    <div class="our-shops" style="padding-bottom: 0px !important; margin-bottom: 0px !important;">
                        <div class="row clearfix">
                            <!--Shop Item-->
                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="shop-item col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="inner-box">
                                        <div class="image" style="background-color:#fff">
                                            <img src="<?php echo e(asset('storage/public/service_image/' . $item->image)); ?>"
                                                    alt=""
                                                    style="background-size: cover;background-position: center;width:250px;">
                                        </div>
                                        <div class="lower-content clearfix">
                                            <div>
                                                <h6>
                                                    <?php echo e($item->title); ?>

                                                </h6>
                                                <a href="<?php echo e(route('front.service.details', $item->id)); ?>" class="theme-btn btn-style-one p-2 mt-2 "><span class="txt">Book Now</span></a>
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

    </div>
    </div>
   

<?php $__env->stopSection(); ?>


<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/our-services/services.blade.php ENDPATH**/ ?>