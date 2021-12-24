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
 <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<!-- Page script -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
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
	i = 0; // you can assign unique name to each textbox using this i
	$( document ).ready(function() {
	var total=0;
	  $("#add").click(function() {
              
              var qmins=+document.getElementById('quicknotemin_dummy').value;
              total+=qmins;
      
             
              $('.minslabel').empty();
               $('.minslabel').text(total+ ' Mins  ');
              
          $("#sortable").append('<li id="quick'+i+'" class="ui-state-default plan-drill-item"><div class="plan-drill-item-inner"> <span class="c-spn-handles"><i class="fa fa-bars" aria-hidden="true"></i></span><input style="width:60px" type="number" class="form-control c-txt-drill-timing drill_count" value="'+qmins+'"><h4>'+document.getElementById('quicknote_dummy').value+'</h4><div class="plan-drill-actions"><p class="c-spn-remove-drill"><span class="fas fa-times"></span></p></div></div></li>');
		 
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
			<input onkeyup="sync(this)" placeholder="Plan Title" class="form-control form-control-navbar plantitle" type="text" id="name_temp" value="">
			<div class="input-group-append">
			</div>
		</div>
	</div>
	<div class="form-group form-inline mt-3 ml-3 mr-3">
		<div class="input-group">
                    <label class="minslabel"> 0 Mins &nbsp;&nbsp;&nbsp;</label>
			<input onchange="sync(this)" value="" id="plan_time_temp" type="date" class="form-control float-right" >
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
			<a class="nav-link" data-toggle="dropdown" href="#">
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
			<a class="nav-link" data-toggle="dropdown" href="#">
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
							  
							  <button id="plan_submit_button" class="nav-link" type="submit"  alt="save"></button>
							
							  </div>
								<div class="row">
									<div class="col-md-12">
										<div class="c-div-expand-collapse">
											<a id="c-a-expand-all">EXPAND</a> | 
                							<a id="c-a-collapse-all">COLLAPSE</a>
										</div>
										<ul id="sortable">											
									@php /*<li class="ui-state-default plan-drill-item">
												<div class="plan-drill-item-inner">
													<span class="c-spn-handles">
														<i class="fa fa-bars" aria-hidden="true"></i>
													</span>
													<input type="text" class="form-control c-txt-drill-timing drill_count" value="3">
													<h4>qwed</h4>
													<div class="plan-drill-actions">
														<p class="plan-toggle" title="Expand / Collapse">
															<span class="fas fa-chevron-down"></span>
														</p>
														<p class="c-spn-remove-drill">
															<span class="fas fa-times"></span>
														</p>
													</div>
												</div>
												<div class="c-div-drill hide-me">
												</div>
											</li> */ @endphp                                                                      
                                                                                </ul>
									</div>
								</div>
								<div class="row">
									<div id="quicknote" class="col-md-12">
										 <div class="row">
												<div class="col-sm-6">
											<!-- Select multiple-->
											<label>Quick Note</label>
													<div class="form-group">
			
                                                                                                            <input  id="quicknote_dummy" name="quicknote_dummy" type="text" class="form-control" id="" placeholder="Quick Note">
													</div>
			
												</div>
												<div class="col-sm-4">
			
												   <label>Mins</label>
													<div class="form-group">
			
                                                                                                            <select id="quicknotemin_dummy" name="quicknotemin_dummy" class="form-control select2bs4" style="width: 100%;">
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
			
											<select required name="age_group[]" class="form-control select2bs4" multiple data-placeholder="Select Age Group" style="width: 100%;">
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
<aside class="main-sidebar sidebar-dark-primary elevation-4 drill-sidebar" style="margin-top: 140px;background-color: #fff; right:0;overflow:visible;">
	 <div class="open-close-button-drills"><span class="drill-box-close tool-close">&gt</span></div>
	<!-- Brand Logo -->
	<a  href="#" class="brand-link" style="background-color: #1969a5;padding-top: 5px;padding-bottom: 5px">
	<span class="brand-text font-weight-light" style="color: #fff"><i class="fas fa-sync" style="font-size: 15px;"></i> DRILLS</span>
	</a>
	 @include('user.drills_sidebar')
</aside>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>

@include('user.include.add_team_modal')
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
$(document).on('click','.plan-toggle .fa-chevron-down', function(e){
	$(this).parent().parent().parent().parent().find('.c-div-drill').css('display','block');
	//$(this).parent().empty();
	$(this).parent().append('<span class="fas fa-chevron-up"></span>');
	$(this).remove();
});
$(document).on('click','.plan-toggle .fa-chevron-up', function(e) {
	$(this).parent().parent().parent().parent().find('.c-div-drill').css('display','none');
	//$(this).parent().empty();
	$(this).parent().append('<span class="fas fa-chevron-down"></span>');
	$(this).remove();
});
$(document).on('click','.c-spn-remove-drill .fa-times', function(e) {
	$(this).parent().parent().parent().parent().remove();
});
$('#c-a-expand-all').click(function(){
	$('.c-div-drill').css('display','block');
	$('.plan-toggle').empty();
	$('.plan-toggle').append('<span class="fas fa-chevron-up"></span>');
})
$('#c-a-collapse-all').click(function(){
	$('.c-div-drill').css('display','none');
	$('.plan-toggle').empty();
	$('.plan-toggle').append('<span class="fas fa-chevron-down"></span>');
})
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
<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; }
  #sortable li { margin: 0px; padding: 0px; padding:0px;margin-bottom: 10px; font-size: 1.4em; /*height: 18px;*/ }
  #sortable li span { /*position: absolute;*//* margin-left: -1.3em;*/ }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
	$( "#sortable" ).sortable();
	$( "#sortable" ).disableSelection();
  } );
  </script>
  <style>
	.plan-drill-item {
		list-style: none;
		font-weight: 700;
		color: #fff;
		width: 100%;
		padding: 0;
		margin-bottom: 1px
	}
	.plan-drill-item-inner {
		background: #434343;
		border: 1px solid #000;
		display: flex;
		align-items: center;
		padding: .25rem .5rem;
	}
	.c-spn-handles {
		cursor: move;
		font-size: 12px;
		margin-right: .5rem;
	}
	.c-txt-drill-timing {
		display: inline-block;
		margin-top: 0;
		margin-right: .5rem;
		margin-left: 0;
		height: 25px;
		width: 35px;
		padding: 0 7px;
		font-size: 14px;
		line-height: 1.42857143;
		color: #ccc;
		background-color: #555;
		background-image: none;
		border: 1px solid #333;
		text-align: center;
	}
	.plan-drill-item-inner h4 {
    	color: #fff;
    	margin: 0;
    	padding: 7px;
    	font-size: 15px;
    	font-weight: 700;
    	flex-grow: 1;
	}
	/*.c-spn-handles {
		display: flex;
	}*/
	.plan-drill-actions {
    	display: flex;
    	align-items: center;
	}
	.plan-toggle {
		cursor: pointer;
    	padding: 0;
    	background: #555;
    	color: #fff;
    	font-size: 1rem;
    	margin: 0 0 0 .5rem;
    	border: 1px solid #333;
    	border-radius: 14px;
    	height: 28px;
    	width: 28px;
    	display: inline-flex;
    	align-items: center;
    	justify-content: center;
	}
	.c-spn-remove-drill {
		cursor: pointer;
    	padding: 0;
    	background: #555;
    	color: #fff;
    	font-size: 1rem;
    	margin: 0 0 0 .5rem;
    	border: 1px solid #333;
    	border-radius: 14px;
    	height: 28px;
    	width: 28px;
    	display: inline-flex;
    	align-items: center;
    	justify-content: center;
	}
	.c-div-expand-collapse {
		font-size: 12px;
    	margin-bottom: 14px;
    	text-align: center;
    	color: #434343;
	}
	.c-div-expand-collapse a:not([href]) {
    	color: #1969a5;
   		font-weight: 700;
    	font-size: 16px;
    	cursor: pointer;
	}
	.c-div-drill {
		min-height: 20px;
    	background-color: red;
    	margin-top: 12px;
    	display: none;
	}
  </style>
@endsection