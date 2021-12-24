<!--checkbox actions-->
<?php echo $__env->make('pages.document.components.actions.checkbox-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!--main table view-->
<?php echo $__env->make('pages.document.components.table.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--filter-->
<?php if(auth()->user()->is_team): ?>
<?php echo $__env->make('pages.document.components.misc.filter-properties', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!--filter--><?php /**PATH H:\wamp64\www\application\resources\views/pages/document/components/table/wrapper.blade.php ENDPATH**/ ?>