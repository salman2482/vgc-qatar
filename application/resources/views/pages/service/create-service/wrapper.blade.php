@extends('layout.wrapper') @section('content')

<!-- main content -->
<div class="container-fluid"    >

    <!--HEADER SECTION-->
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-2">
            {{-- @if ($page = 'create') --}}
            @include('pages.service.create-service.bill-web')
            {{-- @endif --}}
    </div>
    </div>
    <!--/#HEADER SECTION-->


</div>
<!--main content -->

@endsection

@section('scripts')
<script>
    var counter = 1;
     $(document).on("click",".addRow", function () {
            //var counter = $('#myTable tr').length - 2;
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td><textarea class="form-control" col="30" rows="6" id="description'+counter+'" name="description[]" ></textarea> </td>'
            cols += '<td><input class="form-control" type="text" id="qty'+counter+'" placeholder="quantity" name="price[]" /></td>';
            cols += '<td><input type="button" class="btn btn-sm btn-danger delete" id="ibtnDel"  value="Delete"></td>';
            cols += '<td ><input type="button" class="addRow btn btn-sm btn-info"  value="Add More" /></td>';

            newRow.append(cols);
            newRow.insertAfter($(this).parents().closest('tr'));
            //$("table.order-list").append(newRow);
            counter++;
        });
        $("#myTable").on("click", "#ibtnDel", function (event) {
            $(this).closest("tr").remove();
        });

</script>

@endsection