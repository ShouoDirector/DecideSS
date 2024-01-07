<div class="d-flex row gap-2">
    <div class="card col-md-5 shadow-lg rounded border-2 border-primary" style="height: fit-content;">
        <div class="p-4 rounded">
            <h5 class="card-title fw-semibold">Pupil's Basic Profile Information</h5>
            <p class="card-subtitle">The information below can only be seen by the authorized users</p>
            <div class="mt-9 py-6 d-flex align-items-center">
                <div
                    class="flex-shrink-0 bg-light-primary rounded-circle round d-flex align-items-center justify-content-center">
                    <i class="ti ti-user text-primary fs-6"></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 fw-semibold">{{ $pupil->first_name }} {{ $pupil->middle_name }}
                        {{ $pupil->last_name }}@if(!empty($pupil->suffix)), @endif {{ $pupil->suffix }}
                    </h6>
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
            <div class="pt-6 d-flex align-items-center">
                <div
                    class="flex-shrink-0 bg-light-info rounded-circle round d-flex align-items-center justify-content-center">
                    <i class="ti ti-mail text-info fs-6"></i>
                </div>
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
                    <span class="fs-3">Added In System When</span>
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
    <div class="col-md-5">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <p class="card-subtitle mb-7">{{ $activeSchoolYear['getRecord'][0]->school_year }} | {{ $activeSchoolYear['getRecord'][0]->phase }}</p>
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div class="card-subtitle mb-2 text-muted text-muted">Section</div>
                            <div class="fs-4">{{ $className[$general->class_id] }}</div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <div class="card-subtitle mb-2 text-muted text-muted">Grade</div>
                            <div class="fs-4">{{ $gradeName[$general->class_id] }}</div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <div class="card-subtitle mb-2 text-muted text-muted">Class Adviser</div>
                            <div class="fs-4">{{ $adviserName[$general->classadviser_id] }}</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="card-subtitle mb-2 text-muted text-muted">School</div>
                            <div class="fs-4">{{ $schoolName[$schoolIds[$general->class_id]] }}</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="card-subtitle mb-2 text-muted text-muted">District</div>
                            <div class="fs-4">{{ $districtName[$districtIds[$schoolIds[$general->class_id]]] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
