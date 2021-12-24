@extends('layouts.admin')
@section('title', 'Manage Tags')
@push('styles')

<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}">

@endpush

@push('scripts')

<!-- DataTables -->
<script src="{!! asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>

<script>
    $(document).ready( function () {
     $('#drills').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url($admin_url.'view_drilltags') }}",
            columns: [
                     
                     { data: 'name', name: 'name' },
                     { data: 'id', name: 'id' }
                       
                  ],
                 order: [[0, 'asc']]
         });
     
    
     $('#plans').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url($admin_url.'view_plantags') }}",
            columns: [
                     
                     { data: 'name', name: 'name' },
                     { data: 'id', name: 'id' }
                       
                  ],
                 order: [[0, 'asc']]
         });
      });
   </script>
@endpush
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content --><br>
    <section class="content">
      <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Manage Drill Tag</h3>
                            </div>
                            <form method="post" action="{{url($admin_url.'tags/drill')}}">          <!-- /.card-header -->
                                <input type="hidden" value="drill" name="tag">
                                @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Drill Tag</label>
                                    <input required class="form-control " type="text" placeholder="Drill Tag" name="name">
                                </div>
                                <div class="form-group">
                                    <button data-id="drill" type="submit"  class="btn btn-primary">Add</button>
                                </div>
                            </div>
                            </form> <!-- /.form -->
                        </div><!-- /.card -->
                    </div> <!-- /.card -->
                </div><!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Drill Tags</h3>
                            </div>
                            <div class="card-body">
                                <table id="drills" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>         
                                </table>
                            </div>
                        </div><!-- /.card -->
                    </div> <!-- /.card -->          
                </div><!-- /.col -->

                <div class="col-md-12">
                    <div class="card">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Manage Plan Tag</h3>
                            </div>
                            <form method="post" action="{{url($admin_url.'tags/plan')}}">          <!-- /.card-header -->
                                <input type="hidden" value="plan" name="tag">
                                @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label> Plan Tag</label>
                                    <input required class="form-control " type="text" placeholder="Plan Tag" name="name">
                                </div>
                                <div class="form-group">
                                    <button data-id="plan" type="submit"  class="btn btn-primary">Add</button>
                                </div>
                            </div>
                            </form> <!-- /.form -->
                        </div><!-- /.card -->
                    </div> <!-- /.card -->
                </div><!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Plan Tags</h3>
                            </div>
                            <div class="card-body">
                                <table id="plans" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>         
                                </table>
                            </div>
                        </div><!-- /.card -->
                    </div> <!-- /.card -->
                </div><!-- /.col -->
            </div>
            <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
 </div>

@endsection
