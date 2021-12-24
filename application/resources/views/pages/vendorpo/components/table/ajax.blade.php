@foreach($vendorpos as $vendorpo)

<tr id="vendorpo_{{ $vendorpo->id }}">
    <td class="vendorpos_col_id">
        {{ $vendorpo->id }}
    </td>
    <td class="vendorpos_col_vendor_name">
        {{ $vendorpo->user->first_name ?? '' }}
    </td>
    <td class="vendorpos_col_po_ref">
        {{ $vendorpo->po_ref }}
    </td>
    <td class="vendorpos_col_issuing_date">
        {{ $vendorpo->issuing_date }}
    </td>
    <td class="vendorpos_col_qtn_ref_no">
        {{ $vendorpo->qtn_ref_no }}
    </td>
    <td class="vendorpos_col_category">
        {!! str_limit($vendorpo->category, 20) !!}

    </td>
    <td class="vendorpos_col_total_value">
        {{ $vendorpo->total_value }}
    </td>
    <td class="vendorpos_col_terms_condition">
        {!! str_limit($vendorpo->terms_condition, 25)  !!}
    </td>
    <td class="vendorpos_col_payment_method">
        {{ $vendorpo->payment_method }}
    </td>
    {{-- <td class="vendorpos_col_status">
        {{ $vendorpo->status }}
    </td> --}}
    {{-- <td class="vendorpos_col_qtn_copy">
    @if ($attachment = \App\Models\Attachment::select('attachment_uniqiueid')->Where('attachmentresource_id', $vendorpo->id)
    ->Where('attachmentresource_type', 'vendorpo')->first())
        
    <a href="vendorpos/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
        Download 
        <i class="ti-download"></i>
    </a>
    @else
    Not Available
    @endif
    </td> --}}

    {{-- <td class="vendorpos_col_po_copy">
        @if ($attachment = \App\Models\Attachment::select('attachment_uniqiueid')->Where('attachmentresource_id', $vendorpo->id)
        ->Where('attachmentresource_type', 'vendorpo')->first())
            
        <a href="vendorpos/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
            Download 
            <i class="ti-download"></i>
        </a>
        @else
        Not Available
        @endif
        </td>
     --}}
    {{-- <td class="vendorpos_col_status">
        {{ $vendorpo->status }}
    </td> --}}
    
    {{-- <td class="vendorpos_col_description">
        {{ str_limit($vendorpo->description ??'---', 20) }}
    </td>
    --}}
    <td class="vendorpos_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            @if(config('visibility.action_buttons_delete'))
            <!--[delete]-->
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/vendorpos/{{ $vendorpo->id }}">
                <i class="sl-icon-trash"></i>
            </button>
           @endif
            <!--[edit]-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/vendorpos/'.$vendorpo->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('Vendor PO Edit')) }}"
                data-action-url="{{ urlResource('/vendorpos/'.$vendorpo->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="vendorpos-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
            <!--view-->
            <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                data-modal-title="{{ cleanLang(__('Government Records')) }}" data-url="{{ url('/vendorpos/'.$vendorpo->id) }}">
                <i class="ti-new-window"></i>
            </button>
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->