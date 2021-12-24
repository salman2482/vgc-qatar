@extends('layouts.main')
@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/fontawesome-free/css/all.min.css') !!}">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/daterangepicker/daterangepicker.css') !!}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') !!}">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/sketchpad/sketchpad.css') !!}">
<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') !!}">
<!-- Theme style -->
<link rel="stylesheet" href="{!! asset('assets/dist/css/adminlte.min.css') !!}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style>
    .main-sidebar .fas{
    color: #fff;
    }
    [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-treeview {
    background: #fff; 
    color:#000
    }
    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link {
    color: #6c757d;
    }
    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link:hover {
    color: #6c757d;
    }
    [class*=sidebar-dark-] .sidebar a {
    color: #fff;
    font-size: 16px;
    font-weight: 400;
    }
    .input-group .plantitle{
    width: 303px;
    height: 35px;
    border: 1px solid #bfd0e0;
    background-color: #fff;
    font-size: 19px;
    border-radius: 3px;
    }
    .navbar-light .form-control-navbar:focus, .navbar-light .form-control-navbar:focus+.input-group-append .btn-navbar {
    background-color: #fff;
    border: 1px solid #bfd0e0;
    background-color: #fff;
    font-size: 19px;
    border-radius: 3px;
    }
    .bdicon{
    border-left: 1px solid #d8d8d8;
    border-right: 1px solid #d8d8d8;
    }
    @media (min-width: 768px){
    body:not(.sidebar-mini-md) .content-wrapper, body:not(.sidebar-mini-md) .main-footer, body:not(.sidebar-mini-md) .main-header {
    margin-right: 250px;
    }
    }
    .ml-15 {
    margin-left: 15rem!important;
    }
    aside {
    top: 10px!important;
    }
</style>
@endpush
@push('scripts')
<!-- Select2 -->
<script src="{!! asset('assets/admin/plugins/select2/js/select2.full.min.js') !!}"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js" ></script>
<!-- Select2 -->
<script src="{!! asset('assets/admin/plugins/select2/js/select2.full.min.js') !!}"></script>
<!-- Bootstrap 4 -->
<script src="{!! asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- Summernote -->
<script src="{!! asset('assets/admin/plugins/summernote/summernote-bs4.min.js') !!}"></script>sss
<!--athira-->
<!-- jQuery -->
<!-- <script src="{!! asset('assets/admin/plugins/jquery/jquery.min.js') !!}"></script> -->
<!-- Bootstrap 4 -->
<script src="{!! asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- Select2 -->
<script src="{!! asset('assets/admin/plugins/select2/js/select2.full.min.js') !!}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{!! asset('assets/admin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') !!}"></script>
<!-- InputMask -->
<script src="{!! asset('assets/admin/plugins/moment/moment.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/inputmask/min/jquery.inputmask.bundle.min.js') !!}"></script>
<!-- date-range-picker -->
<script src="{!! asset('assets/admin/plugins/daterangepicker/daterangepicker.js') !!}"></script>
<!-- bootstrap color picker -->
<script src="{!! asset('assets/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') !!}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{!! asset('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') !!}"></script>
<!-- Bootstrap Switch -->
<script src="{!! asset('assets/admin/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}"></script>
<script src="{!! asset('assets/admin/dist/js/adminlte.min.js') !!}"></script>
<script src="{!! asset('assets/admin/dist/js/demo.js') !!}"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 -->
<!-- Page script -->
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()
    
      
    
    })
