<div class="card count-{{ @count($services) }}" id="services-table-wrapper">
    {{-- @dd($services) --}}
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (session()->has('success'))
            <div class="alert alert-primary">
              {{ session('success')  }}
            </div>
        @endif
            @if (@count($services) > 0)
                <table id="services-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                    data-page-size="10">
                    <thead>
                        <tr>
                            <th class="services_col_id">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                    data-url="{{ urlResource('/services?action=sort&orderby=service_id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="services_col_title">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_title" href="javascript:void(0)"
                                    data-url="{{ urlResource('/services?action=sort&orderby=title&sortorder=asc') }}">{{ cleanLang(__('Title')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>

                            <th class="services_col_description">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_description"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/services?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Description')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="services_col_rate_per_hour">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_rate_per_hour"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/services?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Rate Per Hour')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>

                            <th class="services_col_minimum_charge">
                                <a class="js-ajax-ux-request js-list-sorting" id="sort_minimum_charge"
                                    href="javascript:void(0)"
                                    data-url="{{ urlResource('/services?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('Minimum Charge')) }}<span
                                        class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                            </th>
                            <th class="services_col_action">
                                <a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="services-td-container">
                        <!--ajax content here-->
                        @include('pages.service.components.table.ajax')
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
                @endif @if (@count($services) == 0)
                    <!--nothing found-->
                    @include('notifications.no-results-found')
                    <!--nothing found-->
                @endif
        </div>
    </div>
</div>
