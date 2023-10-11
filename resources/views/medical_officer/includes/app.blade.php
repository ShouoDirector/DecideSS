<!DOCTYPE html>
<html lang="en">

@include('medical_officer.includes.head')

<body>
    @include('medical_officer.includes.preloader')
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('medical_officer.includes.sidebar')
        <!-- Sidebar End -->
        <!-- Main wrapper -->
        <div class="body-wrapper">
            <!-- Header Start -->
            @include('medical_officer.includes.header')
            <!-- Header End -->
            @yield('content')
            <!-- container-fluid over -->
        </div>
        
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <div class="dark-transparent sidebartoggler"></div>
    </div>

    <!--  Mobilenavbar -->
    @include('medical_officer.includes.mobile_navbar')
    <!-- Search Bar -->
    @include('medical_officer.includes.search')
    <!-- Customizer -->
    @include('medical_officer.includes.customizer')
    <!-- Customizer -->
    @include('medical_officer.includes.js')
</body>

</html>
