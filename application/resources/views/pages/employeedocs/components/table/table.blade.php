<div class="card count-{{ @count($employees) }}" id="employees-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($employees) > 0)
                <table id="employees-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                    data-page-size="10">
                    <thead>
                        <tr>
                            <th class="employees_col_id">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                    data-url="{{ urlResource('/employeedocument?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="employees_col_employee_no">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_employee_no"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/documents?action=sort&orderby=employee_no&sortorder=asc') }}">{{ cleanLang(__('Employee No')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="employees_col_employee_name">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_employee_name"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/employeedocument?action=sort&orderby=employee_name&sortorder=asc') }}">{{ cleanLang(__('Employee Name')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="employees_col_expiration">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_expiration"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/employeedocument?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Expiration ID')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>

                            <th class="employees_col_visa_no">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_visa_no"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/employeedocument?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Visa No')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="employees_col_id_no">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_id_no" href="javascript:void(0)"
                                    data-url="{{ urlResource('/employeedocument?action=sort&orderby=id_no&sortorder=asc') }}">{{ cleanLang(__('ID NO')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>

                            <th class="employees_col_passport_no">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_passport_no"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/employeedocument?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Passport No')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>

                            <th class="employees_col_passport_expiration">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_passport_expiration"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/employeedocument?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Passport Expiration')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="employees_col_status">
                                <a class="js-ajax-ux-request js-list-sorting"
                                    href="javascript:void(0)">{{ cleanLang(__('Status')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="employees_col_employee_status">
                                <a class="js-ajax-ux-request js-list-sorting"
                                    href="javascript:void(0)">{{ cleanLang(__('Employee Status')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>

                            <th class="employees_col_action"><a
                                    href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                        </tr>
                    </thead>
                    <tbody id="employees-td-container">
                        <!--ajax content here-->
                        @include('pages.employeedocs.components.table.ajax')
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
            @endif
            @if (@count($employees) == 0)

                <!--nothing found-->
                @include('notifications.no-results-found')
                <!--nothing found-->
            @endif
        </div>
    </div>
</div>