</script>
<script>
i = 1; // yoi can assign unique name to each textbox using this i
$( document ).ready(function() {

  $("#add").click(function() {
     $("#quicknote").append('<div id="quick'+i+'" class="row"><div class="col-sm-6"> <label>Quick Note</label> <div class="form-group"> <input type="text" name="quicknote['+i+']" class="form-control" id="" placeholder="Quick Note">  </div></div> <div class="col-sm-4"> <label>Mins</label> <div class="form-group"> <select name="quicknotemin['+i+']" class="form-control select2bs4" style="width: 100%;">   @for($i=1;$i<=60;$i++)  <option value="{{$i}}">{{$i}}</option> @endfor </select></div> </div>  <div class="col-sm-2">  <label style="color: beige"> +</label> <div class="form-group"><button type="button" id="delete'+i+'" onclick="remove(quick'+i+')"  class="btn btn-danger btn-sm">x</button></div> </div> </div>');
     i++;

  })
  
   $("#add_plan").click(function() {
     $("#add_new_plan").append('<div id="new_plan" class="modal-body">  <label>New Name</label>  <input required name="new_name" type="text" class="form-control" id="" placeholder="Plan New Name">  </div>');
     

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


 function remove2(el) {
     
 
  var element = el;
  element.remove();
  
        }



  $(".remove-note").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
 
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('plan/note/delete') }}',
                    method: "POST",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        
                        document.getElementById(ele.attr("data-id")).remove();
                         //ele.remove();
        //alert('success'); // window.location.reload();
                    }
                });
            }
        });
        
        
     

</script>

