 
<?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--admin dashboard-->
    <?php if(auth()->user()->is_team): ?>
    <?php if(auth()->user()->is_admin): ?>
    
    <?php else: ?>
    
    <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->user()->is_client): ?>
    <?php echo $__env->make('pages.home.client.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>



</div>
<!--main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\wamp64\www\application\resources\views/pages/home/home.blade.php ENDPATH**/ ?>