<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('Vendor Comp')) }}</td>
                        <td>{{ $vendorinvoice->user->company_name }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('LPO Ref')) }}</td>
                        <td>{{ $vendorinvoice->lpo_ref }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Delivery Date')) }}</td>
                        <td>{{ $vendorinvoice->delivery_date }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Category')) }}</td>
                        <td>{{ $vendorinvoice->category }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Total Value')) }}</td>
                        <td>{{ $vendorinvoice->total_value }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('INVOICE REF NO')) }}</td>
                        <td>{{ $vendorinvoice->invoice_ref_no }}</td>
                    </tr>
                    <!--description-->
                    
                  
                    <tr> 
                        <td>{{ cleanLang(__('Reason')) }}</td>
                        <td>{{ $vendorinvoice->reason }}</td>
                    </tr> 
                    <tr>
                        <td>{{ cleanLang(__('Status')) }}</td>
                        <td>{{ $vendorinvoice->status }}</td>
                    </tr>
                    
                    <tr>
                        <td>{{ cleanLang(__('LPO Copy')) }}</td>
                        <td>
                            @if ($vendorinvoice->upload_lpo_copy != null)        
            <a href="{{ asset('storage/public/vendor/' . $vendorinvoice->upload_lpo_copy) }}" download>
                            Download </a>
                            @else Not Avilable 
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('INVOICE Copy')) }}</td>
                        <td>
                            @if ($vendorinvoice->upload_invoice_copy != null)        
            <a href="{{ asset('storage/public/vendor/' . $vendorinvoice->upload_invoice_copy) }}" download>
                            Download </a>
                            @else Not Avilable 
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('QTN Copy')) }}</td>
                        <td>
                            @if ($vendorinvoice->upload_qtn_copy != null)        
            <a href="{{ asset('storage/public/vendor/' . $vendorinvoice->upload_qtn_copy) }}" download>
                            Download </a>
                            @else Not Avilable 
                            @endif
                        </td>
                    </tr>

                   
                </tbody>
            </table>
        </div>
    </div>
</div>