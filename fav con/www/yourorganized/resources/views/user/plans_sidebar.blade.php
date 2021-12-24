 <!-- <input class="form-control brand-text" type="text" placeholder="Search Plans" aria-label="Search"> -->        
      
  
  @php $planTags=DB::table('plan_tags')->orderby('name','asc')->get(); @endphp
 
    <div class="sidebar" style="background-color: #26af60;">
      <!-- Sidebar user (optional) -->
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              
              <p>
                PERSONAL
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bgwhite h-auto">
                
                 @foreach($planTags as $planTag)
                    
                    @php $myTaggedPlans=App\Models\Plan::where('user_id',$user->id)->where('tags', 'LIKE', '%'.$planTag->name.'%')->get(); @endphp
                   @if($myTaggedPlans->count())
              <li class="nav-item">
                <div class="nav-link">
                
                    <p class="plan-name"> <i class="far fa-folder-open nav-icon"></i>  {{$planTag->name}}<span style="background-color: #26af60;" class="badge badge-success right">{{$myTaggedPlans->count()}}</span>
                    <i class="right fas fa-angle-left"></i></p>
                  <div class="plan-sub">
                     @foreach($myTaggedPlans as $myTaggedPlan)
                    
                     <br><a style="color:#26af60; padding: 10px" href="{{url('plan/'.$myTaggedPlan->id)}}"> <i style="color:black;" class="far fa-eye"> </i> {{$myTaggedPlan->name}}</a>
                  
                     @endforeach
                  </div>
                </div>
              </li>
              
               @endif
               @endforeach
                   <li class="nav-item">
                <a  class="nav-link">
                <i class="far fa-trash-alt"></i>
                  <p> Trash</p>
                   <i class="far fa-trash-alt" style="float: right;margin-top: 5px;"></i>
                </a>
              </li>
            </ul>
          </li>
          
           @php   /* 
            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              
              <p>
                PERSONAL
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bgwhite h-auto">
              <li class="nav-item">
                <a  class="nav-link">
                <i class="far fa-folder-open nav-icon"></i>
                  <p class="plan-name">Plan 1</p>
                  <div class="plan-sub">
                    <p><span>&gt;</span>Sub 1</p>
                    <p><span>&gt;</span>Sub 2</p>
                    <p><span>&gt;</span>Sub 3</p>
                  </div>
                </a>
              </li>
              
          
             <li class="nav-item">
                <a  class="nav-link">
                <i class="far fa-folder-open nav-icon"></i>
                  <p class="plan-name">Plan 1</p>
                  <div class="plan-sub">
                    <p><span>&gt;</span>Sub 1</p>
                    <p><span>&gt;</span>Sub 2</p>
                    <p><span>&gt;</span>Sub 3</p>
                    <p><span>&gt;</span>Sub 1</p>
                    <p><span>&gt;</span>Sub 2</p>
                    <p><span>&gt;</span>Sub 3</p>
                   <p><span>&gt;</span>Sub 1</p>
                    <p><span>&gt;</span>Sub 2</p>
                    <p><span>&gt;</span>Sub 3</p>
                  </div>
                </a>
              </li>
              
            
              <li class="nav-item">
                <a  class="nav-link">
                <i class="far fa-folder-open nav-icon"></i>
                  <p class="plan-name">Plan 1</p>
                  <div class="plan-sub">
                    <p><span>&gt;</span>Sub 1</p>
                    <p><span>&gt;</span>Sub 2</p>
                    <p><span>&gt;</span>Sub 3</p>
                  </div>
                </a>
              </li>
                   <li class="nav-item">
                <a  class="nav-link">
                <i class="far fa-trash-alt"></i>
                  <p> Trash</p>
                   <i class="far fa-trash-alt" style="float: right;margin-top: 5px;"></i>
                </a>
              </li>
            </ul>
          </li>
          
            */
              @endphp
            
         <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              
              <p>
                        TEAMS <i title="Add Team" style="color:green;padding-left: 10px" data-toggle="modal" data-target="#new_team" class="fa fa-plus"></i>
                    <i class="right fas fa-angle-left"></i>
                    </p>
            </a>
           <ul class="nav nav-treeview bgwhite">
                   <hr style="border-color: red">  
                  @php $teams=App\Models\Team::where('creator_id',$user->id)->get(); @endphp
                    <li class="nav-item">
                       <a class="nav-link">
                            <i style="color:red" class="far fa-user-circle nav-icon"></i>
                        <p><b>My Teams</b><span class="badge badge-warning right">{{$teams->count()}}</span> </p>
                        </a>
                    </li>
                    
         
                
                
                    @foreach($teams as $team)
                    
                   
                   
                    <li class="nav-item has-treeview">
                <a href="{{url('team/'.$team->id)}}" class="nav-link">
                    <p>
                        <i class="far fa-user-circle nav-icon"></i> {{Str::limit($team->name,15)}} 
                    <i class="right fas fa-cogs"></i>
                    </p>
                </a>
                       
                   
                    </li>
                  
                    @endforeach
                    
                 
                    
                </ul>
          </li>
             <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              
              <p>
                ASSOCIATION
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bgwhite">
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              
              <p>
              MARKET PLACE
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bgwhite">
              <li class="nav-item">
                <a href="account/index.html" class="nav-link">
                <i class="far fa-folder-open nav-icon"></i>
                  <p>Recent</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="account/index2.html" class="nav-link">
                  <i class="far fa-folder-open nav-icon"></i>
                  <p>Untagged</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="account/index3.html" class="nav-link">
                  <i class="far fa-folder-open nav-icon"></i>
                  <p>Defence</p>
                </a>
              </li>
                   <li class="nav-item">
                <a href="account/index3.html" class="nav-link">
                 <i class="far fa-folder-open nav-icon"></i>
                  <p> News Letter</p>
               
                </a>
              </li>
            </ul>
          </li>
            
            
               <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              
              <p>
                SHARED
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview bgwhite">
              <li>
                </li>
            </ul>
          </li>
            
            
            
            
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    
    <style type="text/css">
.plan-sub {
  display: none;
}
.plan-sub p {
    display: block;
    width: 100%;
    padding-left: 33px;
}
.plan-name:hover {
  cursor: pointer;
}
.h-auto {
  height: auto!important;
}
.plan-sub span {
  display:inline-block;
  margin-right: 10px;
}
.plan-sub-show {
  display: block;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  $('.plan-name').click(function(e) {
      if( $(e.target).hasClass('plan-sub-show')) {
        $(this).removeClass('plan-sub-show');
        $(this).next('.plan-sub').css('display','none');
      }
      else {
        $('.plan-sub').css('display','none');
        $(this).addClass('plan-sub-show');
        $(this).next('.plan-sub').css('display','block');
      }
     // $('.plan-sub').css('display','none');
     // $(this).next('.plan-sub').css('display','block');
     // $(this).addClass('plan-sub-show');
  })
</script>
 
