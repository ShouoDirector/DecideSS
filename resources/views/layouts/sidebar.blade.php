<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="text-nowrap logo-img fs-7 text-center d-flex justify-content-start">
                <img id="darkLogo" src="{{ asset('icons/dark-logo.svg') }}" class="dark-logo card-hover" width="30"
                    alt="" />
                &nbsp;&nbsp;DecideSS
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
                    <a class="sidebar-link" href="{{ route('admin.admin.user_accounts') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-user-cog"></i>
                        </span>
                        <span class="hide-menu">User Accounts List</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.admin.pupils') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-brand-asana"></i>
                        </span>
                        <span class="hide-menu">Manage Pupils</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.admin.manage_schools') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-stack-3"></i>
                        </span>
                        <span class="hide-menu">Manage Schools</span>
                    </a>
                </li>

                <li class="nav-small-cap mb-2">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Constants</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.constants.school_year') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-calendar-plus"></i>
                        </span>
                        <span class="hide-menu">School Years</span>
                    </a>
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
                            <a class="sidebar-link" href="{{ route('admin.constants.districts') }}"
                                aria-expanded="false">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-corner-down-right-double fs-5"></i>
                                </div>
                                <span class="hide-menu">Districts</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.constants.schools') }}" aria-expanded="false">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-corner-down-right-double fs-5"></i>
                                </div>
                                <span class="hide-menu">Schools</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('admin.constants.sections') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-corner-down-right-double fs-5"></i>
                                </div>
                                <span class="hide-menu">Sections</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item hidden">
                            <a class="sidebar-link has-arrow" href="#">
                                <div class="round-16 d-flex align-items-center ps-3">
                                    <i class="ti ti-building-community fs-4"></i>
                                </div>
                                <span class="hide-menu ps-3">Sections</span>
                            </a>
                            <ul class="collapse three-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.constants.manage_sections') }}" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-building-community fs-4"></i>
                                        </div>
                                        <span class="hide-menu">Manage Sections</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item hidden">
                            <a class="sidebar-link" href="{{ route('admin.constants.class_assignment') }}"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-door"></i>
                                </span>
                                <span class="hide-menu">Assign Class Adviser</span>
                            </a>
                        </li>

                <li class="nav-small-cap mb-2 hidden">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Assignment</span>
                </li>
                <li class="sidebar-item hidden">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-archive"></i>
                        </span>
                        <span class="hide-menu">Classroom</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.constants.class_assignment') }}"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-door"></i>
                                </span>
                                <span class="hide-menu">Assign Class Adviser</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('admin.constants.classroom') }}"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-door"></i>
                                </span>
                                <span class="hide-menu">Classrooms</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-small-cap mb-2">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Menu</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-trash"></i>
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
                                <span class="hide-menu">User Accounts</span>
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
                        <li class="sidebar-item ps-3 hidden">
                            <a href="{{ route('admin.archives.sections_archive') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-corner-down-right-double fs-2"></i>
                                    <i class="ti ti-building-skyscraper fs-5 ps-2"></i>
                                </div>
                                <span class="hide-menu">Sections</span>
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
                    <a class="sidebar-link" href="{{ route('admin.histories.histories') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-history-toggle"></i>
                        </span>
                        <span class="hide-menu">Logs</span>
                    </a>
                </li>

                <!-- ====================================================================================== -->
                <!-- Medical Officer Wise Menu -->
                <!-- ====================================================================================== -->
                @elseif(Auth::user()->user_type == 2)

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('medical_officer.medical_officer_dashboard') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-list"></i>
                        </span>
                        <span class="hide-menu">Reports</span>
                    </a>

                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('medical_officer.medical_officer.cnsr_main') }}"
                                aria-expanded="false">
                                <span>
                                    <i class="fs-4 ps-1 ti ti-file-star"></i>
                                </span>
                                <span class="hide-menu">School CNSRs</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link"
                                href="{{ route('medical_officer.medical_officer.consolidatedCNSRByGrade') }}"
                                aria-expanded="false">
                                <span>
                                    <i class="fs-4 ps-1 ti ti-file-star"></i>
                                </span>
                                <span class="hide-menu">District CNSR</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('medical_officer.medical_officer.healthcare') }}"
                                aria-expanded="false">
                                <span>
                                    <i class="fs-4 ps-1 ti ti-file-star"></i>
                                </span>
                                <span class="hide-menu">Healthcare Services</span>
                            </a>
                        </li>
                    </ul>

                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('medical_officer.medical_officer.schools') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-search"></i>
                        </span>
                        <span class="hide-menu">Schools</span>
                    </a>
                </li>




                <li class="nav-small-cap mb-2">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Menu</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('medical_officer.medical_officer.search_pupil') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Pupil Health Profile</span>
                    </a>
                </li>

                <!-- ====================================================================================== -->
                <!-- School Nurse Wise Menu -->
                <!-- ====================================================================================== -->
                @elseif(Auth::user()->user_type == 3)
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('school_nurse.school_nurse_dashboard') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}"
                        aria-expanded="false">
                        <span>
                            <i class="fs-5 ti ti-list-details"></i>
                        </span>
                        <span class="hide-menu">Beneficiaries</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('school_nurse.school_nurse.cnsr') }}"
                        aria-expanded="false">
                        <span>
                            <i class="fs-5 ti ti-file-like"></i>
                        </span>
                        <span class="hide-menu">Nutritional Status Report</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('school_nurse.school_nurse.health_table') }}"
                        aria-expanded="false">
                        <span>
                            <i class="fs-5 ti ti-file-like"></i>
                        </span>
                        <span class="hide-menu">Healthcare Services Report</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('school_nurse.school_nurse.past_reports') }}"
                        aria-expanded="false">
                        <span>
                            <i class="fs-5 ti ti-report"></i>
                        </span>
                        <span class="hide-menu">Past Reports</span>
                    </a>
                </li>

                <li class="sidebar-item d-none">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="d-flex">
                            <i class="ti ti-list"></i>
                        </span>
                        <span class="hide-menu">Reports</span>
                    </a>

                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item d-none">
                            <a class="sidebar-link"
                                href="{{ route('school_nurse.school_nurse.healthcare_services_report') }}"
                                aria-expanded="false">
                                <span>
                                    <i class="fs-4 ps-1 ti ti-list-check"></i>
                                </span>
                                <span class="hide-menu">HealthCare Services <br>Report</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item hidden">
                    <a class="sidebar-link" href="{{ route('school_nurse.school_nurse.referrals') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-files"></i>
                        </span>
                        <span class="hide-menu">Referrals</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('school_nurse.school_nurse.search_pupil') }}"
                        aria-expanded="false">
                        <span>
                            <i class="fs-5 ti ti-user-circle"></i>
                        </span>
                        <span class="hide-menu">Pupil Health Profile</span>
                    </a>
                </li>

                <!-- ====================================================================================== -->
                <!-- Class Adviser Wise Menu -->
                <!-- ====================================================================================== -->
                @elseif(Auth::user()->user_type == 4)
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('class_adviser.class_adviser_dashboard') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MY SECTION</span>
                </li>

                <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('class_adviser.class_adviser.masterlist') }}"
                                aria-expanded="true">
                                <span>
                                    <i class="ti ti-list fs-5"></i>
                                </span>
                                <span class="hide-menu fs-3">MasterList</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('class_adviser.class_adviser.approved_report') }}"
                                aria-expanded="true">
                                <span>
                                    <i class="ti ti-files fs-5"></i>
                                </span>
                                <span class="hide-menu fs-3">Nutritional Status Records</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('class_adviser.class_adviser.search_pupil') }}"
                                aria-expanded="true">
                                <span>
                                    <i class="ti ti-users fs-5"></i>
                                </span>
                                <span class="hide-menu fs-3">Learner's Profile</span>
                            </a>
                        </li>


                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
