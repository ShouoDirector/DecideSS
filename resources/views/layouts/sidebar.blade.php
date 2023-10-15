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

                <!-- ====================================================================================== -->
                <!-- Admin Wise Menu -->
                <!-- ====================================================================================== -->
                @if(Auth::user()->user_type == 1)
                @php
                $role = 'admin';
                @endphp
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url($role.'/dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url($role.'/'.$role.'/list') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-cog"></i>
                        </span>
                        <span class="hide-menu">Admin User List</span>
                    </a>
                </li>

                <!-- ====================================================================================== -->
                <!-- Medical Officer Wise Menu -->
                <!-- ====================================================================================== -->
                @elseif(Auth::user()->user_type == 2)
                @php
                $role = 'medical_officer';
                @endphp
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url($role.'/dashboard') }}" aria-expanded="false">
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
                @php
                $role = 'school_nurse';
                @endphp
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url($role.'/dashboard') }}" aria-expanded="false">
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
                @php
                $role = 'class_adviser';
                @endphp
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ url($role.'/dashboard') }}" aria-expanded="false">
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
                    <a class="sidebar-link" href="{{ url('logout') }}" aria-expanded="false">
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
