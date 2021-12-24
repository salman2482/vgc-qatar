@extends('layouts.main') @push('styles')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
<!-- Bootstrap Editor -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/summernote/summernote-bs4.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/sketchpad/soccer.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/sketchpad/volleyball.css') !!}">
<!-- Theme style -->
<link rel="stylesheet" href="{!! asset('assets/dist/css/adminlte.min.css') !!}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="{!! asset('assets/sketchpad/sketchpad.css') !!}">
@endpush
@push('scripts')
<!-- Select2 -->
<script src="{!! asset('assets/admin/plugins/select2/js/select2.full.min.js') !!}"></script>
<!-- Summernote -->
<script src="{!! asset('assets/admin/plugins/summernote/summernote-bs4.min.js') !!}"></script>
<script src="https://unpkg.com/konva@7.2.2/konva.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js" ></script>
<script src="{!! asset('assets/sketchpad/sketchpad.js') !!}"></script>
<!-- Bootstrap Switch -->
<script src="{!! asset('assets/admin/dist/js/adminlte.min.js') !!}"></script>
<!-- Page script -->
 @if($errors->all()) <script type="text/javascript">  $('#error_modal').modal('show');</script> @endif
<script>
    $(function () {
      $('.select2').select2()
          $('.select2bs4').select2({
            theme: 'bootstrap4'
      })
      
       $('.textarea').summernote()
    })
</script>

