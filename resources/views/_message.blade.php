<div class="clear-both"></div>

@if(!empty(session('errorDeletedAccountLoginMessage')))
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    Your account is deleted.
</div>
@endif

@if(!empty(session('error_add_account_failed')))
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('error_add_account_failed') }}
</div>
@endif

@if(!empty(session('errorLogin')))
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('errorLogin') }}
</div>
@endif

@if(!empty(session('success')))
<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('success') }}
</div>
@endif

@if(!empty(session('another_error')))
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('error') }}
</div>
@endif

@if(!empty(session('error')))
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    An error occurred while processing your request. Please try again later.
    <i class="ti ti-info-circle fs-5 card-subtitle mb-3" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-original-title="{{ session('error') }}"></i>
</div>
@endif

@if(!empty(session('error2')))
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('error2') }}
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
