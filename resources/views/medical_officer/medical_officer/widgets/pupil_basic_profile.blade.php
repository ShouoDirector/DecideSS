<div class="card shadow rounded">
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
                <i class="ti ti-calendar text-info fs-6"></i>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 fw-semibold"></h6>
                <span class="fs-3">Added In System when</span>
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
                <span class="fs-3">Updated when</span>
            </div>
            <div class="ms-auto d-flex row">
                <span class="fs-2">{{ \Carbon\Carbon::parse($pupil->updated_at)->format('F d, Y H:i:s') }}</span>
            </div>

        </div>
    </div>

</div>
