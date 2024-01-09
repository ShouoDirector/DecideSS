<div class="f-flex row col-12 border-none gap-1 justify-content-end mb-3">
    @if($activeSchoolYear['getRecord']->isNotEmpty())
    <form class="d-flex row col-12 border-none m-0 p-0 align-items-center" action="{{ route('medical_officer.medical_officer.search_pupil') }}">
        <div class="col-lg-3 col-md-5 col-sm-6 col-12 border-none">
        <input type="search"
                    class="form-control col-lg-3 col-md-4 col-sm-6 col-12 border-dark
                            @if(count($pupilData['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty() &&
                                !empty(Request::get('search'))) is-valid border-success
                            @else
                                @if(!empty(Request::get('search'))) is-invalid
                                border-dark
                                @endif
                            @endif"
                    id="inputHorizontalDanger"
                    placeholder="Search Pupil w/ LRN"
                    value="{{ Request::get('search') }}"
                    name="search"
                    pattern="[0-9]{12}"
                    minlength="12"
                    maxlength="12"
                    title="LRN must be exactly 12 digits and contain only numbers">
        </div>
        or
        <div class="col-lg-4 col-sm-6 col-12 border-none px-2">
        <input type="search" class="col-lg-3 col-md-4 col-sm-6 col-12 border-none form-control border-dark"
    id="text-srh" name="name" value="{{ Request::get('name') }}"
    placeholder="Search Pupil w/ Name"
    pattern="[A-Za-z ]+" title="Please enter only letters">
        </div>
        <button type="submit" class="col-auto btn btn-info font-medium px-4">
            Search
        </button>
    </form>
    @endif
    @if(count($pupilBasicProfile['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty() &&
    !empty(Request::get('search')))
    <a href="{{ route('medical_officer.medical_officer.search_pupil') }}"
        class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4">
        <i class="ti ti-square-minus me-2 fs-4 fw-semibold"></i>
        Clear Result
    </a>
    @endif

</div>

@if(!empty(Request::get('name')))

<div class="d-flex justify-content-end mx-2">
<a href="{{ route('medical_officer.medical_officer.search_pupil') }}"
        class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4">
        <i class="ti ti-square-minus me-2 fs-4 fw-semibold"></i>
        Clear Result
    </a>
</div>

<div class="table-responsive w-100 pb-3 mt-3">
    <h5 class="mb-3">Results</h5>
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th></th>
                <th>LRN</th>
                <th>Full Name</th>
                <th>Current Age</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($pupilBasicProfileByName['getList']) === 0)
            <tr>
                <td colspan="14" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($pupilBasicProfileByName['getList'] as $value)
            <tr>
            <td>{{ $loop->index + 1 + ($pupilBasicProfileByName['getList']->perPage() * 
                                ($pupilBasicProfileByName['getList']->currentPage() - 1)) }}</td>
            <td> {{ $value->lrn }} </td>
            <td> {{ $value->last_name }}, {{ $value->first_name }}, {{ $value->middle_name }}, {{ $value->suffix }}</td>
            <td>
                @php
                $dob = DateTime::createFromFormat('Y-m-d', $value->date_of_birth);
                $age = $dob->diff(Carbon\Carbon::now())->y;
                echo $age;
                @endphp
                years old
            </td>
            <td> {{ $value->gender }}</td>
                <td>
                    <div class="dropdown dropstart">
                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ti ti-tool fs-6"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-3"
                                    href="{{ route('medical_officer.medical_officer.search_pupil', ['search' => $value->lrn]) }}">
                                    <i class="fs-4 ti ti-edit"></i>Pupil Profile
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
            {!! $pupilBasicProfileByName['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>


@endif

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
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-health-tab" data-bs-toggle="pill" data-bs-target="#pills-health" type="button" role="tab"
                aria-controls="pills-health" aria-selected="false" tabindex="-1">
                <span class="d-none d-md-block">Health Profile</span>
                <i class="ti ti-arrow-autofit-height ms-2 fs-6"></i>
            </button>
        </li>
    </ul>

    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-generalized" role="tabpanel" aria-labelledby="pills-generalized-tab" tabindex="0">
                    @include('medical_officer.medical_officer.widgets.pupil_basic_profile')
            </div>

            <div class="tab-pane fade show active" id="pills-health" role="tabpanel" aria-labelledby="pills-health-tab" tabindex="0">
                <div class="row">

                <div class="d-flex row">
                    <div class="col-md-8">
                        @include('medical_officer.medical_officer.widgets.health_history')
                    </div>
                    <div class="col-md-4">
                    @include('medical_officer.medical_officer.widgets.pupil_beneficiary_records')
                    </div>
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