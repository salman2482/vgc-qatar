<div class="row" id="js-documents-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <!--meta data - creatd by-->
        {{-- @if(isset($page['section']) && $page['section'] == 'edit')
        <div class="modal-meta-data">
            <small><strong>{{ cleanLang(__('lang.created_by')) }}:</strong> {{ $project->first_name ?? runtimeUnkownUser() }} |
                {{ runtimeDate($project->project_created) }}</small>
        </div>
        @endif --}}

        <!--subject<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.subject')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="document_subject" name="document_subject"
                    placeholder="document subject" value="{{ $document->subject ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Category')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="category" name="category"
                    placeholder="document category" value="{{ $document->category ?? '' }}">
            </div>
        </div>
        <!--issue_date<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.issue_date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="document_issue_date" placeholder="Issue Date"
                     value="{{ runtimeDatepickerDate($document->issue_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="document_issue_date" id="document_issue_date"
                    value="{{ $document->issue_date ?? '' }}">
            </div>
        </div>
        <!--/#issue date-->

        <!--delivery_date<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.delivery_date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate"  name="document_delivery_date" placeholder="Delivery Date"
                     value="{{ runtimeDatepickerDate($document->delivery_date ?? '') }}">
                     <input class="mysql-date" type="hidden" name="document_delivery_date" id="document_delivery_date"
                     value="{{ $document->delivery_date ?? '' }}">
            </div>
        </div>
        <!--/#delivery_date-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Remarks')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="remarks" name="remarks"
                    placeholder="document remarks" value="{{ $document->remarks ?? '' }}">
            </div>
        </div>
        <!--delivered_by<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.delivered_by')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="document_delivered_by" name="document_delivered_by" placeholder="Delivered By"
                     value="{{ $document->delivered_by ?? '' }}">
            </div>
        </div>
        <!--/#delivered_by-->

        <!--delivery_method<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.delivery_method')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="document_delivery_method" name="document_delivery_method" placeholder="Delivery Method"
                     value="{{ $document->delivery_method ?? '' }}">
            </div>
        </div>
        <!--/#delivery_method-->

         <!--expiration<>-->
         <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.expiration')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="document_expiration" placeholder="Expiration Date"
                     value="{{ runtimeDatepickerDate($document->expiration ?? '')  }}">
                     <input class="mysql-date" type="hidden" name="document_expiration" id="document_expiration"
                     value="{{ $document->expiration ?? '' }}">
            </div>
        </div>

      <div>
        <label
        class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Document Copy')) }}*</label>
        <!--fileupload-->
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="dropzone dz-clickable" id="fileupload_document_document_copy">
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
                @if ($attachment->attachment_unique_input === 'document_doc_file')
                <tr id="document_attachment_{{ $attachment->attachment_id ?? '' }}">
                    <td>{{ $attachment->attachment_filename ?? '' }} </td>
                    <td class="w-px-40"> <button type="button"
                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                            data-ajax-type="DELETE"
                            data-url="{{ url('/documents/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
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
        class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Document Submital Copy')) }}*</label>
        <!--fileupload-->
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="dropzone dz-clickable" id="fileupload_document_submital_copy">
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
                @if ($attachment->attachment_unique_input === 'document_submital_copy')
                <tr id="document_attachment_{{ $attachment->attachment_id ?? ''}}">
                    <td>{{ $attachment->attachment_filename }} </td>
                    <td class="w-px-40"> <button type="button"
                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                            data-ajax-type="DELETE"
                            data-url="{{ url('/documents/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
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
