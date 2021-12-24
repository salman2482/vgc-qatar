@if (session()->has('insert'))
    <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
        <strong>{{ session()->get('insert') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('update'))
    <div class="alert alert-primary alert-dismissible fade show" id="success-alert" role="alert">
        <strong>{{ session()->get('update') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" id="success-alert" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
