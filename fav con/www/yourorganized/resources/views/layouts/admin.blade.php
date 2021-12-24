<!doctype html>
<html lang="en" >
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <link rel="icon" href="{!! asset('favicon.ico') !!}" type="image/x-icon"/>
		<link rel="shortcut icon" type="image/x-icon" href="{!! asset('favicon.ico') !!}"/>
           

		
                  <!-- Font Awesome Icons -->
                  <link rel="stylesheet" href="{!! asset('assets/admin/plugins/fontawesome-free/css/all.min.css') !!}">
                  <!-- Theme style -->
                  <link rel="stylesheet" href="{!! asset('assets/admin/dist/css/adminlte.min.css') !!}">
                  <!-- Google Font: Source Sans Pro -->
                  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
                  <title>@yield('title') Admin DashBoard {{ config('app.name', '') }}</title>
                 @stack('styles')         
               
                
	</head>
        
        
        <body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url($admin_url.'dashboard')}}" class="nav-link">Home</a>
      </li>
     
    </ul>

  

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{!! asset('assets/main/assets/images/guardian.png') !!}" alt="img" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  User  Name
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Message content preview.....</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{!! asset('assets/main/assets/images/guardian.png') !!}" alt="img" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  User  Name
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Message content preview.....</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          
          
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{!! asset('assets/main/assets/images/guardian.png') !!}" alt="img" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  User  Name
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Message content preview.....</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{!! asset('assets/main/assets/images/guardian.png') !!}" alt="img" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  User  Name
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Message content preview.....</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          
          
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">1</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">1 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
 <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
     <a href="{{url($admin_url.'dashboard')}}" class="brand-link">
      
      <span class="brand-text font-weight-light"> <img src="{!! asset('assets/images/logo.jpg') !!}" style="height:32px"></span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="" class="img-circle elevation-2" alt="">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{$user->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
           
          
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{url($admin_url.'dashboard')}}" class="nav-link {{ request()->is($admin_url.'dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li> 
          
          
           {{-- <li class="nav-item">
            <a href="{{url($admin_url.'coaches')}}" class="nav-link {{ request()->is($admin_url.'coaches') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Coaches
              </p>
            </a>
          </li> --}}
          
          <li class="nav-item">
            <a href="{{url($admin_url.'users')}}" class="nav-link {{ request()->is($admin_url.'users') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                 Manage Coaches
              </p>
            </a>
          </li> 
          
          
           
          
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-user"></i>
              <p>
                 Manage Memberships
              </p>
            </a>
          </li> 
          
          <li class="nav-item">
            <a href="{{url($admin_url.'tags')}}" class="nav-link {{ request()->is($admin_url.'tags') ? 'active' : '' }}">
              <i class="nav-icon fa fa-tags"></i>
              <p>
                 Manage Tags
              </p>
            </a>
          </li> 
          
          <li class="nav-item">
            <a href="{{url($admin_url.'manage_drills')}}" class="nav-link {{ request()->is($admin_url.'manage_drills') ? 'active' : '' }}">
              <i class="nav-icon fas fa-flag"></i>
              <p>
                 Manage Drills
              </p>
            </a>
          </li> 
          
          <li class="nav-item">
            <a href="{{url($admin_url.'manage_plans')}}" class="nav-link {{ request()->is($admin_url.'manage_plans') ? 'active' : '' }}">
              <i class="nav-icon fas fa-flag"></i>
              <p>
                 Manage Plans
              </p>
            </a>
          </li> 
          
          
          
          
          <li class="nav-item">
            <a href="{{url($admin_url.'manage_associations')}}" class="nav-link {{ request()->is($admin_url.'manage_associations') ? 'active' : '' }}">
              <i class="nav-icon fas fa-star"></i>
              <p>
                 Manage Associations
              </p>
            </a>
          </li> 
          
              <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                 Manage Referals
              </p>
            </a>
          </li> 
          
          
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                 Manage Videos
              </p>
            </a>
          </li> 
          
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                 Chats
              </p>
            </a>
          </li> 
          
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                FAQ Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
                <li class="nav-item">
                <a href="{{url($admin_url.'manage/faq')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage FAQ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url($admin_url.'faq/youtube/videos')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Youtube Videos</p>
                </a>
              </li>
              
            </ul>
          </li>
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
                <li class="nav-item">
                <a href="{{url($admin_url.'home/sliders')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          
          <li class="nav-item">
            <a href="#" data-toggle="modal" data-target="#Logout" class="nav-link ">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li> 
        
     
            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
 @yield('content')
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer text-sm">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
     
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <script>document.write(new Date().getFullYear())</script> <a href="{{url('/')}}">Name</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

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
         <a  href="{{url($admin_url.'logout')}}" class="btn btn-danger" >Logout</a>
      </div>

    </div>
  </div>
</div> 
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{!! asset('assets/admin/plugins/jquery/jquery.min.js') !!}"></script>
<!-- Bootstrap 4 -->
<script src="{!! asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- AdminLTE App -->
<script src="{!! asset('assets/admin/dist/js/adminlte.min.js') !!}"></script>
@stack('scripts')
</body>
</html>