@if(count($getHealthRecords['getList']) !== 0)
<div class="table w-100 pb-3">

    <div class="col-12">
        <div class="card-body w-100">
            <div class="d-flex row m-0 justify-content-end mt-2 mb-4 p-0">

            <div class="btn-toolbar d-flex justify-content-end p-0" role="toolbar"
                aria-label="Toolbar with button groups">
                <div class="btn-group mb-2 p-0" role="group" aria-label="First group"
                    style="align-items: center;">

                    <form action="{{  route('school_nurse.school_nurse.consolidated_health') }}">
                    <input class="d-none" type="text" name="schoolYear" value="{{ Request::get('schoolYear') }}" hidden>
                    <button type="submit" class="btn btn-secondary">
                        <i class="ti ti-printer"></i>
                    </button>
                    </form>

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

                    @include('class_adviser.segments.filter-two')
            <button type="button" class="btn btn-secondary " data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="ti ti-list-check fs-4"></i>
            </button>

            <ul class="dropdown-menu animated flipInX shadow p-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRName" checked>
                    <label class="form-check-label" for="checkbox1">Grade Levels</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRDateOfBirth" checked>
                    <label class="form-check-label" for="checkbox1">Total Beneficiaries</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRWeight" checked>
                    <label class="form-check-label" for="checkbox1">Feeding Program</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRHeight" checked>
                    <label class="form-check-label" for="checkbox1">Immunization Program</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRSex" checked>
                    <label class="form-check-label" for="checkbox1">Deworming Program</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRHeightSquared" checked>
                    <label class="form-check-label" for="checkbox1">Dental Program</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRAge" checked>
                    <label class="form-check-label" for="checkbox1">Mental Health Program</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRBMI" checked>
                    <label class="form-check-label" for="checkbox1">Eye Care Program</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRBMICat" checked>
                    <label class="form-check-label" for="checkbox1">Health  And Wellness Program</label>
                </div>

            </ul>
                    </ul>

                </div>
            </div>
        </div>
    </div>

    <table class="table border table-bordered text-nowrap mt-1">
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

            $maleFeedingCount = $kinderRecords->where('gender', 'Male')->where('is_feeding_program', '1')->count();
            $femaleFeedingCount = $kinderRecords->where('gender', 'Female')->where('is_feeding_program', '1')->count();

            $maleVaccinationCount = $kinderRecords->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count();
            $femaleVaccinationCount = $kinderRecords->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count();

            $maleDewormingCount = $kinderRecords->where('gender', 'Male')->where('is_deworming_program', '1')->count();
            $femaleDewormingCount = $kinderRecords->where('gender', 'Female')->where('is_deworming_program', '1')->count();

            $maleDentalCount = $kinderRecords->where('gender', 'Male')->where('is_dental_care_program', '1')->count();
            $femaleDentalCount = $kinderRecords->where('gender', 'Female')->where('is_dental_care_program', '1')->count();

            $maleMentalCount = $kinderRecords->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count();
            $femaleMentalCount = $kinderRecords->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count();

            $maleEyeCount = $kinderRecords->where('gender', 'Male')->where('is_eye_care_program', '1')->count();
            $femaleEyeCount = $kinderRecords->where('gender', 'Female')->where('is_eye_care_program', '1')->count();

            $maleHealthCount = $kinderRecords->where('gender', 'Male')->where('is_health_wellness_program', '1')->count();
            $femaleHealthCount = $kinderRecords->where('gender', 'Female')->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($kinderRecords as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleFeedingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleFeedingCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleFeedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleFeedingCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleVaccinationCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleVaccinationCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleVaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleVaccinationCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDewormingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDewormingCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleMentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleMentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleMentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleMentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleEyeCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleEyeCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleEyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleEyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleHealthCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleHealthCount }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleHealthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleHealthCount / $femaleCount) * 100, 2) }}%
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

            $maleFeedingCount = $grade1Records->where('gender', 'Male')->where('is_feeding_program', '1')->count();
            $femaleFeedingCount = $grade1Records->where('gender', 'Female')->where('is_feeding_program', '1')->count();

            $maleVaccinationCount = $grade1Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count();
            $femaleVaccinationCount = $grade1Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count();

            $maleDewormingCount = $grade1Records->where('gender', 'Male')->where('is_deworming_program', '1')->count();
            $femaleDewormingCount = $grade1Records->where('gender', 'Female')->where('is_deworming_program', '1')->count();

            $maleDentalCount = $grade1Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count();
            $femaleDentalCount = $grade1Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count();

            $maleMentalCount = $grade1Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count();
            $femaleMentalCount = $grade1Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count();

            $maleEyeCount = $grade1Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count();
            $femaleEyeCount = $grade1Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count();

            $maleHealthCount = $grade1Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count();
            $femaleHealthCount = $grade1Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade1Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleFeedingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleFeedingCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleFeedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleFeedingCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleVaccinationCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleVaccinationCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleVaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleVaccinationCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDewormingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDewormingCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleMentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleMentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleMentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleMentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleEyeCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleEyeCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleEyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleEyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleHealthCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleHealthCount }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleHealthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleHealthCount / $femaleCount) * 100, 2) }}%
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

            $maleFeedingCount = $grade2Records->where('gender', 'Male')->where('is_feeding_program', '1')->count();
            $femaleFeedingCount = $grade2Records->where('gender', 'Female')->where('is_feeding_program', '1')->count();

            $maleVaccinationCount = $grade2Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count();
            $femaleVaccinationCount = $grade2Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count();

            $maleDewormingCount = $grade2Records->where('gender', 'Male')->where('is_deworming_program', '1')->count();
            $femaleDewormingCount = $grade2Records->where('gender', 'Female')->where('is_deworming_program', '1')->count();

            $maleDentalCount = $grade2Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count();
            $femaleDentalCount = $grade2Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count();

            $maleMentalCount = $grade2Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count();
            $femaleMentalCount = $grade2Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count();

            $maleEyeCount = $grade2Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count();
            $femaleEyeCount = $grade2Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count();

            $maleHealthCount = $grade2Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count();
            $femaleHealthCount = $grade2Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade2Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleFeedingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleFeedingCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleFeedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleFeedingCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleVaccinationCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleVaccinationCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleVaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleVaccinationCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDewormingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDewormingCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleMentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleMentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleMentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleMentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleEyeCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleEyeCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleEyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleEyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleHealthCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleHealthCount }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleHealthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleHealthCount / $femaleCount) * 100, 2) }}%
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

            $maleFeedingCount = $grade3Records->where('gender', 'Male')->where('is_feeding_program', '1')->count();
            $femaleFeedingCount = $grade3Records->where('gender', 'Female')->where('is_feeding_program', '1')->count();

            $maleVaccinationCount = $grade3Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count();
            $femaleVaccinationCount = $grade3Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count();

            $maleDewormingCount = $grade3Records->where('gender', 'Male')->where('is_deworming_program', '1')->count();
            $femaleDewormingCount = $grade3Records->where('gender', 'Female')->where('is_deworming_program', '1')->count();

            $maleDentalCount = $grade3Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count();
            $femaleDentalCount = $grade3Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count();

            $maleMentalCount = $grade3Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count();
            $femaleMentalCount = $grade3Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count();

            $maleEyeCount = $grade3Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count();
            $femaleEyeCount = $grade3Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count();

            $maleHealthCount = $grade3Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count();
            $femaleHealthCount = $grade3Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade3Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleFeedingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleFeedingCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleFeedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleFeedingCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleVaccinationCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleVaccinationCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleVaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleVaccinationCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDewormingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDewormingCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleMentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleMentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleMentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleMentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleEyeCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleEyeCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleEyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleEyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleHealthCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleHealthCount }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleHealthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleHealthCount / $femaleCount) * 100, 2) }}%
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

            $maleFeedingCount = $grade4Records->where('gender', 'Male')->where('is_feeding_program', '1')->count();
            $femaleFeedingCount = $grade4Records->where('gender', 'Female')->where('is_feeding_program', '1')->count();

            $maleVaccinationCount = $grade4Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count();
            $femaleVaccinationCount = $grade4Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count();

            $maleDewormingCount = $grade4Records->where('gender', 'Male')->where('is_deworming_program', '1')->count();
            $femaleDewormingCount = $grade4Records->where('gender', 'Female')->where('is_deworming_program', '1')->count();

            $maleDentalCount = $grade4Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count();
            $femaleDentalCount = $grade4Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count();

            $maleMentalCount = $grade4Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count();
            $femaleMentalCount = $grade4Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count();

            $maleEyeCount = $grade4Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count();
            $femaleEyeCount = $grade4Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count();

            $maleHealthCount = $grade4Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count();
            $femaleHealthCount = $grade4Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade4Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleFeedingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleFeedingCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleFeedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleFeedingCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleVaccinationCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleVaccinationCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleVaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleVaccinationCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDewormingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDewormingCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleMentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleMentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleMentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleMentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleEyeCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleEyeCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleEyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleEyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleHealthCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleHealthCount }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleHealthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleHealthCount / $femaleCount) * 100, 2) }}%
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

            $maleFeedingCount = $grade5Records->where('gender', 'Male')->where('is_feeding_program', '1')->count();
            $femaleFeedingCount = $grade5Records->where('gender', 'Female')->where('is_feeding_program', '1')->count();

            $maleVaccinationCount = $grade5Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count();
            $femaleVaccinationCount = $grade5Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count();

            $maleDewormingCount = $grade5Records->where('gender', 'Male')->where('is_deworming_program', '1')->count();
            $femaleDewormingCount = $grade5Records->where('gender', 'Female')->where('is_deworming_program', '1')->count();

            $maleDentalCount = $grade5Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count();
            $femaleDentalCount = $grade5Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count();

            $maleMentalCount = $grade5Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count();
            $femaleMentalCount = $grade5Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count();

            $maleEyeCount = $grade5Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count();
            $femaleEyeCount = $grade5Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count();

            $maleHealthCount = $grade5Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count();
            $femaleHealthCount = $grade5Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade5Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleFeedingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleFeedingCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleFeedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleFeedingCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleVaccinationCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleVaccinationCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleVaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleVaccinationCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDewormingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDewormingCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleMentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleMentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleMentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleMentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleEyeCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleEyeCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleEyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleEyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleHealthCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleHealthCount }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleHealthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleHealthCount / $femaleCount) * 100, 2) }}%
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

            $maleFeedingCount = $grade6Records->where('gender', 'Male')->where('is_feeding_program', '1')->count();
            $femaleFeedingCount = $grade6Records->where('gender', 'Female')->where('is_feeding_program', '1')->count();

            $maleVaccinationCount = $grade6Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count();
            $femaleVaccinationCount = $grade6Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count();

            $maleDewormingCount = $grade6Records->where('gender', 'Male')->where('is_deworming_program', '1')->count();
            $femaleDewormingCount = $grade6Records->where('gender', 'Female')->where('is_deworming_program', '1')->count();

            $maleDentalCount = $grade6Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count();
            $femaleDentalCount = $grade6Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count();

            $maleMentalCount = $grade6Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count();
            $femaleMentalCount = $grade6Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count();

            $maleEyeCount = $grade6Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count();
            $femaleEyeCount = $grade6Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count();

            $maleHealthCount = $grade6Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count();
            $femaleHealthCount = $grade6Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($grade6Records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleFeedingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleFeedingCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleFeedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleFeedingCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleVaccinationCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleVaccinationCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleVaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleVaccinationCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDewormingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDewormingCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleMentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleMentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleMentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleMentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleEyeCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleEyeCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleEyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleEyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleHealthCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleHealthCount }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleHealthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleHealthCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
        </tr>
        @endforeach

        </tr>
        @endif

        <!-- ========================================= GRADE TOTAL ======================================== -->
        
        <!--<tr class="border border-2 border-dark text-center">
            <td rowspan="2" style="vertical-align: middle;">Total</td>

            @php
            $maleCount = $kinderRecords->where('gender', 'Male')->count() +
            $grade1Records->where('gender', 'Male')->count() +
            $grade2Records->where('gender', 'Male')->count() +
            $grade3Records->where('gender', 'Male')->count() +
            $grade4Records->where('gender', 'Male')->count() +
            $grade5Records->where('gender', 'Male')->count() +
            $grade6Records->where('gender', 'Male')->count() +
            $spedRecords->where('gender', 'Male')->count();
            $femaleCount = $kinderRecords->where('gender', 'Female')->count() +
            $grade1Records->where('gender', 'Female')->count() +
            $grade2Records->where('gender', 'Female')->count() +
            $grade3Records->where('gender', 'Female')->count() +
            $grade4Records->where('gender', 'Female')->count() +
            $grade5Records->where('gender', 'Female')->count() +
            $grade6Records->where('gender', 'Female')->count() +
            $spedRecords->where('gender', 'Female')->count();

            $maleFeedingCount = $kinderRecords->where('gender', 'Male')->where('is_feeding_program', '1')->count() +
            $grade1Records->where('gender', 'Male')->where('is_feeding_program', '1')->count() +
            $grade2Records->where('gender', 'Male')->where('is_feeding_program', '1')->count() +
            $grade3Records->where('gender', 'Male')->where('is_feeding_program', '1')->count() +
            $grade4Records->where('gender', 'Male')->where('is_feeding_program', '1')->count() +
            $grade5Records->where('gender', 'Male')->where('is_feeding_program', '1')->count() +
            $grade6Records->where('gender', 'Male')->where('is_feeding_program', '1')->count() +
            $spedRecords->where('gender', 'Male')->where('is_feeding_program', '1')->count();
            $femaleFeedingCount = $kinderRecords->where('gender', 'Female')->where('is_feeding_program', '1')->count() +
            $grade1Records->where('gender', 'Female')->where('is_feeding_program', '1')->count() +
            $grade2Records->where('gender', 'Female')->where('is_feeding_program', '1')->count() +
            $grade3Records->where('gender', 'Female')->where('is_feeding_program', '1')->count() +
            $grade4Records->where('gender', 'Female')->where('is_feeding_program', '1')->count() +
            $grade5Records->where('gender', 'Female')->where('is_feeding_program', '1')->count() +
            $grade6Records->where('gender', 'Female')->where('is_feeding_program', '1')->count() +
            $spedRecords->where('gender', 'Female')->where('is_feeding_program', '1')->count();

            $maleVaccinationCount = $kinderRecords->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count() +
            $grade1Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count() +
            $grade2Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count() +
            $grade3Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count() +
            $grade4Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count() +
            $grade5Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count() +
            $grade6Records->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count() +
            $spedRecords->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count();
            $femaleVaccinationCount = $kinderRecords->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count() +
            $grade1Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count() +
            $grade2Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count() +
            $grade3Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count() +
            $grade4Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count() +
            $grade5Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count() +
            $grade6Records->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count() +
            $spedRecords->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count();

            $maleDewormingCount = $kinderRecords->where('gender', 'Male')->where('is_deworming_program', '1')->count() +
            $grade1Records->where('gender', 'Male')->where('is_deworming_program', '1')->count() +
            $grade2Records->where('gender', 'Male')->where('is_deworming_program', '1')->count() +
            $grade3Records->where('gender', 'Male')->where('is_deworming_program', '1')->count() +
            $grade4Records->where('gender', 'Male')->where('is_deworming_program', '1')->count() +
            $grade5Records->where('gender', 'Male')->where('is_deworming_program', '1')->count() +
            $grade6Records->where('gender', 'Male')->where('is_deworming_program', '1')->count() +
            $spedRecords->where('gender', 'Male')->where('is_deworming_program', '1')->count();
            $femaleDewormingCount = $kinderRecords->where('gender', 'Female')->where('is_deworming_program', '1')->count() +
            $grade1Records->where('gender', 'Female')->where('is_deworming_program', '1')->count() +
            $grade2Records->where('gender', 'Female')->where('is_deworming_program', '1')->count() +
            $grade3Records->where('gender', 'Female')->where('is_deworming_program', '1')->count() +
            $grade4Records->where('gender', 'Female')->where('is_deworming_program', '1')->count() +
            $grade5Records->where('gender', 'Female')->where('is_deworming_program', '1')->count() +
            $grade6Records->where('gender', 'Female')->where('is_deworming_program', '1')->count() +
            $spedRecords->where('gender', 'Female')->where('is_deworming_program', '1')->count();

            $maleDentalCount = $kinderRecords->where('gender', 'Male')->where('is_dental_care_program', '1')->count() + 
            $grade1Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count() +
            $grade2Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count() +
            $grade3Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count() +
            $grade4Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count() +
            $grade5Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count() +
            $grade6Records->where('gender', 'Male')->where('is_dental_care_program', '1')->count() +
            $spedRecords->where('gender', 'Male')->where('is_dental_care_program', '1')->count();
            $femaleDentalCount = $kinderRecords->where('gender', 'Female')->where('is_dental_care_program', '1')->count() + 
            $grade1Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count() +
            $grade2Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count() +
            $grade3Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count() +
            $grade4Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count() +
            $grade5Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count() +
            $grade6Records->where('gender', 'Female')->where('is_dental_care_program', '1')->count() +
            $spedRecords->where('gender', 'Female')->where('is_dental_care_program', '1')->count();

            $maleMentalCount = $kinderRecords->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count() +
            $grade1Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count() +
            $grade2Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count() +
            $grade3Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count() +
            $grade4Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count() +
            $grade5Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count() +
            $grade6Records->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count() +
            $spedRecords->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count();
            $femaleMentalCount = $kinderRecords->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count() +
            $grade1Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count() +
            $grade2Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count() +
            $grade3Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count() +
            $grade4Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count() +
            $grade5Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count() +
            $grade6Records->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count() +
            $spedRecords->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count();

            $maleEyeCount = $kinderRecords->where('gender', 'Male')->where('is_eye_care_program', '1')->count() +
            $grade1Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count() +
            $grade2Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count() +
            $grade3Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count() +
            $grade4Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count() +
            $grade5Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count() +
            $grade6Records->where('gender', 'Male')->where('is_eye_care_program', '1')->count() +
            $spedRecords->where('gender', 'Male')->where('is_eye_care_program', '1')->count();
            $femaleEyeCount = $kinderRecords->where('gender', 'Female')->where('is_eye_care_program', '1')->count() +
            $grade1Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count() +
            $grade2Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count() +
            $grade3Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count() +
            $grade4Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count() +
            $grade5Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count() +
            $grade6Records->where('gender', 'Female')->where('is_eye_care_program', '1')->count() +
            $spedRecords->where('gender', 'Female')->where('is_eye_care_program', '1')->count();

            $maleHealthCount = $kinderRecords->where('gender', 'Male')->where('is_health_wellness_program', '1')->count() +
            $grade1Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count() +
            $grade2Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count() +
            $grade3Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count() +
            $grade4Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count() +
            $grade5Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count() +
            $grade6Records->where('gender', 'Male')->where('is_health_wellness_program', '1')->count() +
            $spedRecords->where('gender', 'Male')->where('is_health_wellness_program', '1')->count();
            $femaleHealthCount = $kinderRecords->where('gender', 'Female')->where('is_health_wellness_program', '1')->count() +
            $grade1Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count() +
            $grade2Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count() +
            $grade3Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count() +
            $grade4Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count() +
            $grade5Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count() +
            $grade6Records->where('gender', 'Female')->where('is_health_wellness_program', '1')->count() +
            $spedRecords->where('gender', 'Female')->where('is_health_wellness_program', '1')->count();
            @endphp

            @php
                $records = [];

                foreach (['Male', 'Female'] as $gender) {
                    $record = new \stdClass();
                    $record->gender = $gender;
                    $records[] = $record;
                }
            @endphp

            @foreach($records as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleFeedingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleFeedingCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleFeedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleFeedingCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleVaccinationCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleVaccinationCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleVaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleVaccinationCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDewormingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDewormingCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleMentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleMentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleMentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleMentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleEyeCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleEyeCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleEyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleEyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleHealthCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleHealthCount }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleHealthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleHealthCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
        </tr>
        @endforeach

        </tr>
        @endif

        @if(count($spedRecords) > 0)
        <tr class="border border-2 border-dark text-center">
            <td rowspan="4" style="vertical-align: middle;">Grade SPED</td>

            @php
            $maleCount = $spedRecords->where('gender', 'Male')->count();
            $femaleCount = $spedRecords->where('gender', 'Female')->count();

            $maleFeedingCount = $spedRecords->where('gender', 'Male')->where('is_feeding_program', '1')->count();
            $femaleFeedingCount = $spedRecords->where('gender', 'Female')->where('is_feeding_program', '1')->count();

            $maleVaccinationCount = $spedRecords->where('gender', 'Male')->where('is_immunization_vax_program', '1')->count();
            $femaleVaccinationCount = $spedRecords->where('gender', 'Female')->where('is_immunization_vax_program', '1')->count();

            $maleDewormingCount = $spedRecords->where('gender', 'Male')->where('is_deworming_program', '1')->count();
            $femaleDewormingCount = $spedRecords->where('gender', 'Female')->where('is_deworming_program', '1')->count();

            $maleDentalCount = $spedRecords->where('gender', 'Male')->where('is_dental_care_program', '1')->count();
            $femaleDentalCount = $spedRecords->where('gender', 'Female')->where('is_dental_care_program', '1')->count();

            $maleMentalCount = $spedRecords->where('gender', 'Male')->where('is_mental_healthcare_program', '1')->count();
            $femaleMentalCount = $spedRecords->where('gender', 'Female')->where('is_mental_healthcare_program', '1')->count();

            $maleEyeCount = $spedRecords->where('gender', 'Male')->where('is_eye_care_program', '1')->count();
            $femaleEyeCount = $spedRecords->where('gender', 'Female')->where('is_eye_care_program', '1')->count();

            $maleHealthCount = $spedRecords->where('gender', 'Male')->where('is_health_wellness_program', '1')->count();
            $femaleHealthCount = $spedRecords->where('gender', 'Female')->where('is_health_wellness_program', '1')->count();
            @endphp

            @foreach($spedRecords as $record)
        <tr class="border border-2 border-dark">
            <td class="text-center">{{ $record->gender == 'Male' ? 'M' : 'F' }}</td>
            <td class="text-center">{{ $record->gender == 'Male' ? $maleCount : $femaleCount }}</td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleFeedingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleFeedingCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleFeedingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleFeedingCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleVaccinationCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleVaccinationCount }}
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleVaccinationCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleVaccinationCount / $femaleCount) * 100, 2) }}%
            @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDewormingCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDewormingCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDewormingCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDewormingCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleDentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleDentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleDentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleDentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleMentalCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleMentalCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleMentalCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleMentalCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleEyeCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleEyeCount }}
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleEyeCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleEyeCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
            <td class="text-center">
            @if($record->gender == 'Male' && $maleCount > 0)
                {{ $maleHealthCount }}
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ $femaleHealthCount }}%
            @endif
            </td>
            <td class="text-center">
                @if($record->gender == 'Male' && $maleCount > 0)
                {{ number_format(($maleHealthCount / $maleCount) * 100, 2) }}%
                @elseif($record->gender == 'Female' && $femaleCount > 0)
                {{ number_format(($femaleHealthCount / $femaleCount) * 100, 2) }}%
                @endif
            </td>
        </tr>
        @endforeach

        </tr>-->
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
        onclick="window.location.href='{{ url()->previous() }}'">Okay, I understand</button>

</div>

@endif
