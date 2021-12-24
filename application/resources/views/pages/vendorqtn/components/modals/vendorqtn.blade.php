<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('RFQ Ref')) }}</td>
                        <td>{{ $vendorqtn->rfq_ref }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Receiving Date')) }}</td>
                        <td>{{ $vendorqtn->receiving_date }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Category')) }}</td>
                        <td>{{ $vendorqtn->category }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('QRN REF NO')) }}</td>
                        <td>{{ $vendorqtn->qtn_ref_no }}</td>
                    </tr>
                    <!--description-->
                    <tr>
                        <td>{{ cleanLang(__('Total Value')) }}</td>
                        <td>{{ $vendorqtn->total_value }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Devlivery Time')) }}</td>
                        <td>{{ $vendorqtn->devlivery_time }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Status')) }}</td>
                        <td>{{ $vendorqtn->status }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Remarks')) }}</td>
                        <td>{{ $vendorqtn->remarks }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('QTN Copy')) }}</td>
                        <td>
                            @if ($vendorqtn->upload_qtn_copy != null)        
            <a href="{{ asset('storage/public/vendor/' . $vendorqtn->upload_qtn_copy) }}" download>
                            Download </a>
                            @else Not Avilable 
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('RFQ Copy')) }}</td>
                        <td>
                            @if ($vendorqtn->upload_rfq_copy != null)        
            <a href="{{ asset('storage/public/vendor/' . $vendorqtn->upload_rfq_copy) }}" download>
                            Download </a>
                            @else Not Avilable 
                            @endif
                        </td>
                    </tr>
                    
                
                   
                    {{-- <tr>
                        <td>{{ cleanLang(__('Status')) }}</td>
                        <td>{{ $vendorqtn->status }}</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
</div>