<div class="row" id="js-contracts-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <!--client id<>-->
        <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}" />
        {{-- <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Select Client')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <select name="contract_client_id" class="form-control" id="contract_client_id">
                    <option value="1">Test Client</option>
                </select>
            </div>
        </div> --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Select Category')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <select name="contract_category" class="form-control" id="contract_category">
                    <option value="cleaning services">Cleaning Services</option>
                    <option value="casual cleaning">Casual Cleaning</option>
                    <option value="hospitality">{{ ucwords('hospitality') }}</option>
                    <option value="pest control">{{ ucwords('pest control') }}</option>
                    <option value="deep cleaning">{{ ucwords('deep cleaning') }}</option>
                    <option value="HVAC PPM AMC">{{ ucwords('HVAC PPM AMC') }}</option>
                    <option value="INTEGRATED FM">{{ ucwords('INTEGRATED FM') }}</option>
                    <option value="Fire fighting">{{ ucwords('Fire fighting') }}</option>
                    <option value="fire alarm">{{ ucwords('fire alarm') }}</option>
                    <option value="FM 200">{{ ucwords('FM 200') }}</option>
                    <option value="fire alarm">{{ ucwords('fire alarm') }}</option>
                    <option value="FIRE SUPPRESSION ">{{ ucwords('FIRE SUPPRESSION ') }}</option>
                    <option value="CHILLER PUMPS">{{ ucwords('CHILLER PUMPS') }}</option>
                    <option value="GENERATOR MAINTENANCE ">{{ ucwords('GENERATOR MAINTENANCE ') }}</option>
                    <option value="INSTALLATION SERVICES">{{ ucwords('INSTALLATION SERVICES') }}</option>
                    <option value="CORRECTIVE MAINTENANCE ">{{ ucwords('CORRECTIVE MAINTENANCE ') }}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Select Client*')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <!--select2 basic search-->
                <select name="contract_client_id" id="contract_client_id"
                    class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search-modal"
                    data-ajax--url="{{ url('/') }}/feed/company_names">
                    @if(isset($contract->client_id) && $contract->client_id != '')
                    <option value="{{ $contract->client_id ?? '' }}">{{ $contract->client_company_name }}
                    </option>
                    @endif
                </select>
            </div>
        </div>
        <!--/#client id-->

       
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Description')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <textarea name="contract_description" id="contract_description" class="form-control form-control-sm" cols="30" rows="10" >{{ $contract->description ?? ''}}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Issuance Date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="contract_issuance_date"  value="{{ runtimeDatepickerDate($contract->issuance_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="contract_issuance_date" id="contract_issuance_date" value="{{ $contract->issuance_date ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Signed By')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" name="contract_signed_by" id="contract_signed_by" value="{{ $contract->signed_by ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Starting Date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="contract_starting_date"  value="{{ runtimeDatepickerDate($contract->sarting_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="contract_starting_date" id="contract_starting_date" value="{{ $contract->sarting_date ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Expiry Date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="contract_expiry_date"  value="{{ runtimeDatepickerDate($contract->expiray_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="contract_expiry_date" id="contract_expiry_date" value="{{ $contract->expiray_date ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Renewal Date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="contract_renewal_date"  value="{{ runtimeDatepickerDate($contract->renewal_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="project_date_due"
                    value="{{ $contract->renewal_date ?? '' }}">
                    <input class="mysql-date" type="hidden" name="contract_renewal_date" id="contract_renewal_date" value="{{ $contract->renewal_date ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Project Value')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="contract_project_value" id="contract_project_value" value="{{ $contract->project_value ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Remarks')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="contract_remarks" id="contract_remarks" value="{{ $contract->remarks ?? '' }}">
            </div>
        </div>

        <!--attach recipt-->
        <div>
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('PO Copy')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="fileupload_contracts_lpo_copy">
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
                    @if ($attachment->attachment_unique_input === 'lpo')
                    <tr id="govtdocument_attachment_{{ $attachment->attachment_id ?? '' }}">
                        <td>{{ $attachment->attachment_filename ?? '' }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                data-ajax-type="DELETE"
                                data-url="{{ url('/contractsmgt/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
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
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Contract Copy')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="fileupload_contract_copy">
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
                    @if ($attachment->attachment_unique_input === 'contract')
                    <tr id="govtdocument_attachment_{{ $attachment->attachment_id ?? ''}}">
                        <td>{{ $attachment->attachment_filename }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                data-ajax-type="DELETE"
                                data-url="{{ url('/contractsmgt/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
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
        
        {{-- <div class="" id="add_contract_lpo_copy">
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="fileupload_contract_lpo_copy">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>Drop files here or click to upload</span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- <div  id="add_contract_contract_copy">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="dropzone dz-clickable" id="fileupload_contract_contract_copy">
                            <div class="dz-default dz-message">
                                <i class="icon-Upload-toCloud"></i>
                                <span>Drop files here or click to upload</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        <!--/#description-->
        
     
            <!--pass source-->
            <input type="hidden" name="source" value="{{ request('source') }}">

        </div>

    </div>
</div>
