<div class="modal fade" id="manage_team" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
      
      
    <div class="modal-content">
       <!-- Modal Header -->
      <div class="modal-header">
        <h3 class="modal-title">Manage Team</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <form method="post" action="{{url('addTeam')}}">
         <!-- Modal body -->
      <div class="modal-body">
      <div class="col-lg-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="invite-tab" data-toggle="pill" href="#invite" role="tab" aria-controls="invite" aria-selected="true">Invite</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="info-tab" data-toggle="pill" href="#info" role="tab" aria-controls="info" aria-selected="false">Info</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="payment-tab" data-toggle="pill" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Pay Your Coaches</a>
                  </li>
                 
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="invite" role="tabpanel" aria-labelledby="invite-tab">
                     <label>Invite</label>  
          <input required name="team_name" type="text" class="form-control" id="" placeholder="Coach Name">  
          
          
          
                  </div>
                  <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                     Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam. 
                  </div>
                  <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                     Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna. 
                  </div>
                  
                </div>
              </div>
      </div>
      </div>
      </div>
      
             @csrf
     
         </form>
    </div>
  </div>
</div>