@if(count($getNsrList['getList']) !== 0)
<div class="print-btn" onclick="printToPDF()">Print to PDF</div>
<div class="table w-100 pb-3">
    <h5 class="text-center fw-bolder">CONSOLIDATED NUTRITIONAL STATUS REPORT OF {{ strtoupper($schoolName[$getSchoolId]) }}</h5>
    <h6 class="text-center">{{ strtoupper($districtName[$districtId[$getSchoolId]]) }} DISTRICT</h6>
    <h6 class="text-center">{{ $schoolYearPhaseName }}</h6>
    <table class="table border table-bordered text-nowrap mt-5">
        <thead>
            <!-- start row -->
            <tr class="border border-2 border-dark text-center">
                <th rowspan="4" >Grade<br>Levels</th>
                <th colspan="2" rowspan="4">No of<br> Pupils</th>
            </tr>
            <tr class="border border-2 border-dark">
                <th colspan="12" class="bg-light-success text-bold text-center">BODY MASS INDEX (BMI)</th>
                <th colspan="10" class="bg-light-primary fw-bold text-bold text-center">HEIGHT-FOR-AGE (HFA)</th>
            </tr>
            <tr class="border border-2 border-dark text-center">
            <th colspan="2" class="fs-1">Severely<br>Wasted</th>
            <th colspan="2" class="fs-1">Wasted</th>
            <th colspan="2" class="fs-1">Normal</th>
            <th colspan="2" class="fs-1">Overweight</th>
            <th colspan="2" class="fs-1">Obese</th>
            <th colspan="2" class="fs-1">Malnourished</th>
            <th colspan="2" class="fs-1">Severely<br>Stunted</th>
            <th colspan="2" class="fs-1">Stunted</th>
            <th colspan="2" class="fs-1">Normal</th>
            <th colspan="2" class="fs-1">Tall</th>
            <th colspan="2" class="fs-1">All Stunted</th>
            </tr>
            <tr class="border border-2 border-dark text-center">
                @php
                    $columns = ['No', '%'];
                    $numColumns = 12; // Adjust the number of columns as needed
                @endphp

                @for ($i = 1; $i < $numColumns; $i++)
                    @foreach ($columns as $column)
                        <th colspan="1" class="fs-1">{{ $column }}</th>
                    @endforeach
                @endfor
            </tr>

            <!-- end row -->
        </thead>
        <tbody>
            <!-- KINDER -->
            @if(count($kinderRecords) === 0)
            @else
                <tr class="border border-2 border-dark text-center">
                    <td rowspan="4" style="vertical-align: middle;"> Kinder </td>
                    @foreach(['M', 'F'] as $gender)
                        <tr class="border border-2 border-dark">
                            <td class="text-center">{{ $gender }}</td>
                            <td>{{ $kinderRecords->sum("no_of_${gender}_pupils") }}</td>
                            @php
                                $metrics = [
                                    'severely_wasted', 'wasted', 'weight_normal', 'overweight', 'obese',
                                    'malnourished_pupils', 'severely_stunted', 'stunted', 'height_normal',
                                    'tall', 'stunted_pupils'
                                ];
                            @endphp

                            @foreach ($metrics as $metric)
                                <td>{{ $kinderRecords->sum("no_of_${gender}_${metric}") }}</td>
                                <td>
                                    @if ($kinderRecords->sum("no_of_${gender}_pupils") > 0)
                                        {{ number_format(($kinderRecords->sum("no_of_${gender}_${metric}") / 
                                            $kinderRecords->sum("no_of_${gender}_pupils")) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    <tr class="border border-2 border-dark">
                        <td class="bg-light-secondary fw-bold"><span class="fw-bolder">Total</span></td>
                        <td class="bg-light-secondary fw-bold"><span class="fw-bolder">{{ $kinderRecords->sum('no_of_pupils') }}</span></td>

                        @foreach ($metrics as $metric)
                            <td class="bg-light-secondary fw-bold">
                                <span class="fw-bolder">{{ $kinderRecords->sum("no_of_${metric}") }}</span>
                            </td>
                            <td class="bg-light-secondary fw-bold">
                                <span class="fw-bolder">
                                    @if($kinderRecords->sum('no_of_pupils') > 0)
                                        {{ number_format(($kinderRecords->sum("no_of_${metric}") / $kinderRecords->sum('no_of_pupils')) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </span>
                            </td>
                        @endforeach
                    </tr>
                </tr>
            @endif

            <!-- GRADE 1 -->
            @if(count($grade1Records) === 0)
            @else
                <tr class="border border-2 border-dark">
                    <td rowspan="4" style="vertical-align: middle;"> Kinder </td>
                    @foreach(['M', 'F'] as $gender)
                        <tr class="border border-2 border-dark">
                            <td>{{ $gender }}</td>
                            <td>{{ $grade1Records->sum("no_of_${gender}_pupils") }}</td>
                            @php
                                $metrics = [
                                    'severely_wasted', 'wasted', 'weight_normal', 'overweight', 'obese',
                                    'malnourished_pupils', 'severely_stunted', 'stunted', 'height_normal',
                                    'tall', 'stunted_pupils'
                                ];
                            @endphp

                            @foreach ($metrics as $metric)
                                <td>{{ $grade1Records->sum("no_of_${gender}_${metric}") }}</td>
                                <td>
                                    @if ($grade1Records->sum("no_of_${gender}_pupils") > 0)
                                        {{ number_format(($grade1Records->sum("no_of_${gender}_${metric}") / 
                                            $grade1Records->sum("no_of_${gender}_pupils")) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    <tr class="border border-2 border-dark">
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">Total</span></td>
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">{{ $grade1Records->sum('no_of_pupils') }}</span></td>

                        @foreach ($metrics as $metric)
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">{{ $grade1Records->sum("no_of_${metric}") }}</span>
                            </td>
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">
                                    @if($grade1Records->sum('no_of_pupils') > 0)
                                        {{ number_format(($grade1Records->sum("no_of_${metric}") / $grade1Records->sum('no_of_pupils')) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </span>
                            </td>
                        @endforeach
                    </tr>
                </tr>
            @endif

            <!-- GRADE 2 -->
            @if(count($grade2Records) === 0)
            @else
                <tr class="border border-2 border-dark">
                    <td rowspan="4" style="vertical-align: middle;"> Kinder </td>
                    @foreach(['M', 'F'] as $gender)
                        <tr class="border border-2 border-dark">
                            <td>{{ $gender }}</td>
                            <td>{{ $grade2Records->sum("no_of_${gender}_pupils") }}</td>
                            @php
                                $metrics = [
                                    'severely_wasted', 'wasted', 'weight_normal', 'overweight', 'obese',
                                    'malnourished_pupils', 'severely_stunted', 'stunted', 'height_normal',
                                    'tall', 'stunted_pupils'
                                ];
                            @endphp

                            @foreach ($metrics as $metric)
                                <td>{{ $grade2Records->sum("no_of_${gender}_${metric}") }}</td>
                                <td>
                                    @if ($grade2Records->sum("no_of_${gender}_pupils") > 0)
                                        {{ number_format(($grade2Records->sum("no_of_${gender}_${metric}") / 
                                            $grade2Records->sum("no_of_${gender}_pupils")) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    <tr class="border border-2 border-dark">
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">Total</span></td>
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">{{ $grade2Records->sum('no_of_pupils') }}</span></td>

                        @foreach ($metrics as $metric)
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">{{ $grade2Records->sum("no_of_${metric}") }}</span>
                            </td>
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">
                                    @if($grade2Records->sum('no_of_pupils') > 0)
                                        {{ number_format(($grade2Records->sum("no_of_${metric}") / $grade2Records->sum('no_of_pupils')) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </span>
                            </td>
                        @endforeach
                    </tr>
                </tr>
            @endif

            <!-- GRADE 3 -->
            @if(count($grade3Records) === 0)
            @else
                <tr class="border border-2 border-dark">
                    <td rowspan="4" style="vertical-align: middle;"> Kinder </td>
                    @foreach(['M', 'F'] as $gender)
                        <tr class="border border-2 border-dark">
                            <td>{{ $gender }}</td>
                            <td>{{ $grade3Records->sum("no_of_${gender}_pupils") }}</td>
                            @php
                                $metrics = [
                                    'severely_wasted', 'wasted', 'weight_normal', 'overweight', 'obese',
                                    'malnourished_pupils', 'severely_stunted', 'stunted', 'height_normal',
                                    'tall', 'stunted_pupils'
                                ];
                            @endphp

                            @foreach ($metrics as $metric)
                                <td>{{ $grade3Records->sum("no_of_${gender}_${metric}") }}</td>
                                <td>
                                    @if ($grade3Records->sum("no_of_${gender}_pupils") > 0)
                                        {{ number_format(($grade3Records->sum("no_of_${gender}_${metric}") / 
                                            $grade3Records->sum("no_of_${gender}_pupils")) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    <tr class="border border-2 border-dark">
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">Total</span></td>
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">{{ $grade3Records->sum('no_of_pupils') }}</span></td>

                        @foreach ($metrics as $metric)
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">{{ $grade3Records->sum("no_of_${metric}") }}</span>
                            </td>
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">
                                    @if($grade3Records->sum('no_of_pupils') > 0)
                                        {{ number_format(($grade3Records->sum("no_of_${metric}") / $grade3Records->sum('no_of_pupils')) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </span>
                            </td>
                        @endforeach
                    </tr>
                </tr>
            @endif

            <!-- GRADE 4 -->
            @if(count($grade4Records) === 0)
            @else
                <tr class="border border-2 border-dark">
                    <td rowspan="4" style="vertical-align: middle;"> Kinder </td>
                    @foreach(['M', 'F'] as $gender)
                        <tr class="border border-2 border-dark">
                            <td>{{ $gender }}</td>
                            <td>{{ $grade4Records->sum("no_of_${gender}_pupils") }}</td>
                            @php
                                $metrics = [
                                    'severely_wasted', 'wasted', 'weight_normal', 'overweight', 'obese',
                                    'malnourished_pupils', 'severely_stunted', 'stunted', 'height_normal',
                                    'tall', 'stunted_pupils'
                                ];
                            @endphp

                            @foreach ($metrics as $metric)
                                <td>{{ $grade4Records->sum("no_of_${gender}_${metric}") }}</td>
                                <td>
                                    @if ($grade4Records->sum("no_of_${gender}_pupils") > 0)
                                        {{ number_format(($grade4Records->sum("no_of_${gender}_${metric}") / 
                                            $grade4Records->sum("no_of_${gender}_pupils")) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    <tr class="border border-2 border-dark">
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">Total</span></td>
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">{{ $grade4Records->sum('no_of_pupils') }}</span></td>

                        @foreach ($metrics as $metric)
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">{{ $grade4Records->sum("no_of_${metric}") }}</span>
                            </td>
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">
                                    @if($grade4Records->sum('no_of_pupils') > 0)
                                        {{ number_format(($grade4Records->sum("no_of_${metric}") / $grade4Records->sum('no_of_pupils')) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </span>
                            </td>
                        @endforeach
                    </tr>
                </tr>
            @endif

            <!-- GRADE 5 -->
            @if(count($grade5Records) === 0)
            @else
                <tr class="border border-2 border-dark">
                    <td rowspan="4" style="vertical-align: middle;"> Kinder </td>
                    @foreach(['M', 'F'] as $gender)
                        <tr class="border border-2 border-dark">
                            <td>{{ $gender }}</td>
                            <td>{{ $grade5Records->sum("no_of_${gender}_pupils") }}</td>
                            @php
                                $metrics = [
                                    'severely_wasted', 'wasted', 'weight_normal', 'overweight', 'obese',
                                    'malnourished_pupils', 'severely_stunted', 'stunted', 'height_normal',
                                    'tall', 'stunted_pupils'
                                ];
                            @endphp

                            @foreach ($metrics as $metric)
                                <td>{{ $grade5Records->sum("no_of_${gender}_${metric}") }}</td>
                                <td>
                                    @if ($grade5Records->sum("no_of_${gender}_pupils") > 0)
                                        {{ number_format(($grade5Records->sum("no_of_${gender}_${metric}") / 
                                            $grade5Records->sum("no_of_${gender}_pupils")) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    <tr class="border border-2 border-dark">
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">Total</span></td>
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">{{ $grade5Records->sum('no_of_pupils') }}</span></td>

                        @foreach ($metrics as $metric)
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">{{ $grade5Records->sum("no_of_${metric}") }}</span>
                            </td>
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">
                                    @if($grade5Records->sum('no_of_pupils') > 0)
                                        {{ number_format(($grade5Records->sum("no_of_${metric}") / $grade5Records->sum('no_of_pupils')) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </span>
                            </td>
                        @endforeach
                    </tr>
                </tr>
            @endif

            <!-- GRADE 6 -->
            @if(count($grade6Records) === 0)
            @else
                <tr class="border border-2 border-dark">
                    <td rowspan="4" style="vertical-align: middle;"> Kinder </td>
                    @foreach(['M', 'F'] as $gender)
                        <tr class="border border-2 border-dark">
                            <td>{{ $gender }}</td>
                            <td>{{ $grade6Records->sum("no_of_${gender}_pupils") }}</td>
                            @php
                                $metrics = [
                                    'severely_wasted', 'wasted', 'weight_normal', 'overweight', 'obese',
                                    'malnourished_pupils', 'severely_stunted', 'stunted', 'height_normal',
                                    'tall', 'stunted_pupils'
                                ];
                            @endphp

                            @foreach ($metrics as $metric)
                                <td>{{ $grade6Records->sum("no_of_${gender}_${metric}") }}</td>
                                <td>
                                    @if ($grade6Records->sum("no_of_${gender}_pupils") > 0)
                                        {{ number_format(($grade6Records->sum("no_of_${gender}_${metric}") / 
                                            $grade6Records->sum("no_of_${gender}_pupils")) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    <tr class="border border-2 border-dark">
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">Total</span></td>
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">{{ $grade6Records->sum('no_of_pupils') }}</span></td>

                        @foreach ($metrics as $metric)
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">{{ $grade6Records->sum("no_of_${metric}") }}</span>
                            </td>
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">
                                    @if($grade6Records->sum('no_of_pupils') > 0)
                                        {{ number_format(($grade6Records->sum("no_of_${metric}") / $grade6Records->sum('no_of_pupils')) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </span>
                            </td>
                        @endforeach
                    </tr>
                </tr>
            @endif

            <!-- SPED -->
            @if(count($spedRecords) === 0)
            @else
                <tr class="border border-2 border-dark">
                    <td rowspan="4" style="vertical-align: middle;"> Kinder </td>
                    @foreach(['M', 'F'] as $gender)
                        <tr class="border border-2 border-dark">
                            <td>{{ $gender }}</td>
                            <td>{{ $spedRecords->sum("no_of_${gender}_pupils") }}</td>
                            @php
                                $metrics = [
                                    'severely_wasted', 'wasted', 'weight_normal', 'overweight', 'obese',
                                    'malnourished_pupils', 'severely_stunted', 'stunted', 'height_normal',
                                    'tall', 'stunted_pupils'
                                ];
                            @endphp

                            @foreach ($metrics as $metric)
                                <td>{{ $spedRecords->sum("no_of_${gender}_${metric}") }}</td>
                                <td>
                                    @if ($spedRecords->sum("no_of_${gender}_pupils") > 0)
                                        {{ number_format(($spedRecords->sum("no_of_${gender}_${metric}") / 
                                            $spedRecords->sum("no_of_${gender}_pupils")) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    <tr class="border border-2 border-dark">
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">Total</span></td>
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">{{ $spedRecords->sum('no_of_pupils') }}</span></td>

                        @foreach ($metrics as $metric)
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">{{ $spedRecords->sum("no_of_${metric}") }}</span>
                            </td>
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">
                                    @if($spedRecords->sum('no_of_pupils') > 0)
                                        {{ number_format(($spedRecords->sum("no_of_${metric}") / $spedRecords->sum('no_of_pupils')) * 100, 2) }}%
                                    @else
                                        0.00%
                                    @endif
                                </span>
                            </td>
                        @endforeach
                    </tr>
                </tr>
            @endif


            <!-- GRAND TOTAL -->
            @php
                $grades = ['Kinder', '1', '2', '3', '4', '5', '6', 'SPED'];
            @endphp

            @if(count($kinderRecords) > 0 || count($grade1Records) > 0 || count($grade2Records) > 0 || count($grade3Records) > 0 || count($grade4Records) > 0 || count($grade5Records) > 0 || count($grade6Records) > 0 || count($spedRecords) > 0)
                <tr class="border border-2 border-dark">
                    <td class="fw-bolder" rowspan="4" style="vertical-align: middle;"> Grand Total </td>
                    
                    @foreach(['M', 'F'] as $gender)
                        <tr class="border border-2 border-dark">
                            <td>{{ $gender }}</td>
                            <td>
                                {{
                                    $kinderRecords->sum("no_of_${gender}_pupils") +
                                    $grade1Records->sum("no_of_${gender}_pupils") +
                                    $grade2Records->sum("no_of_${gender}_pupils") +
                                    $grade3Records->sum("no_of_${gender}_pupils") +
                                    $grade4Records->sum("no_of_${gender}_pupils") +
                                    $grade5Records->sum("no_of_${gender}_pupils") +
                                    $grade6Records->sum("no_of_${gender}_pupils") +
                                    $spedRecords->sum("no_of_${gender}_pupils")
                                }}
                            </td>
                            
                            @php
                                $metrics = [
                                    'severely_wasted', 'wasted', 'weight_normal', 'overweight', 'obese',
                                    'malnourished_pupils', 'severely_stunted', 'stunted', 'height_normal',
                                    'tall', 'stunted_pupils'
                                ];
                            @endphp
                            
                            @foreach ($metrics as $metric)
                                <td>
                                    {{
                                        $kinderRecords->sum("no_of_${gender}_${metric}") +
                                        $grade1Records->sum("no_of_${gender}_${metric}") +
                                        $grade2Records->sum("no_of_${gender}_${metric}") +
                                        $grade3Records->sum("no_of_${gender}_${metric}") +
                                        $grade4Records->sum("no_of_${gender}_${metric}") +
                                        $grade5Records->sum("no_of_${gender}_${metric}") +
                                        $grade6Records->sum("no_of_${gender}_${metric}") +
                                        $spedRecords->sum("no_of_${gender}_${metric}")
                                    }}
                                </td>
                                
                                <td>
                                    @if (
                                        $kinderRecords->sum("no_of_${gender}_pupils") +
                                        $grade1Records->sum("no_of_${gender}_pupils") +
                                        $grade2Records->sum("no_of_${gender}_pupils") +
                                        $grade3Records->sum("no_of_${gender}_pupils") +
                                        $grade4Records->sum("no_of_${gender}_pupils") +
                                        $grade5Records->sum("no_of_${gender}_pupils") +
                                        $grade6Records->sum("no_of_${gender}_pupils") +
                                        $spedRecords->sum("no_of_${gender}_pupils") > 0
                                    )
                                        {{
                                            number_format(
                                                (
                                                    $kinderRecords->sum("no_of_${gender}_${metric}") +
                                                    $grade1Records->sum("no_of_${gender}_${metric}") +
                                                    $grade2Records->sum("no_of_${gender}_${metric}") +
                                                    $grade3Records->sum("no_of_${gender}_${metric}") +
                                                    $grade4Records->sum("no_of_${gender}_${metric}") +
                                                    $grade5Records->sum("no_of_${gender}_${metric}") +
                                                    $grade6Records->sum("no_of_${gender}_${metric}") +
                                                    $spedRecords->sum("no_of_${gender}_${metric}")
                                                ) /
                                                (
                                                    $kinderRecords->sum("no_of_${gender}_pupils") +
                                                    $grade1Records->sum("no_of_${gender}_pupils") +
                                                    $grade2Records->sum("no_of_${gender}_pupils") +
                                                    $grade3Records->sum("no_of_${gender}_pupils") +
                                                    $grade4Records->sum("no_of_${gender}_pupils") +
                                                    $grade5Records->sum("no_of_${gender}_pupils") +
                                                    $grade6Records->sum("no_of_${gender}_pupils") +
                                                    $spedRecords->sum("no_of_${gender}_pupils")
                                                ) * 100,
                                                2
                                            )
                                        }}%
                                    @else
                                        0.00%
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    <tr class="border border-2 border-dark">
                        <td class="bg-light-primary fw-bold"><span class="fw-bolder">Total</span></td>
                        <td class="bg-light-primary fw-bold">
                            <span class="fw-bolder">
                                {{
                                    $kinderRecords->sum('no_of_pupils') +
                                    $grade1Records->sum('no_of_pupils') +
                                    $grade2Records->sum('no_of_pupils') +
                                    $grade3Records->sum('no_of_pupils') +
                                    $grade4Records->sum('no_of_pupils') +
                                    $grade5Records->sum('no_of_pupils') +
                                    $grade6Records->sum('no_of_pupils') +
                                    $spedRecords->sum('no_of_pupils')
                                }}
                            </span>
                        </td>

                        @foreach ($metrics as $metric)
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">
                                    {{
                                        $kinderRecords->sum("no_of_${metric}") +
                                        $grade1Records->sum("no_of_${metric}") +
                                        $grade2Records->sum("no_of_${metric}") +
                                        $grade3Records->sum("no_of_${metric}") +
                                        $grade4Records->sum("no_of_${metric}") +
                                        $grade5Records->sum("no_of_${metric}") +
                                        $grade6Records->sum("no_of_${metric}") +
                                        $spedRecords->sum("no_of_${metric}")
                                    }}
                                </span>
                            </td>
                            <td class="bg-light-primary fw-bold">
                                <span class="fw-bolder">
                                    @if (
                                        $kinderRecords->sum('no_of_pupils') +
                                        $grade1Records->sum('no_of_pupils') +
                                        $grade2Records->sum('no_of_pupils') +
                                        $grade3Records->sum('no_of_pupils') +
                                        $grade4Records->sum('no_of_pupils') +
                                        $grade5Records->sum('no_of_pupils') +
                                        $grade6Records->sum('no_of_pupils') +
                                        $spedRecords->sum('no_of_pupils') > 0
                                    )
                                        {{
                                            number_format(
                                                (
                                                    $kinderRecords->sum("no_of_${metric}") +
                                                    $grade1Records->sum("no_of_${metric}") +
                                                    $grade2Records->sum("no_of_${metric}") +
                                                    $grade3Records->sum("no_of_${metric}") +
                                                    $grade4Records->sum("no_of_${metric}") +
                                                    $grade5Records->sum("no_of_${metric}") +
                                                    $grade6Records->sum("no_of_${metric}") +
                                                    $spedRecords->sum("no_of_${metric}")
                                                ) /
                                                (
                                                    $kinderRecords->sum('no_of_pupils') +
                                                    $grade1Records->sum('no_of_pupils') +
                                                    $grade2Records->sum('no_of_pupils') +
                                                    $grade3Records->sum('no_of_pupils') +
                                                    $grade4Records->sum('no_of_pupils') +
                                                    $grade5Records->sum('no_of_pupils') +
                                                    $grade6Records->sum('no_of_pupils') +
                                                    $spedRecords->sum('no_of_pupils')
                                                ) * 100,
                                                2
                                            )
                                        }}%
                                    @else
                                        0.00%
                                    @endif
                                </span>
                            </td>
                        @endforeach
                    </tr>
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
            <div></div>
            <div class="fs-2 fw-bolder mb-1">
                School Nurse
            </div>
        </div>
        <div class="d-flex row col-6">
            <div class="fs-2 fw-bolder mb-1">
                Noted By:
            </div>
            <div></div>
            <div class="fs-2 fw-bolder mb-1">
                School Head
            </div>
        </div>
    </div>

</div>
@else
<div class="d-flex bg-dark text-white p-5">
    Attention: The Consolidated Nutritional Status Report currently contains no data. As the school nurse, it is imperative that you review and approve the Nutritional Status Reports submitted by the Class Advisers.

    <br>Please be mindful that thorough review of Nutritional Status Reports is critical, as inaccuracies may have a cascading effect on existing data and impact the overall statistical integrity of your school's health records and status.
</div>

@endif
