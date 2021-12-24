@extends('layouts.main') @push('styles')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">
<!-- Bootstrap Editor -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/summernote/summernote-bs4.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/sketchpad/volleyball.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/sketchpad/hockey.css') !!}">
<!-- Theme style -->
<link rel="stylesheet" href="{!! asset('assets/dist/css/adminlte.min.css') !!}">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="{!! asset('assets/sketchpad/sketchpad.css') !!}">
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
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
<div class="content-wrapper  mr-0 bg-white">
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
                    <button type="button" class="btn btn-secondary dropdown-toggle ground-switch" data-toggle="dropdown">
                    Surface
                    </button>
                    <div class="dropdown-menu  dropdown-menu-right ground-change">
                        <a id="1" class="dropdown-item Basketball surface Basketballsurface" href="#" data-ground="basketball_court_one"><img src="{!! asset('assets/sketchpad/img/basketball_court_one.svg') !!}"></a>
                        <div class="dropdown-divider Basketball surface Basketballsurface"></div>
                        <a id="1" class="dropdown-item Basketball surface h-120 Basketballsurface" href="#" data-ground="basketball_court_two"><img src="{!! asset('assets/sketchpad/img/basketball_court_two.svg') !!}"></a>
                        <div class="dropdown-divider Basketball surface Basketballsurface"></div>
                        <a id="1" class="dropdown-item Basketball surface h-110 Basketballsurface" href="#" data-ground="basketball_court_three"><img src="{!! asset('assets/sketchpad/img/basketball_court_three.svg') !!}"></a>
                        <div class="dropdown-divider Basketball surface Basketballsurface"></div>
                        <a id="1" class="dropdown-item Basketball surface h-150 Basketballsurface" href="#" data-ground="basketball_court_four"><img src="{!! asset('assets/sketchpad/img/basketball_court_four.svg') !!}"></a>
                        <div class="dropdown-divider Basketball none surface Basketballsurface"></div>
                        <a id="1" class="dropdown-item Hockey none surface h-95 Hockeysurface" href="#" data-ground="hockeycourt_one"><img src="{!! asset('assets/sketchpad/img/hockeycourt_one_old.svg') !!}"></a>
                        <div class="dropdown-divider Hockey none surface Hockeysurface"></div>
                        <a id="1" class="dropdown-item Hockey none surface Hockeysurface" href="#" data-ground="hockeycourt_two"><img src="{!! asset('assets/sketchpad/img/hockeycourt_two.svg') !!}"></a>
                        <div class="dropdown-divider Hockey none surface Hockeysurface"></div>
                        <a id="1" class="dropdown-item Hockey none surface Hockeysurface" href="#" data-ground="hockeycourt_three"><img src="{!! asset('assets/sketchpad/img/hockeycourt_three_old.svg') !!}"></a>
                        <div class="dropdown-divider Hockey none surface Hockeysurface"></div>
                        <a id="1" class="dropdown-item Hockey none surface Hockeysurface" href="#" data-ground="hockeycourt_four"><img src="{!! asset('assets/sketchpad/img/hockeycourt_four_old.svg') !!}"></a>
                    </div>
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
    <section class="toolbox-section">
                <div class="test  toolbox-container">
                    <ul class="newtools Basketball toolbox">
                        <li id="Select" title="Select" class=" tool"><i class="fa fa-paper-plane"></i></li>
                        <li id="delete" title="Eraser" class=" tool"><img id="delete" src="{!! asset('assets/sketchpad/img/erase.svg') !!}"></li>
                        <li id="Freelinewitharrow" title="Freeline" class=" tool"><img id="freeline" src="{!! asset('assets/sketchpad/img/curve.svg') !!}" width="30" height="30"></li>
                        <li id="arrow" title="Straightline" class=" tool"><i id="streightline" class="fa fa-minus"></i></li>
                        <li id="undo" title="Undo" class=" tool"><i id="undo" class="fa fa-undo"></i></li>
                        <li id="redo" title=Redo class="tool-seperation tool"><i id="redo" class="fa fa-repeat"></i></li>
                        <li id="attack" title="Point Guard" class="tool" data-attacktype="PG">PG</li>
                        <li id="attack" title="Shooting Guard" class="tool" data-attacktype="SG">SG</li>
                        <li id="attack" title="Power Forward" class="tool" data-attacktype="PF">PF</li>
                        <li id="attack" title="Small Forward" class=" tool" data-attacktype="SF">SF</li>
                        <li id="attack" title="Center" class="tool" data-attacktype="C">C</li>
                        <li id="icon" title="Coach" data-attacktype="copyright" class="tool" data-attacktype="@"><i class="fa fa-copyright"></i></li>
                        <li id="Dtext" title="Text" class="tool tool-seperation">abc</li>
                        <li id="icon" title="Camera" data-attacktype="camera" class="tool"><img id="icon" data-attacktype="camera" src="{!! asset('assets/sketchpad/img/camera.svg') !!}" width="25" height="25"></li>
                        <li id="icon" title="Hoop" data-attacktype="hoop" class="tool"> <img id="icon" data-attacktype="hoop" src="{!! asset('assets/sketchpad/img/hoop.svg') !!}" width="25" height="25"></li>
                        <li id="icon" title="4 ball track" data-attacktype="4_ball_track" class="tool"> <img id="icon" data-attacktype="4_ball_track" src="{!! asset('assets/sketchpad/img/4ballrack.svg') !!}" width="25" height="25"></li>
                        <li id="icon" title="Cone" data-attacktype="cone" class="tool"> <img id="icon" data-attacktype="cone"  src="{!! asset('assets/sketchpad/img/cone.svg') !!}" width="30" height="30"></li>
                        <li id="icon" title="B ball" data-attacktype="v_ball" class="tool"> <img id="icon" data-attacktype="v_ball" src="{!! asset('assets/sketchpad/img/btball.svg') !!}" width="30" height="30"></li>
                        <li class="tool" title="Triangle" id="triangle"><i id="triangle" class="fa fa-caret-up"></i></li>
                        <li id="icon" title="x" data-attacktype="close_x" class="tool"> <i id="icon" data-attacktype="close_x" class="fa fa-times" aria-hidden="true"></i></li>
                        <li class="tool" title="Square" id="rect"><i  id="rect" class="fa fa-square-o"></i></li>
                        <li class="tool" title="Circle" id="circ"><i id="circ" class="fa fa-circle-o" aria-hidden="true"></i></li>
                    </ul>
                    <ul class="newtools Hockey toolbox">
                        <li id="Select" title="Select" class=" tool"><i class="fa fa-paper-plane"></i></li>
                        <li id="delete" title="Eraser" class=" tool"><img id="delete" src="{!! asset('assets/sketchpad/img/erase.svg') !!}"></li>
                        <li id="Freelinewitharrow" title="Freeline" class=" tool"><img id="freeline" src="{!! asset('assets/sketchpad/img/curve.svg') !!}" width="30" height="30"></li>
                        <li id="arrow" title="Straightline" class=" tool"><i id="streightline" class="fa fa-minus"></i></li>
                        <li id="undo" title="Undo" class=" tool"><i id="undo" class="fa fa-undo"></i></li>
                        <li id="redo" title=Redo class="tool-seperation tool"><i id="redo" class="fa fa-repeat"></i></li>
                        <li id="attack" title="Left Wing" class="tool" data-attacktype="LW">LW</li>
                        <li id="attack" title="Centre" class="tool" data-attacktype="C">C</li>
                        <li id="attack" title="Regulation Win" class="tool"data-attacktype="RW">RW</li>
                        <li id="attack" title="Left Defense" class="tool" data-attacktype="LD">LD</li>
                        <li id="attack" title="Goals" class="tool"data-attacktype="G">G</li>
                        <li id="attack" title="Re-entered NHL Entry Draft" class="tool"data-attacktype="RD">RD</li>
                        <li id="attack" title="Forward" class="tool"data-attacktype="F">F</li>
                        <li id="attack" title="Defense" class="tool"data-attacktype="D">D</li>
                        <li id="icon" title="Coach" class="tool"data-attacktype="copyright"><i data-attacktype="copyright"class="fa fa-copyright"></i></li>
                        <li id="Dtext" title="Text" class="tool tool-seperation" >abc</li>
                        <li id="icon" title="Camera" data-attacktype="camera" class="tool"><img id="icon" data-attacktype="camera" src="{!! asset('assets/sketchpad/img/camera.svg') !!}" width="25" height="25"></li>
                        <li id="icon" title="Net" data-attacktype="hocnet" class="tool"> <img data-attacktype="hocnet" src="{!! asset('assets/sketchpad/img/hockeynet.svg') !!}"  width="25" height="25"></li>
                        <li id="icon" title="Stick" data-attacktype="hocstick" class="tool">  <img  data-attacktype="hocstick" src="{!! asset('assets/sketchpad/img/hockeystick.svg') !!}"  width="25" height="25"></li>
                        <li id="icon" title="Cone" data-attacktype="cone" class="tool"> <img data-attacktype="cone" src="{!! asset('assets/sketchpad/img/cone.svg') !!}"  width="25" height="25"></li>
                        <li id="icon" title="Tire" data-attacktype="tire" class="tool"> <img data-attacktype="tire" src="{!! asset('assets/sketchpad/img/hockytire.svg') !!}"  width="25" height="25"></i></li>
                        <li id="icon" title="Puck" data-attacktype="puck" class="tool"> <img data-attacktype="cone" src="{!! asset('assets/sketchpad/img/hockeypuck.svg') !!}"  width="25" height="25"></li>
                        <li id="icon" title="Pucks" data-attacktype="pucks" class="tool"> <img data-attacktype="pucks" src="{!! asset('assets/sketchpad/img/hokysixpuck.svg') !!}"  width="25" height="25"></i></li>
                        <li class="tool" title="Triangle" id="triangle"><i class="fa fa-caret-up"></i></li>
                        <li id="icon" title="X" data-attacktype="close_x" class="tool"> <i data-attacktype="close_x"class="fa fa-times" aria-hidden="true"></i></li>
                        <li class="tool" id="rect" title="square"><i class="fa fa-square-o"></i></li>
                        <li class="tool" id="circ" title="Circle"><i class="fa fa-circle-o" aria-hidden="true"></i></li>
                        <li id="icon" title="Horizontal Bar" data-attacktype="HorizontalBar" class="tool"> <img data-attacktype="HorizontalBar" src="{!! asset('assets/sketchpad/img/bar1.svg') !!}"  width="25" height="25"></li>
                        <li id="icon" title="vertical bar" data-attacktype="verticalbar" class="tool"> <img data-attacktype="verticalbar" src="{!! asset('assets/sketchpad/img/bar2.svg') !!}"  width="25" height="25"></i></li>
                    </ul>
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
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="PG{{$i}}" class="attacklistselection">PG{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist sg mr-25">
                        <li id="attack" data-attacktype="SG" class="attacklistselection">SG</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="SG{{$i}}" class="attacklistselection">SG{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist pf mr-25">
                        <li id="attack" data-attacktype="PF" class="attacklistselection">PF</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="PF{{$i}}" class="attacklistselection">PF{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist sf mr-25">
                        <li id="attack" data-attacktype="SF" class="attacklistselection">SF</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="SF{{$i}}" class="attacklistselection">SF{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist c mr-25">
                        <li id="attack" data-attacktype="C" class="attacklistselection">C</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="C{{$i}}" class="attacklistselection">C{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist lw mr-25">
                        <li id="attack" data-attacktype="LW" class="attacklistselection">LW</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="LW{{$i}}" class="attacklistselection">LW{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist rw mr-25">
                        <li id="attack" data-attacktype="RW" class="attacklistselection">RW</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="RW{{$i}}" class="attacklistselection">RW{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist ld mr-25">
                        <li id="attack" data-attacktype="LD" class="attacklistselection">LD</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="LD{{$i}}" class="attacklistselection">LD{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist g mr-25">
                        <li id="attack" data-attacktype="G" class="attacklistselection">G</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="G{{$i}}" class="attacklistselection">G{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist rd mr-25">
                        <li id="attack" data-attacktype="RD" class="attacklistselection">RD</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="RD{{$i}}" class="attacklistselection">RD{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist f mr-25">
                        <li id="attack" data-attacktype="F" class="attacklistselection">F</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="F{{$i}}" class="attacklistselection">F{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist d mr-25">
                        <li id="attack" data-attacktype="D" class="attacklistselection">D</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="D{{$i}}" class="attacklistselection">D{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist lb mr-25">
                        <li id="attack" data-attacktype="LB" class="attacklistselection">LB</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="LB{{$i}}" class="attacklistselection">LB{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist gk mr-25">
                        <li id="attack" data-attacktype="GK" class="attacklistselection">GK</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="GK{{$i}}" class="attacklistselection">GK{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist rb mr-25">
                        <li id="attack" data-attacktype="RB" class="attacklistselection">RB</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="RB{{$i}}" class="attacklistselection">RB{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist lwb mr-25">
                        <li id="attack" data-attacktype="LWB" class="attacklistselection">LWB</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="LWB{{$i}}" class="attacklistselection">LWB{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist sw mr-25">
                        <li id="attack" data-attacktype="SW" class="attacklistselection">SW</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="SW{{$i}}" class="attacklistselection">SW{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist rwb mr-25">
                        <li id="attack" data-attacktype="RWB" class="attacklistselection">RWB</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="RWB{{$i}}" class="attacklistselection">RWB{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist dm mr-25">
                        <li id="attack" data-attacktype="DM" class="attacklistselection">DM</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="DM{{$i}}" class="attacklistselection">DM{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist cm mr-25">
                        <li id="attack" data-attacktype="CM" class="attacklistselection">CM</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="CM{{$i}}" class="attacklistselection">CM{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist am mr-25">
                        <li id="attack" data-attacktype="AM" class="attacklistselection">AM</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="AM{{$i}}" class="attacklistselection">AM{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist lm mr-25">
                        <li id="attack" data-attacktype="LM" class="attacklistselection">LM</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="LM{{$i}}" class="attacklistselection">LM{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist rm mr-25">
                        <li id="attack" data-attacktype="RM" class="attacklistselection">RM</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="RM{{$i}}" class="attacklistselection">RM{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist cf mr-25">
                        <li id="attack" data-attacktype="CF" class="attacklistselection">CF</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="CF{{$i}}" class="attacklistselection">CF{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist s mr-25">
                        <li id="attack" data-attacktype="S" class="attacklistselection">S</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="S{{$i}}" class="attacklistselection">S{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist ss mr-25">
                        <li id="attack" data-attacktype="SS" class="attacklistselection">SS</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="SS{{$i}}" class="attacklistselection">SS{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist l mr-25">
                        <li id="attack" data-attacktype="L" class="attacklistselection">L</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="F{{$i}}" class="attacklistselection">F{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist mb mr-25">
                        <li id="attack" data-attacktype="MB" class="attacklistselection">MB</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="MB{{$i}}" class="attacklistselection">MB{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist h mr-25">
                        <li id="attack" data-attacktype="OUT H" class="attacklistselection">OUT H</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="OUT H{{$i}}" class="attacklistselection">OUT H{{$i}}</li>
                        @endfor
                    </ul>
                    <ul class="attacklist opp mr-25">
                        <li id="attack" data-attacktype="OPP H" class="attacklistselection">OPP H</li>
                        @for( $i=1;$i<=5;$i++)
                        <li id="attack" data-attacktype="OUT H{{$i}}" class="attacklistselection">OUT H{{$i}}</li>
                        @endfor
                    </ul>
                    <div id="myDropdown" class="lines-option mr-25"></div>
                    <div id="arrowoption" class="mr-25"></div>
                </div>

    </section>
    <!-- Tools&sketchpad  -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 bg-grey">
                <div class="ground">
                    <div id="play-ground">
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
  <aside class="main-sidebar sidebar-dark-primary elevation-4 drill-sidebar  drill-box-closed" style="margin-top: 140px;background-color: #fff;position: fixed;top:12px;overflow:visible;">
    <div class="open-close-button-drills"><span class="drill-box-open clr-black">DRILLS</span></div>
    <!-- Brand Logo -->
    <a  class="brand-link hover-green" style="background-color: #000;color: #fff;">
 
      <span class="brand-text font-weight-light" style="color: #fff"><i class="fas fa-sync"></i> DRILLS</span>
    </a>
 
        @include('user.drills_sidebar')
  </aside>
        <div class="col-md-12 open-left">
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
                                           
                                            <div class="tab-content">
                                                <div class="timeline-body">
                                                    <div class="row d-none">
                                                        <div class="col-md-2">
                                                            <label> Drill Name</label>
                                                            <input required class="form-control"  id="drillname" type="text" placeholder="Drill Name" name="name">
                                                            <br> 
                                                        </div>
                                                        <div class="col-md-2">
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
                                                        <div class="col-md-2">
                                                            <label>sports</label>
                                                            <div class="form-group">
                                                                <input required class="form-control" id="sports" type="text" placeholder="Drill Name" name="sports">
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


