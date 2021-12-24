@foreach($properties as $property)

<tr id="property_{{ $property->id }}">
    {{-- <td class="properties_col_checkbox checkitem" id="properties_col_checkbox_{{ $property->id }}">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-properties-{{ $property->id }}"
                name="ids[{{ $property->id }}]"
                class="listcheckbox listcheckbox-properties filled-in chk-col-light-blue"
                data-actions-container-class="properties-checkbox-actions-container">
            <label for="listcheckbox-properties-{{ $property->id }}"></label>
        </span>
    </td> --}}
    <td class="properties_col_id">{{ $property->id }}</label
    </td>
    <td class="properties_col_title">
        {{ $property->title }}
    </td>
    <td class="properties_col_description">
        {{ str_limit($property->description ??'---', 20) }}
    </td>
   
    <td class="properties_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            @if(config('visibility.action_buttons_delete'))
            <!--[delete]-->
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/properties/{{ $property->id }}">
                <i class="sl-icon-trash"></i>
            </button>
           @endif
            <!--[edit]-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/properties/'.$property->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('lang.property_edit')) }}"
                data-action-url="{{ urlResource('/properties/'.$property->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="properties-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
            {{-- <!--view-->
            <a href="/properties/{{ $property->id }}" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">
                <i class="ti-new-window"></i>
            </a> --}}
        </span>
    
    </td>
</tr>
@endforeach
<!--each row-->