<div class="col-12 card position-relative overflow-hidden shadow-none">
    <div class="card-body shadow-none px-0">
        <h5>Search Pupil To Enlist</h5>
        <p class="card-subtitle">Search with LRN or below</p>
        <p class="card-subtitle mb-3 mt-3">
            @foreach($dataClassRecord['getRecord'] as $value)

            @endforeach

            @php
            $schoolId = $classSchoolId[$value->class_id];
            @endphp
        </p>


        <div class="f-flex row col-12 border-none gap-1 justify-content-end mb-3">
            @if($activeSchoolYear['getRecord']->isNotEmpty())
            <form class="d-flex row col-12 border-none gap-2 mb-3 justify-content-end m-0"
                action="{{ route('school_nurse.school_nurse.enlist_new') }}">
                <div class="d-flex row col-lg-4 col-md-6 col-sm-8 border-none">
                    <input type="search"
                        class="form-control col-lg-3 col-md-4 col-sm-6 col-12 @if(count($beneficiaryData['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty() &&
            !empty(Request::get('search'))) is-valid @else @if(!empty(Request::get('search'))) is-invalid @endif @endif"
                        id="inputHorizontalDanger" placeholder="Input Pupil's LRN first"
                        value="{{ Request::get('search') }}" name="search">
                    @if(count($beneficiaryData['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty() &&
                    !empty(Request::get('search')))
                    <div class="valid-feedback">
                        The Pupil is already enlisted as beneficiary, you may update the beneficiary's information.
                    </div>
                    @else
                    @if(!empty(Request::get('search')))
                    <div class="invalid-feedback">
                        You can enlist this pupil as beneficiary by adding information.
                    </div>
                    @endif
                    @endif
                </div>
                <button type="submit" class="col-auto btn btn-info font-medium px-4" style="height: min-content;">
                    Check
                </button>
            </form>
            @endif

            <div class="d-flex row">
                <div class="col-md-5">
                    @if(count($dataClass['classRecords']) !== 0 && empty(Request::get('search')))
                    <div class="d-flex row justify-content-start">
                        <div class="table-responsive pb-3">
                            <table class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <!-- start row -->
                                    <tr>
                                        <th></th>
                                        <th>Section Name</th>
                                        <th>Grade Level</th>
                                        <th></th>
                                    </tr>
                                    <!-- end row -->
                                </thead>
                                <tbody>
                                    @if(count($dataClass['classRecords']) === 0)
                                    <tr>
                                        <td colspan="12" class="text-center">No class selected</td>
                                    </tr>
                                    @else

                                    @php
                                    $customSortOrder = ['Kinder', '1', '2', '3', '4', '5', '6', 'SPED'];
                                    $orderedClassRecords = $dataClass['classRecords']->sortBy(function ($record) use
                                    ($customSortOrder) {
                                    return array_search($record->grade_level, $customSortOrder);
                                    });
                                    @endphp

                                    @foreach($orderedClassRecords as $value)
                                    <tr>
                                        <td>{{ $loop->index + 1 + ($dataClassRecord['getRecord']->perPage() * 
                                        ($dataClassRecord['getRecord']->currentPage() - 1)) }}</td>
                                        <td>{{ $value->section }}</td>
                                        <td>{{ $value->grade_level }}</td>
                                        <td>
                                            <form class="d-flex align-items-center"
                                                action="{{ route('school_nurse.school_nurse.enlist_new') }}">
                                                <input type="number" name="class" value="{{ $value->id }}"
                                                    class="hidden">
                                                <button type="submit"
                                                    class="btn btn-primary text-white py-1 px-3">Select
                                                </button>
                                                @if(!empty(Request::get('class')) && Request::get('class') == $value->id
                                                )
                                                <i class="ti ti-player-track-next fs-5 ms-3"></i>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    <!-- End row -->
                                </tbody>
                            </table>

                        </div>
                    </div>
                    @else
                    @endif
                </div>

                <div class="col-md-5">
                    @if(count($dataClasses['getRecord']) !== 0 && !empty(Request::get('class')) &&
                    empty(Request::get('search')))
                    <div class="d-flex row justify-content-start">
                        <div class="table-responsive pb-3">
                            <table class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <!-- start row -->
                                    <tr>
                                        <th></th>
                                        <th>Pupil</th>
                                        <th></th>
                                    </tr>
                                    <!-- end row -->
                                </thead>
                                <tbody>
                                    @if(count($dataClasses['getRecord']) === 0)
                                    <tr>
                                        <td colspan="12" class="text-center">No class selected</td>
                                    </tr>
                                    @else

                                    @foreach($dataClasses['getRecord'] as $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dataPupilNames[$value->pupil_id] }}</td>
                                        <td>
                                            <form action="{{ route('school_nurse.school_nurse.enlist_new') }}">
                                                <input type="text" name="class" value="{{ Request::get('class') }}"
                                                    class="hidden">
                                                <input type="text" name="search"
                                                    value="{{ $dataPupilLRN[$value->pupil_id] }}" class="hidden">
                                                <button type="submit"
                                                    class="btn btn-primary text-white py-1 px-3">Select This
                                                    Pupil</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    <!-- End row -->
                                </tbody>
                            </table>

                        </div>
                    </div>
                    @else
                    @endif
                </div>
            </div>

            @if(!empty(Request::get('search')))
            <div class="d-flex row justify-content-end">
                <a href="{{ route('school_nurse.school_nurse.enlist_new') }}"
                    class="btn btn-outline-primary col-sm-2">Clear result
                    <i class="ti ti-trash"></i>
                </a>
            </div>
            @endif

            @if(!empty(Request::get('search')))
            <form class="d-flex row justify-content-between" method="post"
                data-insert-route="{{ route('enlist_new.add') }}" id="insertUserForm">
                {{ csrf_field() }}

                <div class="card col-lg-4 col-md-6 col-sm-8 col-12 shadow-lg rounded" style="height: max-content;">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold">Pupil Information</h5>
                        <p class="card-subtitle mb-7 pb-8">LRN : {{ Request::get('search') }}</p>

                        @if (
                            isset($beneficiaryData['getList'][0]->pupil_id) &&
                            isset($dataPupilPhoto[$beneficiaryData['getList'][0]->pupil_id])
                        )
                        <img class="w-100 h-100 mb-4 rounded"
                            src="{{ asset('storage/' . $dataPupilPhoto[$beneficiaryData['getList'][0]->pupil_id]) }}"
                            alt="Profile Photo">
                        @else
                        <img src="{{ asset('background-images/Blank-Profile-Picture-0.jpg') }}"
                            class="w-100 h-100 mb-4 rounded" alt="Profile Photo">
                        @endif

                        <div class="position-relative">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex">
                                    <div
                                        class="p-8 bg-primary rounded-2 d-flex align-items-center justify-content-center me-6">
                                        <i class="fs-5 px-1 ti ti-user text-white"></i>
                                    </div>
                                    <div>
                                        @if (isset($beneficiaryData['getList'][0]->pupil_id) && isset($dataPupilNames[$beneficiaryData['getList'][0]->pupil_id]))
                                            <h6 class="mb-1 fs-4">
                                                {{ $dataPupilNames[$beneficiaryData['getList'][0]->pupil_id] }}
                                            </h6>
                                            <p class="fs-3 mb-0">Pupil Name</p>
                                        @else
                                            
                                            <h6 class="mb-1 fs-4">{{ $getPupilData['getRecord'][0]->first_name }} 
                                                {{ $getPupilData['getRecord'][0]->middle_name }} 
                                                {{ $getPupilData['getRecord'][0]->last_name }}</h6>
                                            <p class="fs-3 mb-0">Pupil Name</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex">
                                    <div
                                        class="p-8 bg-success rounded-2 d-flex align-items-center justify-content-center me-6">
                                        <i class="fs-5 px-1 ti ti-users text-white"></i>
                                    </div>
                                    <div>
                                        @if (
                                            isset($beneficiaryData['getList'][0]->classadviser_id) &&
                                            isset($classAdvisersNames[$beneficiaryData['getList'][0]->classadviser_id])
                                        )
                                            <h6 class="mb-1 fs-4">
                                                {{ $classAdvisersNames[$beneficiaryData['getList'][0]->classadviser_id] }}
                                            </h6>
                                            <p class="fs-3 mb-0">Class Adviser</p>
                                        @else
                                            <h6 class="mb-1 fs-4">
                                                {{ $classAdvisersNames[$getPupilMasterlist['getRecord'][0]->classadviser_id] }}
                                            </h6>
                                            <p class="fs-3 mb-0">Class Adviser</p>
                                        @endif
                                    </div>

                                </div>

                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex">
                                    <div
                                        class="p-8 bg-warning rounded-2 d-flex align-items-center justify-content-center me-6">
                                        <i class="fs-5 px-1 ti ti-box text-white"></i>
                                    </div>
                                    <div>
                                        @if (
                                            isset($beneficiaryData['getList'][0]->class_id) &&
                                            isset($dataGradeLevel[$beneficiaryData['getList'][0]->class_id]) &&
                                            isset($dataClassNames[$beneficiaryData['getList'][0]->class_id])
                                        )
                                            <h6 class="mb-1 fs-4">
                                                {{ old('class_id', 'Grade ' . $dataGradeLevel[$beneficiaryData['getList'][0]->class_id] . ' - ' . $dataClassNames[$beneficiaryData['getList'][0]->class_id]) }}
                                            </h6>
                                            <p class="fs-3 mb-0">Section</p>
                                        @else
                                            <h6 class="mb-1 fs-4">
                                                {{ old('class_id', 'Grade ' . $dataGradeLevel[$getPupilMasterlist['getRecord'][0]->class_id] . ' - ' . $dataClassNames[$getPupilMasterlist['getRecord'][0]->class_id]) }}
                                            </h6>
                                            <p class="fs-3 mb-0">Section</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-7 pb-8">
                                <div class="d-flex">
                                    <div
                                        class="p-8 bg-danger rounded-2 d-flex align-items-center justify-content-center me-6">
                                        <i class="fs-5 px-1 ti ti-ruler-measure text-white"></i>
                                    </div>
                                    <div class="d-flex row">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fs-3">Weight</h6>
                                        <h6 class="mb-0 text-muted">
                                            @if(isset($beneficiaryData['getList'][0]->weight))
                                                {{ old('weight', $beneficiaryData['getList'][0]->weight . 'kg') }}
                                            @else
                                                {{ $getNAData['getRecord']->weight . 'kg' }}
                                            @endif
                                        </h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="fs-3 mb-0">Height</p>
                                        <h6 class="mt-0 text-muted">
                                            @if(isset($beneficiaryData['getList'][0]->height))
                                                {{ old('height', $beneficiaryData['getList'][0]->height . 'm') }}
                                            @else
                                                {{ $getNAData['getRecord']->height . 'm' }}
                                            @endif
                                        </h6>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card col-lg-8 col-md-6 col-12">

                    <div class="accordion accordion-flush mb-5 card position-relative overflow-hidden"
                        id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Feeding Program
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                <div class="accordion-body fw-normal">
                                    <div class="m-0 d-flex row pt-3">
                                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                                            <input type="text" name="bmi_category"
                                                class="form-control border-0 border-info"
                                                value="{{ old('bmi_category', $beneficiaryData['getList'][0]->bmi_category ?? $getNAData['getRecord']->bmi ) }}"
                                                placeholder="BMI Category" required readonly />
                                            <label><span class="border-info">BMI Category</span></label>
                                        </div>
                                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                                            <input type="text" name="hfa_category"
                                                class="form-control border-0 border-info"
                                                value="{{ old('hfa_category', $beneficiaryData['getList'][0]->hfa_category ?? $getNAData['getRecord']->hfa) }}"
                                                placeholder="HFA Category" required readonly />
                                            <label><span class="border-info">HFA Category</span></label>
                                        </div>

                                        @php $feeding = 0; @endphp
                                        @if($getNAData['getRecord']->bmi == 'Severely Wasted' || $$getNAData['getRecord']->bmi == 'Wasted' || $getNAData['getRecord']->hfa == 'Severely Stunted' ||
                                        $getNAData['getRecord']->hfa == 'Stunted')
                                            @php $feeding = 1; @endphp
                                            <h3>Beneficiary : Yes</h3>
                                        @endif

                                        <div class="form-floating mb-3 col-12 hidden">
                                            <input class="form-control form-select border border-info p-3"
                                                name="is_feeding_program" value="{{ $feeding }}" id="userTypeSelect">
                                            </input>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    Deworming Program
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">

                                    <div class="m-0 d-flex row pt-3">
                                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                                            <input type="text" class="form-control border-0 border-info cursor-default"
                                                value="{{ $getPermittedAndUndecidedList[0]->is_permitted_deworming ? 
                                        'Yes' : ($getPermittedAndUndecidedList[0]->is_permitted_deworming === 0 ? 'No' : 'Undecided') }}"
                                                readonly>
                                            <label><span class="border-info">Is the Pupil Permitted By
                                                    Parent?</span></label>
                                        </div>
                                        <label><span class="border-info">Will Undergo Deworming Program</span></label>
                                        <div class="form-floating mb-3 col-12">
                                            <select class="form-control form-select border border-info p-3"
                                                name="is_deworming_program" id="userTypeSelect">
                                                <option value="#" selected disabled>Will Undergo Deworming Program?
                                                </option>
                                                <option value="0"
                                                    {{ old('is_deworming_program', $beneficiaryData['getList'][0]->is_deworming_program ?? NULL) === '0' ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ old('is_deworming_program', $beneficiaryData['getList'][0]->is_deworming_program ?? NULL) === '1' ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            <div class="text-dark">Pupils permitted by their parents to undergo
                                                deworming program or undecided are enlisted but you can still change
                                                this</div>
                                        </div>
                                        A deworming program involves administering medications to students to eliminate
                                        parasitic worms from their bodies, promoting better health and well-being.
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                    aria-expanded="false" aria-controls="flush-collapseThree">
                                    Immunization / Vaccination Program
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">

                                    <div class="m-0 d-flex row pt-3">
                                        <div class="form-floating mb-3 col-12">
                                            <select class="form-control form-select border border-info p-3"
                                                name="is_immunized" id="userTypeSelect">
                                                <option value="#" selected disabled>Is Immunized And/Or Vaccinated?</option>
                                                <option value="0"
                                                    {{ old('is_immunized', $beneficiaryData['getList'][0]->is_immunized ?? $getNAData['getRecord']->is_immunized) === '0' ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ old('is_immunized', $beneficiaryData['getList'][0]->is_immunized ?? $getNAData['getRecord']->is_immunized) === '1' ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                        </div>
                                        <div class="form-floating mb-3 col-12">
                                            <input type="text" name="is_immunized"
                                                class="form-control border border-info"
                                                value="{{ old('immunization_specify', $beneficiaryData['getList'][0]->immunization_specify ?? $getNAData['getRecord']->is_immunized_specify) }}">
                                            <label><span class="border-info ps-3">Specify
                                                    Immunizations / Vaccinations</span></label>
                                        </div>
                                        <label><span class="border-info">Shall Undergo Immunization/Vaccination Program?</span></label>
                                        <div class="form-floating mb-3 col-12">
                                            <select class="form-control form-select border border-info p-3"
                                                name="is_immunization_vax_program" id="userTypeSelect">
                                                <option value="#" selected disabled>Will Undergo Immunization Vax?
                                                </option>
                                                <option value="0"
                                                    {{ old('is_immunization_vax_program', $beneficiaryData['getList'][0]->is_immunization_vax_program ?? $getNAData['getRecord']->is_immunization_vax_program) === '0' ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ old('is_immunization_vax_program', $beneficiaryData['getList'][0]->is_immunization_vax_program ?? $getNAData['getRecord']->is_immunization_vax_program) === '1' ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            <div class="text-dark">You can still change this</div>
                                        </div>
                                        <p>An immunization or vaccination program involves administering vaccines to students to 
                                            protect them from various infectious diseases, 
                                            preventing illness and promoting community health.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingfour">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false"
                                    aria-controls="flush-collapsefour">
                                    Mental Health Program
                                </button>
                            </h2>
                            <div id="flush-collapsefour" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    <div class="m-0 d-flex row pt-3">
                                        <label><span class="border-info">Shall Undergo Mental Health Program?</span></label>
                                        <div class="form-floating mb-3 col-12">
                                            <select class="form-control form-select border border-info p-3"
                                                name="is_mental_healthcare_program" id="userTypeSelect">
                                                <option value="#" selected disabled>Will Undergo Mental HealthCare Program?</option>
                                                <option value="0"
                                                    {{ old('is_mental_healthcare_program', $beneficiaryData['getList'][0]->is_mental_healthcare_program ?? null) === '0' ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ old('is_mental_healthcare_program', $beneficiaryData['getList'][0]->is_mental_healthcare_program ?? null) === '1' ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            <div class="text-dark">This is related to mental health of the pupil.</div>
                                        </div>
                                        <p> A mental health program involves initiatives and resources aimed at promoting and 
                                            supporting the psychological well-being pupils, through education, counseling, and mental health services.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingfifty">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapsefifty" aria-expanded="false"
                                    aria-controls="flush-collapsefifty">
                                    Dental Care Program
                                </button>
                            </h2>
                            <div id="flush-collapsefifty" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingfifty" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    <div class="m-0 d-flex row pt-3">
                                        <label><span class="border-info">Shall Undergo Dental Care Program?</span></label>
                                        <div class="form-floating mb-3 col-12">
                                            <select class="form-control form-select border border-info p-3"
                                                name="is_dental_care_program" id="userTypeSelect">
                                                <option value="#" selected disabled>Will Undergo Mental HealthCare Program?</option>
                                                <option value="0"
                                                    {{ old('is_dental_care_program', $beneficiaryData['getList'][0]->is_dental_care_program ?? null) === '0' ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ old('is_dental_care_program', $beneficiaryData['getList'][0]->is_dental_care_program ?? null) === '1' ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            <div class="text-dark">You can still change this</div>
                                        </div>
                                        <p>Maintaining good oral health, preventing pain and discomfort in the teeth,</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingeighty">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseeighty" aria-expanded="false"
                                    aria-controls="flush-collapseeighty">
                                    Medical Support Program
                                </button>
                            </h2>
                            <div id="flush-collapseeighty" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingeighty" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    <div class="m-0 d-flex row pt-3">
                                        <label><span class="border-info">Shall Undergo Medical Support Program?</span></label>
                                        <div class="form-floating mb-3 col-12">
                                            <select class="form-control form-select border border-info p-3"
                                                name="is_medical_support_program" id="userTypeSelect">
                                                <option value="#" selected disabled>Will Undergo Medical Support Program?</option>
                                                <option value="0"
                                                    {{ old('is_medical_support_program', $beneficiaryData['getList'][0]->is_medical_support_program ?? null) === '0' ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ old('is_medical_support_program', $beneficiaryData['getList'][0]->is_medical_support_program ?? null) === '1' ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            <div class="text-dark">Pupil may have serious health issues and necessary medical assistance and resources. You can still change this</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingninety">
                                <button class="accordion-button collapsed fs-4 fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseninety" aria-expanded="false"
                                    aria-controls="flush-collapseninety">
                                    Nursing Services
                                </button>
                            </h2>
                            <div id="flush-collapseninety" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingninety" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    <div class="m-0 d-flex row pt-3">
                                        <div class="form-floating mb-3 col-12">
                                            <select class="form-control form-select border border-info p-3" name="is_nursing_services"
                                                id="userTypeSelect">
                                                <option value="#" selected disabled>Shall Undergo for more Nursing Services?</option>
                                                <option value="0"
                                                    {{ old('is_nursing_services', $beneficiaryData['getList'][0]->is_nursing_services ?? null) === '0' ? 'selected' : '' }}>
                                                    No</option>
                                                <option value="1"
                                                    {{ old('is_nursing_services', $beneficiaryData['getList'][0]->is_nursing_services ?? null) === '1' ? 'selected' : '' }}>
                                                    Yes</option>
                                            </select>
                                            <div class="text-dark">Pupil may need more nursing services and/or diagnoses but you can still change this</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-0 px-2 d-flex row pt-3">
                            <div class="form-floating mb-3 mt-3 col-12">
                                <textarea type="text" name="explanation" class="form-control border border-info" step="0.01"
                                    value="{{ old('explanation', $beneficiaryData['getList'][0]->explanation ?? null) }}">
                            </textarea>
                                <label><span class="border-info ps-3">Observation & Notes you may add</span></label>
                            </div>
                        </div>

                    </div>
                    
                </div>

                <div class="hidden">
                    <input type="text" name="district_id" value="{{ $classDistrictId[$schoolId] }}">
                </div>
                <div class="m-0 d-flex row pt-3">

                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="pupil_id" class="form-control border border-info"
                            value="{{ $beneficiaryData['getList'][0]->pupil_id ?? $getPupilMasterlist['getRecord'][0]->pupil_id }}" placeholder="Pupil" required
                            readonly />
                        <label><span class="border-info ps-3">Pupil ID</span></label>
                    </div>

                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="classadviser_id" class="form-control border border-info"
                            value="{{ old('classadviser_id', $beneficiaryData['getList'][0]->classadviser_id ?? $getPupilMasterlist['getRecord'][0]->classadviser_id) }}"
                            placeholder="Class Adviser ID" required readonly />
                        <label><span class="border-info ps-3">Class Adviser ID</span></label>
                    </div>

                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="school_nurse_id" class="form-control border border-info"
                            value="{{ old('school_nurse_id', $beneficiaryData['getList'][0]->school_nurse_id ?? Auth::user()->id) }}"
                            placeholder="School Nurse ID" required readonly />
                        <label><span class="border-info ps-3">School Nurse ID</span></label>
                    </div>

                    {{ $classid = $getPupilMasterlist['getRecord'][0]->class_id }}

                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="class_id" class="form-control border border-info"
                            value="{{ old('class_id', $beneficiaryData['getList'][0]->class_id ?? $getPupilMasterlist['getRecord'][0]->class_id) }}"
                            placeholder="Class ID" required readonly />
                        <label><span class="border-info ps-3">Class ID</span></label>
                    </div>

                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="schoolyear_id" class="form-control border border-info"
                            value="{{ old('schoolyear_id', $beneficiaryData['getList'][0]->schoolyear_id ?? null) }}"
                            placeholder="School Year ID" required readonly />
                        <label><span class="border-info ps-3">School Year ID</span></label>
                    </div>

                </div>


                <div class="d-flex justify-content-end align-items-center">
                    <div class="mt-3 mt-md-0 d-content cursor-pointer col-lg-4 col-md-6 col-12">
                        <button type="button" class="btn btn-info font-medium w-100 px-4" id="submitButton"
                            data-bs-toggle="modal" data-bs-target="#add-beneficiary">
                            Submit
                        </button>
                    </div>
                </div>

                @include('school_nurse.school_nurse.modals.add-beneficiary')
            </form>
            @endif
            @include('validator/form-validator')
        </div>
    </div>
