@extends('layouts.admin')
@push('styles')

<!-- DataTables -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') !!}">

@endpush

@push('scripts')

<!-- DataTables -->
<script src="{!! asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
<script src="{!! asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>

<script>
   
     $('#drill_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url($admin_url.'user_drills/'.$user2->id) }}",
            columns: [
                     
                     { data: 'name', name: 'name' },
                     { data: 'created_at', name: 'created_at' }
                       
                  ],
                 order: [[1, 'desc']]
         });
    
      </script>
      <script>
  
     $('#plan_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url($admin_url.'user_plans/'.$user2->id) }}",
            columns: [
                     
                     { data: 'name', name: 'name' },
                     { data: 'created_at', name: 'created_at' }
                       
                  ],
                 order: [[1, 'desc']]
        
      });
   </script>
  <script>
    
     $('#team_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url($admin_url.'team/'.$user2->id) }}",
            columns: [
                     
                     { data: 'name', name: 'name' },
                     { data: 'members', name: 'members' },
                     
                       
                  ],
                 order: [[1, 'desc']]
         });
   
   </script>

@endpush
@section('title', $user2->firstname.' '.$user2->lastname.'- View Profile - ')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url($admin_url.'dashboard')}}">DashBoard</a></li>
              <li class="breadcrumb-item active">{{$user2->firstname}}</li>
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
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{url($admin_url.'viewuserimage/'.$user2->id)}}" >
                </div>

                <h3 class="profile-username text-center">{{$user2->firstname.' '.$user2->lastname}}</h3>

                <p class="text-muted text-center">{{$user2->sports}}</p>
                @php
                use App\Models\Drill;
                 use App\Models\Plan;
                $countdrill=Drill::where('user_id',$user2->id)->count();   
                $countplan=Plan::where('user_id',$user2->id)->count();    
                @endphp
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Drills</b> <a class="float-right">{{ $countdrill }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Associations</b> <a class="float-right">{{App\Models\Association::where('creator_id',$user2->id)->count()}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Plans</b> <a class="float-right">{{ $countdrill }}</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Chat</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i>Any Details</strong>

                <p class="text-muted">
                  Descriptions will be shown here
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">{{$user2->country}}</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">Skill-1</span>
                  <span class="tag tag-success">Skill-2</span>
                  <span class="tag tag-info">Skill-3</span>
                  
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Tags</strong>

                <p class="text-muted">Tags details. ... . .. </p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                  <li class="nav-item"><a class="nav-link" href="#drills" data-toggle="tab">Drills</a></li>
                  <li class="nav-item"><a class="nav-link" href="#plans" data-toggle="tab">Plans</a></li>
                  <li class="nav-item"><a class="nav-link" href="#teams" data-toggle="tab">Teams</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                
                  <!-- /.tab-pane -->
                  <div class="tab-pane active" id="timeline">
                    <!-- The timeline -->
                    
                    @for($i=0;$i<3;$i++)
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          {{30-$i*3}} October 2020
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                      
                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Activity Title</a> description</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">View more</a>
                            
                          </div>
                        </div>
                      </div>
                   <div class="time-label">
                        <span class="bg-info">
                          {{28-$i*3}} October 2020
                        </span>
                      </div>
                    
                     
                      
                      
                    </div>
                    @endfor
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <label ><---------Settings Page---------></label>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="drills">
                      <div class="row">
                      <div class="col-md-12">
                          <table style="width: 100%" id="drill_table" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <th>Date</th>
                      </tr>
                      </thead>         
                    </table>
                  </div>
                      </div>
                      
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="plans">
                      <div class="row">
                      <div class="col-md-12">
                    <table style="width: 100%" id="plan_table" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <th>Date</th>
                      </tr>
                      </thead>         
                    </table>
                  </div>
                      </div>
                      
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="teams">
                    <div class="row">
                      <div class="col-md-12">
                        <table style="width: 100%" id="team_table" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>Teams</th>
                            <th>Members</th>
                           
                          </tr>
                          </thead>         
                        </table>
                      </div> <!-- /.col  -->
                    
                    </div> <!-- /.row -->
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
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