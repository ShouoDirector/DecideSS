<div class="col-12 card position-relative overflow-hidden shadow-none">
    <div class="shadow-none">

        <div class="f-flex row col-12 gap-1 justify-content-end mb-3">
            <form class="d-flex row col-12" action="{{ route('admin.constants.classroom') }}">
                <div class="col-lg-3 col-md-5 col-sm-6 col-12 m-1">
                    <input type="search" class="col-lg-3 col-md-4 col-sm-6 col-12 form-control border-dark" id="text-srh"
                        name="search" value="{{ Request::get('search') }}" placeholder="Search ClassAdviser with Unique ID">
                </div>
                <button type="submit" class="col-auto btn btn-info font-medium px-4 m-1">
                    Search
                </button>
            </form>
            @if(!empty(Request::get('search')))
            <a href="{{ route('admin.constants.classroom') }}"
                class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4">
                <i class="ti ti-square-minus me-2 fs-4 fw-semibold"></i>
                Clear
            </a>
            @endif
        </div>

        @if(count($classAdvisersData['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty())
        @if(!empty(Request::get('search')))
        @forelse($classAdvisersData['getList'] as $ca)

        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerMessage1'] }}
        </p>
        <form class="d-flex row" method="post" action="{{ route('classroom.add') }}" id="userForm">
            {{ csrf_field() }}

            <div class="form-floating mb-3 col-lg-4 col-md-6 col-sm-12 hidden">
                <input type="text" value="{{ $ca->id }}" name="classadviser_id" class="form-control border border-info" placeholder="Section"
                    required readonly/>
                <label><span class="border-info ps-3">Class Adviser</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-4 col-md-6 col-sm-12">
                <input type="text" value="{{ $ca->unique_id }} | {{ $ca->name }}" class="form-control border border-info" placeholder="Section"
                    required readonly/>
                <label><span class="border-info ps-3">Class Adviser</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-4 col-md-6 col-sm-12">
                <input type="text" name="section" class="form-control border border-info" placeholder="Section"
                    required />
                <label><span class="border-info ps-3">Section</span></label>
            </div>
            <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <select class="form-control form-select border border-info p-3 select2" name="school_id"
                    id="schoolSelect">
                    <option value="#" selected disabled>Select School</option>
                    @if(isset($dataSchools['getList']) && !$dataSchools['getList']->isEmpty())
                    @foreach($dataSchools['getList'] as $school)
                    <option value="{{ $school->id }}">{{ $school->school }}</option>
                    @endforeach
                    @else
                    <option value="#" disabled>No Schools available</option>
                    @endif
                </select>
            </div>
            
            <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                <select class="form-control form-select border border-info p-3 select2" name="grade_level"
                    id="userTypeSelect">
                    <option value="#" selected disabled>Select Grade Level</option>
                    <option value="Kinder">Kinder</option>
                    <option value="1">Grade 1</option>
                    <option value="2">Grade 2</option>
                    <option value="3">Grade 3</option>
                    <option value="4">Grade 4</option>
                    <option value="5">Grade 5</option>
                    <option value="6">Grade 6</option>
                    <option value="SPED">SPED</option>
                </select>

                <div id="validationMessage" class="text-danger"></div>
            </div>

            <div class="d-md-flex align-items-center">
                <div class="mt-3 mt-md-0 d-content" style="display: contents;">
                    <input type="submit" value="Submit" class="btn btn-info font-medium w-100 px-4" id="submitButton">
                </div>
            </div>
        </form>
        @empty
        <div class="alert alert-warning" role="alert">
            No search results.
        </div>
        @endforelse

        @else

        @endif

        @else
        <div class="alert alert-warning px-4" role="alert">
            No search result. Please use the Unique ID of the class adviser you were trying to assign for the classroom you will make.
        </div>
        <div class="alert alert-warning px-4" role="alert">
            Find the unique id in account list tab.
        </div>
        @endif

        @include('validator/form-validator')

    </div>
</div>
