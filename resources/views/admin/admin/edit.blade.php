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
    <div class="row d-flex justify-content-center">
        <div class="col-12 d-flex align-items-stretch w-100">
            <div class="col-12 card bg-light-info shadow-none position-relative overflow-hidden">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">{{ $head['header_title'] }}</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a class="text-muted "
                                            href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item" aria-current="page">{{ $head['header_title'] }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3">
                            <div class="text-center mb-n5">
                                <img src="{{ asset('background-images/ChatBc.png')}}" alt="" class="img-fluid mb-n4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('_message')

        <div class="col-lg-5 col-md-12 card position-relative overflow-hidden">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $head['header_title'] }}</h5>
                    <p class="card-subtitle mb-3">
                        You will add users?
                    </p>
                    <form class="" method="post" action="" id="userForm">
                        {{ csrf_field() }}
                        <div class="form-floating mb-3">
                            <input type="text" name="name" value="{{ $getRecord->name }}" class="form-control border border-info"
                                placeholder="Name" required />
                            <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Name</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" value="{{ $getRecord->email }}" class="form-control border border-info"
                                required />
                            <label><i class="ti ti-mail me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Email address</span></label>
                        </div>
                        <div class="mb-3">
                            <select class="form-control form-select border border-info p-3" name="user_type" id="userTypeSelect">
                                <option value="" disabled>Choose Role</option>
                                <option value="1" {{ $getRecord->user_type == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ $getRecord->user_type == 2 ? 'selected' : '' }}>Medical Officer</option>
                                <option value="3" {{ $getRecord->user_type == 3 ? 'selected' : '' }}>School Nurse</option>
                                <option value="4" {{ $getRecord->user_type == 4 ? 'selected' : '' }}>Class Adviser</option>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control border border-info"
                                placeholder="Password" />
                            <label><i class="ti ti-lock me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Password</span></label>
                            <p class="text-danger">Skip this if you don't want to change the account's password</p>
                        </div>

                        <div class="d-md-flex align-items-center">
                            <div class="mt-3 mt-md-0 ms-auto">
                                <input type="submit" value="Update" class="btn btn-info font-medium"
                                    id="submitButton">
                            </div>
                        </div>
                    </form>

                    <script>
                        document.getElementById("userForm").onsubmit = function (event) {
                            var userType = document.getElementById("userTypeSelect").value;
                            if (userType === "") {
                                toastr.error("Please select a role before submitting the form.");
                                event.preventDefault();
                            }
                        };

                    </script>

                </div>
            </div>
        </div>

    </div>

    @endsection
