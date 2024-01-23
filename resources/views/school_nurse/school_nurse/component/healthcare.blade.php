<div class="table w-100 p-0 pb-3">
    <h5 class="text-center fw-bolder">HEALTHCARE SERVICES REPORT OF {{ strtoupper($schoolName[$getSchoolId]) }}</h5>
    <h6 class="text-center">{{ strtoupper($districtName[$districtId[$getSchoolId]]) }} DISTRICT</h6>
    <h6 class="text-center mb-3">{{ $schoolYearPhaseName }}</h6>

    <div class="print-btn rounded btn btn-primary text-white text-right fs-3 position-fixed w-auto" style="bottom: 10px; right: 50px;" onclick="printToPDF()"><i class="ti ti-printer"></i></div>
    <button class="print-btn w-auto position-fixed btn btn-secondary text-white" style="bottom: 10px; right: 105px;" onclick="window.location.href='{{ url()->previous() }}'"><i class="ti ti-arrow-left"></i></button>

    <div class="" id="feeding-program">
        <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
            Feeding Program
        </div>
        <div class="table-responsive w-100 pb-3">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>No.</th>
                        <th>Pupil LRN</th>
                        <th>Pupil</th>
                        <th>Class</th>
                        <th>Class Adviser</th>
                    </tr>
                    <!-- end row -->
                </thead>
                @php
                    $rowFeedingCount = 0;
                @endphp
                <tbody>
                    @if(count($dataProgram['getRecord']) === 0)
                    <tr>
                        <td colspan="7" class="text-center">No pupil</td>
                    </tr>
                    @else
                    <!-- start row -->
                    @foreach($dataProgram['getRecord'] as $value)
                    @if($value->is_feeding_program == '1')
                    @php
                        $rowFeedingCount++;
                    @endphp
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                        <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                        <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                        <td> {{ $adviserName[$value->classadviser_id] }}</td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    <!-- End row -->
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>

    <div class="" id="deworming-program">
        <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
            Deworming Program
        </div>
        <div class="table-responsive w-100 pb-3">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>No.</th>
                        <th>Pupil LRN</th>
                        <th>Pupil</th>
                        <th>Class</th>
                        <th>Class Adviser</th>
                    </tr>
                    <!-- end row -->
                </thead>
                @php
                    $rowDewormingCount = 0;
                @endphp
                <tbody>
                    @if(count($dataProgram['getRecord']) === 0)
                    <tr>
                        <td colspan="7" class="text-center">No pupil</td>
                    </tr>
                    @else
                    <!-- start row -->
                    @foreach($dataProgram['getRecord'] as $value)
                    @if($value->is_deworming_program == '1')
                    @php
                        $rowDewormingCount++;
                    @endphp
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                        <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                        <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                        <td> {{ $adviserName[$value->classadviser_id] }}</td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    <!-- End row -->
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>


    <div class="" id="immunization-program">
        <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
            Immunization/Vaccination Program
        </div>
        <div class="table-responsive w-100 pb-3">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>No.</th>
                        <th>Pupil LRN</th>
                        <th>Pupil</th>
                        <th>Class</th>
                        <th>Class Adviser</th>
                    </tr>
                    <!-- end row -->
                </thead>
                @php
                    $rowImmunizationCount = 0;
                @endphp
                <tbody>
                    @if(count($dataProgram['getRecord']) === 0)
                    <tr>
                        <td colspan="7" class="text-center">No pupil</td>
                    </tr>
                    @else
                    <!-- start row -->
                    @foreach($dataProgram['getRecord'] as $value)
                    @if($value->is_immunization_vax_program == '1')
                    @php
                        $rowImmunizationCount++;
                    @endphp
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                        <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                        <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                        <td> {{ $adviserName[$value->classadviser_id] }}</td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    <!-- End row -->
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>


    <div class="" id="mental-program">
        <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
            Mental HealthCare Program
        </div>
        <div class="table-responsive w-100 pb-3">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>No.</th>
                        <th>Pupil LRN</th>
                        <th>Pupil</th>
                        <th>Class</th>
                        <th>Class Adviser</th>
                    </tr>
                    <!-- end row -->
                </thead>
                @php
                    $rowMentalCount = 0;
                @endphp
                <tbody>
                    @if(count($dataProgram['getRecord']) === 0)
                    <tr>
                        <td colspan="7" class="text-center">No pupil</td>
                    </tr>
                    @else
                    <!-- start row -->
                    @foreach($dataProgram['getRecord'] as $value)
                    @if($value->is_mental_healthcare_program == '1')
                    @php
                        $rowMentalCount++;
                    @endphp
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                        <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                        <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                        <td> {{ $adviserName[$value->classadviser_id] }}</td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    <!-- End row -->
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>

    <div class="" id="dental-program">
        <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
            Dental Care Program
        </div>
        <div class="table-responsive w-100 pb-3">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>No.</th>
                        <th>Pupil LRN</th>
                        <th>Pupil</th>
                        <th>Class</th>
                        <th>Class Adviser</th>
                    </tr>
                    <!-- end row -->
                </thead>
                @php
                    $rowDentalCount = 0;
                @endphp
                <tbody>
                    @if(count($dataProgram['getRecord']) === 0)
                    <tr>
                        <td colspan="7" class="text-center">No pupil</td>
                    </tr>
                    @else
                    <!-- start row -->
                    @foreach($dataProgram['getRecord'] as $value)
                    @if($value->is_dental_care_program == '1')
                    @php
                        $rowDentalCount++;
                    @endphp
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                        <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                        <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                        <td> {{ $adviserName[$value->classadviser_id] }}</td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    <!-- End row -->
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>

    <div class="" id="eye-program">
        <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
            Eye Care Program
        </div>
        <div class="table-responsive w-100 pb-3">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>No.</th>
                        <th>Pupil LRN</th>
                        <th>Pupil</th>
                        <th>Class</th>
                        <th>Class Adviser</th>
                    </tr>
                    <!-- end row -->
                </thead>
                @php
                    $rowEyeCount = 0;
                @endphp
                <tbody>
                    @if(count($dataProgram['getRecord']) === 0)
                    <tr>
                        <td colspan="7" class="text-center">No pupil</td>
                    </tr>
                    @else
                    <!-- start row -->
                    @foreach($dataProgram['getRecord'] as $value)
                    @if($value->is_eye_care_program == '1')
                    @php
                        $rowEyeCount++;
                    @endphp
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                        <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                        <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                        <td> {{ $adviserName[$value->classadviser_id] }}</td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    <!-- End row -->
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>

    <div class="" id="health-program">
        <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
            Health And Wellness Program
        </div>
        <div class="table-responsive w-100 pb-3">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>No.</th>
                        <th>Pupil LRN</th>
                        <th>Pupil</th>
                        <th>Class</th>
                        <th>Class Adviser</th>
                    </tr>
                    <!-- end row -->
                </thead>
                @php
                    $rowHealthCount = 0;
                @endphp
                <tbody>
                    @if(count($dataProgram['getRecord']) === 0)
                    <tr>
                        <td colspan="7" class="text-center">No pupil</td>
                    </tr>
                    @else
                    <!-- start row -->
                    @foreach($dataProgram['getRecord'] as $value)
                    @if($value->is_health_wellness_program == '1')
                    @php
                        $rowHealthCount++;
                    @endphp
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                        <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                        <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                        <td> {{ $adviserName[$value->classadviser_id] }}</td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    <!-- End row -->
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>

    <div class="" id="medical-program">
        <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
            Medical Support Program
        </div>
        <div class="table-responsive w-100 pb-3">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>No.</th>
                        <th>Pupil LRN</th>
                        <th>Pupil</th>
                        <th>Class</th>
                        <th>Class Adviser</th>
                    </tr>
                    <!-- end row -->
                </thead>
                @php
                    $rowMedicalCount = 0;
                @endphp
                <tbody>
                    @if(count($dataProgram['getRecord']) === 0)
                    <tr>
                        <td colspan="7" class="text-center">No pupil</td>
                    </tr>
                    @else
                    <!-- start row -->
                    @foreach($dataProgram['getRecord'] as $value)
                    @if($value->is_medical_support_program == '1')
                    @php
                        $rowMedicalCount++;
                    @endphp
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                        <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                        <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                        <td> {{ $adviserName[$value->classadviser_id] }}</td>

                    </tr>
                    @endif
                    @endforeach
                    @endif
                    <!-- End row -->
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>

    <div class="" id="nursing-program">
        <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
            Nursing Services
        </div>
        <div class="table-responsive w-100 pb-3">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>No.</th>
                        <th>Pupil LRN</th>
                        <th>Pupil</th>
                        <th>Class</th>
                        <th>Class Adviser</th>
                    </tr>
                    <!-- end row -->
                </thead>
                @php
                    $rowNursingCount = 0;
                @endphp
                <tbody>
                    @if(count($dataProgram['getRecord']) === 0)
                    <tr>
                        <td colspan="7" class="text-center">No pupil</td>
                    </tr>
                    @else
                    <!-- start row -->
                    @foreach($dataProgram['getRecord'] as $value)
                    @if($value->is_nursing_services == '1')
                    @php
                        $rowNursingCount++;
                    @endphp
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                        <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                        <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                        <td> {{ $adviserName[$value->classadviser_id] }}</td>

                    </tr>
                    @endif
                    @endforeach
                    @endif
                    <!-- End row -->
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
        </div>
    </div>

    <div class="d-flex row mt-5">
        <div class="d-flex row col-6">
            <div class="fs-2 fw-bolder mb-1">
                Prepared By:
            </div>
            <div>{{ Auth::user()->name }}</div>
            <div class="fs-2 fw-bolder mb-1">
                School Nurse
            </div>
        </div>

    </div>

