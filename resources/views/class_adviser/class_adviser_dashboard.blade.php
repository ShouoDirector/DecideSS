@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">

    <div class="col-12 w-100">
        @include('_message')
    </div>

        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100 bg-light-info overflow-hidden shadow-none">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex align-items-center mb-7">
                                <div class="rounded-circle overflow-hidden me-6">
                                    <img src="{{ asset('upload/class_adviser_images/class_adviser.png') }}" alt="" width="40"
                                        height="40">
                                </div>
                                <h5 class="fw-semibold mb-0 fs-5">Welcome!</h5>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="welcome-bg-img mb-n7 text-end">
                                <img src="{{ asset('background-images/welcome-bg.svg') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex row bg-primary text-white text-center m-0 p-3 mt-5 mb-5">
            Overall BMI DATA
        </div>

        <div class="d-flex row col-lg-6 col-12 p-3">
            <canvas id="myLineChartSectionTotalGenderBMI"></canvas>
        </div>

        <div class="d-flex row bg-primary text-white text-center m-0 p-3 mt-5 mb-5">
            Overall BMI DATA BY TOTAL PUPILS
        </div>
        @php
            $dataArray = json_decode($dataSectionAttribute, true);
            
            $no_of_severely_wasted = isset($dataArray['no_of_severely_wasted']) ? $dataArray['no_of_severely_wasted'] : null;
            $no_of_wasted = isset($dataArray['no_of_wasted']) ? $dataArray['no_of_wasted'] : null;
            $no_of_weight_normal = isset($dataArray['no_of_weight_normal']) ? $dataArray['no_of_weight_normal'] : null;
            $no_of_overweight = isset($dataArray['no_of_overweight']) ? $dataArray['no_of_overweight'] : null;
            $no_of_obese = isset($dataArray['no_of_obese']) ? $dataArray['no_of_obese'] : null;
        @endphp
        <div class="d-flex row justify-content-between">
            <div class="d-flex row col-lg-4 col-12 p-3">
                <canvas id="myPieChartSectionTotalBMI"></canvas>
                <h6 class="text-center">Body Mass Index by Total Pupils {{ $totalPupils[0] }}</h6>
                <h6 class="text-center">Severely Wasted Pupils {{ $no_of_severely_wasted }}</h6>
                <h6 class="text-center">Wasted Pupils {{ $no_of_wasted }}</h6>
                <h6 class="text-center">Normal Weight Pupils {{ $no_of_weight_normal }}</h6>
                <h6 class="text-center">Overweight Pupils {{ $no_of_overweight }}</h6>
                <h6 class="text-center">Obese Pupils {{ $no_of_obese }}</h6>
            </div>
            <div class="d-flex row col-lg-7 col-12 p-3">
                <canvas id="myBarChartSectionTotalBMI"></canvas>
                <canvas id="myLineChartSectionTotalBMI"></canvas>
            </div>
        </div>

        <div class="d-flex row bg-primary text-white text-center m-0 p-3 mt-5 mb-5">
            Overall HFA DATA BY TOTAL PUPILS
        </div>
        @php
            $dataArray = json_decode($dataSectionAttribute, true);
            
            $no_of_severely_stunted = isset($dataArray['no_of_severely_stunted']) ? $dataArray['no_of_severely_stunted'] : null;
            $no_of_stunted = isset($dataArray['no_of_stunted']) ? $dataArray['no_of_stunted'] : null;
            $no_of_height_normal = isset($dataArray['no_of_height_normal']) ? $dataArray['no_of_height_normal'] : null;
            $no_of_tall = isset($dataArray['no_of_tall']) ? $dataArray['no_of_tall'] : null;
        @endphp
        <div class="d-flex row justify-content-between">
            <div class="d-flex row col-lg-5 col-12 p-3">
                <canvas id="myPieChartSectionTotalHFA"></canvas>
                <h6 class="text-center">Body Mass Index by Total Pupils {{ $totalPupils[0] }}</h6>
                <h6 class="text-center">Severely Wasted Pupils {{ $no_of_severely_stunted }}</h6>
                <h6 class="text-center">Wasted Pupils {{ $no_of_stunted }}</h6>
                <h6 class="text-center">Normal Weight Pupils {{ $no_of_height_normal }}</h6>
                <h6 class="text-center">Overweight Pupils {{ $no_of_tall }}</h6>
            </div>
            <div class="d-flex row col-lg-7 col-12 p-3">
                <canvas id="myBarChartSectionTotalHFA"></canvas>
                <canvas id="myLineChartSectionTotalHFA"></canvas>
            </div>
        </div>

        <div class="d-flex row bg-primary text-white text-center m-0 p-3 mt-5">
            Overall BMI DATA BY GENDER
        </div>

        <div class="d-flex row col-lg-6 col-12 p-3">
            <canvas id="myLineChartSectionTotalGenderBMI"></canvas>
        </div>

        <div class="d-flex row col-lg-6 col-12 p-3">
            <canvas id="myBarChartSectionTotalGenderBMI"></canvas>
        </div>

    </div>
</div>

@endsection
