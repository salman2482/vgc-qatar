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

  })
</script>

<script>
i = 1; // yoi can assign unique name to each textbox using this i
$( document ).ready(function() {

  $("#add").click(function() {
     $("#quicknote").appendchild('<div id="quick'+i+'" class="row"><div class="col-sm-6"> <label>Quick Note</label> <div class="form-group"> <input type="text" name="quicknote'+i+'" class="form-control" id="" placeholder="Quick Note">  </div></div> <div class="col-sm-4"> <label>Mins</label> <div class="form-group"> <select name="quicknotemin'+i+'" class="form-control select2bs4" style="width: 100%;">   @for($i=1;$i<=60;$i++)  <option value="{{$i}}">{{$i}}</option> @endfor </select></div> </div>  <div class="col-sm-2">  <label style="color: beige"> +</label> <div class="form-group"><button type="button" id="delete'+i+'" onclick="remove(quick'+i+')"  class="btn btn-danger btn-sm">x</button></div> </div> </div>');
     i++;

  })
  
  
 
});
</script>


<script>


  
 function remove(el) {
     
    var r=confirm("Are you Sure");
  if (r==true)
  {
  var element = el;
  element.remove();
  
        }
}

</script>
@endpush
@section('title', $user->firstname.' '.$user->lastname.'- Plans - ')
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
          <div class="col-md-3">

            <!-- Profile Image -->
          

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Plans</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
         
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <p>
                    PERSONAL
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview bgwhite">
                    <li class="nav-item">
                        <a href="account/index.html" class="nav-link">
                        <i class="far fa-folder-open nav-icon"></i>
                        <p>Plan 1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="account/index2.html" class="nav-link">
                        <i class="far fa-folder-open nav-icon"></i>
                        <p>Plan 2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="account/index3.html" class="nav-link">
                        <i class="far fa-folder-open nav-icon"></i>
                        <p>Plan 3</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="account/index3.html" class="nav-link">
                        <i class="far fa-trash-alt"></i>
                        <p> Trash</p>
                        <i class="far fa-trash-alt" style="float: right;margin-top: 5px;"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <p>
                TEAM
                <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview bgwhite">
              
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <p>
                ASSOCIATION
                <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview bgwhite">
                
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                
                <p>
                MARKET PLACE
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                    <ul class="nav nav-treeview bgwhite">
                    <li class="nav-item">
                        <a href="account/index.html" class="nav-link">
                        <i class="far fa-folder-open nav-icon"></i>
                        <p>Recent</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="account/index2.html" class="nav-link">
                        <i class="far fa-folder-open nav-icon"></i>
                    <p>Untagged</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="account/index3.html" class="nav-link">
                    <i class="far fa-folder-open nav-icon"></i>
                    <p>Defence</p>
                    </a>
                </li>
                    <li class="nav-item">
                    <a href="account/index3.html" class="nav-link">
                    <i class="far fa-folder-open nav-icon"></i>
                    <p> News Letter</p>
                
                    </a>
                </li>
                </ul>
            </li>
            
            
               <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              
              <p>
                SHARED
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bgwhite">
              <li>
                </li>
            </ul>
          </li>
            
            
            
            
        </ul>
               
               

               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              
                  
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Plan</h3>

           
          </div>
          <form method="post" action="{{url()->current()}}">          <!-- /.card-header -->
              @csrf
          <div class="card-body">
           <div class="row">
       
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
            
                
                <div class="card-body">
                    <div class="tab-content">
                        <div class="timeline-body">
                            
                             <label> Plan Name</label>
                             <input required class="form-control " type="text" placeholder="Plan Name" name="name">
                            <br>
                            
                              <label>Date</label>
                              <input name="plan_time" required type="date" class="form-control " >
                            
                              
                            <br>
                                <div class="row">
                                    <div id="quicknote" class="col-md-12">
                                        
            
                                            
                                        
                                         <div class="row">
                                                <div class="col-sm-6">
                                            <!-- Select multiple-->
                                            <label>Quick Note</label>
                                                    <div class="form-group">
            
                                                        <input name="quicknote0" type="text" class="form-control" id="" placeholder="Quick Note">
                                                    </div>
            
                                                </div>
                                                <div class="col-sm-4">
            
                                                   <label>Mins</label>
                                                    <div class="form-group">
            
                                                        <select name="quicknotemin0" class="form-control select2bs4" style="width: 100%;">
                                                    @for($i=1;$i<=60;$i++)<!-- comment -->
       
                                                    <option value="{{$i}}">{{$i}}</option>

                                                    @endfor
                                                    </select>
                                                   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label style="color: beige"> +</label>
                                                    <div class="form-group">
                                                        <button type="button" id="add"  class="btn btn-primary btn-sm">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                       
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
            
                                </div>
                                <!-- /.row -->
                                <div class="row">

                                    <!-- /.col -->
                                    <div class="col-md-12">
                                         <label>Tags</label>
                                        <div class="form-group">
            
                                            <select name="tags[]" class="form-control select2bs4" multiple data-placeholder="Select Tags" style="width: 100%;">
                                             <optgroup  label="Tags">
              
                                                @foreach($tags as $tag)<!-- comment -->

                                                <option value="{{$tag->name}}">{{$tag->name}}</option>

                                                @endforeach

                                                 </optgroup>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
            
            
                                         <label>Age Group</label>
                                        <div class="form-group">
            
                                            <select name="age_group[]" class="form-control select2bs4" multiple data-placeholder="Select Age Group" style="width: 100%;">
                                        <option>8U & Under</option>
                                        <option>9U to 12U</option>
                                        <option>13U & Above</option>
            
                                        </select>
                                        </div>
                                        <!-- /.form-group -->
            
            
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                                <div class="row">
                                    <!-- Right navbar links -->
                          
                            <nav class="navbar navbar-expand navbar-white navbar-light" style="background-color:#f1f1f1;padding:0">
                                <ul class="navbar-nav ml-10">
                                <!-- Messages Dropdown Menu -->
                                
                                     <li class="nav-item">
                                  <button class="nav-link" type="submit"  alt="save">
                                   <i class="fa fa-save"></i>
                                   
                                  </button>
                                    
                                </li>
                                     <li class="nav-item">
                                  <button class="nav-link" data-toggle="dropdown" href="#">
                                    <i class="fa fa-copy"></i>
                                   
                                  </button>
                                    
                                </li>
                                     <li class="nav-item">
                                  <button class="nav-link" data-toggle="dropdown" href="#">
                                  <i class="fas fa-print"></i>
                                   
                                  </button>
                                    
                                </li>
                                     <li class="nav-item bdicon">
                                  <button class="nav-link" data-toggle="dropdown" href="#">
                                   <i class="fas fa-share"></i>
                                   
                                  </button>
                                    
                                </li>
                                     <li class="nav-item">
                                  <button class="nav-link" data-toggle="dropdown" href="#">
                                   <i class="far fa-folder-open nav-icon"></i>
                                   
                                  </button>
                                    
                                </li>
                                     <li class="nav-item bdicon">
                                  <button class="nav-link" data-toggle="dropdown" href="#">
                                       <i class="far fa-trash-alt"></i>
                                  </button>
                                    
                                </li>
                                     <li class="nav-item bdicon">
                                  <button class="nav-link" data-toggle="dropdown" href="#">
                                   <i class="fas fa-edit"></i>
                                  </button>
                                    
                                </li>
                                </ul>
                                </nav>
                                </div><!-- /.row -->
                                
            
                         </div>
                            
                </div> <!-- tab content -->
            </div><!-- card body -->

            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
           
        </div>
        <!-- /.card -->
            </form>    
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