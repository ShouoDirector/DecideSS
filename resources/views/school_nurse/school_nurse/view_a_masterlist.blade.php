@extends('layouts.full')
@section('content')

<div class="container-fluid">

    <div class="row">

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
                @include('school_nurse.school_nurse.component.view_masterlist_part')
        @else
        <div class="alert alert-warning px-4 card-hover" role="alert">
            No school year at the moment.
        </div>
        @endif
        
    </div>
</div>

@endsection