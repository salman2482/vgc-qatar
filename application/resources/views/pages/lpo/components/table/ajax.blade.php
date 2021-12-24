@foreach ($lpos as $lpo)

    <tr id="lpo_{{ $lpo->id }}">
        <td class="lpos_col_id">
            {{ $lpo->id }}
        </td>
        <td class="lpos_col_ref_no">
            {{ $lpo->ref_no }}
        </td>
        <td class="lpos_col_rfm_ref_no">
            {{ $lpo->rfm_ref_no }}
        </td>
        <td class="lpos_col_subject">
            {{ $lpo->subject }}
        </td>
        <td class="lpos_col_date_requested">
            {{ runtimeDate($lpo->date_requested) }}
        </td>
        <td class="lpos_col_requestor">
            {{ $lpo->requestor }}
        </td>
        <td class="lpos_col_rfm_link">
            <a title="{{ cleanLang(__('lang.download')) }}" title="{{ cleanLang(__('lang.download')) }}"
            class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-warning btn-circle btn-sm"
            href="{{ url('/rfms/'.$lpo->rfm_ref_no.'/pdf') }}" >
            <i class="ti-import"></i></a>
        </td>
        <td class="lpos_col_lpo_link">
            <a title="{{ cleanLang(__('lang.download')) }}" title="{{ cleanLang(__('lang.download')) }}"
            class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-warning btn-circle btn-sm"
            href="{{ url('/lpos/'.$lpo->id.'/pdf') }}" >
            <i class="ti-import"></i></a>
        </td>

        <td class="lpos_col_action actions_column">
            <!--action button-->
            <span class="list-table-action dropdown font-size-inherit">
                @if (config('visibility.action_buttons_delete'))
                <!--[delete]-->
                <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                    class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                    data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                    data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                    data-url="{{ url('/') }}/lpos/{{ $lpo->id }}">
                    <i class="sl-icon-trash"></i>
                </button>
                @endif
                <!--[edit]-->
                @if (config('visibility.action_buttons_edit'))
                {{-- <button type="button" title="{{ cleanLang(__('Lpo Edit')) }}"
                    class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#commonModal"
                    data-url="{{ urlResource('/lpos/' . $lpo->id . '/edit') }}"
                    data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('PO Edit')) }}"
                    data-action-url="{{ urlResource('/lpos/' . $lpo->id) }}" data-action-method="PUT"
                    data-action-ajax-class="" data-action-ajax-loading-target="lpos-td-container">
                    <i class="sl-icon-note"></i>
                </button> --}}
                @endif
                <!--view-->
                <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                    class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                    data-modal-title="{{ cleanLang(__('PO Details')) }}"
                    data-url="{{ url('/lpos/' . $lpo->id) }}">
                    <i class="ti-new-window"></i>
                </button>
            </span>

        </td>
    </tr>
@endforeach
<!--each row-->
