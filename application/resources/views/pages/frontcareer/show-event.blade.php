@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles justify-content-center">
    <!-- page content -->
        <div class="col-6">
            <div class="card">
                <div class="card-header">Front career Details</div>
                <div class="card-body">
                    <label >ID</label>
                    <p class="text-muted">{{ $frontcareer->id }}</p>
                    <label>Title</label>
                    <p class="text-muted">{{ $frontcareer->title ?? 'not found'}}</p>
                    <label>Experience</label>
                    <p class="text-muted">{{ $frontcareer->experience ?? 'not found'}}</p>
                    <label>Category</label>
                    <p class="text-muted">{{ $frontcareer->category ?? 'not found'}}</p>
                    <label>Salary</label>
                    <p class="text-muted">{{ $frontcareer->salary ?? 'not found'}}</p>
                    <label>Position Applied For</label>
                    <p class="text-muted">{{ $frontcareer->position ?? 'not found'}}</p>
                    <label>Status</label>
                    <p class="text-muted">{{ $frontcareer->status ?? 'not found'}}</p>
                    @foreach($attachments as $attachment)
                        @if ($attachment->attachment_unique_input === 'frontcareer')
                            <img src="{{ asset('storage/files/'.$attachment->attachment_uniqiueid.'/'.$attachment->attachment_filename) }}" class="x-logo justify-content-center" width="250px" height="250px" style="margin-top:30px">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--page content -->

</div>
<!--main content -->
@endsection