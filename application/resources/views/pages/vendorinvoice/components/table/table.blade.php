
<div class="card count-{{ @count($vendorinvoices) }}" id="vendorinvoices-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($vendorinvoices) > 0)
            <table id="vendorinvoices-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="vendorinvoices_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorinvoices_col_company_name">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_company_name"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=company_name&sortorder=asc') }}">
                                {{ cleanLang(__('Vendor Comp')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorinvoices_col_lpo_ref">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lpo_ref" href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=lpo_ref&sortorder=asc') }}">
                                {{ cleanLang(__('PO REF')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <th class="vendorinvoices_col_category">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_category" href="javascript:void(0)"
                            data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=category&sortorder=asc') }}">
                            {{ cleanLang(__('Category')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <th class="vendorinvoices_col_delivery_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_delivery_date" href="javascript:void(0)"
                            data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=delivery_date&sortorder=asc') }}">
                            {{ cleanLang(__('Delivery Date')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                      
                        <th class="vendorinvoices_col_invoice_ref_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_invoice_ref_no"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=invoice_ref_no&sortorder=asc') }}">
                                {{ cleanLang(__('Invoice REF #')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorinvoices_col_total_value">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_total_value"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=total_value&sortorder=asc') }}">
                                {{ cleanLang(__('Total Value')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorinvoices_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_status"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=status&sortorder=asc') }}">
                                {{ cleanLang(__('Status')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorinvoices_col_lpo_copy">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_lpo_copy"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=lpo_copy&sortorder=asc') }}">
                                {{ cleanLang(__('Lpo Copy')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorinvoices_col_invoice_copy">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_invoice_copy"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=invoice_copy&sortorder=asc') }}">
                                {{ cleanLang(__('Invoice Copy')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorinvoices_col_qtn_copy">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_qtn_copy"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=qtn_copy&sortorder=asc') }}">
                                {{ cleanLang(__('Qtn Copy')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorinvoices_col_reason">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_reason"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorinvoices?action=sort&orderby=reason&sortorder=asc') }}">
                                {{ cleanLang(__('Reason')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="vendorinvoices_col_action"><a href="javascript:void(0)">{{ cleanLang(__('ACTION')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="vendorinvoices-td-container">
                    <!--ajax content here-->
                    @include('pages.vendorinvoice.components.table.ajax')
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
            @endif @if (@count($vendorinvoices) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>