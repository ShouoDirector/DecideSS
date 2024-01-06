@extends('layouts.app')
@section('content')
@if(Auth::user()->user_type == 1)
@php
$role = 'admin';
@endphp
@elseif(Auth::user()->user_type == 2)
@php
$role = 'medical_officer';
@endphp
@elseif(Auth::user()->user_type == 3)
@php
$role = 'school_nurse';
@endphp
@elseif(Auth::user()->user_type == 4)
@php
$role = 'class_adviser';
@endphp
@endif
<div class="container-fluid">
    <div class="row">

        <div class="col-12 w-100">
            @include('_message')
        </div>

        <div class="w-100 m-0 mb-5 p-4 shadow d-flex rounded gap-4">
            <div class="position-relative">
                <div class="border border-2 border-primary rounded-circle shadow">
                    <img src="{{ asset('upload/'.$role.'_images/'.$role.'.png') }}" class="rounded-circle m-1"
                        alt="user1" width="60">
                </div>
            </div>
            <div>
                <h3 class="fw-semibold">Hi, <span>{{ Auth::user()->name }}</span>
                </h3>
                <span>Cheers, and happy activities - {{ now()->format('F j Y') }}</span>
            </div>
        </div>

        <form action="{{ route('medical_officer.medical_officer_dashboard') }}" class="my-3">
            <h4>Your District</h4>
            <div class="d-flex row justify-end">
                <select class="form-select fw-semibold col-auto w-auto shadow" name="searchTime">
                    @foreach($dataSchoolYearPhase['getData'] as $school_year)
                    <option value="{{ $school_year->id }}"
                        {{ Request::get('searchTime') == $school_year->id ? 'selected' : '' }}>
                        {{ $school_year->school_year }} {{ $school_year->phase }}
                    </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary col-auto w-auto">
                    <i class="ti ti-search"></i>
                </button>
            </div>
        </form>

        @include('medical_officer.medical_officer.widgets.general-widgets')

        <div class="card shadow">
            <div class="card-body px-0">
                <div class="row pb-4 d-flex justify-content-center">
                    <p style="font-style: italic;">*Percentages on graphs are relative to the total number of pupils</p>
                    <div class="d-flex row col-12 justify-content-center gap-4">
                        <div class="col-lg-4 d-flex row justify-content-center">
                            <div class="w-100 mb-2 p-4 shadow d-flex justify-content-center rounded">
                                <canvas id="myPieChartDistrictTotalBMI"></canvas>
                            </div>
                            <div class="w-100 mt-2 p-4 shadow d-flex justify-content-center rounded">
                                <canvas id="myPieChartDistrictOverallHFA"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-7 d-flex flex-column">
                            <div class="w-100 mb-3 shadow p-4 d-flex flex-column justify-content-center rounded">
                                <div class="d-md-flex align-items-start gap-3">
                                    <div>
                                        <h6 class="mb-0">Overall</h6>
                                        <div class="d-flex align-items-center gap-3">
                                            <h6 class="mt-2 fw-bold">BODY MASS INDEX</h6>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <select class="form-select" id="myChartDistrictGeneralBMIChartTypeSelector">
                                            <option value="bar">Bar Graph</option>
                                            <option value="line">Line Graph</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4 flex-grow-1">
                                    <canvas id="myChartDistrictGeneralBMI"
                                        style="max-width: 100%; height: 280px;"></canvas>
                                </div>
                            </div>

                            <div class="w-100 mt-3 shadow p-4 d-flex flex-column justify-content-center rounded">
                                <div class="d-md-flex align-items-start gap-3">
                                    <div>
                                        <h6 class="mb-0">Overall</h6>
                                        <div class="d-flex align-items-center gap-3">
                                            <h6 class="mt-2 fw-bold">HEIGHT-FOR-AGE</h6>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <select class="form-select" id="myChartSectionGeneralHFAChartTypeSelector">
                                            <option value="bar">Bar Graph</option>
                                            <option value="line">Line Graph</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4 flex-grow-1">
                                    <canvas id="myChartDistrictGeneralHFA"
                                        style="max-width: 100%; height: 280px;"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 d-flex align-items-stretch pt-5">
                        <div class="w-100 p-4 shadow rounded px-3">
                            <div class="d-md-flex align-items-start gap-3">
                                <h5 class="card-title fw-semibold">Conclusion</h5>
                                @php
                                $sectionName = $dataClassNames[$sectionOfClassAdviser];
                                $totalPupilsValue = $totalPupils[0];

                                @endphp

                                <span class="fs-4">In the <b>{{ $sectionName }} District</b>,
                                    currently there are <b>{{ $totalPupilsValue }}</b> pupils, consisting of
                                    <b>{{ $totalMalePupils[0] }}</b> boys and {{ $totalFemalePupils[0] }} girls.
                                    <br>Among them,
                                    @if($totalMalnourishedPupils[0] > 0)
                                    {{ $totalMalnourishedPupils[0] }}
                                    ({{ $totalMalnourishedPupils[0] > 0 ? ($totalMalnourishedPupils[0] / $totalPupilsValue) * 100 : 0 }}%)
                                    pupils
                                    are
                                    classified as underweight,
                                    @else
                                    there is no underweight pupil,
                                    @endif

                                    @if($totalStuntedPupils[0] > 0)
                                    {{ $totalStuntedPupils[0] }}
                                    ({{ $totalStuntedPupils[0] > 0 ? ($totalStuntedPupils[0] / $totalPupilsValue) * 100 : 0 }}%)
                                    pupils have
                                    below-average
                                    height,
                                    @else
                                    there is no pupil with below-average height,
                                    @endif
                                    <br>
                                    Moreover,
                                    @if($totalSeverelyWastedPupils[0] > 0)
                                    {{ $totalSeverelyWastedPupils[0] }}
                                    ({{ $totalSeverelyWastedPupils[0] > 0 ? ($totalSeverelyWastedPupils[0] / $totalPupilsValue) * 100 : 0 }}%)
                                    pupils are severely
                                    wasted,
                                    @else
                                    there is no severely wasted pupil,
                                    @endif

                                    @if($totalWastedPupils[0] > 0)
                                    {{ $totalWastedPupils[0] }}
                                    ({{ $totalWastedPupils[0] > 0 ? ($totalWastedPupils[0] / $totalPupilsValue) * 100 : 0 }}%)
                                    wasted pupils,
                                    @else
                                    there is no wasted pupil,
                                    @endif

                                    @if($totalNormalInWeightPupils[0] > 0)
                                    {{ $totalNormalInWeightPupils[0] }}
                                    ({{ $totalNormalInWeightPupils[0] > 0 ? ($totalNormalInWeightPupils[0] / $totalPupilsValue) * 100 : 0 }}%)
                                    pupils with normal
                                    weight,
                                    @else
                                    there is no pupil with normal weight,
                                    @endif

                                    and

                                    @if($totalOverweightPupils[0] > 0)
                                    {{ $totalOverweightPupils[0] }}
                                    ({{ $totalOverweightPupils[0] > 0 ? ($totalOverweightPupils[0] / $totalPupilsValue) * 100 : 0 }}%)
                                    pupils
                                    classified as
                                    overweight.
                                    @else
                                    there is no overweight pupil.
                                    @endif

                                    Additionally,
                                    @if($totalObesePupils[0] > 0)
                                    {{ $totalObesePupils[0] }}
                                    ({{ $totalObesePupils[0] > 0 ? ($totalObesePupils[0] / $totalPupilsValue) * 100 : 0 }}%)
                                    pupils fall under the obese category.
                                    @else
                                    there is no obese pupil.
                                    @endif

                                    In terms of height,
                                    @if($totalSeverelyStuntedPupils[0] > 0)
                                    {{ $totalSeverelyStuntedPupils[0] }}
                                    ({{ $totalSeverelyStuntedPupils[0] > 0 ? ($totalSeverelyStuntedPupils[0] / $totalPupilsValue) * 100 : 0 }}%)
                                    pupils are severely
                                    stunted,
                                    @else
                                    there is no severely stunted pupil,
                                    @endif

                                    @if($totalStuntedPupils[0] > 0)
                                    {{ $totalStuntedPupils[0] }}
                                    ({{ $totalStuntedPupils[0] > 0 ? ($totalStuntedPupils[0] / $totalPupilsValue) * 100 : 0 }}%)
                                    pupils are
                                    stunted, and
                                    @else
                                    there is no stunted pupil,
                                    @endif

                                    @if($totalTallPupils[0] > 0)
                                    {{ $totalTallPupils[0] }}
                                    ({{ $totalTallPupils[0] > 0 ? ($totalTallPupils[0] / $totalPupilsValue) * 100 : 0 }}%)
                                    pupils are classified as tall.
                                    @else
                                    there is no tall pupil.
                                    @endif

                                    @if($totalPupilsNormalInHeight[0] > 0)
                                    The majority of pupils, {{ $totalPupilsNormalInHeight[0] }}
                                    ({{ $totalPupilsNormalInHeight[0] > 0 ? ($totalPupilsNormalInHeight[0] / $totalPupilsValue) * 100 : 0 }}%),
                                    have
                                    a normal
                                    height.
                                    @else
                                    There is no pupil with normal height.
                                    @endif
                                </span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="border-top">
                <div class="row gx-0 justify-content-center d-flex mb-3">
                    <p style="font-style: italic;">*Pupils below are enlisted by either the system or the respective school nurse</p>
                    <div class="col-md-3 border-end shadow mb-3 p-3">
                        <div class="p-4 py-3 py-md-4">
                            <p class="fs-4 text-dark mb-0">
                                </span>Feeding Program
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $collectiveData['feedingProgramCount'] }} pupils</h3>
                        </div>
                    </div>
                    <div class="col-md-3 border-end shadow mb-3 p-3">
                        <div class="p-4 py-3 py-md-4">
                            <p class="fs-4 text-dark mb-0">
                                </span>Deworming Program
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $collectiveData['dewormingProgramCount'] }} pupils</h3>
                        </div>
                    </div>
                    <div class="col-md-3 border-end shadow mb-3 p-3">
                        <div class="p-4 py-3 py-md-4">
                            <p class="fs-4 text-dark mb-0">
                                </span>Immunization Vax Program
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $collectiveData['immunizationVaxProgramCount'] }} pupils</h3>
                        </div>
                    </div>
                    <div class="col-md-3 border-end shadow mb-3 p-3">
                        <div class="p-4 py-3 py-md-4">
                            <p class="fs-4 text-dark mb-0">
                                </span>Mental Healthcare Program
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $collectiveData['mentalProgramCount'] }} pupils</h3>
                        </div>
                    </div>
                    <div class="col-md-3 border-end shadow mb-3 p-3">
                        <div class="p-4 py-3 py-md-4">
                            <p class="fs-4 text-dark mb-0">
                                </span>Dental Care Program
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $collectiveData['dentalProgramCount'] }} pupils</h3>
                        </div>
                    </div>
                    <div class="col-md-3 border-end shadow mb-3 p-3">
                        <div class="p-4 py-3 py-md-4">
                            <p class="fs-4 text-dark mb-0">
                                </span>Eye Care Program
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $collectiveData['eyeProgramCount'] }} pupils</h3>
                        </div>
                    </div>
                    <div class="col-md-3 border-end shadow mb-3 p-3">
                        <div class="p-4 py-3 py-md-4">
                            <p class="fs-4 text-dark mb-0">
                                </span>Health and Wellness Program
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $collectiveData['wellnessProgramCount'] }} pupils</h3>
                        </div>
                    </div>
                    <div class="col-md-3 border-end shadow mb-3 p-3">
                        <div class="p-4 py-3 py-md-4">
                            <p class="fs-4 text-dark mb-0">
                                </span>Medical Support Program
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $collectiveData['medicalProgramCount'] }} pupils</h3>
                        </div>
                    </div>
                    <div class="col-md-3 border-end shadow mb-3 p-3">
                        <div class="p-4 py-3 py-md-4">
                            <p class="fs-4 text-dark mb-0">
                                </span>Nursing Services
                            </p>
                            <h3 class=" mt-2 mb-0">{{ $collectiveData['nursingProgramCount'] }} pupils</h3>
                        </div>
                    </div>


                    
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
