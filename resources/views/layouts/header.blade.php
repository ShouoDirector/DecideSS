<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav quick-links d-none d-lg-flex">
            <li class="nav-item dropdown-hover d-none d-lg-block">
                <p class="nav-link m-0" id="liveDateTime">{{ now()->format('l, F j, Y g:i:s A') }}</p>
            </li>
        </ul>
        <div class="d-block d-lg-none">
            <img src="{{ asset('icons/dark-logo.svg') }}" class="dark-logo" width="50" alt="" />
            <img src="{{ asset('icons/light-logo.svg') }}" class="light-logo" width="50" alt="" />
        </div>
        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between">
                <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                    aria-controls="offcanvasWithBothOptions">
                    <i class="ti ti-align-justified fs-7"></i>
                </a>

                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex align-items-center gap-3">
                                    <h6 class="m-0 px-2">{{ Auth::user()->name }} </h6>
                                </div>

                                <div class="p-1 bg-white rounded-circle">
                                <div class="user-profile-img">
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

                                    <img src="{{ asset('upload/'.$role.'_images/'.$role.'.png') }}"
                                        class="rounded-circle" width="35" height="35" alt="" />
                                </div>
                                </div>
                            </div>

                        </a>
                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                            aria-labelledby="drop1">
                            <div class="profile-dropdown position-relative" data-simplebar>
                                <div class="py-3 px-7 pb-0">
                                    <h5 class="mb-0 fs-5 fw-semibold">Profile</h5>
                                </div>
                                <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                    <img src="{{ asset('upload/'.$role.'_images/'.$role.'.png') }}"
                                        class="rounded-circle" width="80" height="80" alt="" />
                                    <div class="ms-3" style="overflow: hidden; text-overflow: ellipsis;">
                                        <h5 class="mb-2 fs-3">{{ Auth::user()->name }}</h5>
                                        <span
                                            class="mb-1 badge bg-light-primary d-flex text-dark align-items-center gap-2 text-dark">
                                            <i class="ti ti-briefcase fs-4"></i>
                                            @php
                                            $capitalizedRole = ucfirst($role);
                                            echo $capitalizedRole;
                                            @endphp
                                        </span>

                                        <p class="mb-0 badge d-flex text-dark align-items-center gap-2">
                                            <i class="ti ti-mail fs-4"></i> {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                                <div class="message-body">
                                    <a href="{{ route($role . '.profile.settings') }}"
                                        class="py-8 px-7 mt-8 d-flex align-items-center">
                                        <span
                                            class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                            <img src="{{ asset('icons/icon-account.svg') }}" alt="" width="24"
                                                height="24">
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                                            <span class="d-block text-dark">Account Settings</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="d-grid py-4 px-7 pt-8">
                                    <a href="{{ route('logout') }}" class="btn btn-outline-primary">Log Out</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
