@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">

        @include('admin.segments.segment_head')

        <!-- =========================================TABLE FILTER ====================================== -->
        @include('admin.archives.filters.archives-filter')

        <!-- ========================================= ADMIN'S USER ARCHIVES TABLE ====================================== -->
        @include('admin.archives.tables.archives-table')
    </div>

@endsection
