@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Materials Details</div>
                <div class="card-body">
                    <label >ID</label>
                    <p class="text-muted">{{ $material->id }}</p>
                    <label>Material Name</label>
                    <p class="text-muted">{{ $material->title }}</p>
                    <label>Amount</label>
                    <p class="text-muted">{{ $material->amount }}</p>
                    <label>Available Stock</label>
                    <p class="text-muted">{{ $material->available_stock }}</p>
                    <label>Category</label>
                    <p class="text-muted">{{ $material->category }}</p>
                    <label>Description</label>
                    <p class="text-muted">{{ $material->description }}</p>
                    <label>Category</label>
                    <p class="text-muted">{{ $material->category }}</p>
                    @foreach($attachments as $attachment)
                        <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="400px" height="300px" style="margin-top:30px">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
@endsection