<div class="card mt-2">
    <ul class="nav nav-pills user-profile-tab bg-light-primary" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-bmi-tab" data-bs-toggle="pill" data-bs-target="#pills-bmi" type="button" role="tab"
                aria-controls="pills-bmi" aria-selected="true">
                <i class="ti ti-weight me-2 fs-6"></i>
                <span class="d-none d-md-block">Body Mass Index</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-hfa-tab" data-bs-toggle="pill" data-bs-target="#pills-hfa" type="button" role="tab"
                aria-controls="pills-hfa" aria-selected="false" tabindex="-1">
                <i class="ti ti-arrow-autofit-height me-2 fs-6"></i>
                <span class="d-none d-md-block">Height For Age</span>
            </button>
        </li>
    </ul>

    <div class="card-body px-0">
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-bmi" role="tabpanel" aria-labelledby="pills-bmi-tab"
                tabindex="0">
                <div class="col">
                    <div class="d-flex row justify-content-start mb-1">
                        <div class="col-md-2-5 col-sm-6 p-1">
                            <div class="card border-start mb-0 border-danger border-3 shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                            $totalSeverelyWastedPupils = is_array($totalSeverelyWastedPupils) ?
                                            $totalSeverelyWastedPupils : [0];
                                            $totalPupils = is_array($totalPupils) ? $totalPupils : [0];
                                            $severelyWastedPercentage = ($totalPupils[0] != 0) ?
                                            ($totalSeverelyWastedPupils[0] / $totalPupils[0]) * 100 : 0;
                                            @endphp
                                            <h3 class="fs-6">{{ $totalSeverelyWastedPupils[0] }}
                                                ({{ $severelyWastedPercentage }} %)</h3>
                                            <h6 class="card-subtitle mb-2 text-muted text-muted">Severely Wasted Pupils
                                            </h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="progress bg-light">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: <?php echo $severelyWastedPercentage . '%'; ?>; height: 6px;"
                                                    aria-valuenow="{{ $severelyWastedPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-md-2-5 col-sm-6 p-1">
                            <div class="card border-start mb-0 border-warning border-3 shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                            $totalWastedPupils = is_array($totalWastedPupils) ? $totalWastedPupils :
                                            [0];
                                            $totalPupils = is_array($totalPupils) ? $totalPupils : [0];
                                            $wastedPercentage = ($totalPupils[0] != 0) ? ($totalWastedPupils[0] /
                                            $totalPupils[0]) * 100 : 0;
                                            @endphp

                                            <h3 class="fs-6">{{ $totalWastedPupils[0] }} ({{ $wastedPercentage }} %)
                                            </h3>
                                            <h6 class="card-subtitle mb-2 text-muted text-muted">Wasted Pupils</h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="progress bg-light">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: <?php echo $wastedPercentage . '%'; ?>; height: 6px;"
                                                    aria-valuenow="{{ $wastedPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-md-2-5 col-sm-6 p-1">
                            <div class="card border-start mb-0 border-success border-3 shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                            $totalNormalInWeightPupils = is_array($totalNormalInWeightPupils) ?
                                            $totalNormalInWeightPupils : [0];
                                            $totalPupils = is_array($totalPupils) ? $totalPupils : [0];
                                            $normalWeightedPercentage = ($totalPupils[0] != 0) ?
                                            ($totalNormalInWeightPupils[0] / $totalPupils[0]) * 100 : 0;
                                            @endphp

                                            <h3 class="fs-6">{{ $totalNormalInWeightPupils[0] }}
                                                ({{ $normalWeightedPercentage }} %)</h3>
                                            <h6 class="card-subtitle mb-2 text-muted text-muted">Normal Weight Pupils
                                            </h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="progress bg-light">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: <?php echo $normalWeightedPercentage . '%'; ?>; height: 6px;"
                                                    aria-valuenow="{{ $normalWeightedPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-md-2-5 col-sm-6 p-1">
                            <div class="card border-start mb-0 border-warning border-3 shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                            $totalOverweightPupils = is_array($totalOverweightPupils) ?
                                            $totalOverweightPupils : [0];
                                            $totalPupils = is_array($totalPupils) ? $totalPupils : [0];
                                            $overweightPercentage = ($totalPupils[0] != 0) ? ($totalOverweightPupils[0]
                                            / $totalPupils[0]) * 100 : 0;
                                            @endphp

                                            <h3 class="fs-6">{{ $totalOverweightPupils[0] }}
                                                ({{ $overweightPercentage }} %)</h3>
                                            <h6 class="card-subtitle mb-2 text-muted text-muted">Overweight Pupils</h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="progress bg-light">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: <?php echo $overweightPercentage . '%'; ?>; height: 6px;"
                                                    aria-valuenow="{{ $overweightPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-md-2-5 col-sm-6 p-1">
                            <div class="card border-start mb-0 border-danger border-3 shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                            $totalObesePupils = is_array($totalObesePupils) ? $totalObesePupils : [0];
                                            $totalPupils = is_array($totalPupils) ? $totalPupils : [0];
                                            $obesePercentage = ($totalPupils[0] != 0) ? ($totalObesePupils[0] /
                                            $totalPupils[0]) * 100 : 0;
                                            @endphp

                                            <h3 class="fs-6">{{ $totalObesePupils[0] }} ({{ $obesePercentage }} %)</h3>
                                            <h6 class="card-subtitle mb-2 text-muted text-muted">Obese Pupils</h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="progress bg-light">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: <?php echo $obesePercentage . '%'; ?>; height: 6px;"
                                                    aria-valuenow="{{ $obesePercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>

                    <!-- BMI GRAPHS -->
                    <div class="d-flex row col-12 justify-content-center m-0 mt-2">
                        <p style="font-style: italic;">*Percentages on graphs are relative to the total number of pupils</p>
                        <div class="col-lg-4 d-flex row justify-content-center">
                            <div class="w-100 mb-2 p-4 shadow border-3 border-primary d-flex justify-content-center rounded"
                            style="height: max-content;">
                                <canvas id="myPieChartSectionTotalBMI"></canvas>
                            </div>
                        </div>

                        <div class="col-lg-8 d-flex flex-column">
                            <div class="w-100 mb-3 shadow border-3 border-primary p-4 d-flex flex-column justify-content-center rounded">
                                <div class="d-md-flex align-items-start gap-3">
                                    <div>
                                        <h6 class="mb-0">Overall</h6>
                                        <div class="d-flex align-items-center gap-3">
                                            <h6 class="mt-2 fw-bold">BODY MASS INDEX</h6>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <select class="form-select" id="myChartSectionGeneralBMIChartTypeSelector">
                                            <option value="bar">Bar Graph</option>
                                            <option value="line">Line Graph</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4 flex-grow-1">
                                    <canvas id="myChartSectionGeneralBMI"
                                        style="max-width: 100%; height: 280px;"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="tab-pane fade" id="pills-hfa" role="tabpanel" aria-labelledby="pills-hfa-tab" tabindex="0">
                <div class="col">
                    <div class="d-flex row justify-content-start mb-1">
                        <!-- Column -->
                        <div class="col-md-2-5 col-sm-6 p-1">
                            <div class="card border-start mb-0 border-danger border-3 shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                            $totalSeverelyStuntedPupils = is_array($totalSeverelyStuntedPupils) ?
                                            $totalSeverelyStuntedPupils : [0];
                                            $totalPupils = is_array($totalPupils) ? $totalPupils : [0];
                                            $severelyStuntedPercentage = ($totalPupils[0] != 0) ?
                                            ($totalSeverelyStuntedPupils[0] / $totalPupils[0]) * 100 : 0;
                                            @endphp

                                            <h3 class="fs-6">{{ $totalSeverelyStuntedPupils[0] }}
                                                ({{ $severelyStuntedPercentage }} %)</h3>
                                            <h6 class="card-subtitle mb-2 text-muted text-muted">Severely Stunted Pupils
                                            </h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="progress bg-light">
                                                <div class="progress-bar bg-danger" role="progressbar"
                                                    style="width: <?php echo $severelyStuntedPercentage . '%'; ?>; height: 6px;"
                                                    aria-valuenow="{{ $severelyStuntedPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-md-2-5 col-sm-6 p-1">
                            <div class="card border-start mb-0 border-warning border-3 shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                            $totalStuntedPupils = is_array($totalStuntedPupils) ? $totalStuntedPupils :
                                            [0];
                                            $totalPupils = is_array($totalPupils) ? $totalPupils : [0];
                                            $totalStuntedPupilsPercentage = ($totalPupils[0] != 0) ?
                                            ($totalStuntedPupils[0] / $totalPupils[0]) * 100 : 0;
                                            @endphp

                                            <h3 class="fs-6">{{ $totalStuntedPupils[0] }}
                                                ({{ $totalStuntedPupilsPercentage }} %)</h3>
                                            <h6 class="card-subtitle mb-2 text-muted text-muted">Stunted Pupils</h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="progress bg-light">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: <?php echo $totalStuntedPupilsPercentage . '%'; ?>; height: 6px;"
                                                    aria-valuenow="{{ $totalStuntedPupilsPercentage }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-md-2-5 col-sm-6 p-1">
                            <div class="card border-start mb-0 border-success border-3 shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                            $totalPupilsNormalInHeight = is_array($totalPupilsNormalInHeight) ?
                                            $totalPupilsNormalInHeight : [0];
                                            $totalPupils = is_array($totalPupils) ? $totalPupils : [0];
                                            $totalPupilsNormalInHeightPercentage = ($totalPupils[0] != 0) ?
                                            ($totalPupilsNormalInHeight[0] / $totalPupils[0]) * 100 : 0;
                                            @endphp
                                            <h3 class="fs-6">{{ $totalPupilsNormalInHeight[0] }}
                                                ({{ $totalPupilsNormalInHeightPercentage }} %)</h3>
                                            <h6 class="card-subtitle mb-2 text-muted text-muted">Normal Height Pupils
                                            </h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="progress bg-light">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: <?php echo $totalPupilsNormalInHeightPercentage . '%'; ?>; height: 6px;"
                                                    aria-valuenow="{{ $totalPupilsNormalInHeightPercentage }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-md-2-5 col-sm-6 p-1">
                            <div class="card border-start mb-0 border-primary border-3 shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @php
                                            $totalTallPupils = is_array($totalTallPupils) ? $totalTallPupils : [0];
                                            $totalPupils = is_array($totalPupils) ? $totalPupils : [0];
                                            $totalTallPupilsPercentage = ($totalPupils[0] != 0) ? ($totalTallPupils[0] /
                                            $totalPupils[0]) * 100 : 0;
                                            @endphp

                                            <h3 class="fs-6">{{ $totalTallPupils[0] }} ({{ $totalTallPupilsPercentage }}
                                                %)</h3>
                                            <h6 class="card-subtitle mb-2 text-muted text-muted">Tall Pupils</h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="progress bg-light">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: <?php echo $totalTallPupilsPercentage . '%'; ?>; height: 6px;"
                                                    aria-valuenow="{{ $totalTallPupilsPercentage }}" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>

                    <!-- HFA GRAPHS -->
                    <div class="d-flex row col-12 justify-content-center m-0 mt-2">
                        <p style="font-style: italic;">*Percentages on graphs are relative to the total number of pupils</p>
                        <div class="col-lg-4 d-flex row justify-content-center">
                            <div class="w-100 mb-2 p-4 shadow border-3 border-primary d-flex justify-content-center rounded"
                            style="height: max-content;">
                                <canvas id="myPieChartSectionOverallHFA"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex flex-column">
                            <div class="w-100 mb-3 shadow border-3 border-primary p-4 d-flex flex-column justify-content-center rounded">
                                <div class="d-md-flex align-items-start gap-3">
                                    <div>
                                        <h6 class="mb-0">Overall</h6>
                                        <div class="d-flex align-items-center gap-3">
                                            <h6 class="mt-2 fw-bold">HEIGHT-FOR-AGE</h6>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <select class="form-select" id="myChartSectionGeneralHFAChartTypeSelector">
                                            <option value="bar">Bar Graph</option>
                                            <option value="line">Line Graph</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-1 flex-grow-1">
                                    <canvas id="myChartSectionGeneralHFA"
                                        style="max-width: 100%; height: 280px;"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
