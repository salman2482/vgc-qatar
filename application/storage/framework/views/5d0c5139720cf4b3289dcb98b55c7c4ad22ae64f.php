<?php $__currentLoopData = $govtdocuments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $govtdocument): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<tr id="govtdocument_<?php echo e($govtdocument->id); ?>">
    <td class="govtdocuments_col_id">
        <?php echo e($govtdocument->id); ?>

    </td>
    <td class="govtdocuments_col_type_of_document">
        <?php echo e($govtdocument->type_of_document); ?>

    </td>
    <td class="govtdocuments_col_doc_no">
        <?php echo e($govtdocument->doc_no); ?>

    </td>
    <td class="govtdocuments_col_issue_date">
        <?php echo e($govtdocument->issue_date); ?>

    </td>
    <td class="govtdocuments_col_validity_date">
        <?php echo e($govtdocument->validity_date); ?>

    </td>
    <td class="govtdocuments_col_renewal_cost">
        <?php echo e($govtdocument->renewal_cost); ?>

    </td>
    <td class="govtdocuments_col_last_renewal_by">
        <?php echo e($govtdocument->last_renewal_by); ?>

    </td>
    
    
    <td class="govtdocuments_col_status">
        <?php echo e($govtdocument->status); ?>

    </td>
    
    
    <td class="govtdocuments_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            
            <!--[delete]-->
            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>" data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>"
                data-ajax-type="DELETE" data-url="<?php echo e(url('/')); ?>/govtdocuments/<?php echo e($govtdocument->id); ?>">
                <i class="sl-icon-trash"></i>
            </button>
           
            <!--[edit]-->
            
            <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="<?php echo e(urlResource('/govtdocuments/'.$govtdocument->id.'/edit')); ?>"
                data-loading-target="commonModalBody" data-modal-title="<?php echo e(cleanLang(__('Govt Document Edit'))); ?>"
                data-action-url="<?php echo e(urlResource('/govtdocuments/'.$govtdocument->id)); ?>" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="govtdocuments-td-container">
                <i class="sl-icon-note"></i>
            </button>
            
            <!--view-->
            <button type="button" title="<?php echo e(cleanLang(__('lang.view'))); ?>"
                class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                data-modal-title="<?php echo e(cleanLang(__('Government Records'))); ?>" data-url="<?php echo e(url('/govtdocuments/'.$govtdocument->id)); ?>">
                <i class="ti-new-window"></i>
            </button>
        </span>
    
    </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row--><?php /**PATH H:\wamp64\www\application\resources\views/pages/govtdocument/components/table/ajax.blade.php ENDPATH**/ ?>