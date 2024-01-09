@extends('layouts.full')
@section('content')

<div class="container-fluid">

    <div class="row">

        @if ($activeSchoolYear['getRecord']->isNotEmpty())
            @if ($permitted == 1)
                @include('school_nurse.school_nurse.component.nsr_list')
            @else
                @include('school_nurse.school_nurse.widgets.404')
                <div class="d-flex justify-content-center mt-3">
                <button class="print-btn col-md-2 col-sm-4 col-6 btn btn-secondary text-white" onclick="window.location.href='{{ url()->previous() }}'">Okay</button>
                </div>
            @endif
        @else
        <div class="alert alert-warning px-4 card-hover" role="alert">
            No active school year at the moment.
        </div>
        @endif
        
    </div>
</div>

@endsection