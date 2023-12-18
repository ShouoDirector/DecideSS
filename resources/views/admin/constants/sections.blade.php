@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">

        @include('admin.segments.segment_head')

        @if(empty($schoolYearId))
        <div class="alert alert-warning" role="alert">
            <span class="badge bg-danger">No School Year Phase is Active.</span>
        </div>
        @else
            
            @include('admin.constants.component.section-section')
        @endif

    </div>
</div>

@endsection
