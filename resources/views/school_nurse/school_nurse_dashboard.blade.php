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

        @include('school_nurse.school_nurse.widgets.accords')

        @include('school_nurse.school_nurse.widgets.bmi-hfa-widgets')

        <div class="card shadow">
            <div class="card-body px-0">
                <div class="row pb-4 d-flex justify-content-center">
                    <p style="font-style: italic;">*Percentages on graphs are relative to the total number of pupils</p>
                    <div class="d-flex row col-12 justify-content-center gap-4">
                        <div class="col-lg-4 d-flex row justify-content-center">
                            <div class="w-100 mb-2 p-4 shadow d-flex justify-content-center rounded">
                                <canvas id="myPieChartSectionTotalBMI"></canvas>
                            </div>
                            <div class="w-100 mt-2 p-4 shadow d-flex justify-content-center rounded">
                                <canvas id="myPieChartSectionOverallHFA"></canvas>
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
                                        <select class="form-select" id="myChartSectionGeneralBMIChartTypeSelector">
                                            <option value="bar">Bar Graph</option>
                                            <option value="line">Line Graph</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-4 flex-grow-1">
                                    <canvas id="myChartSectionGeneralBMI"
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
                                    <canvas id="myChartSectionGeneralHFA"
                                        style="max-width: 100%; height: 280px;"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>

            <div class="border-top">
                <div class="row gx-0 justify-content-center d-flex mb-3">
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
                                </span>Immunization/Vaccination Program
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
