@extends('layouts.admin')

@push('styles')
<!-- DataTables -->
  <link rel="stylesheet" href="{!! asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}">

@endpush
@section('title', 'Visitors- ')
@push('scripts')

<!-- DataTables -->
<script src="{!! asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>

 <script>
   $(document).ready( function () {
    $('#example1').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ url($admin_url.'visitors_list') }}",
           columns: [
                    { data: 'page', name: 'page' },
                  
                      { data: 'ip', name: 'ip' },
                    { data: 'created_at', name: 'created_at' },
                     { data: 'user', name: 'user' },
                      { data: 'device', name: 'device' }
                 ],
                 order: [[2, 'desc']]
        });
     });
  </script>
@endpush

@section('content')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <!-- Main content --><br>
    <section class="content">
      <div class="container-fluid">
          <div class="row"><hr>
          <div class="col-12">
          

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Visitors</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                   <thead>
                  <tr>
                <th>Url</th>
                
                <th>IP</th>
                <th>Time</th>
                <th>User</th>
                <th>Device</th>
                  </tr>
               </thead>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
 </div>

@endsection