<div class="f-flex row col-12 gap-1 justify-content-end mb-3">
    @if($activeSchoolYear['getRecord']->isNotEmpty())
    <form class="d-flex row col-12" action="{{ route('class_adviser.class_adviser.pupil_to_masterlist') }}">
        <div class="col-lg-3">
            <input type="text" class="col-lg-3 col-md-4 col-sm-6 col-12 form-control border-dark" id="text-srh"
                name="search" value="{{ Request::get('search') }}" placeholder="Search Pupil with LRN">
        </div>
        <button type="submit" class="col-auto btn btn-info font-medium px-4">
            Search
        </button>
    </form>
    @endif
    @if(count($pupilData['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty() &&
    !empty(Request::get('search')))
    <a href="{{ route('class_adviser.class_adviser.pupil_to_masterlist') }}"
        class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4">
        <i class="ti ti-square-minus me-2 fs-4"></i>
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
            Please check the result, if this is the pupil you were looking for
        </p>
        <form class="d-flex row" method="post"
            action="{{ route('class_adviser.class_adviser.pupil_to_masterlist.pupil_masterclass_add') }}">
            {{ csrf_field() }}
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 hidden">
                <input type="text" class=" form-control border border-info" placeholder="Name" readonly
                    value="{{ $pupil->id }}" name="pupil_id" required>
                <label><span class="border-info ps-3">ID</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
                <input type="text" class="form-control border border-info" placeholder="Name" readonly
                    value="{{ $pupil->last_name }}, {{ $pupil->first_name }}, {{ $pupil->middle_name }}, {{ $pupil->suffix }}">
                <label><span class="border-info ps-3">Name</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
                <input type="text" class="form-control border border-info" placeholder="LRN" readonly
                    value="{{ $pupil->lrn }}" name="lrn">
                <label><span class="border-info ps-3">LRN</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
                <input type="text" class="form-control border border-info" placeholder="Birth Date" readonly
                    value="{{ $pupil->date_of_birth }}">
                <label><span class="border-info ps-3">Birth Date</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
                <input type="text" class="form-control border border-info" placeholder="Gender" readonly
                    value="{{ $pupil->gender }}">
                <label><span class="border-info ps-3">Gender</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
                <input type="text" class="form-control border border-info" placeholder="Address" readonly
                    value="{{ $pupil->barangay }}, {{ $pupil->municipality }}, {{ $pupil->province }}">
                <label><span class="border-info ps-3">Address</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 hidden">
                <input type="text" class="form-control border border-info" placeholder="Class Adviser ID" readonly
                    value="{{ Auth::user()->id }}" name="classadviser_id" required>
                <label><span class="border-info ps-3">Class Adviser ID</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
                <select class="form-select border border-info" id="class_id" name="class_id" required>
                    @foreach($filteredRecords as $record)
                    <option value="{{ $record->id }}">{{ $record->id }} - {{ $record->section }} (Grade
                        {{ $record->grade_level }})</option>
                    @endforeach
                </select>
                <label for="class_id"><span class="border-info ps-3">Class ID</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 hidden">
                <input type="text" class="form-control border border-info" placeholder="School Year ID" readonly
                    value="{{ $activeSchoolYear['getRecord'][0]->id }}" name="schoolyear_id" required>
                <label><span class="border-info ps-3">School Year ID</span></label>
            </div>

            <div class="d-flex justify-content-end col-12 mt-3 mt-md-0 ms-auto">
                <button type="submit" class="btn btn-info font-medium rounded-pill px-4">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-send me-2 fs-4"></i>
                        Add Pupil to your MasterList
                    </div>
                </button>
            </div>
        </form>
    </div>
</div>
@empty
<div class="alert alert-warning" role="alert">
    No search result. Please search for a pupil with LRN to add to your masterlist.
</div>
@endforelse

{!! $pupilData['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

@else
<div class="alert alert-warning" role="alert">
    No search performed. Please search for a pupil with LRN to add to your masterlist.
</div>
@endif
@else
<div class="alert alert-warning px-4 card-hover" role="alert">
    No school year phase at the moment.
</div>
@endif
