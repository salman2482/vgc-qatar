
<div class="card count-{{ @count($frontcareers) }}" id="frontcareers-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($frontcareers) > 0)
            <table id="frontcareers-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="frontcareers_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/frontcareers?action=sort&orderby=id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="frontcareers_col_title">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_title"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/frontcareers?action=sort&orderby=title&sortorder=asc') }}">
                                {{ cleanLang(__('lang.title')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="frontcareers_col_experience">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_experience"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/frontcareers?action=sort&orderby=experience&sortorder=asc') }}">
                                {{ cleanLang(__('Experience')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="frontcareers_col_category">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_category"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/frontcareers?action=sort&orderby=category&sortorder=asc') }}">
                                {{ cleanLang(__('Category')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="frontcareers_col_position">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_position"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/frontcareers?action=sort&orderby=position&sortorder=asc') }}">
                                {{ cleanLang(__('Position')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="frontcareers_col_salary">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_salary"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/frontcareers?action=sort&orderby=salary&sortorder=asc') }}">
                                {{ cleanLang(__('Salary')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>

                        <th class="frontcareers_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_status"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/frontcareers?action=sort&orderby=status&sortorder=asc') }}">
                                {{ cleanLang(__('status')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                       
                      
                        <th class="frontcareers_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="frontcareers-td-container">
                    <!--ajax content here-->
                    @include('pages.frontcareer.components.table.ajax')
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
            @endif @if (@count($frontcareers) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>