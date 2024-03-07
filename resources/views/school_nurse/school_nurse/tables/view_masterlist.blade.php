@if(count($data['getRecord']) !== 0)
<div class="print-btn offcanvas offcanvas-end customizer show bg-light shadow-0" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel" data-simplebar="init" aria-modal="true" role="dialog">
    <div class="simplebar-wrapper shadow-xl" style="margin: 0px;">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                    style="height: 100%; overflow: hidden scroll;">
                    <div class="simplebar-content px-2">
                        <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                            <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Settings</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body d-flex justify-content-between p-4">
                            <div class="d-flex row">
                                <div class="theme-option pb-4">
                                    <h6 class="fw-semibold fs-4 mb-2">By Gender</h6>
                                    <div>
                                        <label>
                                            <input type="radio" name="gender" value="All" checked> All
                                        </label>
                                        <label>
                                            <input type="radio" name="gender" value="Male"> Male
                                        </label>
                                        <label>
                                            <input type="radio" name="gender" value="Female"> Female
                                        </label>
                                    </div>
                                </div>

                                <div class="theme-colors pb-4">
                                    <h6 class="fw-semibold fs-4 mb-1">By Columns</h6>
                                    <div class="d-flex row align-items-center gap-2 my-3 mx-4">

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxMasterlistLRN"
                                                checked>
                                            <label class="form-check-label" for="checkbox1">LRN</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxMasterlistName"
                                                checked>
                                            <label class="form-check-label" for="checkbox2">Name</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxMasterlistAge"
                                                checked>
                                            <label class="form-check-label" for="checkbox2">Age</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                id="checkboxMasterlistGender" checked>
                                            <label class="form-check-label" for="checkbox2">Gender</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                id="checkboxMasterlistAddress" checked>
                                            <label class="form-check-label" for="checkbox2">Address</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                id="checkboxMasterlistGuardianName" checked>
                                            <label class="form-check-label" for="checkbox2">Guardian Name</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                id="checkboxMasterlistGuardianContactNumber" checked>
                                            <label class="form-check-label" for="checkbox2">Guardian Contact No</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                id="checkboxMasterlistActions" checked>
                                            <label class="form-check-label" for="checkbox2">Actions</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="d-flex w-100 flex-col">
                                    <button type="button" class="col-12 justify-content-center w-100 btn mb-1 btn-rounded
                                    btn-primary d-flex align-items-center" onclick="printToPDF()">
                                        PRINT &nbsp;&nbsp;
                                        <i class="ti ti-printer fs-4 me-2"></i>
                                    </button>
                                    <button type="button" class="col-12 justify-content-center w-100 btn mb-1 btn-rounded
                                    btn-primary d-flex align-items-center"
                                        onclick="window.location.href='{{ url()->previous() }}'">
                                        <i class="ti ti-arrow-left fs-4 me-2"></i>
                                        Return
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="simplebar-placeholder" style="width: auto; height: 1038px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
        <div class="simplebar-scrollbar" style="height: 616px; transform: translate3d(0px, 0px, 0px); display: block;">
        </div>
    </div>
</div>

<div class="print-btn mb-2 position-fixed w-auto" style="top: 10px; right: 10px;">
    <button type="button" class="btn btn-primary customizer-btn" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <i class="ti ti-settings fs-7" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Settings"></i>
    </button>

</div>
    
    <!-- Gender-wise tables -->
    @foreach(['Male', 'Female'] as $gender)
        <div class="w-100 p-0 pb-3 mt-5">
            <h2 class="fs-4 px-0 py-2">{{ $gender }}s</h2>
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <tr>
                        <th></th>
                        <th>LRN</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Guardian</th>
                        <th>Guardian Contact No.</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $filteredRecords = $data['getRecord']->filter(function ($record) use ($gender, $dataPupilGender) {
                            return isset($dataPupilGender[$record->pupil_id]) && $dataPupilGender[$record->pupil_id] === $gender;
                        });
                    @endphp

                    @if(count($filteredRecords) === 0)
                        <tr>
                            <td colspan="9" class="text-center">No {{ strtolower($gender) }} pupils</td>
                        </tr>
                    @else
                        @foreach($filteredRecords as $value)
                            <tr>
                                <td>{{ $loop->index + 1 + ($data['getRecord']->perPage() * ($data['getRecord']->currentPage() - 1)) }}</td>
                                <td>{{ $dataPupilLRNs[$value->pupil_id] }}</td>
                                <td>{{ $dataPupilNames[$value->pupil_id] }}</td>
                                <td>{{ now()->diff($dataPupilBDate[$value->pupil_id])->y }} years old</td>
                                <td>{{ $dataPupilGender[$value->pupil_id] }}</td>
                                <td>{{ !empty($dataPupilAddress[$value->pupil_id]) ? $dataPupilAddress[$value->pupil_id] : 'None' }}</td>
                                <td>{{ !empty($dataPupilGuardian[$value->pupil_id]) ? $dataPupilGuardian[$value->pupil_id] : 'None' }}</td>
                                <td>{{ !empty($dataPupilGuardianCo[$value->pupil_id]) ? $dataPupilGuardianCo[$value->pupil_id] : 'None' }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    @endforeach

@else
    <!-- No data warning -->
    <div class="d-flex bg-warning py-3 px-4 text-white">
        Currently has no data.
    </div>
@endif
