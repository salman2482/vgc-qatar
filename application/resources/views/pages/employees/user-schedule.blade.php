@extends('layout.wrapper')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endsection

@section('content')
 <!-- main content -->
 <div class="container-fluid">
    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--contacts table-->
            <div id='full_calendar_events'></div>
            <!--contacts table-->
        </div>
    </div>
    <!--page content -->
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {

            var SITEURL = "{{ url('/') }}";
            var user_id = {{ $id }};

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#full_calendar_events').fullCalendar({
                editable: true,
                editable: true,
                displayEventTime: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaDay,agendaWeek'
                },
                events: "{{ route('employees.add-schedule') }}"+'/'+user_id,
                displayEventTime: true,
                eventRender: function(event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function(event_start, event_end, allDay) {
                    var event_name = prompt('Event Name:');
                    if (event_name) {
                        var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                        var event_end = $.fullCalendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");
                        var event_start_time = moment(event_start).format('HH:mm:ss');
                        var event_end_time = moment(event_end).format('HH:mm:ss');
                        $.ajax({
                            url: "{{ route('employees.store-schedule') }}",
                            data: {
                                user_id: {{ $id }},
                                event_name: event_name,
                                event_start: event_start,
                                event_end: event_end,
                                event_start_time: event_start_time,
                                event_end_time: event_end_time,
                                type: 'create'
                            },
                            type: "POST",
                            success: function(data) {
                                displayMessage("Event created.");

                                calendar.fullCalendar('renderEvent', {
                                    id: data.id,
                                    title: title,
                                    start: event_start,
                                    end: event_end,
                                    allDay: allDay
                                }, true);
                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                },
                eventDrop: function(event, delta, allDay) {
                    var event_start = moment(event.start).format('Y-MM-DD HH:mm:ss');
                    var event_end = moment(event.end).format('Y-MM-DD HH:mm:ss');

                    var event_start_time = moment(event_start).format('HH:mm:ss');
                    var event_end_time = event.end_time;

                    $.ajax({
                        url: "{{ route('employees.store-schedule') }}",
                        data: {
                            user_id: {{ $id }},
                            title: event.title,
                            start: event_start,
                            end: event_end,
                            id: event.id,
                            event_start_time: event_start_time,
                            event_end_time: event_end_time,
                            type: 'edit'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Event updated");
                            calendar.fullCalendar('renderEvent', {
                                id: data.id,
                                title: title,
                                start: event_start,
                                end: event_end,
                                allDay: allDay
                            }, true);
                            calendar.fullCalendar('unselect');
                        }
                    });
                },
                eventResize: function(event, event_start, event_end, allDay) {
                    // console.log(event);
                    // return false;
                    var event_start = moment(event.start).format('Y-MM-DD HH:mm:ss');
                    var event_end = moment(event.end).format('Y-MM-DD HH:mm:ss');

                    var event_start_time = moment(event_start).format('HH:mm:ss');
                    var event_end_time = moment(event_end).format('HH:mm:ss');


                    $.ajax({
                        url: "{{ route('employees.store-schedule') }}",
                        data: {
                            user_id: {{ $id }},
                            title: event.title,
                            start: event_start,
                            end: event_end,
                            id: event.id,
                            event_start_time: event_start_time,
                            event_end_time: event_end_time,
                            type: 'edit'
                        },
                        type: "POST",
                        success: function(response) {
                            displayMessage("Event updated");
                            calendar.fullCalendar('renderEvent', {
                                id: data.id,
                                title: title,
                                start: event_start,
                                end: event_end,
                                allDay: allDay
                            }, true);
                            calendar.fullCalendar('unselect');
                        }
                    });
                },
                eventClick: function(event) {
                    var eventDelete = confirm("Are you sure?");
                    if (eventDelete) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('employees.store-schedule') }}",
                            data: {
                                id: event.id,
                                type: 'delete'
                            },
                            success: function(response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("Event removed");
                            }
                        });
                    }
                }
            });
        });

        function displayMessage(message) {
            toastr.success(message, 'Event');
        }
    </script>
@endsection