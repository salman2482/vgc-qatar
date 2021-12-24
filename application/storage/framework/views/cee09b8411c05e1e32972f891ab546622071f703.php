<?php $__currentLoopData = $careersapply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $careerapply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<tr id="careerapply_<?php echo e($careerapply->id); ?>">
    <td class="careersapply_col_id">
        <?php echo e($careerapply->id); ?>

    </td>
    <td class="careersapply_col_type">
        <?php echo e($careerapply->type); ?>

    </td>
    <td class="careersapply_col_field">
        <?php echo e(str_limit($careerapply->field, 20)); ?>

    </td>
    <td class="careersapply_col_first_name">
        <?php echo e(str_limit($careerapply->first_name.' '.$careerapply->last_name, 20)); ?>

    </td>
    <td class="careersapply_col_primary_email	">
        <?php echo e(str_limit($careerapply->primary_email	, 20)); ?>

    </td>
    <td class="careersapply_col_mobile	">
        <?php echo e(str_limit($careerapply->mobile	, 20)); ?>

    </td>
    <td class="careersapply_col_education	">
        <?php echo e(str_limit($careerapply->education	, 20)); ?>

    </td>
    <td class="careersapply_col_nationality	">
        <?php echo e(str_limit($careerapply->nationality	, 20)); ?>

    </td>

    <td class="careersapply_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
          
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                data-ajax-type="DELETE" data-url="<?php echo e(url('/')); ?>/careersapply/<?php echo e($careerapply->id); ?>">
                <i class="sl-icon-trash"></i>
            </button>
            
            <!--[edit]-->
            <a href="<?php echo e(route('careersapply.show', $careerapply->id)); ?>" class="btn btn-outline-info btn-circle btn-sm">
                <i class="ti-new-window"></i>
            </a>
            
        
        </span>
    
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH H:\wamp64\www\application\resources\views/pages/careerapply/components/table/ajax.blade.php ENDPATH**/ ?>