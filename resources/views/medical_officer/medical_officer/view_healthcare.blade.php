@extends('layouts.full')
@section('content')

<div class="container-fluid">

    <div class="row">

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
=
                @include('medical_officer.medical_officer.component.view_a_healthcare')
=
        @else
        <div class="alert alert-warning px-4 card-hover" role="alert">
            No active school year phase at the moment.
        </div>
        @endif
        
    </div>
</div>

@endsection