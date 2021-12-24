
<div class="card count-{{ @count($materials) }}" id="materials-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($materials) > 0)
            <table id="materials-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        {{-- <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-materials" name="listcheckbox-materials"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="materials-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-materials">
                                <label for="listcheckbox-materials"></label>
                            </span>
                        </th> --}}
                        <th class="materials_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/materials?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="materials_col_title">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_title"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/materials?action=sort&orderby=title&sortorder=asc') }}">{{ cleanLang(__('Material Title')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="materials_col_value">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_value"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/materials?action=sort&orderby=value&sortorder=asc') }}">{{ cleanLang(__('Material Value')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="materials_col_description">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_description"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/materials?action=sort&orderby=description&sortorder=asc') }}">{{ cleanLang(__('Description')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="materials_col_category">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_category"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/materials?action=sort&orderby=category&sortorder=asc') }}">{{ cleanLang(__('Category')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="materials_col_availablestock">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_availablestock"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/materials?action=sort&orderby=availablestock&sortorder=asc') }}">{{ cleanLang(__('Available Stock')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                      
                        <th class="materials_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="materials-td-container">
                    <!--ajax content here-->
                    @include('pages.material.components.table.ajax')
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
            @endif @if (@count($materials) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>