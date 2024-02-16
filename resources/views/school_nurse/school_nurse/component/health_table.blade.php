@if(count($getHealthRecords['getList']) !== 0)
<div class="table w-100 pb-3">

    <div class="col-12">
        <div class="card-body w-100">
            <div class="d-flex row m-0 justify-content-end mt-2 mb-4 p-0">

            <div class="btn-toolbar d-flex justify-content-end p-0" role="toolbar"
                            aria-label="Toolbar with button groups">
                            <div class="btn-group mb-2 p-0" role="group" aria-label="First group"
                                style="align-items: center;">

                                <a href="{{ route('school_nurse.school_nurse.consolidated_health') }}" type="button" class="btn btn-secondary">
                                    <i class="ti ti-printer"></i>
                                </a>

                                <button type="button" class="btn btn-secondary" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-filter fs-4"></i>
                                </button>

                                <ul class="dropdown-menu animated lightSpeedIn px-3 shadow-lg">
                                    <form action="{{ route('school_nurse.school_nurse.health_table') }}">
                                        {{ csrf_field() }}
                                        <input type="text" name="gender" value="{{ Request::get('gender') }}" hidden>
                                        <li>
                                            <h6 class="my-2 fw-semibold">Entries</h6>
                                            <div class="col-auto d-flex align-items-center my-1 w-100">
                                                <select class="form-select border-dark" name="pagination"
                                                    id="paginationSelect">
                                                    <option value="5"
                                                        {{ Request::get('pagination') == 5 ? 'selected' : '' }}> 5
                                                        Rows
                                                    </option>
                                                    <option value="10"
                                                        {{ (Request::get('pagination') ?? 10) == 10 ? 'selected' : '' }}>
                                                        10
                                                        Rows
                                                    </option>
                                                    <option value="25"
                                                        {{ Request::get('pagination') == 25 ? 'selected' : '' }}>
                                                        25 Rows
                                                    </option>
                                                    <option value="50"
                                                        {{ Request::get('pagination') == 50 ? 'selected' : '' }}>
                                                        50 Rows
                                                    </option>
                                                    <option value="100"
                                                        {{ Request::get('pagination') == 100 ? 'selected' : '' }}>
                                                        100 Rows
                                                    </option>
                                                    <option value="250"
                                                        {{ Request::get('pagination') == 250 ? 'selected' : '' }}>
                                                        250 Rows
                                                    </option>
                                                    <option value="999"
                                                        {{ Request::get('pagination') == 999 ? 'selected' : '' }}>
                                                        999 Rows
                                                    </option>
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <h6 class="my-2 fw-semibold">Sort By</h6>
                                            <div
                                                class="form-group row d-flex align-items-center ps-4 justify-content-start">
                                                <div class="d-flex row gap-1 p-0 w-100">
                                                    <select class="form-select border-dark" name="sort_attribute">
                                                        <option value="id"
                                                            {{ Request::get('sort_attribute', 'id') == 'id' ? 'selected' : '' }}>
                                                            ID</option>
                                                        <option value="created_at"
                                                            {{ Request::get('sort_attribute') == 'created_at' ? 'selected' : '' }}>
                                                            Created
                                                        </option>
                                                        <option value="updated_at"
                                                            {{ Request::get('sort_attribute') == 'updated_at' ? 'selected' : '' }}>
                                                            Updated
                                                        </option>
                                                    </select>
                                                    <select class="form-select border-dark" name="sort_order">
                                                        <option value="asc"
                                                            {{ Request::get('sort_order', 'asc') == 'asc' ? '' : 'selected' }}>
                                                            Ascending</option>
                                                        <option value="desc"
                                                            {{ Request::get('sort_order') == 'desc' ? 'selected' : '' }}>
                                                            Descending</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <button type="submit" class="justify-content-center w-100 btn mt-2 btn-rounded btn-secondary 
                                        d-flex align-items-center card-hover py-2">Sort and Filter</button>
                                        </li>
                                    </form>
                                </ul>


                                <button type="button" class="btn btn-secondary " data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-list-check fs-4"></i>
                                </button>

                                <ul class="dropdown-menu animated flipInX shadow p-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxGradeLevels" checked>
                                        <label class="form-check-label" for="checkbox1">Grade Level</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxTotalBeneficiaries" checked>
                                        <label class="form-check-label" for="checkbox2">Total Beneficiaries</label>
                                    </div>

                                </ul>

                            </div>
                        </div>
        </div>
    </div>

    <table class="table border table-bordered text-nowrap mt-5">
        <thead>
            <!-- start row -->
            <tr class="border border-2 border-dark text-center">
                <th rowspan="4" id="checkboxGradeLevels">Grade<br>Levels</th>
                <th colspan="2" rowspan="4" id="checkboxTotalBeneficiaries">Total of<br>Beneficiaries</th>
            </tr>
            <tr class="border border-2 border-dark">
                <th colspan="20" class="bg-light-primary text-bold text-center">HEALTHCARE SERVICES</th>
            </tr>
            <tr class="border border-2 border-dark text-center">
                <th colspan="2" class="fs-1">Feeding Program</th>
                <th colspan="2" class="fs-1">Immunization Vax Program</th>
                <th colspan="2" class="fs-1">Deworming Program</th>
                <th colspan="2" class="fs-1">Dental Care Program</th>
                <th colspan="2" class="fs-1">Mental HealthCare Program</th>
                <th colspan="2" class="fs-1">Eye Care Program</th>
                <th colspan="2" class="fs-1">health & Wellness Program</th>
            </tr>
            <tr class="border border-2 border-dark text-center">
                @php
                $columns = ['No', '%'];
                $numColumns = 8; // Adjust the number of columns as needed
                @endphp

                @for ($i = 1; $i < $numColumns; $i++) 
                    @foreach ($columns as $column) <th colspan="1" class="fs-1">{{ $column }}</th>
                    @endforeach
                @endfor
            </tr>

            <!-- end row -->
        </thead>
        <tbody>

            <!-- ========================================= GRADE KINDER ======================================== -->
        @if(count($kinderRecords) > 0)
        <tr class="border border-2 border-dark text-center">
            <td rowspan="4" style="vertical-align: middle;">Kinder</td>

            @php
            $maleCount = $kinderRecords->where('gender', 'Male')->count();
            $femaleCount = $kinderRecords->where('gender', 'Female')->count();
            $feedingCount = $kinderRecords->where('is_feeding_program', '1')->count();
            $vaccinationCount = $kinderRecords->where('is_immunization_vax_program', '1')->count();
            $dewormingCount = $kinderRecords->where('is_deworming_program', '1')->count();
            $dentalCount = $kinderRecords->where('is_dental_care_program', '1')->count();
            $mentalCount = $kinderRecords->where('is_mental_healthcare_program', '1')->count();
            $eyeCount = $kinderRecords->where('is_eye_care_program', '1')->count();
            $healthCount = $kinderRecords->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($kinderRecords as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">{{ $feedingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($feedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($feedingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $vaccinationCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($vaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($vaccinationCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dewormingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $mentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($mentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($mentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $eyeCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($eyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($eyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $healthCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($healthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($healthCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
        </tr>
        @endforeach

        </tr>
        @endif

        <!-- ========================================= GRADE 1 ======================================== -->
        @if(count($grade1Records) > 0)
        <tr class="border border-2 border-dark text-center">
            <td rowspan="4" style="vertical-align: middle;">Grade 1</td>

            @php
            $maleCount = $grade1Records->where('gender', 'Male')->count();
            $femaleCount = $grade1Records->where('gender', 'Female')->count();
            $feedingCount = $grade1Records->where('is_feeding_program', '1')->count();
            $vaccinationCount = $grade1Records->where('is_immunization_vax_program', '1')->count();
            $dewormingCount = $grade1Records->where('is_deworming_program', '1')->count();
            $dentalCount = $grade1Records->where('is_dental_care_program', '1')->count();
            $mentalCount = $grade1Records->where('is_mental_healthcare_program', '1')->count();
            $eyeCount = $grade1Records->where('is_eye_care_program', '1')->count();
            $healthCount = $grade1Records->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade1Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">{{ $feedingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($feedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($feedingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $vaccinationCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($vaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($vaccinationCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dewormingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $mentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($mentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($mentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $eyeCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($eyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($eyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $healthCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($healthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($healthCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
        </tr>
        @endforeach

        </tr>
        @endif

        <!-- ========================================= GRADE 2 ======================================== -->
        @if(count($grade2Records) > 0)
        <tr class="border border-2 border-dark text-center">
            <td rowspan="4" style="vertical-align: middle;">Grade 2</td>

            @php
            $maleCount = $grade2Records->where('gender', 'Male')->count();
            $femaleCount = $grade2Records->where('gender', 'Female')->count();
            $feedingCount = $grade2Records->where('is_feeding_program', '1')->count();
            $vaccinationCount = $grade2Records->where('is_immunization_vax_program', '1')->count();
            $dewormingCount = $grade2Records->where('is_deworming_program', '1')->count();
            $dentalCount = $grade2Records->where('is_dental_care_program', '1')->count();
            $mentalCount = $grade2Records->where('is_mental_healthcare_program', '1')->count();
            $eyeCount = $grade2Records->where('is_eye_care_program', '1')->count();
            $healthCount = $grade2Records->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade2Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">{{ $feedingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($feedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($feedingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $vaccinationCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($vaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($vaccinationCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dewormingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $mentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($mentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($mentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $eyeCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($eyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($eyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $healthCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($healthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($healthCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
        </tr>
        @endforeach
        </tr>
        @endif


        <!-- ========================================= GRADE 3 ======================================== -->
        @if(count($grade3Records) > 0)
        <tr class="border border-2 border-dark text-center">
            <td rowspan="4" style="vertical-align: middle;">Grade 3</td>

            @php
            $maleCount = $grade3Records->where('gender', 'Male')->count();
            $femaleCount = $grade3Records->where('gender', 'Female')->count();
            $feedingCount = $grade3Records->where('is_feeding_program', '1')->count();
            $vaccinationCount = $grade3Records->where('is_immunization_vax_program', '1')->count();
            $dewormingCount = $grade3Records->where('is_deworming_program', '1')->count();
            $dentalCount = $grade3Records->where('is_dental_care_program', '1')->count();
            $mentalCount = $grade3Records->where('is_mental_healthcare_program', '1')->count();
            $eyeCount = $grade3Records->where('is_eye_care_program', '1')->count();
            $healthCount = $grade3Records->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade3Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">{{ $feedingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($feedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($feedingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $vaccinationCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($vaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($vaccinationCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dewormingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $mentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($mentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($mentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $eyeCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($eyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($eyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $healthCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($healthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($healthCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
        </tr>
        @endforeach

        </tr>
        @endif

        <!-- ========================================= GRADE 4 ======================================== -->
        @if(count($grade4Records) > 0)
        <tr class="border border-2 border-dark text-center">
            <td rowspan="4" style="vertical-align: middle;">Grade 4</td>

            @php
            $maleCount = $grade4Records->where('gender', 'Male')->count();
            $femaleCount = $grade4Records->where('gender', 'Female')->count();
            $feedingCount = $grade4Records->where('is_feeding_program', '1')->count();
            $vaccinationCount = $grade4Records->where('is_immunization_vax_program', '1')->count();
            $dewormingCount = $grade4Records->where('is_deworming_program', '1')->count();
            $dentalCount = $grade4Records->where('is_dental_care_program', '1')->count();
            $mentalCount = $grade4Records->where('is_mental_healthcare_program', '1')->count();
            $eyeCount = $grade4Records->where('is_eye_care_program', '1')->count();
            $healthCount = $grade4Records->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade4Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">{{ $feedingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($feedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($feedingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $vaccinationCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($vaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($vaccinationCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dewormingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $mentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($mentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($mentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $eyeCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($eyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($eyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $healthCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($healthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($healthCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
        </tr>
        @endforeach

        </tr>
        @endif

        <!-- ========================================= GRADE 5 ======================================== -->
        @if(count($grade5Records) > 0)
        <tr class="border border-2 border-dark text-center">
            <td rowspan="4" style="vertical-align: middle;">Grade 5</td>

            @php
            $maleCount = $grade5Records->where('gender', 'Male')->count();
            $femaleCount = $grade5Records->where('gender', 'Female')->count();
            $feedingCount = $grade5Records->where('is_feeding_program', '1')->count();
            $vaccinationCount = $grade5Records->where('is_immunization_vax_program', '1')->count();
            $dewormingCount = $grade5Records->where('is_deworming_program', '1')->count();
            $dentalCount = $grade5Records->where('is_dental_care_program', '1')->count();
            $mentalCount = $grade5Records->where('is_mental_healthcare_program', '1')->count();
            $eyeCount = $grade5Records->where('is_eye_care_program', '1')->count();
            $healthCount = $grade5Records->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade5Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">{{ $feedingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($feedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($feedingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $vaccinationCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($vaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($vaccinationCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dewormingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $mentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($mentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($mentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $eyeCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($eyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($eyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $healthCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($healthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($healthCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
        </tr>
        @endforeach

        </tr>
        @endif

        <!-- ========================================= GRADE 6 ======================================== -->
        @if(count($grade6Records) > 0)
        <tr class="border border-2 border-dark text-center">
            <td rowspan="4" style="vertical-align: middle;">Grade 6</td>

            @php
            $maleCount = $grade6Records->where('gender', 'Male')->count();
            $femaleCount = $grade6Records->where('gender', 'Female')->count();
            $feedingCount = $grade6Records->where('is_feeding_program', '1')->count();
            $vaccinationCount = $grade6Records->where('is_immunization_vax_program', '1')->count();
            $dewormingCount = $grade6Records->where('is_deworming_program', '1')->count();
            $dentalCount = $grade6Records->where('is_dental_care_program', '1')->count();
            $mentalCount = $grade6Records->where('is_mental_healthcare_program', '1')->count();
            $eyeCount = $grade6Records->where('is_eye_care_program', '1')->count();
            $healthCount = $grade6Records->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade6Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">{{ $feedingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($feedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($feedingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $vaccinationCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($vaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($vaccinationCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dewormingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $mentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($mentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($mentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $eyeCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($eyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($eyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $healthCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($healthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($healthCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
        </tr>
        @endforeach

        </tr>
        @endif

        <!-- ========================================= GRADE 6 ======================================== -->
        @if(count($spedRecords) > 0)
        <tr class="border border-2 border-dark text-center">
            <td rowspan="4" style="vertical-align: middle;">Grade SPED</td>

            @php
            $maleCount = $spedRecords->where('gender', 'Male')->count();
            $femaleCount = $spedRecords->where('gender', 'Female')->count();
            $feedingCount = $spedRecords->where('is_feeding_program', '1')->count();
            $vaccinationCount = $spedRecords->where('is_immunization_vax_program', '1')->count();
            $dewormingCount = $spedRecords->where('is_deworming_program', '1')->count();
            $dentalCount = $spedRecords->where('is_dental_care_program', '1')->count();
            $mentalCount = $spedRecords->where('is_mental_healthcare_program', '1')->count();
            $eyeCount = $spedRecords->where('is_eye_care_program', '1')->count();
            $healthCount = $spedRecords->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($spedRecords as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">{{ $feedingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($feedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($feedingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $vaccinationCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($vaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($vaccinationCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dewormingCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $dentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($dentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($dentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $mentalCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($mentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($mentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $eyeCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($eyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($eyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">{{ $healthCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($healthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($healthCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
        </tr>
        @endforeach

        </tr>
        @endif
            <!-- End row -->
        </tbody>

    </table>

</div>
@else
<div class="d-flex bg-dark text-white p-5">
    Attention: The Healthcare Services Report currently contains no data. As the school nurse, it is
    imperative that you health assess the pupils in your school.

    <br>Please be mindful that thorough completion of Healthcare Services Report is critical, as inaccuracies may have a
    cascading effect on existing data and impact the overall statistical integrity of your school's health records and
    status.
</div>

<div class="d-flex row justify-content-end">
    <button class="print-btn col-md-2 col-sm-4 col-6 btn btn-primary mt-2 text-white"
        onclick="window.location.href='{{ url()->previous() }}'">Okay</button>

</div>

@endif
