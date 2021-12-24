<div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{url('user_images/image/'.$user->id)}}" >
                  <form action="{{url('/user_images')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <input required type="file" class="form-control-file" name="profile_pic">
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </form>
                </div>

                <h3 class="profile-username text-center">{{$user->firstname.' '.$user->lastname}}</h3>

                <p class="text-muted text-center">{{$user->sports}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Drills</b> <a class="float-right">{{App\Models\Drill::where('user_id',$user->id)->count()}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Associations</b> <a class="float-right">{{App\Models\Association::where('creator_id',$user->id)->count()}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Plans</b> <a class="float-right">{{App\Models\Plan::where('user_id',$user->id)->count()}}</a>
                  </li>
                </ul>

              <button class="btn btn-default"   data-toggle="modal" data-target="#Change-password"><i class="fa fa-key"> </i> Change Password</button>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
<p>
  
  <button class="btn btn-info btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
   Associations
  </button>
</p>
<div class="collapse" id="collapseExample">
   
    
    
    <div class="card card-primary">
        
        <div class="card-body">
          <ul class="nav nav-treeview bgwhite">
              
              <span style="" data-toggle="modal" data-target="#AddAssociation"  type="button" class="btn btn-success btn-block"><b>Add Association +</b></span><hr>
          </ul>
      </div>
  <!-- /.card-header -->
      <div class="card-body">
         
              
           
          @php $Association=App\Models\Association::where(['creator_id'=>$user->id])->get(); @endphp
          @foreach($Association as $assoc)          
                  
            
                  <a href="{{url('association/'.$assoc->id)}}" class="nav-link">
                      <p>   <span class="btn btn-default"><i class="fa fa-file nav-icon"></i>  {{$assoc->name}}</span></p>
                  </a>
            
  
          @endforeach    
        
          
      </div>
  <!-- /.card-body -->
  </div>
</div>


  <!-- /.card -->
            <!-- About Me Box -->
            
            
            <br><!-- comment -->
            <br>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
         

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">{{$user->country}}</p>

                <hr>

               

               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>