<div class="card count-{{ @count($mails) }}" id="mails-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($mails) > 0)
                <table id="mails-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                    data-page-size="10">
                    <thead>
                        <tr>
                            <th class="mails_col_id">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                    data-url="{{ urlResource('/mails?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="mails_col_email">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_email" href="javascript:void(0)"
                                    data-url="{{ urlResource('/mails?action=sort&orderby=email&sortorder=asc') }}">{{ cleanLang(__('Email')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>

                            <th class="mails_col_action"><a
                                    href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                        </tr>
                    </thead>
                    <tbody id="mails-td-container">
                        <!--ajax content here-->
                        @include('pages.mailist.components.table.ajax')
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
                @endif @if (@count($mails) == 0)
                    <!--nothing found-->
                    @include('notifications.no-results-found')
                    <!--nothing found-->
                @endif
        </div>
    </div>
</div>
