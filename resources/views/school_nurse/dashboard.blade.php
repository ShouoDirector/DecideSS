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

        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100 bg-light-info overflow-hidden shadow-none">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex align-items-center mb-7">
                                <div class="rounded-circle overflow-hidden me-6">
                                    <img src="{{ asset('upload/'.$role.'_images/'.$role.'.png') }}" alt="" width="40"
                                        height="40">
                                </div>
                                <h5 class="fw-semibold mb-0 fs-5">Welcome {{ Auth::user()->name }}!</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="border-end pe-4 border-muted border-opacity-10">
                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">$2,340<i
                                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h3>
                                    <p class="mb-0 text-dark">Today’s Sales</p>
                                </div>
                                <div class="ps-4">
                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">35%<i
                                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h3>
                                    <p class="mb-0 text-dark">Overall Performance</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="welcome-bg-img mb-n7 text-end">
                                <img src="{{ asset('background-images/welcome-bg.svg') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">$10,230</h4>
                    <p class="mb-2 fs-3">Expense</p>
                    <div id="expense"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">$65,432</h4>
                    <p class="mb-1 fs-3">Sales</p>
                    <div id="sales" class="sales-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Revenue Updates</h5>
                    <p class="card-subtitle mb-4">Overview of Profit</p>
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">Footware</span>
                        </div>
                        <div>
                            <span class="round-8 bg-secondary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">Fashionware</span>
                        </div>
                    </div>
                    <div id="revenue-chart" class="revenue-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Sales Overview</h5>
                    <p class="card-subtitle mb-2">Every Month</p>
                    <div id="sales-overview" class="mb-4"></div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div
                                class="bg-light-primary rounded-2 me-8 p-8 d-flex align-items-center justify-content-center">
                                <i class="ti ti-grid-dots text-primary fs-6"></i>
                            </div>
                            <div>
                                <h6 class="fw-semibold text-dark fs-4 mb-0">$23,450</h6>
                                <p class="fs-3 mb-0 fw-normal">Profit</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div
                                class="bg-light-secondary rounded-2 me-8 p-8 d-flex align-items-center justify-content-center">
                                <i class="ti ti-grid-dots text-secondary fs-6"></i>
                            </div>
                            <div>
                                <h6 class="fw-semibold text-dark fs-4 mb-0">$23,450</h6>
                                <p class="fs-3 mb-0 fw-normal">Expance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="p-2 bg-light-primary rounded-2 d-inline-block mb-3">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-cart.svg"
                                    alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div id="sales-two" class="mb-3"></div>
                            <h4 class="mb-1 fw-semibold d-flex align-content-center">$16.5k<i
                                    class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
                            <p class="mb-0">Sales</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="p-2 bg-light-info rounded-2 d-inline-block mb-3">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-bar.svg"
                                    alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div id="growth" class="mb-3"></div>
                            <h4 class="mb-1 fw-semibold d-flex align-content-center">24%<i
                                    class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
                            <p class="mb-0">Growth</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row alig n-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fw-semibold mb-0 me-8">$6,820</h4>
                                <div class="d-flex align-items-center">
                                    <span
                                        class="me-2 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-up-left text-success"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div class="p-2 bg-light-primary rounded-2 d-inline-block">
                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-master-card-2.svg"
                                        alt="" class="img-fluid" width="24" height="24">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="monthly-earning"></div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
