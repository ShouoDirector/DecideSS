@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-12 d-flex align-items-stretch w-100">
            <div class="col-12 card card-hover bg-light-info shadow-none position-relative overflow-hidden">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">{{ $head['headerTitle'] }}</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a class="text-muted "
                                            href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item" aria-current="page">{{ $head['headerTitle'] }}</li>
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

        <div class="col-12 w-100">
            @include('_message')
        </div>

        <div class="col-lg-5 col-md-12 card position-relative overflow-hidden">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $head['headerTitle'] }}</h5>
                    <p class="card-subtitle mb-3">
                        {{ $head['headerCaption'] }}
                    </p>
                    <form class="" method="post" action="" id="userForm">
                        {{ csrf_field() }}
                        <div class="form-floating mb-3">
                            <input type="text" name="name" value="{{ old('email', $data['getRecord']->name) }}"
                                class="form-control border border-info" placeholder="Name" required />
                            <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Name</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" value="{{ old('email', $data['getRecord']->email) }}" class="form-control border border-info
                            @if($errors->has('email')) border-danger is-invalid @endif" required />
                            <label><i class="ti ti-mail me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Email address</span></label>
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                        </div>
                        <div class="mb-3">
                            <select class="form-control form-select border border-info p-3" name="user_type"
                                id="userTypeSelect">
                                <option value="" disabled>Choose Role</option>
                                <option value="2" {{ $data['getRecord']->user_type == 2 ? 'selected' : '' }}>Medical Officer
                                </option>
                                <option value="3" {{ $data['getRecord']->user_type == 3 ? 'selected' : '' }}>School Nurse
                                </option>
                                <option value="4" {{ $data['getRecord']->user_type == 4 ? 'selected' : '' }}>Class Adviser
                                </option>
                            </select>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control border border-info"
                                placeholder="Password" />
                            <label><i class="ti ti-lock me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Password</span></label>
                            {{ $head['skipPassword'] }}
                        </div>

                        <div class="d-md-flex align-items-center">
                            <div class="mt-3 mt-md-0 w-100">
                                <input type="submit" value="{{ $head['headerTitle'] }}" class="btn btn-info font-medium w-100" id="submitButton">
                            </div>
                        </div>
                    </form>

                    @include('validator/form-validator')

                </div>
            </div>
        </div>

    </div>

    @endsection
