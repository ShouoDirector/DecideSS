@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('admin.segments.segment_head')

        @if(empty($schoolYearId))
        <div class="alert alert-warning" role="alert">
            <span class="badge bg-danger">No School Year is Active.</span>
        </div>
        @else
        
        @include('admin.constants.component.classroom-section')
        @endif

    </div>
</div>

@endsection
