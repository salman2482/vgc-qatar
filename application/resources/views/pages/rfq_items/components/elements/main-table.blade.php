<div class="col-12">
    <div class="row">
        <h1 class="text-muted p-2 ml-3">Add Materials For RFQ</h1>
    </div>
    <div class="table-responsive m-t-40 invoice-table-wrapper {{ config('css.bill_mode') }} clear-both">
        <form action="{{ route('ritem.store.material') }}" method="post">
            @csrf
        <table class="table table-hover invoice-table {{ config('css.bill_mode') }}" id="myTable">
            <thead>
                <tr>
                    <th class="text-left x-quantity bill_col_quantity">{{ cleanLang(__('Title')) }}</th>
                    <th class="text-left x-quantity bill_col_quantity">{{ cleanLang(__('Quantity')) }}</th>
                    <th class="text-left x-quantity bill_col_quantity">{{ cleanLang(__('UOM')) }}</th>
                    <th class="text-left x-quantity bill_col_quantity">{{ cleanLang(__('Description')) }}</th>
                    <th class=" x-total bill_col_total" id="bill_col_total">{{ cleanLang(__('Add Row')) }}</th>
                    <th class=" x-total bill_col_total" id="bill_col_total">{{ cleanLang(__('Delete Row')) }}</th>
                </tr>
            </thead>
                
            <tbody id="billing-items-container">
                <input type="hidden" name="vendorrfq_id" value="{{ $payload['vendorrfq']->id ?? ''}}">
                @if ($payload['rfq_materials']->isEmpty())
                <tr>
                    <td>
                        <select name="material_id[]" class="form-control">
                            @foreach ($payload['materials'] as $material)
                            <option value="{{ $material->id }}">{{ $material->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control" required type="text" required id="qty" name="qty[]"  placeholder="quantity" />
                    </td>
                    <td>
                        <input class="form-control" required type="text" required id="uom" name="uom[]" placeholder="uom" />
                    </td>
                    <td>
                        <textarea class="form-control" id="description" name="description[]" placeholder="description" id="" cols="30" rows="6"></textarea>
                    </td>
                    <td >
                        <input type="button" class="addRow btn btn-info btn-sm" id="addrow" value="Add Row" />
                    </td>
                    <td><input type="button" class="btn btn-danger btn-sm delete" id="ibtnDel"  value="Delete"></td>
                </tr> 
                @endif
                
                
                @if (!empty($payload['rfq_materials']))
                    @foreach ($payload['rfq_materials'] as $item)
                <tr>
                    <td>
                        <select name="material_id[]" class="form-control">
                            @foreach ($payload['materials'] as $material)
                            <option value="{{ $material->id }}" {{ $material->id == $item->material_id ? 'selected' : ''}}>{{ $material->title }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="form-control" required type="text" required id="qty" name="qty[]" value="{{$item->qty}}"  placeholder="quantity" />
                    </td>
                    <td>
                        <input class="form-control" required type="text" required id="uom" name="uom[]" value="{{$item->uom}}" placeholder="uom" />
                    </td>
                    
                    <td>
                        <textarea class="form-control" required id="description" name="description[]" cols="30" rows="6">{{$item->material->description}}</textarea>
                    </td>
                    <td >
                        <input type="button" class="addRow btn btn-info btn-sm" id="addrow" value="Add Row" />
                    </td>
                    <td><input type="button" class="btn btn-danger btn-sm delete" id="ibtnDel"  value="Delete"></td>
                </tr> 
                @endforeach

                @endif
            </tbody>
            
            
        </table>
        <input type="submit" class="btn btn-sm btn-success float-right mr-4" value="Submit">
    </form>
    </div>
</div>