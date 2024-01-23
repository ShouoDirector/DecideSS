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

        @if(!empty($dataSection) && $dataSection['getData']->isNotEmpty())
            @include('class_adviser.class_adviser.widgets.accordion')
        @else
            @include('class_adviser.class_adviser.widgets.404')

            <div class="d-flex justify-content-center">
            <div>
            Possible Reasons why your dashboard doesn't load up:<br>
            1. Once you are done with assessing pupils (e.g weight),<br> you can click on the "Approve" button to approve your nutritional status report
            by going to <br> Nutritional Status Records tab > Create > Review & Approve then click Approve Report button.<br>
            2. Or you are not assigned to any school and class.<br>
            </div>
            </div>
        @endif


    </div>
</div>

@endsection
