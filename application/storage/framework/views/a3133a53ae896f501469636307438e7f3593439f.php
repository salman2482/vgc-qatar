<?php $__env->startSection('styles'); ?>
    <style>
        @media  screen and (max-width: 560px) {
            .partner-block {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }

        @media  screen and (min-width: 600px) {
            .textual-div {
                margin-left: -100px !important;
            }
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('front-end-content'); ?>
    <!--Page Title-->

    <?php if($attachment->attachment_unique_input === 'frontbanner'): ?>
        <img class="img-fluid" src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" style="height: " alt="">
    <?php endif; ?>

    <!--Testimonial Page Section-->
    <section class="partners-page-section" style="padding: 20px 0px 6px !important;">
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
                        <div class="row">
                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="icon col-md-4 p-3">
                                    <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($attachment->attachment_unique_input == 'frontclient'): ?>
                                            <?php if($attachment->attachmentresource_id == $client->id): ?>
                                                
                                                <div class="image-box">
                                                <img src="<?php echo e(asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename)); ?>"
                                                    alt="Client Pic">

                                            </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/our-clients/our-clients.blade.php ENDPATH**/ ?>