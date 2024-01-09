@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('medical_officer.segments.segment_head')

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
        @include('medical_officer.medical_officer.component.schools_form')

        @else
        <div class="alert alert-warning px-4 card-hover" role="alert">
            No school year at the moment.
        </div>
        @endif

    </div>
</div>

@endsection
