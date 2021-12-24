<div class="card count-{{ @count($vusers) }}" id="vusers-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (@count($vusers) > 0)
            <table id="vusers-list-table" class="table m-t-0 m-b-0 table-hover no-wrap vuser-list"
                data-page-size="10">
                <thead>
                    <tr>
                        @if(config('visibility.vusers_col_checkboxes'))
                        <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-vusers" name="listcheckbox-vusers"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="vusers-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-vusers">
                                <label for="listcheckbox-vusers"></label>
                            </span>
                        </th>
                        @endif
                        <th class="vusers_col_first_name"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_first_name" href="javascript:void(0)"
                                data-url="{{ urlResource('/vusers?action=sort&orderby=first_name&sortorder=asc') }}">{{ cleanLang(__('lang.name')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        {{-- @if(config('visibility.vusers_col_client')) --}}
                        <th class="vusers_col_company"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_company_name" href="javascript:void(0)"
                                data-url="{{ urlResource('/vusers?action=sort&orderby=company_name&sortorder=asc') }}">{{ cleanLang(__('lang.company')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span>
                        </th>
                        {{-- @endif --}}
                        <th class="vusers_col_email"><a class="js-ajax-ux-request js-list-sorting" id="sort_email"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vusers?action=sort&orderby=email&sortorder=asc') }}">{{ cleanLang(__('lang.email')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></th>
                                
                        <th class="vusers_col_phone"><a class="js-ajax-ux-request js-list-sorting" id="sort_phone"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vusers?action=sort&orderby=phone&sortorder=asc') }}">{{ cleanLang(__('lang.phone')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></th>
                        
                                {{-- @if(config('visibility.vusers_col_last_active')) --}}
                        <th class="vusers_col_last_active"><a class="js-ajax-ux-request js-list-sorting"
                                id="sort_last_seen" href="javascript:void(0)"
                                data-url="{{ urlResource('/vusers?action=sort&orderby=last_seen&sortorder=asc') }}">{{ cleanLang(__('lang.last_seen')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></th>
                        {{-- @endif --}}
                        <th class="vusers_col_status"><a class="js-ajax-ux-request js-list-sorting" id="sort_status"
                            href="javascript:void(0)"
                            data-url="{{ urlResource('/vusers?action=sort&orderby=status&sortorder=asc') }}">{{ cleanLang(__('lang.status')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></th>
                    
                        @if(config('visibility.action_column'))
                        <th class="vusers_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                        @endif
                    </tr>
                </thead>
                <tbody id="vusers-td-container">
                    <!--ajax content here-->
                    @include('pages.vusers.components.table.ajax')
                    <!--ajax content here-->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            <!--load more button-->
                            @include('misc.load-more-button')
                            <!--load more button-->
                        </td>
                    </tr>
                </tfoot>
            </table>
            @endif @if (@count($vusers) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>