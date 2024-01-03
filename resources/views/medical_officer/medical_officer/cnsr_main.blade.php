@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('medical_officer.segments.segment_head')

        @if ($activeSchoolYear['getRecord']->isNotEmpty())

                @include('medical_officer.medical_officer.component.cnsr_main_component')

        @else
        <div class="alert alert-warning px-4 card-hover" role="alert">
            No active school year phase at the moment.
        </div>
        @endif
        
    </div>
</div>

@endsection