
<div class="card count-{{ @count($corporateservices) }}" id="corporateservices-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($corporateservices) > 0)
            <table id="corporateservices-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="corporateservices_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/corporateservices?action=sort&orderby=id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="corporateservices_col_title">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_title"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/corporateservices?action=sort&orderby=title&sortorder=asc') }}">
                                {{ cleanLang(__('lang.title')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="corporateservices_col_description">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_description"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/corporateservices?action=sort&orderby=description&sortorder=asc') }}">
                                {{ cleanLang(__('Description')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                      
                        <th class="corporateservices_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="corporateservices-td-container">
                    <!--ajax content here-->
                    @include('pages.corporateservice.components.table.ajax')
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
            @endif @if (@count($corporateservices) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>