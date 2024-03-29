@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        @include('admin.segments.segment_head')
        <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
            <a href="#" type="button"
                class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Insert New
                Users</a>
            <a href="{{ route('admin.admin.list') }}" type="button"
                class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Users
                Table</a>
        </div>
        <div class="d-flex row justify-content-center w-100">
            <div class="col-lg-4">
                <div class="card-body w-100">
                    <div class="card">
                        @include('admin.admin.forms.user-form')
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card-body w-100">
                    <div class="card shadow-none">
                        <!-- ================================ SIDE FORM - USER ================================================ -->
                        @include('admin.admin.forms.user-mass-import')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.admin.scripts.user_table')
</div>
@endsection
