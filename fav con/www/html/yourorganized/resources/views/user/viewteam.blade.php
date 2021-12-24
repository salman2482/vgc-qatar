@extends('layouts.main')
@push('styles')
  <!-- Select2 -->
 <link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2/css/select2.min.css') !!}">
 <link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
 <!-- DataTables -->
  <link rel="stylesheet" href="{!! asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}">
@endpush

@push('scripts')


<!-- Select2 -->
<script src="{!! asset('assets/admin/plugins/select2/js/select2.full.min.js') !!}"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
  
  
  
  function productStyles(selection) {
  if (!selection.id) { return selection.text; }
    var thumb = $(selection.element).data('thumb');
    if(!thumb){
      return selection.text;
    } else {
      var $selection = $(
    '<img src="' + thumb + '" alt=""><span class="img-changer-text">' + $(selection.element).text() + '</span>'
  );
  return $selection;
  }
}
</script>




<!-- DataTables -->
<script src="{!! asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>

<script>
   $(document).ready( function () {
    $('#coaches').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ url('my_coaches_list/'.$team->id) }}",
           columns: [
                    
                    { data: 'firstname', name: 'firstname' },
                      { data: 'email', name: 'email' },
                      
                       { data: 'id', name: 'id' }
                      
                    
                      
                 ],
                 
        });
     });
  </script>
@endpush
@section('title','Team - '.$team->name.' - '.$user->firstname.' '.$user->lastname.' - ')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">{{$user->firstname}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          @include('user.teams_sidebar')
          <div class="col-md-9">
            <div class="card">
              
                  
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{'Team - '.$team->name}}</h3>           
          </div>
          
            
            
      
      <div class="col-lg-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="invite-tab" data-toggle="pill" href="#invite" role="tab" aria-controls="invite" aria-selected="true">Invite</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="info-tab" data-toggle="pill" href="#info" role="tab" aria-controls="info" aria-selected="false">Info</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="payment-tab" data-toggle="pill" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Pay Your Coaches</a>
                  </li>
                 
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="invite" role="tabpanel" aria-labelledby="invite-tab">
                       <form method="post" action="{{url('addToTeam')}}">
                         <div class="card">
                     <label>Add Coaches</label>  
                     <select required name="coach_id[]" class="form-control select2bs4" multiple  data-placeholder="Select Coaches" style="width: 100%;">
             <optgroup label="Coaches">
                
                 
       @foreach($coaches as $coach)

       <option value="{{$coach->id}}" style="background-color: red">{{$coach->firstname.' '.$coach->lastname}} ({{$coach->email}})</option>
       @endforeach
       
      
             </optgroup>                      
                                        </select>
                     
                     
                     
                         </div>
                           <button type="submit" class="btn btn-success">Add</button>     
                            @csrf
                            <input type="hidden" name="team_id" value="{{$team->id}}">
     
         </form>
                      <hr>
                 <div class="card">
              <div class="card-header">
                <h3 class="card-title">{!!'Team - <b>'.$team->name.'</b> - Members'!!}</h3>
              </div>     
                     
                     
                     
                       <div class="card-body">
                <table id="coaches" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                     <th>Email</th>
                     
                      <th></th>
                    
                  </tr>
                  </thead>
                  
                </table>
              </div>
          
                 </div>
          
                  </div>
                  <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                       <div class="card-header">
                        <h3 class="card-title">{{'Team - '.$team->name}}</h3>           
                       </div>
                  </div>
                  <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                      
                      <div class="card-header">
                          <button class="btn btn-primary">Pay</button>          
                       </div>
                 
                  </div>
                  
                </div>
              </div>
      </div>
      </div>
      
      
            
            
            
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection