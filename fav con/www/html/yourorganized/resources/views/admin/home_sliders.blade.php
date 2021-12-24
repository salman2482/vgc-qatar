@extends('layouts.admin')
@push('styles')
@endpush

@push('scripts')
@endpush
@section('title', 'Home Sliders - ')
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
              <li class="breadcrumb-item"><a href="{{url($admin_url.'dashboard')}}">DashBoard</a></li>
              <li class="breadcrumb-item active">Home Sliders</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Slider</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                                    @foreach ($errors->all() as $error)
                              <div class="alert alert-danger"> * {{ $error }} <br> </div>
                             @endforeach
                             <form action="{{url()->current()}}" method="post" enctype="multipart/form-data" >
                <div class="card-body">
                  <div class="form-group">
                    <label >Image</label>
                    <input type="file" class="form-control" name="file" accept="image/*" required >
                  </div>
                     <div class="form-group">
                    <label >Caption</label>
                    <textarea class="form-control" name="title"   placeholder="Enter a caption for slide"></textarea>
                  </div>
                  <div class="form-group">
                    <label >Url</label>
                    <input type="url" class="form-control" name="url"  placeholder="">
                  </div>
                 @csrf
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
@if(session()->has('message')) <div class="alert alert-success"> {{ session()->get('message') }} <br> </div> @endif
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
             @foreach($homesliders as $homeslider)
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
               
                    
                <div class="card-body pt-0">
                    <img style="width:270px;height: 200px" src="{{url('assets/uploads/homesliders/'.$homeslider->id)}}.jpg">
                </div>
                <div class="card-footer">
                     <div class="card-header text-muted border-bottom-0">
                 {{Str::limit($homeslider->title, 150, $end='...')}}
                </div>
                     <form action="{{url($admin_url.'home/sliders/delete/'.$homeslider->id)}}" method="post">@csrf
                  <div class="text-right">
                      <a href="#" data-toggle="modal" data-target="#edit{{$homeslider->id}}"  class="btn btn-sm bg-teal">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                     
                          <button onclick="return confirm('Are you sure?')"  class="btn btn-sm btn-danger">
                      <i class="fas fa-trash"></i> Delete
                    </button>
                     
                  </div> </form>
                </div>
              </div>
            </div>
             
             
             <!-- Edit  Modal -->
             <div class="modal" id="edit{{$homeslider->id}}">
  <div class="modal-dialog ">
    <form action="{{url($admin_url.'home/sliders/edit/')}}" method="post">
    <div class="modal-content">

    

      <!-- Modal body -->
      <div class="modal-body">
         
                <div class="card-body">
                  <div class="form-group">
                    <label >Caption</label>
                    
                      <textarea class="form-control" name="title"   placeholder="Enter a caption for slide">{{$homeslider->title}}</textarea>
                    
                  </div>
                  <div class="form-group">
                    <label >Url</label>
                    <input value="{{$homeslider->url}}" type="url" class="form-control" name="url"  placeholder="">
                  </div>
                 @csrf
                 <input name="id" type="hidden" value="{{$homeslider->id}}"
                </div>
                <!-- /.card-body -->

              
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        
      </div>
      

    </div></form>
  </div>
</div> 
          </div>   
             
             @endforeach
             
          </div>
            {{$homesliders->links()}}
        </div>
        <!-- /.card-body -->
     
      </div>
      
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
 
  <!-- /.content-wrapper --> 
@endsection