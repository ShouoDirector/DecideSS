@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('school_nurse.segments.segment_head')

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
            @if ($permitted == 1)
                @include('school_nurse.school_nurse.component.list_of_masterlists')
            @else
                <div class="alert alert-warning px-4" role="alert">
                    <span class="badge bg-warning">You are not assigned nor permitted.</span>
                </div>
            @endif
        @else
        <div class="alert alert-warning px-4 card-hover" role="alert">
            No active school year phase at the moment.
        </div>
        @endif
        
    </div>
</div>

@endsection