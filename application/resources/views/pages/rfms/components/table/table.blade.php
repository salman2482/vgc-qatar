
<div class="card count-{{ @count($rfms) }}" id="rfms-table-wrapper">
    <div class="card-body">
        <div class="table-responsive list-table-wrapper">
            @if (session()->has('success'))
                <div class="alert alert-primary">
                  {{ session('success')  }}
                </div>
            @endif
            @if (@count($rfms) > 0)
            <table id="rfms-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list"
                data-page-size="10">
                <thead>
                    <tr>
                        {{-- <th class="list-checkbox-wrapper">
                            <!--list checkbox-->
                            <span class="list-checkboxes display-inline-block w-px-20">
                                <input type="checkbox" id="listcheckbox-rfms" name="listcheckbox-rfms"
                                    class="listcheckbox-all filled-in chk-col-light-blue"
                                    data-actions-container-class="rfms-checkbox-actions-container"
                                    data-children-checkbox-class="listcheckbox-rfms">
                                <label for="listcheckbox-rfms"></label>
                            </span>
                        </th> --}}
                        <th class="rfms_col_id">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_id" href="javascript:void(0)"
                                data-url="{{ urlResource('/rfms?action=sort&orderby=id&sortorder=asc') }}">{{ cleanLang(__('lang.id')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="rfms_col_ref_no">
                            <a class="js-ajax-ux-request js-list-sorting" id="ref_no" href="javascript:void(0)"
                                data-url="{{ urlResource('/rfms?action=sort&orderby=ref_no&sortorder=asc') }}">{{ cleanLang(__('RFM Ref.No')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="rfms_col_department">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_department"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/rfms?action=sort&orderby=department&sortorder=asc') }}">{{ cleanLang(__('Category')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="rfms_col_subject">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_subject"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/rfms?action=sort&orderby=subject&sortorder=asc') }}">{{ cleanLang(__('lang.rfm_subject')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="rfms_col_site">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_site"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/rfms?action=sort&orderby=site&sortorder=asc') }}">{{ cleanLang(__('lang.rfm_site')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="rfms_col_date_requested">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_date_requested"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/rfms?action=sort&orderby=date_requested&sortorder=asc') }}">{{ cleanLang(__('Date Requested')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="rfms_col_requestor">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_requestor"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/rfms?action=sort&orderby=requestor&sortorder=asc') }}">{{ cleanLang(__('Requestor')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        <th class="rfms_col_status">
                            <a class="js-ajax-ux-request js-list-sorting" id="sort_status"
                                href="javascript:void(0)"
                                data-url="{{ urlResource('/rfms?action=sort&orderby=status&sortorder=asc') }}">{{ cleanLang(__('Status')) }}<span class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>
                        </th>
                        @if (auth()->user()->is_admin)
                         <th class="rfms_col_assign_admin"><a href="javascript:void(0)">{{ cleanLang(__('Recieved Rfms')) }}</a></th>
                        @endif
                        <th class="rfms_col_assign_admin"><a href="javascript:void(0)">{{ cleanLang(__('RFM Copy')) }}</a></th>

                        <th class="rfms_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>
                    </tr>
                </thead>
                <tbody id="rfms-td-container">
                    <!--ajax content here-->
                    @include('pages.rfms.components.table.ajax')
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
            @endif
            @if (@count($rfms) == 0)
            <!--nothing found-->
            @include('notifications.no-results-found')
            <!--nothing found-->
            @endif

        </div>
    </div>
</div>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$("#btnAdd").on("click", function() {
  var $tableBody = $('#tbl').find("tbody"),
    $trLast = $tableBody.find("tr:last"),
    $trNew = $trLast.clone();
  //Set updated value
  $trNew.find('select').val($trLast.find('select').val())
  $trLast.after($trNew);
});
</script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

// $("#btnAdd").on("click", function() {
//   var $tableBody = $('#tbl').find("tbody"),
//     $trLast = $tableBody.find("tr:last"),
//     $trNew = $trLast.clone();
//   //Set updated value
//   $trNew.find('select').val($trLast.find('select').val())
//   $trLast.after($trNew);
// });

$(document).ready(function(){
    $(".alert").fadeTo(2000, 500).slideUp(500, function() {
        $(".alert").slideUp(500);
    });
});
</script>