<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>

                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('Ref No')) }}</td>
                        <td>{{ $document->ref_no ?? ''}}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Issue Date')) }}</td>
                        <td>{{ runtimeDate($document->issue_date ?? '') }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Category')) }}</td>
                        <td>{{ $document->category ?? ''}}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Subject')) }}</td>
                        <td>{{ $document->subject ?? '' }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('Delivered By')) }}</td>
                        <td>{{ $document->delivered_by ?? '' }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Delivery Method')) }}</td>
                        <td>{{ $document->delivery_method ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>{{ cleanLang(__('Remarks')) }}</td>
                        <td>{{ $document->remarks ?? ''}}</td>
                    </tr>
                    <!--description-->
                    <tr>
                        <td>{{ cleanLang(__('Expiration')) }}</td>
                        <td>{{ runtimeDate($document->expiration ?? '' ) }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Delivery Date')) }}</td>
                        <td>{{ runtimeDate($document->delivery_date ?? '' ) }}</td>
                    </tr>
                     <!--Attchment-->
                     <tr>
                        <td>{{ cleanLang(__('lang.attachement')) }}</td>
                        <td>
                            @forelse($attachments as $attachment)
                            <ul class="p-l-0">
                                @if ($attachment->attachment_unique_input === 'document_submital_copy')
                                <span>Submital Attachments: </span>
                                <li  id="fx-expenses-files-attached">
                                    <a href="documents/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                                @endif

                                @if ($attachment->attachment_unique_input === 'document_doc_file')
                                <span>Document Attachments: </span>
                                <li  id="fx-expenses-files-attached">
                                    <a href="documents/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                                @endif
                            </ul>
                            @empty
                            Not found !!
                            @endforelse
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>