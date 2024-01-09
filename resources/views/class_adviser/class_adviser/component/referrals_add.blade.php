<div class="row mt-4">
    @if(empty(Request::get('program')) && empty(Request::get('search')))
    <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
        <a href="#" type="button" class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Make Referral</a>
        <a href="{{ route('class_adviser.class_adviser.referrals_list') }}" type="button" class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Referrals Table</a>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
        <form class="d-flex row col-12 border-none m-0 p-0" action="{{ route('class_adviser.class_adviser.referrals') }}">
            <input type="text" name="program" value="Feeding Program"  class="hidden">
            <button type="submit" class="card bg-success text-white w-100 card-hover">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-soup display-6"></i>
                        <div class="ms-auto">
                            <i class="ti ti-arrow-right fs-8"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 class="card-title mb-1 text-white">Feeding Program</h4>
                        <h6 class="card-text fw-normal text-white-50">
                            Ensuring students thrive, feeding program addresses nutrition gaps for academic success and health.
                        </h6>
                    </div>
                </div>
            </button>
        </form>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
        <form class="d-flex row col-12 border-none m-0 p-0" action="{{ route('class_adviser.class_adviser.referrals') }}">
            <input type="text" name="program" value="Immunization Vax"  class="hidden">
            <button type="submit" class="card bg-danger text-white w-100 card-hover">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-vaccine display-6"></i>
                        <div class="ms-auto">
                            <i class="ti ti-arrow-right fs-8"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 class="card-title mb-1 text-white">
                            Immunization/Vaccination
                        </h4>
                        <h6 class="card-text fw-normal text-white-50">
                        Inoculating for collective immunity, vaccinations shield communities, fortifying against preventable diseases and illnesses.
                        </h6>
                    </div>
                </div>
            </button>
        </form>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
        <form class="d-flex row col-12 border-none m-0 p-0" action="{{ route('class_adviser.class_adviser.referrals') }}">
        <input type="text" name="program" value="Mental Healthcare"  class="hidden">
        <button type="submit" class="card bg-primary text-white w-100 card-hover">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="ti ti-brain display-6"></i>
                    <div class="ms-auto">
                        <i class="ti ti-arrow-right fs-8"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <h4 class="card-title mb-1 text-white">
                        Mental Healthcare
                    </h4>
                    <h6 class="card-text fw-normal text-white-50">
                        Nurturing minds, mental healthcare promotes well-being, resilience, and emotional balance for overall health.
                    </h6>
                </div>
            </div>
        </button>
        </form>
    </div>
    <div class="col-md-4 d-flex align-items-stretch">
    <form class="d-flex row col-12 border-none m-0 p-0" action="{{ route('class_adviser.class_adviser.referrals') }}">
        <input type="text" name="program" value="Dental Care"  class="hidden">
        <button type="submit" class="card bg-secondary text-white w-100 card-hover">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="ti ti-dental display-6"></i>
                    <div class="ms-auto">
                        <i class="ti ti-arrow-right fs-8"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <h4 class="card-title mb-1 text-white">
                        Dental Care
                    </h4>
                    <h6 class="card-text fw-normal text-white-50">
                        Preserving smiles, dental care ensures oral health, fostering confidence and overall well-being.
                    </h6>
                </div>
            </div>
        </button>
    </form>
    </div>

    <div class="col-md-4 d-flex align-items-stretch">
        <form class="d-flex row col-12 border-none m-0 p-0" action="{{ route('class_adviser.class_adviser.referrals') }}">
            <input type="text" name="program" value="Medical Support"  class="hidden">
            <button type="submit" class="card bg-warning text-white w-100 card-hover">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-first-aid-kit display-6"></i>
                        <div class="ms-auto">
                            <i class="ti ti-arrow-right fs-8"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 class="card-title mb-1 text-white">
                            Medical Support
                        </h4>
                        <h6 class="card-text fw-normal text-white-50">
                            Providing comprehensive medical support to ensure the well-being and health of the pupil.
                        </h6>
                    </div>
                </div>
            </button>
        </form>
    </div>

    <div class="col-md-4 d-flex align-items-stretch">
        <form class="d-flex row col-12 border-none m-0 p-0" action="{{ route('class_adviser.class_adviser.referrals') }}">
            <input type="text" name="program" value="Medical Support"  class="hidden">
            <button type="submit" class="card bg-success text-white w-100 card-hover">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-stethoscope display-6"></i>
                        <div class="ms-auto">
                            <i class="ti ti-arrow-right fs-8"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 class="card-title mb-1 text-white">
                            Nursing Services
                        </h4>
                        <h6 class="card-text fw-normal text-white-50">
                            Providing compassionate nursing services to ensure the well-being and health of pupils, promoting a caring and supportive environment.
                        </h6>
                    </div>
                </div>
            </button>
        </form>
    </div>
    
    @endif
