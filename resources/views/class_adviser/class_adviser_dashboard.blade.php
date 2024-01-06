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

        <div class="w-100 m-0 mb-5 p-4 shadow d-flex rounded gap-4">
            <div class="position-relative">
                <div class="border border-2 border-primary rounded-circle shadow">
                    <img src="{{ asset('upload/'.$role.'_images/'.$role.'.png') }}" class="rounded-circle m-1"
                        alt="user1" width="60">
                </div>
            </div>
            <div>
                <h3 class="fw-semibold">Hi, <span>{{ Auth::user()->name }}</span>
                </h3>
                <span>Cheers, and happy activities - {{ now()->format('F j Y') }}</span>
            </div>
        </div>

        @if(!empty($dataSection) && $dataSection['getData']->isNotEmpty())
            @include('class_adviser.class_adviser.widgets.accordion')
        @else
            @include('class_adviser.class_adviser.widgets.404')
        @endif


    </div>
</div>

@endsection
