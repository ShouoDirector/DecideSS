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
                            <div class="card-body pt-5">
                                <a href="#" class="text-nowrap logo-img text-center d-block mb-4">
                                    <img src="{{ asset('icons/dark-logo.svg') }}"
                                        width="180" alt="">
                                </a>
                                <div class="mb-5 text-center">
                                    <p class="mb-0 ">
                                        Reset your password.
                                    </p>
                                </div>

                                @include('_message')
                                
                                <form action="" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-floating mb-4">
                                        <input type="password" name="password" class="form-control border border-info" placeholder="Password" required/>
                                        <label><i class="ti ti-lock me-2 fs-4 text-info"></i><span
                                                class="border-start border-info ps-3">Password</span></label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" name="cpassword" class="form-control border border-info" placeholder="Password" required/>
                                        <label><i class="ti ti-lock me-2 fs-4 text-info"></i><span
                                                class="border-start border-info ps-3">Confirm Password</span></label>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-3">Reset
                                        Password</button>
                                    <a href="{{ url('/') }}"
                                        class="btn btn-light-primary text-primary w-100 py-8">Back to Login</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts/js')
</body>

</html>
