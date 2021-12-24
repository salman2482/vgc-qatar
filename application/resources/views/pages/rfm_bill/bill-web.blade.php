<div id="bill-form-container">
    <div class="card card-body invoice-wrapper box-shadow" id="invoice-wrapper">

        <!--HEADER-->
        <hr>
        <div class="row">
            <!--INVOICE TABLE-->
            @include('pages.rfm_bill.components.elements.main-table')


            <!--[EDITING] INVOICE LINE ITEMS BUTTONS -->
            {{-- @if (config('visibility.bill_mode') == 'editing') --}}
                <div class="col-12">
                    @include('pages.rfm_bill.components.misc.add-line-buttons')
                </div>
            {{-- @endif --}}

        </div>
    </div>
</div>

<!--ELEMENTS (invoice line item)-->
{{-- @if (config('visibility.bill_mode') == 'editing') --}}
    <!--MODALS-->
    @include('pages.rfm_bill.components.modals.items')
    {{-- @include('pages.rfm_bill.components.modals.expenses')
    @include('pages.rfm_bill.components.timebilling.modal') --}}

    <!--[DYNAMIC INLINE SCRIPT] - Get lavarel objects and convert to javascript onject-->
    {{-- <script>
        $(document).ready(function() {
            NXINVOICE.DATA.INVOICE = $.parseJSON('{!! $rfm->json ?? '' !!}');
            NXINVOICE.DOM.domState();
        });

    </script> --}}
{{-- @endif --}}
