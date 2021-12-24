@foreach ($frontusers as $vuser)
    <!--each row-->
    <tr id="frontuser_{{ $vuser->id }}">
        <td class="frontusers_col_first_name" id="frontusers_col_first_name_{{ $vuser->id }}">
            <span class="user-avatar-container"><img src="{{ $vuser->avatar }}" alt="user"
                    class="img-circle avatar-xsmall">
                @if ($vuser->is_online)
                    <span class="online-status bg-success" data-toggle="tooltip"
                        title="{{ cleanLang(__('lang.user_is_online')) }}"></span>
                @endif
            </span> <span>{{ $vuser->first_name }}</span>
            {{ $vuser->last_name }}
            <!--account owner-->
            @if ($vuser->account_owner == 'yes')
                <span class="sl-icon-star text-warning p-l-5" data-toggle="tooltip"
                    title="{{ cleanLang(__('lang.account_owner')) }}"
                    id="account_owner_icon_{{ $vuser->clientid }}"></span>
            @endif

        </td>
        {{-- @if (config('visibility.frontusers_col_client')) --}}
        <td class="frontusers_col_company" id="frontusers_col_company_{{ $vuser->id }}">
            {{ $vuser->company_name ?? '' }}
        </td>
        {{-- @endif --}}
        <td class="frontusers_col_email" id="frontusers_col_email_{{ $vuser->id }}">
            {{ $vuser->email }}
        </td>
        <td class="frontusers_col_phone" id="frontusers_col_phone_{{ $vuser->id }}">{{ $vuser->phone ?? '---' }}
        </td>
        {{-- @if (config('visibility.frontusers_col_last_active')) --}}
        <td class="frontusers_col_last_active" id="frontusers_col_last_active_{{ $vuser->id }}">
            {{ $vuser->carbon_last_seen }}
        </td>

        @if ($vuser->status == 'unverified')
            <td class="clients_col_status" id="clients_col_status_{{ $vuser->client_id }}">
                <span class="label {{ runtimeClientStatusLabel('suspended') }}">
                    {{ 'Not Verified' }}</span>
            </td>
        @else
            <td class="vuser_col_status" id="frontuser_col_status_{{ $vuser->client_id }}">
                <span
                    class="label {{ runtimeClientStatusLabel($vuser->status) }}">{{ runtimeLang($vuser->status) }}</span>
            </td>
        @endif

        {{-- @endif --}}
        {{-- @if (config('visibility.action_column')) --}}
        <td class="frontusers_col_action actions_column" id="frontusers_col_action_{{ $vuser->id }}">
            <!--action button-->
            <span class="list-table-action dropdown font-size-inherit">
                <!--delete-->
                @if (auth()->user()->is_admin)
                    <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                        data-confirm-title="{{ cleanLang(__('lang.delete_user')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                        data-url="{{ url('/') }}/frontusers/{{ $vuser->id }}">
                        <i class="sl-icon-trash"></i>
                    </button>
                @endif
                <a class="btn btn-outline-info btn-circle btn-sm actions-modal-button js-ajax-ux-request reset-target-modal-form"
                    href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                    data-modal-title="{{ cleanLang(__('lang.change_status')) }}"
                    data-url="{{ urlResource('/frontusers/' . $vuser->id . '/change-status') }}"
                    data-action-url="{{ urlResource('/frontusers/' . $vuser->id . '/change-status') }}"
                    data-loading-target="actionsModalBody" data-action-method="POST">
                    <i class="sl-icon-note"></i>
                </a>
                <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                    class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                    data-modal-title="{{ cleanLang(__('User Details')) }}"
                    data-url="{{ url('/frontusers/' . $vuser->id) }}">
                    <i class="ti-new-window"></i>
                </button>
            </span>
            <!--action button-->
        </td>
        {{-- @endif --}}
    </tr>
@endforeach
<!--each row-->
