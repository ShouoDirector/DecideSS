@extends('layouts.full')
@section('content')

<div class="container-fluid">

    <div class="row">

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
            @if ($permitted == 1)
                @include('class_adviser.class_adviser.component.view_masterlist_component')
            @else
                @include('class_adviser.class_adviser.widgets.404')
            @endif
        @else
        <div class="alert alert-warning px-4 card-hover" role="alert">
            No school year phase at the moment.
        </div>
        @endif
        
    </div>
</div>

@endsection