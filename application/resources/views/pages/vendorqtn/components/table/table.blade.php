
<div class="card count-{{ @count($vendorqtns) }}" id="vendorqtns-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($vendorqtns) > 0)
            <table id="vendorqtns-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="vendorqtns_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorqtns?action=sort&orderby=id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorqtns_col_rfq_ref">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_rfq_ref"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorqtns?action=sort&orderby=rfq_ref&sortorder=asc') }}">
                                {{ cleanLang(__('RFQ REF')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorqtns_col_first_name">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_first_name"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorqtns?action=sort&orderby=first_name&sortorder=asc') }}">
                                {{ cleanLang(__('Created By')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorqtns_col_receiving_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_receiving_date"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorqtns?action=sort&orderby=receiving_date&sortorder=asc') }}">
                                {{ cleanLang(__('Receiving Date')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorqtns_col_category">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_category"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorqtns?action=sort&orderby=category&sortorder=asc') }}">
                                {{ cleanLang(__('Category')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="vendorqtns_col_qtn_ref_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_qtn_ref_no"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorqtns?action=sort&orderby=qtn_ref_no&sortorder=asc') }}">
                                {{ cleanLang(__('QTN REF NO')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorqtns_col_total_value">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_total_value"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorqtns?action=sort&orderby=total_value&sortorder=asc') }}">
                                {{ cleanLang(__('Total Value')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorqtns_col_devlivery_time">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_devlivery_time"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorqtns?action=sort&orderby=devlivery_time&sortorder=asc') }}">
                                {{ cleanLang(__('Delivery Time')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorqtns_col_downoload_pdf">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_downoload_pdf"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorqtns?action=sort&orderby=downoload_pdf&sortorder=asc') }}">
                                {{ cleanLang(__('PDF')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorqtns_col_qtn_copy">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_qtn_copy"
                                href="javascript:void(0)"
                                >
                                {{ cleanLang(__('Qtn Copy')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorqtns_col_rfq_copy">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_rfq_copy"
                                href="javascript:void(0)"
                                >
                                {{ cleanLang(__('RFQ Copy')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorqtns_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_status"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorqtns?action=sort&orderby=status&sortorder=asc') }}">
                                {{ 'Status' }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                       
                        <th class="vendorqtns_col_action"><a href="javascript:void(0)">{{ cleanLang(__('ACTION')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="vendorqtns-td-container">
                    <!--ajax content here-->
                    @include('pages.vendorqtn.components.table.ajax')
                    <!--/ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            @include('misc.load-more-button')
                            <!--/load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            @endif @if (@count($vendorqtns) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>