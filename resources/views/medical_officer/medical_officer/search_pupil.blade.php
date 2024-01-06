@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('medical_officer.segments.segment_head')

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
                @include('medical_officer.medical_officer.component.pupil_health_profile')
            @else
        @endif

    </div>

</div>

@endsection
