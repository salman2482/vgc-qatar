
<div class="card count-<?php echo e(@count($documents)); ?>" id="documents-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($documents) > 0): ?>
            <table id="documents-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="documents_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/documents?action=sort&orderby=id&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.id'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="documents_col_ref_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_ref_no" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/documents?action=sort&orderby=ref_no&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.ref_no'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="documents_col_issue_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_issue_date" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/documents?action=sort&orderby=issue_date&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.issue_date'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="documents_col_subject">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_subject"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/documents?action=sort&orderby=subject&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.subject'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="documents_col_delivered_by">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/documents?action=sort&orderby=delivered_by&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.delivered_by'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="documents_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                href="javascript:void(0)"
                                ><?php echo e(cleanLang(__('Status'))); ?></a>
                        </th>
                      
                        <th class="documents_col_action"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                    </tr>
                </thead>
                <tbody id="documents-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.document.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php endif; ?> <?php if(@count($documents) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH H:\wamp64\www\application\resources\views/pages/document/components/table/table.blade.php ENDPATH**/ ?>