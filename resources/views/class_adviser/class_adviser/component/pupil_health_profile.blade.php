<div class="f-flex row col-12 border-none gap-1 justify-content-end mb-3">
    @if($activeSchoolYear['getRecord']->isNotEmpty())
    <form class="d-flex row col-12 border-none m-0 p-0 align-items-center"
        action="{{ route('class_adviser.class_adviser.search_pupil') }}">
        <div class="col-lg-3 col-sm-6 col-12 border-none px-2">
            <input type="search" class="col-lg-3 col-md-4 col-sm-6 col-12 border-none form-control border-dark"
                id="text-srh" name="name" value="{{ Request::get('name') }}" placeholder="Search Pupil w/ Name"
                pattern="[A-Za-z ]+" title="Please enter only letters">
        </div>
        <button type="submit" class="col-auto btn btn-info font-medium px-4">
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

@if(!empty(Request::get('name')))

<div class="d-flex justify-content-end mx-2">
    <a href="{{ route('class_adviser.class_adviser.search_pupil') }}"
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
                <td> {{ $value->last_name }}, {{ $value->first_name }}, {{ $value->middle_name }}, {{ $value->suffix }}
                </td>
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
                        <a class="dropdown-item d-flex align-items-center gap-3"
                            href="{{ route('class_adviser.class_adviser.search_pupil', ['search' => $value->lrn]) }}">
                            <i class="fs-4 ti ti-eye"></i>View Details
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $pupilBasicProfileByName['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links()
        !!}
    </div>

</div>


@endif

@if(count($pupilBasicProfile['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty())
@if(!empty(Request::get('search')))
@forelse($pupilBasicProfile['getList'] as $pupil)

<ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-light-info rounded-2" id="pills-tab"
    role="tablist">
    
    <li class="nav-item" role="presentation">
        <button
            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6 active"
            id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
            aria-controls="pills-profile" aria-selected="true">
            <i class="ti ti-user-circle me-2 fs-6"></i>
            <span class="d-none d-md-block">Learner's Profile</span>
        </button>
    </li>

    <!--<li class="nav-item" role="presentation">
        <button
            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
            id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab"
            aria-controls="pills-followers" aria-selected="false" tabindex="-1">
            <i class="ti ti-heart me-2 fs-6"></i>
            <span class="d-none d-md-block">Health Profile</span>
        </button>
    </li>-->

</ul>

<div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
    tabindex="0">
    <div class="d-flex row py-3">
        @include('class_adviser.class_adviser.widgets.pupil_basic_profile')
    </div>
</div>


@empty
<div class="alert alert-warning" role="alert">
    No search result. Please search for a pupil.
</div>
@endforelse

{!! $pupilBasicProfile['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

@else

@endif
@else
<div class="alert alert-warning px-4" role="alert">
    No search performed.
</div>
@endif
