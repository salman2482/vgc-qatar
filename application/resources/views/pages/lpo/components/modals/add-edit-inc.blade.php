<div class="row" id="js-lpos-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <!--client id<>-->
        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />

        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Rfm Ref#')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" name="rfm_ref_no" value="{{ $lpo->rfm_ref_no ?? '' }}" id="rfm_ref_no">
               
            </div>
        </div>

        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Department')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="department" id="department" value="{{ $lpo->department ?? '' }}">                
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Subject')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="subject"  value="{{ $lpo->subject ?? '' }}" id="subject">
              
            </div>
        </div>

        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Site')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="site" id="site" value="{{ $lpo->site ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Remarks')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="remarks" id="remarks" value="{{ $lpo->remarks ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Value')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="value" id="value" value="{{ $lpo->value ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Requestor')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="requestor" id="requestor" value="{{ $lpo->requestor ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Date Requested')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="date_requested" value="{{    runtimeDatepickerDate($lpo->date_requested ?? '') }}">
                <input type="hidden" class="mysql-date" value="{{ $lpo->date_requested ?? '' }}" name="date_requested" id="date_requested" >
            </div>
        </div>

        <div>
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Rfm Copy')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="lpo_rfm_copy">
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
            @if (isset($attachments))
            <table class="table table-bordered">
                <tbody>
                    @foreach($attachments as $attachment)
                    @if ($attachment->attachment_unique_input === 'lpo_rfm_copy')
                    <tr id="lpo_attachment_{{ $attachment->attachment_id ?? '' }}">
                        <td>{{ $attachment->attachment_filename ?? '' }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                data-ajax-type="DELETE"
                                data-url="{{ url('/lpos/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
                                <i class="sl-icon-trash"></i>
                            </button></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <!--/#document_copy-->
        <!--attach recipt-->

        <div>
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Lpo Copy')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="lpo_lpo_copy">
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
                    @foreach($attachments as $attachment)
                    @if ($attachment->attachment_unique_input === 'lpo_lpo_copy')
                    <tr id="lpo_attachment_{{ $attachment->attachment_id ?? ''}}">
                        <td>{{ $attachment->attachment_filename }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                data-ajax-type="DELETE"
                                data-url="{{ url('/lpos/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
                                <i class="sl-icon-trash"></i>
                            </button></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif
            @endif
        </div>

            <!--pass source-->
            <input type="hidden" name="source" value="{{ request('source') }}">

        </div>

    </div>
</div>
