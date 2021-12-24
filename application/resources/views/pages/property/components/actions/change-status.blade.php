<div class="form-group row">
    <label for="example-month-input"
        class="col-12 col-form-label text-left">{{ cleanLang(__('lang.status')) }}</label>
    <div class="col-sm-12">
        @csrf
        <select class="select2-basic form-control form-control-sm" id="property_status" name="property_status">
            <option value="0" {{ $property->is_approved == 0 ? 'selected' : '' }}>Rejected</option>
            <option value="1" {{ $property->is_approved == 1 ? 'selected' : '' }}>Approved</option>
            <option value="2" {{ $property->is_approved == 2 ? 'selected' : '' }}>Suspended</option>
        </select>
    </div>
</div>
