<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                  
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('Ref No')) }}</td>
                        <td>{{ $quotation->ref_no }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Client Req-ref')) }}</td>
                        <td>{{ $quotation->client_rfq_ref }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Issuance date')) }}</td>
                        <td>{{ runtimeDate($quotation->issuance_date) }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Expiration')) }}</td>
                        <td>{{ runtimeDate($quotation->expiration) }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Delivery Date')) }}</td>
                        <td>{{ runtimeDate($quotation->delivery_date) }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Estimated By')) }}</td>
                        <td>{{ $quotation->estimated_by }}</td>
                    </tr>
                    <!--description-->
                    <tr>
                        <td>{{ cleanLang(__('Delivered By')) }}</td>
                        <td>{{ $quotation->delivered_by }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Delivery Method')) }}</td>
                        <td>{{ $quotation->delivery_method }}</td>
                    </tr>
                    <!--Attchment-->
                    <tr>
                        <td>{{ cleanLang(__('lang.attachement')) }}</td>
                        <td>
                            @foreach($attachments as $attachment)
                            <ul class="p-l-0">
                                @if ($attachment->attachment_unique_input === 'transmital_copy')
                                <span>Contract Attachments: </span>
                                <li  id="fx-expenses-files-attached">
                                    <a href="quotations/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                                @endif
                                @if ($attachment->attachment_unique_input === 'technical_copy')
                                <span>LPO Attachments: </span>
                                <li  id="fx-expenses-files-attached">
                                    <a href="quotations/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                                @endif

                                @if ($attachment->attachment_unique_input === 'financial_copy')
                                <span>Contract Attachments: </span>
                                <li  id="fx-expenses-files-attached">
                                    <a href="quotations/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                                @endif

                            </ul>
                            @endforeach
                        </td>
                    </tr>
                    <!--date-->
                    <!--description-->
                </tbody>
            </table>
        </div>
    </div>
</div>