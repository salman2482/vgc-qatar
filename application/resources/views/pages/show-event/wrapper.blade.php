@extends('layout.wrapper') @section('content')
    <!-- main content -->
    <div class="container-fluid">

        <!-- page content -->
        <div class="jumbotron text-center">
            <h1>All Activities</h1>
            <div class="row ">
                <div class="col-md-10 mt-5">
                    <form method="post">
                        @csrf
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-12 col-lg-3  control-label col-form-label">Start Date</label>
                            <div class="col-sm-12 col-lg-4">
                                <input type="text" class="form-control form-control-sm pickadate" id="from_date"
                                    name="from_date" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <label class="col-sm-12 col-lg-3  control-label col-form-label">End Date</label>
                            <div class="col-sm-12 col-lg-4">
                                <input type="text" class="form-control form-control-sm pickadate" id="to_date"
                                    name="to_date" autocomplete="off">
                                <button type="button" value="Filter" id="filter"
                                    class="btn btn-rounded-x btn-danger waves-effect text-left mt-2">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
                <div class="row" id="event_wrapper">
                    <!--rfms table-->
                    @include('pages.show-event.table.wrapper')
                    <!--rfms table-->
                </div>
                <div id="pagination">
                {{ $events->links() }}
            </div>
        <!--page content -->

    </div>
    <!--main content -->
@endsection


@section('scripts')
    <script>
        $('#filter').on('click', function(e) {
            e.preventDefault();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '')
            {
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.ajax({
            url:"/filter-events",
            method:"POST",
            data:
            {
                from_date:from_date,
                to_date:to_date,
            },
            success:function(data)
            {
                if (data.length > 0) {
                    $('#event_wrapper').html('');
                    $('#event_wrapper').html(data);
                }else{
                    $('#event_wrapper').html('');
                    $('#pagination').hide();
                }
            }
            });
            }
            else
            {
                alert('Both Date are required');
            }
        });
    </script>
@endsection
