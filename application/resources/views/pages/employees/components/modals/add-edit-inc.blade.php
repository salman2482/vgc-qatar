<div class="row">
    <div class="col-lg-12">
        @csrf
        <div class="form-group row">
            <label class="col-sm-12 col-lg-3 text-left control-label col-form-label required">
                {{ cleanLang(__('Select Service')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                {{-- services --}}
                <select name="service_id" id="service_id"
                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"
                    multiple="multiple" tabindex="-1" aria-hidden="true">
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}"
                            {{ isset($user) && in_array($service->id, $user->services()->pluck('id')->toArray()) ? 'selected' : '' }}
                            >
                            {{ $service->title }}
                        </option>
                    @endforeach
                </select>
                {{-- services --}}

            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.first_name')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="first_name" name="first_name"
                    value="{{ $user->first_name ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.last_name')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="last_name" name="last_name"
                    value="{{ $user->last_name ?? '' }}">
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.email_address')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="email" name="email"
                    value="{{ $user->email ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label">{{ cleanLang(__('lang.telephone')) }}</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="phone" name="phone"
                    value="{{ $user->phone ?? '' }}">
            </div>
        </div>

        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Description')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <textarea name="description" cols="30" rows="7"
                    class="form-control form-control-sm">{{ $user->description ?? '' }}</textarea>
            </div>
        </div>
        
        <!--attach recipt-->
        <div>
            <!--fileupload-->
             <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Profile Image')) }}*</label>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="fileupload_employee_receipt">
                        <div class="dz-default dz-message">
                            <i class="icon-Upload-toCloud"></i>
                            <span>{{ cleanLang(__('lang.drag_drop_file')) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--fileupload-->
            <!--existing files-->
            @if(isset($page['section']) && $page['section'] == 'edit')
            <table class="table table-bordered">
                <tbody>
                    @foreach($attachments as $attachment)
                    @if ($attachment->attachment_unique_input === 'employee')
                    <tr id="employee_attachment_{{ $attachment->attachment_id }}">
                        <td>{{ $attachment->attachment_filename }} </td>
                        <td class="w-px-40"> <button type="button"
                                class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active
                                data-ajax-type="DELETE"
                                data-url="{{ url('/employees/attachments/'.$attachment->attachment_uniqiueid) }}">
                                <i class="sl-icon-trash"></i>
                            </button></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>


        <!--pass source-->
        <input type="hidden" name="source" value="{{ request('source') }}">

        <!--notes-->
        <div class="row">
            <div class="col-12">
                <div><small><strong>* {{ cleanLang(__('lang.required')) }}</strong></small></div>
            </div>
        </div>
    </div>
</div>
