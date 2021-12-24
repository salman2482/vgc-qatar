@extends('layouts.admin')
@push('styles')
 
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endpush

@push('scripts')
   

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    
   
        <script type="text/javascript">

        $(document).ready(function() {

         $('.summernote').summernote({

               height: 300,width: 1200,
                toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]

          });

       });
       
       
       

    </script>


@endpush
@section('title', $faq_lists->title.' - Manage FAQ - ')
@section('content')

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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DashBoard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <h5 class="mt-4 mb-2"></h5>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$faq_lists->title}}</h3>
               
              </div>
                <div class="card-header">
                <h3 class="card-title">
                 <a href="{{url()->current()}}/delete/" onclick="return confirm('Are you sure?')"  class="btn btn-sm btn-danger">
                      <i class="fas fa-trash"></i> Delete All
                    </a></h3>
              </div>
                <div class="card-header">
                        <form method="post" action="{{url()->current()}}" enctype="multipart/form-data">
                    @csrf
                <div class="input-group " style="">
                    
                        <input type="text" class="form-control" placeholder="Add new question" name="question" required >
                        <input type="hidden" value="{{$faq_lists->id}}"  name="category_id" >
                        
                   
              </div>
                    
                    <div class="input-group " style="">
                    
                        <textarea class="form-control summernote" placeholder="Answer" name="answer" required ></textarea>
                  
              </div>
                    
                    <br>
                    
                    <div class="input-group " style="">
                    
                        
                    <span class="input-group-btn">
                        <button name="" type="submit" class="btn btn-primary">Add</button>
                    
                    </span>
              </div>
                    </form>
            </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="accordion">
                 
                @php $faqs=App\Models\Faq::where('category_id',$faq_lists->id)->get(); @endphp
                
                @foreach($faqs as $faq)
                
                  <div class="card card-success">
                    <div class="card-header">
                      <h4 class="card-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$faq->id}}">
                        {{$faq->question}}
                        </a>
                      </h4>
                    </div>
                    <div id="collapse{{$faq->id}}" class="panel-collapse collapse">
                      <div class="card-body">
                         {!!$faq->answer!!}
                      </div>
                        
                   @php /*     <button class="btn btn-sm btn-warning">
                      <i class="fas fa-edit"></i> Edit
                    </button>
                   
                   */ @endphp
                        <a href="{{url()->current()}}/delete/{{$faq->id}}" onclick="return confirm('Are you sure?')"  class="btn btn-sm btn-danger">
                      <i class="fas fa-trash"></i> Delete
                    </a>
                    </div>
                  </div>
                
                @endforeach
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
         
        </div>
        <!-- /.row -->
        <!-- END ACCORDION & CAROUSEL-->
     
  </div>
     </section>
    
 </div>

@endsection