<div class="clear-both"></div>

@if(!empty(session('success')))
<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('success') }}
</div>
@endif

@if(!empty(session('error')))
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('error') }}
</div>
@endif

@if(!empty(session('warning')))
<div class="alert alert-warning alert-dismissible bg-warning text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('warning') }}
</div>
@endif

@if(!empty(session('info')))
<div class="alert alert-info alert-dismissible bg-info text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('info') }}
</div>
@endif

@if(!empty(session('secondary')))
<div class="alert alert-secondary alert-dismissible bg-secondary text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('secondary') }}
</div>
@endif

@if(!empty(session('primary')))
<div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('primary') }}
</div>
@endif

@if(!empty(session('light')))
<div class="alert alert-light alert-dismissible bg-light text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('light') }}
</div>
@endif
