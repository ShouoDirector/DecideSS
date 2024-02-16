<div class="d-flex shadow-none row w-100">

    <div class="col-12 shadow-none">
        <div class="card-body w-100">

            <!-- Nav tabs -->

            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane active show" id="home2" role="tabpanel">
                    <div class="p-3">

                        <!-- =========================================TABLE FILTER - PUPILS ====================================== -->
                        <div class="btn-toolbar d-flex justify-content-end" role="toolbar"
                            aria-label="Toolbar with button groups">
                            <div class="btn-group mb-2" role="group" aria-label="First group"
                                style="align-items: center;">
                                <div class=" col-auto">
                                    <form action="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}">
                                        {{ csrf_field() }}
                                        <input type="search" class="form-control col-auto bg-light-primary"
                                            name="search" value="{{ Request::get('search') }}"
                                            placeholder="Search & Enter" aria-label="Input group example"
                                            aria-describedby="btnGroupAddon2">
                                    </form>
                                </div>
                                <button type="submit" class="input-group-text col-auto bg-light-primary my-1 px-2"
                                    style="margin-left: -38px; margin-right: 15px; cursor:default;" id="btnGroupAddon2">
                                    <i class="ti ti-search fs-4"></i>
                                </button>
                                <a href="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}"
                                    type="button" class="btn btn-secondary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Clear"
                                    style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
                                    <i class="ti ti-clear-all fs-4"></i>
                                </a>

                                <button type="button" class="btn btn-secondary" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-filter fs-4"></i>
                                </button>

                                <ul class="dropdown-menu animated lightSpeedIn px-3 shadow-lg">
                                    <form action="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}">
                                        {{ csrf_field() }}
                                        <input type="text" name="gender" value="{{ Request::get('gender') }}" hidden>
                                        <li>
                                            <h6 class="my-2 fw-semibold">Entries</h6>
                                            <div class="col-auto d-flex align-items-center my-1 w-100">
                                                <select class="form-select border-dark" name="pagination"
                                                    id="paginationSelect">
                                                    <option value="5"
                                                        {{ Request::get('pagination') == 5 ? 'selected' : '' }}> 5
                                                        Rows
                                                    </option>
                                                    <option value="10"
                                                        {{ (Request::get('pagination') ?? 10) == 10 ? 'selected' : '' }}>
                                                        10
                                                        Rows
                                                    </option>
                                                    <option value="25"
                                                        {{ Request::get('pagination') == 25 ? 'selected' : '' }}>
                                                        25 Rows
                                                    </option>
                                                    <option value="50"
                                                        {{ Request::get('pagination') == 50 ? 'selected' : '' }}>
                                                        50 Rows
                                                    </option>
                                                    <option value="100"
                                                        {{ Request::get('pagination') == 100 ? 'selected' : '' }}>
                                                        100 Rows
                                                    </option>
                                                    <option value="250"
                                                        {{ Request::get('pagination') == 250 ? 'selected' : '' }}>
                                                        250 Rows
                                                    </option>
                                                    <option value="999"
                                                        {{ Request::get('pagination') == 999 ? 'selected' : '' }}>
                                                        999 Rows
                                                    </option>
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <h6 class="my-2 fw-semibold">Sort By</h6>
                                            <div
                                                class="form-group row d-flex align-items-center ps-4 justify-content-start">
                                                <div class="d-flex row gap-1 p-0 w-100">
                                                    <select class="form-select border-dark" name="sort_attribute">
                                                        <option value="id"
                                                            {{ Request::get('sort_attribute', 'id') == 'id' ? 'selected' : '' }}>
                                                            ID</option>
                                                        <option value="created_at"
                                                            {{ Request::get('sort_attribute') == 'created_at' ? 'selected' : '' }}>
                                                            Created
                                                        </option>
                                                        <option value="updated_at"
                                                            {{ Request::get('sort_attribute') == 'updated_at' ? 'selected' : '' }}>
                                                            Updated
                                                        </option>
                                                    </select>
                                                    <select class="form-select border-dark" name="sort_order">
                                                        <option value="asc"
                                                            {{ Request::get('sort_order', 'asc') == 'asc' ? '' : 'selected' }}>
                                                            Ascending</option>
                                                        <option value="desc"
                                                            {{ Request::get('sort_order') == 'desc' ? 'selected' : '' }}>
                                                            Descending</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <button type="submit" class="justify-content-center w-100 btn mt-2 btn-rounded btn-secondary 
                                        d-flex align-items-center card-hover py-2">Sort and Filter</button>
                                        </li>
                                    </form>
                                </ul>


                                <button type="button" class="btn btn-secondary " data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-list-check fs-4"></i>
                                </button>

                                <ul class="dropdown-menu animated flipInX shadow p-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxBLRN" checked>
                                        <label class="form-check-label" for="checkbox1">LRN</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxBName" checked>
                                        <label class="form-check-label" for="checkbox1">Name</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxBClass" checked>
                                        <label class="form-check-label" for="checkbox1">Class</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxBAdviser" checked>
                                        <label class="form-check-label" for="checkbox1">Class Adviser</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxBAction" checked>
                                        <label class="form-check-label" for="checkbox1">Action</label>
                                    </div>

                                </ul>

                            </div>

                        </div>
                        <div class="d-flex justify-content-end my-2">
                            <div class="btn-group mb-2 p-0 m-0" role="group" aria-label="Basic example">
                                <form action="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn @if(Request::get('gender') == 'Male' || 
                                    Request::get('gender') == 'Female') btn-secondary
                                    @elseif(empty(Request::get('gender')))
                                    btn-primary
                                    @endif
                                    font-medium m-0"
                                        style="border-top-left-radius: 5px; 
                                    border-bottom-left-radius: 5px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;">
                                        All
                                    </button>
                                </form>
                                <form action="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}">
                                    {{ csrf_field() }}
                                    <input type="text" name="gender" value="Male" hidden>
                                    <button type="submit" class="btn @if(Request::get('gender') == 'Male') 
                                    btn-primary 
                                    @else btn-secondary @endif
                                    font-medium m-0" style="border-radius: 0px;">
                                        Male
                                    </button>
                                </form>
                                <form action="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}"
                                    class="me-1">
                                    {{ csrf_field() }}
                                    <input type="text" name="gender" value="Female" hidden>
                                    <button type="submit" class="btn @if(Request::get('gender') == 'Female') 
                                    btn-primary 
                                    @else btn-secondary @endif
                                    font-medium m-0" style="border-top-right-radius: 5px; border-bottom-right-radius: 5px; 
                                border-top-left-radius: 0px; border-bottom-left-radius: 0px;">
                                        Female
                                    </button>
                                </form>
                            </div>

                        </div>
                        <h3 class="mb-4 text-dark fs-4">{{ $schoolName[$schoolIDBySN] }}
                        </h3>

                        <!-- ========================================= MasterList TABLE ====================================== -->
                        @include('school_nurse.school_nurse.tables.beneficiaries_table')

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
