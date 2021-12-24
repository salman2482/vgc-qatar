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
    @if(session()->has('add')) $('#AddAssociation').modal('show');  @endif
    
      @if(session()->has('update')) $('#EditAssociation').modal('show');  @endif

  })
  
  
  
  $("#add_association_team").submit(function(stay){
   var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
    $.ajax({
        type: 'POST',
        url: "{{url('association/add/team')}}",
        data: formdata, // here $(this) refers to the ajax object not form
        success: function (data) {
            location.reload();
        $("#add_association_team").load(" #add_association_team");
         document.getElementById("add_association_team").reset();
          $("#team_table").load(" #team_table");
           //$("#team_view").load(" #team_view");
         $('#ateam_view').load(location.href+(' #team_view'));
        },
    });
    stay.preventDefault(); 
});



  $("#association_team_add_coach").submit(function(stay){
   var formdata = $(this).serialize(); // here $(this) refere to the form its submitting
    $.ajax({
        type: 'POST',
        url: "{{url('association/add/coach')}}",
        data: formdata, // here $(this) refers to the ajax object not form
        success: function (data) {
            location.reload();
            
            $("#team_table").load(" #team_table");
       //alert('Coach added to Team');
         document.getElementById("association_team_add_coach").reset();
        },
    });
    stay.preventDefault(); 
});
</script>

