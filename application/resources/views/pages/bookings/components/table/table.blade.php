<div class="card count-{{ @count($bookings) }}" id="bookings-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($bookings) > 0)
                <table id="bookings-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                    data-page-size="10">
                    <thead>
                        <tr>
                            <th class="bookings_col_id">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="bookings_col_id">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Schedule Timing')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="bookings_col_id">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Service Name')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>

                            <th class="bookings_col_ref_no">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_ref_no" href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=reidf_no&sortorder=asc') }}">{{ cleanLang(__('Name')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="bookings_col_issue_date">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_issue_date"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Email')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="bookings_col_subject">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_subject"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Phone')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>

                            <th class="bookings_col_delivered_by">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Street No')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="bookings_col_delivered_by">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Building No')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="bookings_col_delivered_by">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Unit No')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="bookings_col_delivered_by">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Zone No')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="bookings_col_delivered_by">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Payment Type')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="bookings_col_delivered_by">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Price')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="bookings_col_delivered_by">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/bookings?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Description')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>

                            <th class="bookings_col_status">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                    href="javascript:void(0)">{{ cleanLang(__('Status')) }}</a>
                            </th>
                            <th class="bookings_col_invoice">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_delivered_by"
                                    href="javascript:void(0)">{{ cleanLang(__('Download Invoice')) }}</a>
                            </th>
                            <th class="bookings_col_action"><a
                                    href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                        </tr>
                    </thead>
                    <tbody id="bookings-td-container">
                        <!--ajax content here-->
                        @include('pages.bookings.components.table.ajax')
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
                @endif @if (@count($bookings) == 0)
                    <!--nothing found-->
                    @include('notifications.no-results-found')
                    <!--nothing found-->
                @endif
        </div>
    </div>
</div>
