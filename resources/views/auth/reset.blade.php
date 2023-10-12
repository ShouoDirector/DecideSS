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
                                    <div class="mb-3">
                                        <label for="examplePassword1" class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                            aria-describedby="passwordHelp" placeholder="Password" autocomplete="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="examplePassword1" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="cpassword" id="exampleInputPassword1"
                                            aria-describedby="passwordHelp" placeholder="Password" autocomplete="">
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
