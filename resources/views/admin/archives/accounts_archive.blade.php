@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-stretch w-100 gap-1 justify-content-between">
            <div class="col-12 card card-hover bg-light-info shadow-none position-relative overflow-hidden">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">{{ $head['headerTitle'] }}</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a class="text-muted "
                                            href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item" aria-current="page">{{ $head['headerTitle'] }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3">
                            <div class="text-center mb-n5">
                                <img src="{{ asset('background-images/ChatBc.png')}}" alt=""
                                    class="img-fluid mb-n4 card-hover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-12 w-100">
            @include('_message')
        </div>

        <!-- =========================================TABLE FILTER ====================================== -->
        <div class="col-12 card position-relative shadow-none">
            <div class="row card-body p-0">
                <h5>Search Account</h5>
            </div>
            <div class="card-body p-0 d-flex">
                <form class="row w-100" method="get" action="{{ route('admin.archives.accounts_archive') }}" id="userFilterForm">

                    <div class="col-lg-2 col-sm-6 col-6 my-1">
                        <input type="text" class="form-control border border-info" name="name" value="{{ Request::get('name') }}" 
                        placeholder="Name">
                    </div>
                    <div class="col-lg-2 col-sm-6 col-6 my-1">
                        <input type="text" class="form-control border border-info" name="email" value="{{ Request::get('email') }}" 
                        placeholder="Email">
                    </div>
                    <div class="col-lg-2 col-sm-6 col-6 my-1">
                        <input type="date" class="form-control border border-info" name="create_date" value="{{ Request::get('create_date') }}" 
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Created Date">
                    </div>
                    <div class="col-lg-2 col-sm-6 col-6 my-1">
                        <input type="date" class="form-control border border-info" name="update_date" value="{{ Request::get('update_date') }}" 
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Last Update Date">
                    </div>
                    <div class="col d-flex align-items-center justify-content-end">
                        <div class="d-flex align-items-center gap-2 my-1">
                            <button type="submit" class="btn btn-primary font-medium w-100 px-5 card-hover">Filter</button>
                            <a href="{{ route('admin.archives.accounts_archive') }}"
                                class="btn btn-success font-medium w-100 px-5 card-hover">Clear</a>
                        </div>
                    </div>
                    <div class="col-auto d-flex align-items-center my-1">
                            <h6>Show</h6>
                            <select class="form-control py-0" name="pagination" id="paginationSelect">
                                <option value="5" {{ Request::get('pagination') == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ Request::get('pagination') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ Request::get('pagination') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ Request::get('pagination') == 50 ? 'selected' : '' }}>50</option>
                            </select>
                            <h6>entries</h6>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Sort By:</label>
                        <div class="col-lg-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort_field" id="idSort" value="id" {{ Request::get('sort_field') == 'id' ? 'checked' : '' }}>
                                <label class="form-check-label" for="idSort">ID</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort_field" id="nameSort" value="name" {{ Request::get('sort_field') == 'name' ? 'checked' : '' }}>
                                <label class="form-check-label" for="nameSort">Name</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort_field" id="emailSort" value="email" {{ Request::get('sort_field') == 'email' ? 'checked' : '' }}>
                                <label class="form-check-label" for="emailSort">Email</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort_field" id="roleSort" value="user_type" {{ Request::get('sort_field') == 'user_type' ? 'checked' : '' }}>
                                <label class="form-check-label" for="roleSort">Role</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort_field" id="createDateSort" value="created_at" {{ Request::get('sort_field') == 'created_at' ? 'checked' : '' }}>
                                <label class="form-check-label" for="createDateSort">Create Date</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort_field" id="updateDateSort" value="updated_at" {{ Request::get('sort_field') == 'updated_at' ? 'checked' : '' }}>
                                <label class="form-check-label" for="updateDateSort">Update Date</label>
                            </div>
                        </div>
                    </div>

                    <!-- Sorting Direction -->
                    <div class="form-group row">
                        <label class="col-form-label col-lg-2">Sort Direction:</label>
                        <div class="col-lg-10">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort_direction" id="ascSort" value="asc" {{ Request::get('sort_direction') == 'asc' ? 'checked' : '' }}>
                                <label class="form-check-label" for="ascSort">Ascending</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sort_direction" id="descSort" value="desc" {{ Request::get('sort_direction') == 'desc' ? 'checked' : '' }}>
                                <label class="form-check-label" for="descSort">Descending</label>
                            </div>
                        </div>
                    </div>
                </form>

                @include('validator/form-validator')
            </div>
        </div>

        <!-- ========================================= ADMIN'S USER TABLE ====================================== -->
        <div class="col-12 card position-relative overflow-hidden">
            <div class="card-body">
                <div class="mb-2 d-flex">
                    <h5 class="mb-2">{{ $head['headerTitle'] }}</h5>
                    <p class=" ms-2 mt-1"><i class="ti ti-info-circle fs-5 card-subtitle mb-3" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-original-title="
                    The Admin User List provides a structured overview of users with administrative privileges within
                    the system.
                    Each entry includes the user's full name, associated email address, assigned role, creation date,
                    and last update date."></i></p>
                    <div class="mt-0 ms-5 fs-4 mx-4 text-dark">
                        Total : {{ $data['getDeletedUsers']->total() }}
                    </div>
                </div>

                <div class="table-responsive pb-3">
                    <table class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created Date</th>
                                <th>Deleted Date</th>
                                <th>Actions</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            <!-- start row -->
                            @foreach($data['getDeletedUsers'] as $value)
                            <tr>
                                <td> {{ $value->id }} </td>
                                <td> {{ $value->name }} </td>
                                <td> {{ $value->email }} </td>
                                <td>
                                    @if($value->user_type == 1)
                                    Admin
                                    @elseif($value->user_type == 2)
                                    Medical Officer
                                    @elseif($value->user_type == 3)
                                    School Nurse
                                    @elseif($value->user_type == 4)
                                    Class Adviser
                                    @endif
                                </td>
                                <td> {{ date('M d, Y | h:ia', strtotime($value->created_at)) }} </td>
                                <td> {{ date('M d, Y | h:ia', strtotime($value->updated_at)) }} </td>

                                <td>
                                    <div class="dropdown dropstart">
                                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ti ti-dots-vertical fs-6"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3"
                                                    href="{{ route('admin.archives.recover', ['id' => $value->id]) }}">
                                                    <i class="fs-4 ti ti-trash"></i>Recover
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <!-- End row -->
                        </tbody>
                    </table>

                    <div class="col-12 d-flex justify-content-end">
                        {!! $data['getDeletedUsers']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endsection
