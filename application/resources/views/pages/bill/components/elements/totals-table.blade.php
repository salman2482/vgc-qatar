<div class="col-12" id="bill-totals-wrapper">
    <!--total amounts-->
    <div class="pull-right m-t-30 text-right">

        <table class="invoice-total-table">

            <!--invoice amount-->
            <tbody id="billing-table-section-subtotal" class="{{ $bill->visibility_subtotal_row }}">
                <tr>
                    <td>{{ cleanLang(__('lang.subtotal')) }}</td>
                    <td id="billing-subtotal-figure">
                        <span>{{ runtimeMoneyFormat($bill->bill_subtotal) }}</span>
                    </td>
                </tr>
            </tbody>

            <!--discounted invoice-->
            <tbody id="billing-table-section-discounts" class="{{ $bill->visibility_discount_row }}">
                <tr id="billing-sums-discount-container">
                    @if($bill->bill_discount_type == 'percentage')
                    <td>{{ cleanLang(__('lang.discount')) }} <span class="x-small"
                            id="dom-billing-discount-type">({{ $bill->bill_discount_percentage }}%)</span>
                    </td>
                    @else
                    <td>{{ cleanLang(__('lang.discount')) }} <span class="x-small" id="dom-billing-discount-type">({{ cleanLang(__('lang.fixed')) }})</span></td>
                    @endif
                    <td id="billing-sums-discount">
                        {{ runtimeMoneyFormat($bill->bill_discount_amount) }}
                    </td>
                </tr>
                <tr id="billing-sums-before-tax-container" class="{{ $bill->visibility_before_tax_row }}">
                    <td>Total <span class="x-small">({{ cleanLang(__('lang.before_tax')) }})</span></td>
                    <td id="billing-sums-before-tax">
                        <span>{{runtimeMoneyFormat($bill->bill_amount_before_tax) }}</span></td>
                </tr>
            </tbody>

            <!--taxes-->
            <tbody id="billing-table-section-tax" class="{{ $bill->visibility_tax_row }}">
                @foreach($bill->taxes as $tax)
                <tr class="billing-sums-tax-container" id="billing-sums-tax-container-{{ $tax->tax_id }}">
                    <td>{{ $tax->tax_name }} <span class="x-small">({{ $tax->tax_rate }}%)</span></td>
                    <td id="invoice-sums-tax-{{ $tax->tax_id }}">
                        <span>{{ runtimeMoneyFormat(($bill->bill_amount_before_tax * $tax->tax_rate)/100) }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>

            <!--invoice total-->
            <tbody id="invoice-table-section-total">
                <tr class="text-themecontrast" id="billing-sums-total-container">
                    <td class="billing-sums-total">{{ cleanLang(__('lang.invoice_total')) }}</td>
                    <td id="billing-sums-total">
                        <span>{{ runtimeMoneyFormat($bill->bill_final_amount) }}</span>
                    </td>
                </tr>
            </tbody>

        </table>
        
    </div>
    
</div>