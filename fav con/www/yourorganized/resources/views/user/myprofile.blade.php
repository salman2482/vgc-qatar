@extends('layouts.main')
@push('styles')
  <!-- Select2 -->
 <link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2/css/select2.min.css') !!}">
 <link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
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
    
    @if($errors->all()) $('#AddAssociation').modal('show');  @endif

  })
</script>

@endpush
@section('title', $user->firstname.' '.$user->lastname.'- View Profile - ')
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
          @include('user.include.myprofilesidebar')
          <!-- /.col -->
          
          
          <div class="col-md-9">
            <div class="card">
              
                
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Edit Profile</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
       <form method="post" action="{{url()->current()}}"> <!-- /.card-header -->
    @csrf
 
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>First Name</label>
                  <input required type="text" name='firstname' value="{{$user->firstname}}"  class="form-control" style="width: 100%;">
                  
                </div>
              
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Last Name</label>
              <input required type="text" name='lastname' value="{{$user->lastname}}"  class="form-control" style="width: 100%;">
                </div>
                
              </div>
              <!-- /.col -->
            </div>
          
            
            <div class="row">
              <div class="col-md-6">
               
                <!-- /.form-group -->
              <div class="form-group">
                  <label>Default Sports</label>
                  <select required name='sports' class="form-control select2bs4" style="width: 100%;">
                       <optgroup  label="Sports">
                   <option @if($user->sports=="Basketball")selected @endif value="Basketball">Basketball</option>
                   <option @if($user->sports=="Soccer")selected @endif value="Soccer">Soccer</option>                  
                   <option @if($user->sports=="Volleyball")selected @endif value="Volleyball">Volleyball</option>
                       </optgroup>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
                
                
                <div class="col-md-6">
              
                <!-- /.form-group -->
              <div class="form-group">
                  <label>Country</label>
                  <select required name='country' class="form-control select2bs4" style="width: 100%;">
                       <optgroup  label="Country">
                      @include('misc.country')
             <option selected value="{{$user->country}}" >{{$user->country}}</option>
                       </optgroup>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
                
                
                
               
          </div>
          <!-- /.card-body -->
             <button class="btn btn-success bt-sm" type="submit">Update</button>
        </div>
        <!-- /.card -->
            </form>    
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
        
        @include('user.include.add_association_modal')
        
        
        <div class="modal" id="Change-password">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h3 class="modal-title">Change Password</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="form-change-password" role="form" method="POST" action="{{ url('/user/credentials') }}" >
          <div class="col-md-12">             
            <label for="current_password" class="col-sm-4 control-label">Current Password</label>
            <div class="col-sm-8">
              <div class="form-group">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Password" required>
              </div>
            </div>
            <label for="password" class="col-sm-4 control-label">New Password</label>
            <div class="col-sm-8">
              <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
              </div>
            </div>
            <label for="password_confirmation" class="col-sm-4 control-label">Re-enter Password</label>
            <div class="col-sm-8">
              <div class="form-group">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-5 col-sm-6">
              <button type="submit" class="btn btn-danger">Submit</button>
            </div>
          </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
         
      </div>

    </div>
  </div>
</div> 
  <!-- /.content-wrapper -->
@endsection