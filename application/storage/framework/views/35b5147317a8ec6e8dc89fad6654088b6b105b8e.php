
<div class="card count-<?php echo e(@count($govtdocuments)); ?>" id="govtdocuments-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($govtdocuments) > 0): ?>
            <table id="govtdocuments-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="govtdocuments_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/govtdocuments?action=sort&orderby=id&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.id'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_type_of_document">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_type_of_document"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/govtdocuments?action=sort&orderby=type_of_document&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('Type of Document'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_doc_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_doc_no"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/govtdocuments?action=sort&orderby=doc_no&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('Document #'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_issue_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_issue_date"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/govtdocuments?action=sort&orderby=issue_date&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.issue_date'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_validity_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_validity_date"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/govtdocuments?action=sort&orderby=validity_date&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('Validity Date'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_renewal_cost">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_renewal_cost"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/govtdocuments?action=sort&orderby=renewal_cost&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('Renewal Cost'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_last_renewal_by">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_last_renewal_by"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/govtdocuments?action=sort&orderby=last_renewal_by&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('Last Renewal By'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="govtdocuments_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_status"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/govtdocuments?action=sort&orderby=status&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('status'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                      
                        <th class="govtdocuments_col_action"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                    </tr>
                </thead>
                <tbody id="govtdocuments-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.govtdocument.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--/ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <!--/load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; ?> <?php if(@count($govtdocuments) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH H:\wamp64\www\application\resources\views/pages/govtdocument/components/table/table.blade.php ENDPATH**/ ?>