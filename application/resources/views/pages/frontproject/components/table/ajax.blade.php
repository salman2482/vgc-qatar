@foreach($frontprojects as $frontproject)
{{-- @dd(config('visibility.action_buttons_delete')) --}}
<tr id="frontproject_{{ $frontproject->id }}">
    <td class="frontprojects_col_id">
        {{ $frontproject->id }}
    </td>
    <td class="frontprojects_col_title">
        {{ $frontproject->title }}
    </td>
    <td class="frontprojects_col_description">
        {{ $frontproject->contractor }}
    </td>
    <td class="frontprojects_col_description">
        {{ $frontproject->client }}
    </td>
    <td class="frontprojects_col_description">
        {{ $frontproject->status }}
    </td>
   
    
    <td class="frontprojects_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
          {{-- delete --}}
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/frontprojects/{{ $frontproject->id }}">
                <i class="sl-icon-trash"></i>
            </button>

            
            <!--[edit]-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/frontprojects/'.$frontproject->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.frontproject_edit')) }}"
                data-action-url="{{ urlResource('/frontprojects/'.$frontproject->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="frontprojects-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
        
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->