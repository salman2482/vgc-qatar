<div class="row" id="js-quotations-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <!--client id<>-->
        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Select Client*')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <!--select2 basic search-->
                <select name="quotation_client_id" id="quotation_client_id"
                    class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search-modal"
                    data-ajax--url="{{ url('/') }}/feed/company_names">
                    @if(isset($quotation->client_id) && $quotation->client_id != '')
                        <option value="{{ $quotation->client_id ?? '' }}">
                            {{ $quotation->client_company_name }}
                        </option>
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Client Rfq Ref')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" name="client_rfq_ref" id="client_rfq_ref" value="{{ $quotation->client_rfq_ref ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Issuance Date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="issuance_date" value="{{ runtimeDatepickerDate($quotation->issuance_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="issuance_date" id="issuance_date"
                    value="{{ $quotation->issuance_date ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Expiration')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="expiration" value="{{ runtimeDatepickerDate($quotation->expiration ?? '') }}">
                <input class="mysql-date" type="hidden" name="expiration" id="expiration"
                value="{{ $quotation->expiration ?? '' }}">
                
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Delivery Date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="delivery_date"  value="{{ runtimeDatepickerDate($quotation->delivery_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="delivery_date" id="delivery_date"
                value="{{ $quotation->delivery_date ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Estimated By')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="estimated_by" id="estimated_by" value="{{ $quotation->estimated_by ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Delivered By')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="delivered_by" id="delivered_by" value="{{ $quotation->delivered_by ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Delivery Method')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="delivery_method" id="delivery_method" value="{{ $quotation->delivery_method ?? '' }}">
            </div>
        </div>

        <div>
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Transmittal Copy')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="transmital_copy">
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
                    @if ($attachment->attachment_unique_input === 'transmital_copy')
                    <tr id="quotation_attachment_{{ $attachment->attachment_id ?? '' }}">
                        <td>{{ $attachment->attachment_filename ?? '' }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                data-ajax-type="DELETE"
                                data-url="{{ url('/quotations/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
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
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Financial Copy')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="financial_copy">
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
                    @if ($attachment->attachment_unique_input === 'financial_copy')
                    <tr id="quotation_attachment_{{ $attachment->attachment_id ?? ''}}">
                        <td>{{ $attachment->attachment_filename }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                data-ajax-type="DELETE"
                                data-url="{{ url('/quotations/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
                                <i class="sl-icon-trash"></i>
                            </button></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <div>
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Technical Copy')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="technical_copy">
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
                    @if ($attachment->attachment_unique_input === 'technical_copy')
                    <tr id="quotation_attachment_{{ $attachment->attachment_id ?? ''}}">
                        <td>{{ $attachment->attachment_filename }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                data-ajax-type="DELETE"
                                data-url="{{ url('/quotations/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
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
