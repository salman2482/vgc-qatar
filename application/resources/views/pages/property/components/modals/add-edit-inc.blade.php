<div class="row" id="js-properties-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
       

        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.property_title')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="property_title" name="property_title"
                     value="{{ $property->title ?? '' }}">
            </div>
        </div>
        <!--/#title-->

        <!--description<>-->
        
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.property_description')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <textarea name="property_description" id="property_description" class="form-control form-control-sm" cols="30" rows="10" >{{ $property->description ?? ''}}</textarea>
            </div>
        </div>
        <label
        class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Property Image')) }}*</label>
        <div class="" id="add_property_image_path">
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="dropzone dz-clickable" id="fileupload_property_image_path">
                    <div class="dz-default dz-message">
                        <i class="icon-Upload-toCloud"></i>
                        <span>Drop files here or click to upload</span>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($page['section']) && $page['section'] == 'edit')
            <table class="table table-bordered">
                <tbody>
                    @foreach($attachments as $attachment)
                    @if ($attachment->attachment_unique_input === 'property')
                    <tr id="property_attachment_{{ $attachment->attachment_id ?? ''}}">
                        <td>{{ $attachment->attachment_filename }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                data-ajax-type="DELETE"
                                data-url="{{ url('/properties/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
                                <i class="sl-icon-trash"></i>
                            </button></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <!--/#description-->
        
     
            <!--pass source-->
            <input type="hidden" name="source" value="{{ request('source') }}">

        </div>

    </div>
</div>
