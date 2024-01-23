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

        <div class="w-100 m-0 mb-2 p-4 shadow d-flex rounded gap-4 border-2 border-primary">
            <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle">
                <div class="border border-2 border-primary rounded-circle shadow">
                    <img src="{{ asset('upload/'.$role.'_images/'.$role.'.png') }}" class="rounded-circle m-1"
                        alt="user1" width="60">
                </div>
            </div>
            <div class="d-flex row">
                <h4 class="m-0 align-items-end d-flex">Hi,&nbsp;<span> {{ Auth::user()->name }}</span>
                </h4>
                <span>Cheers, and happy activities XD</span>
            </div>
        </div>

        @include('school_nurse.school_nurse.widgets.accords')


    </div>
</div>

@endsection
