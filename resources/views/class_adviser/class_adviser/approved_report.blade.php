@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('class_adviser.segments.segment_head')
        @include('class_adviser.class_adviser.component.user_widget')

        @if($filteredRecords->isNotEmpty() && isset($data) && $activeSchoolYear['getRecord']->isNotEmpty() && $permitted == 1)
            @if ($activeSchoolYear['getRecord']->isNotEmpty())
                @if ($permitted == 1)
                    @include('class_adviser.class_adviser.component.approved_reports')
                @else
                    <div class="alert alert-warning px-4" role="alert">
                        <span class="badge bg-warning">You are not assigned nor permitted.</span>
                    </div>
                @endif
            @else
            <div class="alert alert-warning px-4 card-hover" role="alert">
                No school year at the moment.
            </div>
            @endif
        @else
            @include('class_adviser.class_adviser.widgets.404')
        @endif
        
    </div>
</div>

@endsection
