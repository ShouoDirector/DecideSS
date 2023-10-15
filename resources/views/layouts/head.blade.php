<head>
    <!--  Title -->
    <title>{{ $head['header_title'] }} | DecideSS
    </title>

    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="DecideSS" />
    <meta name="author" content="" />
    <meta name="keywords" content="DecideSS" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- CORE COMPONENTS-->
    <!-- =================================================== -->

    <!-- Core Css, System Always Prioritized This First Among Others -->
    <link rel="preload" id="themeColors" href="{{ asset('dist/css/style.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('icons/head-icon.svg') }}" />
    <!-- Prisma CSS -->
    <link rel="stylesheet" href="{{ asset('dist/libs/prismjs/themes/prism-okaidia.min.css') }}">
    <!-- Bootstrap CSS Switch -->
    <link rel="stylesheet"
        href="{{ asset('dist/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('dist/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <!-- DataTables-->
    <link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <!-- Sweet Alert-->
    <link rel="stylesheet" href="{{ asset('dist/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>
