@foreach ($contracts as $contract)
    {{-- @dd($contract) --}}
    <tr id="contract_{{ $contract->id }}">
        <td class="contracts_col_id">{{ $contract->id }}
        </td>
        <td class="contracts_col_client_id">
            {{ ucwords($contract->client_company_name) }}
        </td>
        <td class="contracts_col_ref_no">
            {{ $contract->ref_no }}
        </td>
        <td class="contracts_col_category">
            {{ ucwords($contract->category) }}
        </td>
        <td class="contracts_col_issuance_date">
            {{ runtimeDate($contract->issuance_date) }}
        </td>
        <td class="contracts_col_project_value">
            {{ $contract->project_value }}
        </td>

        <td class="contracts_col_status">
            <span class="label {{ runtimeContractStatusLabel($contract->status) }}">{{ $contract->status }}
            </span>

        </td>


        @if (config('visibility.contract_col_action'))
            <td class="contracts_col_action actions_column">
                <!--action button-->
                <span class="list-table-action dropdown font-size-inherit">
                    <!--[delete]-->
                    @if (config('visibility.action_buttons_delete'))
                        <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                            class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                            data-url="{{ url('/') }}/contractsmgt/{{ $contract->id }}">
                            <i class="sl-icon-trash"></i>
                        </button>
                    @endif
                    <!--[edit]-->
                    @if (config('visibility.action_buttons_edit'))
                        <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                            class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                            data-toggle="modal" data-target="#commonModal"
                            data-url="{{ urlResource('/contractsmgt/' . $contract->id . '/edit') }}"
                            data-loading-target="commonModalBody"
                            data-modal-title="{{ cleanLang(__('lang.contract_edit')) }}"
                            data-action-url="{{ urlResource('/contractsmgt/' . $contract->id) }}"
                            data-action-method="PUT" data-action-ajax-class=""
                            data-action-ajax-loading-target="contracts-td-container">
                            <i class="sl-icon-note"></i>
                        </button>
                    @endif
                    <!--view-->
                    <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                        class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                        data-modal-title="{{ cleanLang(__('Contract Details')) }}"
                        data-url="{{ url('/contractsmgt/' . $contract->id) }}">
                        <i class="ti-new-window"></i>
                    </button>
                </span>

            </td>
        @endif
    </tr>
@endforeach
<!--each row-->
