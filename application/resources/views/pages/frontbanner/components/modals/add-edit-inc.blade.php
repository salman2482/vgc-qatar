<div class="row" id="js-frontbanners-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">

        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Title')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="frontbanner_title" name="frontbanner_title"
                     value="{{ $frontbanner->title ?? '' }}">
            </div>
        </div>
        <!--/#title-->
        
        <!--title_ar<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Title Arabic')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="frontbanner_title_ar" name="frontbanner_title_ar"
                     value="{{ $frontbanner->title_ar ?? '' }}">
            </div>
        </div>
        <!--/#title_ar-->

        <!--description<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg text-left control-label col-form-label required">
                {{ cleanLang(__('Description')) }}*</label>
            <div class="col-sm-12">
            <textarea class="form-control form-control-sm tinymce-textarea" id="frontbanner_description" name="frontbanner_description" cols="30" rows="8">{{ $frontbanner->description ?? '' }}</textarea>
            </div>
        </div>
        <!--/#description-->

        <!--description_ar<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg text-left control-label col-form-label required">
                {{ cleanLang(__('Description Arabic')) }}*</label>

            <div class="col-sm-12">
            <textarea class="form-control form-control-sm tinymce-textarea" id="frontbanner_description_ar" name="frontbanner_description_ar" cols="30" rows="8">{{ $frontbanner->description_ar ?? '' }}</textarea>
            </div>
        </div>
        <!--/#description_ar-->

        
       <!--attach recipt-->
       <div>
        <!--fileupload-->
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="dropzone dz-clickable" id="fileupload_frontbanner_receipt">
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
                @if ($attachment->attachment_unique_input === 'frontbanner')
                <tr id="frontbanner_attachment_{{ $attachment->attachment_id }}">
                    <td>{{ $attachment->attachment_filename }} </td>
                    <td class="w-px-40"> <button type="button"
                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                            data-ajax-type="DELETE"
                            data-url="{{ url('/frontbanners/attachments/'.$attachment->attachment_uniqiueid) }}">
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
