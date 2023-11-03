@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        
        @include('school_nurse.segments.segment_head')

        <div class="col-lg-5 col-md-12 card position-relative overflow-hidden">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $head['headerTitle'] }}</h5>
                    <p class="card-subtitle mb-3">
                        {{ $head['headerCaption'] }}
                    </p>
                    
                    @include('school_nurse.school_nurse.forms.classroom-edit-form')

                    @include('validator/form-validator')

                </div>
            </div>
        </div>

    </div>

@endsection