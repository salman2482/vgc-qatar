@foreach ($employees as $employee)
    <tr id="employee_{{ $employee->id }}">
        <td class="employees_col_id">{{ $employee->id }}
        </td>
        <td class="employees_col_employee_no">
            {{ $employee->employee_no }}
        </td>
        <td class="employees_col_employee_name">
            {{ $employee->employee_name }}
        </td>
        <td class="employees_col_expiration">
            {{ runtimeDate($employee->expiration) }}
        </td>
        <td class="employees_col_visa_no">
            {{ $employee->visa_no }}
        </td>
        <td class="employees_col_id_no">
            {{ $employee->id_no }}
        </td>
        <td class="employees_col_passport_no">
            {{ $employee->passport_no }}
        </td>
        <td class="employees_col_passport_expiration">
            {{ runtimeDate($employee->passport_expiration) }}
        </td>
        <td class="employees_col_status">
            <span
                class="label {{ runtimeLegalDocumentStatusLabel($employee->status) }}">{{ $employee->status }}</span>
        </td>
        <td class="employees_col_employee_status">
            <span
                class="label {{ runtimeLegalDocumentStatusLabel($employee->working_status) }}">{{ $employee->working_status }}</span>
        </td>


        <td class="documents_col_action actions_column">
            <!--action button-->
            <span class="list-table-action dropdown font-size-inherit">
                @if (config('visibility.action_buttons_delete'))
                    <!--[delete]-->
                    <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                        data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                        data-url="{{ url('/') }}/employeedocument/{{ $employee->id }}">
                        <i class="sl-icon-trash"></i>
                    </button>
                @endif
                <!--[edit]-->
                @if (config('visibility.action_buttons_edit'))
                    <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#commonModal"
                        data-url="{{ urlResource('/employeedocument/' . $employee->id . '/edit') }}"
                        data-loading-target="commonModalBody"
                        data-modal-title="{{ cleanLang(__('Edit Employee Legal Document')) }}"
                        data-action-url="{{ urlResource('/employeedocument/' . $employee->id) }}"
                        data-action-method="PUT" data-action-ajax-class=""
                        data-action-ajax-loading-target="employee-td-container">
                        <i class="sl-icon-note"></i>
                    </button>
                @endif
                <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                    class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                    data-modal-title="{{ cleanLang(__('Employee Legal Document Details')) }}"
                    data-url="{{ url('/employeedocument/' . $employee->id) }}">
                    <i class="ti-new-window"></i>
                </button>
            </span>

        </td>
    </tr>
@endforeach
<!--each row-->
