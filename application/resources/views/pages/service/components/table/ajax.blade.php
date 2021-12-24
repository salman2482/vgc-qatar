@foreach ($services as $service)
    <tr id="service_{{ $service->id }}">
        <td class="services_col_id">{{ $service->id }}
        </td>
        <td class="services_col_title">
            {{ $service->title }}
        </td>
        <td class="services_col_title">
            {{ \Illuminate\Support\Str::limit($service->service_description, 10) ?? 'no data' }}
        </td>
        <td class="services_col_title">
            {{ $service->rate_per_hour ?? 'no data' }}
        </td>
        <td class="services_col_title">
            {{ $service->minimum_charge ?? 'no data' }}
        </td>

        <td class="services_col_action actions_column">
            <!--action button-->
            <span class="list-table-action dropdown font-size-inherit">
                @if (config('visibility.action_buttons_delete'))
                    <!--[delete]-->
                    <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                        data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                        data-url="{{ url('/') }}/services/{{ $service->id }}">
                        <i class="sl-icon-trash"></i>
                    </button>
                @endif
                <!--[edit]-->
                @if (config('visibility.action_buttons_edit'))
                    <a href="{{ urlResource('/services/' . $service->id . '/edit') }}"
                        title="{{ cleanLang(__('Service Edit')) }}" class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm" >
                        <i class="sl-icon-note"></i>
                    </a>
                @endif
                <!--view-->
                <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                    class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                    data-modal-title="{{ cleanLang(__('Service Details')) }}"
                    data-url="{{ url('/services/' . $service->id) }}">
                    <i class="ti-new-window"></i>
                    </a>
            </span>

        </td>
    </tr>
@endforeach
<!--each row-->
