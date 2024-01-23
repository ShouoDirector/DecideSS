@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        @include('admin.segments.segment_head')
        <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
            <a href="#" type="button"
                class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Manage</a>
            <button type="button" disabled
                class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">MasterList</button>
        </div>

        <div class="w-100">
            <div class="d-flex row justify-content-start">
                <div class="col-lg-5">
                    <div class="card-body w-100">
                        <div class="card">
                            @if(Request::get('schoolId') == null)
                            @include('admin.admin.forms.schools-form')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex row justify-content-start">
                <div class="col-lg-7">
                    <div class="card-body w-100">
                        <div class="card shadow-none">
                            <!-- ================================ SIDE FORM - USER ================================================ -->
                            @include('admin.admin.forms.schools-mass-import')
                        </div>
                    </div>
                </div>
                    @if(Request::get('sectionId')!= null)
                    <div class="col-lg-4">
                        <div class="card-body w-100">
                            <div class="card">
                                @include('admin.admin.forms.schools-one')
                            </div>
                        </div>
                    </div>
                    @endif
            </div>

        </div>


    </div>
    @include('admin.admin.scripts.user_table')
</div>
@endsection
