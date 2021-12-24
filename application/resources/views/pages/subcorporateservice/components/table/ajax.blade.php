
@foreach($subcorporateservices as $subcorporateservice)
{{-- @dd(config('visibility.action_buttons_delete')) --}}
<tr id="subcorporateservice_{{ $subcorporateservice->id }}">
    <td class="subcorporateservices_col_id">
        {{ $subcorporateservice->id }}
    </td>
    <td class="subcorporateservices_col_title">
        {{ $subcorporateservice->title }}
    </td>
    <td class="subcorporateservices_col_corporate_service">
        {{ $subcorporateservice->corporateservice->title}}
    </td>
    <td class="subcorporateservices_col_description">
        {{ str_limit($subcorporateservice->description, 30) }}
    </td>
    
    <td class="subcorporateservices_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
          {{-- delete --}}
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/subcorporateservices/{{ $subcorporateservice->id }}">
                <i class="sl-icon-trash"></i>
            </button>
            
            <!--[edit]-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/subcorporateservices/'.$subcorporateservice->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.subcorporateservice_edit')) }}"
                data-action-url="{{ urlResource('/subcorporateservices/'.$subcorporateservice->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="subcorporateservices-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
            
            <button type="button" title="{{ cleanLang(__('lang.view')) }}"
            class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
            data-modal-title="{{ cleanLang(__(' View subcorporateservice Show')) }}" 
            data-url="{{ url('/subcorporateservices/'.$subcorporateservice->id) }}">
            <i class="ti-new-window"></i>
            </button>
        
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->