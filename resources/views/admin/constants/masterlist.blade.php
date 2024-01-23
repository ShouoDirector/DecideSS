@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">

        @include('admin.segments.segment_head')

        <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
            <a href="{{ route('admin.admin.manage_schools') }}" type="button"
                        class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Manage</a>
            <a href="#" type="button"
                        class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">MasterList</a>
        </div>

        @php
            $schoolId = Request::get('schoolId');
            $districtId = Request::get('districtId');
            $sectionId = Request::get('sectionId');
            $classId = Request::get('classId');
        @endphp

        <div class="d-flex row justify-content-center w-100">
            <div class="col-lg-5">
                <div class="card-body w-100">
                    <div class="card">
                        @include('admin.constants.forms.masterlist-one')
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card-body w-100">
                    <div class="card shadow-none">
                        <!-- ================================ SIDE FORM - USER ================================================ -->
                        @include('admin.constants.forms.masterlist-mass-import')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
