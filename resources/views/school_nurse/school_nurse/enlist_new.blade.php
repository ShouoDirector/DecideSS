@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('school_nurse.segments.segment_head')

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
        @include('school_nurse.school_nurse.component.enlist_new_form')

        @else
        <div class="alert alert-warning px-4 card-hover" role="alert">
            No school year at the moment.
        </div>
        @endif

    </div>
</div>

@endsection
