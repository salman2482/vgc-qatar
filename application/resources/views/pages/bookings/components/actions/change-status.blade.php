<div class="form-group row">
    <label for="example-month-input" class="col-12 col-form-label text-left">{{ cleanLang(__('lang.status')) }}</label>
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm" id="project_status"
            name="status">
            <option value="pending" {{ runtimePreselected('pending', $booking->status) }}>{{ cleanLang(__('Pending')) }}</option>
            <option value="collected" {{ runtimePreselected('collected', $booking->status) }}>{{ cleanLang(__('Collected')) }}</option>
        </select>
    </div>
</div>