
<div class="card count-{{ @count($careersapply) }}" id="careersapply-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($careersapply) > 0)
            <table id="careersapply-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="careersapply_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/careersapply?action=sort&orderby=id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_type">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_type"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/careersapply?action=sort&orderby=type&sortorder=asc') }}">
                                {{ cleanLang(__('lang.type')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_field">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_field"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/careersapply?action=sort&orderby=field&sortorder=asc') }}">
                                {{ cleanLang(__('Field')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_first_name">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_first_name"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/careersapply?action=sort&orderby=first_name&sortorder=asc') }}">
                                {{ cleanLang(__('Name')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_primary_email">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_primary_email"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/careersapply?action=sort&orderby=primary_email&sortorder=asc') }}">
                                {{ cleanLang(__('Email')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_mobile">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_mobile"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/careersapply?action=sort&orderby=mobile&sortorder=asc') }}">
                                {{ cleanLang(__('Mobile')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_education">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_education"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/careersapply?action=sort&orderby=education&sortorder=asc') }}">
                                {{ cleanLang(__('Education')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="careersapply_col_nationality">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_nationality"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/careersapply?action=sort&orderby=nationality&sortorder=asc') }}">
                                {{ cleanLang(__('Nationality')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                       
                      
                        <th class="careersapply_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="careersapply-td-container">
                    <!--ajax content here-->
                    @include('pages.careerapply.components.table.ajax')
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
            @endif @if (@count($careersapply) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>