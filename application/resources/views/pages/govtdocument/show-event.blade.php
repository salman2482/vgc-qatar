@extends('layout.wrapper') 
<title>Govt Document Details</title>
@section('content')
<!-- main content -->
<div class="container-fluid">
    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Govt Documents Details</div>
                <div class="card-body">
                    <label class="strong">ID</label>
                    <p class="text-muted">{{ $govtdocument->id }}</p>
                    <label class="strong">Type Of Document</label>
                    <p class="text-muted">{{ $govtdocument->type_of_document ?? 'not found'}}</p>
                    <label class="strong">Issue Date</label>
                    <p class="text-muted">{{ $govtdocument->issue_date ?? 'not found'}}</p>
                    <label class="strong">Validity Date</label>
                    <p class="text-muted">{{ $govtdocument->validity_date ?? 'not found'}}</p>
                    <label class="strong">Renewal Cost</label>
                    <p class="text-muted">{{ $govtdocument->renewal_cost ?? 'not found'}}</p>
                    <label class="strong">Last Renewal By</label>
                    <p class="text-muted">{{ $govtdocument->last_renewal_by ?? 'not found'}}</p>
                    <label class="strong">Status</label>
                    <p class="text-muted">{{ $govtdocument->status ?? 'not found'}}</p>
                    <label class="d-block">Attachments</label>
                    @foreach($attachments as $attachment)
                            @if ($attachment->attachment_unique_input == 'document_attachments') 
                            <ul class="p-l-0">
                                
                                <li>
                                    <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
                                </li>
                                <li  id="fx-govtdocuments-files-attached" style="list-style: none">
                                    <a href="govtdocuments/attachments/download/{{ $attachment->attachment_uniqiueid }}" download>
                                        {{ $attachment->attachment_filename }} <i class="ti-download"></i>
                                    </a>
                                </li>
                            </ul>
                            @endif
                    @endforeach
                    <hr>
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
                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
@endsection