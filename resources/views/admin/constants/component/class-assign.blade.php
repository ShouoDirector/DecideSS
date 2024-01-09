<div class="d-flex row w-100">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            @if($searchedSchools['getList']->isEmpty() && empty(Request::get('searchSchools')) && empty(Request::get('searchSections'))
                && empty(Request::get('retrieveId')) && empty(Request::get('search')))
                <li class="breadcrumb-item active">Districts</li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('admin.constants.class_assignment') }}">Districts</a></li>
            @endif

            @if($activeSchoolYear['getRecord']->isNotEmpty() && !empty($searchedSchools['getList']) && empty(Request::get('searchSections'))
                && empty(Request::get('retrieveId')) && empty(Request::get('search')) && $districtData['getList']->isEmpty())
                <li class="breadcrumb-item active">Schools</li>
            @elseif($activeSchoolYear['getRecord']->isNotEmpty() && !empty($searchedSections['getList']) && !empty(Request::get('searchSections'))
                && empty(Request::get('retrieveId')))
                <li class="breadcrumb-item"><a href="{{ route('admin.constants.class_assignment') }}">Schools</a></li>
                <li class="breadcrumb-item active">Sections</li>
            @elseif($activeSchoolYear['getRecord']->isNotEmpty() && !empty($retrievedId['getList']) && !empty(Request::get('retrieveId')))
                <li class="breadcrumb-item"><a href="{{ route('admin.constants.class_assignment') }}">Sections</a></li>
                <li class="breadcrumb-item active">Search Results</li>
            @else
                <li class="breadcrumb-item active">Search Results</li>
            @endif
        </ol>
    </nav>

    <div class="col-12">
        <div class="d-flex row card w-100 shadow-none">
            <!-- Nav tabs -->
            
            @if($searchedSchools['getList']->isEmpty() && empty(Request::get('searchSchools')) && empty(Request::get('searchSections'))
            && empty(Request::get('retrieveId')) && empty(Request::get('search')))
            <table class="table stylish-table v-middle mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th></th>
                        <th class="border-0 fw-normal"></th>
                        <th class="border-0 fw-normal">District</th>
                        <th class="border-0 fw-normal">Medical Officer</th>
                        <th class="border-0 fw-normal">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($districtData['getList'] as $index => $district)
                    <tr>
                        <td> <span class="d-flex align-items-center">{{ $loop->iteration }}</span> </td>
                        <td>
                            <span
                                class="round-40 text-white d-flex align-items-center justify-content-center text-center rounded-circle 
                                {{ $index % 2 == 0 ? 'bg-primary' : 'bg-secondary' }}">
                                {{ strtoupper(substr($district->district, 0, 2)) }}</span>
                        </td>
                        <td class="d-flex flex-column align-items-baseline justify-content-center">
                            <h6 class="font-weight-medium mb-0">{{ $district->district }}</h6>
                        </td>
                        <td class="align-middle">{{ $medicalOfficersNames[$district->medical_officer_id] }}</td>

                        <td class="d-flex flex-column align-items-baseline justify-content-center">
                            <form class="d-flex row col-12 w-auto" action="{{ route('admin.constants.class_assignment') }}">
                                <div class="hidden">
                                    <input type="search" class="border-dark col-1" id="text-srh"
                                        name="searchSchools" value="{{ $district->id }}" placeholder="Search" readonly>
                                </div>
                                <button type="submit" class="d-inline-flex align-items-center justify-content-center 
                                btn btn-circle btn-lg card-zoom
                                {{ $index % 2 == 0 ? 'bg-primary' : 'bg-secondary' }}">
                                    <i class="fs-5 ti ti-arrow-right text-white card-zoom"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            
            </table>
            @endif

            @if($activeSchoolYear['getRecord']->isNotEmpty() && !empty($searchedSchools['getList']) && empty(Request::get('searchSections'))
            && empty(Request::get('retrieveId')) && empty(Request::get('search')))
            <table class="table stylish-table v-middle mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th class="border-0 fw-normal"></th>
                        <th class="border-0 fw-normal">School</th>
                        <th class="border-0 fw-normal">School Nurse</th>
                        <th class="border-0 fw-normal">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($searchedSchools['getList'] as $index => $school)
                    <tr>
                        <td>
                            <span
                                class="round-40 text-white d-flex align-items-center justify-content-center text-center rounded-circle 
                                {{ $index % 2 == 0 ? 'bg-primary' : 'bg-secondary' }}">
                                {{ strtoupper(substr($school->school, 0, 2)) }}</span>
                        </td>
                        <td class="d-flex flex-column align-items-baseline justify-content-center card-hover">
                            <h6 class="font-weight-medium mb-0">{{ $school->school }}</h6>
                        </td>
                        <td class="align-middle card-hover">{{ $schoolNursesNames[$school->school_nurse_id] }}</td>

                        <td class="d-flex flex-column align-items-baseline justify-content-center">
                            <form class="d-flex row col-12 w-auto" action="{{ route('admin.constants.class_assignment') }}">
                                <div class="hidden">
                                    <input type="search" class="border-dark col-1" id="text-srh"
                                        name="searchSections" value="{{ $school->id }}" placeholder="Search" readonly>
                                </div>
                                <button type="submit" class="d-inline-flex align-items-center justify-content-center 
                                btn btn-circle btn-lg card-zoom
                                {{ $index % 2 == 0 ? 'bg-primary' : 'bg-secondary' }}">
                                    <i class="fs-5 ti ti-arrow-right text-white card-zoom"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif

            @if($activeSchoolYear['getRecord']->isNotEmpty() && !empty($searchedSections['getList']) && !empty(Request::get('searchSections'))
            && empty(Request::get('retrieveId')))
            <table class="table stylish-table v-middle mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th class="border-0 fw-normal"></th>
                        <th class="border-0 fw-normal">School</th>
                        <th class="border-0 fw-normal">Grade Level</th>
                        <th class="border-0 fw-normal">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($searchedSections['getList'] as $index => $section)
                    <tr>
                        <td>
                            <span
                                class="round-40 text-white d-flex align-items-center justify-content-center text-center rounded-circle 
                                {{ $index % 2 == 0 ? 'bg-primary' : 'bg-secondary' }}">
                                {{ strtoupper(substr($section->section_name, 0, 2)) }}</span>
                        </td>
                        <td class="d-flex flex-column align-items-baseline justify-content-center card-hover">
                            <h6 class="font-weight-medium mb-0">{{ $section->section_name }}</h6>
                        </td>
                        <td class="align-middle card-hover">{{ $section->grade_level }}</td>

                        <td class="d-flex flex-column align-items-baseline justify-content-center">
                            <form class="d-flex row col-12 w-auto" action="{{ route('admin.constants.class_assignment') }}">
                                <div class="hidden">
                                    <input type="search" class="border-dark col-1" id="text-srh"
                                        name="retrieveId" value="{{ $section->id }}" placeholder="Search" readonly>
                                </div>
                                <button type="submit" class="d-inline-flex align-items-center justify-content-center 
                                btn btn-circle btn-lg card-zoom
                                {{ $index % 2 == 0 ? 'bg-primary' : 'bg-secondary' }}">
                                    <i class="fs-5 ti ti-arrow-right text-white card-zoom"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
            @endforeach
                </tbody>
            </table>
            @endif


            @if($activeSchoolYear['getRecord']->isNotEmpty() && !empty($retrievedId['getList']) && !empty(Request::get('retrieveId')))
            @foreach($retrievedId['getList'] as $retrievedId)
            <div class="d-flex row align-items-center p-2 col-12 justify-content-between">
                <form class="d-flex row align-items-center col-lg-8 col-md-6 col-sm-12 m-0" action="#" style="width: max-content;">
                    <div class="border-none col-auto">
                        <input type="search" class="col-auto border-none form-control border-dark" id="text-srh"
                            name="search" value="{{ $retrievedId->section_code }}" placeholder="Section Code" readonly>
                    </div>
                    <div class="border-none col-auto">
                        <input type="search" class="col-auto border-none form-control border-dark" id="text-srh"
                            name="search_id" value="{{ Request::get('search_id') }}" placeholder="Class Adviser Unique ID">
                    </div>
                    <div class="d-flex row align-items-center p-2 col-auto">
                    <button type="submit" class="col-auto btn btn-info font-medium px-4">
                        Search
                    </button>
                    </div>
                    @if(!is_null($sectionData['getList']) && $activeSchoolYear['getRecord']->isNotEmpty() &&
                    !empty(Request::get('search')))
                    <a href="{{ route('admin.constants.class_assignment') }}"
                        class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4 mx-3">
                        <i class="ti ti-square-minus me-2 fs-4 fw-semibold"></i>
                        Clear Result
                    </a>
                    @endif
                </form>

            </div>
            @endforeach
            @endif

            <!-- ================================ SIDE FORM - SECTION ================================================ -->
            @if(!is_null($sectionData['getList']) && $activeSchoolYear['getRecord']->isNotEmpty())
            @if(!empty(Request::get('search')))
            @forelse([$sectionData['getList']] as $section)

            <div class="card">
                <div class="card-body bg-light-primary">
                    <h5>Result</h5>
                    <p class="card-subtitle mb-3">
                        Please check the result, if this is the section you were looking for alongside the details
                    </p>
                    <form class="d-flex row" method="post"
                        action="{{ route('assign_ca.add') }}">
                        {{ csrf_field() }}

                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                            <input type="text" class=" form-control border border-info" placeholder="Search" readonly
                                value="{{ Request::get('search') }}" name="search" required>
                            <label><span class="border-info ps-3">Section Code</span></label>
                        </div>

                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                            <input type="text" class=" form-control border border-info" placeholder="Search" readonly
                                value="{{ Request::get('search_id') }}" name="search_id" required>
                            <label><span class="border-info ps-3">Class Adviser Unique ID</span></label>
                        </div>

                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                            <input type="text" class=" form-control border border-info" placeholder="Section Code" readonly
                                value="{{ $section->school_id }}" name="school_id" required>
                            <label><span class="border-info ps-3">School ID</span></label>
                        </div>

                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                            <input type="text" class=" form-control border-0 border-info" placeholder="Section Code" readonly
                                value="{{ $schoolNames[$section->school_id] }}" required>
                            <label><span class="border-info ps-3">School</span></label>
                        </div>

                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                            <input type="text" class="form-control " placeholder="Section Name" name="section" readonly
                                value="{{ $section->section_name }}">
                            <label><span class="border-info ps-3">Section Name</span></label>
                        </div>

                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                            <input type="text" name="grade_level" class="form-control" placeholder="Grade Level" readonly
                                value="{{ $section->grade_level }}">
                            <label><span class="border-info ps-3">Grade Level</span></label>
                        </div>

                        <hr>

                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                            <input type="text" name="classadviser_id" class="form-control" placeholder="Grade Level" readonly
                                value="{{ $dataClassAdvisers['getList'][0]['id'] }}">
                            <label><span class="border-info ps-3">Class Adviser</span></label>
                        </div>

                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                            <input type="text" class="form-control" placeholder="Grade Level" readonly
                                value="{{ $classAdvisersNames[$dataClassAdvisers['getList'][0]['id']] }}">
                            <label><span class="border-info ps-3">Class Adviser</span></label>
                        </div>
                        
                        <hr>

                        <div class="d-flex justify-content-end col-12 mt-3 mt-md-0 ms-auto">
                            <button type="button" class="btn btn-info font-medium px-4" 
                            data-bs-toggle="modal" data-bs-target="#add-classroom-modal">
                                <div class="d-flex gap-2 align-items-center">
                                    Continue
                                    <i class="ti ti-send me-2 fs-4"></i>
                                </div>
                            </button>
                        </div>

                        @include('admin.constants.modals.add-classroom-modal')
                        
                    </form>
                </div>
            </div>
            @empty
            <div class="alert alert-warning" role="alert">
                No search result. Please search for school with School ID to continue.
            </div>
            @endforelse

            @else

            @endif

            @else
            <div class="alert alert-warning px-4" role="alert">
                Please search for a school with school ID to continue.
            </div>
            @endif


        </div>
    </div>

</div>
