{{-- @dd($page) --}}
<div class="row" id="js-employees-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        @php
            $status = ['working', 'leave', 'left', 'terminated'];
        @endphp

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Status')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" name="status" id="status"
                    data-allow-clear="false">
                    @foreach ($status as $item)
                        <option value="{{ $item }}"
                            {{ runtimePreselected($employee->working_status ?? '', $item) }}>
                            {{ ucwords($item) }}
                        </option>
                    @endforeach
                </select>
                {{-- <input type="text" class="form-control form-control-sm" id="rfm_title" name="rfm_title"
                placeholder="" value="{{ $rfm-> ?? '' }}"> --}}
            </div>
        </div>


        {{-- employee no --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Employee No')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="employee_no" name="employee_no"
                    value="{{ $employee->employee_no ?? '' }}">
            </div>
        </div>

        {{-- employee name --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Employee Name')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="employee_name" name="employee_name"
                    value="{{ $employee->employee_name ?? '' }}">
            </div>
        </div>

        {{-- visa_no --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Visa No')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="visa_no" name="visa_no"
                    value="{{ $employee->visa_no ?? '' }}">
            </div>
        </div>

        {{-- id_no --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('ID No')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="id_no" name="id_no"
                    value="{{ $employee->id_no ?? '' }}">
            </div>
        </div>

        {{-- expiration --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Expiration ID')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="expiration"
                    value="{{ runtimeDatepickerDate($employee->expiration ?? '') }}">
                <input class="mysql-date" type="hidden" name="expiration" id="expiration"
                    value="{{ $employee->expiration ?? '' }}">
            </div>
        </div>

        {{-- Passport No --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Passport No')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="passport_no" name="passport_no"
                    value="{{ $employee->passport_no ?? '' }}">
            </div>
        </div>

        {{-- Passport Expiration --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Passport Expiration')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="passport_expiration"
                    value="{{ runtimeDatepickerDate($employee->passport_expiration ?? '') }}">
                <input class="mysql-date" type="hidden" name="passport_expiration" id="passport_expiration"
                    value="{{ $employee->passport_expiration ?? '' }}">
            </div>
        </div>

        {{-- Contract No --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Contract No')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="contract_no" name="contract_no"
                    value="{{ $employee->contract_no ?? '' }}">
            </div>
        </div>

        {{-- Contract Expiration --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Contract Expiration')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="contract_expiration"
                    value="{{ runtimeDatepickerDate($employee->contract_expiration ?? '') }}">
                <input class="mysql-date" type="hidden" name="contract_expiration" id="contract_expiration"
                    value="{{ $employee->contract_expiration ?? '' }}">
            </div>
        </div>

        {{-- Arrival Date --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Arrival Date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="arrival_date"
                    value="{{ runtimeDatepickerDate($employee->arrival_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="arrival_date" id="arrival_date"
                    value="{{ $employee->arrival_date ?? '' }}">
            </div>
        </div>

        {{-- Working Starting Date --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Working Starting Date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="working_starting_date"
                    value="{{ runtimeDatepickerDate($employee->working_starting_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="working_starting_date" id="working_starting_date"
                    value="{{ $employee->working_starting_date ?? '' }}">
            </div>
        </div>

        {{-- PHCC NO --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('PHCC NO')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="phcc_no"
                    value="{{ $employee->phcc_no ?? '' }}">

            </div>
        </div>
        {{-- phcc_expiration --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('phcc_expiration')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="phcc_expiration"
                    value="{{ runtimeDatepickerDate($employee->phcc_expiration ?? '') }}">
                <input class="mysql-date" type="hidden" name="phcc_expiration" id="phcc_expiration"
                    value="{{ $employee->phcc_expiration ?? '' }}">
            </div>
        </div>
        {{-- Joining Visa No --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Joining Visa No')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm " name="joining_visa_no"
                    value="{{ $employee->joining_visa_no ?? '' }}">

            </div>
        </div>

        <div>
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('ID Copy')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="id_copy">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            @if (isset($page['section']) && $page['section'] == 'edit')
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($attachments as $attachment)
                            @if ($attachment->attachment_unique_input === 'id_copy')
                                <tr id="employee_attachment_{{ $attachment->attachment_id ?? '' }}">
                                    <td>{{ $attachment->attachment_filename ?? '' }} </td>
                                    <td class="w-px-40"> <button type="button"
                                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                            data-ajax-type="DELETE"
                                            data-url="{{ url('/employeedocument/attachments/' . $attachment->attachment_uniqiueid ?? '') }}">
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
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Passport Copy')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="passport_copy">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            @if (isset($page['section']) && $page['section'] == 'edit')
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($attachments as $attachment)
                            @if ($attachment->attachment_unique_input === 'passport_copy')
                                <tr id="employee_attachment_{{ $attachment->attachment_id ?? '' }}">
                                    <td>{{ $attachment->attachment_filename ?? '' }} </td>
                                    <td class="w-px-40"> <button type="button"
                                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                            data-ajax-type="DELETE"
                                            data-url="{{ url('/employeedocument/attachments/' . $attachment->attachment_uniqiueid ?? '') }}">
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
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Employement Contract Copy')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="employement_contract_copy">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            @if (isset($page['section']) && $page['section'] == 'edit')
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($attachments as $attachment)
                            @if ($attachment->attachment_unique_input === 'employement_contract_copy')
                                <tr id="employee_attachment_{{ $attachment->attachment_id ?? '' }}">
                                    <td>{{ $attachment->attachment_filename ?? '' }} </td>
                                    <td class="w-px-40"> <button type="button"
                                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                            data-ajax-type="DELETE"
                                            data-url="{{ url('/employeedocument/attachments/' . $attachment->attachment_uniqiueid ?? '') }}">
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
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Hamad Card Copy')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="hamad_card_copy">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            @if (isset($page['section']) && $page['section'] == 'edit')
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($attachments as $attachment)
                            @if ($attachment->attachment_unique_input === 'hamad_card_copy')
                                <tr id="employee_attachment_{{ $attachment->attachment_id ?? '' }}">
                                    <td>{{ $attachment->attachment_filename ?? '' }} </td>
                                    <td class="w-px-40"> <button type="button"
                                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                            data-ajax-type="DELETE"
                                            data-url="{{ url('/employeedocument/attachments/' . $attachment->attachment_uniqiueid ?? '') }}">
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
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Other Document')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="other_document">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            @if (isset($page['section']) && $page['section'] == 'edit')
                <table class="table table-bordered">
                    <tbody>
                        @foreach ($attachments as $attachment)
                            @if ($attachment->attachment_unique_input === 'other_document')
                                <tr id="employee_attachment_{{ $attachment->attachment_id ?? '' }}">
                                    <td>{{ $attachment->attachment_filename ?? '' }} </td>
                                    <td class="w-px-40"> <button type="button"
                                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                            data-ajax-type="DELETE"
                                            data-url="{{ url('/employeedocument/attachments/' . $attachment->attachment_uniqiueid ?? '') }}">
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
