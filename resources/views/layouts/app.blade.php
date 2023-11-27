<!DOCTYPE html>
<html lang="en">

@include('layouts.head')
<body>

@include('layouts.preloader')
    
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('layouts.sidebar')
        <!-- Sidebar End -->
        <!-- Main wrapper -->
        <div class="body-wrapper">
            <!-- Header Start -->
            @include('layouts.header')
            <!-- Header End -->
            @yield('content')
            <!-- container-fluid over -->
        </div>

    </div>
    
        <div class="dark-transparent sidebartoggler"></div>
        <div class="dark-transparent sidebartoggler"></div>
    </div>

    <!--  Mobile Navbar -->
    @include('layouts.mobile_navbar')
    <!-- Search Bar -->
    @include('layouts.js')
    
</body>

</html>