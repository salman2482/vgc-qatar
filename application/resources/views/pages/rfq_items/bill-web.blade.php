<div id="bill-form-container">
    <div class="card card-body invoice-wrapper box-shadow" id="invoice-wrapper">

        <hr>
        <div class="row">
            @include('pages.rfq_items.components.elements.main-table')


                <div class="col-12">
                    @include('pages.rfq_items.components.misc.add-line-buttons')
                </div>
        </div>
    </div>
</div>

    @include('pages.rfq_items.components.modals.items')
    