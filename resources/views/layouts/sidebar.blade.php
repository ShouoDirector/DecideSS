<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="index-2.php" class="text-nowrap logo-img">
                <img id="darkLogo" src="{{ asset('icons/dark-logo.svg') }}" class="dark-logo card-hover" width="180" alt="" />
                <img id="lightLogo" src="{{ asset('icons/light-logo.svg') }}" class="light-logo card-hover" width="180" alt="" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>

        <!-- Sidebar navigation for Admin-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>

                <!-- ====================================================================================== -->
                <!-- Admin Wise Menu -->
                <!-- ====================================================================================== -->
                @if(Auth::user()->user_type == 1)
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.admin.list') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-cog"></i>
                        </span>
                        <span class="hide-menu">Admin User List</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.archives.accounts_archive') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-archive"></i>
                        </span>
                        <span class="hide-menu">Accounts Archive</span>
                    </a>
                </li>

                <li class="nav-small-cap mb-2">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Constants</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.constants.constants') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-building-community"></i>
                        </span>
                        <span class="hide-menu">Areas</span>
                    </a>
                </li>

                <!-- ====================================================================================== -->
                <!-- Medical Officer Wise Menu -->
                <!-- ====================================================================================== -->
                @elseif(Auth::user()->user_type == 2)
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('medical_officer.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- ====================================================================================== -->
                <!-- School Nurse Wise Menu -->
                <!-- ====================================================================================== -->
                @elseif(Auth::user()->user_type == 3)
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('school_nurse.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- ====================================================================================== -->
                <!-- Class Adviser Wise Menu -->
                <!-- ====================================================================================== -->
                @elseif(Auth::user()->user_type == 4)
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('class_adviser.dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                @endif

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Others</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false">
                        <span>
                            <i class="ti ti-help"></i>
                        </span>
                        <span class="hide-menu">FAQ</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="javascript:void(0)" aria-expanded="false">
                        <span>
                            <i class="ti ti-book"></i>
                        </span>
                        <span class="hide-menu">Documentation</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="https://bicol-u.edu.ph/" target="_blank" aria-expanded="false">
                        <span>
                            <i class="ti ti-school"></i>
                        </span>
                        <span class="hide-menu">Bicol University Official</span>
                    </a>
                </li>
                <li class="sidebar-item bg-transparent">
                    <a class="sidebar-link" href="{{ route('logout') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-logout"></i>
                        </span>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
