<div class="row" id="js-fproducts-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

        <!--title<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ 'Product Title' }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="fproduct_title" name="fproduct_title"
                    value="{{ $fproduct->title ?? '' }}">
            </div>
        </div>
        <!--/#title-->

        <!--description<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ 'Product Description' }}*</label>
            <div class="col-sm-12 col-lg-9">
                <textarea name="fproduct_description" id="fproduct_description" class="form-control form-control-sm"
                    cols="30" rows="10">{{ $fproduct->description ?? '' }}</textarea>
            </div>
        </div>
        <!--description<>-->

        <!--category<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ 'Product category' }}*</label>
            <div class="col-sm-12 col-lg-9">

                <select name="fproduct_category" id="fproduct_category"
                    class="select2-basic form-control form-control-sm">
                    <option>Select Category</option>

                    @foreach ($cats as $req)

                        <?php if(isset($fproduct->f_category_id)) { ?>

                        <option value="{{ $req->id }}"
                            {{ $req->id == $fproduct->f_category_id ? 'selected' : '' }}>
                            {{ $req->name }}
                        </option>
                        <?php } else{ ?>

                        <option value="{{ $req->id }}">
                            {{ $req->name }}
                        </option>

                        <?php }?>
                    @endforeach

                </select>

            </div>
        </div>
        <!--category<>-->



        <!--attach image-->
        <div class="" id="add_fproduct_image_path">
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="fileupload_fproduct_image_path">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>Drop files here or click to upload</span>
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($page['section']) && $page['section'] == 'edit')
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($attachments as $attachment)
                            @if ($attachment->attachment_unique_input === 'fproduct')
                                <tr id="fproduct_attachment_{{ $attachment->attachment_id ?? '' }}">
                                    <td>{{ $attachment->attachment_filename }} </td>
                                    <td class="w-px-40"> <button type="button"
                                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                            data-ajax-type="DELETE"
                                            data-url="{{ url('/fproducts/attachments/' . $attachment->attachment_uniqiueid ?? '') }}">
                                            <i class="sl-icon-trash"></i>
                                        </button></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <!--/#attach image-->



        <!--pass source-->
        <input type="hidden" name="source" value="{{ request('source') }}">

    </div>

</div>
</div>
