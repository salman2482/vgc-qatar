@foreach ($properties as $property)
    {{-- @dd(config('visibility.action_buttons_delete')) --}}
    <tr id="property_{{ $property->id }}">
        <td class="properties_col_id">{{ $property->id }}
        </td>
        <td class="properties_col_reference_no">
            {{ $property->reference_no }}
        </td>
        <td class="properties_col_title">
            {{ $property->title }}
        </td>
        <td class="properties_col_description">
            {{ str_limit($property->description ?? '---', 20) }}
        </td>
        <td class="properties_col_price">
            {{ $property->price }}
        </td>
        <td class="properties_col_rent_or_sale">
            {{ ucfirst($property->rent_or_sale) }}
        </td>
        <td>
            <span class="label {{ $property->is_approved == 1 ? runtimePropertytatusLabel(1) : runtimePropertytatusLabel(0) }}">
                @if ($property->is_approved == 0)
                    Rejected
                @elseif($property->is_approved == 1)
                    Approved
                @else
                    Suspended
                @endif
            </span>
        </td>


        @if (config('visibility.property_col_action'))
            <td class="properties_col_action actions_column">
                <!--action button-->
                <span class="list-table-action dropdown font-size-inherit">
                    @if (config('visibility.action_buttons_delete'))
                        {{-- delete --}}
                        <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                            class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                            data-url="{{ url('/') }}/properties/{{ $property->id }}">
                            <i class="sl-icon-trash"></i>
                        </button>
                    @endif
                    <!--[edit]-->
                    @if (config('visibility.action_buttons_edit'))
                        <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                            class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                            data-toggle="modal" data-target="#commonModal"
                            data-url="{{ urlResource('/properties/' . $property->id . '/edit') }}"
                            data-loading-target="commonModalBody"
                            data-modal-title="{{ cleanLang(__('lang.property_edit')) }}"
                            data-action-url="{{ urlResource('/properties/' . $property->id) }}"
                            data-action-method="PUT" data-action-ajax-class=""
                            data-action-ajax-loading-target="properties-td-container">
                            <i class="sl-icon-note"></i>
                        </button>
                    @endif
                    <a class="btn btn-outline-info btn-circle btn-sm actions-modal-button js-ajax-ux-request reset-target-modal-form"
                        href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                        data-modal-title="{{ cleanLang(__('lang.change_status')) }}"
                        data-url="{{ urlResource('/properties/' . $property->id . '/change-status') }}"
                        data-action-url="{{ urlResource('/properties/' . $property->id . '/change-status') }}"
                        data-loading-target="actionsModalBody" data-action-method="POST">
                        <i class="sl-icon-note"></i>
                    </a>
                    <!--view-->
                    <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                        class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                        data-modal-title="{{ cleanLang(__('Property Details')) }}"
                        data-url="{{ url('/properties/' . $property->id) }}">
                        <i class="ti-new-window"></i>
                    </button>
                </span>

            </td>
        @endif
    </tr>
@endforeach
<!--each row-->
