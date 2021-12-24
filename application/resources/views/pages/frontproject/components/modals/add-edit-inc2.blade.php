@extends('layout.wrapper') @section('content')
    <!-- main content -->
    <div class="container-fluid">
        <div class="row page-titles">

            <div class="col-md-12 col-lg-5 align-self-center list-pages-crumbs" id="breadcrumbs">
                <h3 class="text-themecolor">Front View Projects</h3>
                <!--crumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">App</li>
                    
                    <li class="breadcrumb-item active"><a class="text-info" href="{{route('frontprojects.index')}}">Front Projects</a></li>

                    <li class="breadcrumb-item  active active-bread-crumb ">Front View Projects</li>
                </ol>
                <!--crumbs-->
            </div>

        </div>
        @if ($frontproject)
        <form action="{{ route('updateAddImgDesc', $frontproject->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card"
                style="background-color: #FFFFFF; padding-left: 25px; padding-right: 25px; flex: 1 1 auto; min-height: 1px; padding: 1.25rem;">
                <div class="card-body">
                    <div class="row" id="js-frontprojects-modal-add-edit">
                        <div class="col-lg-12">

                            <!--title<>-->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-sm-12  text-left control-label col-form-label required">
                                        Description*</label>
                                    <div class="col-sm-12 ">
                                        <textarea name="main_description" class="form-control form-control-sm"
                                            id="main_description" cols="30"
                                            rows="10">{{ $frontproject->main_description ?? '' }}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-sm-12 text-left control-label col-form-label required">
                                        Project Image*
                                        <input type="file" name="main_image" id="main_image" class="form-control">
                                    </label>

                                </div>
                            </div>
                            @if (isset($frontproject))
                                
                            @if ($frontproject->main_image != null)
                            
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <img src="{{asset('storage/public/project/'.$frontproject->main_image)}}" class="img-fluid" alt="No Pic">
                                </div>
                            </div>
                            @endif
                            @endif

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <input type="submit" class="btn btn-danger text-white form-control" value="Submit">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form> 


        @else
        <form action="{{ route('submitAddImgDesc') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card"
                style="background-color: #FFFFFF; padding-left: 25px; padding-right: 25px; flex: 1 1 auto; min-height: 1px; padding: 1.25rem;">
                <div class="card-body">
                    <div class="row" id="js-frontprojects-modal-add-edit">
                        <div class="col-lg-12">

                            <!--title<>-->
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-sm-12  text-left control-label col-form-label required">
                                        Description*</label>
                                    <div class="col-sm-12 ">
                                        <textarea name="main_description" class="form-control form-control-sm"
                                            id="main_description" cols="30"
                                            rows="10"></textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-sm-12 text-left control-label col-form-label required">
                                        Project Image*
                                        <input type="file" name="main_image" id="main_image" class="form-control">
                                    </label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <input type="submit" class="btn btn-danger text-white form-control" value="Submit">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </form>

        @endif
       


    </div>

@endsection
