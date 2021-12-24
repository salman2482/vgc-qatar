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

@section('title', $user->firstname.' '.$user->lastname.'- Plans - ')
@section('content')
<!-- Content Wrapper. Contains page content -->
<nav class="navbar navbar-expand navbar-white navbar-light plans-subheader" style="background-color:#f1f1f1;padding:0;position: relative;top:80px;">
    <!-- Left navbar links -->
    <!-- SEARCH FORM -->
    <div class="form-inline ml-15 mr-3">
        <div class="input-group input-group-sm">
            <input onkeyup="sync(this)" placeholder="Plan Title" class="form-control form-control-navbar plantitle" type="text" id="name_temp" value="{{$plan->name}}">
            <div class="input-group-append">
            </div>
        </div>
    </div>
    <div class="form-group form-inline mt-3 ml-3 mr-3">
        <div class="input-group">
            <label class="minslabel"> 0 Mins &nbsp;&nbsp;&nbsp;</label>
            <input onchange="sync(this)" value="{{date("Y-m-d",strtotime($plan->plan_time))}}" id="plan_time_temp" type="date" class="form-control float-right" >
        </div>
        <!-- /.input group -->
    </div>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-10">
        <!-- Messages Dropdown Menu -->
        <!-- <li class="nav-item bdicon">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-layer-group"></i>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" id="plan_form" onclick="document.getElementById('plan_submit_button').click()" href="javascript:" title="Save">
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
            <a class="nav-link" data-toggle="modal" data-target="#newDrill">
            <i class="fas fa-edit"></i>
            </a>
        </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4 toolbox-container" style="margin-top: 140px;background-color: #fff;overflow: visible;">
    <div class="open-close-button"><span class="tool-box-plans tool-box-close tool-close">&lt</span></div>
    <!-- Brand Logo -->
    <a href="#" class="brand-link hover-green" style="background-color: #000;padding-top: 5px;padding-bottom: 5px;">
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
                        <form id="plan_form" method="post" action="{{url()->current()}}">
                            <!-- /.card-header -->
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
                                                                    
                                                                 @foreach($quicknotes as $quicknote)
                                                                  <li id="{{$quicknote->id}}" class="ui-state-default plan-drill-item"><div class="plan-drill-item-inner"> <span class="c-spn-handles"><i class="fa fa-bars" aria-hidden="true"></i></span><input style="width:60px" value="{{$quicknote->mins}}" type="number" min="1" class="form-control c-txt-drill-timing drill_count"  onchange="findtotalmins()"><input type="hidden" value="" name="" ><h4>{{$quicknote->notes}}</h4><div class="plan-drill-actions"><p class="c-spn-remove-drill"><span data-api-delete="{{ route('deletePlanNote', $quicknote->id) }}" class="fas fa-times"></span></p></div></div></li>
                                                                 @endforeach   
                                                                 
                                                                @foreach($quickdrills as $quickdrill)
                                                                <li id="{{$quickdrill->id}}" class="ui-state-default plan-drill-item"><div class="plan-drill-item-inner"> <span class="c-spn-handles"><i class="fa fa-bars" aria-hidden="true"></i></span><input style="width:60px" type="number" class="form-control c-txt-drill-timing drill_count" value="{{$quickdrill->mins}}" min="1" name="" onchange="findtotalmins()"><input type="hidden" value="" name="" ><h4>{{$dname=App\Models\Drill::where('id',$quickdrill->drill_id)->value('name')}}</h4>
                                                                        <div class="plan-drill-actions"><p  data-drill-id="{{ $quickdrill->drill_id }}" data-drill-name="{{ $dname}}"  data-drill-mins="{{ $quickdrill->mins}}" data-route="{{ route('drill.preview', $quickdrill->drill_id) }}" class="plan-toggle drill-sketchpad" title="Expand / Collapse"><span class="fas fa-chevron-down"></span></p><p  class="c-spn-remove-drill"><span data-api-delete="{{ route('deletePlanDrill', $quickdrill->id) }}" class="fas fa-times"></span></p></div></div><div class="c-div-drill hide-me"><div class="plan-drill-meta-container"><div><a class="read-more-description"><span class="fas fa-chevron-down"></span>&nbsp;Description</a><div class="plan-drill-content description-none">{!!App\Models\Drill::where('id',$quickdrill->drill_id)->value('description')!!}</div></div></div></li>
                                                                 @endforeach 
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
                                                                                @for($i=1;$i<=60;$i++)
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
                                                        <div class="row d-none">
                                                            <input  type="text" required name="mins" class="minshidden">
                                                      
                                                        <!-- /.row -->
                                                        <div class="row">
                                                            <!-- Right navbar links -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                </div>
                                                <!-- tab content -->
                                            </div>
                                            <!-- card body -->
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
        </div>
        <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 drill-sidebar" style="margin-top: 140px;background-color: #fff; right:0;overflow:visible;">
    <div class="open-close-button-drills"><span class="drill-box-close tool-close">&gt</span></div>
    <!-- Brand Logo -->
    <a  href="#" class="brand-link hover-green" style="background-color: #000;padding-top: 5px;padding-bottom: 5px">
    <span class="brand-text font-weight-light" style="color: #fff"><i class="fas fa-sync" style="font-size: 15px;"></i> DRILLS</span>
    </a>
    @include('user.drills_sidebar')
