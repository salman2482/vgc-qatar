@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">PO Details</div>
                <div class="card-body">
                    <label class="strong">Ref no</label>
                    <p class="text-muted">{{ $lpo->ref_no }}</p>
                    <label class="strong">Department</label>
                    <p class="text-muted">{{ $lpo->department ?? 'not found'}}</p>
                    <label class="strong">RFM ref no</label>
                    <p class="text-muted">{{ $lpo->rfm_ref_no ?? 'not found'}}</p>
                    <label class="strong">Subject</label>
                    <p class="text-muted">{{ $lpo->subject ?? 'not found'}}</p>
                    <label class="strong">Site</label>
                    <p class="text-muted">{{ $lpo->site ?? 'not found'}}</p>
                    <label class="strong">Value</label>
                    <p class="text-muted">{{ $lpo->value ?? 'not found'}}</p>
                    <label class="strong">Date Requested</label>
                    <p class="text-muted">{{ $lpo->date_requested ?? 'not found'}}</p>
                    <label class="strong">Requestor</label>
                    <p class="text-muted">{{ $lpo->requestor ?? 'not found'}}</p>

                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
@endsection