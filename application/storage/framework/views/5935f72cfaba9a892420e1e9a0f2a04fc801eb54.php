<div class="row" id="js-govtdocuments-modal-add-edit" data-section="<?php echo e($page['section']); ?>">
    <div class="col-lg-12">
        <?php
            $docs = [
                'Employee Legal Document' => 'Employee Legal Document',
                'Company Legal Document' => 'Company Legal Document',
                'Client Legal Document Vendor' => 'Client Legal Document',
                'Legal Document' => 'Vendor Legal Document',
    ];
        ?>

        <!--type_of_document<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                <?php echo e(cleanLang(__('Type of Document'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                
                <select class="select2-basic form-control form-control-sm" name="govtdocument_type_of_document" id="govtdocument_type_of_document"
                    data-allow-clear="false" >
                    <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($doc); ?>" <?php echo e($govtdocument->type_of_document ?? '' == $doc ? 'selected' : ''); ?>><?php echo e(ucwords($doc)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <input type="hidden" name="_token" id="csrf-token" value="<?php echo e(Session::token()); ?>" />
        <!--/#type_of_document-->

        <!--doc_no<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                <?php echo e(cleanLang(__('Doc Number'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="govtdocument_doc_no" name="govtdocument_doc_no"
                    placeholder="" value="<?php echo e($govtdocument->doc_no ?? ''); ?>">
            </div>
        </div>
        <!--/#doc_no-->

        <!--renewal_cost<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                <?php echo e(cleanLang(__('Renewal Cost'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="govtdocument_renewal_cost" name="govtdocument_renewal_cost"
                    placeholder="" value="<?php echo e($govtdocument->renewal_cost ?? ''); ?>">
            </div>
        </div>
        <!--/#renewal_cost-->


        <!--issue dates<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                <?php echo e(cleanLang(__('lang.issue_date'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="govtdocument_issue_date"
                    autocomplete="off" value="<?php echo e(runtimeDatepickerDate($govtdocument->issue_date ?? '')); ?>">
                <input class="mysql-date" type="hidden" name="govtdocument_issue_date" id="govtdocument_issue_date"
                    value="<?php echo e($govtdocument->issue_date ?? ''); ?>">
            </div>
        </div>
        <!--/#issue dates-->

        <!--validity_date<>-->
        <div class="form-group row">
                <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                <?php echo e(cleanLang(__('Validity Date'))); ?>*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="govtdocument_validity_date"
                    autocomplete="off" value="<?php echo e(runtimeDatepickerDate($govtdocument->validity_date ?? '')); ?>">
                <input class="mysql-date" type="hidden" name="govtdocument_validity_date" id="govtdocument_validity_date"
                    value="<?php echo e($govtdocument->validity_date ?? ''); ?>">
            </div>
        </div>
        <!--/#validity_date-->

        <!--last_renewal_by<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                <?php echo e(cleanLang(__('Last Renewal By'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="govtdocument_last_renewal_by" name="govtdocument_last_renewal_by"
                    placeholder="" value="<?php echo e($govtdocument->last_renewal_by ?? ''); ?>">
            </div>
        </div>
        <!--/#last_renewal_by-->

        <!--document_copy<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                <?php echo e(cleanLang(__('Document Copy'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                
            </div>
        </div>

        <!--attach recipt-->
        <div>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="fileupload_govtdocument_receipt">
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
                    <?php if($attachment->attachment_unique_input === 'document_attachments'): ?>
                    <tr id="govtdocument_attachment_<?php echo e($attachment->attachment_id); ?>">
                        <td><?php echo e($attachment->attachment_filename); ?> </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" active"
                                data-ajax-type="DELETE"
                                data-url="<?php echo e(url('/govtdocuments/attachments/'.$attachment->attachment_uniqiueid)); ?>">
                                <i class="sl-icon-trash"></i>
                            </button></td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>




         <!--last_renewal_copy<>-->
         <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                <?php echo e(cleanLang(__('Last Renewal Copy'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                
            </div>
        </div>

        <!--attach recipt-->
        <div>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="fileupload_govtdocument_lrc">
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
                    <?php if($attachment->attachment_unique_input === 'lrc_attachments'): ?>


                    <tr id="govtdocument_attachment_<?php echo e($attachment->attachment_id); ?>">
                        <td><?php echo e($attachment->attachment_filename); ?> </td>

                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"
                                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" active"
                                data-ajax-type="DELETE"
                                data-url="<?php echo e(url('/govtdocuments/attachments/'.$attachment->attachment_uniqiueid)); ?>">
                                <i class="sl-icon-trash"></i>
                            </button></td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
        <!--/#last_renewal_copy-->

         <!--status<>-->
         <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                <?php echo e(cleanLang(__('status'))); ?></label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="govtdocument_status" name="govtdocument_status"
                    placeholder="" value="<?php echo e($govtdocument->status ?? ''); ?>">
            </div>
        </div>
        <!--/#status-->


        </div>


        <!--redirect to govtdocument-->
        <?php if(config('visibility.govtdocument_show_govtdocument_option')): ?>
        <div class="form-group form-group-checkbox row">
            <div class="col-12 text-left p-t-5">
                <input type="checkbox" id="show_after_adding" name="govtdocument_show_after_adding"
                    class="filled-in chk-col-light-blue" checked="checked">
                <label for="show_after_adding"><?php echo e(cleanLang(__('lang.show_govtdocument_after_its_created'))); ?></label>
            </div>
        </div>
        <?php endif; ?>
        <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* <?php echo e(cleanLang(__('lang.required'))); ?></strong></small></div>
            </div>
        </div>
    </div>
</div>


<?php if(isset($page['section']) && $page['section'] == 'edit'): ?>
<!--dynamic inline - set dynamic govtdocument progress-->
<script>
    NX.varInitialgovtdocumentProgress = "<?php echo e($govtdocument['govtdocument_progress']); ?>";
</script>
<?php endif; ?><?php /**PATH H:\wamp64\www\application\resources\views/pages/govtdocument/components/modals/add-edit-inc.blade.php ENDPATH**/ ?>