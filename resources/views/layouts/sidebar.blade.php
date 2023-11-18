<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="index-2.php" class="text-nowrap logo-img">
                <img id="darkLogo" src="{{ asset('icons/dark-logo.svg') }}" class="dark-logo card-hover" width="180" alt="" />
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
                        <span class="hide-menu">Account List</span>
                    </a>
                </li>

                <li class="nav-small-cap mb-2">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Constants</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-archive"></i>
                        </span>
                        <span class="hide-menu">Areas</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.constants.districts') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-building-community"></i>
                                </span>
                                <span class="hide-menu">Districts</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.constants.schools') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-building-community"></i>
                                </span>
                                <span class="hide-menu">Schools</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.constants.classroom') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-door"></i>
                                </span>
                                <span class="hide-menu">Classroom</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.constants.school_year') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-calendar-plus"></i>
                        </span>
                        <span class="hide-menu">School Year</span>
                    </a>
                </li>

                <li class="nav-small-cap mb-2">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Menu</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-archive"></i>
                        </span>
                        <span class="hide-menu">Archives</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item ps-3 show">
                            <a href="{{ route('admin.archives.accounts_archive') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-corner-down-right-double fs-2"></i>
                                    <i class="ti ti-user-x fs-5 ps-2"></i>
                                </div>
                                <span class="hide-menu">Accounts</span>
                            </a>
                        </li>
                        <li class="sidebar-item ps-3">
                            <a href="{{ route('admin.archives.districts_archive') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-corner-down-right-double fs-2"></i>
                                    <i class="ti ti-building-skyscraper fs-5 ps-2"></i>
                                </div>
                                <span class="hide-menu">Districts</span>
                            </a>
                        </li>
                        <li class="sidebar-item ps-3">
                            <a href="{{ route('admin.archives.schools_archive') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-corner-down-right-double fs-2"></i>
                                    <i class="ti ti-building-skyscraper fs-5 ps-2"></i>
                                </div>
                                <span class="hide-menu">Schools</span>
                            </a>
                        </li>
                        <li class="sidebar-item ps-3">
                            <a href="{{ route('admin.archives.school_year_archive') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-corner-down-right-double fs-2"></i>
                                    <i class="ti ti-calendar-plus fs-5 ps-2"></i>
                                </div>
                                <span class="hide-menu">School Years</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.histories.admin-histories') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-history-toggle"></i>
                        </span>
                        <span class="hide-menu">Admin Logs</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.profile.settings') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Profile Settings</span>
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

                <li class="nav-small-cap mb-2">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Menu</span>
                </li>

                <li class="sidebar-item bg-transparent">
                    <a class="sidebar-link" href="{{ route('logout') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-logout"></i>
                        </span>
                        <span class="hide-menu">Logout</span>
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

                <li class="sidebar-item bg-transparent">
                    <a class="sidebar-link" href="{{ route('school_nurse.school_nurse.cnsr') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-circle"></i>
                        </span>
                        <span class="hide-menu">CNSR</span>
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

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('class_adviser.class_adviser.pupils') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-mood-kid"></i>
                        </span>
                        <span class="hide-menu">MasterList</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('class_adviser.class_adviser.nutritional_assessment') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-mood-kid"></i>
                        </span>
                        <span class="hide-menu">Nutritional Assessments</span>
                    </a>
                </li>

                @endif



                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Resources</span>
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


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
