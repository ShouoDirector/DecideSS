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
                        <td class="align-middle">{{ $na->updated_at ? $na->updated_at->format('F j, Y \a\t g:i:s a') : 'N/A' }}</td>


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

    <div class="card p-3 shadow rounded border-2 border-primary mb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <div class="table-responsive">
                    <table class="table stylish-table v-middle mb-0">
                        <thead>
                            <tr>
                                <th class="border-0 text-muted fw-normal">Grade & Section</th>
                                <th class="border-0 text-muted fw-normal">Accessed When</th>
                                <th class="border-0 text-muted fw-normal">Healthcare Suggestion</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($healthConducts['getRecord'] as $nan)
                            <tr class="border-1 border-dark">
                                <td class="align-middle">
                                    <h6 class="font-weight-medium mb-0">
                                        Grade {{ $gradeName[$nan->class_id] }}
                                    </h6>
                                    <small class="text-muted">{{ $sectionNames[$sectionId[$nan->class_id]] }}</small>
                                </td>
                                <td class="align-middle">
                                    <h6 class="font-weight-medium mb-0">
                                        {{ isset($nan->updated_at) ? \Carbon\Carbon::parse($nan->updated_at)->format('F j, Y \a\t g:i A') : 'NULL' }}
                                    </h6>
                                </td>
                                <td class="align-middle">
                                    @if($nan->is_feeding_program == '1')
                                        <span class="badge bg-primary my-1">Feeding/Nutrition</span>
                                    @endif
                                    @if($nan->is_deworming_program == '1')
                                        <span class="badge bg-success my-1">Deworming</span>
                                    @endif
                                    @if($nan->is_immunization_vax_program == '1')
                                        <span class="badge bg-info my-1">Immunization/Vaccination</span>
                                    @endif
                                    @if($nan->is_mental_program == '1')
                                        <span class="badge bg-warning my-1">Mental</span>
                                    @endif
                                    @if($nan->is_dental_program == '1')
                                        <span class="badge bg-danger my-1">Dental</span>
                                    @endif
                                    @if($nan->is_eye_program == '1')
                                        <span class="badge bg-secondary my-1">Eye</span>
                                    @endif
                                    @if($nan->is_health_wellness_program == '1')
                                        <span class="badge bg-dark my-1">Health & Wellness</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <hr>
    </div>




