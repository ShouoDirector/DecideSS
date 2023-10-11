<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="index-2.php" class="text-nowrap logo-img">
                <img id="darkLogo" src="{{ asset('icons/dark-logo.svg') }}"
                    class="dark-logo" width="180" alt="" />
                <img id="lightLogo" src="{{ asset('icons/light-logo.svg') }}"
                    class="light-logo" width="180" alt="" />
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

                @if(Auth::user()->user_type == 1)
                    @php
                        $role = 'admin';
                    @endphp
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
                            <span class="hide-menu">Admin List</span>
                        </a>
                    </li>
                
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

                
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>