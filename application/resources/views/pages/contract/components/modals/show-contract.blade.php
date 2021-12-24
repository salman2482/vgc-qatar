<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>

                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('Ref No')) }}</td>
                        <td>{{ $contract->ref_no }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('lang.date')) }}</td>
                        <td>{{ runtimeDate($contract->issuance_date) }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('lang.client')) }}</td>
                        <td>{{ $contract->client_company_name }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('category')) }}</td>
                        <td>{{ $contract->category }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('description')) }}</td>
                        <td>{{ $contract->description }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Signed By')) }}</td>
                        <td>{{ $contract->signed_by }}</td>
                    </tr>
                    <!--description-->
                    <tr>
                        <td>{{ cleanLang(__('Expiry Date')) }}</td>
                        <td>{{ runtimeDate($contract->expiray_date) }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Renewal Date')) }}</td>
                        <td>{{ runtimeDate($contract->renewal_date) }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Project Value')) }}</td>
                        <td>{{ $contract->project_value }}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Remarks')) }}</td>
                        <td>{{ $contract->remarks }}</td>
                    </tr>
                    
                    <!--Attchment-->
                    <tr>
                        <td>{{ cleanLang(__('lang.attachement')) }}</td>
                        <td>
                            @foreach($attachments as $attachment)
                            <ul class="p-l-0">
                                @if ($attachment->attachment_unique_input === 'lpo')
                                <span>LPO Attachments: </span>
                                <li  id="fx-expenses-files-attached">
                                    <a href="contractsmgt/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                                @endif

                                @if ($attachment->attachment_unique_input === 'contract')
                                <span>Contract Attachments: </span>
                                <li  id="fx-expenses-files-attached">
                                    <a href="contractsmgt/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
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