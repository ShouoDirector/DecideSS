<!-- ========================================= GRADE KINDER ======================================== -->
@if(count($kinderRecords) > 0)
<tr class="border border-2 border-dark text-center">
    <td rowspan="4" style="vertical-align: middle;">Grade 1</td>

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




