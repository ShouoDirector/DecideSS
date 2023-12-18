<div class="d-flex row m-0 mb-3">
    <div class="bg-light-primary rounded text-dark fs-4 text-center col-12 px-4 py-3">
        OVERVIEW OF {{ $schoolName[$school] }}
    </div>
</div>
<div class="d-flex row col-12 mb-3">
    <div class="d-flex row col-12 justify-content-between">
        <div class="d-flex col-lg-4 col-12 p-3">
            <canvas id="myPieChartSchool"></canvas>
        </div>
        <div class="d-flex col-lg-8 col-12 p-3">
            <canvas id="myBarChartSchool"></canvas>
        </div>
    </div>
    <div class="d-flex col-lg-6 col-12 p-3 mt-5">
        <canvas id="myLineChartSchool"></canvas>
    </div>
</div>
<div class="col-lg-6 col-12 d-flex align-items-stretch">
    <div class="card w-100">
        <div class="card-body">
            <div class="d-sm-flex d-block align-items-center justify-content-between mb-7 bg-primary p-4 rounded">
                <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold text-white">Beneficiaries By Malnutrition</h5>
                    <p class="card-subtitle mb-0 text-white">Both Severely Stunted and Stunted</p>
                </div>
                <div>
                </div>
            </div>
            <div>
                <table class="table align-middle text-nowrap mb-0">
                    <thead>
                        <tr class="text-muted fw-semibold">
                            <th></th>
                            <th scope="col" class="ps-0">Pupils</th>
                            <th scope="col">BMI</th>
                            <th scope="col">See</th>
                        </tr>
                    </thead>
                    @foreach($getMalnourishedList['getRecords'] as $na)
                        @php
                            $gradeLevel = $classGradeLevel[$na->class_id];
                        @endphp
                        
                        @if(in_array($gradeLevel, ['Kinder', '1', '2', '3', '4', '5', '6', 'SPED']))
                            @if($na->bmi == 'Severely Wasted' || $na->bmi == 'Wasted')
                                <tbody class="border-top">
                                    <tr>
                                        <td class="text-dark">{{ $loop->iteration }}</td>
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <h6 class="fw-semibold mb-1">{{ $dataPupilNames[$na->pupil_id] }}</h6>
                                                    <p class="fs-2 mb-0 text-muted">Grade {{ $gradeLevel }} - {{ $className[$na->class_id] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="mb-0 fs-3">{{ $na->bmi }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            @endif
                        @endif
                    @endforeach


                </table>
                
            </div>
        </div>
    </div>
</div>



