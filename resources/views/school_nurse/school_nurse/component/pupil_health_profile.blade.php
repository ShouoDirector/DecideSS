<div class="f-flex row col-12 border-none gap-1 justify-content-end mb-3">
    @if($activeSchoolYear['getRecord']->isNotEmpty())
    <form class="d-flex row col-12 border-none m-0 p-0 align-items-center"
        action="{{ route('school_nurse.school_nurse.search_pupil') }}">
        <div class="col-lg-4 col-sm-6 col-12 border-none px-2">
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
    <a href="{{ route('school_nurse.school_nurse.search_pupil') }}"
        class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4">
        <i class="ti ti-square-minus me-2 fs-4 fw-semibold"></i>
        Clear Result
    </a>
    @endif

</div>

@if(!empty(Request::get('name')))

<div class="d-flex justify-content-end mx-2">
    <a href="{{ route('school_nurse.school_nurse.search_pupil') }}"
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
                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ti ti-tool fs-6"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-3"
                                    href="{{ route('school_nurse.school_nurse.search_pupil', ['search' => $value->lrn]) }}">
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
            class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6"
            id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab"
            aria-controls="pills-friends" aria-selected="false" tabindex="-1">
            <i class="ti ti-user-circle me-2 fs-6"></i>
            <span class="d-none d-md-block">Conduct Health Assessment</span>
        </button>
    </li>

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

