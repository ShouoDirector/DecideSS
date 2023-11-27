@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('class_adviser.segments.segment_head')

        @include('class_adviser.class_adviser.component.user_widget')

        @if($permitted == 1)
            @include('class_adviser.class_adviser.component.add_pupil_to_masterlist')
        @else
            <div class="alert alert-warning" role="alert">
                <span class="badge bg-danger">You are not assigned nor permitted.</span>
            </div>
        @endif

        <div class="d-flex row w-100">

            <div class="col-12 shadow">
                <div class="card-body w-100">

                    <!-- Nav tabs -->

                </div>
            </div>

        </div>

    </div>

    @endsection
