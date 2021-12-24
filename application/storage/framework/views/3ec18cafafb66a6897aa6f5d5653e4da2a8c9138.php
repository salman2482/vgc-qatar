
<div class="card count-<?php echo e(@count($careersapply)); ?>" id="careersapply-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            <?php if(@count($careersapply) > 0): ?>
            <table id="careersapply-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="careersapply_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/careersapply?action=sort&orderby=id&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.id'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_type">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_type"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/careersapply?action=sort&orderby=type&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('lang.type'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_field">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_field"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/careersapply?action=sort&orderby=field&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('Field'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_first_name">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_first_name"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/careersapply?action=sort&orderby=first_name&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('Name'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_primary_email">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_primary_email"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/careersapply?action=sort&orderby=primary_email&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('Email'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_mobile">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_mobile"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/careersapply?action=sort&orderby=mobile&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('Mobile'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_education">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_education"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/careersapply?action=sort&orderby=education&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('Education'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_nationality">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_nationality"
                                href="javascript:void(0)"
                                data-url="<?php echo e(urlResource('/careersapply?action=sort&orderby=nationality&sortorder=asc')); ?>">
                                <?php echo e(cleanLang(__('Nationality'))); ?><span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                       
                      
                        <th class="careersapply_col_action"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>
                    </tr>
                </thead>
                <tbody id="careersapply-td-container">
                    <!--ajax content here-->
                    <?php echo $__env->make('pages.careerapply.components.table.ajax', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            <?php endif; ?> <?php if(@count($careersapply) == 0): ?>
            <!--nothing found-->
            <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--nothing found-->
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH H:\wamp64\www\application\resources\views/pages/careerapply/components/table/table.blade.php ENDPATH**/ ?>