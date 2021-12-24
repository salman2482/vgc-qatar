<div class="row" id="js-projects-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <!--meta data - creatd by-->
        @if(isset($page['section']) && $page['section'] == 'edit')
        <div class="modal-meta-data">
            <small><strong>{{ cleanLang(__('lang.created_by')) }}:</strong> {{ $project->first_name ?? runtimeUnkownUser() }} |
                {{ runtimeDate($project->project_created) }}</small>
        </div>
        @endif

        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.project_title')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="project_title" name="project_title"
                    placeholder="" value="{{ $project->project_title ?? '' }}">
            </div>
        </div>
        <!--/#title-->

        <!--client<>-->
        @if(config('visibility.project_modal_client_fields'))
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.client')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <!--select2 basic search-->
                <select name="project_clientid" id="project_clientid"
                    class="form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"
                    data-ajax--url="{{ url('/') }}/feed/company_names"></select>
                <!--select2 basic search-->
                </select>
            </div>
        </div>
        @endif
        <!--/#client-->


        <!--dates<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.start_date')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="project_date_start"
                    autocomplete="off" value="{{ runtimeDatepickerDate($project->project_date_start ?? '') }}">
                <input class="mysql-date" type="hidden" name="project_date_start" id="project_date_start"
                    value="{{ $project->project_date_start ?? '' }}">
            </div>
        </div>

        <!--dates<>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.deadline')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="project_date_due"
                    autocomplete="off" value="{{ runtimeDatepickerDate($project->project_date_due ?? '') }}">
                <input class="mysql-date" type="hidden" name="project_date_due" id="project_date_due"
                    value="{{ $project->project_date_due ?? '' }}">
            </div>
        </div>

        <!--assigned team members<>-->
        @if(config('visibility.project_modal_assign_fields'))
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.assigned')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <select name="assigned" id="assigned"
                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                    multiple="multiple" tabindex="-1" aria-hidden="true">
                    <!--array of assigned-->
                    @if(isset($page['section']) && $page['section'] == 'edit' && isset($project->assigned))
                    @foreach($project->assigned as $user)
                    @php $assigned[] = $user->id; @endphp
                    @endforeach
                    @endif
                    <!--/#array of assigned-->
                    <!--users list-->
                    @foreach(config('system.team_members') as $user)
                    <option value="{{ $user->id }}" {{ runtimePreselectedInArray($user->id ?? '', $assigned ?? []) }}>{{
                        $user->full_name }}</option>
                    @endforeach
                    <!--/#users list-->
                </select>
            </div>
        </div>
        @endif
        <!--/#assigned team members-->

        <!--project manager<>-->
        @if(config('visibility.project_modal_assign_fields'))
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.manager')) }} <a
                    class="align-middle font-16 toggle-collapse" href="#project_manager_info" role="button"
                    ><i class="ti-info-alt text-themecontrast"></i></a></label>
            <div class="col-sm-12 col-lg-9">
                <select name="manager" id="manager" class="select2-basic form-control form-control-sm">
                    <!--array of assigned-->
                    @if(isset($page['section']) && $page['section'] == 'edit' && isset($project->managers))
                    @foreach($project->managers as $user)
                    @php $manager[] = $user->id; @endphp
                    @endforeach
                    @endif
                    <!--/#array of assigned-->
                    <!--users list-->
                    @foreach(config('system.team_members') as $user)
                    <option></option>
                    <option value="{{ $user->id }}" {{ runtimePreselectedInArray($user->id ?? '', $manager ?? []) }}>{{
                                $user->full_name }}</option>
                    @endforeach
                    <!--/#users list-->
                </select>
            </div>
        </div>
        @endif

        <!--/#project manager-->
        <div class="collapse" id="project_manager_info">
            <div class="alert alert-info">{{ cleanLang(__('lang.project_manager_info')) }}</div>
        </div>

        <!--[billing details]-->
        @if(auth()->user()->role->role_projects_billing == 2)
        <div class="highlighted-panel">
            <!--billing type-->
            <div class="form-group row">
                <label for="example-month-input"
                    class="col-sm-12 col-lg-4 col-form-label text-left">{{ cleanLang(__('lang.billing')) }}</label>
                <div class="col-sm-12 col-lg-4">
                    <input type="number" class="form-control form-control-sm" id="project_billing_rate"
                        name="project_billing_rate" placeholder="" value="{{ $project['project_billing_rate'] ?? '' }}">

                </div>
                <div class="col-sm-12 col-lg-4">
                    <select class="select2-basic form-control form-control-sm" id="project_billing_type"
                        data-allow-clear="false" name="project_billing_type">
                        <option value="hourly" {{ runtimePreselected( 'hourly', $project['project_billing_type'] ?? '') }}>
                            {{ cleanLang(__('lang.hourly')) }}</option>
                        <option value="fixed" {{ runtimePreselected( 'fixed', $project['project_billing_type'] ?? '') }}>
                            {{ cleanLang(__('lang.fixed_fee')) }}</option>
                    </select>
                </div>
            </div>
            <!--estimated hours-->
            <div class="form-group row">
                <label class="col-sm-12 col-lg-4 text-left control-label col-form-label">{{ cleanLang(__('lang.estimated_hours')) }}
                    <a class="align-middle font-16 toggle-collapse" href="#project_estimated_hours_info" role="button"
                        ><i class="ti-info-alt text-themecontrast"></i></a></label>
                <div class="col-sm-12 col-lg-4">
                    <input type="number" class="form-control form-control-sm" id="project_billing_estimated_hours"
                        name="project_billing_estimated_hours" placeholder=""
                        value="{{ $project['project_billing_estimated_hours'] ?? '' }}">
                </div>
                <div class="collapse col-sm-12 m-t-15" id="project_estimated_hours_info">
                    <div class="alert alert-info">{{ cleanLang(__('lang.project_estimated_hours_info')) }}</div>
                </div>
            </div>
            <!--cost estimate-->
            <div class="form-group row m-b-0">
                <label class="col-sm-12 col-lg-4 text-left control-label col-form-label">{{ cleanLang(__('lang.costs_estimate')) }} <a
                        class="align-middle font-16 toggle-collapse" href="#project_cost_estimate_info" role="button"
                        ><i class="ti-info-alt text-themecontrast"></i></a></label>
                <div class="col-sm-12 col-lg-4">
                    <input type="number" class="form-control form-control-sm" id="project_billing_costs_estimate"
                        name="project_billing_costs_estimate" placeholder=""
                        value="{{ $project['project_billing_costs_estimate'] ?? '' }}">
                </div>
                <div class="collapse col-sm-12 m-t-15" id="project_cost_estimate_info">
                    <div class="alert alert-info">{{ cleanLang(__('lang.project_cost_estimate_info')) }}</div>
                </div>
            </div>
        </div>
        @endif
        <!--/#[billing details]-->


        <!--edit description- toggle<>-->
        <div class="spacer row">
            <div class="col-sm-8">
                <span class="title">Project {{ cleanLang(__('lang.description')) }}</span class="title">
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="switch  text-right">
                    <label>
                        <input type="checkbox" class="js-switch-toggle-hidden-content"
                            data-target="edit_project_description_toggle">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="hidden" id="edit_project_description_toggle">
            <textarea id="project_description" name="project_description"
                class="tinymce-textarea">{{ $project->project_description ?? '' }}</textarea>
            <div class="line m-t-30"></div>
        </div>
        <!--edit description- toggle-->


        <!--project options-->
        <div class="spacer row">
            <div class="col-sm-8">
                <span class="title">{{ cleanLang(__('lang.additional_settings')) }}</span class="title">
            </div>
            <div class="col-sm-4 text-right">
                <div class="switch">
                    <label>
                        <input type="checkbox" class="js-switch-toggle-hidden-content"
                            data-target="edit_project_setings">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="hidden" id="edit_project_setings">



            <!--spacer-->
            @if(config('visibility.project_modal_project_permissions'))
            <div class="spacer row">
                <div class="col-sm-8">
                    <span class="title">{{ cleanLang(__('lang.assigned_user_permissions')) }}</span>
                </div>
                <div class="col-sm-4">
                    <div class="switch  text-right">
                        <label>
                            <input type="checkbox" name="show_more_settings_projects" id="show_more_settings_projects"
                                class="js-switch-toggle-hidden-content" data-target="edit_project_assigned_permissions">
                            <span class="lever switch-col-light-blue"></span>
                        </label>
                    </div>
                </div>
            </div>
            <!--spacer-->
            <!--option toggle-->
            <div class="hidden highlighted-panel" id="edit_project_assigned_permissions">
                <div class="form-group form-group-checkbox row m-b-0">
                    <label class="col-5 col-form-label text-left">{{ cleanLang(__('lang.task_collaboration')) }} <a
                            class="align-middle font-16 toggle-collapse" href="#info_task_collaboration" role="button"
                            ><i class="ti-info-alt text-themecontrast"></i></a> </label>
                    <div class="col-7 text-left p-t-5">
                        <input type="checkbox" id="assignedperm_tasks_collaborate" name="assignedperm_tasks_collaborate"
                            class="filled-in chk-col-light-blue"
                            {{ runtimePrechecked($project['assignedperm_tasks_collaborate'] ?? '') }}>
                        <label for="assignedperm_tasks_collaborate"></label>
                    </div>
                </div>
                <!--info: taskcollaborations-->
                <div class="collapse" id="info_task_collaboration">
                    <div class="alert alert-info">{{ cleanLang(__('lang.task_collaboration_info')) }}</div>
                </div>
            </div>
            <!--option toggle-->


            <!--spacer-->
            <div class="spacer row">
                <div class="col-sm-8">
                    <span class="title">{{ cleanLang(__('lang.client_project_permissions')) }}</span class="title">
                </div>
                <div class="col-sm-4">
                    <div class="switch text-right">
                        <label>
                            <input type="checkbox" name="show_more_settings_projects2" id="show_more_settings_projects2"
                                class="js-switch-toggle-hidden-content" data-target="edit_project_permissions_tasks">
                            <span class="lever switch-col-light-blue"></span>
                        </label>
                    </div>
                </div>
            </div>
            <!--spacer-->
            <!--permissions-->
            <div id="edit_project_permissions_tasks" class="hidden highlighted-panel">
                <!--permission - view tasks-->
                <div class="form-group form-group-checkbox row">
                    <label class="col-5 col-form-label text-left">{{ cleanLang(__('lang.view_tasks')) }}</label>
                    <div class="col-7 text-left p-t-5">
                        <input type="checkbox" id="clientperm_tasks_view" name="clientperm_tasks_view"
                            class="filled-in chk-col-light-blue"
                            {{ runtimePrechecked($project['clientperm_tasks_view'] ?? '') }}>
                        <label for="clientperm_tasks_view"></label>
                    </div>
                </div>
                <!--permission - task participation-->
                <div class="form-group form-group-checkbox row">
                    <label class="col-5 col-form-label text-left required">{{ cleanLang(__('lang.task_participation')) }}**</label>
                    <div class="col-7 text-left p-t-5">
                        <input type="checkbox" id="clientperm_tasks_collaborate" name="clientperm_tasks_collaborate"
                            class="filled-in chk-col-light-blue"
                            {{ runtimePrechecked($project['clientperm_tasks_collaborate'] ?? '') }}>
                        <label for="clientperm_tasks_collaborate"></label>
                    </div>
                </div>
                <!--permission - create tasks-->
                <div class="form-group form-group-checkbox row">
                    <label class="col-5 col-form-label text-left required">{{ cleanLang(__('lang.create_tasks')) }}**</label>
                    <div class="col-7 text-left p-t-5">
                        <input type="checkbox" id="clientperm_tasks_create" name="clientperm_tasks_create"
                            class="filled-in chk-col-light-blue"
                            {{ runtimePrechecked($project['clientperm_tasks_create'] ?? '') }}>
                        <label for="clientperm_tasks_create"></label>
                    </div>
                </div>
                <div class="line"></div>
                <!--permission - view timesheets-->
                <div class="form-group form-group-checkbox row">
                    <label class="col-5 col-form-label text-left">{{ cleanLang(__('lang.view_time_sheets')) }}</label>
                    <div class="col-7 text-left p-t-5">
                        <input type="checkbox" id="clientperm_timesheets_view" name="clientperm_timesheets_view"
                            class="filled-in chk-col-light-blue"
                            {{ runtimePrechecked($project['clientperm_timesheets_view'] ?? '') }}>
                        <label for="clientperm_timesheets_view"></label>
                    </div>
                </div>
                <!--permission - view expenses-->
                <div class="form-group form-group-checkbox row">
                    <label class="col-5 col-form-label text-left">{{ cleanLang(__('lang.view_expenses')) }}</label>
                    <div class="col-7 text-left p-t-5">
                        <input type="checkbox" id="clientperm_expenses_view" name="clientperm_expenses_view"
                            class="filled-in chk-col-light-blue"
                            {{ runtimePrechecked($project['clientperm_expenses_view'] ?? '') }}>
                        <label for="clientperm_expenses_view"></label>
                    </div>
                </div>

                <div><small class="text-bold">** {{ cleanLang(__('lang.if_items_selected_then_viewing_perm')) }}</small></div>
            </div>
            <!--permissions-->
            @endif



            <!--project progress-->
            <div class="spacer row">
                <div class="col-sm-8">
                    <span class="title">{{ cleanLang(__('lang.progress')) }}</span class="title">
                </div>
                <div class="col-sm-4 text-right">
                    <div class="switch">
                        <label>
                            <input type="checkbox" class="js-switch-toggle-hidden-content"
                                data-target="edit_project_progress">
                            <span class="lever switch-col-light-blue"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!--project progress-->
            <div class="hidden" id="edit_project_progress">

                <div class="form-group form-group-checkbox row">
                    <label class="col-4 col-form-label text-left">{{ cleanLang(__('lang.set_progress_manually')) }}?</label>
                    <div class="col-7 text-left p-t-5">
                        <input type="checkbox" id="project_progress_manually" name="project_progress_manually"
                            class="filled-in chk-col-light-blue"
                            {{ runtimePrechecked($project['project_progress_manually'] ?? '') }}>
                        <label for="project_progress_manually"></label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 p-l-30">
                        <div id="edit_project_progress_bar"></div>
                    </div>
                    <div class="col-sm-2 text-right">
                        <strong>
                            <span id="edit_project_progress_display">20</span>%</strong>
                    </div>
                </div>
                <input type="hidden" name="project_progress" value="{{ $project->project_progress ?? '' }}"
                    id="project_progress" />
            </div>


            <!--project options-->
            <div class="spacer row">
                <div class="col-sm-8">
                    <span class="title">{{ cleanLang(__('lang.options')) }}</span class="title">
                </div>
                <div class="col-sm-4 text-right">
                    <div class="switch">
                        <label>
                            <input type="checkbox" class="js-switch-toggle-hidden-content"
                                data-target="edit_project_options">
                            <span class="lever switch-col-light-blue"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!--project options-->
            <div class="hidden" id="edit_project_options">
                <div class="form-group row">
                    <label for="example-month-input"
                        class="col-sm-12 col-lg-3 col-form-label text-left required">{{ cleanLang(__('lang.category')) }}</label>
                    <div class="col-sm-12 col-lg-9">
                        <select class="select2-basic form-control form-control-sm" id="project_categoryid"
                            name="project_categoryid">
                            @foreach($categories as $category)
                            <option value="{{ $category->category_id }}"
                                {{ runtimePreselected($project->project_categoryid ?? '', $category->category_id) }}>{{
                                                runtimeLang($category->category_name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <!--tags-->
                <div class="form-group row">
                    <label class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.tags')) }}</label>
                    <div class="col-sm-12 col-lg-9">
                        <select name="tags" id="tags"
                            class="form-control form-control-sm select2-multiple {{ runtimeAllowUserTags() }} select2-hidden-accessible"
                            multiple="multiple" tabindex="-1" aria-hidden="true">
                            <!--array of selected tags-->
                            @if(isset($page['section']) && $page['section'] == 'edit')
                            @foreach($project->tags as $tag)
                            @php $selected_tags[] = $tag->tag_title ; @endphp
                            @endforeach
                            @endif
                            <!--/#array of selected tags-->
                            @foreach($tags as $tag)
                            <option value="{{ $tag->tag_title }}"
                                {{ runtimePreselectedInArray($tag->tag_title ?? '', $selected_tags ?? []) }}>{{ $tag->tag_title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!--/#tags-->
            </div>





            <!--pass source-->
            <input type="hidden" name="source" value="{{ request('source') }}">

        </div>


        <!--redirect to project-->
        @if(config('visibility.project_show_project_option'))
        <div class="form-group form-group-checkbox row">
            <div class="col-12 text-left p-t-5">
                <input type="checkbox" id="show_after_adding" name="show_after_adding"
                    class="filled-in chk-col-light-blue" checked="checked">
                <label for="show_after_adding">{{ cleanLang(__('lang.show_project_after_its_created')) }}</label>
            </div>
        </div>
        @endif
        <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* {{ cleanLang(__('lang.required')) }}</strong></small></div>
            </div>
        </div>
    </div>
</div>


@if(isset($page['section']) && $page['section'] == 'edit')
<!--dynamic inline - set dynamic project progress-->
<script>
    NX.varInitialProjectProgress = "{{ $project['project_progress'] }}";
</script>
@endif