<script>
function sync()
{
  var n1 = document.getElementById('name_temp');
  var n2 = document.getElementById('name');
  n2.value = n1.value;
  
  var n1 = document.getElementById('plan_time_temp');
  var n2 = document.getElementById('plan_time');
  n2.value = n1.value;
}
 sync();
 
 
 
 function planformsubmit() {
     
   $("#plan_form").submit()

}
</script>
@endpush
@section('title', $user->firstname.' '.$user->lastname.'- Plans - ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<nav class="navbar navbar-expand navbar-white navbar-light" style="background-color:#f1f1f1;padding:0;position: relative;top:80px;">
    <!-- Left navbar links -->
    <!-- SEARCH FORM -->
    <div class="form-inline ml-15 mr-3">
        <div class="input-group input-group-sm">
            <input onkeyup="sync(this)" placeholder="Plan Title" class="form-control form-control-navbar plantitle" type="text" id="name_temp" value="{{$plan->name}}" >
            <div class="input-group-append">
            </div>
        </div>
    </div>
    <div class="form-group form-inline mt-3 ml-3 mr-3">
        <div class="input-group">
            <label> 0 Mins &nbsp;&nbsp;&nbsp;</label>
            <input value="{{date("Y-m-d",strtotime($plan->plan_time))}}"  onchange="sync(this)" value="" id="plan_time_temp" type="date" class="form-control float-right" >
        </div>
        <!-- /.input group -->
    </div>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-10">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item bdicon">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-layer-group"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="plan_form" onclick="document.getElementById('plan_submit_button').click()" href="#" title="Save">
            <i class="fas fa-save"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="add_plan" title="Save As" data-toggle="modal" data-target="#save_as" href="#">
            <i class="fas fa-copy"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-print"></i>
            </a>
        </li>
        <li class="nav-item bdicon">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-share"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-folder-open nav-icon"></i>
            </a>
        </li>
        <li class="nav-item bdicon">
            <a class="nav-link" data-toggle="modal" data-target="#plan_delete" href="#">
            <i class="far fa-trash-alt"></i>
            </a>
        </li>
        <li class="nav-item bdicon">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-edit"></i>
            </a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4 toolbox-container" style="margin-top: 140px;background-color: #fff;overflow: visible;">
    <div class="open-close-button"><span class="tool-box-plans tool-box-close tool-close">&lt</span></div>
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="background-color: #1969a5;padding-top: 5px;padding-bottom: 5px;">
    <span class="brand-text font-weight-light" style="color: #fff"><i class="fas fa-sync" style="font-size: 15px;"></i> PLANS</span>
    </a>
    @include('user.plans_sidebar')
</aside>
<!-- /.content-wrapper -->
<div class="content-wrapper ml-250 mr-250 open-left" style="background-color: #fff;position: relative;top:90px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card">
              
                  
        <div class="card card-default">
        
          <form id="plan_form" method="post" action="{{url()->current()}}">          <!-- /.card-header -->
              @csrf
              
          <div class="card-body">
           <div class="row">
       
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
            
                
                <div class="card-body">
                    <div class="tab-content">
                        <div class="timeline-body">
                            
                            
                          
                            
                            <div class="row d-none">
                           
                             <input id="name"  class="form-control " type="text" placeholder="Plan Name" name="name">
                         
                            
                           
                              <input id="plan_time" name="plan_time"  type="date" class="form-control " >
                              
                             
                            
                              </div>
                              
                            <br>
                              @php $i=1000; @endphp
                            @foreach($quicknotes as $quicknote)
                          @php $i++; @endphp
                          <div id="{{$quicknote->id}}" class="row">
                                    <div id="" class="col-md-12">
                                        
            
                                            
                                        
                                         <div class="row">
                                                <div class="col-sm-6">
                                            <!-- Select multiple-->
                                            <label>Quick Note</label>
                                                    <div class="form-group">
            
                                                        <input disabled value='{{$quicknote->notes}}' name="" type="text" class="form-control" id="" placeholder="Quick Note">
                                                    </div>
            
                                                </div>
                                                <div class="col-sm-4">
            
                                                   <label>Mins</label>
                                                    <div class="form-group">
            
                                                        <select disabled name="" class="form-control select2bs4" style="width: 100%;">
                                                    @for($i=1;$i<=60;$i++)<!-- comment -->
       
                                                    <option @if($quicknote->mins==$i)selected @endif value="{{$i}}">{{$i}}</option>

                                                    @endfor
                                                    </select>
                                                   
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label style="color: beige"> +</label>
                                                    <div class="form-group">
                                                        <button type="button" data-id="{{$quicknote->id}}"  class="btn btn-danger btn-sm remove-note"><i class="fa fa-trash"></i></button>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        
                                       
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
            
                                </div>
                            
                            
                            @endforeach
                                <div class="row">
                                    <div id="quicknote" class="col-md-12">
                                        
            
                                            
                                        
                                         <div class="row">
                                                <div class="col-sm-6">
                                            <!-- Select multiple-->
                                            <label>Quick Note</label>
                                                    <div class="form-group">
            
                                                        <input name="quicknote[0]" type="text" class="form-control" id="" placeholder="Quick Note">
                                                    </div>
            
                                                </div>
                                                <div class="col-sm-4">
            
                                                   <label>Mins</label>
                                                    <div class="form-group">
            
                                                        <select name="quicknotemin[0]" class="form-control select2bs4" style="width: 100%;">
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
              
                                                
                                               <?php
                                           foreach($tags as $tag)
                                            {
                                             $variableAry=explode(", ",$plan->tags); //you have array now
                                        foreach($variableAry as $var)
                                        {
                                            if($tag->name==$var){
                                                $check='selected';
                                                break;
                                            }
                                            else {  $check="";}
                                        }

                          ?>    
                                            <option <?php echo $check;?> value="<?php echo $tag->name;?>"><?php echo $tag->name;?></option>
                                            <?php } ?>

                                                 </optgroup>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
            
            
                                         <label>Age Group</label>
                                         <?php  $variableAry=explode(", ",$plan->age_group);?>
                                        <div class="form-group">
            
                                       <select required name="age_group[]" class="form-control select2bs4" multiple data-placeholder="Select Age Group" style="width: 100%;">
                                        <option <?php if (in_array("8U & Under", $variableAry)) echo 'selected' ; ?> >8U & Under</option>
                                        <option <?php if (in_array("9U to 12U", $variableAry)) echo 'selected' ; ?>>9U to 12U</option>
                                        <option <?php if (in_array("13U & Above", $variableAry)) echo 'selected' ; ?>>13U & Above</option>
            
                                        </select>
                                        </div>
                                        <!-- /.form-group -->
            
            
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                             
                            <div class="row d-none">
                            <nav class="navbar navbar-expand navbar-white navbar-light" style="background-color:#f1f1f1;padding:0">
                                <ul class="navbar-nav ml-10">
                                <!-- Messages Dropdown Menu -->
                                
                                     <li class="nav-item">
                                         <button title="Save"  class="nav-link" type="submit" id="plan_submit_button"  alt="save">
                                   <i class="fa fa-save"></i>
                                   
                                  </button>
                                    
                                </li>
                                     <li class="nav-item">
                                         <button id="add_plan" title="Save As" type="button" data-toggle="modal" data-target="#save_as" class="nav-link" >
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
                                     
                                     <li class="nav-item bdicon">
                                  <button class="nav-link" title="Save As" type="button" data-toggle="modal" data-target="#plan_delete">
                                       <i class="far fa-trash-alt"></i>
                                  </button>
                                    
                                </li>
                                     
                                </ul>
                                </nav>
                                    
                                </div>
                             
                                
            
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
<aside class="main-sidebar sidebar-dark-primary elevation-4 drill-sidebar" style="margin-top: 140px;background-color: #fff; right:0;overflow:visible;">
     <div class="open-close-button-drills"><span class="drill-box-close tool-close">&gt</span></div>
    <!-- Brand Logo -->
    <a href="#" class="brand-link" style="background-color: #1969a5;padding-top: 5px;padding-bottom: 5px">
    <span class="brand-text font-weight-light" style="color: #fff"><i class="fas fa-sync" style="font-size: 15px;"></i> DRILLS</span>
    </a>
     @include('user.drills_sidebar')
</aside>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<div style="padding-top:100px" class="modal fade" id="plan_delete" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{$plan->name}}</h5>
        <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         <!-- Modal body -->
      <div class="modal-body">
       Are you sure you want to delete this Plan? 
      </div>
         <form method="post" action="{{url('delete/plan')}}">
             <input type="hidden" value="{{$plan->id}}" name="plan_id">
             @csrf
      <div class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button data-id="{{$plan->id}}" type="submit" class="btn btn-danger ">Yes</button>
      </div>
         </form>
    </div>
  </div>
