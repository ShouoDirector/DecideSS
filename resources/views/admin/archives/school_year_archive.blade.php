@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">

        @include('admin.segments.segment_head')

        <div class="row col-12 d-flex justify-content-end gap-2 mb-2">
            <div class="col-auto d-flex align-items-center p-0 justify-content-between">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link d-flex active py-2 px-4" data-bs-toggle="tab" href="#home2" role="tab"
                            aria-selected="true">
                            <span><i class="ti ti-map"></i></span>
                            <span class="d-none d-md-block ms-2">{{ $head['headerTitle'] }} Table</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="d-flex row w-100">

            <!-- =========================================TABLE FILTER - DISTRICT ====================================== -->
            @include('admin.segments.filter')

            <div class="col-lg-9 shadow">
            <div class="card-body w-100">
                <!-- Nav tabs -->

                <!-- Tab panes -->
                <div class="tab-content">

                    <div class="tab-pane active show" id="home2" role="tabpanel">
                        <div class="p-3">

                            <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                                <h5 class="col-lg-3 fs-5 fw-semibold mb-0 d-none d-lg-block">
                                    {{ $data['getDeletedSchoolYears']->count() }} {{ $head['headerTitle'] }}</h5>
                                <div class="d-flex w-100 justify-content-end gap-2">
                                    <div class="justify-content-end">
                                        <a role="button" href="{{ route('admin.archives.school_year_archive') }}" type="submit" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Clear">
                                            <i class="ti ti-rotate-clockwise-2 fs-4"></i>
                                        </a>
                                    </div>
                                    <a class="btn row d-lg-none d-flex justify-content-" data-bs-toggle="offcanvas"
                                        href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                        <i class="ti ti-menu-2 fs-6"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- ========================================= SCHOOL YEAR TABLE ====================================== -->
                            @include('admin.archives.tables.school-year-archives-table')

                        </div>
                    </div>

                </div>

            </div>
            </div>



        </div>


    </div>
</div>

@endsection
