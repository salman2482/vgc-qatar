<div class="row" id="js-subproducts-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">

        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.title')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="subproduct_title" name="subproduct_title"
                     value="{{ $subproduct->title ?? '' }}">
            </div>
        </div>
        <!--/#title-->

         <!--f_product<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Front Product')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <select name="subproduct_f_product" id="subproduct_f_product" class="select2-basic form-control form-control-sm">
                    @foreach ($fproducts as $fproduct)
                        <option value="{{$fproduct->id}}" 
                            {{ runtimePreselected($subproduct->fproduct->id ?? '', $fproduct->id) }}>
                            {{ $fproduct->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!--/#f_product-->

        <!--status<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ 'Product Status' }}*</label>
                <?php $opts = [
                    'Best Value' => 'Best Value',
                    'Coming Soon' => 'Coming Soon',
                    'Out Of Stock' => 'Out Of Stock',
                    'Sold Out' => 'Sold Out',
                    'Not Available' => 'Not Available',
                ] ?>
            <div class="col-sm-12 col-lg-9">
                <select name="fproduct_status" id="fproduct_status" class="select2-basic form-control form-control-sm">
                    @foreach ($opts as $item)
                        <option value="{{$item}}" {{ runtimePreselected($subproduct->status ?? '', $item) }}>
                            {{ ucwords($item) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!--/#status-->

        <!--description<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Description')) }}*</label>
            <div class="col-sm-12 col-lg-9">
            <textarea name="subproduct_description" id="subproduct_description" cols="30" rows="6" class="form-control form-control-sm">{{ $subproduct->description ?? '' }}</textarea>
            </div>
        </div>
        <!--/#description-->

         <!--attach recipt-->
        <!--attach recipt-->
        <div>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="subfileupload_subproduct_receipt">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            @if(isset($page['section']) && $page['section'] == 'edit')
            <table class="table table-bordered">
                <tbody>
                    {{-- @dd($attachments) --}}
                    @foreach($attachments as $attachment)
                    @if ($attachment->attachment_unique_input === 'subproduct')
                    <tr id="subproduct_attachment_{{ $attachment->attachment_id }}">
                        <td>{{ $attachment->attachment_filename }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active
                                data-ajax-type="DELETE"
                                data-url="{{ url('/subproducts/attachments/'.$attachment->attachment_uniqiueid) }}">
                                <i class="sl-icon-trash"></i>
                            </button></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

            <!--pass source-->
            <input type="hidden" name="source" value="{{ request('source') }}">

        </div>

    </div>
</div>
