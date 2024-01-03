<div class="print-btn float-right" onclick="printToPDF()">Print to PDF</div>
@if(count($getNsrList['getList']) !== 0)
<table class="table border table-bordered text-nowrap mt-5">
    <thead>
        <!-- start row -->
        <tr class="border border-2 border-dark text-center">
            <th rowspan="4">Schools</th>
            <th colspan="2" rowspan="4">No of<br> Pupils</th>
        </tr>
        <tr class="border border-2 border-dark">
            <th colspan="10" class="bg-light-success text-bold text-center">BODY MASS INDEX (BMI)</th>
            <th colspan="10" class="bg-light-primary text-bold text-center">HEIGHT-FOR-AGE (HFA)</th>
        </tr>
        <tr class="border border-2 border-dark text-center">
            <th colspan="2" class="fs-1">Severely<br>Wasted</th>
            <th colspan="2" class="fs-1">Wasted</th>
            <th colspan="2" class="fs-1">Normal</th>
            <th colspan="2" class="fs-1">Overweight</th>
            <th colspan="2" class="fs-1">Obese</th>
            <th colspan="2" class="fs-1">Severely<br>Stunted</th>
            <th colspan="2" class="fs-1">Stunted</th>
            <th colspan="2" class="fs-1">Normal</th>
            <th colspan="2" class="fs-1">Tall</th>
        </tr>
        <tr class="border border-2 border-dark text-center">
            <th colspan="1" class="fs-1">No.</th>
            <th colspan="1" class="fs-1">%</th>
            <th colspan="1" class="fs-1">No.</th>
            <th colspan="1" class="fs-1">%</th>
            <th colspan="1" class="fs-1">No.</th>
            <th colspan="1" class="fs-1">%</th>
            <th colspan="1" class="fs-1">No.</th>
            <th colspan="1" class="fs-1">%</th>
            <th colspan="1" class="fs-1">No.</th>
            <th colspan="1" class="fs-1">%</th>
            <th colspan="1" class="fs-1">No.</th>
            <th colspan="1" class="fs-1">%</th>
            <th colspan="1" class="fs-1">No.</th>
            <th colspan="1" class="fs-1">%</th>
            <th colspan="1" class="fs-1">No.</th>
            <th colspan="1" class="fs-1">%</th>
            <th colspan="1" class="fs-1">No.</th>
            <th colspan="1" class="fs-1">%</th>
        </tr>

        <!-- end row -->
    </thead>
    <tbody>
        @php
        $totalMale = 0;
        $totalFemale = 0;
        $totalPupils = 0;
        @endphp

        @foreach($getNsrList['getList'] as $cnsrList)
        @php
        $categories = ['severely_wasted', 'wasted', 'weight_normal', 'overweight', 'obese', 'severely_stunted',
        'stunted', 'height_normal', 'tall'];
        @endphp

        <tr class="border-2 border-dark">
            <td rowspan="3" style="text-align: center; vertical-align:middle;">{{ $schoolName[$cnsrList['school_id']] }}
            </td>
            <td class="text-center">{{ 'M' }}</td>
            <td class="text-center">{{ $cnsrList['no_of_male_pupils'] }}</td>

            @foreach ($categories as $category)
            @php
            $countKey = "no_of_male_$category";
            $percentageKey = "percentage_$category";
            @endphp

            <td class="text-center">{{ $cnsrList[$countKey] }}</td>
            <td class="text-center">
                {{ number_format(($cnsrList[$countKey] / $cnsrList['no_of_male_pupils']) * 100, 2) }}%
            </td>
            @endforeach
        </tr>


        <tr class="border-2 border-dark">
            <td class="text-center">{{ 'F' }}</td>
            <td class="text-center">{{ $cnsrList['no_of_female_pupils'] }}</td>

            @foreach ($categories as $category)
            @php
            $countKey = "no_of_female_$category";
            $percentageKey = "percentage_$category";
            @endphp

            <td class="text-center">{{ $cnsrList[$countKey] }}</td>
            <td class="text-center">
                {{ number_format(($cnsrList[$countKey] / $cnsrList['no_of_female_pupils']) * 100, 2) }}%
            </td>
            @endforeach
        </tr>

        <tr class="border-2 border-dark">
            <td  class="text-center bg-light-primary">{{ 'Total' }}</td>
            <td class="text-center bg-light-primary">{{ $cnsrList['no_of_pupils'] }}</td>

            @foreach ($categories as $category)
            @php
            $countKey = "no_of_$category";
            $percentageKey = "percentage_$category";
            @endphp

            <td class="text-center bg-light-primary">{{ $cnsrList[$countKey] }}</td>
            <td class="text-center bg-light-primary">
                {{ number_format(($cnsrList[$countKey] / $cnsrList['no_of_pupils']) * 100, 2) }}%
            </td>
            @endforeach
        </tr>

        <tr class="border-2 border-dark">
            <td class="text-center bg-light-primary">{{ 'Grand Total' }}</td>
            <td class="text-center bg-light-primary">Total</td>
            <td class="text-center bg-light-primary">{{ $cnsrList['no_of_pupils'] }}</td>

            @foreach ($categories as $category)
                @php
                $countKey = "no_of_$category";
                $percentageKey = "percentage_$category";
                @endphp

                <td class="text-center bg-light-primary">{{ $cnsrList[$countKey] }}</td>
                <td class="text-center bg-light-primary">
                    {{ number_format(($cnsrList[$countKey] / $cnsrList['no_of_pupils']) * 100, 2) }}%
                </td>

                <!-- Accumulate values for total calculation -->
                @if (strpos($countKey, 'male') !== false)
                    @php
                    $totalMale += $cnsrList[$countKey];
                    @endphp
                @elseif (strpos($countKey, 'female') !== false)
                    @php
                    $totalFemale += $cnsrList[$countKey];
                    @endphp
                @endif
            @endforeach

            <!-- Accumulate total pupils count -->
            @php
            $totalPupils += $cnsrList['no_of_pupils'];
            @endphp
        </tr>

        @endforeach

    </tbody>

</table>

<div class="d-flex row mt-5">
        <div class="d-flex row col-6">
            <div class="fs-2 fw-bolder mb-1">
                Prepared By:
            </div>
            <div class="mt-3"></div>
            <div class="fs-2 fw-bolder mb-1">
                Medical Officer
            </div>
        </div>
        <div class="d-flex row col-6">
            <div class="fs-1 mb-1 d-flex text-gray justify-content-end">

            </div>
            <div></div>
            <div class="fs-1 mb-1 d-flex justify-content-end">
                CNSR CODE : #{{ $getNsrList['getList'][0]['cnsr_code'] }}
                @php echo now()->toDateTimeString(); @endphp
            </div>
        </div>
    </div>

@endif
