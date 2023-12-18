<div class="f-flex row col-12 border-none gap-1 justify-content-end mb-3">
    @if($activeSchoolYear['getRecord']->isNotEmpty())
    <form class="d-flex row col-12 border-none m-0 p-0" action="{{ route('class_adviser.class_adviser.search_pupil') }}">
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

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
        tabindex="0">
        <div class="d-flex row justify-content-center">
            <div class="col-md-5 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold">Pupil's Basic Profile Information</h5>
                        <p class="card-subtitle">The information below can only be seen by the authorized users</p>
                        <div class="mt-9 py-6 d-flex align-items-center">
                            <div
                                class="flex-shrink-0 bg-light-primary rounded-circle round d-flex align-items-center justify-content-center">
                                <i class="ti ti-user text-primary fs-6"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 fw-semibold">{{ $pupil->first_name }} {{ $pupil->middle_name }}
                                    {{ $pupil->last_name }}@if(!empty($pupil->suffix)), @endif {{ $pupil->suffix }}</h6>
                                <span class="fs-3">Name</span>
                            </div>
                            <div class="ms-auto">
                                <span class="fs-2"> </span>
                            </div>
                        </div>
                        <div class="py-6 d-flex align-items-center">
                            <div
                                class="flex-shrink-0 bg-light-danger rounded-circle round d-flex align-items-center justify-content-center">
                                <i class="ti ti-bookmark fs-6 text-danger"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 fw-semibold">{{ $pupil->lrn }}</h6>
                                <span class="fs-3">Learner Reference Number</span>
                            </div>
                            <div class="ms-auto">
                                <span class="fs-2">LRN</span>
                            </div>
                        </div>
                        <div class="py-6 d-flex align-items-center">
                            <div
                                class="flex-shrink-0 bg-light-success rounded-circle round d-flex align-items-center justify-content-center">
                                <i
                                    class="{{ ($pupil->gender == 'Male' || $pupil->gender == 'Female') ? ($pupil->gender == 'Female' ? 'ti ti-gender-female' : 'ti ti-gender-male') : 'default-gender-class' }} fs-6 text-success"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 fw-semibold">{{ $pupil->gender }}</h6>
                                <span class="fs-3">Gender</span>
                            </div>
                            <div class="ms-auto">
                                <span class="fs-2"><i
                                        class="{{ ($pupil->gender == 'Male' || $pupil->gender == 'Female') ? ($pupil->gender == 'Female' ? 'ti ti-gender-female' : 'ti ti-gender-male') : 'default-gender-class' }} fs-6 text-success"></i></span>
                            </div>
                        </div>
                        <div class="py-6 d-flex align-items-center">
                            <div
                                class="flex-shrink-0 bg-light-warning rounded-circle round d-flex align-items-center justify-content-center">
                                <i class="ti ti-cast text-warning fs-6"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 fw-semibold ">{{ $pupil->pupil_guardian_name }}</h6>
                                <span class="fs-3">Guardian Name & Phone Number</span>
                            </div>
                            <div class="ms-auto">
                                <span class="fs-2">{{ $pupil->pupil_guardian_contact_no }}</span>
                            </div>
                        </div>
                        <div class="pt-6 d-flex align-items-center">
                            <div
                                class="flex-shrink-0 bg-light-info rounded-circle round d-flex align-items-center justify-content-center">
                                <i class="ti ti-mail text-info fs-6"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 fw-semibold">{{ $pupil->barangay }} {{ $pupil->municipality }},
                                    {{ $pupil->province }}</h6>
                                <span class="fs-3">Address</span>
                            </div>
                            <div class="ms-auto">
                                <span class="fs-2"> </span>
                            </div>
                        </div>
                        <hr>
                        <div class="pt-0 d-flex align-items-center mb-1">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center">
                                <i class="ti ti-calendar text-info fs-6"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 fw-semibold"></h6>
                                <span class="fs-3">Recorded when</span>
                            </div>
                            <div class="ms-auto d-flex row">
                                <span
                                    class="fs-2">{{ \Carbon\Carbon::parse($pupil->created_at)->format('F d, Y H:i:s') }}</span>
                            </div>

                        </div>
                        <div class="pt-0 d-flex align-items-center mb-1">
                            <div class="flex-shrink-0 d-flex align-items-center justify-content-center">
                                <i class="ti ti-calendar text-info fs-6"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 fw-semibold"></h6>
                                <span class="fs-3">Updated when</span>
                            </div>
                            <div class="ms-auto d-flex row">
                                <span
                                    class="fs-2">{{ \Carbon\Carbon::parse($pupil->updated_at)->format('F d, Y H:i:s') }}</span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            @foreach($nsrRecords['getRecords'] as $na)
            @if(isset($na->nsr_id))

            <div class="col-md-7">
                <div class="card shadow-none m-0 p-4">
                    <h5 class="card-title fw-semibold">Health History</h5>
                    <p class="card-subtitle mb-0">Below are the nutritional assessments of the pupil</p>
                </div>

                <div class="card p-3">
                    @php
                    $pnaParts = explode('-', $na->pna_code);

                    // Accessing each part
                    $class_adviser_id = $pnaParts[0] ?? '';
                    $class_id = $pnaParts[1] ?? '';
                    $section_id = $pnaParts[2] ?? '';
                    $lrn = $pnaParts[3] ?? '';
                    @endphp
                    <div class="card-body p-2">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title mb-0">Grade {{ $gradeName[$na->class_id] }} - Section
                                {{ $className[$na->class_id] }}</h4>
                            <h6 class="w-auto ms-auto m-0">
                                Class Adviser | {{ $adviserName[$class_adviser_id] }}
                            </h6>
                            <div class="dropdown p-1">
                                
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-1"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-eye"></i>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1">
                                    <a class="dropdown-item cursor-pointer d-flex align-items-center gap-1"
                                        href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#na-notes-modal">
                                        <i class="ti ti-eye fs-5"></i>See Notes</a>
                                </div>
                                @include('class_adviser.class_adviser.modals.na-notes-modal')
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mt-4 justify-content-between">
                    <div class="p-2 display-5
                        @if($na->bmiCategory === 'Overweight')
                            text-warning
                        @elseif($na->bmiCategory === 'Obese')
                            text-danger
                        @elseif($na->bmiCategory === 'Normal')
                            text-success
                        @elseif($na->bmiCategory === 'Wasted')
                            text-warning
                        @elseif($na->bmiCategory === 'Severely Wasted')
                            text-danger
                        @endif">
                            <i class="ti ti-report-medical"></i>
                            <span>{{ $na->bmi }} <sup class="fs-5"> kg m<sup>2</sup></sup></span>
                        </div>
                        <div class="">
                            <div class="p-2 d-flex align-items-center">
                                <h3 class="mb-0 px-2">{{ $na->bmiCategory }}</h3>
                                <div class="d-block spinner-grow {{ $na->bmiColorSpinner }} spinner-grow-sm"
                                    role="status"></div>
                            </div>
                            <div>
                                <small>Body Mass Index</small><br>
                                <small>Height For Age : {{ $na->hfaCategory }}</small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-borderless">
                        <tbody class="d-flex justify-content-around">
                            <tr class="d-flex flex-col">
                                <td class="fw-semibold">Height</td>
                                <td class="font-weight-medium py-0">{{ $na->height }} m</td>
                            </tr>
                            <tr class="d-flex flex-col">
                                <td class="fw-semibold">Weight</td>
                                <td class="font-weight-medium py-0">{{ $na->weight }} kg</td>
                            </tr>
                            <tr class="d-flex flex-col">
                                <td class="fw-semibold">Recorded When</td>
                                <td class="font-weight-medium py-0">{{ $na->created_at }}</td>
                            </tr>
                            <tr class="d-flex flex-col">
                                <td class="fw-semibold">Last Update</td>
                                <td class="font-weight-medium py-0">{{ $na->updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <table class="table table-borderless">
                        <tbody class="d-flex justify-content-around">
                            <tr class="d-flex flex-col">
                                <td class="fw-semibold">Dewormed</td>
                                <td class="font-weight-medium py-0">{{ $na->is_dewormed == 1 ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr class="d-flex flex-col">
                                <td class="fw-semibold">Dewormed Date</td>
                                <td class="font-weight-medium py-0">
                                    {{ $na->dewormed_date ? \Carbon\Carbon::parse($na->dewormed_date)->format('F j, Y') : 'None' }}
                                </td>
                            </tr>
                            <tr class="d-flex flex-col">
                                <td class="fw-semibold">Dietary Restriction</td>
                                <td class="font-weight-medium py-0">
                                    @if(!empty($na->dietary_restriction))
                                        {{ $na->dietary_restriction }}
                                    @else
                                        None
                                    @endif
                                </td>
                            </tr>
                            <tr class="d-flex flex-col">
                                <td>Is Permitted For Deworming</td>
                                <td class="font-weight-medium py-0">
                                    {{ $na->is_permitted_deworming == 1 ? 'Yes' : 'No' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @else
        <div class="col-md-7">
            <div class="d-flex row bg-warning px-4 py-3 text-white">
                No nutritional status record of the pupil is submitted
            </div>
        </div>
        @endif
        @endforeach

    </div>
</div>
<div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
    <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
        <form class="position-relative">
            <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Followers">
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
