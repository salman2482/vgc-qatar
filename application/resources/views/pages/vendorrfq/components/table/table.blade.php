
<div class="card count-{{ @count($vendorrfqs) }}" id="vendorrfqs-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (session('success'))
                <div class="alert alert-primary">
                    {{session('success')}}
                </div>
                {{Session::forget('success')}}
            @endif
            @if (@count($vendorrfqs) > 0)
            <table id="vendorrfqs-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        <th class="vendorrfqs_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorrfqs?action=sort&orderby=id&sortorder=asc') }}">
                                {{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorrfqs_col_rfq_ref">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_rfq_ref"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorrfqs?action=sort&orderby=rfq_ref&sortorder=asc') }}">
                                {{ cleanLang(__('RFQ REF')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorrfqs_col_category">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_category"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorrfqs?action=sort&orderby=category&sortorder=asc') }}">
                                {{ cleanLang(__('CATEGORY')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorrfqs_col_company_category">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_company_category"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorrfqs?action=sort&orderby=company_category&sortorder=asc') }}">
                                {{ cleanLang(__('COMPANY CATEGORY')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorrfqs_col_priority">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_priority"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorrfqs?action=sort&orderby=priority&sortorder=asc') }}">
                                {{ cleanLang(__('PRIORITY')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        <th class="vendorrfqs_col_due_date_request">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_due_date_request"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorrfqs?action=sort&orderby=due_date_request&sortorder=asc') }}">
                                {{ cleanLang(__('DUE DATE REQUEST')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        
                        
                        <th class="vendorrfqs_col_required_quotation_validity">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_required_quotation_validity"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorrfqs?action=sort&orderby=required_quotation_validity&sortorder=asc') }}">
                                {{ cleanLang(__('REQ QTN VALIDITY')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="vendorrfqs_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_status"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/vendorrfqs?action=sort&orderby=status&sortorder=asc') }}">
                                {{ cleanLang(__('STATUS')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                      
                        <th class="vendorrfqs_col_action"><a href="javascript:void(0)">{{ cleanLang(__('ACTION')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="vendorrfqs-td-container">
                    <!--ajax content here-->
                    @include('pages.vendorrfq.components.table.ajax')
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
            @endif @if (@count($vendorrfqs) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif
        </div>
    </div>
</div>

@section('scripts')   
<script>
    $(document).ready(function(){
        $('.alert').fadeTo(2000,500).slideUp(500,function(){
            $('.alert').slideUp(500);
        });
    });
</script>
@endsection