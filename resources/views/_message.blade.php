<div class="clear-both"></div>

@if(!empty(session('success')))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(!empty(session('error')))
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close">
        </button>
        <strong>{{ session('error') }}</strong>
    </div>
@endif

@if(!empty(session('warning')))
    <div class="alert alert-warning" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if(!empty(session('info')))
    <div class="alert alert-info" role="alert">
        {{ session('info') }}
    </div>
@endif

@if(!empty(session('secondary')))
    <div class="alert alert-secondary" role="alert">
        {{ session('secondary') }}
    </div>
@endif

@if(!empty(session('primary')))
    <div class="alert alert-primary" role="alert">
        {{ session('primary') }}
    </div>
@endif

@if(!empty(session('light')))
    <div class="alert alert-light" role="alert">
        {{ session('light') }}
    </div>
@endif