</div> 



<div style="padding-top:100px"  class="modal fade" id="save_as" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Save As New Plan</h5>
        <button onclick="remove2(new_plan)" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div id="add_new_plan">
     
            
        </div>
      <div class="modal-footer">
        <button onclick="remove2(new_plan)" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button onclick="document.getElementById('plan_submit_button').click()" id="" type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div> 
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('click', '.tool-box-plans', function() {
    $('.toolbox-container').addClass("toolbox_close_plans");
    $('.open-close-button').empty();
    $('.open-left').removeClass('ml-250');
    $('.mr-25').css('display','none');
    $('.open-close-button').append('<span class="tool-box-open  plan-close open-close-button edit-open">PLANS</span>');
});
$(document).on('click', '.tool-box-open', function() {
    $('.toolbox-container').removeClass("toolbox_close_plans");
    $('.open-close-button').empty();
    $('.open-left').addClass('ml-250');
    $('.open-close-button').append('<span class="tool-box-plans tool-box-close  open-close-button">&lt;</span>');
});
$(document).on('click', '.drill-box-close', function() {
    $('.drill-sidebar').addClass("drill-box-closed");
    $('.open-close-button-drills').empty();
    $('.open-left').removeClass('mr-250');
    $('.open-left').addClass('mr-0');
    $('.open-close-button-drills').append('<span class="drill-box-open">DRILLS</span>');
});
$(document).on('click', '.drill-box-closed', function() {
    $('.drill-sidebar').removeClass("drill-box-closed");
    $('.open-left').addClass('mr-250');
    $('.open-left').removeClass('mr-0');
    $('.open-close-button-drills').empty();
    $('.open-close-button-drills').append('<span class="drill-box-close">&gt;</span>');
});
</script>
<style type="text/css">
    .toolbox_close_plans {
    transform: translateX(-250px);
    transition: transform .35s cubic-bezier(.39,.575,.565,1);
}
.tool-box-plans {
    right: -29px;
}
.plan-close  {
    right: -58px!important;
    width: 80px!important;
    top: 20px!important;
    transition: transform .35s cubic-bezier(.39,.575,.565,1);
}
.tool-box-open {
    transition: transform .35s cubic-bezier(.39,.575,.565,1);
}
.open-left {

}
.ml-250 {
    margin-left: 250px!important;
}
.mr-250 {
    margin-right: 250px!important;
}
.open-left {
    padding: 0px 30px;
}
.mr-0 {
    margin-right: 0px!important;
}
body {
    overflow-x: hidden;
}
</style>
<!--date and time-->

@endsection