</div>

<div class="f-flex row col-12 border-none gap-1 justify-content-end mb-3">
    @if($activeSchoolYear['getRecord']->isNotEmpty() && !empty(Request::get('program')))
    <form class="d-flex row col-12 border-none m-0 p-0" action="{{ route('class_adviser.class_adviser.referrals') }}">
        <div class="col-lg-3 col-md-5 col-sm-6 col-12 border-none my-1">
            <input type="search" class="col-lg-3 col-md-4 col-sm-6 col-12 border-none form-control border-dark"
                id="text-srh" name="search" value="{{ Request::get('search') }}" placeholder="Search Pupil with LRN">
        </div>
        <div class="col-lg-3 col-md-5 col-sm-6 col-12 border-none my-1">
            <input type="search" class="col-lg-3 col-md-4 col-sm-6 col-12 border-none form-control border-dark"
                id="text-srh" name="program" value="{{ Request::get('program') }}" readonly>
        </div>
        <button type="submit" class="col-auto btn btn-info font-medium px-4 my-1">
            Search
        </button>
    </form>
    <div class="d-flex row align-items-center p-0 m-0 my-1 justify-content-end">
        <a href="{{ route('class_adviser.class_adviser.referrals_list') }}"
            class="btn btn-primary col-lg-3 col-md-5 col-sm-8 col-12">
            See Your Referrals
        </a>
    </div>

    @if(empty(Request::get('search')))
        @include('class_adviser.segments.filter')
        <div class="table-responsive w-100 pb-3">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th></th>
                        <th>LRN</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    <!-- end row -->
                </thead>
                <tbody>
                    @if(count($dataMasterList['getRecord']) === 0)
                    <tr>
                        <td colspan="7" class="text-center">No pupil</td>
                    </tr>
                    @else
                    <!-- start row -->
                    @foreach($dataMasterList['getRecord'] as $value)
                        <tr>
                            <td>{{ $loop->index + 1 + ($dataMasterList['getRecord']->perPage() * 
                                ($dataMasterList['getRecord']->currentPage() - 1)) }}</td>
                            <td>{{ $dataPupilLRNs[$value->pupil_id] }}</td>
                            <td>{{ $dataPupilNames[$value->pupil_id] }}</td>
                            <td>
                                <a href="{{ route('class_adviser.class_adviser.referrals', 
                                    ['search' => $dataPupilLRNs[$value->pupil_id], 
                                    'program' => Request::get('program')]) }}" class="btn btn-primary text-white py-1 px-3">Refer 
                                    <i class="ti ti-arrow-right"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    <!-- End row -->
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                    {!! $data['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>

        </div>
        @endif

    @endif
    @if(count($pupilData['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty() &&
    !empty(Request::get('search')) && !empty(Request::get('program')))
    <a href="{{ route('class_adviser.class_adviser.referrals') }}"
        class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4">
        <i class="ti ti-square-minus me-2 fs-4 fw-semibold"></i>
        Clear Result
    </a>
    @endif

</div>

@if(count($pupilData['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty())
@if(!empty(Request::get('search')))
@forelse($pupilData['getList'] as $pupil)
<div class="card">
    <div class="card-body bg-light-primary">
        <h5>Result</h5>
        <p class="card-subtitle mb-3">
            Please check the result, if this is the pupil you were looking for alongside the details
        </p>
        @php
        $class_id = $classId;
        @endphp

        <form class="d-flex row" method="post" action="{{ route('class_adviser.class_adviser.referrals.add') }}">
            {{ csrf_field() }}
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                <input type="text" class=" form-control border border-info" placeholder="Name" readonly
                    value="{{ $pupil->id }}" name="pupil_id" required>
                <label><span class="border-info ps-3">ID</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                <input type="text" class=" form-control border border-info" placeholder="Program" readonly
                    value="{{ Request::get('program') }}" name="program" required>
                <label><span class="border-info ps-3">Program</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                <input type="text" class=" form-control border border-info" placeholder="Name" readonly
                    value="{{ $dataSchoolNurseIds[$dataSchoolIds[$class_id]] }}" name="school_nurse_id" required>
                <label><span class="border-info ps-3">School Nurse ID</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control " placeholder="Name" readonly
                    value="{{ $pupil->last_name }}, {{ $pupil->first_name }}, {{ $pupil->middle_name }}, {{ $pupil->suffix }}">
                <label><span class="border-info ps-3">Name</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control" placeholder="LRN" readonly value="{{ $pupil->lrn }}" name="lrn">
                <label><span class="border-info ps-3">LRN</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control" placeholder="Birth Date" readonly
                    value="{{ $pupil->date_of_birth }}">
                <label><span class="border-info ps-3">Birth Date</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control" placeholder="Gender" readonly value="{{ $pupil->gender }}">
                <label><span class="border-info ps-3">Gender</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control" placeholder="Address" readonly
                    value="{{ $pupil->barangay }}, {{ $pupil->municipality }}, {{ $pupil->province }}">
                <label><span class="border-info ps-3">Address</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                <input type="text" class="form-control" placeholder="Class Adviser ID" readonly
                    value="{{ Auth::user()->id }}" name="classadviser_id" required>
                <label><span class="border-info ps-3">Class Adviser ID</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                <input type="text" class="form-control" placeholder="School Year ID" readonly
                    value="{{ $activeSchoolYear['getRecord'][0]->school_year }}"
                    required>
                <label><span class="border-info ps-3">School Year</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                <input type="text" class="form-control border border-info" placeholder="School Year ID" readonly
                    value="{{ $activeSchoolYear['getRecord'][0]->id }}" name="schoolyear_id" required>
                <label><span class="border-info ps-3">School Year ID</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                <input type="text" class="form-control border border-info" placeholder="Class" readonly
                    value="{{ $class_id }}" name="class_id" required>
                <label><span class="border-info ps-3">{{ $dataClassNames[$class_id] }}</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control border-0 border-info" placeholder="Class" readonly
                    value="Grade : {{ $dataGradeLevel[$class_id] }} | Section : {{ $dataClassNames[$class_id] }}"
                    required>
                <label><span class="border-info ps-3">Class</span></label>
            </div>

            <div class="d-flex row col-12 border-none justify-content-end">
                <div class="form-floating mb-3 col-12 border-none">
                    <textarea class="form-control border border-info" placeholder="Notes/Observation" name="explanation" rows="10"
                        required></textarea>
                    <label for="class_id"><span class="border-info ps-3">Enter Any Notes or Observations</span></label>
                </div>
            </div>


            <div class="d-flex justify-content-end col-12 border-none mt-3 mt-md-0 ms-auto">
                <button type="button" class="btn btn-info font-medium px-4" data-bs-toggle="modal"
                    data-bs-target="#refer-modal">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-send me-2 fs-4"></i>
                        Refer
                    </div>
                </button>
            </div>

            @include('class_adviser.class_adviser.modals.refer')

        </form>
    </div>
</div>
@empty
<div class="alert alert-warning" role="alert">
    No search result. Please search for a pupil with LRN to add to refer.
</div>
@endforelse

{!! $pupilData['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

@else

@endif
@else
<div class="alert alert-warning px-4" role="alert">
    No search performed. Please search for a pupil with LRN to add to refer.
</div>
@endif
