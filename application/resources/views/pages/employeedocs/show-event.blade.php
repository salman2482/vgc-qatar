@extends('layout.wrapper') @section('content')
    <!-- main content -->
    <div class="container-fluid">

        <!--page heading-->
        <div class="row page-titles justify-content-center">
            <!-- page content -->
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Employee Legal Document Details</div>
                    <div class="card-body">
                        <label>ID</label>
                        <p class="text-muted">{{ $employee->id }}</p>
                        <label>Employee No</label>
                        <p class="text-muted">{{ $employee->employee_no }}</p>
                        <label>Employee Name</label>
                        <p class="text-muted">{{ $employee->employee_name }}</p>
                        <label>Expiration</label>
                        <p class="text-muted">{{ runtimeDate($employee->expiration) }}</p>
                        <label>Visa No</label>
                        <p class="text-muted">{{ $employee->visa_no }}</p>
                        <label>ID No</label>
                        <p class="text-muted">{{ $employee->id_no }}</p>
                        <label>Passport No</label>
                        <p class="text-muted">{{ $employee->passport_no }}</p>
                        <label>Passport Expiration</label>
                        <p class="text-muted">{{ runtimeDate($employee->passport_expiration) }}</p>
                        <label>Contract No</label>
                        <p class="text-muted">{{ $employee->contract_no }}</p>
                        <label>Contract Expiration</label>
                        <p class="text-muted">{{ runtimeDate($employee->contract_expiration) }}</p>
                        <label>Arrival Date</label>
                        <p class="text-muted">{{ runtimeDate($employee->arrival_date) }}</p>
                        <label>Working Starting Date</label>
                        <p class="text-muted">{{ runtimeDate($employee->working_starting_date) }}</p>
                        <label>PHCC No</label>
                        <p class="text-muted">{{ $employee->phcc_no }}</p>
                        <label>PHCC Expiration</label>
                        <p class="text-muted">{{ runtimeDate($employee->phcc_expiration) }}</p>
                        <label>Joining Visa No</label>
                        <p class="text-muted">{{ $employee->joining_visa_no }}</p>


                        <label class="d-block">Attachments</label>
                        @foreach ($attachments as $attachment)
                            @if ($attachment->attachment_unique_input == 'id_copy')
                                <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"
                                    class="x-logo justify-content-center" width="400px" height="300px"
                                    style="margin-top:30px">
                            @endif
                            <br>
                            @if ($attachment->attachment_unique_input == 'passport_copy')
                                <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"
                                    class="x-logo justify-content-center" width="400px" height="300px"
                                    style="margin-top:30px">
                            @endif
                            <br>
                            @if ($attachment->attachment_unique_input == 'employement_contract_copy')
                                <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"
                                    class="x-logo justify-content-center" width="400px" height="300px"
                                    style="margin-top:30px">
                            @endif
                            <br>
                            @if ($attachment->attachment_unique_input == 'hamad_card_copy')
                                <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"
                                    class="x-logo justify-content-center" width="400px" height="300px"
                                    style="margin-top:30px">
                            @endif
                            @if ($attachment->attachment_unique_input == 'other_document')
                                <img src="{{ asset('storage/files/' . $attachment->attachment_uniqiueid . '/' . $attachment->attachment_filename) }}"
                                    class="x-logo justify-content-center" width="400px" height="300px"
                                    style="margin-top:30px">
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
