<?php $__env->startSection('styles'); ?>
<style>
    @media  screen and (min-width: 800px){
        .mt-1{
            margin-top: 95px !important;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('front-end-content'); ?>

<?php if($attachment->attachment_unique_input === 'frontbanner'): ?>
        <img class="img-fluid" src="<?php echo e(asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename)); ?>" style="height: " alt="">
    <?php endif; ?>

    <!--About Section-->
    <section class="about-section">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Column-->
                <div class="content-column col-lg-6 col-md-6 col-sm-12">
                    <div class="inner-column">
                        <?php if(session()->has('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                                <strong><?php echo e(session()->get('success')); ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
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

                        <div class="row">
                             <div class="col-lg-6 col-md-6 col-sm-12 p-1">
                                <div class="card" >
                                    <div class="card-body">
                                      <h5 class="card-title"><?php echo e(__('fl.Career Apply')); ?></h5>
                                      <p class="card-text"><?php echo e(__('fl.APPLY NOW')); ?></p>
                                      <a href="<?php echo e(route('front.careerApply')); ?>" 
                                      style="font-size: 14px" class="theme-btn btn-style-one">
                                        <span class="txt"><?php echo e(__('fl.APPLY NOW')); ?></span> 
                                    </a>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 p-1">
                                <div class="card" >
                                    <div class="card-body">
                                      <h5 class="card-title"><?php echo e(__('fl.Career Apply')); ?></h5>
                                      <p class="card-text"><?php echo e(__('CURRENT OPENINGS')); ?></p>
                                      <a href="<?php echo e(route('front.careerOpenings')); ?>" 
                                      style="font-size: 14px" class="theme-btn btn-style-one">
                                        <span class="txt"><?php echo e(__('CURRENT OPENINGS')); ?></span> 
                                    </a>
                                    </div>
                                  </div>
                            </div> 
                             
                        </div>

                    </div>
                </div>
                
                <div class="col-md-6 col-lg-6 col-sm-12 mt-1">
                    <div class="image-box">
                        <iframe width="600" height="413" class="index-iframe" src="https://www.youtube.com/embed/WDX0wGmN9x8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    // trustech
      $(document).ready(function() {
      $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
      $("#success-alert").slideUp(500);
    });
  });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front-end.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\wamp64\www\application\resources\views/front-end/careers/career.blade.php ENDPATH**/ ?>