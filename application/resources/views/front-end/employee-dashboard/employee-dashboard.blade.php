@extends('front-end.layouts.master')

@section('front-end-content')
<div class="auto-container">
        @if (session()->has('success'))
        <div class="alert alert-success mt-2" role="alert">
           {{ session('success') }}
          </div>
        @endif
        <div class="row clearfix my-3 justify-content-center">
            <h3 class="m-3">All Bookings</h3>
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Service</th>
                            <th>Schedule Time</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Service Address</th>
                            <th>Street No</th>
                            <th>Building No</th>
                            <th>Unit No</th>
                            <th>Status</th>
                            <th>Change Status</th>
                        </thead>
                        <tbody>
                            @forelse ($user_schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->id }}</td>
                                    <td>{{ $schedule->full_name ?? 'not found' }}</td>
                                    <td>{{ $schedule->service->title ?? 'not found' }}</td>
                                    <td>{{ $schedule->userSchedule->start ?? 'not found' }} -
                                        {{ date('H:i', strtotime($schedule->userSchedule->start_time)) }}</td>
                                    <td>{{ $schedule->email ?? 'not found' }}</td>
                                    <td>{{ $schedule->phone ?? 'not found' }}</td>
                                    <td>{{ $schedule->service_address ?? 'not found' }}</td>
                                    <td>{{ $schedule->street_no ?? 'not found' }}</td>
                                    <td>{{ $schedule->bldg_no ?? 'not found' }}</td>
                                    <td>{{ $schedule->unit_no ?? 'not found' }}</td>
                                    <td> <span
                                            class="badge {{ $schedule->status == 'pending' ? 'badge-primary' : 'badge-success' }}"
                                            style="font-size: 14px">{{ $schedule->status ?? 'not found' }}</span></td>
                                    <td>
                                        <a href="#" class="change-status" data-id="{{ $schedule->id }}">
                                            <i class="fa fa-edit fa-2x"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <strong style="font-size:20px;">
                                            No Data Found
                                        </strong>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade status-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('front.booking.status.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="pending">Pending</option>
                                    <option value="collected">Collected</option>
                                </select>
                                <input type="hidden" id="status-id" name="id">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

@section('scripts')
    <script>
        $('body').on('click', '.change-status', function() {
            let row = $(this).closest('tr');
            let status_id = row.find('.change-status').data('id');
            $('#status-id').val(status_id);
            $('.status-modal').modal('show');
        });
    </script>
@endsection
