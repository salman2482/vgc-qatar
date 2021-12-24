<form action="{{ isset($page) ?  route('services.store') : route('services.update',$payload['service']->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @isset($payload)
    @method('put')
    @endisset
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="form-group">
                <label for="">Service Title</label>
                <input type="text" class="form-control form-control-sm" name="service_title" id="service_title"
                    value="{{ $payload['service']->title ?? '' }}" placeholder="service title">
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="form-group">
                <label for="">Rate Per Hour</label>
                <input type="text" class="form-control form-control-sm" name="rate_per_hour" id="rate_per_hr"
                    value="{{ $payload['service']->rate_per_hour ?? '' }}" placeholder="Rate per hour">
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="form-group">
                <label for="">Minimum Charge</label>
                <input type="text" class="form-control form-control-sm" name="minimum_charge" id="min_charge"
                    value="{{ $payload['service']->minimum_charge ?? '' }}" placeholder="Minimum Charge">
            </div>
        </div>

        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="form-group">
                <label for="">Service Image</label>
                <input type="file" name="service_image">
            </div>
        </div>

        <div class="col-md-6 col-lg-6 col-sm-12">
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="service_description" cols="30" class="form-control form-control-sm"
                    rows="7">{{ $payload['service']->service_description ?? '' }}</textarea>
            </div>
        </div>

    </div>
    <table class="table table-hover invoice-table {{ config('css.bill_mode') }}" id="myTable">
        <thead>
            <tr>
                <th class="text-left x-action bill_col_action">Description</th>
                <th class="text-left x-quantity bill_col_quantity">{{ cleanLang(__('Price')) }}</th>

                <!--total-->
                <th class=" x-total bill_col_total" id="bill_col_total">{{ cleanLang(__('Delete')) }}</th>
                <th class=" x-total bill_col_total" id="bill_col_total">{{ cleanLang(__('Add More')) }}</th>
            </tr>
        </thead>
        {{-- @if (config('visibility.bill_mode') == 'editing') --}}


        @if (isset($page))
        @if ($page == 'create')
            <tbody id="billing-items-container">
                <!--plain line-->
                <tr>
                    <td>
                        <textarea name="description[]" cols="30" rows="6" class="form-control"
                            id="description0">description</textarea>
                    </td>
                    <td>
                        <input class="form-control" required type="text" id="qty0" name="price[]"
                            placeholder="quantity" />
                    </td>

                    <td>
                        <input type="button" class="btn btn-danger btn-sm delete" id="ibtnDel" value="Delete">
                    </td>
                    <td>
                        <input type="button" class="addRow btn btn-info btn-sm" id="addrow" value="Add More" />
                    </td>
                </tr>

            </tbody>
            @endif
        @endif

        @if (isset($payload))

            @if ($payload['page']['section'] == 'edit')
            @php
                $descriptions = explode('&&&',$payload['service']['description']);
                $prices = explode('&&&',$payload['service']['price']);
            @endphp

            <tbody id="billing-items-container">
                <!--plain line-->

                @for ($i = 0; $i < count($descriptions); $i++)
                <tr>
                    <td>
                        <textarea name="description[]" cols="30" rows="6" class="form-control"
                            id="description0">{{ $descriptions[$i] ?? '' }}</textarea>
                    </td>
                    <td>
                        <input class="form-control"  type="text" id="qty0" name="price[]"
                            placeholder="quantity" value="{{ $prices[$i] }}" />
                    </td>

                    <td>
                        <input type="button" class="btn btn-danger btn-sm delete" id="ibtnDel" value="Delete">
                    </td>
                    <td>
                        <input type="button" class="addRow btn btn-info btn-sm" id="addrow" value="Add More" />
                    </td>
                </tr>
                @endfor
            </tbody>
            @endif
        @endif


    </table>
    <input type="submit" class="btn btn-sm btn-success float-right mr-4" value="Submit">
</form>
