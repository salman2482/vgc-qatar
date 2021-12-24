
<div class="card count-{{ @count($documents) }}" id="documents-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($documents) > 0)
            <table id="documents-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="documents_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/documents?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="documents_col_ref_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_ref_no" href="javascript:void(0)"
                                data-url="{{ urlResource('/documents?action=sort&orderby=ref_no&sortorder=asc') }}">{{ cleanLang(__('lang.ref_no')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="documents_col_issue_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_issue_date" href="javascript:void(0)"
                                data-url="{{ urlResource('/documents?action=sort&orderby=issue_date&sortorder=asc') }}">{{ cleanLang(__('lang.issue_date')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="documents_col_subject">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_subject"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/documents?action=sort&orderby=subject&sortorder=asc') }}">{{ cleanLang(__('lang.subject')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="documents_col_delivered_by">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/documents?action=sort&orderby=delivered_by&sortorder=asc') }}">{{ cleanLang(__('lang.delivered_by')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="documents_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                href="javascript:void(0)"
                                >{{ cleanLang(__('Status')) }}</a>
                        </th>
                      
                        <th class="documents_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="documents-td-container">
                    <!--ajax content here-->
                    @include('pages.document.components.table.ajax')
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
            @endif @if (@count($documents) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>