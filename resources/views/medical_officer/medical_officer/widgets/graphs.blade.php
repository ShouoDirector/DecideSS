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

    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade show active" id="pills-bmi" role="tabpanel" aria-labelledby="pills-bmi-tab" tabindex="0">
                <div class="row">
                    <div class="w-100 mb-3 shadow p-4 d-flex flex-column justify-content-center rounded">
                        <div class="d-md-flex align-items-start gap-3">
                            <div>
                                <h6 class="mb-0">Overall</h6>
                                <div class="d-flex align-items-center gap-3">
                                    <h6 class="mt-2 fw-bold">BODY MASS INDEX</h6>
                                </div>
                            </div>
                            <div class="ms-auto">
                                <select class="form-select" id="myChartPupilGeneralBMIChartTypeSelector">
                                    <option value="bar">Bar Graph</option>
                                    <option value="line">Line Graph</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 flex-grow-1">
                            <canvas id="myChartPupilGeneralBMI" style="max-width: 100%; height: 280px;"></canvas>
                        </div>
                    </div>


                </div>
            </div>

            <div class="tab-pane fade" id="pills-hfa" role="tabpanel" aria-labelledby="pills-hfa-tab" tabindex="0">
                <div class="row">
                    <div class="w-100 mb-3 shadow p-4 d-flex flex-column justify-content-center rounded">
                        <div class="d-md-flex align-items-start gap-3">
                            <div>
                                <h6 class="mb-0">Overall</h6>
                                <div class="d-flex align-items-center gap-3">
                                    <h6 class="mt-2 fw-bold">HEIGHT-FOR-AGE</h6>
                                </div>
                            </div>
                            <div class="ms-auto">
                                <select class="form-select" id="myChartPupilGeneralHFAChartTypeSelector">
                                    <option value="bar">Bar Graph</option>
                                    <option value="line">Line Graph</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 flex-grow-1">
                            <canvas id="myChartPupilGeneralHFA" style="max-width: 100%; height: 280px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
