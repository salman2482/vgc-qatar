
<div class="card count-{{ @count($lpos) }}" id="lpos-table-wrapper">
    {{-- @dd($lpos) --}}
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($lpos) > 0)
            <table id="lpos-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="lpos_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/lpos?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="lpos_col_ref_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_ref_no"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/lpos?action=sort&orderby=ref_no&sortorder=asc') }}">{{ cleanLang(__('Ref #')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="lpos_col_rfm_ref_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_rfm_ref_no"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/lpos?action=sort&orderby=rfm_ref_no&sortorder=asc') }}">{{ cleanLang(__('RFM Ref #')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="lpos_col_subject">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client_subject"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/lpos?action=sort&orderby=client_subject&sortorder=asc') }}">{{ cleanLang(__('Subject')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="lpos_col_date_requested">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client_date_requestred"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/lpos?action=sort&orderby=client_date_requestred&sortorder=asc') }}">{{ cleanLang(__('Date Requested')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="lpos_col_requestor">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client_requestor"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/lpos?action=sort&orderby=client_requestor&sortorder=asc') }}">{{ cleanLang(__('Requestor')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="lpos_col_rfm_copy_link">
                            <a class="js-ajax-ux-request "
                                href="javascript:void(0)"
                                >{{ cleanLang(__('RFM Copy')) }}</a>
                        </th>
                        <th class="lpos_col_lpo_copy_link">
                            <a class="js-ajax-ux-request "
                                href="javascript:void(0)"
                               >{{ cleanLang(__('PO Copy')) }}</a>
                        </th>
                        
                        <th class="lpos_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="lpos-td-container">
                    <!--ajax content here-->
                    @include('pages.lpo.components.table.ajax')
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
            @endif @if (@count($lpos) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>