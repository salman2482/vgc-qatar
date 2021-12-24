<div class="row" id="js-documents-modal-add-edit" data-section="<?php echo e($page['section']); ?>">
    <div class="col-lg-12">
        <!--meta data - creatd by-->
        

        <!--subject<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.subject'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="document_subject" name="document_subject"
                    placeholder="document subject" value="<?php echo e($document->subject ?? ''); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('Category'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="category" name="category"
                    placeholder="document category" value="<?php echo e($document->category ?? ''); ?>">
            </div>
        </div>
        <!--issue_date<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.issue_date'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="document_issue_date" placeholder="Issue Date"
                     value="<?php echo e(runtimeDatepickerDate($document->issue_date ?? '')); ?>">
                <input class="mysql-date" type="hidden" name="document_issue_date" id="document_issue_date"
                    value="<?php echo e($document->issue_date ?? ''); ?>">
            </div>
        </div>
        <!--/#issue date-->

        <!--delivery_date<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.delivery_date'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate"  name="document_delivery_date" placeholder="Delivery Date"
                     value="<?php echo e(runtimeDatepickerDate($document->delivery_date ?? '')); ?>">
                     <input class="mysql-date" type="hidden" name="document_delivery_date" id="document_delivery_date"
                     value="<?php echo e($document->delivery_date ?? ''); ?>">
            </div>
        </div>
        <!--/#delivery_date-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('Remarks'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="remarks" name="remarks"
                    placeholder="document remarks" value="<?php echo e($document->remarks ?? ''); ?>">
            </div>
        </div>
        <!--delivered_by<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.delivered_by'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="document_delivered_by" name="document_delivered_by" placeholder="Delivered By"
                     value="<?php echo e($document->delivered_by ?? ''); ?>">
            </div>
        </div>
        <!--/#delivered_by-->

        <!--delivery_method<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.delivery_method'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="document_delivery_method" name="document_delivery_method" placeholder="Delivery Method"
                     value="<?php echo e($document->delivery_method ?? ''); ?>">
            </div>
        </div>
        <!--/#delivery_method-->

         <!--expiration<>-->
         <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.expiration'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="document_expiration" placeholder="Expiration Date"
                     value="<?php echo e(runtimeDatepickerDate($document->expiration ?? '')); ?>">
                     <input class="mysql-date" type="hidden" name="document_expiration" id="document_expiration"
                     value="<?php echo e($document->expiration ?? ''); ?>">
            </div>
        </div>

      <div>
        <label
        class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('Document Copy'))); ?>*</label>
        <!--fileupload-->
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="dropzone dz-clickable" id="fileupload_document_document_copy">
                    <div class="dz-default dz-message">
                        <i class="icon-Upload-toCloud"></i>
                        <span><?php echo e(cleanLang(__('lang.drag_drop_file'))); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <!--fileupload-->
        <!--existing files-->
        <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
        <table class="table table-bordered">
            <tbody>
                <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($attachment->attachment_unique_input === 'document_doc_file'): ?>
                <tr id="document_attachment_<?php echo e($attachment->attachment_id ?? ''); ?>">
                    <td><?php echo e($attachment->attachment_filename ?? ''); ?> </td>
                    <td class="w-px-40"> <button type="button"
                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" active"
                            data-ajax-type="DELETE"
                            data-url="<?php echo e(url('/documents/attachments/'.$attachment->attachment_uniqiueid ?? '')); ?>">
                            <i class="sl-icon-trash"></i>
                        </button></td>
                </tr>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
    <!--/#document_copy-->
    <!--attach recipt-->

    <div>
        <label
        class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('Document Submital Copy'))); ?>*</label>
        <!--fileupload-->
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="dropzone dz-clickable" id="fileupload_document_submital_copy">
                    <div class="dz-default dz-message">
                        <i class="icon-Upload-toCloud"></i>
                        <span><?php echo e(cleanLang(__('lang.drag_drop_file'))); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <!--fileupload-->
        <!--existing files-->
        <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
        <table class="table table-bordered">
            <tbody>
                <?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($attachment->attachment_unique_input === 'document_submital_copy'): ?>
                <tr id="document_attachment_<?php echo e($attachment->attachment_id ?? ''); ?>">
                    <td><?php echo e($attachment->attachment_filename); ?> </td>
                    <td class="w-px-40"> <button type="button"
                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                            data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                            data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" active"
                            data-ajax-type="DELETE"
                            data-url="<?php echo e(url('/documents/attachments/'.$attachment->attachment_uniqiueid ?? '')); ?>">
                            <i class="sl-icon-trash"></i>
                        </button></td>
                </tr>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>


            <!--pass source-->
            <input type="hidden" name="source" value="<?php echo e(request('source')); ?>">

        </div>

    </div>
</div>
<?php /**PATH H:\wamp64\www\application\resources\views/pages/document/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>