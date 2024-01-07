@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('class_adviser.segments.segment_head')

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
                @include('class_adviser.class_adviser.component.pupil_health_profile')
            @else
        @endif

    </div>

</div>

@endsection