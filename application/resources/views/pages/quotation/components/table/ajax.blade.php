@foreach ($quotations as $quotation)
    <tr id="quotation_{{ $quotation->id }}">
        <td class="quotations_col_id">{{ $quotation->id }}
        </td>
        <td class="quotations_col_ref_no">
            {{ $quotation->ref_no }}
        </td>
        <td class="quotations_col_client_id">
            {{ ucwords($quotation->client_company_name) }}
        </td>
        <td class="quotations_col_client_req_ref">
            {{ $quotation->client_rfq_ref }}
        </td>
        <td class="quotations_col_issuance_date">
            {{ $quotation->issuance_date }}
        </td>
        <td class="quotations_col_estimated_by">
            {{ $quotation->estimated_by }}
        </td>
        <td class="quotations_col_status">
            <span
                class="label {{ runtimeQuotationStatusLabel($quotation->status) }}">{{ $quotation->status ?? 'valid' }}
            </span>
        </td>
        <td class="quotations_col_action actions_column">
            <!--action button-->
            <span class="list-table-action dropdown font-size-inherit">
                @if (config('visibility.action_buttons_delete'))
                    <!--[delete]-->
                    <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                        data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                        data-url="{{ url('/') }}/quotations/{{ $quotation->id }}">
                        <i class="sl-icon-trash"></i>
                    </button>
                @endif
                <!--[edit]-->
                @if (config('visibility.action_buttons_edit'))
                    <button type="button" title="{{ cleanLang(__('Quotation Edit')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#commonModal"
                        data-url="{{ urlResource('/quotations/' . $quotation->id . '/edit') }}"
                        data-loading-target="commonModalBody"
                        data-modal-title="{{ cleanLang(__('Quotation Edit')) }}"
                        data-action-url="{{ urlResource('/quotations/' . $quotation->id) }}" data-action-method="PUT"
                        data-action-ajax-class="" data-action-ajax-loading-target="quotations-td-container">
                        <i class="sl-icon-note"></i>
                    </button>
                @endif
                <!--view-->
                <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                    class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                    data-modal-title="{{ cleanLang(__('Quotation Details')) }}"
                    data-url="{{ url('/quotations/' . $quotation->id) }}">
                    <i class="ti-new-window"></i>
                </button>

                <span class="list-table-action dropdown font-size-inherit">
                    <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" title="{{ cleanLang(__('lang.more')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm">
                        <i class="ti-more"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="listTableAction">
                        {{-- <a title="{{ cleanLang(__('Change Status')) }}"
                        class="dropdown-item  actions-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#actionsModal"
                        data-url="{{ urlResource('/quotations/' . $quotation->id . '/change-status') }}"
                        data-loading-target="actionsModalBody"
                        data-modal-title="{{ cleanLang(__('Change Status')) }}"
                        data-action-url="{{ urlResource('/quotations/' . $quotation->id) }}" data-action-method="POST"
                        data-action-ajax-class="">
                        {{ cleanLang(__('Change Status')) }}
                    </a> --}}
                        <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form"
                            href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                            data-modal-title="{{ cleanLang(__('lang.change_status')) }}"
                            data-url="{{ urlResource('/quotations/' . $quotation->id . '/change-status') }}"
                            data-action-url="{{ urlResource('/quotations/' . $quotation->id . '/change-status') }}"
                            data-loading-target="actionsModalBody" data-action-method="POST">
                            {{ cleanLang(__('lang.change_status')) }}</a>
                    </div>
                </span>




            </span>

        </td>
    </tr>
@endforeach
<!--each row-->
