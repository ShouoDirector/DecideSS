<!DOCTYPE html>
<html lang="en">

@include('layouts.pre-head')

<body>
    @include('layouts.preloader')
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="javascript:void(0)"
                                    class="text-nowrap logo-img text-center d-block mb-5 mt-5 w-100">
                                    <img src="{{ asset('icons/login-logo.svg') }}" width="180" alt="">
                                </a>

                                @include('_message')

                                <form action="{{ url('login') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-floating mb-3">
                                        <input type="email" name="email" class="form-control border border-info" placeholder="Email" required/>
                                        <label><i class="ti ti-mail me-2 fs-4 text-info"></i><span
                                                class="border-start border-info ps-3">Email address</span></label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" name="password" class="form-control border border-info" placeholder="Password" required/>
                                        <label><i class="ti ti-lock me-2 fs-4 text-info"></i><span
                                                class="border-start border-info ps-3">Password</span></label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value=""
                                                id="remember" name="remember" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remember Me
                                            </label>
                                        </div>
                                        <a class="text-primary fw-medium" href="{{ url('forgot-password') }}">Forgot
                                            Password ?</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign
                                        In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.js')

</html>
