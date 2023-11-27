<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerMessage1'] }}
        </p>

        <div class="f-flex row col-12 gap-1 justify-content-end mb-3">
            <form class="d-flex row col-12" action="{{ route('class_adviser.class_adviser.nutritional_assessment') }}">
                <div class="col-lg-3">
                    <input type="text" class="col-lg-3 col-md-4 col-sm-6 col-12 form-control border-dark" id="text-srh"
                        name="search" value="{{ Request::get('search') }}" placeholder="Search Pupil with LRN">
                </div>
                <button type="submit" class="col-auto btn btn-info font-medium px-4">
                    Search
                </button>
            </form>
            @if(count($pupilData['getList']) !== 0)
            @if(!empty(Request::get('search')))
            <a href="{{ route('class_adviser.class_adviser.pupil_to_masterlist') }}"
                class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4">
                <i class="ti ti-square-minus me-2 fs-4"></i>
                Clear Result
            </a>
            @endif
            @endif
        </div>
        @if(count($pupilData['getList']) !== 0)
        @if(!empty(Request::get('search')))
        @foreach($pupilData['getList'] as $pupil)
        <form class="d-flex row" method="post" data-insert-route="{{ route('class_adviser.class_adviser.nutritional_assessment.add') }}" id="insertUserForm">
            {{ csrf_field() }}
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="text" name="lrn" class="form-control border border-info" placeholder="PNA CODE" 
                    value="{{ Auth::user()->id }}{{ $filteredRecords->first()->school_id }}{{ 
                        $filteredRecords->first()->grade_level == 'Kinder' ? 'K' : (
                        $filteredRecords->first()->grade_level == 'SPED' ? 'S' :
                        $filteredRecords->first()->grade_level)
                        }}{{ $pupil->lrn }}" required readonly/>
                <label><span class="border-info ps-3">PNA CODE</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 hidden">
                <input type="text" class=" form-control border border-info" placeholder="ID" readonly
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
                <input type="text" class="form-control border border-info" placeholder="Height" readonly
                    name="height">
                <label><span class="border-info ps-3">Height</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
                <input type="text" class="form-control border border-info" placeholder="Weight" readonly
                    name="weight">
                <label><span class="border-info ps-3">Weight</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
                <input type="text" class="form-control border border-info" placeholder="Allergies" readonly
                    name="allergies">
                <label><span class="border-info ps-3">Allergies</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
                <input type="text" class="form-control border border-info" placeholder="Dietary Restriction" readonly
                    name="dietary_restriction">
                <label><span class="border-info ps-3">Dietary Restriction</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
                <input type="text" class="form-control border border-info" placeholder="Explanation" readonly
                    name="explanation">
                <label><span class="border-info ps-3">Explanation</span></label>
            </div>


            <div class="d-md-flex align-items-center">
                <div class="mt-3 mt-md-0 d-content cursor-pointer" style="display: contents;">
                    <input type="submit" value="{{ $head['headerTitle1'] }}" class="btn btn-info font-medium w-100 px-4"
                    id="submitButton">
                </div>
            </div>
        </form>
        @endforeach

        {!!
        $pupilData['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links()
        !!}

        @else
        <div class="alert alert-warning" role="alert">
            No search result. Do search for pupil with lrn to add to your masterlist
        </div>
        @endif
        @endif
        @include('validator/form-validator')
    </div>
</div>
