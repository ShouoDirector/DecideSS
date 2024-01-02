<div class="f-flex row col-12 border-none gap-1 justify-content-end mb-3">
    @if($activeSchoolYear['getRecord']->isNotEmpty())
    <form class="d-flex row col-12 border-none m-0 p-0" action="{{ route('school_nurse.school_nurse.search_pupil') }}">
        <div class="col-lg-3 col-md-5 col-sm-6 col-12 border-none">
            <input type="search" class="col-lg-3 col-md-4 col-sm-6 col-12 border-none form-control border-dark"
                id="text-srh" name="search" value="{{ Request::get('search') }}" placeholder="Search Pupil with ID">
        </div>
        <button type="submit" class="col-auto btn btn-info font-medium px-4">
            Search
        </button>
    </form>
    @endif
    @if(count($pupilBasicProfile['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty() &&
    !empty(Request::get('search')))
    <a href="{{ route('school_nurse.school_nurse.search_pupil') }}"
        class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4">
        <i class="ti ti-square-minus me-2 fs-4 fw-semibold"></i>
        Clear Result
    </a>
    @endif

</div>

@if(count($pupilBasicProfile['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty())
@if(!empty(Request::get('search')))
@forelse($pupilBasicProfile['getList'] as $pupil)

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
        tabindex="0">
        <div class="d-flex row justify-content-center">
            <div class="col-md-5 d-flex align-items-stretch">
                <div class="card w-100 shadow-none rounded">
                    @include('school_nurse.school_nurse.widgets.pupil_basic_profile')
                    @include('school_nurse.school_nurse.widgets.pupil_beneficiary_records')

                </div>
            </div>

            <div class="col-md-7">
                @include('school_nurse.school_nurse.widgets.program_count')
                @include('school_nurse.school_nurse.widgets.graphs')
                @include('school_nurse.school_nurse.widgets.health_history')
            </div>

        </div>
    </div>
    <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
        <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
            <form class="position-relative">
                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                    placeholder="Search Followers">
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
            </form>
        </div>
        <div class="row">
            <div class=" col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body p-4 d-flex align-items-center gap-3">

                    </div>
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