<div class="tab-content" id="pills-tabContent">

    <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab" tabindex="0">

        <div class="row py-5">

            <div class="d-flex row justify-content-center">
                <div class="text-center mb-7">
                    <h3 class="fw-semibold">Conduct Health Assessment</h3>
                    <p class="fw-normal mb-0 fs-4">So pupil may be referred by the system to undergo healthcare services
                    </p>
                </div>
            </div>
            <div class="row justify-content-start">
                <div class="col-lg-8">

                    <div class="accordion accordion-flush mb-5 card position-relative overflow-hidden"
                        id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Vaccination
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    <div class="card-body py-0">
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="vaccination1A" id="vaccination1A-radio" value="Yes">
                                                    <label class="form-check-label"
                                                        for="vaccination1A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="vaccination1B" id="vaccination1B-radio" value="No"
                                                        checked="">
                                                    <label class="form-check-label" for="vaccination1B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    1. Has the pupil already been vaccinated?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="vaccination2A" id="vaccination2A-radio" value="Yes">
                                                    <label class="form-check-label"
                                                        for="vaccination2A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="vaccination2B" id="vaccination2B-radio" value="No"
                                                        checked="">
                                                    <label class="form-check-label" for="vaccination2B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    2. Is the pupil willing to get vaccinated?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="vaccination3A" id="vaccination3A-radio" value="Yes">
                                                    <label class="form-check-label"
                                                        for="vaccination3A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="vaccination3B" id="vaccination3B-radio" value="No"
                                                        checked="">
                                                    <label class="form-check-label" for="vaccination3B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    3. Have the pupil's parents or guardians provided consent for vaccination?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="vaccination4A" id="vaccination4A-radio" value="Yes">
                                                    <label class="form-check-label"
                                                        for="vaccination4A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="vaccination4B" id="vaccination4B-radio" value="No"
                                                        checked="">
                                                    <label class="form-check-label" for="vaccination4B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    4. Are there any known allergies or adverse reactions to <br>previous vaccinations?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item d-none">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    Feeding
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    <div class="card-body py-0">
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="feeding1A" id="feeding1A-radio" value="Yes">
                                                    <label class="form-check-label" for="feeding1A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="feeding1B" id="feeding1B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="feeding1B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    1. Is the pupil underweight?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="feeding2A" id="feeding2A-radio" value="Yes">
                                                    <label class="form-check-label" for="feeding2A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="feeding2B" id="feeding2B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="feeding2B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    2. Does the pupil often seem hungry?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="feeding3A" id="feeding3A-radio" value="Yes">
                                                    <label class="form-check-label" for="feeding3A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="feeding3B" id="feeding3B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="feeding3B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    3. Does the pupil lack energy?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="feeding4A" id="feeding4A-radio" value="Yes">
                                                    <label class="form-check-label" for="feeding4A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="feeding4B" id="feeding4B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="feeding4B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    4. Has there been a decline in academic performance?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="feeding5A" id="feeding5A-radio" value="Yes">
                                                    <label class="form-check-label" for="feeding5A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="feeding5B" id="feeding5B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="feeding5B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    5. Is there a noticeable change in growth?
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                    aria-expanded="false" aria-controls="flush-collapseThree">
                                    Deworming
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    <div class="card-body py-0">
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="deworming1A" id="deworming1A-radio" value="Yes">
                                                    <label class="form-check-label" for="deworming1A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="deworming1B" id="deworming1B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="deworming1B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    1. Has the pupil complained of stomach pain recently?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="deworming2A" id="deworming2A-radio" value="Yes">
                                                    <label class="form-check-label" for="deworming2A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="deworming2B" id="deworming2B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="deworming2B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    2. Has the pupil been diagnosed with parasitic worm infections?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="deworming3A" id="deworming3A-radio" value="Yes">
                                                    <label class="form-check-label" for="deworming3A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="deworming3B" id="deworming3B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="deworming3B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    3. Has the pupil received deworming treatment within the last six months?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="deworming4A" id="deworming4A-radio" value="Yes">
                                                    <label class="form-check-label" for="deworming4A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio"
                                                        name="deworming4B" id="deworming4B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="deworming4B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    4. Has the pupil displayed symptoms such as nausea or fatigue?
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingfour">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false"
                                    aria-controls="flush-collapsefour">
                                    Dentalcare
                                </button>
                            </h2>
                            <div id="flush-collapsefour" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    <div class="card-body py-0">
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="dental1A"
                                                        id="dental1A-radio" value="Yes">
                                                    <label class="form-check-label" for="dental1A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="dental1B"
                                                        id="dental1B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="dental1B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    1. Has the pupil experienced tooth pain or discomfort recently?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="dental2A"
                                                        id="dental2A-radio" value="Yes">
                                                    <label class="form-check-label" for="dental2A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="dental2B"
                                                        id="dental2B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="dental2B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    2. Does the pupil have bad breath?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="dental3A"
                                                        id="dental3A-radio" value="Yes">
                                                    <label class="form-check-label" for="dental3A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="dental3B"
                                                        id="dental3B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="dental3B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    3. Are there visible signs of tooth discoloration or decay in the pupil's teeth?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="dental4A"
                                                        id="dental4A-radio" value="Yes">
                                                    <label class="form-check-label" for="dental4A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="dental4B"
                                                        id="dental4B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="dental4B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    4. Does the pupil face difficulties in chewing or eating due to dental issues?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="dental5A"
                                                        id="dental5A-radio" value="Yes">
                                                    <label class="form-check-label" for="dental5A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="dental5B"
                                                        id="dental5B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="dental5B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    5. Does the pupil brush their teeth regularly?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Accordion Item Five -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingfive">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapsefive" aria-expanded="false"
                                    aria-controls="flush-collapsefive">
                                    Mental
                                </button>
                            </h2>
                            <div id="flush-collapsefive" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingfive" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    <div class="card-body py-0">
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental1A"
                                                        id="mental1A-radio" value="Yes">
                                                    <label class="form-check-label" for="mental1A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental1B"
                                                        id="mental1B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="mental1B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    1. Has the pupil been frequently expressing feelings of sadness or low mood?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental2A"
                                                        id="mental2A-radio" value="Yes">
                                                    <label class="form-check-label" for="mental2A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental2B"
                                                        id="mental2B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="mental2B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    2. Does the pupil encounter difficulties maintaining focus and concentration in school?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental3A"
                                                        id="mental3A-radio" value="Yes">
                                                    <label class="form-check-label" for="mental3A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental3B"
                                                        id="mental3B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="mental3B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    3. Have there been noticeable changes in the pupil's academic performance or grades recently?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental4A"
                                                        id="mental4A-radio" value="Yes">
                                                    <label class="form-check-label" for="mental4A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental4B"
                                                        id="mental4B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="mental4B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    4. Does the pupil experience stress or anxiety?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental5A"
                                                        id="mental5A-radio" value="Yes">
                                                    <label class="form-check-label" for="mental5A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental5B"
                                                        id="mental5B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="mental5B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    5. Are there any changes in the pupil's sleep patterns, such as difficulty sleeping or sleeping too much?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental5A"
                                                        id="mental6A-radio" value="Yes">
                                                    <label class="form-check-label" for="mental6A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental5B"
                                                        id="mental6B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="mental6B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    6. Has the pupil expressed thoughts of self-harm or suicide?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental5A"
                                                        id="mental7A-radio" value="Yes">
                                                    <label class="form-check-label" for="mental7A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="mental5B"
                                                        id="mental7B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="mental7B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    7. Is there any history of mental health concerns or conditions in the pupil or their family?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingsix">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapsesix" aria-expanded="false"
                                    aria-controls="flush-collapsesix">
                                    Eyes-related Questions
                                </button>
                            </h2>
                            <div id="flush-collapsesix" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingsix" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    <div class="card-body py-0">
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="eye1A"
                                                        id="eye1A-radio" value="Yes">
                                                    <label class="form-check-label" for="eye1A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="eye1B"
                                                        id="eye1B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="eye1B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">

                                                    1. Does the pupil experience difficulty seeing objects clearly up close, indicating nearsightedness?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="eye2A"
                                                        id="eye2A-radio" value="Yes">
                                                    <label class="form-check-label" for="eye2A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="eye2B"
                                                        id="eye2B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="eye2B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    2. Does the pupil struggle with clear vision at a distance, suggesting farsightedness?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="eye3A"
                                                        id="eye3A-radio" value="Yes">
                                                    <label class="form-check-label" for="eye3A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="eye3B"
                                                        id="eye3B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="eye3B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    3. Has the pupil been diagnosed with astigmatism, resulting in distorted or blurred vision?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="eye4A"
                                                        id="eye4A-radio" value="Yes">
                                                    <label class="form-check-label" for="eye4A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="eye4B"
                                                        id="eye4B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="eye4B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    4. Does the pupil complain of eye strain or discomfort?
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion Item Seven -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingseven">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseseven"
                                    aria-expanded="false" aria-controls="flush-collapseseven">
                                    Health and Wellness Question
                                </button>
                            </h2>
                            <div id="flush-collapseseven" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingseven" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    <div class="card-body py-0">
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="health1A"
                                                        id="health1A-radio" value="Yes">
                                                    <label class="form-check-label" for="health1A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="health1B"
                                                        id="health1B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="health1B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    1. Is the pupil active in school?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="health2A"
                                                        id="health2A-radio" value="Yes">
                                                    <label class="form-check-label" for="health2A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="health2B"
                                                        id="health2B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="health2B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    2. Does the pupil regularly engage in outdoor play or recreational activities
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="health3A"
                                                        id="health3A-radio" value="Yes">
                                                    <label class="form-check-label" for="health3A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="health3B"
                                                        id="health3B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="health3B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    3. Does the pupil exercise regularly?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="health4A"
                                                        id="health4A-radio" value="Yes">
                                                    <label class="form-check-label" for="health4A-radio">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input primary" type="radio" name="health4B"
                                                        id="health4B-radio" value="No" checked="">
                                                    <label class="form-check-label" for="health4B-radio">No</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    4. Is the pupil actively participating in any extracurricular activities, sports, or clubs?
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
        </div>
    </div>


</div>
</div>

<div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
    tabindex="0">
    <div class="row py-3">

        @include('school_nurse.school_nurse.widgets.pupil_basic_profile')

    </div>
    <div class="d-flex row p-0 mt-3 justify-content-between">
        <div class="col-md-6 p-0">
        @include('school_nurse.school_nurse.widgets.graphs')
        </div>
        <div class="col-md-6 p-0">
            @include('school_nurse.school_nurse.widgets.health_history')
        </div>
        
    </div>
            <div class="d-flex row p-0 mt-1">
            <div class="col-md-6 p-0">
            <!-- @include('school_nurse.school_nurse.widgets.pupil_beneficiary_records') -->
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
