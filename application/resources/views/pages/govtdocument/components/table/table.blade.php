
<div class="card count-{{ @count($govtdocuments) }}" id="govtdocuments-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($govtdocuments) > 0)
            <table id="govtdocuments-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="govtdocuments_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/govtdocuments?action=sort&orderby=id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_type_of_document">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_type_of_document"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/govtdocuments?action=sort&orderby=type_of_document&sortorder=asc') }}">
                                {{ cleanLang(__('Type of Document')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_doc_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_doc_no"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/govtdocuments?action=sort&orderby=doc_no&sortorder=asc') }}">
                                {{ cleanLang(__('Document #')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_issue_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_issue_date"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/govtdocuments?action=sort&orderby=issue_date&sortorder=asc') }}">
                                {{ cleanLang(__('lang.issue_date')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_validity_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_validity_date"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/govtdocuments?action=sort&orderby=validity_date&sortorder=asc') }}">
                                {{ cleanLang(__('Validity Date')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_renewal_cost">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_renewal_cost"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/govtdocuments?action=sort&orderby=renewal_cost&sortorder=asc') }}">
                                {{ cleanLang(__('Renewal Cost')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_last_renewal_by">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_last_renewal_by"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/govtdocuments?action=sort&orderby=last_renewal_by&sortorder=asc') }}">
                                {{ cleanLang(__('Last Renewal By')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        {{-- <th class="govtdocuments_col_document_copy">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_document_copy"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/govtdocuments?action=sort&orderby=document_copy&sortorder=asc') }}">
                                {{ cleanLang(__('Document Copy')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="govtdocuments_col_last_renewal_copy">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_last_renewal_copy"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/govtdocuments?action=sort&orderby=last_renewal_copy&sortorder=asc') }}">
                                {{ cleanLang(__('Last Renewal Copy')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th> --}}
                        <th class="govtdocuments_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_status"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/govtdocuments?action=sort&orderby=status&sortorder=asc') }}">
                                {{ cleanLang(__('status')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                      
                        <th class="govtdocuments_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="govtdocuments-td-container">
                    <!--ajax content here-->
                    @include('pages.govtdocument.components.table.ajax')
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
            @endif @if (@count($govtdocuments) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>