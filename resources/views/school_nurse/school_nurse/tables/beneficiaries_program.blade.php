<div class="card mt-2">
    <ul class="nav nav-pills user-profile-tab bg-light-primary" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab"
                aria-controls="pills-all" aria-selected="true">
                <i class="ti ti-pokeball me-2 fs-6"></i>
                <span class="d-none d-md-block">All</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-feeding-tab" data-bs-toggle="pill" data-bs-target="#pills-feeding" type="button" role="tab"
                aria-controls="pills-feeding" aria-selected="true">
                <i class="ti ti-bowl me-2 fs-6"></i>
                <span class="d-none d-md-block">Feeding</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-deworming-tab" data-bs-toggle="pill" data-bs-target="#pills-deworming" type="button" role="tab"
                aria-controls="pills-deworming" aria-selected="false" tabindex="-1">
                <i class="ti ti-scribble me-2 fs-6"></i>
                <span class="d-none d-md-block">Deworming</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-immunization-tab" data-bs-toggle="pill" data-bs-target="#pills-immunization" type="button" role="tab"
                aria-controls="pills-immunization" aria-selected="false" tabindex="-1">
                <i class="ti ti-vaccine me-2 fs-6"></i>
                <span class="d-none d-md-block">Immunization/Vaccination</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-mental-tab" data-bs-toggle="pill" data-bs-target="#pills-mental" type="button" role="tab"
                aria-controls="pills-mental" aria-selected="false" tabindex="-1">
                <i class="ti ti-brain me-2 fs-6"></i>
                <span class="d-none d-md-block">Mental HealthCare</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-dental-tab" data-bs-toggle="pill" data-bs-target="#pills-dental" type="button" role="tab"
                aria-controls="pills-dental" aria-selected="false" tabindex="-1">
                <i class="ti ti-dental me-2 fs-6"></i>
                <span class="d-none d-md-block">Dental Care</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-eye-tab" data-bs-toggle="pill" data-bs-target="#pills-eye" type="button" role="tab"
                aria-controls="pills-eye" aria-selected="false" tabindex="-1">
                <i class="ti ti-eye me-2 fs-6"></i>
                <span class="d-none d-md-block">Eye Care</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button
                class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                id="pills-health-tab" data-bs-toggle="pill" data-bs-target="#pills-health" type="button" role="tab"
                aria-controls="pills-health" aria-selected="false" tabindex="-1">
                <i class="ti ti-health-recognition me-2 fs-6"></i>
                <span class="d-none d-md-block">Health & Wellness</span>
            </button>
        </li>
    </ul>

    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
                <div class="row">
                    
                <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
                    All
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
                                <th>Action</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            @if(count($dataProgram['getRecord']) === 0)
                            <tr>
                                <td colspan="7" class="text-center">No pupil</td>
                            </tr>
                            @else
                            <!-- start row -->
                            @foreach($dataProgram['getRecord'] as $value)
                            <tr>
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                                <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                                <td> {{ $adviserName[$value->classadviser_id] }}</td>
                                <td>
                                    <div class="dropdown dropstart">
                                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ti ti-tool fs-6"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                            <button type="button" class="dropdown-item d-flex align-items-center gap-3" data-bs-toggle="modal"
                                                data-bs-target="#beneficiary-program-modal-feeding-{{ $value->id }}">
                                                <i class="fs-4 ti ti-eye"></i>See More
                                            </button>
                                            </li>
                                        </ul>
                                        
                                    </div>
                                </td>
                                @include('school_nurse.school_nurse.modals.beneficiary-program-modal', ['Id' => $value->id])
                            </tr>
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
            </div>

            <div class="tab-pane fade" id="pills-feeding" role="tabpanel" aria-labelledby="pills-feeding-tab" tabindex="0">
                <div class="row">
                    
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
                        <tbody>
                            @if(count($dataProgram['getRecord']) === 0)
                            <tr>
                                <td colspan="7" class="text-center">No pupil</td>
                            </tr>
                            @else
                            <!-- start row -->
                            @foreach($dataProgram['getRecord'] as $value)
                            @if($value->is_feeding_program == '1')
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
            </div>

            <div class="tab-pane fade" id="pills-deworming" role="tabpanel" aria-labelledby="pills-deworming-tab" tabindex="0">
                <div class="row">
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
                            <tbody>
                                @if(count($dataProgram['getRecord']) === 0)
                                <tr>
                                    <td colspan="7" class="text-center">No pupil</td>
                                </tr>
                                @else
                                <!-- start row -->
                                @foreach($dataProgram['getRecord'] as $value)
                                @if($value->is_deworming_program == '1')
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
            </div>

            <div class="tab-pane fade" id="pills-immunization" role="tabpanel" aria-labelledby="pills-immunization-tab" tabindex="0">
                <div class="row">
                    <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
                        Immunization Vax Program
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
                            <tbody>
                                @if(count($dataProgram['getRecord']) === 0)
                                <tr>
                                    <td colspan="7" class="text-center">No pupil</td>
                                </tr>
                                @else
                                <!-- start row -->
                                @foreach($dataProgram['getRecord'] as $value)
                                @if($value->is_immunization_vax_program == '1')
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
                    
            </div>

            <div class="tab-pane fade" id="pills-mental" role="tabpanel" aria-labelledby="pills-mental-tab" tabindex="0">
                <div class="row">
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
                            <tbody>
                                @if(count($dataProgram['getRecord']) === 0)
                                <tr>
                                    <td colspan="7" class="text-center">No pupil</td>
                                </tr>
                                @else
                                <!-- start row -->
                                @foreach($dataProgram['getRecord'] as $value)
                                @if($value->is_mental_healthcare_program == '1')
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
                    
            </div>

            <div class="tab-pane fade" id="pills-dental" role="tabpanel" aria-labelledby="pills-dental-tab" tabindex="0">
                <div class="row">
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
                            <tbody>
                                @if(count($dataProgram['getRecord']) === 0)
                                <tr>
                                    <td colspan="7" class="text-center">No pupil</td>
                                </tr>
                                @else
                                <!-- start row -->
                                @foreach($dataProgram['getRecord'] as $value)
                                @if($value->is_dental_care_program == '1')
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
                    
            </div>

            <div class="tab-pane fade" id="pills-eye" role="tabpanel" aria-labelledby="pills-eye-tab" tabindex="0">
                <div class="row">
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
                            <tbody>
                                @if(count($dataProgram['getRecord']) === 0)
                                <tr>
                                    <td colspan="7" class="text-center">No pupil</td>
                                </tr>
                                @else
                                <!-- start row -->
                                @foreach($dataProgram['getRecord'] as $value)
                                @if($value->is_eye_care_program == '1')
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
                    
            </div>
            
            <div class="tab-pane fade" id="pills-health" role="tabpanel" aria-labelledby="pills-health-tab" tabindex="0">
                <div class="row">
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
                            <tbody>
                                @if(count($dataProgram['getRecord']) === 0)
                                <tr>
                                    <td colspan="7" class="text-center">No pupil</td>
                                </tr>
                                @else
                                <!-- start row -->
                                @foreach($dataProgram['getRecord'] as $value)
                                @if($value->is_health_wellness_program == '1')
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
                    
            </div>

            <div class="tab-pane fade" id="pills-medical" role="tabpanel" aria-labelledby="pills-medical-tab" tabindex="0">
                <div class="row">
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
                            <tbody>
                                @if(count($dataProgram['getRecord']) === 0)
                                <tr>
                                    <td colspan="7" class="text-center">No pupil</td>
                                </tr>
                                @else
                                <!-- start row -->
                                @foreach($dataProgram['getRecord'] as $value)
                                @if($value->is_medical_support_program == '1')
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
                    
            </div>

            <div class="tab-pane fade" id="pills-nursing" role="tabpanel" aria-labelledby="pills-nursing-tab" tabindex="0">
                <div class="row">
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
                            <tbody>
                                @if(count($dataProgram['getRecord']) === 0)
                                <tr>
                                    <td colspan="7" class="text-center">No pupil</td>
                                </tr>
                                @else
                                <!-- start row -->
                                @foreach($dataProgram['getRecord'] as $value)
                                @if($value->is_nursing_services == '1')
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
                    
            </div>

        </div>
    </div>

</div>

















