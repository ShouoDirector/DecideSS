<!-- ---------------------------------------------- -->
<!-- Import Js Files -->
<!-- ---------------------------------------------- -->
<script src="{{ asset('dist/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- ---------------------------------------------- -->
<!-- core files -->
<!-- ---------------------------------------------- -->
<script src="{{ asset('dist/js/custom.js') }}"></script>
<script src="{{ asset('dist/js/chartjs.js') }}"></script>
<script src="{{ asset('dist/js/app.min.js') }}"></script>
<script src="{{ asset('dist/js/app.init.js') }}"></script>
<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dist/libs/prismjs/prism.js') }}"></script>
<script src="{{ asset('dist/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('dist/js/forms/bootstrap-switch.js') }}"></script>

<!-- ---------------------------------------------- -->
<!-- Other js files -->
<!-- ---------------------------------------------- -->
<script src="{{ asset('dist/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<!-- ---------------------------------------------- -->
@include('layouts.user-form')
@include('layouts.pupil-form')
@include('layouts.masterlist-form')
@include('layouts.date_time')
@include('layouts.sectionchartsjs')
@include('layouts.districtchartsjs')
@include('layouts.pupil_chart_js')