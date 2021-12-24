
<div class="card count-{{ @count($subcorporateservices) }}" id="subcorporateservices-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($subcorporateservices) > 0)
            <table id="subcorporateservices-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="subcorporateservices_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/subcorporateservices?action=sort&orderby=id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="subcorporateservices_col_title">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_title"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/subcorporateservices?action=sort&orderby=title&sortorder=asc') }}">
                                {{ cleanLang(__('lang.title')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="subcorporateservices_col_corporate_service">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_corporate_service"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/subcorporateservices?action=sort&orderby=corporate_service&sortorder=asc') }}">
                                {{ cleanLang(__('Corporate Service')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="subcorporateservices_col_description">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_description"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/subcorporateservices?action=sort&orderby=description&sortorder=asc') }}">
                                {{ cleanLang(__('Description')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                      
                        <th class="subcorporateservices_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="subcorporateservices-td-container">
                    <!--ajax content here-->
                    @include('pages.subcorporateservice.components.table.ajax')
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
            @endif @if (@count($subcorporateservices) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>