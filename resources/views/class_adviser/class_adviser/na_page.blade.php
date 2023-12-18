@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">

        @include('class_adviser.segments.segment_head')

        <div class="col-12 col-md-12 card position-relative overflow-hidden">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $head['headerTitle'] }}</h5>
                    <p class="card-subtitle mb-3">
                        {{ $head['headerCaption'] }}
                    </p>

                    @include('class_adviser.class_adviser.forms.na-page-form')

                    @include('validator/form-validator')

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
