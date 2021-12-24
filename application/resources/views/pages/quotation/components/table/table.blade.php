
<div class="card count-{{ @count($quotations) }}" id="quotations-table-wrapper">
    {{-- @dd($quotations) --}}
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($quotations) > 0)
            <table id="quotations-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="quotations_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/quotations?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="quotations_col_ref_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_ref_no"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/quotations?action=sort&orderby=ref_no&sortorder=asc') }}">{{ cleanLang(__('Ref no')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="quotations_col_client_req_ref">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client_req_ref"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/quotations?action=sort&orderby=client_req_ref&sortorder=asc') }}">{{ cleanLang(__('Client Ref')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="quotations_col_client_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client_req_ref"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/quotations?action=sort&orderby=client_req_ref&sortorder=asc') }}">{{ cleanLang(__('Client Name')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="quotations_col_issuance_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_issuance_date"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/quotations?action=sort&orderby=issuance_date&sortorder=asc') }}">{{ cleanLang(__('Issuance Date')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="quotations_col_estimated_by">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_estimated_by"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/quotations?action=sort&orderby=estimated_by&sortorder=asc') }}">{{ cleanLang(__('Estimated By')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="quotation_col_status"><a href="javascript:void(0)">{{ cleanLang(__('Status')) }}</a></th>                            
                        <th class="quotations_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="quotations-td-container">
                    <!--ajax content here-->
                    @include('pages.quotation.components.table.ajax')
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
            @endif @if (@count($quotations) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>