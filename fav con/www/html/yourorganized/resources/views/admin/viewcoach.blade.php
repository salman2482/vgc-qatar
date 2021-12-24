@extends('layouts.admin')
@push('styles')
@endpush
@section('title', $user2->firstname.' '.$user2->lastname.'- View Profile - ')
@push('scripts')
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Coach Profile</h1>
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
                       src="{!! asset('assets/main/assets/images/guardian.png') !!}" >
                </div>

                <h3 class="profile-username text-center">{{$user2->firstname.' '.$user2->lastname}}</h3>

                <p class="text-muted text-center">{{$user2->sports}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Drills</b> <a class="float-right">7</a>
                  </li>
                  <li class="list-group-item">
                    <b>Associates</b> <a class="float-right">11</a>
                  </li>
                  <li class="list-group-item">
                    <b>Tags</b> <a class="float-right">17</a>
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