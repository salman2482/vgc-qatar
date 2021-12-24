@extends('layout.wrapper') @section('content')

<!-- main content -->
<div class="container-fluid" id="invoice-container">

    <!--HEADER SECTION-->
    <div class="row page-titles">
        <!--ACTIONS-->
        {{-- @if($bill->bill_type == 'invoice')
        @include('pages.rfm_bill.components.misc.invoice.actions')
        @endif
        @if($bill->bill_type == 'estimate')
        @include('pages.rfm_bill.components.misc.estimate.actions')
        @endif --}}

    </div>
    <!--/#HEADER SECTION-->

    <!--BILL CONTENT-->
    <div class="row">
        <div class="col-md-12 p-t-30">
            @include('pages.rfm_bill.bill-web')
        </div>
    </div>
</div>
<!--main content -->

@endsection

@section('scripts')
<script>
    var counter = 0;
    var total_qty = 0;
     $(document).on("click",".addRow", function () {
            var counter = $('#myTable tr').length - 1;
            var newRow = $("<tr>");
            var cols = "";
            var materials = `
                     <td>
                        <select name="material_id[]" onchange='getQuantity(${counter})' id="material${counter}" class="form-control materials" >
                            <option value="" disabled selected>Select Material</option>
                            @foreach ($payload['materials'] as $material)
                            <option value="{{ $material->id }}"  data-id="{{ $material->id }}" data-quantity="{{ $material->available_stock }}">{{ $material->title }}</option>
                            @endforeach
                        </select>
                    </td>
            `;
            cols += materials;
            cols += '<td><input class="form-control qt" type="number" id="qty'+counter+'" placeholder="quantity" max="'+ total_qty +'" name="qty[]" required/></td>';
            // cols += '<td><input class="form-control" type="text" id="val'+counter+'" placeholder="value" name="value[]" required/></td>';
            cols += '<td><input type="button" class="btn btn-sm btn-danger delete" id="ibtnDel"  value="Delete"></td>';
            cols += '<td ><input type="button" class="addRow btn btn-sm btn-info"  value="Add More" /></td>';
            newRow.append(cols);
            newRow.insertAfter($(this).parents().closest('tr'));
            counter++;

            //$("table.order-list").append(newRow);
        });

        function getQuantity(id) {
                let selected_material_id = $('#material'+id).find(':selected').data('id');
                total_qty = $('#material'+id).find(':selected').data('quantity');
                var closest_row = $('#material'+id).closest('tr').find('#qty'+id);
                closest_row.attr('max',total_qty);
                console.log(closest_row);
        }

        $("#myTable").on("click", "#ibtnDel", function (event) {
            $(this).closest("tr").remove();
        });
        // $("table.order-list").on("change", 'input[name^="price"]', function (event) {
        //     calculateRow($(this).closest("tr"));
        //     calculateGrandTotal();
        // });


        // $("table.order-list").on("click", ".dele", function (event) {
        //     $(this).closest("tr").remove();
        //     calculateGrandTotal();
        // });

</script>

@endsection