@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('school_nurse.segments.segment_head')

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
            @if ($permitted == 1)
                @include('school_nurse.school_nurse.component.school-area')
            @else
                @include('school_nurse.school_nurse.widgets.404')
            @endif
        @else
        <div class="alert alert-warning px-4 card-hover" role="alert">
            No school year at the moment.
        </div>
        @endif
        
    </div>
</div>

@endsection
