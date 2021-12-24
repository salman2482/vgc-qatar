@foreach($vusers as $vuser)
<!--each row-->
<tr id="vuser_{{ $vuser->id }}">
    @if(config('visibility.vusers_col_checkboxes'))
    <td class="vusers_col_checkbox checkitem" id="vusers_col_checkbox_{{ $vuser->id }}">
        <!--list checkbox-->
        <span class="list-checkboxes display-inline-block w-px-20">
            <input type="checkbox" id="listcheckbox-vusers-{{ $vuser->id }}" name="ids[{{ $vuser->id }}]"
                class="listcheckbox listcheckbox-vusers filled-in chk-col-light-blue"
                data-actions-container-class="vusers-checkbox-actions-container"
                {{ runtimeDisabledvusersChecboxes($vuser->account_owner) }}>
            <label for="listcheckbox-vusers-{{ $vuser->id }}"></label>
        </span>
    </td>
    @endif
    <td class="vusers_col_first_name" id="vusers_col_first_name_{{ $vuser->id }}">
        <span class="user-avatar-container"><img src="{{ $vuser->avatar }}" alt="user"
                class="img-circle avatar-xsmall">
            @if($vuser->is_online)
            <span class="online-status bg-success" data-toggle="tooltip" title="{{ cleanLang(__('lang.user_is_online')) }}"></span>
            @endif
        </span> <span>{{ $vuser->first_name }}</span>
        {{ $vuser->last_name }}
        <!--account owner-->
        @if($vuser->account_owner == 'yes')
        <span class="sl-icon-star text-warning p-l-5" data-toggle="tooltip" title="{{ cleanLang(__('lang.account_owner')) }}"
            id="account_owner_icon_{{ $vuser->clientid }}"></span>
        @endif

    </td>
    {{-- @if(config('visibility.vusers_col_client')) --}}
    <td class="vusers_col_company" id="vusers_col_company_{{ $vuser->id }}">
        {{ $vuser->fvendor->vendor_company_name ?? '' }}
    </td>
    {{-- @endif --}}
    <td class="vusers_col_email" id="vusers_col_email_{{ $vuser->id }}">
        {{ $vuser->email }}
    </td>
    <td class="vusers_col_phone" id="vusers_col_phone_{{ $vuser->id }}">{{ $vuser->phone ?? '---'}}</td>
    {{-- @if(config('visibility.vusers_col_last_active')) --}}
    <td class="vusers_col_last_active" id="vusers_col_last_active_{{ $vuser->id }}">
        {{ $vuser->carbon_last_seen }}
    </td>
    
    @if ($vuser->status == 'unverified')
    <td class="clients_col_status" id="clients_col_status_{{ $vuser->client_id }}">
        <span class="label {{ runtimeClientStatusLabel('suspended') }}">
        {{ 'Not Verified' }}</span>
    </td>
    @else
    <td class="vuser_col_status" id="vuser_col_status_{{ $vuser->client_id }}">
        <span class="label {{ runtimeClientStatusLabel($vuser->status) }}">{{
            runtimeLang($vuser->status) }}</span>
    </td>
    @endif
    
    {{-- @endif --}}
    @if(config('visibility.action_column'))
    <td class="vusers_col_action actions_column" id="vusers_col_action_{{ $vuser->id }}">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--delete-->
            @if(config('visibility.action_buttons_delete') == 'show' && $vuser->account_owner == 'no')
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_user')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/vusers/{{ $vuser->id }}">
                <i class="sl-icon-trash"></i>
            </button>
            @else
            <!--optionally show disabled button?-->
            <span class="btn btn-outline-default btn-circle btn-sm disabled {{ runtimePlaceholdeActionsButtons() }}"
                data-toggle="tooltip" title="{{ cleanLang(__('lang.actions_not_available')) }}"><i class="sl-icon-trash"></i></span>
            @endif
            <!--edit-->
            @if(config('visibility.action_buttons_edit'))
            <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                data-toggle="modal" data-target="#commonModal"
                data-url="{{ urlResource('/vusers/'.$vuser->id.'/edit') }}" data-loading-target="commonModalBody"
                data-modal-title="{{ cleanLang(__('lang.edit_user')) }}"
                data-action-url="{{ urlResource('/vusers/'.$vuser->id.'?ref=list') }}" data-action-method="PUT"
                data-action-ajax-class="" data-action-ajax-loading-target="vusers-td-container">
                <i class="sl-icon-note"></i>
            </button>
            @endif
        </span>
        <!--action button-->
    </td>
    @endif
</tr>
@endforeach
<!--each row-->