@endpush
@section('title', $Association->name.' - Association - '.$user->firstname.' '.$user->lastname)
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
          @include('user.include.myprofilesidebar')
          <!-- /.col -->
           <div class="col-md-9">
            <div class="card">
              
                  
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{'Association - '.$Association->name}}</h3>

           
          </div>
          
            
            
      
      <div class="col-lg-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="Manage-tab" data-toggle="pill" href="#Manage" role="tab" aria-controls="Manage" aria-selected="true">Manage</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " id="info-tab" data-toggle="pill" href="#info" role="tab" aria-controls="info" aria-selected="false">Info</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="payment-tab" data-toggle="pill" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Pay Your Coaches</a>
                  </li>
                 
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="Manage" role="tabpanel" aria-labelledby="Manage-tab">
                     <div class="col-md-12">
            
                         
                         
            <div class="card card-warning">
             
              <div class="card-body">
                  <form method="post" id="add_association_team" role="form">
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Skill Level</label>
                      <select required name='skill_level' class="form-control select2bs4" style="width: 100%;">
                   <option disabled selected ></option>
                   <option value="A">A</option>
                   <option value="AA">AA</option>                  
                   <option value="AAA">AAA</option>
                     
                  </select>
                      </div>
                    </div>
                      
                      <div class="col-sm-3">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Age Level</label>
                       <select required name='age_level' class="form-control select2bs4" style="width: 100%;">
                     <option disabled selected ></option>  
                   <option >Minor Atom</option>
                   <option >Major Atom</option>                  
                 
                   
                  </select>
                      </div>
                    </div>
                      
                       @php $end=date('Y')-5; $start=date('Y')-50; @endphp
                      <div class="col-sm-2">
                      <!-- text input -->
                      <div class="form-group">
                        <label>From Birth Year</label>
                       <select required name='from_year' class="form-control select2bs4" style="width: 100%;">
                           <option disabled selected ></option>
                    @for($i=$end; $i>=$start;$i--)
                   <option value="{{$i}}">{{$i}}</option>
                   
                       @endfor
                     
                  </select>
                      </div>
                    </div>
                      
                     
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label>To Birth Year</label>
                     <select required name='to_year' class="form-control select2bs4" style="width: 100%;">
                           <option disabled selected ></option>
                    @for($i=$end; $i>=$start;$i--)
                   <option value="{{$i}}">{{$i}}</option>
                   
                       @endfor
                     
                  </select>
                      </div>
                    </div>
                      
                      <div class="col-sm-2">
                <label style="color: beige"> +</label>
                <div class="form-group">
                    <button type="submit" id="add_team"  class="btn btn-success btn-sm">Add Team</button>
                </div>
            </div>
                  </div>
                 @csrf
                 <input type="hidden" value="{{$Association->id}}" name="association_id">
                      
                </form></div> 
                
                 <div id="team_view" class="card-body">
                      <form id="association_team_add_coach" role="form">
                 
                  <div class="row">
                    <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Select Coach</label>
                     <select required name="coach_id[]" class="form-control select2bs4" multiple  data-placeholder="Select Coaches" style="width: 100%;">
             <optgroup label="Coaches">
                
           @php $coaches=App\Models\User::all(); @endphp      
       @foreach($coaches as $coach)

       <option value="{{$coach->id}}" >{{$coach->firstname.' '.$coach->lastname}} ({{$coach->email}})</option>
       @endforeach
       
      
             </optgroup>                      
                                        </select>
                      </div>
                    </div>
                      
                      <div class="col-sm-5">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Select Team</label>
                       <select required name='association_team_id' class="form-control select2bs4" style="width: 100%;">
                     <option disabled selected ></option>  
                     @foreach($AssociationTeams as $AssociationTeam)

       <option value="{{$AssociationTeam->id}}" >{{$AssociationTeam->skill_level.' - '.$AssociationTeam->age_level}} ({{$AssociationTeam->from_year.' - '.$AssociationTeam->to_year}})</option>
       @endforeach
                      
                 
                   
                  </select>
                      </div>
                    </div>
                      
                 
                      
                     
                  
                      
                      <div class="col-sm-2">
                <label style="color: beige"> +</label>
                <div class="form-group">
                    <button type="submit" id="add_team"  class="btn btn-success btn-sm">Add Coach</button>
                </div>
            </div>
                  </div>
                 @csrf
                  <input type="hidden" value="{{$Association->id}}" name="association_id">
                      
                </form></div> 
              
            </div>
                         
                     </div>
                 <div class="card">
              <div class="card-header">
                <h3 class="card-title">{!!'Association - <b>'.$Association->name.'</b> - Teams'!!}</h3>
              </div>     
                     
                     
                     
                       <div class="card-body">
                           
                           
                           
                           
                           <table class="table table-striped projects" id="team_table">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 60%">
                          Team 
                      </th>
                      <th style="width: 30%">
                         Coaches
                      </th>
                      
                      <th style="width: 8%" class="text-center">
                          Status
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @php $i=1; @endphp
                    @foreach($AssociationTeams as $AssociationTeam)
                  <tr>
                      <td>
                          {{$i++}}
                      </td>
                      <td>
                          <a>
                             {{$AssociationTeam->skill_level.' - '.$AssociationTeam->age_level}} ({{$AssociationTeam->from_year.' - '.$AssociationTeam->to_year}})
                          </a>
                         
                      </td>
                      <td>
                          <ul class="list-inline">
                              
                             @php $team_coaches=DB::table('association_team_coaches')->where(['association_team_id'=>$AssociationTeam->id,'association_id'=>$Association->id])->get('user_id'); @endphp
                              @foreach($team_coaches as $team_coach)
                             <li class="list-inline-item">
                                  <img alt="{{App\Models\User::where('id',$team_coach->user_id)->value('firstname')}}" class="table-avatar" src="{{url('user_images/image/'.$team_coach->user_id)}}">
                              </li>
                              @endforeach
                              </li>
                          </ul>
                      </td>
                     
                      <td class="project-state">
                          <span class="badge badge-success">Active</span>
                      </td>
                      <td class="project-actions text-right">
                         
                      @php /*    <a class="btn btn-info btn-sm" href="#">
                              <i class="fas fa-pencil-alt">
                              </i>
                              
                          </a>
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              
                          </a>  */ @endphp
                      </td>
                  </tr>
                  
                    @endforeach
              </tbody>
          </table>
              </div>
          
                 </div>
          
                  </div>
                      
                      
                  <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                      <div class="row">
                          
                           <div class="col-md-12">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$Association->name}}</h3>
                <h5 class="widget-user-desc">{{$Association->sports}}</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{url('association/image/'.$Association->id)}}" alt="">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h6 class="description-header"><i class="fa fa-mobile"></i></h6>
                      <small class="description-text">{{$Association->phone}}</small>
                      
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h6 class="description-header">{{date("d M Y",strtotime($Association->season_start))}}</h6>
                     @if($Association->season_end)
                     to<br>
                       <h6 class="description-header">{{date("d M Y",strtotime($Association->season_end))}}</h6>
                      
                      @endif
                      
                  
                      
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h6 class="description-header"><i class="fa fa-envelope"></i></h6>
                      <small class="description-text-small">{{$Association->email}}</small>
                    </div>
                    <!-- /.description-block -->
                    
                    
                    
                  </div>
                  <!-- /.col -->
                  
                  
                  
                </div>
                  
                  <br>
                   <div class="col-sm-12 border-right">
                    <div class="description-block">
                  
                        @if($Association->address)
                      
                       <div class="card-body">
                <dl>
                  <dt>Address</dt>
                 {!! str_replace(array("\r\n", "\n", "\r"), "<br>", $Association->address)!!}
                 
                 
              </div>
                        
                        @endif
                      <button data-toggle="modal" data-target="#EditAssociation" class="btn btn-primary btn-sm">Edit</button> 
                    </div>
                    <!-- /.description-block -->
                    
                    
                   
                  </div>
                  
                <!-- /.row -->
              </div>
              
             
              
            </div>
            <!-- /.widget-user -->
          </div>
                          
                      </div>
                  </div>
                  <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                     Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna. 
                  </div>
                  
                </div>
              </div>
      </div>
      </div>
      
      
            
            
            
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
        
        @include('user.include.add_association_modal')
         @include('user.include.edit_association_modal')
  <!-- /.content-wrapper -->
@endsection