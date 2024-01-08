<div class="mt-2 mb-2 d-flex row">
    <div class="col-md-5 p-1">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold">General</h5>
                    <p class="card-subtitle mb-7">Related Information</p>
                    <div class="col-12">
                        @php
                        $getData = $dataSection['getData']->toArray();
                        @endphp
                        <div class="d-flex justify-content-between">
                            <div class="card-subtitle mb-2 text-muted text-muted">School</div>
                            <div class="fs-4">{{ $schoolName[$getData[0]['school_id']] }}</div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <div class="card-subtitle mb-2 text-muted text-muted">School ID {{$schoolID[$getData[0]['school_id']]}}
                            </div>
                            <div class="fs-4"> - Location 
                                {{$schoolAddress[$getData[0]['school_id']]}}
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <div class="fs-4">{{ Auth::user()->name }}
                            </div>
                            <div class="card-subtitle mb-2 text-muted text-muted">School Nurse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 p-1">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold">Demographic Data</h5>
                    <p class="card-subtitle mb-7">Based on all MasterLists*</p>
                    <div class="col-12 mb-3">
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Male</div>
                            @php 
                                $countMale = 0; 
                                $countFemale = 0;
                                $countTotal = 0;
                            @endphp
                            @foreach($dataMasterList['getRecord'] as $pupil)
                                    @php $countTotal++; @endphp
                                @if($dataPupilGender[$pupil->pupil_id] == 'Male')
                                    @php $countMale++; @endphp
                                @elseif($dataPupilGender[$pupil->pupil_id] == 'Female')
                                    @php $countFemale++; @endphp
                                @endif
                            @endforeach
                            <div class="col-auto">{{ $countMale }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Female</div>
                            <div class="col-auto">{{ $countFemale }}</div>
                        </div>
                        <hr>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Total</div>
                            <div class="col-auto">{{ $countTotal }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 p-1">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold">Nutritional Assessments</h5>
                    <p class="card-subtitle mb-7">Related Data</p>
                    <div class="col-12 mb-3">
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Assessed</div>
                            <div class="col-auto">{{ $totalPupils[0] }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Not Assessed Yet <i class="ti ti-alert-circle"
                                    data-bs-toggle="tooltip" title="Pupils In MasterList With No Nutritional Assessment"></i></div>
                            <div class="col-auto">{{ $countTotal - $totalPupils[0] }}</div>
                        </div>
                        <hr>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Dietary Restriction/s <i class="ti ti-alert-circle"
                                    data-bs-toggle="tooltip" title="Pupils With Dietary Restrictions"></i></div>
                            <div class="col-auto">
                                {{ $dataNaRecords['getRecord']->where('dietary_restriction', '!=', null)->where('dietary_restriction', '!=', '')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 p-1">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold">Deworming</h5>
                    <p class="card-subtitle mb-7">Related Data</p>
                    <div class="col-12 mb-3">
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Permitted</div>
                            <div class="col-auto">
                                {{ $dataNaRecords['getRecord']->where('is_permitted_deworming', '1')->count() }}</div>

                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Not Permitted</div>
                            <div class="col-auto">
                                {{ $dataNaRecords['getRecord']->where('is_permitted_deworming', '0')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Undecided</div>
                            <div class="col-auto">
                                {{ $dataNaRecords['getRecord']->where('is_permitted_deworming', NULL)->count() }}</div>
                        </div>
                        <hr>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Dewormed <i class="ti ti-alert-circle" data-bs-toggle="tooltip"
                                    title="Pupils That Undergone Deworming In The Past Year"></i></div>
                            <div class="col-auto">{{ $dataNaRecords['getRecord']->where('is_dewormed', '1')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 p-1">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold">Referrals</h5>
                    <p class="card-subtitle mb-7">Referrals You Made</p>
                    <div class="col-12 mb-3">
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Referred Pupils</div>
                            <div class="col-auto">{{ $dataReferrals['getRecords']->unique('pupil_id')->count() }}</div>

                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Referrals</div>
                            <div class="col-auto">{{ $dataReferrals['getRecords']->count() }}</div>
                        </div>
                    </div>
                    <a type="button" class="btn btn-outline-primary w-100"
                        href="{{ route('school_nurse.school_nurse.referrals') }}">View Referrals</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 p-1">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold">Beneficiaries</h5>
                    <p class="card-subtitle mb-7">And Healthcare Services</p>
                    <div class="col-12 mb-3">
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">No. of Beneficiaries</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->count() }}</div>

                        </div>
                        <hr>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Feeding</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_feeding_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Deworming</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_deworming_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Immunization</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_immunization_vax_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Mental Healthcare</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_mental_healthcare_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Dental Care</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_dental_care_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Medical Support</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_medical_support_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Nursing Services</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_nursing_services', '1')->count() }}</div>
                        </div>
                    </div>

                    <a type="button" class="btn btn-outline-primary w-100"
                        href="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}">View Beneficiaries</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 p-1">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold">MasterLists</h5>
                    <p class="card-subtitle mb-7">Related Data</p>
                    <div class="col-12 mb-3">
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">No. of Masterlists</div>
                            <div class="col-auto">{{ $dataClass['classRecords']->count() }}</div>

                        </div>
                    </div>
                    <a type="button" class="btn btn-outline-primary w-100"
                        href="{{ route('school_nurse.school_nurse.list_of_masterlist') }}">View MasterLists</a>
                </div>
            </div>
        </div>
    </div>



</div>