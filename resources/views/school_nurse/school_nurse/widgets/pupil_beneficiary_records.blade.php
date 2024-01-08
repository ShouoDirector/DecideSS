<div class="card d-flex row">

    <div class="card shadow-lg m-0 p-4 mb-2">
        <h5 class="card-title fw-semibold">Beneficiary Records</h5>
        <p class="card-subtitle mb-0">Below are the records of the pupil as beneficiary</p>
    </div>

    @if (!empty($beneficiaryData['getList']))
    @foreach ($beneficiaryData['getList'] as $beneficiary)
    <div class="card card-body shadow">
        <span class="side-stick d-flex justify-content-end">
            <div class="ms-auto">
                <div class="category-selector btn-group">
                    <a class="nav-link category-dropdown label-group p-0 show" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="true" aria-expanded="true">
                        <div class="category">
                            <div class="category-business"></div>
                            <div class="category-social"></div>
                            <div class="category-important"></div>
                            <span class="more-options text-dark">
                                <i class="ti ti-dots-vertical fs-5"></i>
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right category-menu show"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 23px, 0px);"
                        data-popper-placement="top-start">
                        <a class="
note-important badge-group-item badge-important dropdown-item position-relative category-important d-flex align-items-center
                                " href="{{ route('school_nurse.school_nurse.enlist_new', ['search' =>  $dataPupilLRN[$beneficiary->pupil_id] ]) }}">See More</a>
                    </div>
                </div>
            </div>
        </span>
        <h6 class="note-title text-truncate w-75 mb-0" data-noteheading="Book a Ticket for Movie">
            {{ $schoolYearName[$beneficiary->schoolyear_id] }}
            {{ $schoolYearPhase[$beneficiary->schoolyear_id] }}
        </h6>
        <p class="note-date fs-2">Date Examined :
            {{ \Carbon\Carbon::parse($beneficiary->date_of_examination)->format('F j, Y') }}</p>
        <p class="note-date fs-2">By : {{ $schoolNurseName[$beneficiary->school_nurse_id] }}</p>
        <div class="note-content">
            @if ($beneficiary->is_feeding_program == '1')
            <div class="badge mt-1 bg-primary">
                Feeding Program
            </div>
            @endif

            @if ($beneficiary->is_deworming_program == '1')
            <div class="badge mt-1 bg-secondary">
                Deworming Program
            </div>
            @endif

            @if ($beneficiary->is_immunization_vax_program == '1')
            <div class="badge mt-1 bg-warning">
                Immunization Vaccination Program
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
        </div>
        <div class="note-content">

        </div>

        <div class="note-content mt-3">
            <p class="note-inner-content" data-notecontent="{{ $beneficiary->deformity_specified ?? 'None'}}">
                Notes / Observation : {{ $beneficiary->deformity_specified ?? 'None'}}
            </p>
            <div class="mt-2 text-end fs-1">
                Recorded When: {{ \Carbon\Carbon::parse($beneficiary->created_at)->format('F j, Y') }}
            </div>
            <div class="mb-3 text-end fs-1">
                Updated When: {{ \Carbon\Carbon::parse($beneficiary->updated_at)->format('F j, Y') }}
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('school_nurse.school_nurse.enlist_new', ['search' =>  $dataPupilLRN[$beneficiary->pupil_id] ]) }}"
                class="link me-1">
                <i class="ti ti-eye fs-5 favourite-note"></i>
            </a>
        </div>
    </div>
    @endforeach
    @endif
</div>
