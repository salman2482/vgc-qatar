<div class="form-group row">
    <label for="example-month-input"
        class="col-12 col-form-label text-left">{{ cleanLang(__('lang.status')) }}</label>
    <div class="col-sm-12">
        @csrf
        <select class="select2-basic form-control form-control-sm" id="user_status" name="user_status">
            <option value="active" {{ $frontuser->status == 'active' ? 'selected' : '' }}>Approved</option>
            <option value="inactive" {{ $frontuser->status == 'inactive' ? 'selected' : '' }}>Rejected</option>
        </select>
    </div>
</div>
