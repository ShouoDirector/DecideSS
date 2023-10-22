@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">

        @include('admin.segments.segment_head')

        <div class="row col-12 d-flex justify-content-end gap-2 mb-2">
            <div class="col-auto d-flex align-items-stretch p-0">
                <button type="button"
                    class="justify-content-center w-100 btn mb-1 btn-rounded btn-primary d-flex align-items-center card-hover px-4 py-2"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="ti ti-circle-plus fs-4 me-2"></i>
                    {{ $head['headerTitle1'] }}
                </button>
            </div>
            <div class="col-auto d-flex align-items-stretch p-0">
                <button type="button"
                    class="justify-content-center w-100 btn mb-1 btn-rounded btn-primary d-flex align-items-center card-hover px-4 py-2"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight2" aria-controls="offcanvasRight">
                    <i class="ti ti-circle-plus fs-4 me-2"></i>
                    {{ $head['headerTitle2'] }}
                </button>
            </div>
        </div>

        <!-- ================================ SIDE FORM - DISTRICT ================================================ -->
        @include('admin.constants.forms.district')

        <!-- ================================ SIDE FORM - SCHOOL ================================================ -->
        @include('admin.constants.forms.school')

        <!-- =========================================TABLE FILTER - DISTRICT ====================================== -->
        @include('admin.constants.filters.district')

        <!-- ========================================= DISTRICT TABLE ====================================== -->
        @include('admin.constants.tables.district')

        <!-- =========================================TABLE FILTER - SCHOOL ====================================== -->
        @include('admin.constants.filters.school')

        <!-- ========================================= SCHOOL TABLE ====================================== -->
        @include('admin.constants.tables.school')

    </div>
</div>

@endsection
