<!--checkbox actions-->
<?php echo $__env->make('pages.careerapply.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--main table view-->
<?php echo $__env->make('pages.careerapply.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.careerapply.components.misc.filter-careersapply', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!--filter--><?php /**PATH H:\wamp64\www\application\resources\views/pages/careerapply/components/table/wrapper.blade.php ENDPATH**/ ?>