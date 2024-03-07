@if(count($dataClassRecord['getRecord']) !== 0)
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
                                    <div class="d-flex justify-content-end my-2">
                                        <div class="btn-group mb-2 p-0 m-0" role="group" aria-label="Basic example">
                                            <form action="{{ route('school_nurse.school_nurse.cnsr_fragment') }}">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn @if(Request::get('gender') == 'Male' || 
                                    Request::get('gender') == 'Female') btn-secondary
                                    @elseif(empty(Request::get('gender')))
                                    btn-primary
                                    @endif
                                    font-medium m-0"
                                                    style="border-top-left-radius: 5px; 
                                    border-bottom-left-radius: 5px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;">
                                                    All
                                                </button>
                                            </form>
                                            <form action="{{ route('school_nurse.school_nurse.cnsr_fragment') }}">
                                                {{ csrf_field() }}
                                                <input type="text" name="gender" value="Male" hidden>
                                                <button type="submit" class="btn @if(Request::get('gender') == 'Male') 
                                    btn-primary 
                                    @else btn-secondary @endif
                                    font-medium m-0" style="border-radius: 0px;">
                                                    Male
                                                </button>
                                            </form>
                                            <form action="{{ route('school_nurse.school_nurse.cnsr_fragment') }}">
                                                {{ csrf_field() }}
                                                <input type="text" name="gender" value="Female" hidden>
                                                <button type="submit" class="btn @if(Request::get('gender') == 'Female') 
                                    btn-primary 
                                    @else btn-secondary @endif
                                    font-medium m-0" style="border-top-right-radius: 5px; border-bottom-right-radius: 5px; 
                                border-top-left-radius: 0px; border-bottom-left-radius: 0px;">
                                                    Female
                                                </button>
                                            </form>
                                        </div>
                                        
                                    </div>
                                    <div class="d-flex gap-1 justify-content-end">
                                    <button type="button" class="btn btn-rounded
                                    btn-primary d-flex align-items-center" onclick="printToPDF()">
                                        <i class="ti ti-printer fs-4"></i>
                                    </button>
                                    <button type="button" class="btn btn-rounded
                                    btn-primary d-flex align-items-center"
                                        onclick="window.location.href='{{ url()->previous() }}'">
                                        <i class="ti ti-arrow-left fs-4 "></i>
                                    </button>
                                    </div>
                                </div>

                                <div class="theme-colors pb-4">
                                    <div class="d-flex row align-items-center gap-2 my-3 mx-4">

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxNSRName"
                                                checked>
                                            <label class="form-check-label" for="checkbox1">Pupil Name</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxNSRDateOfBirth"
                                                checked>
                                            <label class="form-check-label" for="checkbox1">Date of Birth</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxNSRWeight"
                                                checked>
                                            <label class="form-check-label" for="checkbox1">Weight</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxNSRHeight"
                                                checked>
                                            <label class="form-check-label" for="checkbox1">Height</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxNSRSex" checked>
                                            <label class="form-check-label" for="checkbox1">Sex</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                id="checkboxNSRHeightSquared" checked>
                                            <label class="form-check-label" for="checkbox1">Height
                                                (m<sup>2</sup>)</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxNSRAge" checked>
                                            <label class="form-check-label" for="checkbox1">Age</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxNSRBMI" checked>
                                            <label class="form-check-label" for="checkbox1">BMI</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxNSRBMICat"
                                                checked>
                                            <label class="form-check-label" for="checkbox1">BMI Category</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkboxNSRHFACat"
                                                checked>
                                            <label class="form-check-label" for="checkbox1">HFA Category</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="d-flex w-100 flex-col">
                                    
                                    
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

<div class="table w-100 pb-3">
    <table class="table border border-2 border-dark table-bordered text-nowrap mt-3">
        <thead>
            <!-- start row -->
            <tr>
                <th></th>
                <th>Pupil Name</th>
                <th>Date of Birth</th>
                <th>Weight <br> (kg)</th>
                <th>Height <br> (m)</th>
                <th>Sex</th>
                <th>Height<br> (m<sup>2</sup>)</th>
                <th>Age <br>
                    (y, m)</th>
                    <th>Body Mass <br>
                    Index <br>
                    (kg/m<sup>2</sup>)</th>
                <th>Body Mass <br>
                    Index <br>
                    Category</th>
                <th>Height For <br>
                Age <br>
                Category</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataClassRecord['getRecord']) === 0)
            <tr>
                <td colspan="12" class="text-center">No class selected</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataClassRecord['getRecord'] as $value)

            <tr>
            <td> {{ $loop->index + 1 + ($dataClassRecord['getRecord']->perPage() * 
                ($dataClassRecord['getRecord']->currentPage() - 1)) }}</td>
            <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
            <td> {{ \Carbon\Carbon::parse($dataPupilBDate[$value->pupil_id])->format('F j, Y') }} </td>
            <td> {{ $value->weight }}</td>
            <td> {{ $value->height }}</td>
            <td> {{ $dataPupilSex[$value->pupil_id] }}</td>
            <td> {{ number_format($value->height_squared, 2) }}</td>
            @php
                $birthdate = \Carbon\Carbon::parse($dataPupilBDate[$value->pupil_id]);
                $age = $birthdate->diff(\Carbon\Carbon::now());
            @endphp
            <td>{{ $age->y }} y, {{ $age->m }} m</td>
            <td>{{ $value->bmi }}</td>
            <td>{{ $value->bmiCategory }}</td>
            <td>{{ $value->hfaCategory }}</td>

            </tr>
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>
    <div class="d-flex row mt-5">
        <div class="d-flex row col-6">
            <div class="fs-2 fw-bolder mb-1">
                Prepared By:
            </div>
            <div class="mt-3"></div>
            <div class="fs-2 fw-bolder mb-1">
                Class Adviser
            </div>
        </div>
        <div class="d-flex row col-6">
            <div class="fs-1 mb-1 d-flex text-gray justify-content-end">
            
            </div>
            <div></div>
            <div class="fs-1 mb-1 d-flex justify-content-end">
                NSR CODE : #{{ $nsrCodes[$value->nsr_id] }} 
                @php echo now()->toDateTimeString(); @endphp
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
            {!! $dataClassRecord['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>

@else
<div class="d-flex bg-warning text-white">
    The NSR has no data. 
</div>
@endif
