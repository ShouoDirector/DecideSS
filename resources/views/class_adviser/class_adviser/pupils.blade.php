@extends('layouts.app')
@section('content')

<div class="container-fluid">
    
    <div class="row">

        @include('class_adviser.segments.segment_head')

        @include('class_adviser.class_adviser.component.user_widget')

        @if($permitted == 1)
            @include('class_adviser.class_adviser.component.pupil')
        @else
            <div class="alert alert-warning" role="alert">
                <span class="badge bg-danger">You are not assigned nor permitted.</span>
            </div>
        @endif
        
    </div>

    @endsection
