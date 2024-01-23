<div class="d-flex row">
    <div class="card col-md-5 shadow-lg rounded border-2 border-primary" style="height: fit-content;">
        <div class="d-flex px-4 pt-3">
        <h6 class="card-title my-3">Learner's Profile Information</h6>
        </div>
        <div class="d-flex px-4 rounded">


            <div class="col-5">
                @if ($pupil->profile_photo)
                <img class="h-100 rounded" src="{{ asset('storage/' . $pupil->profile_photo) }}" alt="Profile Photo">
                @else
                <img src="{{ asset('background-images/Blank-Profile-Picture-0.jpg') }}" class="h-100 rounded"
                    alt="Profile Photo">
                @endif
            </div>

            <div class="col-7">
                <div class="mt-9 py-6 d-flex align-items-center">
                    <div class="ms-3">
                        <h6 class="mb-0 fw-semibold text-end">{{ $pupil->first_name }} {{ $pupil->middle_name }}
                            {{ $pupil->last_name }}@if(!empty($pupil->suffix)), @endif {{ $pupil->suffix }}
                        </h6>
                        <span class="fs-3">Name</span>
                    </div>
                    <div class="ms-auto">
                        <span class="fs-2"> </span>
                    </div>
                </div>
                <div class="py-6 d-flex align-items-center">
                    <div class="ms-3">
                        <h6 class="mb-0 fw-semibold">{{ $pupil->lrn }}</h6>
                        <span class="fs-3">Learner Reference Number</span>
                    </div>
                    <div class="ms-auto">
                        <span class="fs-2"></span>
                    </div>
                </div>
                <div class="py-6 d-flex align-items-center">
                    <div class="ms-3">
                        <h6 class="mb-0 fw-semibold">{{ $pupil->gender }}</h6>
                        <span class="fs-3">Gender</span>
                    </div>

                </div>
                <hr>

            </div>


        </div>

        <div class="d-flex row py-4 px-4">
            <div class="pt-6 d-flex align-items-center">
                @php
                    $dob = \Carbon\Carbon::parse($pupil->date_of_birth);
                    $age = $dob->age;
                @endphp
                <div class="ms-0">
                    <span class="fs-3">Date of Birth</span>
                </div>
                <div class="ms-auto">
                    <span class="fs-2">{{ \Carbon\Carbon::parse($pupil->date_of_birth)->format('F j, Y') }}</span>
                </div>
            </div>
            <div class="pt-6 d-flex align-items-center">
                <div class="ms-0">
                    <span class="fs-3">Current Age</span>
                </div>
                <div class="ms-auto">
                    <span class="fs-2">{{ $age }} years old</span>
                </div>
            </div>
            <div class="pt-6 d-flex align-items-center">
                <div class="ms-0">
                    <h6 class="mb-0 fw-semibold "></h6>
                    <span class="fs-3">Guardian's Name</span>
                </div>
                <div class="ms-auto">
                {{ $pupil->pupil_guardian_name ?? 'N/A'}}
                </div>
            </div>
            <div class="pt-6 d-flex align-items-center">
                <div class="ms-0">
                    <h6 class="mb-0 fw-semibold "></h6>
                    <span class="fs-3">Guardian's Phone Number</span>
                </div>
                <div class="ms-auto">
                {{ $pupil->pupil_guardian_contact_no ?? 'N/A' }}
                </div>
            </div>
            <div class="pt-6 d-flex align-items-center mb-3">
                <div class="ms-0">
                    <h6 class="mb-0 fw-semibold">

                    </h6>
                    <span class="fs-3">Address</span>
                </div>
                <div class="ms-auto">
                @if (!empty($pupil->barangay) || !empty($pupil->municipality) ||
                        !empty($pupil->province))
                        {{ $pupil->barangay }} {{ $pupil->municipality }},
                        {{ $pupil->province }}
                        @else
                        N/A
                        @endif
                </div>
            </div>
            <hr>

            <div class="pt-0 d-flex align-items-center mb-1">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center">
                    <i class="ti ti-calendar text-info fs-6"></i>
                </div>
                <div class="ms-2">
                    <h6 class="mb-0 fw-semibold"></h6>
                    <span class="fs-3">Added On</span>
                </div>
                <div class="ms-auto d-flex row">
                <span class="fs-2">{{ \Carbon\Carbon::parse($pupil->created_at)->format('F d, Y \a\t h:i:s A') }}</span>
                </div>

            </div>
            <div class="pt-0 d-flex align-items-center mb-1">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center">
                    <i class="ti ti-calendar text-info fs-6"></i>
                </div>
                <div class="ms-2">
                    <h6 class="mb-0 fw-semibold"></h6>
                    <span class="fs-3"> Updated On</span>
                </div>
                <div class="ms-auto d-flex row">
                <span class="fs-2">{{ \Carbon\Carbon::parse($pupil->updated_at)->format('F d, Y \a\t H:i:s A') }}</span>
                </div>
            </div>
        </div>

    </div>

    
    <div class="col-md-7">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <ul class="timeline-widget mb-0">
                    @php $promoted_from = '' @endphp
                    @foreach($pupilDataLineUp['getList'] as $general)
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">
                                {{ $schoolYearName[$schoolYearId[$general->class_id]] }}<br>
                                <b>G - {{ $gradeName[$general->class_id] }}</b>
                            </div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border bg-muted d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 text-start">
                                {{ $pupil->first_name }} attended <b>Grade {{ $gradeName[$general->class_id] }} 
                                - Section {{ $sectionNames[$sectionId[$general->class_id]] }},</b><br>
                                in the {{ $schoolName[$schoolIds[$general->class_id]] }},
                                {{ $districtName[$districtIds[$schoolIds[$general->class_id]]] }} District.
                                And was under by class adviser <b>{{ $adviserName[$adviserIds[$general->class_id]] }}.</b><br>
                                @if($general->promoted == 'Yes' && $gradeName[$general->class_id] !== 'Kinder')
                                @if($pupil->gender == 'Male')
                                He 
                                @else
                                She 
                                @endif
                                is promoted from {{ $promoted_from }}
                                @endif
                                @if($general->transferred == 'Yes')
                                    He was also a transferee.
                                @endif
                                @if($general->repeated == 'Yes')
                                    Unfortunately, he repeated in the same grade.
                                @endif
                                @if($general->dropped == 'Yes')
                                    And unfortunately, he was dropped in this class.
                                @endif
                            </div>
                            
                        </li>
                        @php $promoted_from = $gradeName[$general->class_id] @endphp
                        <hr>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>


</div>
