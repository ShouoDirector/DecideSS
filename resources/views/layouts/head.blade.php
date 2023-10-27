<head>
    <!--  Title -->
    <title>{{ $head['headerTitle'] ?? 'DecideSS' }} | DecideSS</title>

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

    <!-- Preloader -->
    <style>
        .preloader {
        width: 100% !important;
        height: 100% !important;
        top: 0 !important;
        position: fixed !important;
        z-index: 99999 !important;
        background: #fff !important;
    }
    </style>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Core CSS -->
    <link rel="preload" id="themeColors" href="{{ asset('dist/css/style.min.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('icons/head-icon.svg') }}" />
    <!-- Prisma CSS -->
    <link rel="stylesheet" href="{{ asset('dist/libs/prismjs/themes/prism-okaidia.min.css') }}">
    <!-- Bootstrap Bundle -->
    <link rel="stylesheet" href="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}">
    <!-- Bootstrap CSS Switch -->
    <link rel="stylesheet" href="{{ asset('dist/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('dist/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">

    <script defer src="{{ asset('dist/js/custom.js') }}"></script>

</head>
