<div class="card d-flex shadow-none row flex-row m-0">
    <div class="btn-toolbar d-flex justify-content-end" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group mb-2" role="group" aria-label="First group" style="align-items: center;">
            <div class=" col-auto">
                <form action="{{ route('class_adviser.class_adviser.approved_report') }}">
                    {{ csrf_field() }}
                    <input type="search" class="form-control col-auto bg-light-primary" name="searchName"
                        value="{{ Request::get('searchName') }}" placeholder="Search & Enter"
                        aria-label="Input group example" aria-describedby="btnGroupAddon2">
                </form>
            </div>
            <button type="submit" class="input-group-text col-auto bg-light-primary my-1 px-2"
                style="margin-left: -38px; margin-right: 15px; cursor:default;" id="btnGroupAddon2">
                <i class="ti ti-search fs-4"></i>
            </button>
            <a href="{{ route('class_adviser.class_adviser.approved_report') }}" type="button" class="btn btn-secondary"
                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Clear"
                style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">
                <i class="ti ti-clear-all fs-4"></i>
            </a>
            <form action="{{ route('class_adviser.class_adviser.view_nsr') }}" class="rounded-0">
                {{ csrf_field() }}
                @if(Request::get('gender') !== null)
                <input type="text" name="gender"
                    value="{{ Request::get('gender') !== null ? Request::get('gender') : 'NULL' }}" hidden>
                @endif
                @if(Request::get('pagination') !== null)
                <input type="text" name="pagination"
                    value="{{ Request::get('pagination') !== null ? Request::get('pagination') : 'NULL' }}" hidden>
                @endif
                @if(Request::get('sort_attribute') !== null)
                <input type="text" name="sort_attribute"
                    value="{{ Request::get('sort_attribute') !== null ? Request::get('sort_attribute') : 'NULL' }}"
                    hidden>
                @endif
                @if(Request::get('sort_order') !== null)
                <input type="text" name="sort_order"
                    value="{{ Request::get('sort_order') !== null ? Request::get('sort_order') : 'NULL' }}" hidden>
                @endif
                <button type="submit" class="btn btn-secondary rounded-0" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-original-title="View and Print">
                    <i class="ti ti-printer fs-4"></i>
                </button>
            </form>
            <button type="button" class="btn btn-secondary" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="ti ti-filter fs-4"></i>
            </button>
            @include('class_adviser.segments.filter-two')
            <button type="button" class="btn btn-secondary " data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="ti ti-list-check fs-4"></i>
            </button>

            <ul class="dropdown-menu animated flipInX shadow p-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRName" checked>
                    <label class="form-check-label" for="checkbox1">Pupil Name</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRDateOfBirth" checked>
                    <label class="form-check-label" for="checkbox1">Date of Birth</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRWeight" checked>
                    <label class="form-check-label" for="checkbox1">Weight</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRHeight" checked>
                    <label class="form-check-label" for="checkbox1">Height</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRSex" checked>
                    <label class="form-check-label" for="checkbox1">Sex</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRHeightSquared" checked>
                    <label class="form-check-label" for="checkbox1">Height (m<sup>2</sup>)</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRAge" checked>
                    <label class="form-check-label" for="checkbox1">Age</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRBMI" checked>
                    <label class="form-check-label" for="checkbox1">BMI</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRBMICat" checked>
                    <label class="form-check-label" for="checkbox1">BMI Category</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNSRHFACat" checked>
                    <label class="form-check-label" for="checkbox1">HFA Category</label>
                </div>

            </ul>

        </div>
        
    </div>
    <div class="d-flex justify-content-end my-2">
            <div class="btn-group mb-2 p-0 m-0" role="group" aria-label="Basic example">
                <form action="{{ route('class_adviser.class_adviser.approved_report') }}">
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
                <form action="{{ route('class_adviser.class_adviser.approved_report') }}">
                    {{ csrf_field() }}
                    <input type="text" name="gender" value="Male" hidden>
                    <button type="submit" class="btn @if(Request::get('gender') == 'Male') 
                                    btn-primary 
                                    @else btn-secondary @endif
                                    font-medium m-0" style="border-radius: 0px;">
                        Male
                    </button>
                </form>
                <form action="{{ route('class_adviser.class_adviser.approved_report') }}" class="me-1">
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
                <a href="{{ route('class_adviser.class_adviser.report_approval') }}" type="button"
                        class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-5 col-sm-7 justify-content-center rounded-1">
                        Review & Approve
                    </a>
            </div>
            
        </div>
        

    <div class="card col-lg-4 col-md-6 col-12 m-0 shadow-none p-0" style="height: fit-content;">
        <div class="card-body text-white p-0">
            <div class="d-flex flex-row align-items-center">
                <div class="card-hover d-flex">
                    <div class="ms-0">
                        @if(count($dataClassRecord['getRecord']) === 0)
                        No Class found.
                        @else
                        @foreach($dataClassRecord['getRecord'] as $value)
                        @if(isset($className[$value->class_id]))
                        @php
                        $classNameValue = $sectionNames[$dataClassSectionId[$value->class_id]];
                        $gradeLevel = $classGradeLevel[$value->class_id];
                        @endphp
                        @break
                        @endif
                        @endforeach
                        <h3 class="mb-0 text-dark fs-4">School : {{ $schoolName[$classSchoolId[$value->class_id]] }}
                        </h3>
                        <h4 class="mb-0 text-dark fs-3">Grade : {{ $gradeLevel }}</h4>
                        <span class="text-dark">Section : {{ $classNameValue ?? 'No Class found' }} </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('class_adviser.class_adviser.modals.exit-na-class')


</div>
