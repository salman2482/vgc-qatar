<div class="form-group row">
    <label for="example-month-input" class="col-12 col-form-label text-left">{{ cleanLang(__('lang.status')) }}</label>
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm" id="quotation_status"
            name="quotation_status">
            <option value="approved" {{ runtimePreselected('approved', $quotation->status) }}>{{ cleanLang(__('Approved')) }}</option>
            <option value="rejected" {{ runtimePreselected('rejected', $quotation->status) }}>{{ cleanLang(__('Rejected')) }}</option>
        </select>
    </div>
</div>