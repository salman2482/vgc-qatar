<div class="row">
    <div class="col-12">
        <div class="table-responsive receipt">
            <table class="table table-bordered">
                <tbody>
                    <!--date-->
                    <tr>
                        <td>{{ cleanLang(__('PO Ref')) }}</td>
                        <td>{{ $vendorpo->po_ref }}</td>
                    </tr>
                    <!--client-->
                    <tr>
                        <td>{{ cleanLang(__('Issuing Date')) }}</td>
                        <td>{{ $vendorpo->issuing_date }}</td>
                    </tr>
                    <!--project-->
                    <tr>
                        <td>{{ cleanLang(__('QTN Ref No')) }}</td>
                        <td>{{ $vendorpo->qtn_ref_no }}</td>
                    </tr>
                    <!--user-->
                    <tr>
                        <td>{{ cleanLang(__('Category')) }}</td>
                        <td>{{ $vendorpo->category }}</td>
                    </tr>
                    <!--description-->
                    <tr>
                        <td>{{ cleanLang(__('Total Value')) }}</td>
                        <td>{{ $vendorpo->total_value }}</td>
                    </tr>

                    <tr>
                        <td>{{ cleanLang(__('Terms Condition')) }}</td>
                        <td>{{ $vendorpo->terms_condition}}</td>
                    </tr>
                    
                    <!--Attchment-->
                    <tr>
                        <td>{{ cleanLang(__('QTN Copy')) }}</td>
                        <td>
                            @foreach($attachments as $attachment)
                            @if ($attachment->attachment_unique_input == 'qtn_attachments') 
                            <ul class="p-l-0">
                                <li  id="fx-vendorpos-files-attached" style="list-style: none">
                                    <a href="vendorpos/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
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
                        <td>{{ cleanLang(__('PO Copy')) }}</td>
                        <td>
                            @foreach($attachments as $attachment)
                            @if ($attachment->attachment_unique_input == 'po_attachments') 
                            <ul class="p-l-0">
                                <li  id="fx-vendorpos-files-attached" style="list-style: none">
                                    <a href="vendorpos/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                            </ul>
                            @endif
                            @endforeach
                        </td>
                    </tr>
                    <!--description-->
                   
                    {{-- <tr>
                        <td>{{ cleanLang(__('Status')) }}</td>
                        <td>{{ $vendorpo->status }}</td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
</div>