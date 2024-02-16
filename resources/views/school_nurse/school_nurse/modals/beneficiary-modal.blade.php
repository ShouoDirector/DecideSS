<div class="modal fade" id="beneficiary-modal-{{ $Id }}" tabindex="-1" aria-labelledby="beneficiary-modal-{{ $Id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded">
            <div class="modal-header d-flex align-items-center px-4 pt-4">
                <h4 class="modal-title" id="myLargeModalLabel">
                    More Information About The Beneficiary
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="p-2" style="white-space: normal;">
                    Class: Grade {{ $data['getRecord'][$loop->index]->class_id }},
                    {{ $className[$data['getRecord'][$loop->index]->class_id] }} <br>
                    Class Adviser: {{ $adviserName[$data['getRecord'][$loop->index]->classadviser_id] }} <br><br>
                    {{ $dataPupilNames[$data['getRecord'][$loop->index]->pupil_id] }}

                    @if ($data['getRecord'][$loop->index]->is_feeding_program == '1')
                    <div class="badge mt-1 bg-primary">
                        Feeding Program
                    </div>
                    @endif

                    @if ($data['getRecord'][$loop->index]->is_deworming_program == '1')
                    <div class="badge mt-1 bg-warning">
                        Deworming Program
                    </div>
                    @endif

                    @if ($data['getRecord'][$loop->index]->is_immunization_vax_program == '1')
                    <div class="badge mt-1 bg-warning">
                        Immunization Vax Program
                    </div>
                    @endif

                    @if ($data['getRecord'][$loop->index]->is_mental_healthcare_program == '1')
                    <div class="badge mt-1 bg-danger">
                        Mental Health Program
                    </div>
                    @endif

                    @if ($data['getRecord'][$loop->index]->is_dental_care_program == '1')
                    <div class="badge mt-1 bg-secondary">
                        Dental Care Program
                    </div>
                    @endif

                    @if ($data['getRecord'][$loop->index]->is_eye_care_program == '1')
                    <div class="badge mt-1 bg-secondary">
                        Eye Care Program
                    </div>
                    @endif

                    @if ($data['getRecord'][$loop->index]->is_health_wellness_program == '1')
                    <div class="badge mt-1 bg-success">
                        Health And Wellness Program
                    </div>
                    @endif

                    @if ($data['getRecord'][$loop->index]->is_medical_support_program == '1')
                    <div class="badge mt-1 bg-danger">
                        Medical Support Program
                    </div>
                    @endif

                    @if ($data['getRecord'][$loop->index]->is_nursing_services == '1')
                    <div class="badge mt-1 bg-danger">
                        Nursing Services Program
                    </div>
                    @endif

                    <div class="accordion accordion-flush mb-5 mt-3 px-4 rounded card position-relative overflow-hidden"
                        id="accordionFlushExample">

                        @if ($data['getRecord'][$loop->index]->is_feeding_program == '1')
                        <div class="accordion-item mt-1">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button
                                    class="accordion-button collapsed px-4 py-3 fs-4 rounded border-start border-2 border-primary shadow"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                    aria-expanded="true" aria-controls="flush-collapseOne">
                                    Feeding Program?
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    Reason :
                                    @if($data['getRecord'][$loop->index]->bmi_category == 'Severely Wasted')
                                    <span class="badge bg-danger">
                                        Severely Wasted
                                        <i class="ti ti-check"></i>
                                    </span>
                                    @endif
                                    @if($data['getRecord'][$loop->index]->bmi_category == 'Wasted')
                                    <span class="badge bg-danger">
                                        Wasted
                                        <i class="ti ti-check"></i>
                                    </span>
                                    @endif
                                    @if($data['getRecord'][$loop->index]->hfa_category == 'Severely Stunted')
                                    <span class="badge bg-danger">
                                        Severely Stunted
                                        <i class="ti ti-check"></i>
                                    </span>
                                    @endif
                                    @if($data['getRecord'][$loop->index]->hfa_category == 'Stunted')
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

                        @if($data['getRecord'][$loop->index]->is_deworming_program == '1')
                        <div class="accordion-item mt-1">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button
                                    class="accordion-button px-4 py-3 rounded collapsed fs-4 border-start border-2 border-primary shadow"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                    aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Deworming Program?
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
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

                        @if($data['getRecord'][$loop->index]->is_immunization_vax_program == '1')
                        <div class="accordion-item mt-1">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button
                                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                    aria-expanded="false" aria-controls="flush-collapseThree">
                                    Immunization/Vaccination Program?
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">

                                    <span class="badge bg-primary">
                                        Reason : Upon decision of the school nurse
                                        <i class="ti ti-check"></i>
                                    </span>

                                </div>
                            </div>
                        </div>
                        @endif

                        @if($data['getRecord'][$loop->index]->is_mental_healthcare_program == '1')
                        <div class="accordion-item mt-1">
                            <h2 class="accordion-header" id="flush-headingFour">
                                <button
                                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour"
                                    aria-expanded="false" aria-controls="flush-collapseFour">
                                    Mental Health Program?
                                </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">

                                    <span class="badge bg-primary">
                                        Reason : Upon decision of the school nurse
                                        <i class="ti ti-check"></i>
                                    </span>

                                </div>
                            </div>
                        </div>
                        @endif

                        @if($data['getRecord'][$loop->index]->is_dental_care_program == '1')
                        <div class="accordion-item mt-1">
                            <h2 class="accordion-header" id="flush-headingFive">
                                <button
                                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive"
                                    aria-expanded="false" aria-controls="flush-collapseFive">
                                    Dental Care Program?
                                </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">

                                    <span class="badge bg-primary">
                                        Reason : Upon decision of the school nurse
                                        <i class="ti ti-check"></i>
                                    </span>

                                </div>
                            </div>
                        </div>
                        @endif

                        @if($data['getRecord'][$loop->index]->is_eye_care_program == '1')
                        <div class="accordion-item mt-1">
                            <h2 class="accordion-header" id="flush-headingSix">
                                <button
                                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix"
                                    aria-expanded="false" aria-controls="flush-collapseSix">
                                    Eye Care Program?
                                </button>
                            </h2>
                            <div id="flush-collapseSix" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    Reason:
                                    @if($data['getRecord'][$loop->index]->vision_screening == '1')
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

                        @if($data['getRecord'][$loop->index]->is_health_wellness_program == '1')
                        <div class="accordion-item mt-1">
                            <h2 class="accordion-header" id="flush-headingSeven">
                                <button
                                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven"
                                    aria-expanded="false" aria-controls="flush-collapseSeven">
                                    Health and Wellness Program?
                                </button>
                            </h2>
                            <div id="flush-collapseSeven" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    Reason:
                                    @if($data['getRecord'][$loop->index]->bmi_category == 'Severely Wasted')
                                    <span class="badge bg-danger">
                                        Severely Wasted
                                        <i class="ti ti-check"></i>
                                    </span>
                                    @endif
                                    @if($data['getRecord'][$loop->index]->bmi_category == 'Wasted')
                                    <span class="badge bg-danger">
                                        Wasted
                                        <i class="ti ti-check"></i>
                                    </span>
                                    @endif
                                    @if($data['getRecord'][$loop->index]->hfa_category == 'Severely Stunted')
                                    <span class="badge bg-danger">
                                        Severely Stunted
                                        <i class="ti ti-check"></i>
                                    </span>
                                    @endif
                                    @if($data['getRecord'][$loop->index]->hfa_category == 'Stunted')
                                    <span class="badge bg-danger">
                                        Stunted
                                        <i class="ti ti-check"></i>
                                    </span>
                                    @endif
                                    @if($data['getRecord'][$loop->index]->bmi_category == 'Overweight')
                                    <span class="badge bg-danger">
                                        Overweight
                                        <i class="ti ti-check"></i>
                                    </span>
                                    @endif
                                    @if($data['getRecord'][$loop->index]->bmi_category == 'Obese')
                                    <span class="badge bg-danger">
                                        Obese
                                        <i class="ti ti-check"></i>
                                    </span>
                                    @endif
                                    @if($data['getRecord'][$loop->index]->menarche == '1')
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

                        @if($data['getRecord'][$loop->index]->is_medical_support_program == '1')
                        <div class="accordion-item mt-1">
                            <h2 class="accordion-header" id="flush-headingEight">
                                <button
                                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight"
                                    aria-expanded="false" aria-controls="flush-collapseEight">
                                    Medical Support Program?
                                </button>
                            </h2>
                            <div id="flush-collapseEight" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">

                                    <span class="badge bg-primary">
                                        Reason : Upon decision of the school nurse
                                        <i class="ti ti-check"></i>
                                    </span>

                                </div>
                            </div>
                        </div>
                        @endif

                        @if($data['getRecord'][$loop->index]->is_nursing_services == '1')
                        <div class="accordion-item mt-1">
                            <h2 class="accordion-header" id="flush-headingNine">
                                <button
                                    class="accordion-button px-4 py-3 collapsed fs-4 rounded border-start border-2 border-primary shadow"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine"
                                    aria-expanded="false" aria-controls="flush-collapseNine">
                                    Nursing Services?
                                </button>
                            </h2>
                            <div id="flush-collapseNine" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body fw-normal">
                                    Reason :
                                    @if($data['getRecord'][$loop->index]->iron_supplementation == '1')
                                    <span class="badge bg-primary">
                                        Need Iron Supplementation
                                        <i class="ti ti-check"></i>
                                    </span>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->temperature))
                                    <p>Temperature: {{ $data['getRecord'][$loop->index]->temperature }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->blood_pressure))
                                    <p>Blood Pressure: {{ $data['getRecord'][$loop->index]->blood_pressure }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->heart_rate))
                                    <p>Heart Rate: {{ $data['getRecord'][$loop->index]->heart_rate }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->pulse_rate))
                                    <p>Pulse Rate: {{ $data['getRecord'][$loop->index]->pulse_rate }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->respiratory_rate))
                                    <p>Respiratory Rate: {{ $data['getRecord'][$loop->index]->respiratory_rate }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->vision_screening))
                                    <p>Vision Screening:
                                        {{ $data['getRecord'][$loop->index]->vision_screening == '1' ? 'Passed' : 'Failed' }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->auditory_screening))
                                    <p>Auditory Screening:
                                        {{ $data['getRecord'][$loop->index]->auditory_screening == '1' ? 'Passed' : 'Failed' }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->skin_scalp))
                                    <p>Skin Scalp: {{ $data['getRecord'][$loop->index]->skin_scalp }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->eyes))
                                    <p>Eyes: {{ $data['getRecord'][$loop->index]->eyes }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->ear))
                                    <p>Ear: {{ $data['getRecord'][$loop->index]->ear }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->nose))
                                    <p>Nose: {{ $data['getRecord'][$loop->index]->nose }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->mouth))
                                    <p>Mouth: {{ $data['getRecord'][$loop->index]->mouth }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->neck))
                                    <p>Neck: {{ $data['getRecord'][$loop->index]->neck }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->throat))
                                    <p>Throat: {{ $data['getRecord'][$loop->index]->throat }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->lungs))
                                    <p>Lungs: {{ $data['getRecord'][$loop->index]->lungs }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->heart))
                                    <p>Heart: {{ $data['getRecord'][$loop->index]->heart }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->abdomen))
                                    <p>Abdomen: {{ $data['getRecord'][$loop->index]->abdomen }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->deformities))
                                    <p>Deformities: {{ $data['getRecord'][$loop->index]->deformities == '1' ? 'Yes' : 'No' }}</p><br>
                                    @endif

                                    @if (!empty($data['getRecord'][$loop->index]->deformity_specified))
                                    <p>Deformity Specified: {{ $data['getRecord'][$loop->index]->deformity_specified }}</p><br>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>

                    Observation/Notes : {{ $data['getRecord'][$loop->index]->explanation ?? 'None' }}<br><br>
                    Date of Examination : {{ \Carbon\Carbon::parse($data['getRecord'][$loop->index]->date_of_examination)->format('F j, Y \a\t h:i a') }}<br>
                    Recorded When : {{ \Carbon\Carbon::parse($data['getRecord'][$loop->index]->created_at)->format('F j, Y \a\t h:i a') }}<br>
                    Updated When : {{ \Carbon\Carbon::parse($data['getRecord'][$loop->index]->updated_at)->format('F j, Y \a\t h:i a') }}
                </h6>
                <br>
                <div class="d-flex row text-white mx-1">
                    <a href="#" type="button" class="btn btn-primary card-hover text-white" data-bs-toggle="tooltip">
                        Okay</a>
                </div>
            </div>
        </div>
    </div>
</div>
