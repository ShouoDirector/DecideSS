<div class="card">
    <div class="card-body shadow-lg mt-0 py-3 px-3 fs-4 fw-semibold rounded">
        Records As Beneficiary
    </div>

    @if (!empty($beneficiaryData['getList']))
    @foreach ($beneficiaryData['getList'] as $beneficiary)
    <div class="card-body shadow-lg mt-2 rounded">
        <div class="d-flex align-items-baseline mb-1">
            <span class="round-8 bg-primary rounded-circle me-6"></span>
            <div>
                <p class="fs-3 mb-1">School Year Phase
                    {{ $schoolYearName[$beneficiary->schoolyear_id] }}
                    {{ $schoolYearPhase[$beneficiary->schoolyear_id] }}</p>
            </div>
        </div>
        <div class="d-flex align-items-baseline mb-1">
            <span class="round-8 bg-primary rounded-circle me-6"></span>
            <div>
                <p class="fs-3 mb-1">
                    Date of Examination:
                    {{ \Carbon\Carbon::parse($beneficiary->date_of_examination)->format('F j, Y') }}
                </p>
            </div>
        </div>
        @if ($beneficiary->is_feeding_program == '1')
        <div class="badge mt-1 bg-primary">
            Feeding Program
        </div>
        @endif

        @if ($beneficiary->is_deworming_program == '1')
        <div class="badge mt-1 bg-warning">
            Deworming Program
        </div>
        @endif

        @if ($beneficiary->is_immunization_vax_program == '1')
        <div class="badge mt-1 bg-warning">
            Immunization Vax Program
        </div>
        @endif

        @if ($beneficiary->is_mental_healthcare_program == '1')
        <div class="badge mt-1 bg-danger">
            Mental Health Program
        </div>
        @endif

        @if ($beneficiary->is_dental_care_program == '1')
        <div class="badge mt-1 bg-secondary">
            Dental Care Program
        </div>
        @endif

        @if ($beneficiary->is_eye_care_program == '1')
        <div class="badge mt-1 bg-secondary">
            Eye Care Program
        </div>
        @endif

        @if ($beneficiary->is_health_wellness_program == '1')
        <div class="badge mt-1 bg-success">
            Health And Wellness Program
        </div>
        @endif

        @if ($beneficiary->is_medical_support_program == '1')
        <div class="badge mt-1 bg-danger">
            Medical Support Program
        </div>
        @endif

        @if ($beneficiary->is_nursing_services == '1')
        <div class="badge mt-1 bg-danger">
            Nursing Services Program
        </div>
        @endif

        @endforeach
        @endif

        @if (!empty($beneficiaryData['getList']))
        @foreach ($beneficiaryData['getList'] as $beneficiary)
        <div class="d-flex align-items-center justify-content-between mb-1 mt-4">
            <div class="d-flex">
                <div class="p-6 bg-light-primary rounded me-6 d-flex align-items-center justify-content-center">
                    <i class="ti ti-map-pin text-primary fs-6"></i>
                </div>
                <div>
                    <h6 class="mb-1 fs-4 fw-semibold">Grade {{ $gradeName[$beneficiary->class_id] }}
                        -
                        Section
                        {{ $className[$beneficiary->class_id] }}
                    </h6>
                    <p class="fs-3 mb-0">{{ $schoolName[$schoolIds[$beneficiary->class_id]] }}</p>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-1 mt-4">
            <div class="d-flex">
                <div class="p-6 bg-light-success rounded me-6 d-flex align-items-center justify-content-center">
                    <i class="ti ti-pin text-primary fs-6"></i>
                </div>
                <div>
                    <h6 class="mb-1 fs-3">Class Adviser:
                        {{ $adviserName[$beneficiary->classadviser_id] }}
                    </h6>
                    <p class="fs-3 mb-0">School Nurse:
                        {{ $schoolNurseName[$beneficiary->school_nurse_id] }}</p>
                </div>
            </div>
        </div>

        @endforeach
        @endif

        <div class="card-body p-1 mt-1 rounded">
            <p class="mt-3">Notes / Observations :</p>
            <span>{{ $beneficiary->deformity_specified ?? 'None'}}</span>
        </div>

    </div>


    <div class="accordion accordion-flush mb-5 px-4 rounded card position-relative overflow-hidden"
        id="accordionFlushExample">
        @if (!empty($beneficiaryData['getList']))
        @foreach ($beneficiaryData['getList'] as $beneficiary)

        @if ($beneficiary->is_feeding_program == '1')
        <div class="accordion-item mt-1">
            <h2 class="accordion-header" id="flush-headingOne">
                <button
                    class="accordion-button collapsed px-4 py-3 fs-4 rounded border-start border-2 border-primary shadow"
                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true"
                    aria-controls="flush-collapseOne">
                    Feeding Program?
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body fw-normal">
                    Reason :
                    @if($beneficiary->bmi_category == 'Severely Wasted')
                    <span class="badge bg-danger">
                        Severely Wasted
                        <i class="ti ti-check"></i>
                    </span>
                    @endif
                    @if($beneficiary->bmi_category == 'Wasted')
                    <span class="badge bg-danger">
                        Wasted
                        <i class="ti ti-check"></i>
                    </span>
                    @endif
                    @if($beneficiary->hfa_category == 'Severely Stunted')
                    <span class="badge bg-danger">
                        Severely Stunted
                        <i class="ti ti-check"></i>
                    </span>
                    @endif
                    @if($beneficiary->hfa_category == 'Stunted')
                    <span class="badge bg-danger">
                        Stunted
                        <i class="ti ti-check"></i>
                    </span>
                    @endif
                    <br>
                    <span class="mt-1">Or Upon the decision of the school nurse</span>
                </div>
            </div>
        </div>
        @endif

        @if($beneficiary->is_deworming_program == '1')
        <div class="accordion-item mt-1">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button
                    class="accordion-button px-4 py-3 rounded collapsed fs-4 border-start border-2 border-primary shadow"
                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                    aria-controls="flush-collapseTwo">
                    Deworming Program?
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body fw-normal">

                    <span class="badge bg-primary">
                        Reason : Either Permitted By Parent or Undecided
                        <i class="ti ti-check"></i>
                    </span>
                    <br>
                    <span class="mt-1">Or Upon the decision of the school nurse</span>

                </div>
            </div>
        </div>
        @endif

        @if($beneficiary->is_immunization_vax_program == '1')
        <div class="accordion-item mt-1">
            <h2 class="accordion-header" id="flush-headingThree">
                <button
                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false"
                    aria-controls="flush-collapseThree">
                    Immunization/Vaccination Program?
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body fw-normal">

                    <span class="badge bg-primary">
                        Reason : Upon decision of the school nurse
                        <i class="ti ti-check"></i>
                    </span>

                </div>
            </div>
        </div>
        @endif

        @if($beneficiary->is_mental_healthcare_program == '1')
        <div class="accordion-item mt-1">
            <h2 class="accordion-header" id="flush-headingFour">
                <button
                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false"
                    aria-controls="flush-collapseFour">
                    Mental Health Program?
                </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body fw-normal">

                    <span class="badge bg-primary">
                        Reason : Upon decision of the school nurse
                        <i class="ti ti-check"></i>
                    </span>

                </div>
            </div>
        </div>
        @endif

        @if($beneficiary->is_dental_care_program == '1')
        <div class="accordion-item mt-1">
            <h2 class="accordion-header" id="flush-headingFive">
                <button
                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false"
                    aria-controls="flush-collapseFive">
                    Dental Care Program?
                </button>
            </h2>
            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body fw-normal">

                    <span class="badge bg-primary">
                        Reason : Upon decision of the school nurse
                        <i class="ti ti-check"></i>
                    </span>

                </div>
            </div>
        </div>
        @endif

        @if($beneficiary->is_eye_care_program == '1')
        <div class="accordion-item mt-1">
            <h2 class="accordion-header" id="flush-headingSix">
                <button
                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false"
                    aria-controls="flush-collapseSix">
                    Eye Care Program?
                </button>
            </h2>
            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body fw-normal">
                    Reason:
                    @if($beneficiary->vision_screening == '1')
                    <span class="badge bg-primary">
                        Vision Screening Failed
                        <i class="ti ti-check"></i>
                    </span>
                    @endif
                    <br>
                    <span class="mt-1">Or Upon the decision of the school nurse</span>

                </div>
            </div>
        </div>
        @endif

        @if($beneficiary->is_health_wellness_program == '1')
        <div class="accordion-item mt-1">
            <h2 class="accordion-header" id="flush-headingSeven">
                <button
                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false"
                    aria-controls="flush-collapseSeven">
                    Health and Wellness Program?
                </button>
            </h2>
            <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body fw-normal">
                    Reason:
                    @if($beneficiary->bmi_category == 'Severely Wasted')
                    <span class="badge bg-danger">
                        Severely Wasted
                        <i class="ti ti-check"></i>
                    </span>
                    @endif
                    @if($beneficiary->bmi_category == 'Wasted')
                    <span class="badge bg-danger">
                        Wasted
                        <i class="ti ti-check"></i>
                    </span>
                    @endif
                    @if($beneficiary->hfa_category == 'Severely Stunted')
                    <span class="badge bg-danger">
                        Severely Stunted
                        <i class="ti ti-check"></i>
                    </span>
                    @endif
                    @if($beneficiary->hfa_category == 'Stunted')
                    <span class="badge bg-danger">
                        Stunted
                        <i class="ti ti-check"></i>
                    </span>
                    @endif
                    @if($beneficiary->bmi_category == 'Overweight')
                    <span class="badge bg-danger">
                        Overweight
                        <i class="ti ti-check"></i>
                    </span>
                    @endif
                    @if($beneficiary->bmi_category == 'Obese')
                    <span class="badge bg-danger">
                        Obese
                        <i class="ti ti-check"></i>
                    </span>
                    @endif
                    @if($beneficiary->menarche == '1')
                    <span class="badge bg-danger">
                        Menarche
                        <i class="ti ti-check"></i>
                    </span>
                    @endif

                    <br>
                    <span class="mt-1">Or Upon the decision of the school nurse</span>

                </div>
            </div>
        </div>
        @endif

        @if($beneficiary->is_medical_support_program == '1')
        <div class="accordion-item mt-1">
            <h2 class="accordion-header" id="flush-headingEight">
                <button
                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false"
                    aria-controls="flush-collapseEight">
                    Medical Support Program?
                </button>
            </h2>
            <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body fw-normal">

                    <span class="badge bg-primary">
                        Reason : Upon decision of the school nurse
                        <i class="ti ti-check"></i>
                    </span>

                </div>
            </div>
        </div>
        @endif

        @if($beneficiary->is_nursing_services == '1')
        <div class="accordion-item mt-1">
            <h2 class="accordion-header" id="flush-headingNine">
                <button
                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false"
                    aria-controls="flush-collapseNine">
                    Nursing Services?
                </button>
            </h2>
            <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body fw-normal">
                    Reason : Upon the decision of school nurse.
                </div>
            </div>
        </div>
        @endif

        <div class="mt-2">
            Date of Examination:
            {{ \Carbon\Carbon::parse($beneficiary->date_of_examination)->format('F j, Y') }}
        </div>
        <div class="mt-2 text-end">
            Recorded When: {{ \Carbon\Carbon::parse($beneficiary->created_at)->format('F j, Y') }}
        </div>
        <div class="mb-3 text-end">
            Updated When: {{ \Carbon\Carbon::parse($beneficiary->updated_at)->format('F j, Y') }}
        </div>
    </div>
    @endforeach
    @endif
</div>
