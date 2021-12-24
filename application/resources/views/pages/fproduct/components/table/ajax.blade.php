@foreach($fproducts as $fproduct)
{{-- @dd(config('visibility.action_buttons_delete')) --}}
<tr id="fproduct_{{ $fproduct->id }}">
    <td class="fproducts_col_id">{{ $fproduct->id }}
    </td>
    <td class="fproducts_col_title">
        {{ $fproduct->title }}
    </td>
    <td class="fproducts_col_description">
        {{ str_limit($fproduct->description ??'--', 20) }}
    </td>
    {{-- <td class="fproducts_col_status">
        {{ str_limit($fproduct->status ??'--', 20) }}
    </td> --}}
    <td class="fproducts_col_category">
        {{ str_limit($fproduct->category->name ??'--', 20) }}
    </td>
   
    {{-- @if(config('visibility.fproduct_col_action')) --}}
    <td class="fproducts_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            @if(config('visibility.action_buttons_delete'))
          {{-- delete --}}
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/fproducts/{{ $fproduct->id }}">
                <i class="sl-icon-trash"></i>
            </button>
           @endif
            <!--[edit]-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/fproducts/'.$fproduct->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.fproduct_edit')) }}"
                data-action-url="{{ urlResource('/fproducts/'.$fproduct->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="fproducts-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
            
            <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                data-modal-title="{{ cleanLang(__('Product')) }}" data-url="{{ url('/fproducts/'.$fproduct->id) }}">
                <i class="ti-new-window"></i>
            </button>
        </span>
    
    </td>
    {{-- @endif --}}
</tr>
@endforeach
<!--each row-->