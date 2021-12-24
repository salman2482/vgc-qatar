<!DOCTYPE html>
<html>

<head>
    <?php echo $__env->make('front-end.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('styles'); ?>

</head>

<body class="hidden-bar-wrapper">
    <div class="page-wrapper">


        <header class="main-header header-style-two">

            <?php echo $__env->make('front-end.partials.headers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
            <?php echo $__env->make('front-end.partials.navbar.desktop-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
            <?php echo $__env->make('front-end.partials.navbar.sticky-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </header>


        <?php echo $__env->yieldContent('front-end-content'); ?>


        <?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('front-end.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
    <!--End pagewrapper-->

    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-arrow-up"></span></div>

    <!-- Color Palate / Color Switcher -->
    

    <?php echo $__env->make('front-end.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH H:\wamp64\www\application\resources\views/front-end/layouts/master.blade.php ENDPATH**/ ?>