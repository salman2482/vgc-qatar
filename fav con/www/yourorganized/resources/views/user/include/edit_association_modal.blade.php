<div style="padding-top: 100px" class="modal" id="EditAssociation">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Association - {{$Association->name}}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
  <form method="post" action="{{url('update/association')}}" enctype="multipart/form-data">
      <!-- Modal body -->
      <div class="modal-body">
          
          @if(session()->has('update'))
  @foreach ($errors->all() as $error) <div class="alert alert-danger"> * {{ $error }} <br> </div> @endforeach
    @endif
 
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Association Name</label>
                  <input required type="text" name='association_name'  value="{{$Association->name}}" class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                
                
           @php /*      <div class="col-md-12">
               
                <!-- /.form-group -->
              <div class="form-group">
                  <label> Sports</label>
                  <select required name='association_sports' class="form-control select2bs4" style="width: 100%;">
                       <optgroup  label="Sports">
                   <option @if($Association->sports=="Basketball")selected @endif value="Basketball">Basketball</option>
                   <option @if($Association->sports=="Soccer")selected @endif value="Soccer">Soccer</option>                  
                   <option @if($Association->sports=="Volleyball")selected @endif value="Volleyball">Volleyball</option>
                       </optgroup>
                  </select>
                </div>
                <!-- /.form-group -->
              </div><br>
                */ @endphp
                 
                  <div class="col-md-6">
                <div class="form-group">
                  <label>Contact Number</label>
                  <input required type="tel" name='association_phone'  value="{{$Association->phone}}" class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                
                  <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input required type="email" name='association_email' value="{{$Association->email}}"  class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                
                
                  <div class="col-md-6">
                <div class="form-group">
                  <label>Season Start</label>
                  <input required type="date" name='association_start_date' value="{{$Association->season_start}}"  class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                  <div class="col-md-6">
                <div class="form-group">
                  <label>Season End</label>
                  <input  type="date" name='association_end_date' value="{{$Association->season_end}}"  class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                
                <div class="col-md-12">
                <div class="form-group">
                  <label>Change Association Logo</label>
                  <input  type="file" name='association_image'   class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                
                 <div class="col-md-12">
                <div class="form-group">
                  <label>Address</label>
                  
                  <textarea name="association_address" class="form-control">{{$Association->address}}</textarea>
                  
                  
                </div>
              
              </div>
                
              @csrf
              <input type="hidden" name="association_id" value="{{$Association->id}}">
            </div>
          
         
           
        </div>
        <!-- /.card -->
            
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button class="btn btn-success bt-sm" type="submit">Save</button>
      </div>
 </form> 
    </div>
  </div>
</div> 