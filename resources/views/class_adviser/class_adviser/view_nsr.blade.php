@extends('layouts.full')
@section('content')

<div class="container-fluid">

    <div class="row">

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
            @if ($permitted == 1)
                @include('class_adviser.class_adviser.component.view_nsr_component')
            @else
                <div class="alert alert-warning px-4" role="alert">
                    <span class="badge bg-warning">You are not assigned nor permitted.</span>
                </div>
            @endif
        @else
        <div class="alert alert-warning px-4 card-hover" role="alert">
            No school year phase at the moment.
        </div>
        @endif
        
    </div>
</div>

@endsection
