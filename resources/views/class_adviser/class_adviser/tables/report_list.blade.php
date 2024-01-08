@if(count($dataClassRecord['getRecord']) !== 0)
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
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
                <th class="hidden">Height For <br>
                    Age</th>
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
            <td>{{ $loop->index + 1 + ($dataClassRecord['getRecord']->perPage() * 
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
            <td><span>{{ $value->bmiCategory }}</span></td>
            @php

            $childHeight = $value->height;
            $childAge = $age->y;

            // Validate input parameters
            if (!is_numeric($childHeight) || !is_numeric($childAge)) {
                // Handle invalid input (e.g., log an error or return an appropriate response)
                $heightForAgeZScore = 0;
                $heightCategory = 'Invalid Input';
            } else {
                $ageGroups = [
                    ['minAge' => 5, 'maxAge' => 10, 'medianHeight' => 130, 'stdDeviation' => 1],
                    ['minAge' => 11, 'maxAge' => 15, 'medianHeight' => 140, 'stdDeviation' => 1],
                    ['minAge' => 16, 'maxAge' => 20, 'medianHeight' => 150, 'stdDeviation' => 1],
                    ['minAge' => 21, 'maxAge' => 50, 'medianHeight' => 160, 'stdDeviation' => 1],
                ];

                // Check if the function already exists before declaring it
                if (!function_exists('findAgeGroup')) {
                    function findAgeGroup($age, $ageGroups) {
                        foreach ($ageGroups as $group) {
                            if ($age >= $group['minAge'] && $age <= $group['maxAge']) {
                                return $group;
                            }
                        }

                        return null;
                    }
                }

                // Check if the function already exists before declaring it
                if (!function_exists('calculateCustomHeightForAgeZScore')) {
                    function calculateCustomHeightForAgeZScore($childHeight, $age, $ageGroups) {
                        $ageGroup = findAgeGroup($age, $ageGroups);

                        if ($ageGroup === null || $ageGroup['stdDeviation'] == 0) {
                            // Log or handle the division by zero case
                            return 0;
                        }

                        return round(($childHeight - $ageGroup['medianHeight']) / $ageGroup['stdDeviation'], 2);
                    }
                }

                // Check if the function already exists before declaring it
                if (!function_exists('categorizeHeightForAge')) {
                    function categorizeHeightForAge($zScore) {
                        if ($zScore < -2.5) {
                            return 'Severely Stunted';
                        } elseif ($zScore >= -2.5 && $zScore <= -1.5){
                            return 'Stunted';
                        } elseif ($zScore >= -1.5 && $zScore <= 2) {
                            return 'Normal';
                        } else {
                            return 'Tall';
                        }
                    }
                }

                // Calculate Z-score and height category
                $heightForAgeZScore = calculateCustomHeightForAgeZScore($childHeight, $childAge, $ageGroups) / 100;
                $heightCategory = categorizeHeightForAge($heightForAgeZScore);
            }

            @endphp

            <!-- Display results -->
            <td class="hidden"><span>{{ number_format($heightForAgeZScore, 2) }} Z-score</span></td>
            <td><span>{{ $heightCategory }}</span></td>


            </tr>
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
            {!! $dataClassRecord['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>
@else
<div class="d-flex bg-warning text-white">
    The class has no data. 
</div>
@endif
