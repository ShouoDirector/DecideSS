@extends('layouts.app')
@section('content')
@if(Auth::user()->user_type == 1)
@php
$role = 'admin';
@endphp
@elseif(Auth::user()->user_type == 2)
@php
$role = 'medical_officer';
@endphp
@elseif(Auth::user()->user_type == 3)
@php
$role = 'school_nurse';
@endphp
@elseif(Auth::user()->user_type == 4)
@php
$role = 'class_adviser';
@endphp
@endif
<div class="container-fluid">
    <div class="row">

    <div class="col-12 w-100">
        @include('_message')
    </div>

    <div class="card col-md-12 p-2 shadow-lg rounded">
            <div class="card-body bg-light-primary text-center">
                <div class="text-white p-3 d-flex row">
                <div class="rounded-circle overflow-hidden shadow mb-2">
                    <img src="{{ asset('upload/'.$role.'_images/'.$role.'.png') }}" alt="" width="40"
                        height="40" style="display: inline;">
                </div>
                    <h5 class="fw-light">Welcome {{ Auth::user()->name }}!</h5>
                </div>
        </div>
    </div>
        

    </div>
</div>

@endsection
