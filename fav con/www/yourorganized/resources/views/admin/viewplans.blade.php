@extends('layouts.admin')

@push('styles')

<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}"> 
@endpush
@section('title', 'View Plan- ')
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

  })
</script>



@endpush

@section('content')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <!-- Main content --><br>
    <section class="content">
      <div class="container-fluid">
          <div class="row"><hr>
          <div class="col-12">
          

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Plans</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <form method="post" action="#">          <!-- /.card-header -->
                        @csrf
                    <div class="card-body">
                     <div class="row">
                 
                    <!-- /.col -->
                    <div class="col-md-12">
                      <div class="card">
                      
                          
                          <div class="card-body">
                              <div class="tab-content">
                                  <div class="timeline-body">
                                      
                                       <label> Plan Name</label>
                                       <input value="{{$plan->name}}" required class="form-control " type="text" placeholder="Plan Name" name="name" disabled>
                                      <br>
                                      
                                        <label>Date</label>
                                        <input value="{{date("Y-m-d",strtotime($plan->plan_time))}}" name="plan_time" required type="date" class="form-control" disabled>
                                        
                                      
                                        
                                      <br>
                                        @php $i=1000; @endphp
                                      @foreach($quicknotes as $quicknote)
                                    @php $i++; @endphp
                                    <div id="{{$quicknote->id}}" class="row">
                                              <div id="" class="col-md-12">                                   
                                                   <div class="row">
                                                          <div class="col-sm-6">
                                                      <!-- Select multiple-->
                                                      <label>Quick Note</label>
                                                              <div class="form-group">
                                                                  <input disabled value='{{$quicknote->notes}}' name="" type="text" class="form-control" id="" placeholder="Quick Note">
                                                              </div>
                      
                                                          </div>
                                                          <div class="col-sm-4">
                      
                                                             <label>Mins</label>
                                                              <div class="form-group">
                      
                                                                  <select disabled name="" class="form-control select2bs4" style="width: 100%;">
                                                              @for($i=1;$i<=60;$i++)<!-- comment -->
                 
                                                              <option @if($quicknote->mins==$i)selected @endif value="{{$i}}">{{$i}}</option>
          
                                                              @endfor
                                                              </select>
                                                             
                                                              </div>
                                                          </div>
                                                         
                                                      </div>
                                                  
                                                 
                                                  <!-- /.form-group -->
                                              </div>
                                              <!-- /.col -->
                      
                                          </div>
                                      
                                      
                                      @endforeach
                                          
                                          <div class="row">
          
                                              <!-- /.col -->
                                              <div class="col-md-12">
                                                   <label>Tags</label>
                                                  <div class="form-group">
                      
                                                      <select disabled name="tags[]" class="form-control select2bs4" multiple data-placeholder="Select Tags" style="width: 100%;">
                                                       <optgroup  label="Tags">
                        
                                                          
                                                         <?php
                                                     foreach($tags as $tag)
                                                      {
                                                       $variableAry=explode(", ",$plan->tags); //you have array now
                                                  foreach($variableAry as $var)
                                                  {
                                                      if($tag->name==$var){
                                                          $check='selected';
                                                          break;
                                                      }
                                                      else {  $check="";}
                                                  }
          
                                    ?>    
                                                      <option <?php echo $check;?> value="<?php echo $tag->name;?>"><?php echo $tag->name;?></option>
                                                      <?php } ?>
          
                                                           </optgroup>
                                                      </select>
                                                  </div>
                                                  <!-- /.form-group -->
                      
                      
                                                   <label>Age Group</label>
                                                   <?php  $variableAry=explode(", ",$plan->age_group);?>
                                                  <div class="form-group">
                      
                                                 <select disabled required name="age_group[]" class="form-control select2bs4" multiple data-placeholder="Select Age Group" style="width: 100%;">
                                                  <option <?php if (in_array("8U & Under", $variableAry)) echo 'selected' ; ?> >8U & Under</option>
                                                  <option <?php if (in_array("9U to 12U", $variableAry)) echo 'selected' ; ?>>9U to 12U</option>
                                                  <option <?php if (in_array("13U & Above", $variableAry)) echo 'selected' ; ?>>13U & Above</option>
                      
                                                  </select>
                                                  </div>
                                                  <!-- /.form-group -->
                      
                      
                                              </div>
                                              <!-- /.col -->
                                          </div>
                                          <!-- /.row -->
                                          <div class="row">
                                              <!-- Right navbar links -->
                                    
                                      <nav class="navbar navbar-expand navbar-white navbar-light" style="background-color:#f1f1f1;padding:0">
                                          <ul class="navbar-nav ml-10">
                                          <!-- Messages Dropdown Menu -->
                                          
                                            
                                            
                                               <li class="nav-item">
                                            <button class="nav-link" data-toggle="dropdown" href="#">
                                            <i class="fas fa-print"></i>
                                             
                                            </button>
                                              
                                          </li>
                                          
                                               
                                               <li class="nav-item bdicon">
                                            <button class="nav-link" title="Delete" type="button" data-toggle="modal" data-target="#plan_delete">
                                                 <i class="far fa-trash-alt"></i>
                                            </button>
                                              
                                          </li>
                                               
                                          </ul>
                                          </nav>
                                          </div><!-- /.row -->
                                          
                      
                                   </div>
                                      
                          </div> <!-- tab content -->
                      </div><!-- card body -->
          
                      </div>
                      <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                  </div>
                     
                  </div>
                        <div class="modal fade" id="save_as" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Save As New Plan</h5>
                  <button onclick="remove2(new_plan)" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <div id="add_new_plan">
               
                      
                  </div>
                <div class="modal-footer">
                  <button onclick="remove2(new_plan)" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button id="" type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </div>
          </div> 
                  <!-- /.card -->
                      </form> 
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
 </div>
 <div class="modal fade" id="plan_delete" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{$plan->name}}</h5>
        <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         <!-- Modal body -->
      <div class="modal-body">
       Are you sure you want to delete this Plan? 
      </div>
         <form method="post" action="{{url($admin_url.'delete/plan')}}">
             <input type="hidden" value="{{$plan->id}}" name="plan_id">
             @csrf
      <div class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button data-id="{{$plan->id}}" type="submit" class="btn btn-danger ">Yes</button>
      </div>
         </form>
    </div>
  </div>
</div> 

@endsection