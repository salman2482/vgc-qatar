@foreach($vendorqtns as $vendorqtn)

<tr id="vendorqtn_{{ $vendorqtn->id }}">
    <td class="vendorqtns_col_id">
        {{ $vendorqtn->id }}
    </td>
    <td class="vendorqtns_col_rfq_ref">
        {{ $vendorqtn->rfq_ref }}
    </td>
    <td class="vendorqtns_col_first_name">
        {{ $vendorqtn->user->first_name.' '.$vendorqtn->user->last_name }}
    </td>
    <td class="vendorqtns_col_receiving_date">
        {{ $vendorqtn->receiving_date }}
    </td>
    <td class="vendorqtns_col_category">
        {!! str_limit($vendorqtn->category, 20) !!}
    </td>
    <td class="vendorqtns_col_qtn_ref_no">
        {{ $vendorqtn->qtn_ref_no }}
    </td>
    <td class="vendorqtns_col_total_value">
        {{ $vendorqtn->total_value }}
    </td>
    <td class="vendorqtns_col_devlivery_time">
        {{ $vendorqtn->devlivery_time }}
    </td>
    <td class="vendorqtns_col_devlivery_time">
        <a href="{{ route('vendor.qtn.pdf', $vendorqtn->id)}}">Download 
            <i class="ti-download"></i>
        </a>
    </td>
    <td class="vendorqtns_col_upload_qtn_copy">
        @if ($vendorqtn->upload_qtn_copy != null)        
        <a href="{{ asset('storage/public/vendor/' . $vendorqtn->upload_qtn_copy) }}" download>
            Download
        </a>
    @else
    Not Avilable
    @endif
        
    </td>
    <td class="vendorqtns_col_upload_rfq_copy">
    @if ($vendorqtn->upload_rfq_copy != null)        
        <a href="{{ asset('storage/public/vendor/' . $vendorqtn->upload_rfq_copy) }}" download>
            Download
        </a>
    @else
    Not Avilable
    @endif

    </td>

    <td class="vendorqtns_col_status">
        {{-- {{ $vendorqtn->status }} --}}
        @if ( $vendorqtn->status == 'WAITING FOR APPROVAL')
        <span class="badge-font badge bg-light-info text-info font-weight-medium"> {{$vendorqtn->status ?? ''}} </span>
        
        @elseif ( $vendorqtn->status == 'APPROVED')
        <span class="badge-font badge bg-light-success text-success font-weight-medium"> {{$vendorqtn->status ?? ''}} </span>

        @elseif ($vendorqtn->status == 'CANCELLED')
        <span class="badge-font badge bg-light-danger text-danger font-weight-medium"> {{$vendorqtn->status ?? ''}} </span>

        @elseif ($vendorqtn->status == 'REQUESTING FOR DISCOUNT')
        <span class="badge-font badge bg-light-warning text-warning font-weight-medium"> {{$vendorqtn->status ?? ''}} </span>

        @endif
    </td>
   
  
    <td class="vendorqtns_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/vendorqtns/'.$vendorqtn->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('Vendor Qtn Edit')) }}"
                data-action-url="{{ urlResource('/vendorqtns/'.$vendorqtn->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="vendorqtns-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
            {{-- @endif --}}
            <!--view-->
            {{-- <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                data-modal-title="{{ cleanLang(__('Qutation Records')) }}" data-url="{{ url('/vendorqtns/'.$vendorqtn->id) }}">
                <i class="ti-new-window"></i>
            </button> --}}

            <a href="{{ url('/vendorqtns/'.$vendorqtn->id) }}" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">
                <i class="ti-new-window"></i>
            </a>

        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->