<div class="row" id="js-rfms-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <!--department<>-->
        @php
            $cats = [
                'soft service' => 'soft service',
                'hard service' => 'hard service',
                'office supply' => 'office supply',
                'transport' => 'transport',
            ];
        @endphp
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('RFM Category')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <select class="select2-basic form-control form-control-sm" name="rfm_department" id="rfm_department"
                    data-allow-clear="false">
                    @foreach ($cats as $cat)
                        <option value="{{ $cat }}" {{ $rfm->department ?? '' == $cat ? 'selected' : '' }}>
                            {{ ucwords($cat) }}</option>
                    @endforeach
                </select>
                {{-- <input type="text" class="form-control form-control-sm" id="rfm_title" name="rfm_title"
                    placeholder="" value="{{ $rfm-> ?? '' }}"> --}}
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Select Inline Manager*')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <!--select2 basic search-->
                <select name="rfm_clientid" id="rfm_clientid"
                    class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search-modal"
                    data-ajax--url="{{ url('/') }}/feed/company_managers">
                    @if (isset($rfm->inline_manager_id) && $rfm->inline_manager_id != '')
                        <option value="{{ $rfm->inline_manager_id ?? '' }}">{{ $rfm->first_name ?? '' }}
                        </option>
                    @endif
                </select>
            </div>
        </div>
        <!--subject<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.rfm_subject')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <textarea name="rfm_subject" id="rfm_subject" class="form-control form-control-sm" required cols="30"
                    rows="10">{{ $rfm->subject ?? '' }}</textarea>
            </div>
        </div>
        <!--/#subject-->

        <!--remarks<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Remarks')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" required name="rfm_remarks" id="rfm_remarks" class="form-control form-control-sm"
                    value="{{ $rfm->remarks ?? '' }}">
            </div>
        </div>
        <!--/#remarks-->

        <!--site<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.rfm_site')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" required name="rfm_site" id="rfm_site" class="form-control form-control-sm"
                    value="{{ $rfm->site ?? '' }}">
            </div>
        </div>

        <!--quantity<>-->
        <div class="form-group row hidden">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.rfm_quantity')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="number" required name="rfm_quantity" id="rfm_quantity" class="form-control form-control-sm"
                    value="{{ $rfm->quantity ?? '' }}">
            </div>
        </div>
        <!--/#quantity-->

        <!--available stock<>-->
        <div class="form-group row hidden">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.rfm_stock')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="number" name="rfm_available_stock" id="rfm_available_stock"
                    class="form-control form-control-sm" value="{{ $rfm->available_stock ?? '' }}">
            </div>
        </div>
        <!--/#available stock-->
        <!--due date <>-->
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">Due Date</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm pickadate" name="rfm_due_date" autocomplete="off"
                    value="{{ runtimeDatepickerDate($rfm->due_date ?? '') }}">
                <input class="mysql-date" type="hidden" name="rfm_due_date" id="rfm_due_date"
                    value="{{ $rfm->due_date ?? '' }}">
            </div>
        </div>
        <!--/# due date-->
        <!--project progress-->
        <div class="spacer row">
            <div class="col-sm-8">
                <span class="title control-label col-form-label">{{ cleanLang(__('Add Clients')) }}</span
                    class="title">
            </div>
            <div class="col-sm-4 text-right">
                <div class="switch">
                    <label>
                        <input type="checkbox" {{ $rfm->user_client_id ?? '' != null ? 'checked' : '' }} class="js-switch-toggle-hidden-content" data-target="show_client_field">
                        <span class="lever switch-col-light-blue"></span>
                    </label>
                </div>
            </div>
        </div>
{{-- @dd($rfm->user_client_id) --}}
        <!--project progress-->
        <div class="{{ $rfm->user_client_id ?? '' != null ? '' : 'hidden' }}" id="show_client_field">

            <div class="form-group row">
                <label
                    class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.client')) }}*</label>
                <div class="col-sm-12 col-lg-9">
                    <!--select2 basic search-->
                    <select name="client_id" id="client_id"
                        class="clients_and_projects_toggle form-control form-control-sm js-select2-basic-search-modal"
                        data-ajax--url="{{ url('/') }}/feed/company_names">
                        {{-- @if ($rfm->user_client_id != null) --}}
                            <option value="{{ $rfm->user_client_id ?? '' }}" {{ $rfm->user_client_id ?? '' != null ? 'selected' : '' }}>
                                {{ $rfm->client_company_name ?? '' }}
                            </option>
                        {{-- @endif --}}
                        <!--select2 basic search-->
                    </select>
                </div>
            </div>

        </div>

        <div>
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Screenshot')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="rfm_image">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            @if (isset($page['section']) && $page['section'] == 'edit')
                @if (isset($attachments))
                    <table class="table table-bordered">
                        <tbody>
                            @foreach ($attachments as $attachment)
                                @if ($attachment->attachment_unique_input === 'rfm_image')
                                    <tr id="rfm_attachment_{{ $attachment->attachment_id ?? '' }}">
                                        <td>{{ $attachment->attachment_filename ?? '' }} </td>
                                        <td class="w-px-40"> <button type="button"
                                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                                data-ajax-type="DELETE"
                                                data-url="{{ url('/rfms/attachments/' . $attachment->attachment_uniqiueid ?? '') }}">
                                                <i class="sl-icon-trash"></i>
                                            </button></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
        </div>


        {{-- rfm video --}}
        <div>
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Video')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="rfm_video">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            @if (isset($page['section']) && $page['section'] == 'edit')
                @if (isset($attachments))
                    <table class="table table-bordered">
                        <tbody>
                            @foreach ($attachments as $attachment)
                                @if ($attachment->attachment_unique_input === 'rfm_video')
                                    <tr id="rfm_attachment_{{ $attachment->attachment_id ?? '' }}">
                                        <td>{{ $attachment->attachment_filename ?? '' }} </td>
                                        <td class="w-px-40"> <button type="button"
                                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                                data-ajax-type="DELETE"
                                                data-url="{{ url('/rfms/attachments/' . $attachment->attachment_uniqiueid ?? '') }}">
                                                <i class="sl-icon-trash"></i>
                                            </button></td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
        </div>
        <!--pass source-->
        <input type="hidden" name="source" value="{{ request('source') }}">

    </div>

</div>
