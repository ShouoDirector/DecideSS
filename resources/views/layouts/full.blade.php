<!DOCTYPE html>
<html lang="en">

@include('layouts.head')
<body>

@include('layouts.preloader')
    
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <!-- Sidebar End -->
        <!-- Main wrapper -->
        <div class="body-wrapper m-0">
            <!-- Header Start -->
            <!-- Header End -->
            @yield('content')
            <!-- container-fluid over -->
        </div>

    </div>
    <div>
        <div class="dark-transparent sidebartoggler"></div>
        <div class="dark-transparent sidebartoggler"></div>
    </div>

    <!--  Mobile Navbar -->
    <!-- Search Bar -->
    @include('layouts.js')
    
</body>

</html>