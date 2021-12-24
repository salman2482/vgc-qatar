<div class="row" id="js-materials-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <!--meta data - creatd by-->
        {{-- @if(isset($page['section']) && $page['section'] == 'edit')
        <div class="modal-meta-data">
            <small><strong>{{ cleanLang(__('lang.created_by')) }}:</strong> {{ $project->first_name ?? runtimeUnkownUser() }} |
                {{ runtimeDate($project->project_created) }}</small>
        </div>
        @endif --}}
        <input type="hidden" value="{{ csrf_token() }}">
         <!--department<>-->
         @php
             $cats = [
                 'soft service' => 'soft service',
                 'hard service' => 'hard service',
                 'office supply' => 'office supply',
                 'transport' => 'transport'
             ];
         @endphp
         <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Material Category')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                    <select class="select2-basic form-control form-control-sm" name="material_category" id="material_category"
                        data-allow-clear="false" >
                        @foreach ($cats as $cat)
                        <option value="{{ $cat }}" {{ $material->category ?? '' == $cat ? 'selected' : '' }}>{{ ucwords($cat) }}</option>                            
                        @endforeach
                    </select>
            </div>
        </div>
        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Material Title')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="material_title" name="material_title"
                     value="{{ $material->title ?? '' }}">
            </div>
        </div>
        <!--/#title-->

        <!--description<>-->
        
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Material Price')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="number" name="material_value" id="material_value" class="form-control form-control-sm" value="{{ $material->amount ?? ''}}" required>
            </div>
        </div>     
        {{-- unit --}}
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Available Stock')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="number" name="material_available_stock" id="material_available_stock" class="form-control form-control-sm" value="{{ $material->available_stock ?? ''}}" required>
            </div>
        </div>     
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Material Description')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <textarea name="material_description" id="material_description" cols="30" rows="7"  class="form-control form-control-sm" required>{{ $material->description ?? ''}}</textarea>
            </div>
        </div>     
        <div>
            <label
            class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Material Image')) }}*</label>
            <!--fileupload-->
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="dropzone dz-clickable" id="material_image">
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
                @if (isset($attachments))
                    <table class="table table-bordered">
                        <tbody>
                            @foreach($attachments as $attachment)
                                @if ($attachment->attachment_unique_input === 'material_image')
                                <tr id="material_attachment_{{ $attachment->attachment_id ?? '' }}">
                                    <td>{{ $attachment->attachment_filename ?? '' }} </td>
                                    <td class="w-px-40"> <button type="button"
                                            class="btn btn-danger btn-circle btn-sm confirm-action-danger"
                                            data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"
                                            data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" active"
                                            data-ajax-type="DELETE"
                                            data-url="{{ url('/materials/attachments/'.$attachment->attachment_uniqiueid ?? '') }}">
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
</div>
