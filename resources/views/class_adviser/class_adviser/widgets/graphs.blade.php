<div class="d-flex row">
    <div class="col-auto card shadow rounded border-2 border-primary mb-2">
    <select class="form-select col-auto" id="myChartsDataSelector">
            <option value="bmi">Body Mass Index</option>
            <option value="hfa">Height For Age</option>
        </select>
    </div>
</div>
<div class="d-flex row justify-content-between">
    <div class="col-12 border-primary border-2 shadow rounded" id="ChartsForBMI">
        <div class="mb-3 p-4 d-flex flex-column justify-content-center rounded">
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
    <div class="row col-md-11 border-primary border-2 shadow rounded m-0" id="chartsForHFA">
        <div class="mb-3 p-4 d-flex flex-column justify-content-center rounded">
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
