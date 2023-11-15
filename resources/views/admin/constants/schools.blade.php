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
                    <li class="nav-item" role="presentation">
                        <a class="nav-link d-flex py-2 px-4" data-bs-toggle="tab" href="#profile2" role="tab"
                            aria-selected="false" tabindex="-1">
                            <span><i class="ti ti-map-pin-plus"></i></span>
                            <span class="d-none d-md-block ms-2">{{ $head['headerTitle1'] }}</span>
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
                                <h5 class="col-lg-2 fs-5 fw-semibold mb-0 d-none d-lg-block">
                                    {{ $dataSchoolRecords['getList']->count() }} {{ $head['headerTitle'] }}</h5>
                                <div class="d-flex w-100 justify-content-end gap-2">
                                    <div class="f-flex row gap-2 justify-content-end">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle py-2 ps-5 pe-5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Search
                                            </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li class="max-content p-1"><form action="{{ route('admin.constants.schools') }}">
                                                        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                                                            name="school" value="{{ Request::get('school') }}"
                                                            placeholder="Search School">
                                                    </form></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li class="max-content p-1"><form action="{{ route('admin.constants.schools') }}">
                                                            <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                                                                name="school_nurse_id"
                                                                value="{{ Request::get('school_nurse_id') }}"
                                                                placeholder="Search School Nurse">
                                                        </form></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li class="max-content p-1"><form action="{{ route('admin.constants.schools') }}">
                                                        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                                                        name="school_id" value="{{ Request::get('school_id') }}" 
                                                        placeholder="Search School ID">
                                                    </form></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li class="max-content p-1"><form action="{{ route('admin.constants.schools') }}">
                                                            <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                                                            name="address_barangay" value="{{ Request::get('address_barangay') }}" 
                                                            placeholder="Search Barangay">
                                                        </form></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li class="max-content p-1"><form action="{{ route('admin.constants.schools') }}">
                                                            <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh"
                                                            name="district_id" value="{{ Request::get('district_id') }}" 
                                                            placeholder="Search District">
                                                        </form></li>
                                                </ul>
                                        </div>
                                    </div>
                                    <div class="justify-content-end">
                                        <a role="button" href="{{ route('admin.constants.schools') }}" type="submit" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Clear">
                                            <i class="ti ti-rotate-clockwise-2 fs-5"></i>
                                        </a>
                                    </div>
                                    <a class="btn row d-lg-none d-flex justify-content-" data-bs-toggle="offcanvas"
                                        href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                        <i class="ti ti-menu-2 fs-6"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- ========================================= DISTRICT TABLE ====================================== -->
                            @include('admin.constants.tables.school-table')

                        </div>
                    </div>
                    <div class="tab-pane p-3" id="profile2" role="tabpanel">
                    
                        <!-- ================================ SIDE FORM - DISTRICT ================================================ -->
                        @include('admin.constants.forms.school-form')


                    </div>

                </div>

            </div>
            </div>



        </div>


    </div>
</div>

@endsection
