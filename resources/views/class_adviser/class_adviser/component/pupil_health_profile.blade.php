<div class="f-flex row col-12 border-none gap-1 justify-content-end mb-3">
    @if($activeSchoolYear['getRecord']->isNotEmpty())
    <form class="d-flex row col-12 border-none m-0 p-0" action="{{ route('class_adviser.class_adviser.search_pupil') }}">
        <div class="col-lg-3 col-md-5 col-sm-6 col-12 border-none">
            <input type="search" class="col-lg-3 col-md-4 col-sm-6 col-12 border-none form-control border-dark"
                id="text-srh" name="search" value="{{ Request::get('search') }}" placeholder="Search Pupil's LRN">
        </div>
        <button type="search" class="col-auto btn btn-info font-medium px-4">
            Search
        </button>
    </form>
    @endif
    @if(count($pupilBasicProfile['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty() &&
    !empty(Request::get('search')))
    <a href="{{ route('class_adviser.class_adviser.search_pupil') }}"
        class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4">
        <i class="ti ti-square-minus me-2 fs-4 fw-semibold"></i>
        Clear Result
    </a>
    @endif

</div>

@if(count($pupilBasicProfile['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty())
@if(!empty(Request::get('search')))
@forelse($pupilBasicProfile['getList'] as $pupil)

<div class="card mt-2">
    <ul class="nav nav-pills user-profile-tab bg-light-primary" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-generalized-tab" data-bs-toggle="pill" data-bs-target="#pills-generalized" type="button" role="tab"
                aria-controls="pills-generalized" aria-selected="true">
                <span class="d-none d-md-block">Learner's Profile</span>
                <i class="ti ti-vacuum-cleaner ms-2 fs-6"></i>
            </button>
        </li>
        <!-- 
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-bmi-tab" data-bs-toggle="pill" data-bs-target="#pills-bmi" type="button" role="tab"
                aria-controls="pills-bmi" aria-selected="false" tabindex="-1">
                <span class="d-none d-md-block">Health Profile</span>
                <i class="ti ti-arrow-autofit-height ms-2 fs-6"></i>
            </button>
        </li>
        -->
    </ul>

    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-generalized" role="tabpanel" aria-labelledby="pills-generalized-tab" tabindex="0">
                    @include('class_adviser.class_adviser.widgets.pupil_basic_profile')
            </div>

            <div class="tab-pane fade show active" id="pills-bmi" role="tabpanel" aria-labelledby="pills-bmi-tab" tabindex="0">
                <div class="row">

                </div>
            </div>

        </div>
    </div>

</div>

@empty
<div class="alert alert-warning" role="alert">
    No search result. Please search for a pupil with ID.
</div>
@endforelse

{!! $pupilBasicProfile['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

@else

@endif
@else
<div class="alert alert-warning px-4" role="alert">
    No search performed. Please search for a pupil with LRN to add to your masterlist.
</div>
@endif
