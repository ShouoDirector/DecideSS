@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-stretch w-100 gap-1 justify-content-between">
            <div class="col-lg-12 card card-hover bg-light-info shadow-none position-relative overflow-hidden">
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

        <div class="col-12 w-100">
            @include('_message')
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
                    <form class="" method="post" action="" id="userForm">
                        {{ csrf_field() }}
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control border border-info"
                                placeholder="Name" required />
                            <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Name</span></label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control border border-info 
                            @if($errors->has('email')) border-danger is-invalid @endif" placeholder="Email" required />
                            <label><i class="ti ti-mail me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Email address</span></label>
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                        </div>
                        <div class="mb-3">
                            <select class="form-control form-select border border-info p-3" name="user_type"
                                id="userTypeSelect">
                                <option value="0" selected disabled>Choose Role</option>
                                <option value="2">Medical Officer</option>
                                <option value="3">School Nurse</option>
                                <option value="4">Class Adviser</option>
                            </select>
                            <div id="validationMessage" class="text-danger"></div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control border border-info"
                                placeholder="Password" required />
                            <label><i class="ti ti-lock me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">Password</span></label>
                        </div>

                        <div class="d-md-flex align-items-center">
                            <div class="mt-3 mt-md-0 d-content" style="display: contents;">
                                <input type="submit" value="{{ $head['OffcanvasTitle']}}" class="btn btn-info font-medium w-100 px-4"
                                    id="submitButton">
                            </div>
                        </div>
                    </form>

                    @include('validator/form-validator')

                </div>
            </div>
        </div>

        <!-- =========================================TABLE FILTER ====================================== -->
        <div class="col-12 card position-relative overflow-hidden pb-3">
            <div class="row card-body pt-4 ps-3">
                <h5>{{ $head['FilterName'] }}</h5>
            </div>
            <div class="d-flex row card-body d-flex justify-between p-0">
                <form class="d-flex row col-12 justify-content-between" method="get"
                    action="{{ route('admin.admin.list') }}" id="userFilterForm">

                    <div class="row d-flex col-lg-9 col-12">

                        <div class="row d-flex ps-4">
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="text" class="form-control border border-info" name="name"
                                    value="{{ Request::get('name') }}" placeholder="Name">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="text" class="form-control border border-info" name="email"
                                    value="{{ Request::get('email') }}" placeholder="Email">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="date" class="form-control border border-info" name="create_date"
                                    value="{{ Request::get('create_date') }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Created Date">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="date" class="form-control border border-info" name="update_date"
                                    value="{{ Request::get('update_date') }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Last Update Date">
                            </div>
                        </div>

                        <div class="row d-flex ps-4">

                            <div class="col-auto d-flex align-items-center my-1">
                                <h6 class="mt-2">Show </h6>
                                <select class="form-control py-0" name="pagination" id="paginationSelect">
                                    <option value="5" {{ Request::get('pagination') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ (Request::get('pagination') ?? 10) == 10 ? 'selected' : '' }}>
                                        10
                                    </option>
                                    <option value="25" {{ Request::get('pagination') == 25 ? 'selected' : '' }}>25
                                    </option>
                                    <option value="50" {{ Request::get('pagination') == 50 ? 'selected' : '' }}>50
                                    </option>
                                </select>
                                <h6 class="mt-2"> rows</h6>
                            </div>

                        </div>

                        <div class="form-group row d-flex align-items-center ps-4">

                            <label class="col-form-label col-lg-2">Sort By:</label>
                            <div class="col-lg-10">
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="idSort"
                                        value="id" {{ Request::get('sort_field') == 'id' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="idSort">ID</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="nameSort"
                                        value="name" {{ Request::get('sort_field') == 'name' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="nameSort">Name</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="emailSort"
                                        value="email" {{ Request::get('sort_field') == 'email' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="emailSort">Email</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="roleSort"
                                        value="user_type"
                                        {{ Request::get('sort_field') == 'user_type' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="roleSort">Role</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="createDateSort"
                                        value="created_at"
                                        {{ Request::get('sort_field') == 'created_at' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="createDateSort">Create Date</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="updateDateSort"
                                        value="updated_at"
                                        {{ Request::get('sort_field') == 'updated_at' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="updateDateSort">Update Date</label>
                                </div>
                            </div>

                        </div>

                        <!-- Sorting Direction -->
                        <div class="form-group row d-flex align-items-center ps-4 my-3">

                            <label class="col-form-label col-lg-2">Sort Direction:</label>
                            <div class="col-lg-10">
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_direction" id="ascSort"
                                        value="asc" {{ Request::get('sort_direction') == 'asc' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="ascSort">Ascending</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_direction" id="descSort"
                                        value="desc" {{ Request::get('sort_direction') == 'desc' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="descSort">Descending</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row d-flex col-lg-3 col-12 align-items-center justify-content-end">
                        <div class="col-auto d-flex align-items-stretch p-0 gap-2">
                            <button type="submit"
                                class="justify-content-center w-100 btn mb-1 btn-rounded btn-secondary d-flex align-items-center card-hover px-5 py-2">Filter</button>
                            <a href="{{ route('admin.admin.list') }}"
                                class="justify-content-center w-100 btn mb-1 btn-rounded btn-secondary d-flex align-items-center card-hover px-5 py-2">Clear</a>
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
                        Total : {{ $data['getRecord']->total() }} rows
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
                                <th>Last Update</th>
                                <th>Actions</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            @if(count($data['getRecord']) === 0)
                            <tr>
                                <td colspan="7" class="text-center">No accounts</td>
                            </tr>
                            @else
                            <!-- start row -->
                            @foreach($data['getRecord'] as $value)
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
                                                    href="{{ route('admin.admin.edit', ['id' => $value->id]) }}">
                                                    <i class="fs-4 ti ti-edit"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3"
                                                    href="{{ route('admin.admin.delete', ['id' => $value->id]) }}">
                                                    <i class="fs-4 ti ti-trash"></i>Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            <!-- End row -->
                        </tbody>
                    </table>

                    <div class="col-12 d-flex justify-content-end">
                        {!! $data['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>

                </div>
            </div>
        </div>



    </div>

    @endsection
