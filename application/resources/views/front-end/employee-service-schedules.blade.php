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
                <div class="modal-body">
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
                                        <input type="checkbox" class="form-contorl mt-1" id="conditions"
                                           value="0">
                                        <span class="ml-1" style="font-size: 15px;font-weight:bold">Employee Terms And
                                            Conditions</span>
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

                    }else
                    {
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
