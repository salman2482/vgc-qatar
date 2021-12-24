@foreach($govtdocuments as $govtdocument)

<tr id="govtdocument_{{ $govtdocument->id }}">
    <td class="govtdocuments_col_id">
        {{ $govtdocument->id }}
    </td>
    <td class="govtdocuments_col_type_of_document">
        {{ $govtdocument->type_of_document }}
    </td>
    <td class="govtdocuments_col_doc_no">
        {{ $govtdocument->doc_no }}
    </td>
    <td class="govtdocuments_col_issue_date">
        {{ $govtdocument->issue_date }}
    </td>
    <td class="govtdocuments_col_validity_date">
        {{ $govtdocument->validity_date }}
    </td>
    <td class="govtdocuments_col_renewal_cost">
        {{ $govtdocument->renewal_cost }}
    </td>
    <td class="govtdocuments_col_last_renewal_by">
        {{ $govtdocument->last_renewal_by }}
    </td>
    {{-- <td class="govtdocuments_col_document_copy">
    @if ($attachment = \App\Models\Attachment::select('attachment_uniqiueid')->Where('attachmentresource_id', $govtdocument->id)
    ->Where('attachmentresource_type', 'govtdocument')->where('attachment_unique_input','document_attachments')->first())
        
    <a href="govtdocuments/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
        Download 
        <i class="ti-download"></i>
    </a>
    @else
    Not Available
    @endif
    </td> --}}
    {{-- <td class="govtdocuments_col_last_renewal_copy">
        {{ $govtdocument->last_renewal_copy }}
    </td> --}}
    <td class="govtdocuments_col_status">
        {{ $govtdocument->status }}
    </td>
    
    {{-- <td class="govtdocuments_col_description">
        {{ str_limit($govtdocument->description ??'---', 20) }}
    </td>
    --}}
    <td class="govtdocuments_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            {{-- @if(config('visibility.action_buttons_delete')) --}}
            <!--[delete]-->
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/govtdocuments/{{ $govtdocument->id }}">
                <i class="sl-icon-trash"></i>
            </button>
           {{-- @endif --}}
            <!--[edit]-->
            {{-- @if(config('visibility.action_buttons_edit')) --}}
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/govtdocuments/'.$govtdocument->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('Govt Document Edit')) }}"
                data-action-url="{{ urlResource('/govtdocuments/'.$govtdocument->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="govtdocuments-td-container">
                <i class="sl-icon-note"></i>
            </button>
            {{-- @endif --}}
            <!--view-->
            <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                data-modal-title="{{ cleanLang(__('Government Records')) }}" data-url="{{ url('/govtdocuments/'.$govtdocument->id) }}">
                <i class="ti-new-window"></i>
            </button>
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->