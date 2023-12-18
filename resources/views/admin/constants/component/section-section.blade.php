<div class="d-flex row w-100">

    <div class="col-12">
        <div class="d-flex row card w-100 shadow-none">
            <!-- Nav tabs -->

            @if($activeSchoolYear['getRecord']->isNotEmpty())
            <div class="d-flex row align-items-center p-2 col-12 justify-content-between">
                <form class="d-flex row align-items-center col-lg-8 col-md-6 col-sm-12 m-0" action="{{ route('admin.constants.sections') }}" style="width: max-content;">
                    <div class="border-none col-auto">
                        <input type="search" class="col-auto border-none form-control border-dark" id="text-srh"
                            name="search" value="{{ Request::get('search') }}" placeholder="Search with School ID">
                    </div>
                    <div class="d-flex row align-items-center p-2 col-auto">
                    <button type="submit" class="col-auto btn btn-info font-medium px-4">
                        Search
                    </button>
                    </div>
                    @if(!is_null($schoolData['getList']) && $activeSchoolYear['getRecord']->isNotEmpty() &&
                    !empty(Request::get('search')))
                    <a href="{{ route('admin.constants.sections') }}"
                        class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4 mx-3">
                        <i class="ti ti-square-minus me-2 fs-4 fw-semibold"></i>
                        Clear Result
                    </a>
                    @endif
                </form>
                
                <div class="d-flex align-items-center justify-content-end col-lg-4 col-md-6 col-12 px-3">
                    <div class="d-flex row align-items-center p-2 ">
                        <a href="{{ route('admin.constants.manage_sections') }}" class="btn btn-primary">
                            See Sections Table
                        </a>
                    </div>
                </div>
            </div>
            @endif
            <!-- ================================ SIDE FORM - SECTION ================================================ -->
            @if(!is_null($schoolData['getList']) && $activeSchoolYear['getRecord']->isNotEmpty())
            @if(!empty(Request::get('search')))
            @forelse([$schoolData['getList']] as $singleSchoolData)

            <div class="card">
                <div class="card-body bg-light-primary">
                    <h5>Result</h5>
                    <p class="card-subtitle mb-3">
                        Please check the result, if this is the school you were looking for alongside the details
                    </p>
                    <form class="d-flex row" method="post"
                        action="{{ route('sections.add') }}">
                        {{ csrf_field() }}

                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                            <input type="text" class=" form-control border border-info" placeholder="School Unique ID" readonly
                                value="{{ Request::get('search') }}" name="school_unique_id" required>
                            <label><span class="border-info ps-3">School Unique ID</span></label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                            <input type="text" class=" form-control border border-info" placeholder="Section Code" readonly
                                value="{{ $singleSchoolData->id }}" name="school_id" required>
                            <label><span class="border-info ps-3">School ID</span></label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                            <input type="text" class="form-control " placeholder="School Name" readonly
                                value="{{ $singleSchoolData->school }}">
                            <label><span class="border-info ps-3">School Name</span></label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                            <input type="text" class="form-control" placeholder="School Nurse" readonly
                                value="{{ $schoolNursesNames[$singleSchoolData->school_nurse_id] }}">
                            <label><span class="border-info ps-3">School Nurse</span></label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                            <input type="text" class="form-control" placeholder="Barangay Address" readonly
                                value="{{ $singleSchoolData->address_barangay }}">
                            <label><span class="border-info ps-3">Barangay Address</span></label>
                        </div>
                        <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                            <input type="text" class="form-control" placeholder="District" readonly
                                value="{{ $districtNames[$singleSchoolData->district_id] }}">
                            <label><span class="border-info ps-3">District</span></label>
                        </div>
                        <hr>

                        <div class="d-flex justify-content-end col-12 mt-3 mt-md-0 ms-auto">
                            <button type="button" class="btn btn-info font-medium px-4" 
                            data-bs-toggle="modal" data-bs-target="#section-section-modal">
                                <div class="d-flex gap-2 align-items-center">
                                    Continue
                                    <i class="ti ti-send me-2 fs-4"></i>
                                </div>
                            </button>
                        </div>

                        @include('admin.constants.modals.section-section-modal')
                        
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
