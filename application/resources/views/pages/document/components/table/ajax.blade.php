@foreach ($documents as $document)
    <tr id="document_{{ $document->id }}">
        <td class="documents_col_id">{{ $document->id }}
        </td>
        <td class="documents_col_ref_no">
            {{ $document->ref_no }}
        </td>
        <td class="documents_col_issue_date">
            {{ runtimeDate($document->issue_date) }}
        </td>
        <td class="documents_col_subject">
            {{ $document->subject }}
        </td>
        <td class="documents_col_delivered_by">
            {{ $document->delivered_by }}
        </td>

        <td class="documents_col_status">
            <span
                class="label {{ runtimeDocumentStatusLabel($document->status ?? 'valid') }}">{{ $document->status ?? 'valid' }}
            </span>
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
                        data-url="{{ url('/') }}/documents/{{ $document->id }}">
                        <i class="sl-icon-trash"></i>
                    </button>
                @endif
                <!--[edit]-->
                @if (config('visibility.action_buttons_edit'))
                    <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#commonModal"
                        data-url="{{ urlResource('/documents/' . $document->id . '/edit') }}"
                        data-loading-target="commonModalBody"
                        data-modal-title="{{ cleanLang(__('lang.document_edit')) }}"
                        data-action-url="{{ urlResource('/documents/' . $document->id) }}" data-action-method="PUT"
                        data-action-ajax-class="" data-action-ajax-loading-target="documents-td-container">
                        <i class="sl-icon-note"></i>
                    </button>
                @endif
                <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                    class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                    data-modal-title="{{ cleanLang(__('Document Details')) }}"
                    data-url="{{ url('/documents/' . $document->id) }}">
                    <i class="ti-new-window"></i>
                </button>
            </span>

        </td>
    </tr>
@endforeach
<!--each row-->
