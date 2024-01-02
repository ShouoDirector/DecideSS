@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('school_nurse.segments.segment_head')

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
                @include('school_nurse.school_nurse.component.pupil_health_profile')
            @else
        @endif

    </div>

</div>

@endsection
