<div class="card shadow-lg m-0 p-4 border-2 border-primary rounded my-2">
    <h5 class="card-title fw-semibold">Nutritional Statuses</h5>
    <p class="card-subtitle mb-0">Below are the nutritional assessments of the pupil</p>
</div>

<div class="card border-2 border-primary rounded my-2">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <h4 class="card-title">Nutritional Statuses</h4>
        </div>
        <div class="table-responsive">
            <table class="table stylish-table v-middle mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th colspan="2" class="border-0 text-muted fw-normal">Grade / Section</th>
                        <th class="border-0 text-muted fw-normal">Class Adviser</th>
                        <th class="border-0 text-muted fw-normal">Body Mass Index</th>
                        <th class="border-0 text-muted fw-normal">Height</th>
                        <th class="border-0 text-muted fw-normal">Weight</th>
                        <th colspan="2" class="border-0 text-muted fw-normal">BMI Category</th>
                        <th class="border-0 text-muted fw-normal">HFA Category</th>
                        <th class="border-0 text-muted fw-normal">Recorded When</th>
                        <th class="border-0 text-muted fw-normal">Last Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nsrRecords['getRecords'] as $na)
                    @if(isset($na->nsr_id))
                    @php
                    $pnaParts = explode('-', $na->pna_code);
                    // Accessing each part
                    $class_adviser_id = $pnaParts[0] ?? '';
                    $class_id = $pnaParts[1] ?? '';
                    $section_id = $pnaParts[2] ?? '';
                    $lrn = $pnaParts[3] ?? '';
                    @endphp
                    <tr class="border-1 border-dark">
                        <td class="align-middle">
                            <span class="
                                round-40
                                text-white
                                d-flex
                                align-items-center
                                justify-content-center
                                text-center
                                rounded-circle
                                bg-info">{{ substr($gradeName[$na->class_id], 0, 1) }}</span>
                        </td>
                        <td class="align-middle">
                            <h6 class="font-weight-medium mb-0">
                                @if($gradeName[$na->class_id] == '1' || $gradeName[$na->class_id] == '2' ||
                                $gradeName[$na->class_id] == '3' || $gradeName[$na->class_id] == '4' ||
                                $gradeName[$na->class_id] == '5' || $gradeName[$na->class_id] == '6')
                                Grade
                                @endif
                                {{ $gradeName[$na->class_id] }}</h6>
                            <small class="text-muted">{{ $sectionNames[$sectionId[$na->class_id]] }}</small>
                        </td>
                        <td class="align-middle">{{ $adviserName[$class_adviser_id] }}</td>
                        <td class="align-middle">{{ $na->bmi }} kg/m²</td>
                        <td class="align-middle">{{ $na->height }} m</td>
                        <td class="align-middle">{{ $na->weight }} kg</td>
                        <td class="align-middle">
                            {{ $na->bmiCategory }}
                        </td>
                        <td class="align-middle">
                            <div class="d-block spinner-grow {{ $na->bmiColorSpinner }} spinner-grow-sm" role="status">
                            </div>
                        </td>
                        <td class="align-middle">{{ $na->hfaCategory }}</td>
                        <td>{{ $na->created_at->format('F j, Y \a\t g:i:s a') }}</td>
                        <td>{{ $na->updated_at->format('F j, Y \a\t g:i:s a') }}</td>

                    </tr>

                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow-lg m-0 p-4 border-2 border-primary rounded mb-2">
    <h5 class="card-title fw-semibold">Health Assessments</h5>
    <p class="card-subtitle mb-0">Below are the health assessments of the pupil</p>
</div>

@foreach($healthConducts['getRecord'] as $nan)
<div class="card p-3 shadow rounded border-2 border-primary mb-2">
    <div class="card-body p-2">
        <div class="d-flex align-items-center">
            <h4 class="card-title mb-0">Grade {{ $gradeName[$nan->class_id] }} - Section
                {{ $sectionNames[$sectionId[$nan->class_id]] }}</h4>
            <h6 class="w-auto ms-auto m-0">
                Class Adviser | {{ $adviserName[$class_adviser_id] }}
            </h6>
        </div>
    </div>

    <div class="d-flex align-items-center mt-4 justify-content-between">

    <div class="">
        <div class="p-2 d-flex align-items-center gap-1">
            @if($nan->is_feeding_program == '1')
                <span class="badge bg-primary">Feeding/Nutrition</span>
            @endif
            @if($nan->is_deworming_program == '1')
                <span class="badge bg-success">Deworming</span>
            @endif
            @if($nan->is_immunization_vax_program == '1')
                <span class="badge bg-info">Immunization/Vaccination</span>
            @endif
            @if($nan->is_mental_program == '1')
                <span class="badge bg-warning text-dark">Mental</span>
            @endif
            @if($nan->is_dental_program == '1')
                <span class="badge bg-danger">Dental</span>
            @endif
            @if($nan->is_eye_program == '1')
                <span class="badge bg-secondary">Eye</span>
            @endif
            @if($nan->is_health_wellness_program == '1')
                <span class="badge bg-dark">Health & Wellness</span>
            @endif
            <tr class="d-flex flex-col">
                <td class="fw-semibold">Recorded When</td>
                <td class="font-weight-medium py-0">{{ $nan->created_at ?? 'NULL' }}</td>
            </tr>
            <br>
            <tr class="d-flex flex-col">
                <td class="fw-semibold">Last Update</td>
                <td class="font-weight-medium py-0">{{ $nan->updated_at ?? 'NULL' }}</td>
            </tr>

            </div>
        </div>
    </div>
    <hr>
    <table class="table table-borderless">
        <tbody class="d-flex justify-content-around">
            <tr class="d-flex flex-col">
                <td class="fw-semibold"></td>
                <td class="font-weight-medium py-0"></td>
            </tr>
            <tr class="d-flex flex-col">
                <td class="fw-semibold"></td>
                <td class="font-weight-medium py-0"></td>
            </tr>
            
        </tbody>
    </table>

</div>
@endforeach


