@extends('front-end.layouts.master')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <style>
        .fc-title {
            color: aliceblue;
        }

        .fc-time {
            color: white;
        }

        table td {
            overflow: visible; //Remove this to fix the issue.
        }

    </style>
@endsection
@section('front-end-content')

    <div class="container px-1 px-md-4 py-5 mx-auto">
        <div class="row">
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large
                modal</button> --}}
            <div class="col-12">
                <h6 class="text-info mb-5">Dear Customer, kindly select from the below calendar the available timing for
                    your
                    booking, “highlighted in blue”</h6>
                <!--contacts table-->
                <div id='full_calendar_events'></div>
                <!--contacts table-->
            </div>
        </div>
    </div>

    <div class="modal fade event-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Book Your Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding:2rem !important">
                    <form action="{{ route('front.booking.store') }}" method="post">
                        @csrf
                        <div class="row px-3 mt-3">
                            <div class="col-md-12">
                                <p class="mb-2 w-100 text-danger">Please fill up the following fields</p>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="full_name" class="form-control" required
                                        placeholder="Full Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" required placeholder="Email">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="telephone" class="form-control" required
                                        placeholder="Telephone">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-3 mb-4">
                                    <input type="text" name="street_no" class="form-control" required
                                        placeholder="Street no">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-3 mb-4">
                                    <input type="text" name="bldg_no" class="form-control" required
                                        placeholder="Building no">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-3 mb-4">
                                    <input type="text" name="zone_no" class="form-control" required placeholder="Zone no">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-3 mb-4">
                                    <input type="text" name="unit_no" class="form-control" required placeholder="Unit no">
                                </div>
                            </div>

                            <div class="col-md-12">

                                <label class="checkbox-inline mr-3">
                                    <input name="payment_type" type="radio" value="debit/credit"> Debit / Credit on machine
                                </label>

                                <label class="checkbox-inline">
                                    <input type="radio" value="cash" name="payment_type"> Cash
                                </label>

                            </div>

                            <input type="hidden" name="service" value="{{ $service_id }}">
                            <input type="hidden" name="employee" value="{{ $id }}">
                            <input type="hidden" name="schedule_id" value="" id="schedule_id">
                            <input type="hidden" name="price" value="{{ session('price') }}">
                            <input type="hidden" name="description" value="{{ session('description') }}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="conditions">
                                        <input type="checkbox" class="form-contorl mt-1" id="conditions" value="0">
                                        <span class="ml-1" style="font-size: 15px;font-weight:bold"> I agree service terms
                                            and condition <a href="#" data-toggle="modal"
                                                data-target="#exampleModalLong">Read Here</a> </span>
                                    </label>
                                </div>
                                <div id=msg_terms name=msg_terms>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="booking" class="btn btn-primary" disabled>Book Schedule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Household service terms of use.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="padding: 2rem !important">
                        <h6 dir="ltr"><span>TERMS AND CONDITIONS&nbsp;</span></h6>
                        <ol>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>DEFINITIONS AND INTERPRETATION</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>&nbsp;Definitions</span></p>
                                </li>
                            </ol>
                        </ol>
                        <p dir="ltr"><span>The following words have these meanings in this Agreement unless the contrary
                                intention appears:</span></p>
                        <p dir="ltr"><strong>Agreement</strong><span> means this Service Agreement including any Schedule or
                                annexure;</span></p>
                        <p dir="ltr"><strong>Business Day</strong><span> means any day excluding Friday, Saturday, a public
                                holiday in Qatar;</span></p>
                        <p dir="ltr"><strong>Commencement Date </strong><span>means the date on which this Agreement is
                                executed;&nbsp;</span></p>
                        <p dir="ltr"><strong>Confidential Information</strong><span> means any information that is:</span>
                        </p>
                        <p><span><span>&nbsp;</span></span></p>
                        <ol>
                            <li dir="ltr">
                                <p dir="ltr"><span>Relating to the Recipient, whether business or personal, which would
                                        reasonably be considered to be private or proprietary to the Recipient and that is
                                        not generally known and where the release of that Confidential Information could
                                        reasonably be expected to cause harm to the Recipient. This includes, but is not
                                        limited to; trade secrets, confidential materials and information which may be
                                        discovered during the course of rendering the Services for the
                                        Recipient.&nbsp;</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>The Provider agrees they will not disclose, divulge, reveal, report or
                                        use, for any purpose, any Confidential Information which the Provider has obtained,
                                        except as approved by the Recipient in writing or as required by law. The
                                        obligations of confidentiality will apply during the Term and will survive
                                        indefinitely upon termination of this Agreement.&nbsp;</span></p>
                            </li>
                        </ol>
                        <p dir="ltr"><span>Order Details</span><span> means the order for Services in the form of a
                                quotation provided to the Recipient from the Provider prior to entering into this Agreement;
                                and</span></p>
                        <p dir="ltr"><span>Services</span><span> means the services specified in Item 5 of the Schedule or
                                as agreed between the Parties from time to time.</span></p>
                        <ol start="2">
                            <li dir="ltr">
                                <p dir="ltr"><span>Interpretation</span></p>
                            </li>
                        </ol>
                        <p dir="ltr"><span>In this Agreement:</span></p>
                        <ol>
                            <li dir="ltr">
                                <p dir="ltr"><span>references to a person include an individual, form or a body, whether
                                        incorporated or unincorporated;</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>clause headings are for references only and shall not form part of this
                                        Agreement nor used in the interpretation of this Agreement;</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>if the time of doing an act or thing under this Agreement falls on a
                                        day</span></p>
                            </li>
                        </ol>
                        <p dir="ltr"><span>which is not a Business Day, then the time of doing that act or thing shall be
                                deemed to be the next Business Day;</span></p>
                        <ol start="4">
                            <li dir="ltr">
                                <p dir="ltr"><span>words in the singular include the plural and vice versa in accordance
                                        with the context of which that word is used;</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>words importing a gender include other genders;</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>a reference to a clause is a reference to a clause in this
                                        Agreement;</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>a reference to any of the words 'include', 'includes' and 'including' is
                                        to be read as if followed by the words "without limitation";</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>a reference to a statute, ordinance, code or law includes regulations and
                                        other instruments under it and any consolidations, amendments, re- enactments or
                                        replacements of any of them;</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>a reference to any party includes that party's executors, administrators,
                                        substitutes, successors and permitted assigns; and</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>each party has participated in the negotiating and drafting of this
                                        document and in the event of ambiguity or a question of interpretation arising, this
                                        Agreement is to be construed as if the Agreement was drafted jointly.</span></p>
                            </li>
                        </ol>
                        <ol start="2">
                            <li dir="ltr">
                                <h6 dir="ltr"><span>COMMENCING AND COMPLETING THE SERVICES</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Commencing the Services</span></p>
                                </li>
                                <ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The Provider will commence the Services on the agreed upon days
                                                and times outlined in the Order Detail.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The Provider must within forty-eight (48) hours provide written
                                                notice to the Recipient requesting additional information if all of the
                                                relevant information and material for completion of the Services has not
                                                been provided for the completion of the Services. If no written notice is
                                                provided, it is implied all relevant information and materials have been
                                                supplied.</span></p>
                                    </li>
                                </ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Completing the Services</span></p>
                                </li>
                                <ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The Provider agrees to complete the Services by the agreed upon
                                                date and time on the agreed upon frequency stipulated in the Order
                                                Detail.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>If the Provider foresees being unable to complete the Services by
                                                the agreed upon date and time, the Provider must inform the Recipient at
                                                least two (2) days prior to the agreed upon date.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>Upon completing the Services, the Provider shall deliver the
                                                Services to the Recipient by the means prescribed in Item 4 of the Agreement
                                                Schedule.</span></p>
                                    </li>
                                </ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Alterations and Modifications to the Services</span></p>
                                </li>
                                <ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>If the Provider is required to alter the description of the
                                                Services, the Provider must first obtain written instruction from the
                                                Recipient.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>Where the Recipient requires modifications to the Order Detail
                                                for the Services, the Recipient must notify the Provider at least two (2)
                                                days prior to the Services being required to be completed. This notification
                                                must be in the approved form of communication and in writing specifying the
                                                requested alterations or modifications.&nbsp;</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>In the event the modifications or alterations to the Services
                                                require additional materials to be used (as an example, but not limited to,
                                                specific cleaners for surfaces which require manufacturer instructions to be
                                                followed), the Provider is entitled to request the Recipient provide the
                                                additional materials or the Provider will obtain them and seek reimbursement
                                                for the costs associated with those materials. The Recipient in the latter
                                                scenario will reimburse the Provider for the costs of the additional
                                                materials.&nbsp;</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>Where the Recipient wishes to modify or alter the Services and
                                                additional work outside of the Order Detail is required, the Provider will
                                                charge for these additionally with a separate quotation or invoice once the
                                                final form of work and payment amount has been agreed upon between the
                                                parties.&nbsp;</span></p>
                                    </li>
                                </ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Outside Work</span></p>
                                </li>
                                <ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>If the Provider has to obtain goods and/or services from a third
                                                party, the Provider must first obtain written consent from The Recipient and
                                                have the third party give an undertaking of confidentiality that is
                                                satisfactory to the Recipient before instructing or giving Confidential
                                                Information to the third party.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>If the third party breaches the aforementioned undertaking of
                                                confidentiality, the Provider is liable for any losses or damages suffered
                                                by the Recipient.</span></p>
                                    </li>
                                </ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Quality of Work and Rectification&nbsp;</span></p>
                                </li>
                                <ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The Provider warrants their work will be performed at a
                                                professional standard and every reasonable care will be taken to ensure the
                                                Recipient is satisfied with the Services.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>In the event the Recipient alleges any defects or incompletion of
                                                the Services, the Recipient will notify the Provider within 24 hours of the
                                                Services being completed.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The Provider will return to the premises where the Services were
                                                completed and rectify any alleged defective or incomplete work to the
                                                satisfaction of the Recipient.&nbsp;</span></p>
                                    </li>
                                </ol>
                            </ol>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>PAYMENT FOR THE SERVICES</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Consideration</span></p>
                                </li>
                            </ol>
                        </ol>
                        <p dir="ltr"><span>The Recipient agrees to pay the Provider an amount set out in Item 5 of the
                                Schedule (the 'Consideration').</span></p>
                        <ol start="2">
                            <li dir="ltr">
                                <p dir="ltr"><span>Time and Method for Payment</span></p>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Recipient will make Payment of the Consideration pursuant to Item
                                            6 of the Schedule</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Recipient will make Payment of Consideration by the method
                                            prescribed in Item 7 of the Schedule.</span></p>
                                </li>
                            </ol>
                            <li dir="ltr">
                                <p dir="ltr"><span>Tax</span></p>
                            </li>
                        </ol>
                        <p dir="ltr"><span>Unless otherwise stated, all amounts, including out of pocket expenses, expressed
                                and described on or in connection with this Agreement and/or its Schedule, are listed in
                                Qatari Riyal and are tax inclusive, being goods and services tax. Where the services are
                                provided outside Qatar, the tax is inapplicable.</span></p>
                        <ol start="4">
                            <li dir="ltr">
                                <p dir="ltr"><span>Cancellations</span></p>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Recipient is required to cancel the Services no later than 48
                                            hours prior to when they were scheduled for completion. In the event the
                                            Recipient cancels outside of this time period, the Recipient agrees to pay a
                                            QAR150.00 cancellation fee.&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Where the Recipient cancels the Service not in accordance with the
                                            minimum required notice outlined in this Agreement, the Recipient agrees to the
                                            cancellation fee in clause 3.4(a).&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Where the cancellation occurs on the same day the Service is to be
                                            completed, the Recipient will be charged 100% of the prescribed Consideration as
                                            a cancellation fee.&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Where the Recipient has not provided the Provider with the keys,
                                            codes, or other devices for access to the premises, rendering the Provider
                                            unable to enter the premises to complete the Services, the Recipient agrees to
                                            be charged 50% of the Consideration amount (</span><span>&lsquo;Lock Out
                                            Fee</span><span>&rsquo;).&nbsp;</span></p>
                                </li>
                            </ol>
                        </ol>
                        <p><span><span>&nbsp;</span></span></p>
                        <ol start="4">
                            <li dir="ltr">
                                <h6 dir="ltr"><span>INDEMNIFICATION</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Indemnification</span></p>
                                </li>
                                <ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The parties hereby indemnify and agree to keep indemnified each
                                                other against all liability, losses or expenses incurred by either party in
                                                relation to or in any way directly or indirectly connected with any breach
                                                of copyright or any rights in relation to copyright in such works
                                                supplied.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>Except to the extent paid in settlement from any applicable
                                                insurance policies, and to the extent permitted by the applicable law, the
                                                Provider and Recipient agree to indemnify and hold harmless each other,
                                                their respective affiliates, officers, agents, employees, and permitted
                                                successors and assignees against any and all claims, losses, damages,
                                                liabilities, penalties, punitive damages, expenses, reasonable legal fees
                                                and costs of any kind or amount whatsoever, which result from or arise out
                                                of any act or omission of the indemnifying party, their respective
                                                affiliates, officers, agents, employees, and permitted successors and
                                                assignees that occurs in connection with this Agreement.&nbsp;&nbsp;</span>
                                        </p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The indemnification will survive the expiry or termination of
                                                this Agreement.&nbsp;</span></p>
                                    </li>
                                </ol>
                            </ol>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>TERMINATION&nbsp;</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>For The Recipient</span></p>
                                </li>
                                <ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The Recipient may terminate this Agreement with the Provider for
                                                any breach of this Agreement by providing fourteen (14) days written notice
                                                to the Provider. At the Recipient's discretion, The Recipient may allow the
                                                Provider to remedy the breach within fourteen (14) days' notices, or another
                                                time-frame as the Recipient elects, and in being satisfied with the remedy
                                                of the breach by the Provider, the Recipient will not be entitled to
                                                terminate this Agreement.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The Recipient may terminate this Agreement for any reason by
                                                providing the Provider with thirty (30) days' written notice of the
                                                Recipient's intent to terminate this Agreement.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>Upon receiving notification of the Recipient's intent to
                                                terminate this Agreement, the Provider will continue work on the Services
                                                until the lapse of the notice period, unless the Recipient's provides
                                                express written notice to cease work on the Services.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>If The Recipient terminates this Agreement for reasons other than
                                                a breach of this Agreement by the Provider, the Recipient will pay the
                                                Provider for the portion of the Services completed to date and time of
                                                cancellation including any amounts outstanding.</span></p>
                                    </li>
                                </ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>For the Provider</span></p>
                                </li>
                                <ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The Provider may terminate this Agreement by providing fourteen
                                                (14) days written notice to the Recipient of the Provider's intent to
                                                terminate this Agreement.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The Provider may terminate this Agreement for a breach by the
                                                Recipient of this Agreement by providing fourteen (14) days' written notice
                                                of the breach to The Recipient. During the fourteen (14) day notice period,
                                                the Recipient reserves the right to remedy the breach. If the Recipient
                                                remedies the breach which was the cause of the notice, this Agreement will
                                                not be terminated at the lapse of the fourteen (14) days on the notice's
                                                basis.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>Upon providing notice of the Provider's intent to terminate this
                                                Agreement, the Provider agrees to continue providing the Services until the
                                                cessation of the notice period unless otherwise instructed by the Recipient
                                                to cease work.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>If the Provider provides notice of intent to terminate this
                                                Agreement, the Recipient will pay for the work which has been done and at
                                                the time the Agreement is terminated, will pay any outstanding works
                                                completed between the provision of the notice to terminate and the cessation
                                                of this Agreement. If the Recipient elects to have the Provider cease work
                                                upon receiving notification of the Provider's intent to terminate, the
                                                Recipient will only be liable to pay amounts outstanding on work completed
                                                by the Provider to the date the request to cease work was issued by the
                                                Recipient.</span></p>
                                    </li>
                                </ol>
                            </ol>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>NON-SOLICITATION</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Non- Solicitation of the Provider&rsquo;s Personnel</span></p>
                                </li>
                                <ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>During the course of this Agreement, the Recipient, its employees
                                                and subcontractors, may have access to commercially sensitive information
                                                and material. The Recipient will not either directly or indirectly, without
                                                written consent from the Provider:</span></p>
                                    </li>
                                    <ol>
                                        <li dir="ltr">
                                            <p dir="ltr"><span>Employ, canvas, solicit, entice or engage any of the
                                                    Provider's employees, servants, contractors, and/or agents
                                                    (</span><span>'Personnel'</span><span>), to terminate their employment
                                                    with the Provider; and</span></p>
                                        </li>
                                        <li dir="ltr">
                                            <p dir="ltr"><span>Employ, engage, retain or source any of the Provider's
                                                    Personnel for any services that are of a competitive nature to the
                                                    Provider's business.</span></p>
                                        </li>
                                    </ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>In the event the Recipient does solicit the Provider&rsquo;s
                                                Personnel, as outlined in this clause 6.1, the Provider will be entitled to
                                                immediately terminate this Agreement.&nbsp;</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>In addition to clause 6.1(b), the Provider will charge a fixed
                                                termination fee of QAR2,500.00 for breach of the non-solicitation clause
                                                plus a penalty of QAR50,000.00.&nbsp;</span></p>
                                    </li>
                                </ol>
                            </ol>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>SUPPLY OF MATERIALS</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Provider will supply all materials as required to complete the
                                            Services.</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Provider must ensure the materials and equipment supplied are
                                            cleaned regularly and well maintained except for fair wear and tear. The
                                            Provider is also required to ensure the products supplied are fit for
                                            purpose.&nbsp;&nbsp;&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Where the Recipient requires specific, or particularly branded,
                                            materials and supplies to be used, the Recipient is required to request these
                                            specific materials in writing from the Provider or it will be assumed the
                                            Recipient will be supplying these items to be used when completing the
                                            Services.&nbsp;</span></p>
                                </li>
                                <ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>Where the Provider is required to obtain these specific
                                                materials, the Recipient will provide a reimbursement for the cost to the
                                                Provider.&nbsp;</span></p>
                                    </li>
                                </ol>
                            </ol>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>RECIPIENT OBLIGATIONS</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Where the Recipient has a Service scheduled to be undertaken by the
                                            Provider, the Recipient is to ensure any and all valuable, fragile, and
                                            important items or devices are removed from the premises where the Services are
                                            being undertaken.&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>In the event these items are not removed from the premises where the
                                            Services are being performed, the Recipient will be liable for any loss or
                                            damage incurred to these items.&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Where the Recipient is of the opinion the Provider&rsquo;s Personnel
                                            have committed theft, damaged, caused harm or injury to, any property or items
                                            of the Recipient, they are to notify the Provider as soon as
                                            possible.&nbsp;</span></p>
                                </li>
                                <ol>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The Provider in this circumstance will undertake an investigation
                                                and hold its personnel liable for any damages or violation and harm done by
                                                him/her.&nbsp;</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>In the event the Provider&rsquo;s Personnel has been found, as a
                                                result of the investigations, to have committed theft, the Provider will
                                                determine in its sole discretion as to whether this will be reported to the
                                                authorities.&nbsp;</span></p>
                                    </li>
                                </ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Recipient must at all times adhere to all Health and Safety
                                            protocols of the Provider.</span></p>
                                </li>
                            </ol>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>RECIPIENT PROPERTY</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>From time to time the Recipient may require the Provider to store and
                                            hold the Recipient&rsquo;s property, namely, access devices such as keys and
                                            access codes (</span><span>&lsquo;Access Devices</span><span>&rsquo;) to enter
                                            the premises to complete the Services.&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Where this is required, the Recipient will advise the Provider in
                                            writing.&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><a
                                            href="https://www.lawinsider.com/clause/use-of-company-property"><span>The</span></a><span>Provider&nbsp;agrees
                                            that for the duration of this Agreement, they shall&nbsp;</span></p>
                                </li>
                            </ol>
                        </ol>
                        <ol>
                            <li dir="ltr">
                                <p dir="ltr"><span>protect and conserve the Recipient&rsquo;s property including equipment,
                                        supplies and any other property entrusted to the Provider; and&nbsp;</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>not directly or indirectly, use, or allow the use of, the
                                        Recipient&rsquo;s property, for any other activities except for accessing the
                                        premises to complete the Services, except with the written approval of the
                                        Recipient.</span></p>
                            </li>
                        </ol>
                        <ol start="4">
                            <li dir="ltr">
                                <p dir="ltr"><span>In the event the Recipient&rsquo;s Access Devices have been damaged or
                                        lost as a direct, or indirect, result of the Provider&rsquo;s use, or misuse, of the
                                        Access Devices, the Provider will be liable to rectify the damage or bear the cost
                                        of rectification or replacement where necessary.</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>Upon the expiry, or termination, of this Agreement, the Provider will
                                        return to the Recipient any and all Access Devices which are the property of the
                                        Recipient.&nbsp;</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>Damage to Recipient Property (other than Access Devices)</span></p>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Where the Provider, their employees or subcontractors, damage the
                                            Recipient&rsquo;s property whilst completing the Services, the Recipient is to
                                            notify the Provider immediately upon being made aware of the damage. The
                                            Recipient is also required to submit documentary evidence such as photographs of
                                            the damage to the Provider for assessment.&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Provider will assess the object, area, or items damaged, and use
                                            their best efforts to rectify, fix, or replace the object, area or item at their
                                            own cost.&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>In the event the Provider is unable to provide a solution to rectify,
                                            repair, or replace the object, the Provider will be required to fairly
                                            compensate the Recipient for the appropriate cost of the item, area, or objects
                                            damaged.&nbsp;</span></p>
                                </li>
                            </ol>
                        </ol>
                        <ol start="10">
                            <li dir="ltr">
                                <h6 dir="ltr"><span>CAPACITY</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>In providing the Services pursuant to this Agreement it is expressly
                                            agreed the Provider is acting as an independent contractor and not as an
                                            employee. The Provider and the Recipient acknowledge this Agreement is
                                            exclusively a contract for service and does not create a partnership or joint
                                            venture between them.&nbsp;</span></p>
                                </li>
                            </ol>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>RIGHT OF SUBSTITUTION, TRANSFER, ASSIGNMENT&nbsp;</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Provider must not engage a third-party sub-contractor to perform
                                            some or all of the obligations of the Provider under this
                                            Agreement.&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Provider must not transfer or assign their rights under this
                                            Agreement to any third-party sub-contractor without the express approval of the
                                            Recipient which may be refused.&nbsp;</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Recipient will not hire or engage any third-parties to assist
                                            with the provision of the Services.&nbsp;</span></p>
                                </li>
                            </ol>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>EXCLUSIVITY</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>During the Term of the Agreement, the Provider is precluded from
                                            entering into any other agreements with other third parties for the Services or
                                            for services that are similar to the Services.</span></p>
                                </li>
                            </ol>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>INSURANCE</span></h6>
                            </li>
                            <ul>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Provider must:</span></p>
                                </li>
                            </ul>
                        </ol>
                        <ul>
                            <li dir="ltr">
                                <p dir="ltr"><span>Insure against liability at common law and if applicable under the
                                        relevant workers compensation statute in respect of the Services for the sum of
                                        QAR100,000.00;</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>Insure against liability to third persons (both personal and property) in
                                        respect of the Services;</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>Lodge, with the Recipient, evidence that all insurances specified in this
                                        Agreement have been affected; and</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>Provide evidence to the Recipient, from time to time, that the insurances
                                        required are current.</span></p>
                            </li>
                        </ul>
                        <ol start="14">
                            <li dir="ltr">
                                <h6 dir="ltr"><span>LIABILITY AND WAIVERS</span></h6>
                            </li>
                            <ol>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Liability</span></p>
                                </li>
                                <ul>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The total liability of The Recipient and its Personnel to the
                                                Provider for damage, loss or reliance shall be limited to any outstanding
                                                payments (if any) for Services completed by the Provider and not paid by The
                                                Recipient.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The Provider expressly understands and agrees that The Recipient
                                                and its Personnel shall not be liable to the Provider for any direct,
                                                indirect, incidental, special consequential or exemplary damages which may
                                                be incurred by the Provider, however caused and under any theory of
                                                liability; including, but not limited to: any loss of profit (incurred
                                                directly or indirectly), any loss of goodwill or business reputation, death
                                                or personal injury and any other intangible loss.</span></p>
                                    </li>
                                </ul>
                                <li dir="ltr">
                                    <p dir="ltr"><span>Waivers</span></p>
                                </li>
                                <ul>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>A waiver of any right, power or remedy under this agreement must
                                                be in writing signed by the party granting it. A waiver is only effective in
                                                relation to the particular obligation or breach in respect of which it is
                                                given. It is not to be taken as an implied waiver of any other obligation or
                                                breach or as an implied waiver of that obligation or breach in relation to
                                                any other occasion.</span></p>
                                    </li>
                                    <li dir="ltr">
                                        <p dir="ltr"><span>The fact that a party fails to do, or delays in doing, something
                                                the party is entitled to do under this agreement does not amount to a
                                                waiver.</span></p>
                                    </li>
                                </ul>
                            </ol>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>ENTIRE AGREEMENT</span></h6>
                            </li>
                            <ul>
                                <li dir="ltr">
                                    <p dir="ltr"><span>This Agreement supersedes all prior arrangements, understandings and
                                            negotiations in respect of the Services or any other matter covered by this
                                            Agreement.</span></p>
                                </li>
                                <li dir="ltr">
                                    <p dir="ltr"><span>The Parties acknowledge that no representations have been made that
                                            this Agreement is a contract of employment under which the Recipient is the
                                            employer of the Provider.</span></p>
                                </li>
                            </ul>
                            <li dir="ltr">
                                <h6 dir="ltr"><span>NOTICES</span></h6>
                            </li>
                        </ol>
                        <ul>
                            <li dir="ltr">
                                <p dir="ltr"><span>Any notice or other communication under this Agreement must be in
                                        writing, must be delivered personally, given by secure post or by email, to the
                                        other party at the address or email notified at the beginning of this Agreement or
                                        any other address as the parties may from time to time notify to the other in
                                        writing.</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>Service by Email</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>A notice may be delivered by email by either party having the notice in
                                        the body of an email to the other party or attaching an electronic copy of the
                                        notice to an email.&nbsp; However, email may only be used to deliver a notice if the
                                        email address for a party is shown at the beginning of this Agreement and that is
                                        the address to which the notice is sent.</span></p>
                            </li>
                            <li dir="ltr">
                                <p dir="ltr"><span>A notice sent by email is to be treated as having been received when the
                                        sender receives a return email, which is an email in reply or from the
                                        recipient&rsquo;s email system confirming delivery or that it has been read.</span>
                                </p>
                            </li>
                        </ul>
                        <ol start="17">
                            <li dir="ltr">
                                <h6 dir="ltr"><span>AMENDMENT</span><span>OF AGREEMENT</span></h6>
                            </li>
                        </ol>
                        <p dir="ltr"><span>Any modification of this Agreement or additional obligations assumed by either
                                party in connection with this Agreement will only be binding if provided to each party in
                                writing and agreed upon by both parties.&nbsp;</span></p>
                        <ol start="18">
                            <li dir="ltr">
                                <h6 dir="ltr"><span>ENTIRE</span><span>AGREEMENT</span></h6>
                            </li>
                        </ol>
                        <p dir="ltr"><span>It is agreed that there is no representation, warranty, collateral agreement or
                                condition affecting this Agreement except as expressly provided for in this
                                Agreement.</span></p>
                        <ol start="19">
                            <li dir="ltr">
                                <h6 dir="ltr"><span>GOVERNING LAW</span></h6>
                            </li>
                        </ol>
                        <p dir="ltr"><span>This Agreement will be governed by and construed in accordance with the laws of
                                the State of Doha, Qatar.&nbsp;</span></p>
                        <ol start="20">
                            <li dir="ltr">
                                <h6 dir="ltr"><span>SEVERABILITY&nbsp;</span></h6>
                            </li>
                        </ol>
                        <p dir="ltr"><span>In the event any of the provisions of this Agreement are held to be invalid or
                                unenforceable in whole or in part, all other provisions will nevertheless continue to be
                                valid and enforceable with the invalid or unenforceable parts severed from the remainder of
                                this Agreement.</span></p>
                        <ol start="21">
                            <li dir="ltr">
                                <h6 dir="ltr"><span>WAIVER</span></h6>
                            </li>
                        </ol>
                        <p dir="ltr"><span>Any waiver of a default under this Agreement must be made in writing and shall
                                not be a waiver of any other default concerning the same or any other provision of this
                                Agreement.&nbsp; No delay or omission in the exercise of any right or remedy shall impair
                                such right or remedy or be constructed as a waiver.&nbsp; A consent to or approval of any
                                act shall not be deemed to waive or render unnecessary consent to or approval of any other
                                or subsequent act.</span></p>
                        <p dir="ltr"><span>Schedule&nbsp;</span></p>
                        <p><span><span>&nbsp;</span></span></p>
                        <div dir="ltr" align="left">
                            <table>
                                <colgroup>
                                    <col width="281" />
                                    <col width="377" />
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p dir="ltr">&nbsp;</p>
                                            <p dir="ltr"><span>Item&nbsp;</span></p>
                                        </td>
                                        <td><br />
                                            <p dir="ltr"><span>Description</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><br />
                                            <ol>
                                                <li dir="ltr">
                                                    <p dir="ltr"><span>Commencement Date</span></p>
                                                </li>
                                            </ol>
                                        </td>
                                        <td><br />
                                            <p dir="ltr"><span>As per the Order Details</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><br />
                                            <ol start="2">
                                                <li dir="ltr">
                                                    <p dir="ltr"><span>The Services</span></p>
                                                </li>
                                            </ol>
                                        </td>
                                        <td><br />
                                            <p dir="ltr"><span>Cleaning and/or facility management services, as per the
                                                    Order Details</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><br />
                                            <ol start="3">
                                                <li dir="ltr">
                                                    <p dir="ltr"><span>Delivery of the Services</span></p>
                                                </li>
                                            </ol>
                                        </td>
                                        <td><br />
                                            <p dir="ltr"><span>In accordance with the Order Details</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><br />
                                            <ol start="4">
                                                <li dir="ltr">
                                                    <p dir="ltr"><span>Consideration</span></p>
                                                </li>
                                            </ol>
                                        </td>
                                        <td><br />
                                            <p dir="ltr"><span>In accordance with the Order Details</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><br />
                                            <ol start="5">
                                                <li dir="ltr">
                                                    <p dir="ltr"><span>Payment Arrangement</span></p>
                                                </li>
                                            </ol>
                                        </td>
                                        <td><br />
                                            <p dir="ltr"><span>As per the Order Details</span></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><br />
                                            <ol start="6">
                                                <li dir="ltr">
                                                    <p dir="ltr"><span>Method of Payment</span></p>
                                                </li>
                                            </ol>
                                        </td>
                                        <td><br />
                                            <p dir="ltr"><span>As per the Order Details</span></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#conditions').on('click', function() {
                    if ($('#conditions').length > 0) {
                        $('#conditions').attr('disabled', 'true'); // disable button
                        $('#booking').removeAttr('disabled');

                    } else {
                        alert('not empty')
                    }

                });

                var SITEURL = "{{ url('/') }}";
                var user_id = {{ $id }};

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var calendar = $('#full_calendar_events').fullCalendar({
                    // defaultView: 'agendaDay',
                    displayEventTime: true,
                    allDaySlot: false,
                    editable: false,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month'
                    },
                    events: "{{ route('front.employees.add-schedule') }}" + '/' + user_id,

                    displayEventTime: false, // previous true
                    eventRender: function(event, element, view) {
                        console.log(event);
                        if (event.allDay === 'true') {
                            event.allDay = true;
                        } else {
                            event.allDay = false;
                        }
                    },
                    selectable: false,
                    selectHelper: false,
                    eventClick: function(event) {
                        $('#schedule_id').val('');
                        var id = event.id;
                        $('#schedule_id').val(id);
                        $('.event-modal').modal('show');
                        // $.ajax({
                        //     type: "POST",
                        //     url: "{{ route('front.employees.store-schedule') }}",
                        //     data: {
                        //         id: event.id,
                        //         type: 'delete'
                        //     },
                        //     success: function(response) {

                        //         // calendar.fullCalendar('removeEvents', event.id);
                        //         // displayMessage("Event removed");
                        //     }
                        // });
                    }
                });
            });

            function displayMessage(message) {
                toastr.success(message, 'Event');
            }
        </script>
    @endsection
