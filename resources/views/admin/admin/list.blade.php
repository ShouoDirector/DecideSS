@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">

        @include('admin.segments.segment_head')

        <div class="row col-12 d-flex justify-content-end gap-2 mb-2">
            <div class="col-auto d-flex align-items-stretch p-0">
                <button type="button"
                    class="justify-content-center w-100 btn mb-1 btn-rounded btn-primary d-flex align-items-center card-hover px-4 py-2"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="ti ti-circle-plus fs-4 me-2"></i>
                    {{ $head['OffcanvasTitle']}}
                </button>
            </div>
        </div>

        <!-- ================================ SIDE FORM ================================================ -->
        <div class="offcanvas offcanvas-end d-flex align-items-center justify-content-center" tabindex="-1"
            id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header align-self-end">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="col-12 card position-relative overflow-hidden">
                <div class="card-body">
                    <h5>{{ $head['OffcanvasTitle']}}</h5>
                    <p class="card-subtitle mb-3">
                        {{ $head['OffcanvasWarning'] }}
                    </p>
                    
                    @include('admin.admin.forms.add-form')

                    @include('validator/form-validator')

                </div>
            </div>
        </div>

        <!-- =========================================TABLE FILTER ====================================== -->
        
        @include('admin.admin.filters.user-table-filter')

        <!-- ========================================= ADMIN'S USER TABLE ====================================== -->
        
        @include('admin.admin.tables.user-table')


    </div>

    @endsection
