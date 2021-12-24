@foreach ($contacts as $contact)
    {{-- @dd($contact) --}}
    <!--each row-->
    <tr id="employee_{{ $contact->id }}">
        @if (config('visibility.contacts_col_checkboxes'))
            <td class="contacts_col_id" id="contacts_col_id_{{ $contact->id }}">
                {{ $contact->id }}
            </td>
        @endif
        <td class="contacts_col_first_name" id="contacts_col_first_name_{{ $contact->id }}">
            <span class="user-avatar-container"><img src="{{ $contact->avatar }}" alt="user"
                    class="img-circle avatar-xsmall">
                @if ($contact->is_online)
                    <span class="online-status bg-success" data-toggle="tooltip"
                        title="{{ cleanLang(__('lang.user_is_online')) }}"></span>
                @endif
            </span> <span>{{ $contact->first_name }}</span>
            {{ $contact->last_name }}
            <!--account owner-->
            @if ($contact->account_owner == 'yes')
                <span class="sl-icon-star text-warning p-l-5" data-toggle="tooltip"
                    title="{{ cleanLang(__('lang.account_owner')) }}"
                    id="account_owner_icon_{{ $contact->clientid }}"></span>
            @endif

        </td>

        <td class="contacts_col_email" id="contacts_col_email_{{ $contact->id }}">
            {{ $contact->email }}
        </td>
        <td class="contacts_col_phone" id="contacts_col_phone_{{ $contact->id }}">{{ $contact->phone ?? '---' }}
        </td>
        @if (config('visibility.contacts_col_last_active'))
            <td class="contacts_col_last_active" id="contacts_col_last_active_{{ $contact->id }}">
                {{ $contact->carbon_last_seen }}
            </td>
        @endif
        @if (config('visibility.action_column'))
            <td class="contacts_col_action actions_column" id="contacts_col_action_{{ $contact->id }}">
                <!--action button-->
                <span class="list-table-action dropdown font-size-inherit">
                    <!--delete-->
                    @if (config('visibility.action_buttons_delete') == 'show' && $contact->account_owner == 'no')
                        <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                            class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                            data-confirm-title="{{ cleanLang(__('lang.delete_user')) }}"
                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                            data-url="{{ url('/') }}/employees/{{ $contact->id }}">
                            <i class="sl-icon-trash"></i>
                        </button>
                    @else
                        <!--optionally show disabled button?-->
                        <span
                            class="btn btn-outline-default btn-circle btn-sm disabled {{ runtimePlaceholdeActionsButtons() }}"
                            data-toggle="tooltip" title="{{ cleanLang(__('lang.actions_not_available')) }}"><i
                                class="sl-icon-trash"></i></span>
                    @endif
                    <!--edit-->
                    @if (config('visibility.action_buttons_edit'))
                        <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                            class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                            data-toggle="modal" data-target="#commonModal"
                            data-url="{{ urlResource('/employees/' . $contact->id . '/edit') }}"
                            {{-- data-url="{{ route('abc.edit', $contact->id) }}" data-loading-target="commonModalBody" --}} data-modal-title="{{ cleanLang(__('Edit Employee')) }}"
                            data-action-url="{{ urlResource('/employees/' . $contact->id . '?ref=list') }}"
                            data-action-method="PUT" data-action-ajax-class=""
                            data-action-ajax-loading-target="employees-td-container">
                            <i class="sl-icon-note"></i>
                        </button>
                    @endif
                    {{-- add schedules --}}
                    {{-- @if (config('visibility.action_buttons_edit')) --}}
                    <a href="{{ route('employees.add-schedule', $contact->id) }}"
                        title="{{ cleanLang(__('Add Employee Schedules')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm">
                        <i class="sl-icon-plus"></i>
                    </a>
                    {{-- <a href="{{ route('employees.add-schedule', $contact->id) }}"
                        title="{{ cleanLang(__('Add Schedule')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-a js-ajax-ux-request reset-target-modal-form">
                        <i class="sl-icon-window"></i>
                    </a> --}}
                    {{-- @endif --}}
                </span>
                <!--action button-->
            </td>
        @endif
    </tr>
@endforeach
<!--each row-->
