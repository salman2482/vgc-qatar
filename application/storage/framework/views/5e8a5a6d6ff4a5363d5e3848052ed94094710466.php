<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(asset('public/front-end/css/owl.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('front-end-content'); ?>

<?php if($attachment->attachment_unique_input === 'frontbanner'): ?>
<img class="img-fluid" src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" style="height: " alt="">
<?php endif; ?>
    

    <section class="shop-single-section">
        <h2 class="text-muted text-center mb-5">Property Details</h2>
        <div class="auto-container">
            <?php
                $attachments = explode(',', $property->images);
            ?>
            <!--Shop Single-->
            <div class="shop-page product-details">

                <!--Basic Details-->
                <div class="basic-details">
                    <div class="row clearfix">

                        <div class="image-column col-lg-7 col-md-12 col-sm-12">
                            <div class="carousel-outer">
                                <ul class="image-carousel owl-carousel owl-theme">
                                    <?php if(isset($attachments)): ?>
                                        <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <a href="<?php echo e(asset('storage/public/frontuser/' . $attachment)); ?>"
                                                    class="lightbox-image" title="Image Caption Here">
                                                    <img src="<?php echo e(asset('storage/public/frontuser/' . $attachment)); ?>"
                                                        alt="">
                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>

                                <ul class="thumbs-carousel owl-carousel owl-theme">
                                    <?php if(isset($attachments)): ?>
                                        <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><img src="<?php echo e(asset('storage/public/frontuser/' . $attachment)); ?>" alt="">
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>

                            </div>
                        </div>

                        <!--Info Column-->
                        <div class="info-column col-lg-5 col-md-12 col-sm-12">
                            <div class="details-header">
                                <h2><?php echo e($property->title); ?></h2>
                                <div class="item-price">Price: <?php echo e($property->price); ?> QAR</div>
                                <div class="item-price" style="font-size:21px;">Reference no:
                                    <?php echo e($property->reference_no); ?></div>
                                <div class="item-price" style="font-size:21px;">Builtup Area:
                                    <?php echo e($property->builtup_area); ?> Sq.Mts</div>
                                <div class="item-price" style="font-size:21px;">Property Type:
                                    <?php echo e($property->property_type); ?></div>
                                <div class="item-price" style="font-size:21px;">Rent Or Sale:
                                    <?php echo e($property->rent_or_sale); ?></div>
                                <div class="item-price" style="font-size:21px;">Community: <?php echo e($property->community); ?>

                                </div>
                                <div class="item-price" style="font-size:21px;">Sub Community:
                                    <?php echo e($property->sub_community); ?></div>
                                <div class="item-price" style="font-size:21px;">Bedrooms: <?php echo e($property->bedroom); ?></div>
                                <div class="item-price" style="font-size:21px;">Parking : <?php echo e($property->parking); ?></div>
                                <div class="item-price" style="font-size:21px;">Primary Unit View :
                                    <?php echo e($property->primary_unit_view); ?></div>
                            </div>

                        </div>

                    </div>
                </div>
                <!--Basic Details-->
                <?php
                    $amminities = explode(',', $property->amminities);
                ?>

                <!--Product Info Tabs-->
                <div class="product-info-tabs">
                    <!--Product Tabs-->
                    <div class="prod-tabs tabs-box">

                        <!--Tab Btns-->
                        <ul class="tab-btns tab-buttons clearfix">
                            <li data-tab="#prod-details" class="tab-btn active-btn">Description</li>
                            <li data-tab="#prod-info" class="tab-btn">Additional Information</li>
                        </ul>

                        <!--Tabs Container-->
                        <div class="tabs-content">

                            <!--Tab / Active Tab-->
                            <div class="tab active-tab" id="prod-details" style="display: block;">
                                <div class="content">
                                    <p><?php echo e($property->description); ?></p>
                                </div>
                            </div>

                            <!--Tab / Active Tab-->
                            <div class="tab" id="prod-info" style="display: none;">
                                <div class="content">
                                    <div class="row mb-3">
                                        <div class="col-md-8 col-sm-12 col-lg-8">
                                            <h5>Contact Details</h5>
                                            <ul class="list-group">
                                                <li class="list-group-item"><span class="text-info">Name</span> :
                                                    <?php echo e($property->user->first_name ?? 'no data'); ?></li>
                                                <li class="list-group-item"><span class="text-info">Email</span> :
                                                    <?php echo e($property->user->email ?? 'no data'); ?></li>
                                                <li class="list-group-item disabled"><span class="text-info">Phone</span> :
                                                    <?php echo e($property->user->phone ?? 'no data'); ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5>Amminities</h5><br>
                                    <div class="row">
                                        <?php $__currentLoopData = $amminities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-6 col-xs-12 col-sm-12">
                                                <div class="my-2">
                                                    <img src="https://www.bhomesqatar.com/images/check.png" alt="">
                                                    <?php echo e($item); ?>

                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!--End Product Info Tabs-->

            </div>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/properties-managment/detail-property.blade.php ENDPATH**/ ?>