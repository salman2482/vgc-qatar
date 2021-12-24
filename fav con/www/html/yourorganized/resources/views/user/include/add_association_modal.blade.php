<div style="padding-top: 100px" class="modal" id="AddAssociation">
  <div class="modal-dialog ">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Association</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
  <form method="post" action="{{url('add/association')}}" enctype="multipart/form-data">
      <!-- Modal body -->
      <div class="modal-body">
          
          @if(session()->has('add'))
  @foreach ($errors->all() as $error) <div class="alert alert-danger"> * {{ $error }} <br> </div> @endforeach
  
  @endif
    @csrf
 
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Association Name</label>
                  <input required type="text" name='association_name'  value="{{old('association_name')}}" class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                
                
                 <div class="col-md-12">
               
                <!-- /.form-group -->
              <div class="form-group">
                  <label> Sports</label>
                  <select required name='association_sports' class="form-control select2bs4" style="width: 100%;">
                       <optgroup  label="Sports">
                   <option @if($user->sports=="Basketball")selected @endif value="Basketball">Basketball</option>
                   <option @if($user->sports=="Soccer")selected @endif value="Soccer">Soccer</option>                  
                   <option @if($user->sports=="Volleyball")selected @endif value="Volleyball">Volleyball</option>
                       </optgroup>
                  </select>
                </div>
                <!-- /.form-group -->
              </div><br>
                
                 
                  <div class="col-md-6">
                <div class="form-group">
                  <label>Contact Number</label>
                  <input required type="tel" name='association_phone'  value="{{old('association_phone')}}" class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                
                  <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input required type="email" name='association_email' value="{{$user->email}}"  class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                
                
                  <div class="col-md-6">
                <div class="form-group">
                  <label>Season Start</label>
                  <input required type="date" name='association_start_date' value="{{old('association_start_date')}}"  class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                  <div class="col-md-6">
                <div class="form-group">
                  <label>Season End</label>
                  <input  type="date" name='association_end_date' value="{{old('association_end_date')}}"  class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                
                <div class="col-md-12">
                <div class="form-group">
                  <label>Association Logo</label>
                  <input  type="file" name='association_image'   class="form-control" style="width: 100%;">
                  
                </div>
              
              </div><br>
                
                 <div class="col-md-12">
                <div class="form-group">
                  <label>Address</label>
                  
                  <textarea name="association_address" class="form-control">{{old('association_address')}}</textarea>
                  
                  
                </div>
              
              </div>
                
              
            </div>
          
         
           
        </div>
        <!-- /.card -->
            
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
           <button class="btn btn-success bt-sm" type="submit">Add</button>
      </div>
 </form> 
    </div>
  </div>
</div> 