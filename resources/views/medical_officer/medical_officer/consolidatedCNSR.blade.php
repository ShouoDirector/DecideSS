@extends('layouts.full')
@section('content')

<div class="container-fluid">

    <div class="row">

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
        <div class="card col-12 m-0 shadow-none" style="height: fit-content;">
        <div class="card-body text-white p-0">
            <div class="d-flex flex-row align-items-center justify-content-center">
                <div class="card-hover d-flex">
                    <div class="ms-3 text-center">
                    <h3 class="mb-0 text-dark fs-5 text-center">
                        CONSOLIDATED NUTRITIONAL STATUS REPORT OF {{ strtoupper($districtName[$getDistrictId]) }}
                    </h3>

                        <h4 class="mb-0 text-dark fs-6"> DISTRICT</h4>
                        <span class="text-dark">Baseline SY {{ $schoolYearPhaseName }} </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
                @include('medical_officer.medical_officer.component.consolidated_cnsr')
        @else
        <div class="alert alert-warning px-4 card-hover" role="alert">
            No active school year phase at the moment.
        </div>
        @endif
        
    </div>
</div>

@endsection