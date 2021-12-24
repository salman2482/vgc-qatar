@extends('layouts.admin')

@push('styles')
<!-- Select2 -->
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2/css/select2.min.css') !!}">
<link rel="stylesheet" href="{!! asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') !!}">

 <!-- Bootstrap Editor -->
 <link rel="stylesheet" href="{!! asset('assets/admin/plugins/summernote/summernote-bs4.css') !!}">
@endpush
@section('title', 'View Drills- ')
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

<script>

$( document ).ready(function() {

 
  
   $("#add_drill").click(function() {
     $("#add_new_drill").append('<div id="new_drill" class="modal-body">  <label>New Name</label>  <input required name="new_name" type="text" class="form-control" id="" placeholder="Drill New Name">  </div>');
     

  })
 
});
</script>


<script>


 function remove2(el) {
     
 
  var element = el;
  element.remove();
  
        }


</script>

<!-- bootatrap editor -->

<!-- Bootstrap 4 -->
<script src="{!! asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<!-- Summernote -->
<script src="{!! asset('assets/admin/plugins/summernote/summernote-bs4.min.js') !!}"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

@endpush

@section('content')

 <div class="content-wrapper">

  <!-- Tools&Sketchpad  -->

  <section class="content">
    <div class="container-fluid">   
      <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Tools & Sketchpad</h3>    
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <img src="{{url('assets/images/download.jpg')}}" style="width: 700px;height:300px;">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    <!-- Main content --><br>
    <section class="content">
      <div class="container-fluid">
          <div class="row"><hr>
          <div class="col-12">
          

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Drills</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <form method="post" action="{{url()->current()}}">          <!-- /.card-header -->
                        @csrf
                    <div class="card-body">
                     <div class="row">
                 
                    <!-- /.col -->
                    <div class="col-md-12">
                      <div class="card">
                      
                          
                          <div class="card-body">
                              <div class="tab-content">
                                  <div class="timeline-body">
                                      <div class="row">
                                          <div class="col-md-6">
                                              <label> Drill Name</label>
                                              <input value="{{$drill->name}}" required class="form-control " type="text" placeholder="Drill Name" name="name" disabled>
                                          </div>
                                          <div class="col-md-4">
                                              <label>Mins</label>
                                              <div class="form-group">
                      
                                                  <select name="mins" class="form-control select2bs4" style="width: 100%;" disabled>
                                                  @for($i=1;$i<=60;$i++)<!-- comment -->
          
                                                  <option @if($drill->mins==$i)selected @endif value="{{$i}}">{{$i}}</option>
          
                                                  @endfor
                                                  </select>
                                             
                                              </div>
                                          </div>
                                          <div class="col-md-2">
                                              <label>Rink</label>
                                              <div class="form-group">
          
                                                  <select name="surface" class="form-control select2bs4" style="width: 100%;" disabled>
                                                  @for($i=1;$i<=3;$i++)<!-- comment -->
          
                                                  <option @if($drill->surface==$i)selected @endif value="{{$i}}">Surface {{$i}}</option>
          
                                                  @endfor
                                                  </select>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row">
          
                                          <!-- /.col -->
                                          <div class="col-md-12">
                                                <div class="form-group">
                                                  <label for="exampleFormControlTextarea1">Sketchpad data</label>
                                                  <textarea name="sketchpad_data" value="{{ $drill->sketchpad_data }}" class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>{{ $drill->sketchpad_data }}</textarea>
                                                </div>
                                          </div>
                                      </div>
                                          
                      
                                          <div class="row">
          
                                              <!-- /.col -->
                                              <div class="col-md-12">
                                                   <label>Tags</label>
                                                  <div class="form-group">
                      
                                                      <select name="tags[]" class="form-control select2bs4" multiple data-placeholder="Select Tags" style="width: 100%;" disabled>
                                                          <optgroup  label="Tags">
          
          
                                                          <?php
                                                              foreach($tags as $tag)
                                                              {
                                                              $variableAry=explode(", ",$drill->tags); //you have array now
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
                                                  <?php  $variableAry=explode(", ",$drill->age_group);?>
                                                 <div class="form-group">
                     
                                                <select disabled required name="age_group[]" class="form-control select2bs4" multiple data-placeholder="Select Age Group" style="width: 100%;">
                                                 <option <?php if (in_array("8U & Under", $variableAry)) echo 'selected' ; ?> >8U & Under</option>
                                                 <option <?php if (in_array("9U to 12U", $variableAry)) echo 'selected' ; ?> >9U to 12U</option>
                                                 <option <?php if (in_array("13U & Above", $variableAry)) echo 'selected' ; ?> >13U & Above</option>
                     
                                                 </select>
                                                 </div>
                                                  <!-- /.form-group -->
                      
                      
                                              </div>
                                              <!-- /.col -->
                                          </div>      
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="card card-outline card-info">
                                                <div class="card-header">
                                                  <h3 class="card-title">
                                                    Notes
                                                  </h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body pad">
                                                  <div class="mb-3">
                                                    {!! $drill->notes !!}          
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- /.col-->
                                          </div>
                                          <!-- ./row -->
                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="card card-outline card-info">
                                                <div class="card-header">
                                                  <h3 class="card-title">
                                                    Description
                                                  </h3>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body pad">
                                                  <div class="mb-3">
                                                    {!! $drill->description !!}
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- /.col-->
                                          </div>
                                          <!-- ./row -->
                                          <div class="row">
                                            <div class="col-md-12">
                                              <label> Plan Name</label>
                                              <input value="" required class="form-control " type="text" placeholder="Plan Name" name="name" disabled>
                                          </div>
                                          </div>
                                          <br><div class="row">
                                              <!-- Right navbar links -->
                                    
                                      <nav class="navbar navbar-expand navbar-white navbar-light" style="background-color:#f1f1f1;padding:0">
                                          <ul class="navbar-nav ml-10">
                                          <!-- Messages Dropdown Menu -->
                                     @php /*     <li class="nav-item">
                                            <button id="add_drill" title="Save As" type="button" data-toggle="modal" data-target="#save_as" class="nav-link" >
                                       <i class="fa fa-copy"></i>
                                             
                                            </button>
                                              
                                          </li>
                                          
                                          */ @endphp
                                          <li class="nav-item bdicon">
                                            <button class="nav-link" title="Delete" type="button" data-toggle="modal" data-target="#drill_delete">
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
                  <!-- /.card -->
          
                  <div class="modal fade" id="save_as" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog modal-sm" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Save As New Drill</h5>
                          <button onclick="remove2(new_drill)" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                          <div id="add_new_drill">
                       
                              
                          </div>
                        <div class="modal-footer">
                          <button onclick="remove2(new_drill)" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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

 <div class="modal fade" id="drill_delete" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{$drill->name}}</h5>
        <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
         <!-- Modal body -->
      <div class="modal-body">
       Are you sure you want to delete this Drill? 
      </div>
         <form method="post" action="{{url($admin_url.'delete/drill')}}">
             <input type="hidden" value="{{$drill->id}}" name="drill_id">
             @csrf
      <div class="modal-footer">
        <button  type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button data-id="{{$drill->id}}" type="submit" class="btn btn-danger ">Yes</button>
      </div>
         </form>
    </div>
  </div>
</div>

@endsection