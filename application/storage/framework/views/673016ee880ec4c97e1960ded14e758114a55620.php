<?php $__env->startSection('front-end-content'); ?>

<?php if($attachment->attachment_unique_input === 'frontbanner'): ?>
        <img class="img-fluid" src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" style="height: " alt="">
    <?php endif; ?>

   <!--Sidebar Page Container-->
<div class="sidebar-page-container" style="padding: 15px 0px 0px !important;">
    <div class="auto-container">
        <div class="sec-title">
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
        <div class="row clearfix">
            
            <!--Content Side-->
            <div class="content-side col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 10px !important;">
                <!--Blog List-->
                <div class="blog-list">
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="news-block-two">
                        <div class="inner-box" style="overflow: hidden !important;">
                            <div class="row clearfix">
                                <!--Image Column-->
                                <div class="image-column col-lg-3 col-md-6 col-sm-12">
                                    <div class="image">
                                        <a >
                                            <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($attachment->attachment_unique_input == 'frontproject'): ?> 
                                            <?php if($attachment->attachmentresource_id == $project->id): ?>
                                                <img src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" alt="Project Pic" style="width: 300px !important"/>
                                            </ul>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </a>
                                        <ul class="category">
                                            <li><a >Project</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--Content Column-->
                                <div class="content-column col-lg-3 col-md-6 col-sm-12">
                                    <div class="inner-column">
                                        <h6>  Title : <?php echo e($project->title); ?> </h6>
                                        
                                        <div class="author">
                                            Contractor : <?php echo e($project->contractor); ?>

                                        </div>
                                        <div class="author">
                                            Client : <?php echo e($project->client); ?>

                                        </div>
                                        <div class="author">
                                            Status : <?php echo e($project->status); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alrifaig/public_html/application/resources/views/front-end/our-projects/our-projects.blade.php ENDPATH**/ ?>