@extends('layout.wrapper') 
<title>Vendor Details</title>
<style>
    p{
        color: black !important;
    }
</style>
@section('content')
<!-- main content -->
<div class="container-fluid">
    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Vendor Details</div>
                <div class="card-body">
                    
                    <label class="strong">Name</label>
                    <p class="text-muted">{{ $vuser->first_name.' '.$vuser->last_name ?? 'Not  Found'}}</p>
                    <label class="strong">Email </label>
                    <p class="text-muted">{{ $vuser->email ?? 'Not  Found'}}</p>
                    <label class="strong">Phone </label>
                    <p class="text-muted">{{ $vuser->phone ?? 'Not  Found'}}</p>
                    <label class="strong">Position </label>
                    <p class="text-muted">{{ $vuser->position ?? 'Not  Found'}}</p>
                    <label class="strong">Company Name </label>
                    <p class="text-muted">{{ $vuser->company_name ?? 'Not  Found'}}</p>
                    <label class="strong">Status </label>
                    <p class="text-muted">{{ $vuser->status ?? 'Not  Found'}}</p>
                    <label class="strong">Commercial Registration_no </label>
                    <p class="text-muted">{{ $vuser->commercial_registration_no ?? 'Not  Found'}}</p>
                    <label class="strong">Trade License No </label>
                    <p class="text-muted">{{ $vuser->trade_license_no ?? 'Not  Found'}}</p>
                    <label class="strong">Address </label>
                    <p class="text-muted">{{ $vuser->address ?? 'Not  Found'}}</p>
                    <label class="strong">Category</label>
                    <p class="text-muted">{{ $vuser->category ?? 'Not  Found' }}</p>

                    
                        @if ($vuser->fvendor->company_profile != null)
                        <label class="d-block">Company Profile</label>
                        
                    <a href="{{asset('storage/public/vendor/'.$vuser->fvendor->company_profile)}}" download>Download</a>
                            
                        <hr>
                        @endif

                        @if ($vuser->fvendor->company_commercial_license != null)
                        <label class="d-block">Company Commercial License</label>
                <a href="{{asset('storage/public/vendor/'.$vuser->fvendor->company_commercial_license)}}" download>Download</a>
                            
                        <hr>
                        @endif

                        @if ($vuser->fvendor->other_documents != null)
                        <label class="d-block">Other Documents</label>
                <a href="{{asset('storage/public/vendor/'.$vuser->fvendor->other_documents)}}" download>Download</a>
                            
                        <hr>
                        @endif
                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
@endsection