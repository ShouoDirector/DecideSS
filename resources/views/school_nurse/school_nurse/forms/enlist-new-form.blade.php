<div class="col-12 card position-relative overflow-hidden shadow-none">
    <div class="card-body shadow-none px-0">
        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            <b>Important Notice : </b>
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


            <form class="d-flex row" method="post" data-insert-route="{{ route('enlist_new.add') }}" id="insertUserForm">
                {{ csrf_field() }}
                <div class="m-0 mt-3 p-0">
                    <button type="button" class="justify-content-center btn mb-1 btn-primary d-flex align-items-center">
                        <i class="ti ti-heart fs-4 me-2"></i>
                        Basic Information
                    </button>
                </div>
                <div class="shadow-lg m-0 d-flex row pt-3">
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="lrn" value="{{ Request::get('search') }}"
                            class="form-control border-0 border-info" placeholder="LRN" required readonly />
                        <label><span class="border-info ps-3">LRN</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="pupil_id" class="form-control border border-info"
                            value="{{ $beneficiaryData['getList'][0]->pupil_id }}" placeholder="Pupil" required
                            readonly />
                        <label><span class="border-info ps-3">Pupil ID</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" class="form-control border-0 border-info"
                            value="{{ $dataPupilNames[$beneficiaryData['getList'][0]->pupil_id] }}" placeholder="Pupil"
                            required readonly />
                        <label><span class="border-info ps-3">Pupil Name</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="classadviser_id" class="form-control border border-info"
                            value="{{ old('classadviser_id', $beneficiaryData['getList'][0]->classadviser_id) }}"
                            placeholder="Class Adviser ID" required readonly />
                        <label><span class="border-info ps-3">Class Adviser ID</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" class="form-control border-0 border-info"
                            value="{{ $classAdvisersNames[$beneficiaryData['getList'][0]->classadviser_id] }}"
                            placeholder="Class Adviser ID" required readonly />
                        <label><span class="border-info ps-3">Class Adviser</span></label>
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
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" class="form-control border-0 border-info"
                            value="{{ old('class_id', 'Grade ' . $dataGradeLevel[$beneficiaryData['getList'][0]->class_id] . ' - ' . $dataClassNames[$beneficiaryData['getList'][0]->class_id]) }}"
                            placeholder="Class ID" required readonly />
                        <label><span class="border-info ps-3">Class</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                        <input type="text" name="schoolyear_id" class="form-control border border-info"
                            value="{{ old('schoolyear_id', $beneficiaryData['getList'][0]->schoolyear_id) }}"
                            placeholder="School Year ID" required readonly />
                        <label><span class="border-info ps-3">School Year ID</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="height" class="form-control border-0 border-info"
                            value="{{ old('height', $beneficiaryData['getList'][0]->height . 'cm') }}"
                            placeholder="Height" required readonly />
                        <label><span class="border-info ps-3">Height</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="weight" class="form-control border-0 border-info"
                            value="{{ old('weight', $beneficiaryData['getList'][0]->weight . 'm') }}"
                            placeholder="Weight" required readonly />
                        <label><span class="border-info ps-3">Weight</span></label>
                    </div>
                </div>

                <div class="m-0 mt-3 p-0">
                    <button type="button" class="justify-content-center btn mb-1 btn-secondary d-flex align-items-center">
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
                        <select class="form-control form-select border border-info p-3" name="is_feeding_program" id="userTypeSelect">
                            <option value="#" selected disabled>Will Undergo Feeding Program?</option>
                            <option value="0" {{ old('is_feeding_program', $beneficiaryData['getList'][0]->is_feeding_program) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_feeding_program', $beneficiaryData['getList'][0]->is_feeding_program) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        <div class="text-dark">You can still change this</div>
                    </div>
                </div>

                <div class="m-0 mt-3 p-0">
                    <button type="button" class="justify-content-center btn mb-1 btn-warning d-flex align-items-center">
                        <i class="ti ti-heart fs-4 me-2"></i>
                        Deworming Program
                    </button>
                </div>
                <div class="shadow-lg m-0 d-flex row pt-3">
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" class="form-control border-0 border-info"
        value="{{ $getPermittedAndUndecidedList[0]->is_permitted_deworming ? 'Yes' : ($getPermittedAndUndecidedList[0]->is_permitted_deworming === 0 ? 'No' : 'Undecided') }}">
                        <label><span class="border-info ps-3">Is the Pupil Permitted By Parent to Undergo Deworming?</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="is_deworming_program" id="userTypeSelect">
                            <option value="#" selected disabled>Will Undergo Deworming Program?</option>
                            <option value="0" {{ old('is_deworming_program', $beneficiaryData['getList'][0]->is_deworming_program) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_deworming_program', $beneficiaryData['getList'][0]->is_deworming_program) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        <div class="text-dark">You can still change this</div>
                    </div>
                </div>

                <div class="m-0 mt-3 p-0">
                    <button type="button" class="justify-content-center btn mb-1 btn-danger d-flex align-items-center">
                        <i class="ti ti-heart fs-4 me-2"></i>
                        Immunization Vax
                    </button>
                </div>
                <div class="shadow-lg m-0 d-flex row pt-3">
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="is_immunized" id="userTypeSelect">
                            <option value="#" selected disabled>Is Immunized?</option>
                            <option value="0" {{ old('is_immunized', $beneficiaryData['getList'][0]->is_immunized) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_immunized', $beneficiaryData['getList'][0]->is_immunized) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" name="is_immunized" class="form-control border border-info"
        value="{{ old('immunization_specify', $beneficiaryData['getList'][0]->immunization_specify) }}">
                        <label><span class="border-info ps-3">Immunized Specify</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="is_immunization_vax_program" id="userTypeSelect">
                            <option value="#" selected disabled>Will Undergo Immunization Vax?</option>
                            <option value="0" {{ old('is_immunization_vax_program', $beneficiaryData['getList'][0]->is_immunization_vax_program) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_immunization_vax_program', $beneficiaryData['getList'][0]->is_immunization_vax_program) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        <div class="text-dark">You can still change this</div>
                    </div>
                </div>

                <div class="m-0 mt-3 p-0">
                    <button type="button" class="justify-content-center btn mb-1 btn-dark d-flex align-items-center">
                        <i class="ti ti-heart fs-4 me-2"></i>
                        Mental Health Program
                    </button>
                </div>
                <div class="shadow-lg m-0 d-flex row pt-3">
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="is_mental_healthcare_program" id="userTypeSelect">
                            <option value="#" selected disabled>Will Undergo Mental HealthCare Program?</option>
                            <option value="0" {{ old('is_mental_healthcare_program', $beneficiaryData['getList'][0]->is_mental_healthcare_program) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_mental_healthcare_program', $beneficiaryData['getList'][0]->is_mental_healthcare_program) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        <div class="text-dark">You can still change this</div>
                    </div>
                </div>
                <div class="m-0 mt-3 p-0">
                    <button type="button" class="justify-content-center btn mb-1 btn-primary d-flex align-items-center">
                        <i class="ti ti-heart fs-4 me-2"></i>
                        Dental Care Program
                    </button>
                </div>
                <div class="shadow-lg m-0 d-flex row pt-3">
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="is_dental_care_program" id="userTypeSelect">
                            <option value="#" selected disabled>Will Undergo Mental HealthCare Program?</option>
                            <option value="0" {{ old('is_dental_care_program', $beneficiaryData['getList'][0]->is_dental_care_program) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_dental_care_program', $beneficiaryData['getList'][0]->is_dental_care_program) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        <div class="text-dark">You can still change this</div>
                    </div>
                </div>

                <div class="m-0 mt-3 p-0">
                    <button type="button" class="justify-content-center btn mb-1 btn-danger d-flex align-items-center">
                        <i class="ti ti-heart fs-4 me-2"></i>
                        Eye Care Program
                    </button>
                </div>
                <div class="shadow-lg m-0 d-flex row pt-3">
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="vision_screening" id="userTypeSelect">
                            <option value="#" selected disabled>Vision Screening?</option>
                            <option value="0" {{ old('vision_screening', $beneficiaryData['getList'][0]->vision_screening) === '0' ? 'selected' : '' }}>Passed</option>
                            <option value="1" {{ old('vision_screening', $beneficiaryData['getList'][0]->vision_screening) === '1' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="is_eye_care_program" id="userTypeSelect">
                            <option value="#" selected disabled>Will Undergo EyeCare Program?</option>
                            <option value="0" {{ old('is_eye_care_program', $beneficiaryData['getList'][0]->is_eye_care_program) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_eye_care_program', $beneficiaryData['getList'][0]->is_eye_care_program) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        <div class="text-dark">You can still change this</div>
                    </div>
                </div>

                <div class="m-0 mt-3 p-0">
                    <button type="button" class="justify-content-center btn mb-1 btn-success d-flex align-items-center">
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
                        <select class="form-control form-select border border-info p-3" name="menarche" id="userTypeSelect">
                            <option value="#" selected disabled>For female pupils only, Menarche?</option>
                            <option value="0" {{ old('menarche', $beneficiaryData['getList'][0]->menarche) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('menarche', $beneficiaryData['getList'][0]->menarche) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    @endif
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="is_health_wellness_program" id="userTypeSelect">
                            <option value="#" selected disabled>Will Undergo Health and Wellness Program?</option>
                            <option value="0" {{ old('is_health_wellness_program', $beneficiaryData['getList'][0]->is_health_wellness_program) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_health_wellness_program', $beneficiaryData['getList'][0]->is_health_wellness_program) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        <div class="text-dark">You can still change this</div>
                    </div>
                </div>

                <div class="m-0 mt-3 p-0">
                    <button type="button" class="justify-content-center btn mb-1 btn-primary d-flex align-items-center">
                        <i class="ti ti-heart fs-4 me-2"></i>
                        Medical Support Program
                    </button>
                </div>
                <div class="shadow-lg m-0 d-flex row pt-3">
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="is_medical_support_program" id="userTypeSelect">
                            <option value="#" selected disabled>Will Undergo Medical Support Program?</option>
                            <option value="0" {{ old('is_medical_support_program', $beneficiaryData['getList'][0]->is_medical_support_program) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_medical_support_program', $beneficiaryData['getList'][0]->is_medical_support_program) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        <div class="text-dark">You can still change this</div>
                    </div>
                </div>

                <div class="m-0 mt-3 p-0">
                    <button type="button" class="justify-content-center btn mb-1 btn-danger d-flex align-items-center">
                        <i class="ti ti-heart fs-4 me-2"></i>
                        Nursing Services
                    </button>
                </div>
                <div class="shadow-lg m-0 d-flex row pt-3">
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="iron_supplementation" id="userTypeSelect">
                            <option value="#" selected disabled>Is The Pupil Need Iron Supplementation?</option>
                            <option value="1" {{ old('iron_supplementation', $beneficiaryData['getList'][0]->iron_supplementation) === '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('iron_supplementation', $beneficiaryData['getList'][0]->iron_supplementation) === '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="number" name="temperature" class="form-control border border-info" step="0.01"
                            value="{{ old('temperature', number_format($beneficiaryData['getList'][0]->temperature, 2, '.', '')) }}">
                        <label><span class="border-info ps-3">Temperature</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="number" name="blood_pressure" class="form-control border border-info" step="0.01"
                            value="{{ old('blood_pressure', number_format($beneficiaryData['getList'][0]->blood_pressure, 2, '.', '')) }}">
                        <label><span class="border-info ps-3">Blood Pressure</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="number" name="heart_rate" class="form-control border border-info" step="0.01"
                            value="{{ old('heart_rate', number_format($beneficiaryData['getList'][0]->heart_rate, 2, '.', '')) }}">
                        <label><span class="border-info ps-3">Heart Rate</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="number" name="pulse_rate" class="form-control border border-info" step="0.01"
                            value="{{ old('pulse_rate', number_format($beneficiaryData['getList'][0]->pulse_rate, 2, '.', '')) }}">
                        <label><span class="border-info ps-3">Pulse Rate</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="number" name="respiratory_rate" class="form-control border border-info" step="0.01"
                            value="{{ old('respiratory_rate', number_format($beneficiaryData['getList'][0]->respiratory_rate, 2, '.', '')) }}">
                        <label><span class="border-info ps-3">Respiratory Rate</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="auditory_screening" id="userTypeSelect">
                            <option value="#" selected disabled>Auditory Screening</option>
                            <option value="0" {{ old('auditory_screening', $beneficiaryData['getList'][0]->auditory_screening) === '0' ? 'selected' : '' }}>Passed</option>
                            <option value="1" {{ old('auditory_screening', $beneficiaryData['getList'][0]->auditory_screening) === '1' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="skin_scalp" class="form-control border border-info" step="0.01"
                            value="{{ old('skin_scalp', $beneficiaryData['getList'][0]->skin_scalp) }}">
                        <label><span class="border-info ps-3">Skin & Scalp</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="eyes" class="form-control border border-info" step="0.01"
                            value="{{ old('eyes', $beneficiaryData['getList'][0]->eyes) }}">
                        <label><span class="border-info ps-3">Eyes</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="ear" class="form-control border border-info" step="0.01"
                            value="{{ old('ear', $beneficiaryData['getList'][0]->ear) }}">
                        <label><span class="border-info ps-3">Ear</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="nose" class="form-control border border-info" step="0.01"
                            value="{{ old('nose', $beneficiaryData['getList'][0]->nose) }}">
                        <label><span class="border-info ps-3">Nose</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="mouth" class="form-control border border-info" step="0.01"
                            value="{{ old('mouth', $beneficiaryData['getList'][0]->mouth) }}">
                        <label><span class="border-info ps-3">Mouth</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="neck" class="form-control border border-info" step="0.01"
                            value="{{ old('neck', $beneficiaryData['getList'][0]->neck) }}">
                        <label><span class="border-info ps-3">Neck</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="throat" class="form-control border border-info" step="0.01"
                            value="{{ old('throat', $beneficiaryData['getList'][0]->throat) }}">
                        <label><span class="border-info ps-3">Throat</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="lungs" class="form-control border border-info" step="0.01"
                            value="{{ old('lungs', $beneficiaryData['getList'][0]->lungs) }}">
                        <label><span class="border-info ps-3">Lungs</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="heart" class="form-control border border-info" step="0.01"
                            value="{{ old('heart', $beneficiaryData['getList'][0]->heart) }}">
                        <label><span class="border-info ps-3">Heart</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="abdomen" class="form-control border border-info" step="0.01"
                            value="{{ old('abdomen', $beneficiaryData['getList'][0]->abdomen) }}">
                        <label><span class="border-info ps-3">Abdomen</span></label>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="deformities" id="userTypeSelect">
                            <option value="#" selected disabled>Has Deformities?</option>
                            <option value="0" {{ old('deformities', $beneficiaryData['getList'][0]->deformities) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('deformities', $beneficiaryData['getList'][0]->deformities) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <input type="text" name="deformity_specified" class="form-control border border-info" step="0.01"
                            value="{{ old('deformity_specified', $beneficiaryData['getList'][0]->deformity_specified) }}">
                        <label><span class="border-info ps-3">If Yes, then specified the deformity</span></label>
                    </div>

                    <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                        <select class="form-control form-select border border-info p-3" name="is_nursing_services" id="userTypeSelect">
                            <option value="#" selected disabled>Will Undergo Nursing Services?</option>
                            <option value="0" {{ old('is_nursing_services', $beneficiaryData['getList'][0]->is_nursing_services) === '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('is_nursing_services', $beneficiaryData['getList'][0]->is_nursing_services) === '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        <div class="text-dark">You can still change this</div>
                    </div>
                </div>

                <div class="m-0 mt-3 p-0">
                    <button type="button" class="justify-content-center btn mb-1 btn-danger d-flex align-items-center">
                        <i class="ti ti-heart fs-4 me-2"></i>
                        Notes/Explanation
                    </button>
                </div>
                <div class="shadow-lg m-0 d-flex row pt-3">
                    <div class="form-floating mb-3 mt-3 col-lg-4 col-md-6 col-12">
                        <textarea type="text" name="explanation" class="form-control border border-info" step="0.01"
                            value="{{ old('explanation', $beneficiaryData['getList'][0]->explanation) }}">
                        </textarea>
                        <label><span class="border-info ps-3">Explanation & Notes you may add</span></label>
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
            @include('validator/form-validator')
        </div>
    </div>