@endpush  
@section('title', $user->firstname.' '.$user->lastname.' - Drills - ') 
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-85 mr-0 bg-white">
    <!-- Content Header (Page header) -->
    <section class="content-header drill-option-header">
        <nav class="navbar navbar-expand navbar-white navbar-light" style="background-color:#f1f1f1;padding:0">
            <!-- Left navbar links -->
            <!-- SEARCH FORM -->
            <div class="form-inline ml-15 mr-3">
                <div class="input-group input-group-sm">
                    <input  value="{{old('name')}}" class="form-control form-control-navbar plantitle" type="text" placeholder="Drill Name" >
                    <div class="input-group-append">
                    </div>
                </div>
            </div>
            <div class="form-group form-inline mt-3 ml-3 mr-3">
                <div class="select-mins mr-10">
                    <select data-placeholder="Mins" class="select2 minchange" name="state" onchange="selectmins();">
                     
                        <option hidden selected disabled>Mins</option>
                        @for($i=1;$i<=60;$i++)
                        <option @if(old('mins')==$i) selected @endif value="{{$i}}">{{$i}}</option>                        
                        @endfor
                        
                        
                    </select>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn btn-secondary dropdown-toggle " data-toggle="dropdown">
                    Surface
                    </button>
                    @php /*
                    <div class="dropdown-menu  dropdown-menu-right">
                        <a id="1" class="dropdown-item sports-selection" href="#"><img src="https://coachthem.com/img/rinkimages/lacrosse/thumb_lacrose_field_mens_white_light_paint.png"></a>
                        <div class="dropdown-divider"></div>
                        <a id="2" class="dropdown-item sports-selection" href="#"><img src="https://coachthem.com/img/rinkimages/lacrosse/thumb_lacrose_box_field.png"></a>
                    </div>
                    
                    */ @endphp
                </div>
            </div>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-10">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item bdicon">
                    <a class="nav-link" data-toggle="dropdown" href="#" title="TURN OFF LAYERS">
                    <i class="fas fa-layer-group"></i>
                    </a>
                </li>
                <li class="nav-item drill-save">
                    <a class="nav-link drill-save" data-toggle="dropdown" href="#" alt="save" title="SAVE">
                    <i class="fas fa-save"></i>
                    </a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" data-toggle="dropdown" href="#" title="PRINT"  onclick="window.print();">
                    <i class="fas fa-print"></i>
                    </a>
                </li>
              
               
                <li class="nav-item bdicon">
                    <a class="nav-link"  href="#" title="NEW DRILL" data-toggle="modal" data-target="#newDrill">
                    <i class="fas fa-edit"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.container-fluid -->
    </section>
    <!-- Tools&sketchpad  -->
    <section class="content mt-75">
        <div class="container-fluid">
            <div class="open-left pl-140 pr-300">
              
                <div class="option-header d-flex">
                    
                    <div class="dropdown color-picker mr-25">
                        <button class="btn  dropdown-toggle color-indicator" type="button" data-toggle="dropdown" style="width:32px;">
                        <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu p-0" style="min-width: 20px;">
                            <li id="black" style="background-color: black"></li>
                            <li id="green" style="background-color: green"></li>
                            <li id="red" style="background-color: red"></li>
                            <li id="purple" style="background-color: purple"></li>
                            <li id="orange" style="background-color: orange"></li>
                            <li id="blue" style="background-color: blue"></li>
                        </ul>
                    </div>
                    <div class="fontcontainer mr-25">
                        <select class="font-selection select2" onchange="selectfontsize();">
                            <option value="15">15px</option>
                            <option value="20">20px</option>
                            <option value="25">25px</option>
                            <option value="30">30px</option>
                        </select>
                    </div>
                    <div class="text-alignment">
                        <img data-align="left" src="{!! asset('assets/sketchpad/img/align-cell-content-left.png') !!}">
                        <img data-align="center" src="{!! asset('assets/sketchpad/img/align-cell-content-center.png') !!}">
                        <img data-align="right" src="{!! asset('assets/sketchpad/img/align-cell-content-right.png') !!}">
                    </div>
                    <ul class="attacklist pg mr-25">
                        <li id="attack" data-attacktype="PG" class="attacklistselection">PG</li>
                        <li id="attack" data-attacktype="PG1" class="attacklistselection">PG1</li>
                        <li id="attack" data-attacktype="PG2" class="attacklistselection">PG2</li>
                        <li id="attack" data-attacktype="PG3" class="attacklistselection">PG3</li>
                        <li id="attack" data-attacktype="PG4" class="attacklistselection">PG4</li>
                        <li id="attack" data-attacktype="PG5" class="attacklistselection">PG5</li>
                    </ul>
                    <ul class="attacklist sg mr-25">
                        <li id="attack" data-attacktype="SG" class="attacklistselection">SG</li>
                        <li id="attack" data-attacktype="SG1" class="attacklistselection">SG1</li>
                        <li id="attack" data-attacktype="SG2" class="attacklistselection">SG2</li>
                        <li id="attack" data-attacktype="SG3" class="attacklistselection">SG3</li>
                        <li id="attack" data-attacktype="SG4" class="attacklistselection">SG4</li>
                        <li id="attack" data-attacktype="SG5" class="attacklistselection">SG5</li>
                    </ul>
                    <ul class="attacklist pf mr-25">
                        <li id="attack" data-attacktype="PF" class="attacklistselection">PF</li>
                        <li id="attack" data-attacktype="PF1" class="attacklistselection">PF1</li>
                        <li id="attack" data-attacktype="PF2" class="attacklistselection">PF2</li>
                        <li id="attack" data-attacktype="PF3" class="attacklistselection">PF3</li>
                        <li id="attack" data-attacktype="PF4" class="attacklistselection">PF4</li>
                        <li id="attack" data-attacktype="PF5" class="attacklistselection">PF5</li>
                    </ul>
                    <ul class="attacklist sf mr-25">
                        <li id="attack" data-attacktype="SF" class="attacklistselection">SF</li>
                        <li id="attack" data-attacktype="SF1" class="attacklistselection">SF1</li>
                        <li id="attack" data-attacktype="SF2" class="attacklistselection">SF2</li>
                        <li id="attack" data-attacktype="SF3" class="attacklistselection">SF3</li>
                        <li id="attack" data-attacktype="SF4" class="attacklistselection">SF4</li>
                        <li id="attack" data-attacktype="SF5" class="attacklistselection">SF5</li>
                    </ul>
                    <ul class="attacklist c mr-25">
                        <li id="attack" data-attacktype="C" class="attacklistselection">C</li>
                        <li id="attack" data-attacktype="C1" class="attacklistselection">C1</li>
                        <li id="attack" data-attacktype="C2" class="attacklistselection">C2</li>
                        <li id="attack" data-attacktype="C3" class="attacklistselection">C3</li>
                        <li id="attack" data-attacktype="C4" class="attacklistselection">C4</li>
                        <li id="attack" data-attacktype="C5" class="attacklistselection">C5</li>
                    </ul>
                    <div id="myDropdown" class="lines-option mr-25"></div>
                    <div id="arrowoption" class="mr-25"></div>
                </div>
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <div>
                                    <div class="containe">
                                        <div class="containe basketball-toolbox  toolbox Basketball toolbox-container toolbox_open_close_transition">
                                            <div class="">
                                                <div class="open-close-button"><span class="tool-box-close tool-close">&lt</span></div>
                                                <div class="top">
                                                    <h1 class="hover-green"> TOOLS</h1>
                                                </div>
                                                <div class="tool-selection-container">
                                                    <div class="column">
                                                        <div class="top">
                                                            <ul>
                                                                <li id="Select" title="Select" class="select tool"><i class="fa fa-paper-plane"></i></li>
                                                                <li id="delete" title="Easer" class="eraser tool"><img id="delete" src="{!! asset('assets/sketchpad/img/erase.svg') !!}"></li>
                                                                <li id="Freelinewitharrow" title="Freeline" class="freeline tool"><img id="freeline" src="{!! asset('assets/sketchpad/img/curve.svg') !!}" width="30" height="30"></li>
                                                                <li id="arrow" title="Straightline" class="straightline tool"><i id="streightline" class="fa fa-minus"></i></li>
                                                                <li id="undo" title="Undo" class="undo tool"><i id="undo" class="fa fa-undo"></i></li>
                                                                <li id="redo" title=Redo class="redo tool"><i id="redo" class="fa fa-repeat"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="middle">
                                                        <ul>
                                                            <li id="attack" title="Point Guard" class="PG tool" data-attacktype="PG">PG</li>
                                                            <li id="attack" title="Shooting Guard" class="SG tool" data-attacktype="SG">SG</li>
                                                            <li id="attack" title="Power Forward" class="PF tool" data-attacktype="PF">PF</li>
                                                            <li id="attack" title="Small Forward" class="SF tool" data-attacktype="SF">SF</li>
                                                            <li id="attack" title="Center" class="C tool" data-attacktype="C">C</li>
                                                            <li id="icon" title="Coach" data-attacktype="copyright" class="coach tool" data-attacktype="@"><i class="fa fa-copyright"></i></li>
                                                            <li id="Dtext" title="Text" class="abc tool">abc</li>
                                                            <li id="icon" title="Camera" data-attacktype="camera" class="camera tool"><img id="icon" data-attacktype="camera" src="{!! asset('assets/sketchpad/img/camera.svg') !!}" width="25" height="25"></li>
                                                        </ul>
                                                    </div>
                                                    <div class="bottom">
                                                        <ul>
                                                            <li id="icon" title="Hoop" data-attacktype="hoop" class="hoop tool"> <img id="icon" data-attacktype="hoop" src="{!! asset('assets/sketchpad/img/hoop.svg') !!}" width="25" height="25"></li>
                                                            <li id="icon" title="4 ball track" data-attacktype="4_ball_track" class="balls tool"> <img id="icon" data-attacktype="4_ball_track" src="{!! asset('assets/sketchpad/img/4ballrack.svg') !!}" width="25" height="25"></li>
                                                            <li id="icon" title="Cone" data-attacktype="cone" class="cone tool"> <img id="icon" data-attacktype="cone"  src="{!! asset('assets/sketchpad/img/cone.svg') !!}" width="30" height="30"></li>
                                                            <li id="icon" title="B ball" data-attacktype="v_ball" class="ball tool"> <img id="icon" data-attacktype="v_ball" src="{!! asset('assets/sketchpad/img/btball.svg') !!}" width="30" height="30"></li>
                                                            <li class="triangle tool" title="Triangle" id="triangle"><i id="triangle" class="fa fa-caret-up"></i></li>
                                                            <li id="icon" title="x" data-attacktype="close_x" class="X tool"> <i id="icon" data-attacktype="close_x" class="fa fa-times" aria-hidden="true"></i></li>
                                                            <li class="square tool" title="Square" id="rect"><i  id="rect" class="fa fa-square-o"></i></li>
                                                            <li class="circle tool" title="Circle" id="circ"><i id="circ" class="fa fa-circle-o" aria-hidden="true"></i></li>
                                                            <!-- <li class="d-man tool"> D-Man Board</li> -->
                                                            <!--<li id="save">save</li>-->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--VOLLEY BALL TOOL-->
                                        <div class="containee volleyball-toolbox toolbox Volleyball toolbox-container toolbox_open_close_transition">
                                            <div class="">
                                                <div class="open-close-button"><span class="tool-box-close">&lt</span></div>
                                                <div class="column">
                                                    <div class="top">
                                                        <ul>
                                                            <h1> TOOLS</h1>
                                                            <li title="Select" class="select tool"><i class="fa fa-paper-plane"></i></li>
                                                            <li title="Eraser" id="delete " class="eraser tool"><img id="delete" src="{!! asset('assets/sketchpad/img/erase.svg') !!}"></li>
                                                            <li title="Freeline" id="freeline" class="freeline tool"><img src="{!! asset('assets/sketchpad/img/curve.svg') !!}" width="30" height="30" width="30" height="30"></li>
                                                            <li title="Straightline" id="streightline" class="straightline tool"><i id="streightline" class="fa fa-minus"></i></li>
                                                            <li title="Undo" id="undo" class="undo tool"><i class="fa fa-undo"></i></li>
                                                            <li title="Redo" id="redo" class="redo tool"><i class="fa fa-repeat"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="middle">
                                                    <ul>
                                                        <li id="attack" title="S" class="Sv tool" data-attacktype="S">S</li>
                                                        <li id="attack" title="L" class="L tool" data-attacktype="L">L</li>
                                                        <li id="attack" title="MB" class="MBv tool" data-attacktype="MB">MB</li>
                                                        <li id="attack" title="OH" class="OUTv tool" data-attacktype="OUT H">OH</li>
                                                        <li id="attack" title="OH" class="OPPv tool" data-attacktype="OPP H">OH</li>
                                                        <li id="icon" title="Copyright" class="coach tool" data-attacktype="copyright"><i class="fa fa-copyright"></i></li>
                                                        <li id="Dtext" title="Text" class="abcv tool">abc</li>
                                                        <li id="icon" title="Camera" data-attacktype="camera" class="camera tool"> <img id="icon" data-attacktype="camera" src="{!! asset('assets/sketchpad/img/camera.svg') !!}" width="25" height="25"></li>
                                                    </ul>
                                                </div>
                                                <div class="bottom">
                                                    <ul>
                                                        <li id="icon" title="volleynet" data-attacktype="volleynet" class="hoop tool"> <img data-attacktype="volleynet" src="{!! asset('assets/sketchpad/img/volleynet.svg') !!}"  width="25" height="25"></li>
                                                        <li id="icon" title="4 ball rack" data-attacktype="volley4ballrack" class="balls tool">  <img data-attacktype="volley4ballrack"src="{!! asset('assets/sketchpad/img/volley4ballrack.svg') !!}"  width="25" height="25"></i></li>
                                                        <li  id="icon" title="Cone" data-attacktype="cone" class="cone tool"> <img data-attacktype="cone" src="{!! asset('assets/sketchpad/img/cone.svg') !!}"  width="25" height="25"></li>
                                                        <li id="icon" title="V ball" data-attacktype="v_ball" class="ball tool"> <img data-attacktype="v_ball" src="{!! asset('assets/sketchpad/img/vball.svg') !!}"  width="25" height="25"></li>
                                                        <li class="triangle tool" title="Triangle" id="triangle"><i class="fa fa-caret-up"></i></li>
                                                        <li class="circle tool" title="Circle" id="circ"><i class="fa fa-circle-o" aria-hidden="true"></i></li>
                                                        <li class="square tool" title="Square" id="rect"><i class="fa fa-square-o"></i></li>
                                                        <li id="icon" class="X tool" title="X" data-attacktype="close_x"> <i data-attacktype="close_x" class="fa fa-times" aria-hidden="true"></i></li>
                                                        <li id="icon" title="Rebounder" class="re-bounder tool" data-attacktype="rebound"> <img data-attacktype="rebound" src="{!! asset('assets/sketchpad/img/rebound.svg') !!}"  width="25" height="25"></li>
                                                        <!--<li id="save">save</li>-->
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!--SOCCER TOOL-->
                                        <div class="containe soccer-toolbox toolbox Soccer toolbox-container toolbox_open_close_transition">
                                            <div class="">
                                                <div class="open-close-button"><span class="tool-box-close">&lt</span></div>
                                                <div class="column">
                                                    <div class="top">
                                                        <ul>
                                                            <h1> TOOLS</h1>
                                                            <li id="" title="Select" class="select tool"><i class="fa fa-paper-plane"></i></li>
                                                            <li id="delete" title="Eraser" class="eraser tool"><img id="delete" src="{!! asset('assets/sketchpad/img/erase.svg') !!}"  width="25" height="25"></li>
                                                            <li id="freeline" title="Freeline" class="freeline tool"><img src="{!! asset('assets/sketchpad/img/curve.svg') !!}" width="30" height="30"></li>
                                                            <li id="streightline" title="StraightLine" class="straightline tool"><i id="streightline" class="fa fa-minus"></i></li>
                                                            <li id="undo" title="Undo" class="undo tool"><i class="fa fa-undo"></i></li>
                                                            <li id="redo" title="Redo" class="redo tool"><i class="fa fa-repeat"></i></li>
                                                        </ul>
                                                    </div>
                                                    <div class="middle">
                                                        <ul>
                                                            <li id="attack" title="LB" class="LB tool" data-attacktype="LB">LB</li>
                                                            <li id="attack" title="GK" class="GK tool" data-attacktype="GK">GK</li>
                                                            <li id="attack" title="RB" class="RB tool" data-attacktype="RB">RB</li>
                                                            <li id="attack" title="LWB" class="LWB tool" data-attacktype="LWB">LWB</li>
                                                            <li id="attack" title="SW" class="SW tool" data-attacktype="SW">SW</li>
                                                            <li id="attack" title="RWB" class="RWB tool" data-attacktype="RWB">RWB</li>
                                                            <li id="attack" title="DM" class="DM tool" data-attacktype="DM">DM</li>
                                                            <li id="attack" title="CM" class="CM tool" data-attacktype="CM">CM</li>
                                                            <li id="attack" title="AM" class="AM tool" data-attacktype="AM">AM</li>
                                                            <li id="attack" title="LM" class="LM tool" data-attacktype="LM">LM</li>
                                                            <li id="icon" title="Copyright" class="coachs tool" data-attacktype="copyright"><i data-attacktype="copyright"class="fa fa-copyright"></i></li>
                                                            <li id="attack" title="RM" class="RM tool" data-attacktype="RM">RM</li>
                                                            <li id="attack" title="CF" class="CF tool" data-attacktype="CF">CF</li>
                                                            <li id="attack" title="S" class="S tool" data-attacktype="S">S</li>
                                                            <li id="attack" title="SS" class="SS tool" data-attacktype="SS">SS</li>
                                                            <li id="Dtext" title="Text" class="abcs tool" >abc</li>
                                                            <li id="icon" title="Camera" data-attacktype="camera" class="cameras tool"><img data-attacktype="camera" src="{!! asset('assets/sketchpad/img/camera.svg') !!}"  width="25" height="25"></li>
                                                        </ul>
                                                    </div>
                                                    <div class="bottom">
                                                        <ul>
                                                            <li id="icon" title="Soccer net" data-attacktype="soccernet" class="soc-net tool"> <img data-attacktype="soccernet" src="{!! asset('assets/sketchpad/img/soccernet.svg') !!}"  width="25" height="25"></li>
                                                            <li id="icon" title="Five soccer ball" data-attacktype="fivesoccerball" class="soc-balls tool">  <img  data-attacktype="fivesoccerball" src="{!! asset('assets/sketchpad/img/fivesoocerball.svg') !!}"  width="25" height="25"></li>
                                                            <li id="icon" title="Cone" data-attacktype="cone" class="cone-soc tool"> <img data-attacktype="cone" src="{!! asset('assets/sketchpad/img/cone.svg') !!}"  width="25" height="25"></li>
                                                            <li id="icon" title="Soccerball" data-attacktype="soccerball" class="soc-ball tool"> <img data-attacktype="soccerball" src="{!! asset('assets/sketchpad/img/soccerball.svg') !!}"  width="25" height="25"></i></li>
                                                            <li class="soc-triangle tool" title="Triangle" id="triangle"><i class="fa fa-caret-up"></i></li>
                                                            <li id="icon" title="x" data-attacktype="close_x" class="soc-X tool"> <i data-attacktype="close_x"class="fa fa-times" aria-hidden="true"></i></li>
                                                            <li class="soc-square tool" id="rect" title="Rectangle"><i class="fa fa-square-o"></i></li>
                                                            <li class="soc-circle tool" id="circ" title="Circle"><i class="fa fa-circle-o" aria-hidden="true"></i></li>
                                                            <li class="soc-mini tool" id="icon" title="Mininet" data-attacktype="mininet"><img data-attacktype="mininet" src="{!! asset('assets/sketchpad/img/mininet.svg')!!}"  width="25" height="25"></li>
                                                            <li class="soc-arch tool" title="Arch" id="icon" data-attacktype="archs"><img data-attackype="archs" src="{!! asset('assets/sketchpad/img/archs.svg') !!}"  width="25" height="25"></li>
                                                            <!--<li id="save">save</li>-->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ground">
                                            <div id="play-ground"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row sketchpad_row">
        <!-- DRILLS Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 drill-sidebar" style="margin-top: 140px;background-color: #fff;position: fixed;top:12px;overflow:visible;">
    <div class="open-close-button-drills"><span class="drill-box-close tool-close">&gt</span></div>
    <!-- Brand Logo -->
    <a  class="brand-link hover-green" style="background-color: #1969a5;">
 
      <span class="brand-text font-weight-light" style="color: #fff"><i class="fas fa-sync"></i> DRILLS</span>
    </a>
 
        @include('user.drills_sidebar')
        
        
  </aside>
        <div class="col-md-12 open-left pl-140 pr-300">
            <div class="">
                <div class="card-default">
                    <div class="">
                        <h3 class="card-title"></h3>
                    </div>
                    <form method="post" id="drawdetails" action="{{url()->current()}}">
                        <!-- /.card-header -->@csrf
                        <div class="">
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="left-right-open-pad">
                                            <!--  <nav class="navbar navbar-expand navbar-white navbar-light" style="background-color:#f1f1f1;padding:0">
                                                <ul class="navbar-nav ml-10"> -->
                                            <!-- Messages Dropdown Menu -->
                                            <!-- <li class="nav-item">
                                                <button class="nav-link" type="submit" alt="save"> <i class="fa fa-save"></i> </button>
                                                </li>
                                                <li class="nav-item bdicon">
                                                <button class="nav-link drawdetailsreset" data-toggle="dropdown" href="#"> <i class="far fa-trash-alt"></i> </button>
                                                </li>
                                                </ul>
                                                </nav> -->
                                            <div class="tab-content">
                                                <div class="timeline-body">
                                                    <div class="row d-none">
                                                        <div class="col-md-6">
                                                            <label> Drill Name</label>
                                                            <input required class="form-control"  id="drillname" type="text" placeholder="Drill Name" name="name">
                                                            <br> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Mins</label>
                                                            <div class="form-group">
                                                                <input required class="form-control" id="mins" type="text" placeholder="Drill Name" name="mins">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Surface</label>
                                                            <div class="form-group">
                                                                <input required class="form-control" id="rink" type="text" placeholder="Drill Name" name="surface">
                                                                <br> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row d-none">
                                                        <!-- /.col -->
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1">sketchpad data</label>
                                                                <textarea  name="sketchpad_data" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.form-group -->
                                                    <div class="row">
                                                        <!-- /.col -->
                                                        <div class="col-md-12">
                                                            <label>Tags</label>
                                                            <div class="form-group">
                                                                <select id="selecttag" multiple name="tags[]" class="form-control select2bs4" multiple data-placeholder="Select Tags" style="width: 100%;">
                                                                    <optgroup label="Tags">
                                                                        @foreach($tags as $tag)
                                                                        <!-- comment -->
                                                                        <option value="{{$tag->name}}">{{$tag->name}}</option>
                                                                        @endforeach 
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                            <!-- /.form-group -->
                                                            <label>Age Group</label>
                                                            <div class="form-group">
                                                                <select required id="selectagegroup" name="age_group[]" class="form-control select2bs4" multiple data-placeholder="Select Age Group" style="width: 100%;">
                                                                    <option>8U & Under</option>
                                                                    <option>9U to 12U</option>
                                                                    <option>13U & Above</option>
                                                                </select>
                                                            </div>
                                                            <!-- /.form-group -->
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card card-outline card-info">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">
                                                                        Notes
                                                                    </h3>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body pad">
                                                                    <div class="mb-3">
                                                                        <textarea name="notes" class="textarea clear" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.col-->
                                                    </div>
                                                    <!-- ./row -->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card card-outline card-info">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">
                                                                        Description
                                                                    </h3>
                                                                    <!-- tools box -->
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body pad">
                                                                    <div class="mb-3">
                                                                        <textarea name="description" class="textarea  clear clearDescription" placeholder="" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.col-->
                                                    </div>
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
@if($errors->all())
<!--Error Modal -->
<div style="padding-top: 100px" class="modal fade" id="error_modal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           @foreach ($errors->all() as $error) <div class="alert alert-danger"> * {{ $error }} <br> </div> @endforeach
      </div>
    
    </div>
  </div>
</div>
@endif

<div  style="padding-top: 100px" class="modal fade" id="newDrill" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Drill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are you sure you want to Delete this Drill and create new ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="window.location.href='{{url('drills')}}'" class="btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>
@include('user.include.add_team_modal')

@endsection


