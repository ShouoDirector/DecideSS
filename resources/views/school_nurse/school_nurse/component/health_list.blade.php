@if(count($getHealthRecords['getList']) !== 0)
<div class="table w-100 pb-3">

    <div class="print-btn rounded btn btn-primary text-white text-right fs-3 position-fixed w-auto"
        style="bottom: 10px; right: 10px;" onclick="printToPDF()"><i class="ti ti-printer"></i></div>
    <button class="print-btn w-auto position-fixed btn btn-secondary text-white" style="bottom: 10px; right: 65px;"
        onclick="window.location.href='{{ url()->previous() }}'"><i class="ti ti-arrow-left"></i></button>


    <h5 class="text-center fw-bolder">HEALTH SERVICES REPORT OF
        {{ strtoupper($schoolName[$getSchoolId]) }}</h5>
    <h6 class="text-center">{{ strtoupper($districtName[$districtId[$getSchoolId]]) }} DISTRICT</h6>
    <h6 class="text-center">{{ $schoolYearPhaseName }}</h6>

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

        <!-- ========================================= GRADE 6 ======================================== -->
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

        </tr>
        @endif
            <!-- End row -->
        </tbody>

    </table>

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
