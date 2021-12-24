@php $user = Auth::user(); @endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{!! asset('assets/admin/plugins/fontawesome-free/css/all.min.css') !!}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{!! asset('assets/admin/dist/css/adminlte.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('assets/sketchpad/headernew.css') !!}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>@yield('title')   {{ config('app.name', '') }}</title>
        @stack('styles') 
    </head>
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            <!-- Navbar -->
            <div id="page" class="site new_drill_header">
            <header class="pt-1">
                <div class="container header-grid">
                    <ul class="primary-menu pl-0 m-0">
                        <li class="pl-10 ">
                            <a  href="{{url('drills')}}">Drills</a>
                        </li>
                        <li>
                            <a href="{{url('plans')}}">Plans</a>
                        </li>
                    </ul>
                    <div id="site-logo" class="site-branding">
                        <a href="https://yourorganized.com">
                            <img  height="68" src="https://yourorganized.com/wp-content/uploads/2020/04/YourOrganized-1000x300-1-768x143.png">
                        </a>
                    </div>
                    <div class="navbar-right-section pt-20">
                        <div class="dropdown mr-10">
                            <button type="button" class="btn btn-primary dropdown-toggle selectedsport btn-success" data-toggle="dropdown">
                                Basketball
                            </button>
                            <div class="dropdown-menu  dropdown-menu-right">
                                <a class="dropdown-item sports-selection" href="#">Basketball</a>
                                <div class="dropdown-divider"></div>
                               <!--  <a class="dropdown-item sports-selection" href="#">Volleyball</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item sports-selection" href="#">Soccer</a>
                                <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item sports-selection" href="#">Hockey</a>
                            </div>
                        </div>
                        
                        
                        <div class="dropdown">
                            <button type="button" class="drill-my-account-avatar btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                <img class="drill-my-account-avatar mt-0" style=" " src="{{url('user_images/image/'.$user->id)}}">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right f-14">
                                <a class="dropdown-item" href="{{url('myprofile')}}">Account</a>
                                <div class="dropdown-divider"></div>
                                <a  class="dropdown-item" href="{{url('logout')}}">Logout</a>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </header>
        </div>
             @if(!((request()->is('drills') OR request()->is('drill/*') OR request()->is('plan/*') OR request()->is('plans'))))
            <div style="padding-bottom:70px"></div>
           
            @endif
            <!-- /.navbar -->
            @yield('content')
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->
          <?php /*   <!-- Main Footer -->
           <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; {{date('Y')}} <a href="#">App Name</a>.</strong> All rights reserved.
            </footer>  
          */?>
            
            <div class="modal" id="Logout">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h3 class="modal-title">Logout</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        Are you sure you want to logout? 
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        <a  href="" class="btn btn-danger" >Logout</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- ./wrapper -->
        
        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{!! asset('assets/admin/plugins/jquery/jquery.min.js') !!}"></script>
        <!-- Bootstrap 4 -->
        <script src="{!! asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
        <!--  App -->
        <script src="{!! asset('assets/admin/dist/js/adminlte.min.js') !!}"></script>
<!--         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 -->        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
       
        @stack('scripts')
    </body>
</html>