@foreach($vendorinvoices as $vendorinvoice)

<tr id="vendorinvoice_{{ $vendorinvoice->id }}">
    <td class="vendorinvoices_col_id">
        {{ $vendorinvoice->id }}
    </td>
    <td class="vendorinvoices_col_lpo_ref">
        {{ $vendorinvoice->user->company_name }}
    </td>
    <td class="vendorinvoices_col_lpo_ref">
        {{ $vendorinvoice->lpo_ref }}
    </td>
    
    <td class="vendorinvoices_col_category">
        {!! str_limit($vendorinvoice->category, 20) !!}

    </td>
    
    <td class="vendorinvoices_col_delivery_date">
        {{ $vendorinvoice->delivery_date }}
    </td>
    <td class="vendorinvoices_col_invoice_ref_no">
        {{ $vendorinvoice->invoice_ref_no }}
    </td>
    <td class="vendorinvoices_col_total_value">
        {{ $vendorinvoice->total_value }}
    </td>
    <td class="vendorinvoices_col_status">
        {{-- {{ $vendorinvoice->status }} --}}
        @if ( $vendorinvoice->status == 'Ready For collection')
        <span class="badge-font badge bg-light-info text-info font-weight-medium"> {{$vendorinvoice->status ?? ''}} </span>
        
        @elseif ( $vendorinvoice->status == 'Approved')
        <span class="badge-font badge bg-light-success text-success font-weight-medium"> {{$vendorinvoice->status ?? ''}} </span>

        @elseif ($vendorinvoice->status == 'Request For Amendment')
        <span class="badge-font badge bg-light-warning text-warning font-weight-medium"> {{$vendorinvoice->status ?? ''}} </span>

        @elseif ($vendorinvoice->status == 'Received For Authentication')
        <span class="badge-font badge bg-light-danger text-danger font-weight-medium"> {{$vendorinvoice->status ?? ''}} </span>
        @endif
    </td>
    
    <td class="vendorinvoices_col_upload_lpo_copy">
        @if ($vendorinvoice->upload_lpo_copy != null)        
        <a href="{{ asset('storage/public/vendor/' . $vendorinvoice->upload_lpo_copy) }}" download>
            Download
        </a>
    @else
    Not Avilable
    @endif
    </td>

    <td class="vendorinvoices_col_upload_invoice_copy">
    @if ($vendorinvoice->upload_invoice_copy != null)        
        <a href="{{ asset('storage/public/vendor/' . $vendorinvoice->upload_invoice_copy) }}" download>
            Download
        </a>
    @else
    Not Avilable
    @endif
    </td>

    <td class="vendorinvoices_col_upload_qtn_copy">
    @if ($vendorinvoice->upload_qtn_copy != null)        
        <a href="{{ asset('storage/public/vendor/' . $vendorinvoice->upload_qtn_copy) }}" download>
            Download
        </a>
    @else
    Not Avilable
    @endif    
    </td>
    
   
    <td class="vendorinvoices_col_reason">
        @if( $vendorinvoice->status == 'Request For Amendment')
            {!! str_limit($vendorinvoice->reason, 15) !!}
        @endif
    </td>
  
    <td class="vendorinvoices_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            @if(config('visibility.action_buttons_delete'))
            <!--[delete]-->
            {{-- <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/vendorinvoices/{{ $vendorinvoice->id }}">
                <i class="sl-icon-trash"></i>
            </button> --}}
           @endif
            
           <!--[edit]-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/vendorinvoices/'.$vendorinvoice->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('Vendor invoice Edit')) }}"
                data-action-url="{{ urlResource('/vendorinvoices/'.$vendorinvoice->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="vendorinvoices-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
           
            <!--view-->
            <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                data-modal-title="{{ cleanLang(__('Invoice Records')) }}" data-url="{{ url('/vendorinvoices/'.$vendorinvoice->id) }}">
                <i class="ti-new-window"></i>
            </button>
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->