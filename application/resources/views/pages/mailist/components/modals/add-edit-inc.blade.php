<div class="row" id="js-mails-modal-add-edit" data-section="{{ $page['section'] }}">
    <div class="col-lg-12">
        <!--title<>-->
        <div class="form-group row">
            <label
                class="col-sm-12 col-lg-3 text-left control-label col-form-label required">{{ cleanLang(__('Email')) }}*</label>
            <div class="col-sm-12 col-lg-9">
                <input type="email" class="form-control form-control-sm" name="email">
            </div>
        </div>
        <!--/#title-->

        <!--pass source-->
        <input type="hidden" name="source" value="{{ request('source') }}">

    </div>

</div>
</div>
