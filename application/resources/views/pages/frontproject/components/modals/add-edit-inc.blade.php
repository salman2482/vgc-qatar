<div class="row" id="js-frontprojects-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">

        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.title')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="frontproject_title" name="frontproject_title"
                     value="{{ $frontproject->title ?? '' }}">
            </div>
        </div>
        <!--/#title-->

        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.contractor')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="frontproject_contractor" name="frontproject_contractor"
                     value="{{ $frontproject->contractor ?? '' }}">
            </div>
        </div>
        <!--/#title-->


        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.client')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="frontproject_client" name="frontproject_client"
                     value="{{ $frontproject->client ?? '' }}">
            </div>
        </div>
        <!--/#title-->


        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.status')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="frontproject_status" name="frontproject_status"
                     value="{{ $frontproject->status ?? '' }}">
            </div>
        </div>
        <!--/#title-->

        
       <!--attach recipt-->
       <div>
        <!--fileupload-->
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="dropzone dz-clickable" id="fileupload_frontproj_receipt">
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
                @if ($attachment->attachment_unique_input === 'frontproject')
                <tr id="frontproject_attachment_{{ $attachment->attachment_id }}">
                    <td>{{ $attachment->attachment_filename }} </td>
                    <td class="w-px-40"> <button type="button"
                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                            data-ajax-type="DELETE"
                            data-url="{{ url('/frontprojects/attachments/'.$attachment->attachment_uniqiueid) }}">
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
