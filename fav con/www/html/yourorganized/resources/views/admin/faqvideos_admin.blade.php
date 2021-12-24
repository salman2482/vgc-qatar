@extends('layouts.admin')
@push('styles')
@endpush

@push('scripts')
@endpush
@section('title', 'FAQ Youtube Videos - ')
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
              <li class="breadcrumb-item active">FAQ Youtube Videos</li>
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
                <h3 class="card-title">Add Video</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                                    @foreach ($errors->all() as $error)
                              <div class="alert alert-danger"> * {{ $error }} <br> </div>
                             @endforeach
              <form action="{{url($admin_url.'faq/youtube/videos')}}" method="post" >
                <div class="card-body">
                  <div class="form-group">
                    <label >Caption</label>
                    <input type="text" class="form-control" name="title" required  placeholder="Enter a caption for video">
                  </div>
                  <div class="form-group">
                    <label >Youtube Link</label>
                    <input type="url" class="form-control" name="url" required placeholder="Eg: https://www.youtube.com/watch?v=raSvts64wNg">
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
             @foreach($faqvideos as $faqvideo)
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
               
                    <?php
             $link = $faqvideo->url;
$video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
if (empty($video_id[1]))
    $video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..

$video_id = explode("&", $video_id[1]); // Deleting any other params
$video_id = $video_id[0];
                ?>
                <div class="card-body pt-0">
                   <iframe width="300" height="315"
src="https://www.youtube.com/embed/{{$video_id}}">
</iframe> 
                </div>
                <div class="card-footer">
                     <div class="card-header text-muted border-bottom-0">
                 {{Str::limit($faqvideo->title, 150, $end='...')}}
                </div>
                     <form action="{{url($admin_url.'faq/youtube/videos/delete/'.$faqvideo->id)}}" method="post">@csrf
                  <div class="text-right">
                      <a href="#" data-toggle="modal" data-target="#edit{{$faqvideo->id}}"  class="btn btn-sm bg-teal">
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
             <div class="modal" id="edit{{$faqvideo->id}}">
  <div class="modal-dialog ">
      <form action="{{url($admin_url.'faq/youtube/videos/edit')}}" method="post" >
    <div class="modal-content">

    

      <!-- Modal body -->
      <div class="modal-body">
         
                <div class="card-body">
                  <div class="form-group">
                    <label >Caption</label>
                    <input value="{{$faqvideo->title}}" type="text" class="form-control" name="title" required  placeholder="Enter a caption for video">
                  </div>
                  <div class="form-group">
                    <label >Youtube Link</label>
                    <input value="{{$faqvideo->url}}" type="url" class="form-control" name="url" required placeholder="Eg: https://www.youtube.com/watch?v=raSvts64wNg">
                  </div>
                 @csrf
                 <input name="id" type="hidden" value="{{$faqvideo->id}}"
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
            {{$faqvideos->links()}}
        </div>
        <!-- /.card-body -->
     
      </div>
      
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
 
  <!-- /.content-wrapper --> 
@endsection