@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">

        @include('class_adviser.segments.segment_head')

        <div class="card">
            <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                        id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button"
                        role="tab" aria-controls="pills-account" aria-selected="true">
                        <i class="ti ti-user-circle me-2 fs-6"></i>
                        <span class="d-none d-md-block">Account</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button
                        class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4"
                        id="pills-notifications-tab" data-bs-toggle="pill" data-bs-target="#pills-notifications"
                        type="button" role="tab" aria-controls="pills-notifications" aria-selected="false"
                        tabindex="-1">
                        <i class="ti ti-bell me-2 fs-6"></i>
                        <span class="d-none d-md-block">Notifications</span>
                    </button>
                </li>
            </ul>
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
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-account" role="tabpanel"
                        aria-labelledby="pills-account-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-6 d-flex align-items-stretch">
                                <div class="card overflow-hidden">
                                    <div class="card-body p-0">
                                        <img src="{{ asset('dist/images/backgrounds/profilebg.jpg') }}" alt="" class="img-fluid">
                                        <div class="row align-items-center justify-content-center m-0 p-0">
                                            <div class="col-lg-4 order-lg-1 order-2">
                                                
                                            </div>
                                            <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                                                <div class="mt-n5">
                                                    <div class="d-flex align-items-center justify-content-center mb-2">
                                                        <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle"
                                                            style="width: 110px; height: 110px;" ;="">
                                                            <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden"
                                                                style="width: 100px; height: 100px;" ;="">
                                                                <img src="{{ asset('upload/'.$role.'_images/'.$role.'.png') }}" alt=""
                                                                    class="w-100 h-100">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <h5 class="fs-5 mb-0 fw-semibold">{{ Auth::user()->name }}</h5>
                                                        <p class="mb-0 fs-4">@php
                                                        $capitalizedRole = ucfirst($role);
                                                        echo $capitalizedRole;
                                                        @endphp</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 order-last text-end">
                                                <a href="#collapseTwo" class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                    Edit <i class="ti ti-edit"></i></a>
                                            </div>
                                        </div>
                                        <div class="row align-items-center justify-content-center">
                                            <div class="d-flex row justify-content-center align-items-center">
                                                <div class="my-3 text-center">
                                                    <p class="mb-1 fs-2">Phone number</p>
                                                    @if(Auth::user()->phone_number)
                                                        <h6 class="fw-semibold mb-0">{{ Auth::user()->phone_number }}</h6>
                                                    @else
                                                        <h6 class="fw-semibold mb-0">N/A</h6>
                                                    @endif
                                                </div>
                                                <div class="my-3 text-center">
                                                    <p class="mb-1 fs-2">Email address</p>
                                                    <h6 class="fw-semibold mb-0">{{ Auth::user()->email }}</h6>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-stretch">
                                <div class="card w-100 position-relative overflow-hidden">
                                    <div class="card-body p-4 shadow">
                                        <h5 class="card-title fw-semibold">Change Password</h5>
                                        <p class="card-subtitle mb-4">To change your password please confirm here</p>
                                        <form action="{{ route('class_adviser.profile.saveSettings') }}" method="post">
                                            {{ csrf_field() }}
                                            <!-- Current Password Field -->
                                            
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control border border-info" placeholder="Current Password" id="current_password" name="current_password" required>
                                                <label><i class="ti ti-lock me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">Current Password</span></label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control border border-info" placeholder="New Password" id="new_password" name="new_password" required>
                                                <label><i class="ti ti-lock me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">New Password</span></label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control border border-info" placeholder="Confirm Password" id="new_password_confirmation" name="new_password_confirmation" required>
                                                <label><i class="ti ti-lock me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">Confirm Password</span></label>
                                            </div>

                                            <!-- Submit Button -->
                                            <button type="submit" class="btn btn-primary w-100 p-2">Change Password</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseTwo" class="col-12" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="card w-100 position-relative overflow-hidden mb-0 accordion-body">
                                    <div class="card-body p-4">
                                        <h5 class="card-title fw-semibold">Personal Details</h5>
                                        <p class="card-subtitle mb-4">To change your personal detail , edit and save
                                            from here</p>
                                            <form method="post" action="{{ route('class_adviser.profile.updateDetails') }}">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control border border-info" placeholder="Name" name="name" 
                                                            value="{{ old('name', Auth::user()->name) }}" required>
                                                            <label>Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-floating mb-4">
                                                            <input type="text" class="form-control border border-info" placeholder="Phone" name="phone_number" value="{{ old('phone_number', Auth::user()->phone_number) }}">
                                                            <label>Phone Number</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="d-flex align-items-center justify-content-end mt-4 gap-3">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>

                            <div id="save">

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-notifications" role="tabpanel"
                        aria-labelledby="pills-notifications-tab" tabindex="0">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <h4 class="fw-semibold mb-3">Notification Preferences</h4>
                                        <div class="">
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div
                                                        class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                        <i class="ti ti-article text-dark d-block fs-7" width="22"
                                                            height="22"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-4 fw-semibold">[This tab is for further future developments of the system.
                                                        </h5>
                                                        <p class="mb-0">No features yet</p>
                                                    </div>
                                                </div>
                                                <div class="form-check form-switch mb-0">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="flexSwitchCheckChecked" checked disabled>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <h4 class="fw-semibold mb-3">Date &amp; Time</h4>
                                        <p>Time zones and calendar display settings.</p>
                                        <div class="d-flex align-items-center justify-content-between mt-7">
                                            <div class="d-flex align-items-center gap-3">
                                                <div
                                                    class="bg-light rounded-1 p-6 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-clock-hour-4 text-dark d-block fs-7" width="22"
                                                        height="22"></i>
                                                </div>
                                                <div>
                                                    <p class="mb-0">Time zone</p>
                                                    <h5 class="fs-4 fw-semibold">(UTC + 08:00) Manila, Philippines</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end gap-3">
                                    <button disabled class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        

    </div>
</div>

@endsection
