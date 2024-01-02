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
            @if($value->is_feeding_program == '1')
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
                                data-bs-target="#beneficiary-program-modal-{{ $value->id }}">
                                <i class="fs-4 ti ti-eye"></i>See More
                            </button>
                            </li>
                        </ul>
                        
                    </div>
                </td>
                @include('school_nurse.school_nurse.modals.beneficiary-program-modal', ['Id' => $value->id])
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
            @if($value->is_deworming_program == '1')
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
                                data-bs-target="#beneficiary-program-modal-{{ $value->id }}">
                                <i class="fs-4 ti ti-eye"></i>See More
                            </button>
                            </li>
                        </ul>
                        
                    </div>
                </td>
                @include('school_nurse.school_nurse.modals.beneficiary-program-modal', ['Id' => $value->id])
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
            @if($value->is_immunization_vax_program == '1')
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
                                data-bs-target="#beneficiary-program-modal-{{ $value->id }}">
                                <i class="fs-4 ti ti-eye"></i>See More
                            </button>
                            </li>
                        </ul>
                        
                    </div>
                </td>
                @include('school_nurse.school_nurse.modals.beneficiary-program-modal', ['Id' => $value->id])
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
            @if($value->is_mental_healthcare_program == '1')
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
                                data-bs-target="#beneficiary-program-modal-{{ $value->id }}">
                                <i class="fs-4 ti ti-eye"></i>See More
                            </button>
                            </li>
                        </ul>
                        
                    </div>
                </td>
                @include('school_nurse.school_nurse.modals.beneficiary-program-modal', ['Id' => $value->id])
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
            @if($value->is_dental_care_program == '1')
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
                                data-bs-target="#beneficiary-program-modal-{{ $value->id }}">
                                <i class="fs-4 ti ti-eye"></i>See More
                            </button>
                            </li>
                        </ul>
                        
                    </div>
                </td>
                @include('school_nurse.school_nurse.modals.beneficiary-program-modal', ['Id' => $value->id])
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
            @if($value->is_eye_care_program == '1')
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
                                data-bs-target="#beneficiary-program-modal-{{ $value->id }}">
                                <i class="fs-4 ti ti-eye"></i>See More
                            </button>
                            </li>
                        </ul>
                        
                    </div>
                </td>
                @include('school_nurse.school_nurse.modals.beneficiary-program-modal', ['Id' => $value->id])
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
            @if($value->is_health_wellness_program == '1')
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
                                data-bs-target="#beneficiary-program-modal-{{ $value->id }}">
                                <i class="fs-4 ti ti-eye"></i>See More
                            </button>
                            </li>
                        </ul>
                        
                    </div>
                </td>
                @include('school_nurse.school_nurse.modals.beneficiary-program-modal', ['Id' => $value->id])
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
            @if($value->is_medical_support_program == '1')
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
                                data-bs-target="#beneficiary-program-modal-{{ $value->id }}">
                                <i class="fs-4 ti ti-eye"></i>See More
                            </button>
                            </li>
                        </ul>
                        
                    </div>
                </td>
                @include('school_nurse.school_nurse.modals.beneficiary-program-modal', ['Id' => $value->id])
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
            @if($value->is_nursing_services == '1')
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
                                data-bs-target="#beneficiary-program-modal-{{ $value->id }}">
                                <i class="fs-4 ti ti-eye"></i>See More
                            </button>
                            </li>
                        </ul>
                        
                    </div>
                </td>
                @include('school_nurse.school_nurse.modals.beneficiary-program-modal', ['Id' => $value->id])
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