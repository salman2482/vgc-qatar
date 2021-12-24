@extends('layouts.admin')

@push('styles')
<!-- DataTables -->
  <link rel="stylesheet" href="{!! asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}">
 
@endpush
@section('title', 'Manage FAQ - ')
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
           ajax: "{{ url($admin_url.'faq_categrory_list') }}",
           columns: [
                    
                    { data: 'title', name: 'title' },
                    
                    { data: 'count', name: 'count' }
                      
                 ],
                
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
                <h3 class="card-title">FAQ Categories</h3>
              </div>
                
                
                    <div class="card-header">
                        <form method="post" action="{{url()->current()}}" enctype="multipart/form-data">
                    @csrf
                <div class="input-group " style="max-width: 400px">
                    
                        <input type="text" class="form-control" placeholder="Add FAQ Category" name="title" required >
                    <span class="input-group-btn">
                        <button name="" type="submit" class="btn btn-success">Add</button>
                    
                    </span>
              </div>
                    </form>
            </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x:auto;">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th style="width:4px">Questions</th>
                  
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