<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')

<body>
    @include('admin.includes.preloader')
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('admin.includes.sidebar')
        <!-- Sidebar End -->
        <!-- Main wrapper -->
        <div class="body-wrapper"></div>
            <!-- Header Start -->
            @include('admin.includes.header')
            <!-- Header End -->
            @yield('content')
            <!-- container-fluid over -->
        </div>
        <div class="dark-transparent sidebartoggler"></div>
        <div class="dark-transparent sidebartoggler"></div>
    </div>

    <!--  Mobilenavbar -->
    @include('admin.includes.mobile_navbar')
    <!-- Search Bar -->
    @include('admin.includes.search')
    <!-- Customizer -->
    @include('admin.includes.customizer')
    <!-- Customizer -->
    @include('admin.includes.js')
</body>

</html>