</div>

<div class="print-btn">
    <div class="d-flex justify-content-end" style="position:fixed; bottom: 10px; right:5px; z-index: 99;">
        <button
            class="btn btn-primary p-2 rounded-circle d-flex align-items-center justify-content-center search-button"
            type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"
            id="search-button">
            <i class="ti ti-tool fs-5" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Settings"></i>
        </button>
    </div>
</div>

<div class="offcanvas offcanvas-end customizer show" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel" data-simplebar="init" aria-modal="true" role="dialog">
    <div class="simplebar-wrapper" style="margin: 0px;">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                    style="height: 100%; overflow: hidden scroll;">
                    <div class="simplebar-content" style="padding: 0px;">
                        <div class="d-flex align-items-center justify-content-between p-3 border-bottom shadow">
                            <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Utility</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body p-4">
                            <div class="d-flex row justify-content-start text-start">
                                <div class="d-flex align-items-center justify-content-start p-0 m-0">
                                        <div class="col-auto mx-1 me-4">
                                            <button class="btn btn-transparent fs-3 px-0 fw-semibold" >
                                            Visibility</button>
                                        </div>
                                        <div class="col-auto mx-1 me-4">
                                        <button class="btn btn-transparent fs-3 px-0 fw-semibold" >
                                            Navigation</button>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start p-0 m-0">
                                    <div class="col-auto mx-1">
                                        <button id="feeding-program-btn" class="btn btn-primary text-white" 
                                            onclick="hideShowProgram('feeding-program', 'feeding-program-btn', 'Feeding Program')">
                                            Exclude</button>
                                    </div>
                                    <div class="col-auto mx-1">
                                        <a href="#feeding-program" class="btn @if($rowFeedingCount != 0) btn-primary @else btn-danger @endif my-1 text-white" role="button">Feeding
                                        Program ({{$rowFeedingCount}})</a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start p-0 m-0">
                                    <div class="col-auto mx-1">
                                        <button id="deworming-program-btn" class="btn btn-primary text-white" 
                                            onclick="hideShowProgram('deworming-program', 'deworming-program-btn', 'Deworming Program')">
                                            Exclude</button>
                                    </div>
                                    <div class="col-auto mx-1">
                                        <a href="#deworming-program" class="btn @if($rowDewormingCount != 0) btn-primary @else btn-danger @endif my-1 text-white"
                                        role="button">Deworming ({{$rowDewormingCount}})</a>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-start p-0 m-0">
                                    <div class="col-auto mx-1">
                                        <button id="immunization-program-btn" class="btn btn-primary text-white" 
                                            onclick="hideShowProgram('immunization-program', 'immunization-program-btn', 'Immunization/Vaccination Program')">
                                            Exclude</button>
                                    </div>
                                    <div class="col-auto mx-1">
                                        <a href="#immunization-program" class="btn @if($rowImmunizationCount != 0) btn-primary @else btn-danger @endif my-1 text-white"
                                        role="button">Immunization/Vacc ({{$rowImmunizationCount}})</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-start p-0 m-0">
                                    <div class="col-auto mx-1">
                                        <button id="mental-program-btn" class="btn btn-primary text-white" 
                                        onclick="hideShowProgram('mental-program', 'mental-program-btn', 'Mental HealthCare Program')">
                                        Exclude</button>
                                    </div>
                                    <div class="col-auto mx-1">
                                        <a href="#mental-program" class="btn @if($rowMentalCount != 0) btn-primary @else btn-danger @endif my-1 text-white" role="button">
                                            Mental HealthCare ({{$rowMentalCount}})</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-start p-0 m-0">
                                    <div class="col-auto mx-1">
                                    <button id="dental-program-btn" class="btn btn-primary text-white" 
                                    onclick="hideShowProgram('dental-program', 'dental-program-btn', 'Dental Care Program')">
                                    Exclude</button>
                                    </div>
                                    <div class="col-auto mx-1">
                                        <a href="#dental-program" class="btn @if($rowDentalCount != 0) btn-primary @else btn-danger @endif my-1 text-white" role="button">Dental
                                        Care Program ({{$rowDentalCount}})</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-start p-0 m-0">
                                    <div class="col-auto mx-1">
                                        <button id="eye-program-btn" class="btn btn-primary text-white" 
                                        onclick="hideShowProgram('eye-program', 'eye-program-btn', 'Eye Care Program')">
                                        Exclude</button>
                                    </div>
                                    <div class="col-auto mx-1">
                                        <a href="#eye-program" class="btn @if($rowEyeCount != 0) btn-primary @else btn-danger @endif my-1 text-white" role="button">Eye Care
                                        Program ({{$rowEyeCount}})</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-start p-0 m-0">
                                    <div class="col-auto mx-1">
                                        <button id="health-program-btn" class="btn btn-primary text-white" 
                                            onclick="hideShowProgram('health-program', 'health-program-btn', 'Health and Wellness Program')">
                                            Exclude</button>
                                    </div>
                                    <div class="col-auto mx-1">
                                        <a href="#health-program" class="btn @if($rowHealthCount != 0) btn-primary @else btn-danger @endif my-1 text-white" role="button">Health
                                        and Wellness ({{$rowHealthCount}})</a>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-start p-0 m-0">
                                    <div class="col-auto mx-1">
                                        <button id="medical-program-btn" class="btn btn-primary text-white" 
                                            onclick="hideShowProgram('medical-program', 'medical-program-btn', 'Medical and Support Program')">
                                            Exclude</button>
                                    </div>
                                    <div class="col-auto mx-1">
                                        <a href="#medical-program" class="btn @if($rowMedicalCount != 0) btn-primary @else btn-danger @endif my-1 text-white" role="button">Medical
                                        Support ({{$rowMedicalCount}})</a>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-start p-0 m-0">
                                    <div class="col-auto mx-1">
                                        <button id="nursing-program-btn" class="btn btn-primary text-white" 
                                            onclick="hideShowProgram('nursing-program', 'nursing-program-btn', 'Nursing Services')">
                                            Exclude</button>
                                    </div>
                                    <div class="col-auto mx-1">
                                        <a href="#nursing-program" class="btn @if($rowNursingCount != 0) btn-primary @else btn-danger @endif my-1 text-white" role="button">Nursing
                                        Services ({{$rowNursingCount}})</a>
                                    </div>
                                </div>

                                
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="simplebar-placeholder" style="width: auto; height: 1037px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
        <div class="simplebar-scrollbar" style="height: 542px; transform: translate3d(0px, 0px, 0px); display: block;">
        </div>
    </div>
</div>
