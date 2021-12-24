<div class="row" id="js-subcorporateservices-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">

        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />

        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('lang.title')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="subcorporateservice_title" name="subcorporateservice_title"
                     value="{{ $subcorporateservice->title ?? '' }}">
            </div>
        </div>
        <!--/#title-->

         <!--corporate_service<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Corporate Service')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <select name="subcorporateservice_corporate_service" id="subcorporateservice_corporate_service" class="select2-basic form-control form-control-sm">
                    @foreach ($corporateservices as $corporateservice)
                        <option value="{{$corporateservice->id}}" 
                            {{ runtimePreselected($subcorporateservice->corporateservice->id ?? '', $corporateservice->id) }}>
                            {{ $corporateservice->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <!--/#corporate_service-->

        <!--description<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Description')) }}*</label>
            <div class="col-sm-12 col-lg-9">
            <textarea name="subcorporateservice_description" id="subcorporateservice_description" cols="30" rows="6" class="form-control form-control-sm">{{ $subcorporateservice->description ?? '' }}</textarea>
            </div>
        </div>
        <!--/#description-->

         <!--attach recipt-->
        <!--attach recipt-->
        <div>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="subfileupload_subcorporateservice_receipt">
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
                    @if ($attachment->attachment_unique_input === 'subcorporateservice')
                    <tr id="subcorporateservice_attachment_{{ $attachment->attachment_id }}">
                        <td>{{ $attachment->attachment_filename }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active
                                data-ajax-type="DELETE"
                                data-url="{{ url('/subcorporateservices/attachments/'.$attachment->attachment_uniqiueid) }}">
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
