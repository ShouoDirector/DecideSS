<div class="card shadow m-0 p-4">
    <h5 class="card-title fw-semibold">Nutritional Status History</h5>
    <p class="card-subtitle mb-0">Below are the nutritional assessments of the pupil</p>
</div>

@foreach($nsrRecords['getRecords'] as $na)
@if(isset($na->nsr_id))

<div class="card p-3 mt-2 shadow rounded">
    @php
    $pnaParts = explode('-', $na->pna_code);
    // Accessing each part
    $class_adviser_id = $pnaParts[0] ?? '';
    $class_id = $pnaParts[1] ?? '';
    $section_id = $pnaParts[2] ?? '';
    $lrn = $pnaParts[3] ?? '';
    @endphp
    <div class="card-body p-2">
        <div class="d-flex align-items-center">
            <h4 class="card-title mb-0">Grade {{ $gradeName[$na->class_id] }} - Section
                {{ $className[$na->class_id] }}</h4>
            <h6 class="w-auto ms-auto m-0">
                Class Adviser | {{ $adviserName[$class_adviser_id] }}
            </h6>
            <div class="dropdown p-1">

                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-eye"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1">
                    <a class="dropdown-item cursor-pointer d-flex align-items-center gap-1" href="javascript:void(0);"
                        data-bs-toggle="modal" data-bs-target="#na-notes-modal">
                        <i class="ti ti-eye fs-5"></i>See Notes</a>
                </div>
                @include('class_adviser.class_adviser.modals.na-notes-modal')
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center mt-4 justify-content-between">
        <div class="p-2 display-5
                        @if($na->bmiCategory === 'Overweight')
                            text-warning
                        @elseif($na->bmiCategory === 'Obese')
                            text-danger
                        @elseif($na->bmiCategory === 'Normal')
                            text-success
                        @elseif($na->bmiCategory === 'Wasted')
                            text-warning
                        @elseif($na->bmiCategory === 'Severely Wasted')
                            text-danger
                        @endif">
            <i class="ti ti-report-medical"></i>
            <span>{{ $na->bmi }} <sup class="fs-5"> kg m<sup>2</sup></sup></span>
        </div>
        <div class="">
            <div class="p-2 d-flex align-items-center">
                <h3 class="mb-0 px-2">{{ $na->bmiCategory }}</h3>
                <div class="d-block spinner-grow {{ $na->bmiColorSpinner }} spinner-grow-sm" role="status">
                </div>
            </div>
            <div>
                <small>Body Mass Index</small><br>
                <small>Height For Age : {{ $na->hfaCategory }}</small>
            </div>
        </div>
    </div>
    <hr>
    <table class="table table-borderless">
        <tbody class="d-flex justify-content-around">
            <tr class="d-flex flex-col">
                <td class="fw-semibold">Height</td>
                <td class="font-weight-medium py-0">{{ $na->height }} m</td>
            </tr>
            <tr class="d-flex flex-col">
                <td class="fw-semibold">Weight</td>
                <td class="font-weight-medium py-0">{{ $na->weight }} kg</td>
            </tr>
            <tr class="d-flex flex-col">
                <td class="fw-semibold">Recorded When</td>
                <td class="font-weight-medium py-0">{{ $na->created_at }}</td>
            </tr>
            <tr class="d-flex flex-col">
                <td class="fw-semibold">Last Update</td>
                <td class="font-weight-medium py-0">{{ $na->updated_at }}</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <div class="accordion accordion-flush shadow-none mb-2 px-0 mt-0 rounded card position-relative overflow-hidden"
        id="accordionFlushExampleHH">
        <div class="accordion-item mt-1">
            <h2 class="accordion-header" id="flush-headingOneHH">
                <button class="accordion-button collapsed px-4 py-3 fs-2 rounded shadow-none" type="button"
                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOneHH" aria-expanded="true"
                    aria-controls="flush-collapseOneHH">
                    More info
                </button>
            </h2>
            <div id="flush-collapseOneHH" class="accordion-collapse collapse" aria-labelledby="flush-headingOneHH"
                data-bs-parent="#accordionFlushExampleHH">
                <div class="accordion-body fw-normal">
                    <table class="table table-borderless">
                        <tbody class="d-flex justify-content-around">
                            <tr class="d-flex flex-col">
                                <td class="fw-semibold">Dewormed</td>
                                <td class="font-weight-medium py-0">{{ $na->is_dewormed == 1 ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr class="d-flex flex-col">
                                <td class="fw-semibold">Dewormed Date</td>
                                <td class="font-weight-medium py-0">
                                    {{ $na->dewormed_date ? \Carbon\Carbon::parse($na->dewormed_date)->format('F j, Y') : 'None' }}
                                </td>
                            </tr>
                            <tr class="d-flex flex-col">
                                <td class="fw-semibold">Dietary Restriction</td>
                                <td class="font-weight-medium py-0">
                                    @if(!empty($na->dietary_restriction))
                                    {{ $na->dietary_restriction }}
                                    @else
                                    None
                                    @endif
                                </td>
                            </tr>
                            <tr class="d-flex flex-col">
                                <td class="fw-semibold">Is Permitted For Deworming</td>
                                <td class="font-weight-medium py-0">
                                    {{ $na->is_permitted_deworming == 1 ? 'Yes' : 'No' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>

@endif
@endforeach
