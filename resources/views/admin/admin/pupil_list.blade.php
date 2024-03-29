@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="row">

        @include('admin.segments.segment_head')

        <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
            <a href="{{ route('admin.admin.pupils') }}" type="button"
                        class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Insert New Pupils</a>
            <a href="#" type="button"
                        class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Pupils Table</a>
        </div>

        <div class="d-flex row w-100">

            <div class="col-12">
                <div class="card-body w-100">

                    <!-- Nav tabs -->

                    <!-- Tab panes -->
                    <div class="card">
                        <div class="tab-content">

                            <div class="tab-pane active show" id="home2" role="tabpanel">
                                <div class="p-3">

                                    <!-- ========================================= TABLE FILTER - USER ====================================== -->
                                    @include('admin.segments.filter')

                                    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                                        <button type="button"
                                            class="col-lg-3 col-md-4 col-sm-6 col-12 btn d-flex gap-3 btn-light-primary d-block text-primary font-medium">
                                            {{ $head['headerTable1'] }}
                                            <span
                                                class="badge ms-auto bg-primary">{{ $data['getRecord']->total() }}</span>
                                        </button>
                                        <div class="d-flex w-100 justify-content-end gap-2">
                                            <div class="f-flex row gap-2 justify-content-end">
                                                <form action="{{ route('admin.admin.list') }}">
                                                    <input type="search" class="form-control search-chat border-dark"
                                                        id="text-srh" name="search" value="{{ Request::get('search') }}"
                                                        placeholder="Search">
                                                </form>
                                            </div>
                                            <div class="justify-content-end">
                                                <a role="button" href="{{ route('admin.admin.list') }}" type="submit"
                                                    class="btn border-dark" data-bs-toggle="tooltip"
                                                    data-bs-placement="right" data-bs-original-title="Clear">
                                                    <i class="ti ti-rotate-clockwise-2 fs-5"></i>
                                                </a>
                                            </div>

                                            <a class="btn row d-lg-none d-flex justify-content-"
                                                data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                                                aria-controls="offcanvasExample">
                                                <i class="ti ti-menu-2 fs-6"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- ========================================= Pupil TABLE ====================================== -->
                                    @include('admin.admin.tables.pupil-table')
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    @include('admin.admin.scripts.user_table')

    @endsection
