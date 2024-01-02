

    @foreach($nsrRecords['getRecords'] as $na)
    @if(isset($na->nsr_id))

    @php
    $feeding_program_count = 0;
    $deworming_program_count = 0;
    $immunization_vax_count = 0;
    $mental_health_program_count = 0;
    $dental_care_program_count = 0;
    $eye_care_program_count = 0;
    $health_and_wellness_program_count = 0;
    $medical_support_program_count = 0;
    $nursing_services_count = 0;
    @endphp

    @foreach ($beneficiaryData['getList'] as $beneficiary)
    @php
    // Check if programs are equal to '1'
    $feeding_program_c = ($beneficiary->is_feeding_program == '1');
    $deworming_program_c = ($beneficiary->is_deworming_program == '1');
    $immunization_vax_c = ($beneficiary->is_immunization_vax == '1');
    $mental_health_program_c = ($beneficiary->is_mental_healthcare_program == '1');
    $dental_care_program_c = ($beneficiary->is_dental_care_program == '1');
    $eye_care_program_c = ($beneficiary->is_eye_care_program == '1');
    $health_and_wellness_program_c = ($beneficiary->is_health_wellness_program == '1');
    $medical_support_program_c = ($beneficiary->is_medical_support_program == '1');
    $nursing_services_c = ($beneficiary->is_nursing_services == '1');

    // Increment the counter if the condition is true
    $feeding_program_count += $feeding_program_c;
    $deworming_program_count += $deworming_program_c;
    $immunization_vax_count += $immunization_vax_c;
    $mental_health_program_count += $mental_health_program_c;
    $dental_care_program_count += $dental_care_program_c;
    $eye_care_program_count += $eye_care_program_c;
    $health_and_wellness_program_count += $health_and_wellness_program_c;
    $medical_support_program_count += $medical_support_program_c;
    $nursing_services_count += $nursing_services_c;

    @endphp
    @endforeach

    <div class="card-body d-flex row">
        <div class="col-auto p-0 mt-2 ms-2">
            <button type="button" class="btn d-flex p-2 btn-primary d-block text-white font-medium align-items-center">
                Feeding Program&nbsp;&nbsp;
                <span class="badge p-1 px-2 ms-auto bg-light-primary text-dark">{{ $feeding_program_count }}</span>
            </button>
        </div>
        <div class="col-auto p-0 mt-2 ms-2">
            <button type="button" class="btn d-flex p-2 btn-success d-block text-white font-medium align-items-center">
                Deworming Program&nbsp;&nbsp;
                <span class="badge p-1 px-2 ms-auto bg-light-success text-dark">{{ $deworming_program_count }}</span>
            </button>
        </div>
        <div class="col-auto p-0 mt-2 ms-2">
            <button type="button" class="btn d-flex p-2 btn-warning d-block text-white font-medium align-items-center">
                Immunization Vax &nbsp;&nbsp;
                <span class="badge p-1 px-2 ms-auto bg-light-warning text-dark">{{ $immunization_vax_count }}</span>
            </button>
        </div>
        <div class="col-auto p-0 mt-2 ms-2">
            <button type="button" class="btn d-flex p-2 btn-danger d-block text-white font-medium align-items-center">
                Mental Healthcare Program&nbsp;&nbsp;
                <span class="badge p-1 px-2 ms-auto bg-light-danger text-dark">{{ $mental_health_program_count }}</span>
            </button>
        </div>
        <div class="col-auto p-0 mt-2 ms-2">
            <button type="button" class="btn d-flex p-2 btn-info d-block text-white font-medium align-items-center">
                Dental Care Program&nbsp;&nbsp;
                <span class="badge p-1 px-2 ms-auto bg-light-info text-dark">{{ $dental_care_program_count }}</span>
            </button>
        </div>
        <div class="col-auto p-0 mt-2 ms-2">
            <button type="button"
                class="btn d-flex p-2 btn-secondary d-block text-white font-medium align-items-center">
                Eye Care Program&nbsp;&nbsp;
                <span class="badge p-1 px-2 ms-auto bg-light-secondary text-dark">{{ $eye_care_program_count }}</span>
        </div>
        <div class="col-auto p-0 mt-2 ms-2">
            <button type="button" class="btn d-flex p-2 btn-dark d-block text-white font-medium align-items-center">
                Health and Wellness Program&nbsp;&nbsp;
                <span class="badge p-1 px-2 ms-auto bg-light text-dark">{{ $health_and_wellness_program_count }}</span>
            </button>
        </div>
        <div class="col-auto p-0 mt-2 ms-2">
            <button type="button"
                class="btn d-flex p-2 btn-light d-block border-1 border-dark text-dark font-medium align-items-center">
                Medical Support Program&nbsp;&nbsp;
                <span
                    class="badge p-1 px-2 ms-auto bg-light text-dark border-1 border-dark">{{ $medical_support_program_count }}</span>
            </button>
        </div>
        <div class="col-auto p-0 mt-2 ms-2">
            <button type="button" class="btn d-flex p-2 btn-primary d-block text-white font-medium align-items-center">
                Nursing Services&nbsp;&nbsp;
                <span class="badge p-1 px-2 ms-auto bg-light text-dark">{{ $nursing_services_count }}</span>
            </button>
        </div>

    </div>


@else
<div class="col-md-7">
    <div class="d-flex row bg-warning px-4 py-3 text-white">
        No nutritional status record of the pupil is submitted
    </div>
</div>
@endif
@endforeach
