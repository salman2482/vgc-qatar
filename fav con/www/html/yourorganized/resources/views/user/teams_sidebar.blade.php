<div class="col-md-3">

           
            <div class="card card-primary">
              <div class="card-header">
                {{-- <div class="title-bar-area">
                    <span class="reload-icon">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </span> --}}
                    <h3 class="card-title">My Teams</h3>
                {{-- </div> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
         
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
            
            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link">
                    <p>
                        TEAMS <i title="Add Team" style="color:green;padding-left: 10px" data-toggle="modal" data-target="#new_team" class="fa fa-plus"></i>
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview bgwhite">
                   <hr style="border-color: red">  
                  
                    <li class="nav-item">
                       <a class="nav-link">
                            <i style="color:red" class="far fa-user-circle nav-icon"></i>
                        <p><b>My Teams</b><span class="badge badge-warning right">{{$teams->count()}}</span> </p>
                        </a>
                    </li>
                    
         
                
                
                    @foreach($teams as $tm)
                    
                   
                   
                    <li class="nav-item has-treeview">
                <a href="{{url('team/'.$tm->id)}}" class="nav-link">
                    <p>
                        <i class="far fa-user-circle nav-icon"></i> {{Str::limit($tm->name,15)}} 
                    <i class="right fas fa-cogs"></i>
                    </p>
                </a>
                       
                   
                    </li>
                  
                    @endforeach
                    
                </ul>
            </li>
                
        </ul>
               
               

               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>