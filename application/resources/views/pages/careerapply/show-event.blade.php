@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
    <div class="card card-body invoice-wrapper box-shadow" id="invoice-wrapper">
        <h4 class="text-center">{{$careerapply->type}} For {{$careerapply->field}}</h4>
        <hr>
        <div class="row">
            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Full Name</div>
                <div>{{$careerapply->first_name.' '.$careerapply->middle_name .''.$careerapply->last_name}}
                </div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Date Of Birth</div>
                    <div>{{$careerapply->dob}}</div>
                </div>
            </div>

            
            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Gender</div>
                    <div>{{$careerapply->gender}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Position</div>
                    <div>{{$careerapply->position}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Field</div>
                    <div>{{$careerapply->field}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Type</div>
                    <div>{{$careerapply->type}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Experience</div>
                    <div>{{$careerapply->experience}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Marital Status</div>
                    <div>{{$careerapply->marital_status}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Education</div>
                    <div>{{$careerapply->education}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Nationality</div>
                    <div>{{$careerapply->nationality}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Other Nationality</div>
                    <div>{{$careerapply->other_nationality}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Current Country</div>
                    <div>{{$careerapply->current_country}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Address</div>
                    <div>{{$careerapply->address}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Primary Email</div>
                    <div>{{$careerapply->primary_email}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Secondary Email</div>
                    <div>{{$careerapply->secondary_email}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Mobile</div>
                    <div>{{$careerapply->mobile}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Land Line</div>
                    <div>{{$careerapply->land_line}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Best Time to Receive Calls</div>
                    <div>{{$careerapply->time_to_receive_calls}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">
                        Why are you leaving your current job (if presently employed)? 
                    </div>
                    <div>{{$careerapply->why_current_job}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">
                        If you were terminated, what is the reason of termination?
                    </div>
                    <div>{{$careerapply->termination}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Qatar Governmental Permits</div>
                    <div>{{$careerapply->governmental_permits}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Non Governmental Permits</div>
                    <div>{{$careerapply->nongovernmental_permits}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">License</div>
                    <div>{{$careerapply->license}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Certificate</div>
                    <div>{{$careerapply->certificate}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Joining Date</div>
                    <div>{{$careerapply->joining_date}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">NOC Availability: </div>
                    <div>{{$careerapply->noc}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">
                        Would you have any objections if we contact your previous employer(s) for reference checking?
                    </div>
                    <div>{{$careerapply->objections}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Expected monthly salary in QAR: </div>
                    <div>{{$careerapply->expected_salary}}</div>
                </div>
            </div>
            <div class="col-12 my-3 panel-label text-center">
                Mention your last 3 employers 
            </div>
            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">1st Employer Name</div>
                    <div>{{$careerapply->employer_1}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">1st Dempartment</div>
                    <div>{{$careerapply->department_1}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">1st Designation</div>
                    <div>{{$careerapply->designation_1}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">1st In Line Manager Name</div>
                    <div>{{$careerapply->in_line_manager_1}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">1st Service Duration</div>
                    <div>{{$careerapply->service_duration_1}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">1st Salary</div>
                    <div>{{$careerapply->salary_1}}</div>
                </div>
            </div>
            <hr style="width: 100%;">

            
            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">2nd Employer Name</div>
                    <div>{{$careerapply->employer_2}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">2nd Dempartment</div>
                    <div>{{$careerapply->department_2}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">2nd Designation</div>
                    <div>{{$careerapply->designation_2}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">2nd In Line Manager Name</div>
                    <div>{{$careerapply->in_line_manager_2}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">2nd Service Duration</div>
                    <div>{{$careerapply->service_duration_2}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">2nd Salary</div>
                    <div>{{$careerapply->salary_2}}</div>
                </div>
            </div>
            <hr style="width: 100%;">

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">3rd Employer Name</div>
                    <div>{{$careerapply->employer_3}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">3rd Dempartment</div>
                    <div>{{$careerapply->department_3}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">3rd Designation</div>
                    <div>{{$careerapply->designation_3}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">3rd In Line Manager Name</div>
                    <div>{{$careerapply->in_line_manager_3}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">3rd Service Duration</div>
                    <div>{{$careerapply->service_duration_3}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">3rd Salary</div>
                    <div>{{$careerapply->salary_3}}</div>
                </div>
            </div>
            <hr style="width: 100%;">

            <div class="col-12 my-3 panel-label text-center">
                Please list down at least three (3) personal references:
            </div>
            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">1st Reference Name</div>
                    <div>{{$careerapply->references_name_1}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">1st Reference Contact No.</div>
                    <div>{{$careerapply->references_contact_1}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">1st Reference Email</div>
                    <div>{{$careerapply->references_email_1}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">1st Reference Relationship</div>
                    <div>{{$careerapply->references_relationship_1}}</div>
                </div>
            </div>
            <hr style="width: 100%;">

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">2nd Reference Name</div>
                    <div>{{$careerapply->references_name_2}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">2nd Reference Contact No.</div>
                    <div>{{$careerapply->references_contact_2}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">2nd Reference Email</div>
                    <div>{{$careerapply->references_email_2}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">2nd Reference Relationship</div>
                    <div>{{$careerapply->references_relationship_2}}</div>
                </div>
            </div>
            <hr style="width: 100%;">

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">3rd Reference Name</div>
                    <div>{{$careerapply->references_name_3}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">3rd Reference Contact No.</div>
                    <div>{{$careerapply->references_contact_3}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">3rd Reference Email</div>
                    <div>{{$careerapply->references_email_3}}</div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">3rd Reference Relationship</div>
                    <div>{{$careerapply->references_relationship_3}}</div>
                </div>
            </div>
            <hr style="width: 100%;">


            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Updated Resume</div>
                    <div>
                        @if ($careerapply->updated_resume != null)
                        <a href="{{asset('storage/public/career/'.$careerapply->updated_resume)}}" download>Download</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Certificates</div>
                    <div>
                        @if ($careerapply->certficates != null)
                        <a href="{{asset('storage/public/career/'.$careerapply->certficates)}}" download>Download</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-4 mb-3">
                <div>
                    <div class="panel-label p-b-3">Others</div>
                    <div>
                        @if ($careerapply->other_doc != null)
                        <a href="{{asset('storage/public/career/'.$careerapply->other_doc)}}" download>Download</a>
                        @endif    
                    </div>
                </div>
            </div>


        </div>
    </div>

    </div>
    <!--page content -->

</div>
<!--main content -->
@endsection