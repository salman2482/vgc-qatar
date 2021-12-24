<div class="card count-{{ @count($frontusers) }}" id="frontusers-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($frontusers) > 0)
                <table id="frontusers-list-table" class="table m-t-0 m-b-0 table-hover no-wrap frontuser-list"
                    data-page-size="10">
                    <thead>
                        <tr>
                            @if (config('visibility.frontusers_col_checkboxes'))
                                <th class="list-checkbox-wrapper">
                                    <!--list checkbox-->
                                    <span class="list-checkboxes display-inline-block w-px-20">
                                        <input type="checkbox" id="listcheckbox-frontusers"
                                            name="listcheckbox-frontusers"
                                            class="listcheckbox-all filled-in chk-col-light-blue"
                                            data-actions-container-class="frontusers-checkbox-actions-container"
                                            data-children-checkbox-class="listcheckbox-frontusers">
                                        <label for="listcheckbox-frontusers"></label>
                                    </span>
                                </th>
                            @endif
                            <th class="frontusers_col_first_name"><a class="js-ajax-ux-request js-list-sorting"
                                    id="sort_first_name" href="javascript:void(0)"
                                    data-url="{{ urlResource('/frontusers?action=sort&orderby=first_name&sortorder=asc') }}">{{ cleanLang(__('lang.name')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            {{-- @if (config('visibility.frontusers_col_client')) --}}
                            <th class="frontusers_col_company"><a class="js-ajax-ux-request js-list-sorting"
                                    id="sort_company_name" href="javascript:void(0)"
                                    data-url="{{ urlResource('/frontusers?action=sort&orderby=company_name&sortorder=asc') }}">{{ cleanLang(__('lang.company')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                            </th>
                            {{-- @endif --}}
                            <th class="frontusers_col_email"><a class="js-ajax-ux-request js-list-sorting"
                                    id="sort_email" href="javascript:void(0)"
                                    data-url="{{ urlResource('/frontusers?action=sort&orderby=email&sortorder=asc') }}">{{ cleanLang(__('lang.email')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></th>

                            <th class="frontusers_col_phone"><a class="js-ajax-ux-request js-list-sorting"
                                    id="sort_phone" href="javascript:void(0)"
                                    data-url="{{ urlResource('/frontusers?action=sort&orderby=phone&sortorder=asc') }}">{{ cleanLang(__('lang.phone')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></th>

                            {{-- @if (config('visibility.frontusers_col_last_active')) --}}
                            <th class="frontusers_col_last_active"><a class="js-ajax-ux-request js-list-sorting"
                                    id="sort_last_seen" href="javascript:void(0)"
                                    data-url="{{ urlResource('/frontusers?action=sort&orderby=last_seen&sortorder=asc') }}">{{ cleanLang(__('lang.last_seen')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></th>
                            {{-- @endif --}}
                            <th class="frontusers_col_status"><a class="js-ajax-ux-request js-list-sorting"
                                    id="sort_status" href="javascript:void(0)"
                                    data-url="{{ urlResource('/frontusers?action=sort&orderby=status&sortorder=asc') }}">{{ cleanLang(__('lang.status')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></th>

                            <th class="frontusers_col_action"><a
                                    href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>

                        </tr>
                    </thead>
                    <tbody id="frontusers-td-container">
                        <!--ajax content here-->
                        @include('pages.frontusers.components.table.ajax')
                        <!--ajax content here-->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="20">
                                <!--load more button-->
                                @include('misc.load-more-button')
                                <!--load more button-->
                            </td>
                        </tr>
                    </tfoot>
                </table>
                @endif @if (@count($frontusers) == 0)
                    <!--nothing found-->
                    @include('notifications.no-results-found')
                    <!--nothing found-->
                @endif
        </div>
    </div>
</div>
