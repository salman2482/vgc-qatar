<div class="row" id="js-properties-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <!--meta data - creatd by-->
        {{-- @if(isset($page['section']) && $page['section'] == 'edit')
        <div class="modal-meta-data">
            <small><strong>{{ cleanLang(__('lang.created_by')) }}:</strong> {{ $project->first_name ?? runtimeUnkownUser() }} |
                {{ runtimeDate($project->project_created) }}</small>
        </div>
        @endif --}}

        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.property_title')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control form-control-sm" id="property_title" name="property_title"
                    placeholder="" value="{{ $property->title ?? '' }}">
            </div>
        </div>
        <!--/#title-->

        <!--description<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('lang.property_description')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <textarea name="property_description" id="property_description" class="form-control form-control-sm" cols="30" rows="10" >{{ $property->description ?? ''}}</textarea>
            </div>
        </div>
        <!--/#description-->
        
     
            <!--pass source-->
            <input type="hidden" name="source" value="{{ request('source') }}">

        </div>

    </div>
</div>
