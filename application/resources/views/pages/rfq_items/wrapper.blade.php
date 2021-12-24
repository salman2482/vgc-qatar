@extends('layout.wrapper') @section('content')

<div class="container-fluid" id="invoice-container">

    <!--HEADER SECTION-->
    <div class="row page-titles">
     

    </div>
    <!--/#HEADER SECTION-->

    <!--BILL CONTENT-->
    <div class="row">
        <div class="col-md-12 p-t-30">
            @include('pages.rfq_items.bill-web')
        </div>
    </div>
</div>
<!--main content -->

@endsection

@section('scripts')
<script>
    var counter = 0;
     $(document).on("click",".addRow", function () {
            var counter = $('#myTable tr').length - 2;
            var newRow = $("<tr>");
            var cols = "";

            var materials = `
                     <td>
                        <select name="material_id[]" id="material${counter}" class="form-control">
                            @foreach ($payload['materials'] as $material)
                            <option value="{{ $material->id }}">{{ $material->title }}</option>
                            @endforeach
                        </select>
                    </td>
            `;
            cols += materials;

            cols += '<td><input class="form-control" type="text" id="amount'+counter+'" placeholder="quantity" name="qty[]" required/></td>';
            cols += '<td><input class="form-control" type="text" id="uom'+counter+'" placeholder="uom" name="uom[]" required/></td>';
            
            cols += '<td><textarea class="form-control" cols="30" rows="6" id="description'+counter+'" placeholder="description" name="description[]" required/></textarea></td>';
                
            
            cols += '<td ><input type="button" class="addRow btn btn-sm btn-info"  value="Add Row" /></td>';
            cols += '<td><input type="button" class="btn btn-sm btn-danger delete" id="ibtnDel"  value="Delete"></td>';


            newRow.append(cols);
            newRow.insertAfter($(this).parents().closest('tr'));
            counter++;
        });
        $("#myTable").on("click", "#ibtnDel", function (event) {
            $(this).closest("tr").remove();
        });
        

</script>

@endsection