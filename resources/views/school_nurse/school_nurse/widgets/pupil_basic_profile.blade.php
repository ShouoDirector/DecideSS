<div class="d-flex row gap-2">
    <div class="card col-md-5 shadow-lg rounded border-2 border-primary" style="height: fit-content;">
        <div class="p-4 rounded">
            <h6 class="card-title my-3">Learner's Profile Information</h6>

            @if ($pupil->profile_photo)
            <img class="w-100 h-100 rounded" src="{{ asset('storage/' . $pupil->profile_photo) }}" alt="Profile Photo">
            @else
            <img src="{{ asset('background-images/Blank-Profile-Picture-0.jpg') }}" class="w-100 h-100 rounded"
                alt="Profile Photo">
            @endif

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
                    <span class="fs-2">LRN</span>
                </div>
            </div>
            <div class="py-6 d-flex align-items-center">
                <div class="ms-3">
                    <h6 class="mb-0 fw-semibold">{{ $pupil->gender }}</h6>
                    <span class="fs-3">Gender</span>
                </div>
                <div class="ms-auto">
                    <span class="fs-2"><i
                            class="{{ ($pupil->gender == 'Male' || $pupil->gender == 'Female') ? ($pupil->gender == 'Female' ? 'ti ti-gender-female' : 'ti ti-gender-male') : 'default-gender-class' }} fs-6 text-success"></i></span>
                </div>
            </div>
            <div class="pt-6 d-flex align-items-center">
                <div class="ms-3">
                    @php
                    $dob = \Carbon\Carbon::parse($pupil->date_of_birth);
                    $age = $dob->age;
                    @endphp
                    <h6 class="mb-0 fw-semibold">
                        {{ \Carbon\Carbon::parse($pupil->date_of_birth)->format('F j, Y') }} | {{ $age }} years old
                    </h6>
                    <span class="fs-3">Date of Birth / Age</span>
                </div>
                <div class="ms-auto">
                    <span class="fs-2"> </span>
                </div>
            </div>
            <div class="py-6 d-flex align-items-center">
                <div class="ms-3">
                    <h6 class="mb-0 fw-semibold ">{{ $pupil->pupil_guardian_name}}</h6>
                    <span class="fs-3">Guardian Name & Phone Number</span>
                </div>
                <div class="ms-auto">
                    <span class="fs-2">{{ $pupil->pupil_guardian_contact_no }}</span>
                </div>
            </div>
            <div class="pt-6 d-flex align-items-center">
                <div class="ms-3">
                    <h6 class="mb-0 fw-semibold">
                        @if (!empty($pupil->barangay) || !empty($pupil->municipality) ||
                        !empty($pupil->province))
                        {{ $pupil->barangay }} {{ $pupil->municipality }},
                        {{ $pupil->province }}
                        @endif
                    </h6>
                    <span class="fs-3">Address</span>
                </div>
                <div class="ms-auto">
                    <span class="fs-2"> </span>
                </div>
            </div>
            <hr>
            <div class="pt-0 d-flex align-items-center mb-1">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center">
                    <i class="ti ti-user text-info fs-6"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 fw-semibold"></h6>
                    <span class="fs-3">Added By</span>
                </div>
                <div class="ms-auto d-flex row">
                    <span class="fs-2">CA {{ $adviserName[$pupil->added_by] }}</span>
                </div>

            </div>
            <div class="pt-0 d-flex align-items-center mb-1">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center">
                    <i class="ti ti-calendar text-info fs-6"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 fw-semibold"></h6>
                    <span class="fs-3">Added When</span>
                </div>
                <div class="ms-auto d-flex row">
                    <span class="fs-2">{{ \Carbon\Carbon::parse($pupil->created_at)->format('F d, Y H:i:s') }}</span>
                </div>

            </div>
            <div class="pt-0 d-flex align-items-center mb-1">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center">
                    <i class="ti ti-calendar text-info fs-6"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 fw-semibold"></h6>
                    <span class="fs-3">Updated When</span>
                </div>
                <div class="ms-auto d-flex row">
                    <span class="fs-2">{{ \Carbon\Carbon::parse($pupil->updated_at)->format('F d, Y H:i:s') }}</span>
                </div>

            </div>
        </div>

    </div>

    @foreach($pupilDataLineUp['getList'] as $general)
    <div class="col-md-6">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <ul class="timeline-widget mb-0">
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">
                                {{ $activeSchoolYear['getRecord'][0]->school_year }}
                                <br>{{ $activeSchoolYear['getRecord'][0]->phase }}
                            </div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border bg-muted d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 text-end">
                                {{ $pupil->first_name }} attended Grade {{ $gradeName[$general->class_id] }} - Section
                                {{ $className[$general->class_id] }}, <br>
                                in the {{ $schoolName[$schoolIds[$general->class_id]] }},
                                {{ $districtName[$districtIds[$schoolIds[$general->class_id]]] }} District.
                                And was under by class adviser, {{ $adviserName[$general->classadviser_id] }}.
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

</div>
