@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('class_adviser.segments.segment_head')

        @include('class_adviser.class_adviser.component.user_widget')

        <div class="row col-12 d-flex justify-content-end gap-2 mb-2 mt-2">
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

            <div class="col-12 shadow">
                <div class="card-body w-100">

                    <!-- Nav tabs -->

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div class="tab-pane active show" id="home2" role="tabpanel">
                            <div class="p-3">

                                <!-- =========================================TABLE FILTER - PUPILS ====================================== -->
                                @include('class_adviser.segments.filter')

                                <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="col-lg-2 fs-5 fw-semibold mb-0 d-none d-lg-block">
                                        {{ $head['headerTable1'] }}</h5>
                                    <a class="mb-0 btn-minimize px-2 cursor-pointer text-white link d-flex align-items-center"
                                        data-action="expand"><i class="ti ti-arrows-maximize fs-6"></i></a>
                                    <div class="d-flex w-100 justify-content-end gap-2">
                                        <div class="f-flex row gap-2 justify-content-end">
                                            <div class="btn-group">
                                            </div>
                                        </div>
                                        <div class="justify-content-end">
                                            <a role="button"
                                                href="{{ route('class_adviser.class_adviser.masterlist') }}"
                                                type="submit" class="btn btn-secondary" data-bs-toggle="tooltip"
                                                data-bs-placement="right" data-bs-original-title="Clear">
                                                <i class="ti ti-rotate-clockwise-2 fs-5"></i>
                                            </a>
                                        </div>

                                        <a class="btn row d-lg-none d-flex justify-content-" data-bs-toggle="offcanvas"
                                            href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                            <i class="ti ti-menu-2 fs-6"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- ========================================= MasterList TABLE ====================================== -->
                                @include('class_adviser.class_adviser.tables.masterlist-table')

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

    @endsection