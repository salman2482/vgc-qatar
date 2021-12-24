<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>

                    <tr>
                        <td>{{ cleanLang(__('RFM Ref#')) }}</td>
                        <td>{{ $rfm->ref_num }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Department')) }}</td>
                        <td>{{ $rfm->department }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Inline Manager')) }}</td>
                        <td>{{ ucfirst($rfm->first_name) }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Requestor')) }}</td>
                        <td>{{ ucfirst($rfm->requestor) }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Remarks')) }}</td>
                        <td>{{ ucfirst($rfm->remarks) }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('lang.date')) }}</td>
                        <td>{{ runtimeDate($rfm->due_date) }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Subject')) }}</td>
                        <td>{{ $rfm->subject }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Site')) }}</td>
                        <td>{{ $rfm->site }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Remarks')) }}</td>
                        <td >{{ $rfm->remarks ?? 'not found' }}</td>
                    </tr>


                    <tr>
                        <td>{{ cleanLang(__('Material')) }}</td>
                        <td>
                            <div class="row">
                                @foreach ($materials as $material)
                                    <div class="col-md-6">
                                        <span
                                            class="mt-1 label {{ runtimeRfmStatusLabel('assigned') }}">{{ runtimeLang($material->material->title) }}
                                        </span>
                                    </div>

                                    <div class="col-md-6">
                                        <span
                                            class="mt-1 label {{ runtimeRfmStatusLabel('assigned') }}">{{ runtimeLang($material->qty) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Attachments')) }}</td>
                        <td>
                            @foreach($attachments as $attachment)
                            <ul class="p-l-0">
                                @if ($attachment->attachment_unique_input == 'rfm_image')
                                <li  id="fx-expenses-files-attached">
                                    <a href="rfms/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                                @endif
                            </ul>
                            @endforeach
                        </td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('RFM Video')) }}</td>
                        <td>
                            @foreach($attachments as $attachment)
                            <ul class="p-l-0">
                                @if ($attachment->attachment_unique_input == 'rfm_video')
                                <video src="{{ asset('rfms/attachments/download/'.$attachment->attachment_uniqiueid) }}" controls></video>
                                <li  id="fx-expenses-files-attached">
                                    <a href="rfms/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                                @endif
                            </ul>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>