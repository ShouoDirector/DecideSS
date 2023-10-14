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
                    <h5>Add User</h5>
                    <p class="card-subtitle mb-3">
                        You will add users?
                    </p>
                    <form class="" method="post" action="" id="userForm">
                        {{ csrf_field() }}
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control border border-info"
                                placeholder="Username" required />
                            <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Name</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control border border-info" placeholder="Email"
                                required />
                            <label><i class="ti ti-mail me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Email address</span></label>
                        </div>
                        <div class="mb-3">
                            <select class="form-control form-select border border-info p-3" name="user_type"
                                id="userTypeSelect">
                                <option value="" selected disabled>Choose Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Medical Officer</option>
                                <option value="3">School Nurse</option>
                                <option value="4">Class Adviser</option>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control border border-info"
                                placeholder="Password" required />
                            <label><i class="ti ti-lock me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Password</span></label>
                        </div>

                        <div class="d-md-flex align-items-center">
                            <div class="mt-3 mt-md-0 ms-auto">
                                <input type="submit" value="Submit" class="btn btn-info font-medium rounded-pill px-4"
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
        <div class="col-12 card position-relative overflow-hidden">
            <div class="card-body">
                <div class="mb-2">
                    <h5 class="mb-2">{{ $head['header_title'] }}</h5>
                </div>
                <p class="card-subtitle mb-3">
                    The Admin User List provides a structured overview of users with administrative privileges within
                    the system.
                    Each entry includes the user's full name, associated email address, assigned role, creation date,
                    and last update date.
                </p>
                <div class="table-responsive pb-3">
                    <table id="default_order" class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created Date</th>
                                <th>Last Update</th>
                                <th>Actions</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            <!-- start row -->
                            @foreach($getRecord as $value)
                            <tr>
                                <td> {{ $value->id }} </td>
                                <td> {{ $value->name }} </td>
                                <td> {{ $value->email }} </td>
                                <td>
                                    @if($value->user_type == 1)
                                        Admin
                                    @elseif($value->user_type == 2)
                                        Medical Officer
                                    @elseif($value->user_type == 3)
                                        School Nurse
                                    @elseif($value->user_type == 4)
                                        Class Adviser
                                    @endif
                                </td>
                                <td> {{ date('F d, Y :: h:ia', strtotime($value->created_at)) }} </td>
                                <td> {{ date('F d, Y :: h:ia', strtotime($value->updated_at)) }} </td>
                                <td>
                                    <div class="dropdown dropstart">
                                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ti ti-dots-vertical fs-6"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3" href="{{ url('admin/admin/edit/'.$value->id) }}"><i class="fs-4 ti ti-edit"></i>Edit</a>                               
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3" id="sa-confirm" href="{{ url('admin/admin/delete/'.$value->id) }}"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <!-- End row -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection
