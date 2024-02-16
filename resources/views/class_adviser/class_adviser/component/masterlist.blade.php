<div class="d-flex shadow-none p-0">

    <div class="col-12 shadow-none">
        <div class="card-body w-100">
            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane active show" id="home2" role="tabpanel">
                    <div class="py-3 px-0">

                        <div class="btn-toolbar d-flex justify-content-end" role="toolbar"
                            aria-label="Toolbar with button groups">
                            <div class="btn-group mb-2" role="group" aria-label="First group"
                                style="align-items: center;">
                                <div class=" col-auto">
                                    <form action="{{ route('class_adviser.class_adviser.masterlist') }}">
                                        {{ csrf_field() }}
                                        <input type="search" class="form-control col-auto bg-light-primary"
                                            name="search" value="{{ Request::get('search') }}" placeholder="Search & Enter"
                                            aria-label="Input group example" aria-describedby="btnGroupAddon2">
                                    </form>
                                </div>
                                <button type="submit" class="input-group-text col-auto bg-light-primary my-1 px-2"
                                    style="margin-left: -38px; margin-right: 15px; cursor:default;" id="btnGroupAddon2">
                                    <i class="ti ti-search fs-4"></i>
                                </button>

                                <a href="{{ route('class_adviser.class_adviser.masterlist') }}" type="button"
                                    class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="Clear"
                                    style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
                                    <i class="ti ti-clear-all fs-4"></i>
                                </a>
                                <form action="{{ route('class_adviser.class_adviser.view_masterlist') }}"
                                    class="rounded-0">
                                    @if(Request::get('gender') !== null)
                                    <input type="text" name="gender"
                                        value="{{ Request::get('gender') !== null ? Request::get('gender') : 'NULL' }}"
                                        hidden>
                                    @endif
                                    @if(Request::get('pagination') !== null)
                                    <input type="text" name="pagination"
                                        value="{{ Request::get('pagination') !== null ? Request::get('pagination') : 'NULL' }}"
                                        hidden>
                                    @endif
                                    @if(Request::get('sort_attribute') !== null)
                                    <input type="text" name="sort_attribute"
                                        value="{{ Request::get('sort_attribute') !== null ? Request::get('sort_attribute') : 'NULL' }}"
                                        hidden>
                                    @endif
                                    @if(Request::get('sort_order') !== null)
                                    <input type="text" name="sort_order"
                                        value="{{ Request::get('sort_order') !== null ? Request::get('sort_order') : 'NULL' }}"
                                        hidden>
                                    @endif
                                    <button type="submit" class="btn btn-secondary rounded-0" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-original-title="View and Print">
                                        <i class="ti ti-printer fs-4"></i>
                                    </button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-filter fs-4"></i>
                                </button>
                                @include('class_adviser.segments.filter-two')
                                <button type="button" class="btn btn-secondary " data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-list-check fs-4"></i>
                                </button>

                                <ul class="dropdown-menu animated flipInX shadow p-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxMasterlistLRN"
                                            checked>
                                        <label class="form-check-label" for="checkbox1">LRN</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxMasterlistName"
                                            checked>
                                        <label class="form-check-label" for="checkbox2">Name</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxMasterlistAge"
                                            checked>
                                        <label class="form-check-label" for="checkbox2">Age</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxMasterlistGender"
                                            checked>
                                        <label class="form-check-label" for="checkbox2">Gender</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxMasterlistAddress"
                                            checked>
                                        <label class="form-check-label" for="checkbox2">Address</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"
                                            id="checkboxMasterlistGuardianName" checked>
                                        <label class="form-check-label" for="checkbox2">Guardian Name</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"
                                            id="checkboxMasterlistGuardianContactNumber" checked>
                                        <label class="form-check-label" for="checkbox2">Guardian Contact No</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkboxMasterlistActions"
                                            checked>
                                        <label class="form-check-label" for="checkbox2">Actions</label>
                                    </div>
                                </ul>

                            </div>
                        </div>

                        <div class="d-flex justify-content-end my-2">
                            <div class="btn-group mb-2 p-0 m-0" role="group" aria-label="Basic example">
                                <form action="{{ route('class_adviser.class_adviser.masterlist') }}">
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
                                <form action="{{ route('class_adviser.class_adviser.masterlist') }}">
                                    {{ csrf_field() }}
                                    <input type="text" name="gender" value="Male" hidden>
                                    <button type="submit" class="btn @if(Request::get('gender') == 'Male') 
                                    btn-primary 
                                    @else btn-secondary @endif
                                    font-medium m-0" style="border-radius: 0px;">
                                        Male
                                    </button>
                                </form>
                                <form action="{{ route('class_adviser.class_adviser.masterlist') }}">
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

                        <!-- =========================================TABLE FILTER - PUPILS ====================================== -->

                        <span class="fs-4">{{ $schoolName[$dataClass['classRecords'][0]['school_id']] }} <br>
                            Grade {{ $dataClass['classRecords'][0]['grade_level'] }} -
                            {{ $sectionNames[$dataClass['classRecords'][0]['section_id']] }}</span><br>
                        {{ $schoolNurseName[$schoolNurseIds[$dataClass['classRecords'][0]['school_id']]] }}

                        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex w-100 justify-content-end gap-2">
                                <a class="btn row d-lg-none d-flex justify-content-" data-bs-toggle="offcanvas"
                                    href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    <i class="ti ti-menu-2 fs-6"></i>
                                </a>
                            </div>
                        </div>

                        <!-- ========================================= MasterList TABLE ====================================== -->
                        @include('class_adviser.class_adviser.tables.masterlist-table')

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
