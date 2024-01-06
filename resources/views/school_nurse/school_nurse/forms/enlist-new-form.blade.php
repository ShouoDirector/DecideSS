<div class="col-12 card position-relative overflow-hidden shadow-none">
    <div class="card-body shadow-none px-0">
        <h5>Search Pupil To Enlist</h5>
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

            @if(!empty(Request::get('search')))
            <form class="d-flex row justify-content-center" method="post"
                data-insert-route="{{ route('enlist_new.add') }}" id="insertUserForm">
                {{ csrf_field() }}

                <div class="card col-lg-4 col-md-6 col-sm-8 col-12 shadow rounded" style="height: max-content;">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold">Pupil General Information</h5>
                        <p class="card-subtitle mb-7 pb-8">LRN : {{ Request::get('search') }}</p>
                        <div class="position-relative">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex">
                                    <div
                                        class="p-8 bg-light-primary rounded-2 d-flex align-items-center justify-content-center me-6">
                                        <i class="fs-5 px-1 ti ti-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fs-4 fw-semibold">
                                            {{ $dataPupilNames[$beneficiaryData['getList'][0]->pupil_id] }}</h6>
                                        <p class="fs-3 mb-0">Pupil Name</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex">
                                    <div
                                        class="p-8 bg-light-success rounded-2 d-flex align-items-center justify-content-center me-6">
                                        <i class="fs-5 px-1 ti ti-users"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fs-4 fw-semibold">
                                            {{ $classAdvisersNames[$beneficiaryData['getList'][0]->classadviser_id] }}
                                        </h6>
                                        <p class="fs-3 mb-0">Class Adviser</p>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex">
                                    <div
                                        class="p-8 bg-light-warning rounded-2 d-flex align-items-center justify-content-center me-6">
                                        <i class="fs-5 px-1 ti ti-box"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fs-4 fw-semibold">
                                            {{ old('class_id', 'Grade ' . $dataGradeLevel[$beneficiaryData['getList'][0]->class_id] . ' - ' . $dataClassNames[$beneficiaryData['getList'][0]->class_id]) }}
                                        </h6>
                                        <p class="fs-3 mb-0">Section</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-7 pb-8">
                                <div class="d-flex">
                                    <div
                                        class="p-8 bg-light-danger rounded-2 d-flex align-items-center justify-content-center me-6">
                                        <i class="fs-5 px-1 ti ti-ruler-measure"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fs-3">Weight</h6>
                                        <p class="fs-3 mb-0">Height</p>
                                    </div>
                                </div>
                                <div class="d-flex row">
                                    <h6 class="mb-0 fw-semibold text-muted">
                                        {{ old('weight', $beneficiaryData['getList'][0]->weight . 'm') }}</h6>
                                    <h6 class="mb-0 fw-semibold text-muted">
                                        {{ old('height', $beneficiaryData['getList'][0]->height . 'cm') }}</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card col-lg-8 col-md-6 col-12">
                    <div class="m-0 mt-3 p-0">
                        <button type="button"
                            class="justify-content-center btn mb-1 btn-secondary d-flex align-items-center">
                            <i class="ti ti-heart fs-4 me-2"></i>
                            Feeding Program
                        </button>
                    </div>
                    <div class="shadow-lg m-0 d-flex row pt-3">
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <input type="text" name="bmi_category" class="form-control border-0 border-info"
                                value="{{ old('bmi_category', $beneficiaryData['getList'][0]->bmi_category) }}"
                                placeholder="BMI Category" required readonly />
                            <label><span class="border-info ps-3">BMI Category</span></label>
                        </div>
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <input type="text" name="hfa_category" class="form-control border-0 border-info"
                                value="{{ old('hfa_category', $beneficiaryData['getList'][0]->hfa_category) }}"
                                placeholder="HFA Category" required readonly />
                            <label><span class="border-info ps-3">HFA Category</span></label>
                        </div>
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3" name="is_feeding_program"
                                id="userTypeSelect">
                                <option value="#" selected disabled>Will Undergo Feeding Program?</option>
                                <option value="0"
                                    {{ old('is_feeding_program', $beneficiaryData['getList'][0]->is_feeding_program) === '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ old('is_feeding_program', $beneficiaryData['getList'][0]->is_feeding_program) === '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                            <div class="text-dark">You can still change this</div>
                        </div>
                    </div>

                    <div class="m-0 mt-3 p-0">
                        <button type="button"
                            class="justify-content-center btn mb-1 btn-warning d-flex align-items-center">
                            <i class="ti ti-heart fs-4 me-2"></i>
                            Deworming Program
                        </button>
                    </div>
                    <div class="shadow-lg m-0 d-flex row pt-3">
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <input type="text" class="form-control border-0 border-info"
                                value="{{ $getPermittedAndUndecidedList[0]->is_permitted_deworming ? 
                        'Yes' : ($getPermittedAndUndecidedList[0]->is_permitted_deworming === 0 ? 'No' : 'Undecided') }}">
                            <label><span class="border-info ps-3">Is the Pupil Permitted By Parent?</span></label>
                        </div>
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3" name="is_deworming_program"
                                id="userTypeSelect">
                                <option value="#" selected disabled>Will Undergo Deworming Program?</option>
                                <option value="0"
                                    {{ old('is_deworming_program', $beneficiaryData['getList'][0]->is_deworming_program) === '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ old('is_deworming_program', $beneficiaryData['getList'][0]->is_deworming_program) === '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                            <div class="text-dark">You can still change this</div>
                        </div>
                    </div>

                    <div class="m-0 mt-3 p-0">
                        <button type="button"
                            class="justify-content-center btn mb-1 btn-danger d-flex align-items-center">
                            <i class="ti ti-heart fs-4 me-2"></i>
                            Immunization/Vaccination
                        </button>
                    </div>
                    <div class="shadow-lg m-0 d-flex row pt-3">
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3" name="is_immunized"
                                id="userTypeSelect">
                                <option value="#" selected disabled>Is Immunized?</option>
                                <option value="0"
                                    {{ old('is_immunized', $beneficiaryData['getList'][0]->is_immunized) === '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ old('is_immunized', $beneficiaryData['getList'][0]->is_immunized) === '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <input type="text" name="is_immunized" class="form-control border border-info"
                                value="{{ old('immunization_specify', $beneficiaryData['getList'][0]->immunization_specify) }}">
                            <label><span class="border-info ps-3">Specify Immunization/Vaccination</span></label>
                        </div>
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3"
                                name="is_immunization_vax_program" id="userTypeSelect">
                                <option value="#" selected disabled>Will Undergo Immunization Vax?</option>
                                <option value="0"
                                    {{ old('is_immunization_vax_program', $beneficiaryData['getList'][0]->is_immunization_vax_program) === '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ old('is_immunization_vax_program', $beneficiaryData['getList'][0]->is_immunization_vax_program) === '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                            <div class="text-dark">You can still change this</div>
                        </div>
                    </div>

                    <div class="m-0 mt-3 p-0">
                        <button type="button"
                            class="justify-content-center btn mb-1 btn-dark d-flex align-items-center">
                            <i class="ti ti-heart fs-4 me-2"></i>
                            Mental Health Program
                        </button>
                    </div>
                    <div class="shadow-lg m-0 d-flex row pt-3">
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3"
                                name="is_mental_healthcare_program" id="userTypeSelect">
                                <option value="#" selected disabled>Will Undergo Mental HealthCare Program?</option>
                                <option value="0"
                                    {{ old('is_mental_healthcare_program', $beneficiaryData['getList'][0]->is_mental_healthcare_program) === '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ old('is_mental_healthcare_program', $beneficiaryData['getList'][0]->is_mental_healthcare_program) === '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                            <div class="text-dark">You can still change this</div>
                        </div>
                    </div>
                    <div class="m-0 mt-3 p-0">
                        <button type="button"
                            class="justify-content-center btn mb-1 btn-primary d-flex align-items-center">
                            <i class="ti ti-heart fs-4 me-2"></i>
                            Dental Care Program
                        </button>
                    </div>
                    <div class="shadow-lg m-0 d-flex row pt-3">
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3"
                                name="is_dental_care_program" id="userTypeSelect">
                                <option value="#" selected disabled>Will Undergo Mental HealthCare Program?</option>
                                <option value="0"
                                    {{ old('is_dental_care_program', $beneficiaryData['getList'][0]->is_dental_care_program) === '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ old('is_dental_care_program', $beneficiaryData['getList'][0]->is_dental_care_program) === '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                            <div class="text-dark">You can still change this</div>
                        </div>
                    </div>

                    <div class="m-0 mt-3 p-0">
                        <button type="button"
                            class="justify-content-center btn mb-1 btn-danger d-flex align-items-center">
                            <i class="ti ti-heart fs-4 me-2"></i>
                            Eye Care Program
                        </button>
                    </div>
                    <div class="shadow-lg m-0 d-flex row pt-3">
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3" name="vision_screening"
                                id="userTypeSelect">
                                <option value="#" selected disabled>Vision Screening?</option>
                                <option value="0"
                                    {{ old('vision_screening', $beneficiaryData['getList'][0]->vision_screening) === '0' ? 'selected' : '' }}>
                                    Passed</option>
                                <option value="1"
                                    {{ old('vision_screening', $beneficiaryData['getList'][0]->vision_screening) === '1' ? 'selected' : '' }}>
                                    Failed</option>
                            </select>
                        </div>
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3" name="is_eye_care_program"
                                id="userTypeSelect">
                                <option value="#" selected disabled>Will Undergo EyeCare Program?</option>
                                <option value="0"
                                    {{ old('is_eye_care_program', $beneficiaryData['getList'][0]->is_eye_care_program) === '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ old('is_eye_care_program', $beneficiaryData['getList'][0]->is_eye_care_program) === '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                            <div class="text-dark">You can still change this</div>
                        </div>
                    </div>

                    <div class="m-0 mt-3 p-0">
                        <button type="button"
                            class="justify-content-center btn mb-1 btn-success d-flex align-items-center">
                            <i class="ti ti-heart fs-4 me-2"></i>
                            Health and Wellness Program
                        </button>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="bmi_category" class="form-control border-0 border-info"
                            value="{{ old('bmi_category', $beneficiaryData['getList'][0]->bmi_category) }}"
                            placeholder="BMI Category" required readonly />
                        <label><span class="border-info ps-3">BMI Category</span></label>
                    </div>
                    <div class="shadow-lg m-0 d-flex row pt-3">
                        @if($dataPupilSex[$beneficiaryData['getList'][0]->pupil_id] == 'Female')
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3" name="menarche"
                                id="userTypeSelect">
                                <option value="#" selected disabled>For female pupils only, Menarche?</option>
                                <option value="0"
                                    {{ old('menarche', $beneficiaryData['getList'][0]->menarche) === '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ old('menarche', $beneficiaryData['getList'][0]->menarche) === '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                        </div>
                        @endif
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3"
                                name="is_health_wellness_program" id="userTypeSelect">
                                <option value="#" selected disabled>Will Undergo Health and Wellness Program?</option>
                                <option value="0"
                                    {{ old('is_health_wellness_program', $beneficiaryData['getList'][0]->is_health_wellness_program) === '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ old('is_health_wellness_program', $beneficiaryData['getList'][0]->is_health_wellness_program) === '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                            <div class="text-dark">You can still change this</div>
                        </div>
                    </div>

                    <div class="m-0 mt-3 p-0">
                        <button type="button"
                            class="justify-content-center btn mb-1 btn-primary d-flex align-items-center">
                            <i class="ti ti-heart fs-4 me-2"></i>
                            Medical Support Program
                        </button>
                    </div>
                    <div class="shadow-lg m-0 d-flex row pt-3">
                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3"
                                name="is_medical_support_program" id="userTypeSelect">
                                <option value="#" selected disabled>Will Undergo Medical Support Program?</option>
                                <option value="0"
                                    {{ old('is_medical_support_program', $beneficiaryData['getList'][0]->is_medical_support_program) === '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ old('is_medical_support_program', $beneficiaryData['getList'][0]->is_medical_support_program) === '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                            <div class="text-dark">You can still change this</div>
                        </div>
                    </div>

                    <div class="m-0 mt-3 p-0">
                        <button type="button"
                            class="justify-content-center btn mb-1 btn-danger d-flex align-items-center">
                            <i class="ti ti-heart fs-4 me-2"></i>
                            Nursing Services
                        </button>
                    </div>
                    <div class="shadow-lg m-0 d-flex row pt-3">

                        <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                            <select class="form-control form-select border border-info p-3" name="is_nursing_services"
                                id="userTypeSelect">
                                <option value="#" selected disabled>Will Undergo Nursing Services?</option>
                                <option value="0"
                                    {{ old('is_nursing_services', $beneficiaryData['getList'][0]->is_nursing_services) === '0' ? 'selected' : '' }}>
                                    No</option>
                                <option value="1"
                                    {{ old('is_nursing_services', $beneficiaryData['getList'][0]->is_nursing_services) === '1' ? 'selected' : '' }}>
                                    Yes</option>
                            </select>
                            <div class="text-dark">You can still change this</div>
                        </div>
                    </div>

                    <div class="m-0 mt-3 p-0">
                        <button type="button"
                            class="justify-content-center btn mb-1 btn-danger d-flex align-items-center">
                            <i class="ti ti-heart fs-4 me-2"></i>
                            Notes/Observation
                        </button>
                    </div>
                    <div class="shadow-lg m-0 d-flex row pt-3">
                        <div class="form-floating mb-3 mt-3 col-lg-4 col-md-6 col-12">
                            <textarea type="text" name="explanation" class="form-control border border-info" step="0.01"
                                value="{{ old('explanation', $beneficiaryData['getList'][0]->explanation) }}">
                        </textarea>
                            <label><span class="border-info ps-3">Observation & Notes you may add</span></label>
                        </div>
                    </div>
                </div>

                <div class="hidden">
                    <input type="text" name="district_id" value="{{ $classDistrictId[$schoolId] }}">
                </div>
                <div class="shadow-lg m-0 d-flex row pt-3">

                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="pupil_id" class="form-control border border-info"
                            value="{{ $beneficiaryData['getList'][0]->pupil_id }}" placeholder="Pupil" required
                            readonly />
                        <label><span class="border-info ps-3">Pupil ID</span></label>
                    </div>

                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="classadviser_id" class="form-control border border-info"
                            value="{{ old('classadviser_id', $beneficiaryData['getList'][0]->classadviser_id) }}"
                            placeholder="Class Adviser ID" required readonly />
                        <label><span class="border-info ps-3">Class Adviser ID</span></label>
                    </div>

                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="school_nurse_id" class="form-control border border-info"
                            value="{{ old('school_nurse_id', $beneficiaryData['getList'][0]->school_nurse_id) }}"
                            placeholder="School Nurse ID" required readonly />
                        <label><span class="border-info ps-3">School Nurse ID</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="class_id" class="form-control border border-info"
                            value="{{ old('class_id', $beneficiaryData['getList'][0]->class_id) }}"
                            placeholder="Class ID" required readonly />
                        <label><span class="border-info ps-3">Class ID</span></label>
                    </div>

                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="schoolyear_id" class="form-control border border-info"
                            value="{{ old('schoolyear_id', $beneficiaryData['getList'][0]->schoolyear_id) }}"
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
