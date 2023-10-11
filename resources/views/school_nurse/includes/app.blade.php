<!DOCTYPE html>
<html lang="en">

@include('school_nurse.includes.head')

<body>
    @include('school_nurse.includes.preloader')
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('school_nurse.includes.sidebar')
        <!-- Sidebar End -->
        <!-- Main wrapper -->
        <div class="body-wrapper">
            <!-- Header Start -->
            @include('school_nurse.includes.header')
            <!-- Header End -->
            @yield('content')
            <!-- container-fluid over -->
        </div>
        
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <div class="dark-transparent sidebartoggler"></div>
    </div>

    <!--  Mobilenavbar -->
    @include('school_nurse.includes.mobile_navbar')
    <!-- Search Bar -->
    @include('school_nurse.includes.search')
    <!-- Customizer -->
    @include('school_nurse.includes.customizer')
    <!-- Customizer -->
    @include('school_nurse.includes.js')
</body>

</html>
