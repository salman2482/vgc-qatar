<div class="col-12">
    <div class="row">
        <h1 class="text-muted p-2 ml-3">Add Materials For RFM</h1>
    </div>
    <div class="table-responsive m-t-40 invoice-table-wrapper {{ config('css.bill_mode') }} clear-both">
        <form action="{{ route('rfm.store.material') }}" method="post">
            @csrf
            <table class="table table-hover invoice-table {{ config('css.bill_mode') }}" id="myTable">
                <thead>
                    <tr>
                        <!--action-->
                        {{-- @if (config('visibility.bill_mode') == 'editing') --}}
                        <th class="text-left x-action bill_col_action">Select Material</th>
                        {{-- @endif --}}
                        {{-- trustech code starts here --}}
                        <!--receipt-->
                        <th class="text-left x-quantity bill_col_quantity">{{ cleanLang(__('Quantity')) }}</th>
                        {{-- trustech code ends here --}}
                        {{-- <!--quantity-->
                    <th class="text-left x-quantity bill_col_quantity">{{ cleanLang(__('Value')) }}</th> --}}
                        <!--total-->
                        <th class=" x-total bill_col_total" id="bill_col_total">{{ cleanLang(__('Delete')) }}</th>
                        <th class=" x-total bill_col_total" id="bill_col_total">{{ cleanLang(__('Add More')) }}</th>
                    </tr>
                </thead>
                {{-- @if (config('visibility.bill_mode') == 'editing') --}}


                <tbody id="billing-items-container">
                    <!--plain line-->
                    {{-- @include('pages.rfm_bill.components.elements.line-plain') --}}
                    <input type="hidden" name="rfm_id" value="{{ $payload['rfm']->id }}">

                    @if ($payload['rfm_materials']->isEmpty())
                        <tr>
                            <td>
                                <select name="material_id[]" class="form-control" id="material0" onchange="getQuantity(0)">
                                    <option value="" disabled selected>Select Material</option>
                                    @foreach ($payload['materials'] as $material)
                                        <option value="{{ $material->id }}" data-id="{{ $material->id }}" data-quantity="{{ $material->available_stock }}">{{ $material->title }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input class="form-control" required type="number" id="qty0" name="qty[]"
                                    placeholder="quantity" max="0" />
                            </td>
                            {{-- <td>
                        <input class="form-control" type="text" id="val" name="value[]" placeholder="value" required />
                    </td> --}}
                            <td><input type="button" class="btn btn-danger btn-sm delete" id="ibtnDel" value="Delete">
                            </td>
                            <td>
                                <input type="button" class="addRow btn btn-info btn-sm" id="addrow" value="Add More" />
                            </td>
                        </tr>
                    @endif

                    @if (!empty($payload['rfm_materials']))
                        @foreach ($payload['rfm_materials'] as $rfm_material)
                            <tr>
                                <td>
                                    <select name="material_id[]" class="form-control">
                                        @foreach ($payload['materials'] as $material)
                                            <option value="{{ $material->id }}"
                                                {{ $material->id == $rfm_material->material_id ? 'selected' : '' }}>
                                                {{ $material->title }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control" required type="text" id="qty" name="qty[]"
                                        placeholder="quantity" value="{{ $rfm_material->qty }}" />
                                </td>
                                {{-- <td>
                                <input class="form-control" type="text" id="val" name="value[]" placeholder="value" required />
                            </td> --}}
                                <td><input type="button" class="btn btn-danger btn-sm delete" id="ibtnDel"
                                        value="Delete"></td>
                                <td>
                                    <input type="button" class="addRow btn btn-info btn-sm" id="addrow"
                                        value="Add More" />
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>


            </table>
            <input type="submit" class="btn btn-sm btn-success float-right mr-4" value="Submit">
        </form>
    </div>
</div>