</aside>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<div  style="padding-top: 150px" class="modal fade" id="plandelete" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="plandelete">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are you sure you want to Delete ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger plandeletepopupyes" onclick="notedelete();">Yes</button>
      </div>
    </div>
  </div>
</div>
@include('user.include.add_team_modal')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('click', '.tool-box-plans', function() {
    $('.toolbox-container').addClass("toolbox_close_plans");
    $('.open-close-button').empty();
    $('.open-left').removeClass('ml-250');
    $('.mr-25').css('display','none');
    $('.open-close-button').append('<span class="tool-box-open  plan-close open-close-button edit-open" style="background-color:#000;">PLANS</span>');
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
    var note_delete_url_this;
    var note_delete_url;
    $(document).on('click','.c-spn-remove-drill .fa-times', function(e) {
        if ( $( this ).hasClass( "note-static" ) ) {
            $(this).parent().parent().parent().parent().remove();
            findtotalmins();
        }
        else {
            $("#plandelete").modal('show'); 
            note_delete_url_this = this;
            note_delete_url = $(this).attr("data-api-delete");
        }
    });
    function notedelete() {
        $.ajax({
            type: "GET",  
            url: note_delete_url, 
            success: function(res){
                if(res=="success") {
                    $(note_delete_url_this).parent().parent().parent().parent().remove();
                    findtotalmins();
                    note_delete_url_this = ''; 
                    note_delete_url = '';
                    $("#plandelete").modal('hide');
                    findtotalmins();
                }
                else {
                    note_delete_url_this = ''; 
                    note_delete_url = '';
                    $("#plandelete").modal('hide');
                    findtotalmins();
                    alert("Error");
                } 
            },
            error: function() {
                findtotalmins();
                note_delete_url_this = ''; 
                note_delete_url = '';
                $("#plandelete").modal('hide');
                alert("Error");
            }       
        });
    }
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
    $('.plan-sub a').click(function(e){
        var drill_url = $(this).attr("data-route");
        var drill_name = $(this).attr("data-drill-name");
        var drill_mins = $(this).attr("data-drill-mins");
        $.ajax({
            url: drill_url, 
            success: function(result){
            console.log(result);
            var sketchpad_data = result.sketchpad_data;
            var description = result.description;
            var qmins = result.mins;
            var drill_name = result.name;
            var selectedground = result.surface;
            var description = result.description;
            var drill_id = result.id;
            var i = 0;
            var timestamp =  $.now();
            $("#sortable").append('<li id="quick'+i+'" class="ui-state-default plan-drill-item"><div class="plan-drill-item-inner"> <span class="c-spn-handles"><i class="fa fa-bars" aria-hidden="true"></i></span><input style="width:60px" type="number" class="form-control c-txt-drill-timing drill_count" value="'+qmins+'" min="1" name="dmins['+i+']" onchange="findtotalmins()"><input type="hidden" value="'+drill_id+'" name="drill_id['+i+']" ><h4>'+drill_name+'</h4><div class="plan-drill-actions"><p class="plan-toggle" title="Expand / Collapse"><span class="fas fa-chevron-down"></span></p><p class="c-spn-remove-drill"><span class="fas fa-times note-static"></span></p></div></div><div class="c-div-drill hide-me"><div class="'+timestamp+'"></div><div class="plan-drill-meta-container"><div><a class="read-more-description"><span class="fas fa-chevron-down"></span>&nbsp;Description</a><div class="plan-drill-content description-none">'+description+'</div></div></div></li>');
                i++;
                findtotalmins();
                var court_details =  {
                "basketball_court_one" : [
                    { "width":700,"Height":400 }
                ],
                "basketball_court_two" : [
                    { "width":701,"Height":830 }
                ],
                "basketball_court_three" : [
                    { "width":401,"Height":321 }
                ],
                "basketball_court_four" : [
                    { "width":400,"Height":689 }
                ],
                "hockeycourt_one" : [
                    { "width":327,"Height":329 }
                ],
                "hockeycourt_two" : [
                    { "width":700,"Height":400 }
                ],
                "hockeycourt_three" : [
                    { "width":329,"Height":327 }
                ],
                "hockeycourt_four" : [
                    { "width":654,"Height":327 }
                ],
            }
            var court_width = court_details[selectedground][0].width;
            var court_Height = court_details[selectedground][0].Height;
            if(selectedground == "hockeycourt_one") {
                selectedground = "hockeycourt_one_old";
            }
            if(selectedground == "hockeycourt_two") {
                selectedground = "hockeycourt_two_old";
            }
            if(selectedground == "hockeycourt_three") {
                selectedground = "hockeycourt_three_old";
            }
            if(selectedground == "hockeycourt_four") {
                selectedground = "hockeycourt_four_old";
            }
           // $('.ground').css('width',court_width);
                stage = Konva.Node.create(sketchpad_data, '.'+timestamp);
                var undogroundlayer = new Konva.Layer();
                Konva.Image.fromURL('{!! asset("assets/sketchpad/img/'+selectedground+'.svg'") !!}, (imageNode) => {
                undogroundlayer.add(imageNode);
                imageNode.setAttrs({
                    width: court_width,
                    height: court_Height,
                });
                undogroundlayer.batchDraw();
                stage.add(undogroundlayer);
                undogroundlayer.zIndex(0);
            });
        }});
    })
    $(document).on("click",'.read-more-description',function(e) {
        $(this).next().toggleClass('description-none')
    })
    $(document).ready(function(){
        setTimeout(function(){
            $('.drill-sketchpad').each(function(){
                console.log($(this).attr('data-route'));
                var drill_url = $(this).attr("data-route");
                var drill_name = $(this).attr("data-drill-name");
                var timestamp = Date.now();
                //$('.c-div-drill.hide-me').find('.'+drill_name).remove();
                $(this).parent().parent().next().prepend("<div class="+timestamp+"></div>");
                $.ajax({
                    url: drill_url, 
                    success: function(result){
                    console.log(result);
                    var sketchpad_data = result.sketchpad_data;
                    var selectedground = result.surface;
                        var court_details =  {
                        "basketball_court_one" : [
                            { "width":700,"Height":400 }
                        ],
                        "basketball_court_two" : [
                            { "width":701,"Height":830 }
                        ],
                        "basketball_court_three" : [
                            { "width":401,"Height":321 }
                        ],
                        "basketball_court_four" : [
                            { "width":400,"Height":689 }
                        ],
                        "hockeycourt_one" : [
                            { "width":327,"Height":329 }
                        ],
                        "hockeycourt_two" : [
                            { "width":700,"Height":400 }
                        ],
                        "hockeycourt_three" : [
                            { "width":329,"Height":327 }
                        ],
                        "hockeycourt_four" : [
                            { "width":654,"Height":327 }
                        ],
                    }
                    var court_width = court_details[selectedground][0].width;
                    var court_Height = court_details[selectedground][0].Height;
                    if(selectedground == "hockeycourt_one") {
                        selectedground = "hockeycourt_one_old";
                    }
                    if(selectedground == "hockeycourt_two") {
                        selectedground = "hockeycourt_two_old";
                    }
                    if(selectedground == "hockeycourt_three") {
                        selectedground = "hockeycourt_three_old";
                    }
                    if(selectedground == "hockeycourt_four") {
                         selectedground = "hockeycourt_four_old";
                    }
                   // $('.ground').css('width',court_width);
                        stage = Konva.Node.create(sketchpad_data, '.'+timestamp);
                        var undogroundlayer = new Konva.Layer();
                        Konva.Image.fromURL('{!! asset("assets/sketchpad/img/'+selectedground+'.svg'") !!}, (imageNode) => {
                        undogroundlayer.add(imageNode);
                        imageNode.setAttrs({
                            width: court_width,
                            height: court_Height,
                        });
                        undogroundlayer.batchDraw();
                        stage.add(undogroundlayer);
                        undogroundlayer.zIndex(0);
                    });
                }});
            });
        }, 2000);
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
  /*  background-color: red;*/
    margin-top: 12px;
    display: none;
    }
    .minslabel {
    margin-right: 20px;
    }
    .konvajs-content {
        margin: 0 auto;
    }
    .plans-subheader {
        top: 80px!important;
        position: fixed!important;
        z-index: 9999;
        width: 100%;
        background-color: #eee;
        padding-top: 0px!important;
        padding-bottom: 0px!important;
    }
    .read-more-description {
        color: #434343!important;
        cursor: pointer;
        font-size: 15px;
    }
    .read-more-description span {
        color: #434343;
        cursor: pointer;
    }
    .plan-drill-content {
        color: #434343;
        font-size: 14px;
        margin-left: 14px;
    }
    .description-none {
        display: none;
    }
    .new_drill_header {
        position: fixed;
    }
    .p-fixed {
        position: fixed;
    }
</style>
<div  style="padding-top: 150px" class="modal fade" id="newDrill" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Plan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are you sure you want to Delete this Plan and create new ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="window.location.href='{{url('plans')}}'" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>
@endsection





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
<script src="https://unpkg.com/konva@7.2.2/konva.min.js"></script>
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
    var total= 0;
      $("#add").click(function() {
      		var quicknote = $("#quicknote_dummy").val();
      		quicknote = quicknote.trim();
      		if(quicknote.length === 0) {
      			alert("Enter Name For Quick Drill");
      		}
      		else {
            	var qmins=+document.getElementById('quicknotemin_dummy').value;
                total+=qmins;
                qnote=document.getElementById('quicknote_dummy').value;
              	 $("#sortable").append('<li id="quick'+i+'" class="ui-state-default plan-drill-item"><div class="plan-drill-item-inner"> <span class="c-spn-handles"><i class="fa fa-bars" aria-hidden="true"></i></span><input style="width:60px" type="number" min="1" class="form-control c-txt-drill-timing drill_count" value="'+qmins+'" name="qmins['+i+']" onchange="findtotalmins()"><input type="hidden" value="'+qnote+'" name="qnote['+i+']" ><h4>'+qnote+'</h4><div class="plan-drill-actions"><p class="c-spn-remove-drill"><span class="fas fa-times note-static"></span></p></div></div></li>');
            	i++;
    			findtotalmins();
                $("#quicknote_dummy").val('');
    		}
      	})
    });
</script>
<script>
    function findtotalmins() {
    	var totalminscount = 0;
    	$(".c-txt-drill-timing").each(function(){
           	totalminscount += +$(this).val();
       	});
       	$('.minslabel').empty();
            $('.minshidden').val(totalminscount);
            $('.minslabel').text(totalminscount+ ' Mins  ');
    }
    
    findtotalmins();
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