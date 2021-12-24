
<div class="card count-{{ @count($frontprojects) }}" id="frontprojects-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($frontprojects) > 0)
            <table id="frontprojects-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="frontprojects_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/frontprojects?action=sort&orderby=id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="frontprojects_col_frontproject">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_title"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/frontprojects?action=sort&orderby=title&sortorder=asc') }}">
                                {{ cleanLang(__('lang.title')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="frontprojects_col_contractor">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_contractor"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/frontprojects?action=sort&orderby=contractor&sortorder=asc') }}">
                                {{ cleanLang(__('Contractor')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="frontprojects_col_client">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_client"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/frontprojects?action=sort&orderby=client&sortorder=asc') }}">{{ cleanLang(__('lang.client')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="frontprojects_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_status"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/frontprojects?action=sort&orderby=status&sortorder=asc') }}">{{ cleanLang(__('lang.status')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                      
                        <th class="frontprojects_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="frontprojects-td-container">
                    <!--ajax content here-->
                    @include('pages.frontproject.components.table.ajax')
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
            @endif @if (@count($frontprojects) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>