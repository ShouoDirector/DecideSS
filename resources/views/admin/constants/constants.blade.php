@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row d-flex justify-content-center">

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

        <div class="row col-12 d-flex justify-content-end gap-2 mb-2">
            <div class="col-auto d-flex align-items-stretch p-0">
                <button type="button"
                    class="justify-content-center w-100 btn mb-1 btn-rounded btn-primary d-flex align-items-center card-hover px-4 py-2"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="ti ti-circle-plus fs-4 me-2"></i>
                    Add District
                </button>
            </div>
            <div class="col-auto d-flex align-items-stretch p-0">
                <button type="button"
                    class="justify-content-center w-100 btn mb-1 btn-rounded btn-primary d-flex align-items-center card-hover px-4 py-2"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight2" aria-controls="offcanvasRight">
                    <i class="ti ti-circle-plus fs-4 me-2"></i>
                    Add School
                </button>
            </div>
        </div>

        <div class="col-12 w-100">
            @include('_message')
        </div>

        <!-- ================================ SIDE FORM - DISTRICT ================================================ -->
        <div class="offcanvas offcanvas-end d-flex align-items-center justify-content-center" tabindex="-1"
            id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header align-self-end">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="col-12 card position-relative overflow-hidden">
                <div class="card-body">
                    <h5>{{ $head['headerTitle1'] }}</h5>
                    <p class="card-subtitle mb-3 mt-3">
                    Warning: You are about to add a district. Please ensure that you understand the implications of this action, 
                    as it may affect existing data and overall statistics. Confirm only if you are certain about your decision.
                    </p>
                    <form class="" method="post" action="" id="userForm">
                        {{ csrf_field() }}
                        <div class="form-floating mb-3">
                            <input type="text" name="district" class="form-control border border-info"
                                placeholder="Username" required />
                            <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">District</span></label>
                        </div>
                        <div class="mb-3">
                        <select class="form-control form-select border border-info p-3 select2" name="medical_officer_email" id="userTypeSelect">
                            <option value="#" selected disabled>Assign Medical Officer</option>
                            @if(isset($dataMedicalOfficer['getList']) && !empty($dataMedicalOfficer['getList']))
                                @foreach($dataMedicalOfficer['getList'] as $medicalOfficer)
                                    <option value="{{ $medicalOfficer->email }}">{{ $medicalOfficer->email }}</option>
                                @endforeach
                            @else
                                <option value="#" disabled>No Medical Officers available</option>
                            @endif
                        </select>

                            <div id="validationMessage" class="text-danger"></div>
                        </div>

                        <div class="d-md-flex align-items-center">
                            <div class="mt-3 mt-md-0 d-content" style="display: contents;">
                                <input type="submit" value="Submit" class="btn btn-info font-medium w-100 px-4"
                                    id="submitButton">
                            </div>
                        </div>
                    </form>

                    @include('validator/form-validator')

                </div>
            </div>
        </div>

        <!-- ================================ SIDE FORM - SCHOOL ================================================ -->
        <div class="offcanvas offcanvas-end d-flex align-items-center justify-content-center" tabindex="-1"
            id="offcanvasRight2" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header align-self-end">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="col-12 card position-relative overflow-hidden">
                <div class="card-body">
                    <h5>{{ $head['headerTitle2'] }}</h5>
                    <p class="card-subtitle mb-3 mt-3">
                    Warning: You are about to add a school. Please ensure that you understand the implications of this action, 
                    as it may affect existing data and overall statistics. Confirm only if you are certain about your decision.
                    </p>
                    <form class="" method="post" action="" id="userForm">
                        {{ csrf_field() }}
                        <div class="form-floating mb-3">
                            <input type="text" name="district" class="form-control border border-info"
                                placeholder="School Name" required />
                            <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                                    class="border-start border-info ps-3">School</span></label>
                        </div>
                        <div class="mb-3">
                            <select class="form-control form-select border border-info p-3 select2" name="medical_officer_email" id="userTypeSelect">
                                <option value="#" selected disabled>Select District It Belongs</option>
                                @if(isset($dataDistrict['getList']) && !empty($dataDistrict['getList']))
                                    @foreach($dataDistrict['getList'] as $district)
                                        <option value="{{ $district->district }}">{{ $district->district }}</option>
                                    @endforeach
                                @else
                                    <option value="#" disabled>No District available</option>
                                @endif
                            </select>

                            <div id="validationMessage" class="text-danger"></div>
                        </div>
                        <div class="mb-3">
                            <select class="form-control form-select border border-info p-3 select2" name="medical_officer_email" id="userTypeSelect">
                                <option value="#" selected disabled>Assign School Nurse</option>
                                @if(isset($dataSchoolNurse['getList']) && !empty($dataSchoolNurse['getList']))
                                    @foreach($dataSchoolNurse['getList'] as $schoolnurse)
                                        <option value="{{ $schoolnurse->email }}">{{ $schoolnurse->email }}</option>
                                    @endforeach
                                @else
                                    <option value="#" disabled>No School Nurse available</option>
                                @endif
                            </select>

                            <div id="validationMessage" class="text-danger"></div>
                        </div>

                        <div class="d-md-flex align-items-center">
                            <div class="mt-3 mt-md-0 d-content" style="display: contents;">
                                <input type="submit" value="Submit" class="btn btn-info font-medium w-100 px-4"
                                    id="submitButton">
                            </div>
                        </div>
                    </form>

                    @include('validator/form-validator')

                </div>
            </div>
        </div>

        <!-- =========================================TABLE FILTER - DISTRICT ====================================== -->
        <div class="col-12 card position-relative overflow-hidden pb-3">
            <div class="row card-body pt-4 ps-3">
                <h5>Filter District</h5>
            </div>
            <div class="d-flex row card-body d-flex justify-between p-0">
                <form class="d-flex row col-12 justify-content-between" method="get" action="{{ route('admin.constants.constants') }}" id="userFilterForm">

                    <div class="row d-flex col-lg-9 col-12">

                        <div class="row d-flex ps-4">
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="text" class="form-control border border-info" name="district"
                                    value="{{ Request::get('district') }}" placeholder="District Name">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="text" class="form-control border border-info" name="medical_officer_email"
                                    value="{{ Request::get('medical_officer_email') }}" placeholder="Medical Officer Email">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="date" class="form-control border border-info" name="create_date"
                                    value="{{ Request::get('create_date') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="Created Date">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="date" class="form-control border border-info" name="update_date"
                                    value="{{ Request::get('update_date') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="Last Update Date">
                            </div>
                        </div>
                        
                        <div class="row d-flex ps-4">

                            <div class="col-auto d-flex align-items-center my-1">
                                <h6 class="mt-2">Show </h6>
                                <select class="form-control py-0" name="pagination" id="paginationSelect">
                                    <option value="5" {{ Request::get('pagination') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ (Request::get('pagination') ?? 10) == 10 ? 'selected' : '' }}>10
                                    </option>
                                    <option value="25" {{ Request::get('pagination') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ Request::get('pagination') == 50 ? 'selected' : '' }}>50</option>
                                </select>
                                <h6 class="mt-2"> rows</h6>
                            </div>

                        </div>

                        <div class="form-group row d-flex align-items-center ps-4">

                            <label class="col-form-label col-lg-2">Sort By:</label>
                            <div class="col-lg-10">
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="idSort" value="id"
                                        {{ Request::get('sort_field') == 'id' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="idSort">ID</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="nameSort"
                                        value="district" {{ Request::get('sort_field') == 'district' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="nameSort">District Name</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="emailSort"
                                        value="medical_officer_email" {{ Request::get('sort_field') == 'medical_officer_email' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="emailSort">Medical Officer Email</label>
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
                            <a href="{{ route('admin.constants.constants') }}"
                                class="justify-content-center w-100 btn mb-1 btn-rounded btn-secondary d-flex align-items-center card-hover px-5 py-2">Clear</a>
                        </div>
                    </div>

                </form>

                @include('validator/form-validator')
            </div>

        </div>

        <!-- ========================================= DISTRICT TABLE ====================================== -->
        <div class="col-12 card position-relative overflow-hidden">
            <div class="card-body">
                <div class="mb-2 d-flex">
                    <h5 class="mb-2">Districts</h5>
                    <p class=" ms-2 mt-1"><i class="ti ti-info-circle fs-5 card-subtitle mb-3" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-original-title="
                    The Admin User List provides a structured overview of users with administrative privileges within
                    the system.
                    Each entry includes the user's full name, associated email address, assigned role, creation date,
                    and last update date."></i></p>
                    <div class="mt-0 ms-5 fs-4 mx-4 text-dark">
                        Total : {{ $dataDistrictModel_MedicalOfficer['getList']->total() }}
                    </div>
                </div>

                <div class="table-responsive pb-3">
                    <table class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th>ID</th>
                                <th>District</th>
                                <th>Medical Officer Email</th>
                                <th>Created Date</th>
                                <th>Last Update</th>
                                <th>Actions</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            <!-- start row -->
                            @foreach($dataDistrictModel_MedicalOfficer['getList'] as $value)
                            <tr>
                                <td> {{ $value->id }} </td>
                                <td> {{ $value->district }} </td>
                                <td> {{ $value->medical_officer_email }} </td>
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
                            <!-- End row -->
                        </tbody>
                    </table>

                    <div class="col-12 d-flex justify-content-end">
                        {!! $dataDistrictModel_MedicalOfficer['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>

                </div>
            </div>
        </div>


        <!-- =========================================TABLE FILTER - SCHOOL ====================================== -->
        <div class="col-12 card position-relative overflow-hidden pb-3">
            <div class="row card-body pt-4 ps-3">
                <h5>Filter School</h5>
            </div>
            <div class="d-flex row card-body d-flex justify-between p-0">
                <form class="d-flex row col-12 justify-content-between" method="get" action="{{ route('admin.constants.constants') }}" id="userFilterForm">

                    <div class="row d-flex col-lg-9 col-12">

                        <div class="row d-flex ps-4">
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="text" class="form-control border border-info" name="school"
                                    value="{{ Request::get('school') }}" placeholder="School Name">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="text" class="form-control border border-info" name="school_nurse_email"
                                    value="{{ Request::get('school_nurse_email') }}" placeholder="School Nurse Email">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="text" class="form-control border border-info" name="address_barangay"
                                    value="{{ Request::get('address_barangay') }}" placeholder="Barangay">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="text" class="form-control border border-info" name="district"
                                    value="{{ Request::get('district') }}" placeholder="District">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="date" class="form-control border border-info" name="create_date"
                                    value="{{ Request::get('create_date') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="Created Date">
                            </div>
                            <div class="col-lg-3 col-sm-6 col-6 my-1">
                                <input type="date" class="form-control border border-info" name="update_date"
                                    value="{{ Request::get('update_date') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="Last Update Date">
                            </div>
                        </div>
                        
                        <div class="row d-flex ps-4">

                            <div class="col-auto d-flex align-items-center my-1">
                                <h6 class="mt-2">Show </h6>
                                <select class="form-control py-0" name="pagination" id="paginationSelect">
                                    <option value="5" {{ Request::get('pagination') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ (Request::get('pagination') ?? 10) == 10 ? 'selected' : '' }}>10
                                    </option>
                                    <option value="25" {{ Request::get('pagination') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ Request::get('pagination') == 50 ? 'selected' : '' }}>50</option>
                                </select>
                                <h6 class="mt-2"> rows</h6>
                            </div>

                        </div>

                        <div class="form-group row d-flex align-items-center ps-4">

                            <label class="col-form-label col-lg-2">Sort By:</label>
                            <div class="col-lg-10">
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="idSort" value="id"
                                        {{ Request::get('sort_field') == 'id' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="idSort">ID</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="nameSort"
                                        value="school" {{ Request::get('sort_field') == 'school' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="nameSort">School Name</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="emailSort"
                                        value="school_nurse_email" {{ Request::get('sort_field') == 'school_nurse_email' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="emailSort">School Nurse Email</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="nameSort"
                                        value="address_barangay" {{ Request::get('sort_field') == 'address_barangay' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="nameSort">Barangay</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="sort_field" id="nameSort"
                                        value="district" {{ Request::get('sort_field') == 'district' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="nameSort">District</label>
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
                            <a href="{{ route('admin.constants.constants') }}"
                                class="justify-content-center w-100 btn mb-1 btn-rounded btn-secondary d-flex align-items-center card-hover px-5 py-2">Clear</a>
                        </div>
                    </div>

                </form>

                @include('validator/form-validator')
            </div>

        </div>

        <!-- ========================================= SCHOOL TABLE ====================================== -->
        <div class="col-12 card position-relative overflow-hidden">
            <div class="card-body">
                <div class="mb-2 d-flex">
                    <h5 class="mb-2">Schools</h5>
                    <p class=" ms-2 mt-1"><i class="ti ti-info-circle fs-5 card-subtitle mb-3" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-original-title="
                    The Admin User List provides a structured overview of users with administrative privileges within
                    the system.
                    Each entry includes the user's full name, associated email address, assigned role, creation date,
                    and last update date."></i></p>
                    <div class="mt-0 ms-5 fs-4 mx-4 text-dark">
                        Total : {{ $dataSchoolModel_SchoolNurse['getList']->total() }}
                    </div>
                </div>

                <div class="table-responsive pb-3">
                    <table class="table border table-striped table-bordered text-nowrap">
                        <thead>
                            <!-- start row -->
                            <tr>
                                <th>ID</th>
                                <th>School</th>
                                <th>School Nurse Email</th>
                                <th>Barangay</th>
                                <th>District</th>
                                <th>Created Date</th>
                                <th>Last Update</th>
                                <th>Actions</th>
                            </tr>
                            <!-- end row -->
                        </thead>
                        <tbody>
                            <!-- start row -->
                            @foreach($dataSchoolModel_SchoolNurse['getList'] as $value)
                            <tr>
                                <td> {{ $value->id }} </td>
                                <td> {{ $value->school }} </td>
                                <td> {{ $value->school_nurse_email }} </td>
                                <td> {{ $value->address_barangay }} </td>
                                <td> {{ $value->district }} </td>
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
                            <!-- End row -->
                        </tbody>
                    </table>

                    <div class="col-12 d-flex justify-content-end">
                        {!! $dataSchoolModel_SchoolNurse['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
