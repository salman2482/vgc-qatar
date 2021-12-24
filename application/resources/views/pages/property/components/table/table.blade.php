
<div class="card count-{{ @count($properties) }}" id="properties-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($properties) > 0)
            <table id="properties-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="properties_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/properties?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="properties_col_reference_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_reference_no" href="javascript:void(0)"
                                data-url="{{ urlResource('/properties?action=sort&orderby=reference_no&sortorder=asc') }}">{{ cleanLang(__('Reference Number')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="properties_col_property">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_title"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/properties?action=sort&orderby=title&sortorder=asc') }}">{{ cleanLang(__('lang.title')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="properties_col_description">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_description"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/properties?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('lang.description')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="properties_col_price">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_price"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/properties?action=sort&orderby=price&sortorder=asc') }}">{{ cleanLang(__('Price')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="properties_col_rent_or_sale">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_rent_or_sale"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/properties?action=sort&orderby=rent_or_sale&sortorder=asc') }}">{{ cleanLang(__('Rent Or Sale')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="properties_col_is_approved"><a href="javascript:void(0)">{{ cleanLang(__('lang.status')) }}</a></th>
                        <th class="properties_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="properties-td-container">
                    <!--ajax content here-->
                    @include('pages.property.components.table.ajax')
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
            @endif @if (@count($properties) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>