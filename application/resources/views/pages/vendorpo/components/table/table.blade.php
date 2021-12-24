
<div class="card count-{{ @count($vendorpos) }}" id="vendorpos-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($vendorpos) > 0)
            <table id="vendorpos-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="vendorpos_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorpos?action=sort&orderby=id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="vendorpos_col_first_name">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_first_name"
                                >
                                {{ cleanLang(__('Vendor')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <th class="vendorpos_col_po_ref">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_po_ref"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorpos?action=sort&orderby=po_ref&sortorder=asc') }}">
                                {{ cleanLang(__('PO REF')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorpos_col_issuing_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_issuing_date"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorpos?action=sort&orderby=issuing_date&sortorder=asc') }}">
                                {{ cleanLang(__('Issuing Date')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorpos_col_qtn_ref_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_qtn_ref_no"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorpos?action=sort&orderby=qtn_ref_no&sortorder=asc') }}">
                                {{ cleanLang(__('QTN REF NO')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorpos_col_category">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_category"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorpos?action=sort&orderby=category&sortorder=asc') }}">
                                {{ cleanLang(__('Category')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorpos_col_total_value">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_total_value"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorpos?action=sort&orderby=total_value&sortorder=asc') }}">
                                {{ cleanLang(__('Total Value')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorpos_col_terms_condition">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_terms_condition"
                                >
                                {{ cleanLang(__('Terms & Condition')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorpos_col_payment_method">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_payment_method"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorpos?action=sort&orderby=payment_method&sortorder=asc') }}">
                                {{ cleanLang(__('Payment Method')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                    
                      
                        <th class="vendorpos_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="vendorpos-td-container">
                    <!--ajax content here-->
                    @include('pages.vendorpo.components.table.ajax')
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
            @endif @if (@count($vendorpos) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>