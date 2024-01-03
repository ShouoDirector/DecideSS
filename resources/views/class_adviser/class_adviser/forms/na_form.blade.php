<div class="col-12 card position-relative overflow-hidden shadow-none">
    <div class="card-body px-0">
        <h5>{{ $head['headerTitle1'] }}</h5>

        <div class="f-flex row col-12 gap-1 justify-content-end mb-3">
            <form class="d-flex row col-12 justify-content-end" action="{{ route('class_adviser.class_adviser.nutritional_assessment') }}">
                <div class="col-lg-3 col-md-4 col-sm-6 py-1">
                    <input type="search" class="col-lg-3 col-md-4 col-sm-6 col-12 form-control border-dark" id="text-srh"
                        name="search" value="{{ Request::get('search') }}" placeholder="Search Pupil with LRN">
                </div>
                <button type="submit" class="col-auto btn btn-info font-medium px-4 my-1">
                    Search
                </button>
            </form>
            @if(count($pupilData['getList']) !== 0)
            @if(!empty(Request::get('search')))
            <a href="{{ route('class_adviser.class_adviser.nutritional_assessment') }}"
                class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4 my-2">
                <i class="ti ti-square-minus me-2 fs-4 fw-semibold"></i>
                Clear Result
            </a>
            @endif
            @endif
        </div>
        @if(count($pupilData['getList']) !== 0)
        @if(!empty(Request::get('search')))
        @foreach($pupilData['getList'] as $pupil)
        <form class="d-flex row justify-content-center" method="post" data-insert-route="{{ route('class_adviser.class_adviser.nutritional_assessment.add') }}" id="insertUserForm">
            {{ csrf_field() }}

            <div class="d-flex row col-md-6 col-12 px-4 mt-3">
                <div class="d-flex align-items-center justify-content-center form-floating mb-3 col-12">
                    <i class="fs-5 ti ti-brand-codesandbox"></i>
                    <input type="text" name="pna_code" class="form-control border-0" placeholder="PNA CODE" 
                        value="{{ Auth::user()->id }}-{{ $filteredRecords->first()->school_id }}-{{ 
                            $filteredRecords->first()->grade_level == 'Kinder' ? 'K' : (
                            $filteredRecords->first()->grade_level == 'SPED' ? 'S' :
                            $filteredRecords->first()->grade_level)
                            }}-{{ $dataPupilLRNs[$pupil->pupil_id] }}" required readonly/>
                    <label class="ms-3"><span class="border-info ps-3 fw-semibold">PNA CODE</span></label>
                </div>
                <div class="form-floating mb-3 col-12 hidden border-0">
                    <i class="fs-5 ti ti-brand-codesandbox"></i>
                    <input type="text" class="form-control border-0" placeholder="ID" readonly
                        value="{{ $pupil->pupil_id }}" name="pupil_id" required>
                    <label class="ms-3"><span class="border-info ps-3">ID</span></label>
                </div>
                <div class="d-flex align-items-center form-floating mb-3 col-12 border-0">
                    <i class="fs-5 ti ti-user"></i>
                    <input type="text" class="form-control border-0" placeholder="Name" readonly
                        value="{{ $dataPupilNames[$pupil->pupil_id] }}">
                    <label class="ms-3"><span class="border-info ps-3 fw-semibold">Name</span></label>
                </div>
                <div class="d-flex align-items-center form-floating mb-3 col-12 border-0">
                    <i class="fs-5 ti ti-id"></i>
                    <input type="text" class="form-control border-0" placeholder="LRN" readonly
                        value="{{ $dataPupilLRNs[$pupil->pupil_id] }}">
                    <label class="ms-3"><span class="border-info ps-3 fw-semibold">LRN</span></label>
                </div>
                <div class="form-floating mb-3 col-6">
                    <input type="number" class="form-control border border-info" placeholder="Height" name="height" step="0.01" min="0" max="3" required>
                    <label for="height"><span class="border-info ps-3 fw-semibold">Height (m)</span></label>
                    <small id="heightHelp" class="form-text text-muted">Enter the height in meters (m), e.g., 1.75</small>
                </div>

                <div class="form-floating mb-3 col-6">
                    <input type="number" class="form-control border border-info" placeholder="Weight" name="weight" step="0.1" min="0" max="500" required>
                    <label for="weight"><span class="border-info ps-3 fw-semibold">Weight (kg)</span></label>
                    <small id="weightHelp" class="form-text text-muted">Enter the weight in kilograms (kg), e.g., 65.5</small>
                </div>
            </div>

            <div class="d-flex row col-md-6 col-12 px-4 mt-3">
                <div class="d-flex row">
                    <div class="mb-3 col-6">
                        <label for="is_dewormed" class="fw-semibold">Has been Dewormed?</label>
                        <select class="form-select" id="is_dewormed" name="is_dewormed">
                            <option value="1">Yes</option>
                            <option value="0" selected>No</option>
                        </select>
                    </div>

                    <div class="form-floating mb-3 col-6" id="dewormedDateContainer">
                        <input type="date" name="dewormed_date" class="form-control border border-info" placeholder="Dewormed Date" />
                        <label><span
                                class="border-info ps-3 fw-semibold">If yes, Dewormed Date</span></label>
                    </div>
                </div>
                <div class="d-flex row">
                    <div class="mb-3 col-12">
                        <label for="is_permitted_deworming" class="fw-semibold">Permitted for potential Deworming? Parental Permission</label>
                        <select class="form-select border border-info" id="is_permitted_deworming" name="is_permitted_deworming">
                            <option selected>Undecided</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex row">
                    <div class="form-floating mb-3 col-12">
                        <textarea class="form-control border border-info" placeholder="Dietary Restriction" name="dietary_restriction"></textarea>
                        <label for="dietary_restriction"><span class="border-info ps-3 fw-semibold">
                            Dietary Restriction/s</span></label>
                        <small id="dietaryRestrictionHelp" class="form-text text-muted">
                            Specify any dietary restrictions, e.g., Allergies, Vegetarian, Gluten-Free...</small>
                    </div>
                </div>

                <div class="d-flex row">
                    <div class="form-floating mb-3 col-12">
                        <textarea class="form-control border border-info" placeholder="Observation/Notes" name="explanation"></textarea>
                        <label for="explanation"><span class="border-info ps-3 fw-semibold">Observation / Notes</span></label>
                        <small id="explanationHelp" class="form-text text-muted">Provide an explanation or additional information if needed.</small>
                    </div>
                </div>

                <div class="d-flex row align-items-center">
                    <div class="mb-3 col-12 cursor-pointer">
                        <button type="button" class="btn btn-info font-medium w-100 px-4"
                        id="submitButton" data-bs-toggle="modal" data-bs-target="#add-na-modal">
                        {{ $head['headerTitle1'] }}
                        </button>
                    </div>
                </div>

                @include('class_adviser.class_adviser.modals.na')

            </div>
        </form>
        @endforeach

        {!!
        $pupilData['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links()
        !!}

        @else
        
        @endif
        @endif

        @include('validator/form-validator')
    </div>
</div>
