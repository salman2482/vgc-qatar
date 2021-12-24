
<div class="card count-{{ @count($contracts) }}" id="contracts-table-wrapper">
    {{-- @dd($contracts) --}}
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($contracts) > 0)
            <table id="contracts-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="contracts_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/contractsmgt?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="contracts_col_client_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client_id"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/contractsmgt?action=sort&orderby=client_id&sortorder=asc') }}">{{ cleanLang(__('Client')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="contracts_col_ref_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_ref_no"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/contractsmgt?action=sort&orderby=ref_no&sortorder=asc') }}">{{ cleanLang(__('Ref no')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="contracts_col_category">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_category"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/contractsmgt?action=sort&orderby=category&sortorder=asc') }}">{{ cleanLang(__('Category')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="contracts_col_issuance_date">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_issuance_date"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/contractsmgt?action=sort&orderby=issuance_date&sortorder=asc') }}">{{ cleanLang(__('Issuance Date')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="contracts_col_project_value">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_project_value"
                            href="javascript:void(0)"
                            data-url="{{ urlResource('/contractsmgt?action=sort&orderby=project_value&sortorder=asc') }}">{{ cleanLang(__('Project Value')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="contracts_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_issuance_date"
                                href="javascript:void(0)"
                               >{{ cleanLang(__('Status')) }}
                            </a>
                        </th>

                        <th class="contracts_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="contracts-td-container">
                    <!--ajax content here-->
                    @include('pages.contract.components.table.ajax')
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
            @endif @if (@count($contracts) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>