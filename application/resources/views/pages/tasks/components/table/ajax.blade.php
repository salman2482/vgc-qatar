@foreach($tasks as $task)
<!--each row-->
<tr id="task_{{ $task->task_id }}" class="task-{{ $task->task_status }}">
    <td class="tasks_col_title td-edge">
        <!--for polling timers-->
        <input type="hidden" name="tasks[{{ $task->task_id }}]" value="{{ $task->assigned_to_me }}">
        <!--checkbox-->
        <span class="task_border td-edge-border {{ runtimeTaskStatusColors($task->task_status, 'background') }}"></span>
        @if(config('visibility.tasks_checkbox'))
        <span class="list-checkboxes m-l-0">
            <input type="checkbox" id="toggle_task_status_{{ $task->task_id }}" name="toggle_task_status"
                class="toggle_task_status filled-in chk-col-light-blue js-ajax-ux-request-default"
                data-url="{{ urlResource('/tasks/'.$task->task_id.'/toggle-status') }}" data-ajax-type="post"
                data-type="form" data-form-id="task_{{ $task->task_id }}" data-notifications="disabled"
                data-container="task_{{ $task->task_id }}" data-progress-bar="hidden"
                {{ runtimePrechecked($task->task_status) }}>
            <label for="toggle_task_status_{{ $task->task_id }}"><a
                    class="show-modal-button reset-card-modal-form js-ajax-ux-request" href="javascript:void(0)"
                    data-toggle="modal" data-target="#cardModal" data-url="{{ urlResource('/tasks/'.$task->task_id) }}"
                    data-loading-target="main-top-nav-bar"><span class="x-strike-through"
                        id="table_task_title_{{ $task->task_id }}">{{ str_limit($task->task_title ?? '---', 40) }}</span></a>
            </label>
        </span>
        @endif
        @if(config('visibility.tasks_nocheckbox'))
        <a class="show-modal-button reset-card-modal-form js-ajax-ux-request p-l-5" href="javascript:void(0)"
            data-toggle="modal" data-target="#cardModal" data-url="{{ urlResource('/tasks/'.$task->task_id) }}"
            data-loading-target="main-top-nav-bar"><span class="x-strike-through"
                id="table_task_title_{{ $task->task_id }}">{{ str_limit($task->task_title ?? '---', 45) }}</span></a>
        @endif
    </td>
    @if(config('visibility.tasks_col_project'))
    <td class="tasks_col_project">
        <span class="x-strike-through"><a title=""
                href="{{ url('/projects/'.$task->project_id) }}">{{ str_limit($task->project_title ?? '---', 18) }}</a></span>
    </td>
    @endif
    @if(config('visibility.tasks_col_milestone'))
    <td class="tasks_col_milestone">
        <span class="x-strike-through">{{ str_limit($task->milestone_title ?? '---', 12) }}</span>
    </td>
    @endif
    @if(config('visibility.tasks_col_date'))
    <td class="tasks_col_created">{{ runtimeDate($task->task_date_start) }}</td>
    @endif
    <td class="tasks_col_deadline">{{ runtimeDate($task->task_date_due) }}</td>

    @if(config('visibility.tasks_col_assigned'))
    <td class="tasks_col_assigned" id="tasks_col_assigned_{{ $task->task_id }}">
        <!--assigned users-->
        @if(count($task->assigned) > 0)
        @foreach($task->assigned->take(2) as $user)
        <img src="{{ $user->avatar }}" data-toggle="tooltip" title="{{ $user->first_name }}" data-placement="top"
            alt="{{ $user->first_name }}" class="img-circle avatar-xsmall">
        @endforeach
        @else
        <span>---</span>
        @endif
        <!--assigned users-->
        <!--more users-->
        @if(count($task->assigned) > 2)
        @php $more_users_title = __('lang.assigned_users'); $users = $task->assigned; @endphp
        @include('misc.more-users')
        @endif
        <!--more users-->
    </td>
    @endif
    @if(config('visibility.tasks_col_all_time'))
    <td class="tasks_col_all_time">
        <span class="x-timer-time"
            id="task_timer_all_table_{{ $task->task_id }}">{{ runtimeSecondsHumanReadable($task->sum_all_time, true) }}</span>
    </td>
    @endif
    @if(config('visibility.tasks_col_mytime'))
    <td class="tasks_col_my_time">
        @if($task->assigned_to_me)
        <span class="x-timer-time timers {{ runtimeTimerRunningStatus($task->timer_current_status) }}"
            id="task_timer_table_{{ $task->task_id }}">{!! clean(runtimeSecondsHumanReadable($task->my_time, false)) !!}</span>
        @if($task->task_status != 'completed')
        <!--start a timer-->
        <span
            class="x-timer-button js-timer-button js-ajax-request timer-start-button hidden {{ runtimeTimerVisibility($task->timer_current_status, 'stopped') }}"
            id="timer_button_start_table_{{ $task->task_id }}" data-task-id="{{ $task->task_id }}" data-location="table"
            data-url="{{ url('/') }}/tasks/timer/{{ $task->task_id }}/start?source=list" data-form-id="tasks-list-table"
            data-type="form" data-progress-bar='hidden' data-ajax-type="POST">
            <span><i class="mdi mdi-play-circle"></i></span>
        </span>
        <!--stop a timer-->
        <span
            class="x-timer-button js-timer-button js-ajax-request timer-stop-button hidden {{ runtimeTimerVisibility($task->timer_current_status, 'running') }}"
            id="timer_button_stop_table_{{ $task->task_id }}" data-task-id="{{ $task->task_id }}" data-location="table"
            data-url="{{ url('/') }}/tasks/timer/{{ $task->task_id }}/stop?source=list" data-form-id="tasks-list-table"
            data-type="form" data-progress-bar='hidden' data-ajax-type="POST">
            <span><i class="mdi mdi-stop-circle"></i></span>
        </span>
        <!--timer updating-->
        <input type="hidden" name="timers[{{ $task->task_id }}]" value="">
        @endif
        @else
        <span>---</span>
        @endif
    </td>
    @endif
    @if(config('visibility.tasks_col_priority'))
    <td class="tasks_col_priority">
        <span
            class="label {{ runtimeTaskPriorityColors($task->task_priority, 'label') }}">{{ runtimeLang($task->task_priority) }}</span>
    </td>
    @endif
    @if(config('visibility.tasks_col_tags'))
    <td class="tasks_col_tags">
        <!--tag-->
        @if(count($task->tags) > 0)
        @foreach($task->tags->take(2) as $tag)
        <span class="label label-outline-default">{{ str_limit($tag->tag_title, 15) }}</span>
        @endforeach
        @else
        <span>---</span>
        @endif
        <!--/#tag-->

        <!--more tags (greater than tags->take(x) number above -->
        @if(count($task->tags) > 1)
        @php $tags = $task->tags; @endphp
        @include('misc.more-tags')
        @endif
        <!--more tags-->
    </td>
    @endif
    <td class="tasks_col_status">
        <span
            class="label {{ runtimeTaskStatusColors($task->task_status, 'label') }}">{{ runtimeLang($task->task_status) }}</span>
    </td>
    <td class="tasks_col_action actions_column">
        <!--action button-->
        <span class="list-table-action dropdown font-size-inherit">
            <!--[delete]-->
            @if($task->permission_delete_task)
            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"
                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"
                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}" data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}"
                data-ajax-type="DELETE" data-url="{{ url('/') }}/tasks/{{ $task->task_id }}">
                <i class="sl-icon-trash"></i>
            </button>
            @else
            <!--optionally show disabled button?-->
            <span class="btn btn-outline-default btn-circle btn-sm disabled  {{ runtimePlaceholdeActionsButtons() }}"
                data-toggle="tooltip" title="{{ cleanLang(__('lang.actions_not_available')) }}"><i class="sl-icon-trash"></i></span>
            @endif

            <!--view-->
            <button type="button" title="{{ cleanLang(__('lang.view')) }}"
                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm show-modal-button reset-card-modal-form js-ajax-ux-request"
                data-toggle="modal" data-target="#cardModal" data-url="{{ urlResource('/tasks/'.$task->task_id) }}"
                data-loading-target="main-top-nav-bar">
                <i class="ti-new-window"></i>
            </button>
        </span>

        <!--more button (team)-->
        @if(auth()->user()->is_team && $task->permission_super_user)
        <span class="list-table-action dropdown  font-size-inherit">
            <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                title="{{ cleanLang(__('lang.more')) }}"
                class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm">
                <i class="ti-more"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="listTableAction">
                <a class="dropdown-item confirm-action-danger" data-confirm-title="{{ cleanLang(__('lang.stop_all_timers')) }}"
                    data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="PUT"
                    data-url="{{ url('/') }}/tasks/timer/{{ $task->task_id }}/stopall?source=list">
                    {{ cleanLang(__('lang.stop_all_timers')) }}
                </a>
            </div>
        </span>
        @endif
        <!--more button-->
        <!--action button-->
    </td>
</tr>
@endforeach
<!--each row-->