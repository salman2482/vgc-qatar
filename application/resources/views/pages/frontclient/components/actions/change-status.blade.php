<div class="form-group row">
    <label for="example-month-input" class="col-12 col-form-label text-left">{{ cleanLang(__('lang.status')) }}</label>
    <div class="col-sm-12">
        <select class="select2-basic form-control form-control-sm" id="client_status"
            name="client_status">
            <option value="not_started" {{ runtimePreselected('not_started', $client->client_status) }}>{{ cleanLang(__('lang.not_started')) }}</option>
            <option value="in_progress" {{ runtimePreselected('in_progress', $client->client_status) }}>{{ cleanLang(__('lang.in_progress')) }}</option>
            <option value="on_hold" {{ runtimePreselected('on_hold', $client->client_status) }}>{{ cleanLang(__('lang.on_hold')) }}</option>
            <option value="cancelled" {{ runtimePreselected('cancelled', $client->client_status) }}>{{ cleanLang(__('lang.cancelled')) }}</option>
            <option value="completed" {{ runtimePreselected('completed', $client->client_status) }}>{{ cleanLang(__('lang.completed')) }}</option>
        </select>
    </div>
</div>