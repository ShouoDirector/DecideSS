<!DOCTYPE html>
<html lang="en">

@include('class_adviser.includes.head')

<body>
    @include('class_adviser.includes.preloader')
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('class_adviser.includes.sidebar')
        <!-- Sidebar End -->
        <!-- Main wrapper -->
        <div class="body-wrapper">
            <!-- Header Start -->
            @include('class_adviser.includes.header')
            <!-- Header End -->
            @yield('content')
            <!-- container-fluid over -->
        </div>
        
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <div class="dark-transparent sidebartoggler"></div>
    </div>

    <!--  Mobilenavbar -->
    @include('class_adviser.includes.mobile_navbar')
    <!-- Search Bar -->
    @include('class_adviser.includes.search')
    <!-- Customizer -->
    @include('class_adviser.includes.customizer')
    <!-- Customizer -->
    @include('class_adviser.includes.js')
</body>

</html>
