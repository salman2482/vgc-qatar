

@foreach ($rfms as $rfm)
    <tr id="rfm_{{ $rfm->id }}">
        <td class="rfms_col_id">
            {{ $rfm->id }}
        </td>
        <td class="rfms_col_ref_no">
            {{ $rfm->ref_num }}
        </td>
        <td class="rfms_col_department">
            {{ $rfm->department }}
        </td>
        <td class="rfms_col_subject">
            {{ str_limit($rfm->subject ?? '---', 20) }}
        </td>
        <td class="rfms_col_site">
            {{ $rfm->site }}
        </td>
        <td class="rfms_col_date_requested">
            {{ runtimeDate($rfm->due_date ?? '') }}
        </td>
        <td class="rfms_col_requestor">
            {{ $rfm->requestor ?? '' }}
        </td>
        @if (auth()->user()->id == $rfm->inline_manager_id)
        <td class="rfms_col_status">
            <span
                class="label {{ $rfm->hoc_id != null ? runtimeRfmStatusLabel('assigned') : runtimeRfmStatusLabel('not assigned')}}">{{ $rfm->hoc_id != null ? runtimeLang('Assigned') : 'Not Assigned' }}
            </span>
        </td>
        @endif

        @if (auth()->user()->id == $rfm->hoc_id)
        <td class="rfms_col_status">
            <span
                class="label {{ runtimeRfmAdminStatusLabel($rfm->assign_admin) }}">{{ $rfm->assign_admin == 'assigned' ? runtimeLang('Assigned') : runtimeLang('Not Assigned') }}
            </span>
        </td>
        @endif

        @if (auth()->user()->id != $rfm->hoc_id && auth()->user()->id != $rfm->inline_manager_id)
        <td class="rfms_col_status">
            <span
                class="label {{ runtimeRfmStatusLabel($rfm->status) }}">{{ runtimeLang($rfm->status) }}
            </span>
        </td>
        @endif

        @if (auth()->user()->is_admin)
            <td class="rfms_col_assign_admin">
                <span
                    class="label {{ runtimeRfmAdminStatusLabel($rfm->assign_admin) }}">{{ runtimeLang($rfm->assign_admin) }}</span>
            </td>
        @endif
        <td class="lpos_col_rfm_link">
            <a title="{{ cleanLang(__('lang.download')) }}" title="{{ cleanLang(__('lang.download')) }}"
            class="data-toggle-tooltip data-toggle-tooltip btn btn-outline-warning btn-circle btn-sm"
            href="{{ url('/rfms/'.$rfm->ref_num.'/pdf') }}" >
            <i class="ti-import"></i></a>
        </td>
        {{-- @if (config('visibility.action_column')) --}}
        <td class="rfms_col_action actions_column">
            <!--action button-->
            <span class="list-table-action dropdown font-size-inherit">
                <!--[delete]-->
                @if (config('visibility.list_page_actions_add_material'))
                @if ($rfm->is_material_added != 1)
                <a href="/rfms/{{ $rfm->id }}/edit-rfm" title="{{ cleanLang(__('Add Rfm Materials')) }}"
                    class="data-toggle-action-tooltip btn btn-outline-info btn-circle btn-sm">
                    <i class="sl-icon-plus"></i>
                </a>
                @endif
                @endif
                @if (config('visibility.action_buttons_delete'))
                    <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                        data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                        data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"
                        data-url="{{ url('/') }}/rfms/{{ $rfm->id }}">
                        <i class="sl-icon-trash"></i>
                    </button>
                @endif
                <!--[edit]-->
                @if (config('visibility.action_buttons_edit'))
                    <button type="button" title="{{ cleanLang(__('lang.edit')) }}"
                        class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                        data-toggle="modal" data-target="#commonModal"
                        data-url="{{ urlResource('/rfms/' . $rfm->id . '/edit') }}" data-loading-target="commonModalBody"
                        data-modal-title="{{ cleanLang(__('Edit Rfm')) }}"
                        data-action-url="{{ urlResource('/rfms/' . $rfm->id) }}" data-action-method="PUT"
                        data-action-ajax-class="" data-action-ajax-loading-target="rfms-td-container">
                        <i class="sl-icon-note"></i>
                    </button>
                @endif
                <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                    class="data-toggle-tooltip show-modal-button btn btn-outline-info btn-circle btn-sm edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                    data-toggle="modal" data-target="#plainModal" data-loading-target="plainModalBody"
                    data-modal-title="{{ cleanLang(__('Rfm Details')) }}" data-url="{{ url('/rfms/' . $rfm->id) }}">
                    <i class="ti-new-window"></i>
                </button>
                {{-- @if (config('visibility.status_button')) --}}
                <!--change status-->
                @if (auth()->user()->id == $rfm->inline_manager_id || auth()->user()->is_admin || auth()->user()->id == $rfm->hoc_id)
                    <span class="list-table-action dropdown font-size-inherit">
                        <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" title="{{ cleanLang(__('lang.more')) }}"
                            class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm">
                            <i class="ti-more"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="listTableAction">
                            @if ($rfm->hoc_id == '' || $rfm->hoc_id == null)
                                <a title="{{ cleanLang(__('Assign Head Of Department')) }}"
                                    class="dropdown-item  edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                                    data-toggle="modal" data-target="#commonModal"
                                    data-url="{{ urlResource('/rfms/' . $rfm->id . '/assign-hoa') }}"
                                    data-loading-target="commonModalBody"
                                    data-modal-title="{{ cleanLang(__('Assign Head-Of-Accounts')) }}"
                                    data-action-url="{{ urlResource('/rfms/' . $rfm->id) }}" data-action-method="PUT"
                                    data-action-ajax-class="" data-action-ajax-loading-target="rfms-td-container">
                                    {{ cleanLang(__('Assign Head Of Dep')) }}
                                </a>
                            @endif
                            {{-- @if (!$rfm->assign_admin === 'assigned') --}}
                                @if (auth()->user()->id == $rfm->hoc_id)
                                    <a class="dropdown-item actions-modal-button js-ajax-ux-request reset-target-modal-form"
                                        href="javascript:void(0)" data-toggle="modal" data-target="#actionsModal"
                                        data-modal-title="{{ cleanLang(__('Send To Admin')) }}"
                                        data-url="{{ urlResource('/rfms/'.$rfm->id.'/send-admin') }}"
                                        data-action-url="{{ urlResource('/rfms/'.$rfm->id.'/send-admin') }}"
                                        data-loading-target="actionsModalBody" data-action-method="POST">
                                        {{ cleanLang(__('Send To Admin')) }}
                                    </a>
                                @endif
                            {{-- @endif --}}

                        @if ($rfm->status != 'approved')
                            @if (auth()->user()->is_admin && $rfm->assign_admin == 'assigned')
                                <a title="{{ cleanLang(__('Change Status')) }}"
                                    class="dropdown-item  edit-add-modal-button js-ajax-ux-request reset-target-modal-form"
                                    data-toggle="modal" data-target="#commonModal"
                                    data-url="{{ urlResource('/rfms/' . $rfm->id . '/change-status') }}"
                                    data-loading-target="commonModalBody"
                                    data-modal-title="{{ cleanLang(__('Change Status')) }}"
                                    data-action-url="{{ urlResource('/rfms/' . $rfm->id) }}" data-action-method="PUT"
                                    data-action-ajax-class="" data-action-ajax-loading-target="rfms-td-container">
                                    {{ cleanLang(__('Change Status')) }}
                                </a>
                                @endif
                            @endif
                        </div>
                    </span>
                @endif

            </span>

        </td>

        {{-- @endif --}}
    </tr>

@endforeach
<!--each row-->
