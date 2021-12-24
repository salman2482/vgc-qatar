<?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr id="document_<?php echo e($document->id); ?>">
        <td class="documents_col_id"><?php echo e($document->id); ?>

        </td>
        <td class="documents_col_ref_no">
            <?php echo e($document->ref_no); ?>

        </td>
        <td class="documents_col_issue_date">
            <?php echo e(runtimeDate($document->issue_date)); ?>

        </td>
        <td class="documents_col_subject">
            <?php echo e($document->subject); ?>

        </td>
        <td class="documents_col_delivered_by">
            <?php echo e($document->delivered_by); ?>

        </td>

        <td class="documents_col_status">
            <span
                class="label <?php echo e(runtimeDocumentStatusLabel($document->status ?? 'valid')); ?>"><?php echo e($document->status ?? 'valid'); ?>

            </span>
        </td>

        <td class="documents_col_action actions_column">
            <!--action button-->
            <span class="list-table-action dropdown font-size-inherit">
                <?php if(config('visibility.action_buttons_delete')): ?>
                    <!--[delete]-->
                    <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"
                        class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                        data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                        data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"
                        data-url="<?php echo e(url('/')); ?>/documents/<?php echo e($document->id); ?>">
                        <i class="sl-icon-trash"></i>
                    </button>
                <?php endif; ?>
                <!--[edit]-->
                <?php if(config('visibility.action_buttons_edit')): ?>
                    <button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>"
                        class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#commonModal"
                        data-url="<?php echo e(urlResource('/documents/' . $document->id . '/edit')); ?>"
                        data-loading-target="commonModalBody"
                        data-modal-title="<?php echo e(cleanLang(__('lang.document_edit'))); ?>"
                        data-action-url="<?php echo e(urlResource('/documents/' . $document->id)); ?>" data-action-method="PUT"
                        data-action-ajax-class="" data-action-ajax-loading-target="documents-td-container">
                        <i class="sl-icon-note"></i>
                    </button>
                <?php endif; ?>
                <button type="button" title="<?php echo e(cleanLang(__('lang.view'))); ?>"
                    class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                    data-modal-title="<?php echo e(cleanLang(__('Document Details'))); ?>"
                    data-url="<?php echo e(url('/documents/' . $document->id)); ?>">
                    <i class="ti-new-window"></i>
                </button>
            </span>

        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!--each row-->
<?php /**PATH H:\wamp64\www\application\resources\views/pages/document/components/table/ajax.blade.php ENDPATH**/ ?>