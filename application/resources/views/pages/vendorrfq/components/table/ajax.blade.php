@foreach($vendorrfqs as $vendorrfq)

<tr id="vendorrfq_{{ $vendorrfq->id }}">
    <td class="vendorrfqs_col_id">
        {{ $vendorrfq->id }}
    </td>
    <td class="vendorrfqs_col_rfq_ref">
        {{ $vendorrfq->rfq_ref }}
    </td>
    <td class="vendorrfqs_col_category">
        {!! str_limit($vendorrfq->category, 20)!!}
    </td>
    <td class="vendorrfqs_col_category">
        {{ $vendorrfq->company_category }}
    </td>
    <td class="vendorrfqs_col_priority">
        {{ $vendorrfq->priority }}
    </td>
    <td class="vendorrfqs_col_due_date_request">
        {{ $vendorrfq->due_date_request }}
    </td>
   

    <td class="vendorrfqs_col_required_quotation_validity">
        {{ $vendorrfq->required_quotation_validity }}
    </td>
    <td class="vendorrfqs_col_status">
        @php 
        $TodayDate = Date('Y-m-d'); 
        @endphp 
        @if($TodayDate > $vendorrfq->due_date_request)
        <span class="badge-font badge bg-light-danger text-danger">EXPIRED</span> 
        @else
        <span class="badge-font badge bg-light-primary text-primary">
            {{ $vendorrfq->status }}
        </span>
            
        @endif
    </td>
  
    <td class="vendorrfqs_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">

            
            @if(config('visibility.action_buttons_delete'))
            <!--[delete]-->
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/vendorrfqs/{{ $vendorrfq->id }}">
                <i class="sl-icon-trash"></i>
            </button>
           @endif

           @if($vendorrfq->is_material_added != 1 )
            <!--[edit]-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/vendorrfqs/'.$vendorrfq->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('Vendor Rfq Edit')) }}"
                data-action-url="{{ urlResource('/vendorrfqs/'.$vendorrfq->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="vendorrfqs-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
            @endif
            <!--view-->
            <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                data-modal-title="{{ cleanLang(__('RFQ')) }}" data-url="{{ url('/vendorrfqs/'.$vendorrfq->id) }}">
                <i class="ti-new-window"></i>
            </button>
            
            {{-- multi items vendor rfq --}}
            @if($vendorrfq->is_material_added != 1 )
            <a href="{{url('vendorrfqs/add/items/'.$vendorrfq->id)}}" title="" class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm" data-original-title="Add Rfm Materials" aria-describedby="tooltip720428">
                <i class="sl-icon-plus"></i>
            </a>
            @endif
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->