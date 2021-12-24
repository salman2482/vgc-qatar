<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('Type of Document')) }}</td>
                        <td>{{ $govtdocument->type_of_document }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Doc No')) }}</td>
                        <td>{{ $govtdocument->doc_no }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Issue Date')) }}</td>
                        <td>{{ $govtdocument->issue_date }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Validity Date')) }}</td>
                        <td>{{ $govtdocument->validity_date }}</td>
                    </tr>
                    <!--description-->
                    <tr>
                        <td>{{ cleanLang(__('Renewal Cost')) }}</td>
                        <td>{{ $govtdocument->renewal_cost }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Last Renewal By')) }}</td>
                        <td>{{ $govtdocument->last_renewal_by }}</td>
                    </tr>
                    
                    <!--Attchment-->
                    <tr>
                        <td>{{ cleanLang(__('Document Copy')) }}</td>
                        <td>
                            @foreach($attachments as $attachment)
                            @if ($attachment->attachment_unique_input == 'document_attachments') 
                            <ul class="p-l-0">
                                <li  id="fx-govtdocuments-files-attached" style="list-style: none">
                                    <a href="govtdocuments/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                            </ul>
                            @endif
                            @endforeach
                        </td>
                    </tr>
                    <!--date-->

                    <tr>
                        <td>{{ cleanLang(__('Last Renewal Copy')) }}</td>
                        <td>
                            @foreach($attachments as $attachment)
                            @if ($attachment->attachment_unique_input == 'lrc_attachments') 
                            <ul class="p-l-0">
                                <li  id="fx-govtdocuments-files-attached" style="list-style: none">
                                    <a href="govtdocuments/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                            </ul>
                            @endif
                            @endforeach
                        </td>
                    </tr>
                    <!--description-->
                   
                    <tr>
                        <td>{{ cleanLang(__('Status')) }}</td>
                        <td>{{ $govtdocument->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>