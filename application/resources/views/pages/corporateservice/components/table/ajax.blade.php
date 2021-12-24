
@foreach($corporateservices as $corporateservice)
{{-- @dd(config('visibility.action_buttons_delete')) --}}
<tr id="corporateservice_{{ $corporateservice->id }}">
    <td class="corporateservices_col_id">
        {{ $corporateservice->id }}
    </td>
    <td class="corporateservices_col_title">
        {{ $corporateservice->title }}
    </td>
    <td class="corporateservices_col_description">
        {{ str_limit($corporateservice->description, 30) }}
    </td>
    
    <td class="corporateservices_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
          {{-- delete --}}
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/corporateservices/{{ $corporateservice->id }}">
                <i class="sl-icon-trash"></i>
            </button>
            
            <!--[edit]-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/corporateservices/'.$corporateservice->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.corporateservice_edit')) }}"
                data-action-url="{{ urlResource('/corporateservices/'.$corporateservice->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="corporateservices-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
            
            <button type="button" title="{{ cleanLang(__('lang.view')) }}"
            class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
            data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
            data-modal-title="{{ cleanLang(__(' View corporateservice Show')) }}" 
            data-url="{{ url('/corporateservices/'.$corporateservice->id) }}">
            <i class="ti-new-window"></i>
            </button>
        
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->