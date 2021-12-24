<script src="<?php echo e(asset('public/front-end/js/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('public/front-end/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/front-end/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/front-end/js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/front-end/js/jquery.fancybox.js')); ?>"></script>
<script src="<?php echo e(asset('public/front-end/js/appear.js')); ?>"></script>
<script src="<?php echo e(asset('public/front-end/js/owl.js')); ?>"></script>
<script src="<?php echo e(asset('public/front-end/js/wow.js')); ?>"></script>
<script src="<?php echo e(asset('public/front-end/js/slick.js')); ?>"></script>
<script src="<?php echo e(asset('public/front-end/js/jquery-ui.js')); ?>"></script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
<script src="<?php echo e(asset('public/front-end/js/map-script.js')); ?>"></script>
<script src="<?php echo e(asseT('public/front-end/js/mixitup.js')); ?>"></script>
<script src="<?php echo e(asseT('public/front-end/js/script.js')); ?>"></script>

<script>
        $(document).ready(function() {
        $("#all-rights-reserved").click(function(e) {
            e.preventDefault();
            $('#copyright-policy-modal').modal('show');
        });
    });

    $(document).ready(function() {
        $("#web-use").click(function(e) {
            e.preventDefault();
            $('#web-use-modal').modal('show');
        });
    });

    $(document).ready(function() {
        $("#privacy-policy").click(function(e) {
            e.preventDefault();
            $('#privacy-policy-modal').modal('show');
        });
    });

    $(document).ready(function() {
        $("#cookies-policy").click(function(e) {
            e.preventDefault();
            $('#cookies-policy-modal').modal('show');
        });
    });
</script>
<?php /**PATH H:\wamp64\www\application\resources\views/front-end/partials/scripts.blade.php ENDPATH**/ ?>