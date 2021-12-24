@foreach($frontclients as $frontclient)
{{-- @dd(config('visibility.action_buttons_delete')) --}}
<tr id="frontclient_{{ $frontclient->id }}">
    <td class="frontclients_col_id">
        {{ $frontclient->id }}
    </td>
    <td class="frontclients_col_title">
        {{ $frontclient->name }}
    </td>
    <td class="frontclients_col_description">
        {{ str_limit($frontclient->description, 20) }}
    </td>

   
    
    <td class="frontclients_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
          {{-- delete --}}
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/frontclients/{{ $frontclient->id }}">
                <i class="sl-icon-trash"></i>
            </button>
            
            <!--[edit]-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/frontclients/'.$frontclient->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.frontclient_edit')) }}"
                data-action-url="{{ urlResource('/frontclients/'.$frontclient->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="frontclients-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
        
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->