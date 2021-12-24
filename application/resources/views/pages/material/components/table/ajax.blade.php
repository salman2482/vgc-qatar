@foreach($materials as $material)

<tr id="material_{{ $material->id }}">
    <td class="materials_col_id">
        {{ $material->id }}
    </td>
    <td class="materials_col_title">

        {{ $material->title }}
    </td>
    <td class="materials_col_value">
        {{ $material->amount }}
    </td>
    <td class="materials_col_description">
        {{str_limit($material->description,55)  }}
    </td>
    <td class="materials_col_category">
        {{ $material->category }}
    </td>
    <td class="materials_col_availablestock">
        {{ $material->available_stock }}
    </td>

    <td class="materials_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            {{-- @if(config('visibility.action_buttons_delete')) --}}
            <!--[delete]-->
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/materials/{{ $material->id }}">
                <i class="sl-icon-trash"></i>
            </button>
           {{-- @endif --}}
            <!--[edit]-->
            {{-- @if(config('visibility.action_buttons_edit')) --}}
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/materials/'.$material->id.'/edit') }}"
                data-loading-target="commonModalBody" data-modal-title="{{ cleanLang(__('Material Edit')) }}"
                data-action-url="{{ urlResource('/materials/'.$material->id) }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="materials-td-container">
                <i class="sl-icon-note"></i>
            </button>
            {{-- @endif --}}
        </span>

    </td>
</tr>
@endforeach
<!--each row-->