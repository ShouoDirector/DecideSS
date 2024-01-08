<div class="col-12 card position-relative overflow-hidden shadow-none">
    <div class="card-body shadow-none px-0">
        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            <b>Important Notice : </b>{{ $head['headerMessage2'] }}
        </p>

        <div class="f-flex row col-12 border-none gap-1 justify-content-end mb-3">
            @if($activeSchoolYear['getRecord']->isNotEmpty())
            <form class="d-flex row col-12 border-none gap-2 mb-3 justify-content-end m-0"
                action="{{ route('class_adviser.class_adviser.pupils') }}">
                <div class="d-flex row col-lg-4 col-md-6 col-sm-8 border-none">
                <input type="search"
                    class="form-control col-lg-3 col-md-4 col-sm-6 col-12
                            @if(count($pupilData['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty() &&
                                !empty(Request::get('search'))) is-invalid
                            @else
                                @if(!empty(Request::get('search'))) is-valid
                                @endif
                            @endif"
                    id="inputHorizontalDanger"
                    placeholder="Input Pupil's LRN If Exist"
                    value="{{ Request::get('search') }}"
                    name="search"
                    pattern="[0-9]{12}"
                    minlength="12"
                    maxlength="12"
                    title="LRN must be exactly 12 digits and contain only numbers">

                    @if(count($pupilData['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty() &&
                    !empty(Request::get('search')))
                    <div class="invalid-feedback">
                        The pupil is already exists in lists.
                    </div>
                    @else
                    @if(!empty(Request::get('search')))
                    <div class="valid-feedback">
                        You can add this pupil.
                    </div>
                    @endif
                    @endif
                </div>
                <button type="submit" class="col-auto btn btn-info font-medium px-4" style="height: min-content;">
                    Check
                </button>
            </form>
            @endif

            <form class="d-flex row" method="post" data-insert-route="{{ route('pupils.add') }}" id="insertUserForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" 
                        name="lrn" 
                        value="@if(count($pupilData['getList']) == 0) {{ Request::get('search') }} @else @endif"
                        class="form-control border border-info bg-light-primary cursor-default"
                        placeholder="LRN" 
                        required 
                        readonly
                        pattern="[0-9]{12}"
                        minlength="12"
                        maxlength="12"
                        title="LRN must be exactly 12 digits and contain only numbers" />
                    <label><span class="border-info ps-3">LRN (12 characters)</span></label>
                </div>

                                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" name="last_name" class="form-control border border-info" placeholder="Last Name"
                        required />
                    <label><span class="border-info ps-3">Last Name*</span></label>
                </div>
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" name="first_name" class="form-control border border-info"
                        placeholder="First Name" required />
                    <label><span class="border-info ps-3">First Name*</span></label>
                </div>
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" name="middle_name" class="form-control border border-info"
                        placeholder="Middle Name" required />
                    <label><span class="border-info ps-3">Middle Name*</span></label>
                </div>
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" name="suffix" class="form-control border border-info" placeholder="Suffix" />
                    <label><span class="border-info ps-3">Suffix</span></label>
                </div>
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="date" name="date_of_birth" class="form-control border border-info"
                        placeholder="Birth Date" required />
                    <label><span class="border-info ps-3">Date of Birth*</span></label>
                </div>
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <select class="form-control form-select border border-info p-3" name="gender" id="userTypeSelect">
                        <option value="#" selected disabled>Choose Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <div id="validationMessage" class="text-danger"></div>
                </div>
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" name="barangay" class="form-control border border-info" placeholder="barangay"
                        required />
                    <label><span class="border-info ps-3">Barangay*</span></label>
                </div>
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" name="municipality" class="form-control border border-info"
                        placeholder="municipality" required />
                    <label><span class="border-info ps-3">Municipality/City*</span></label>
                </div>
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" name="province" class="form-control border border-info" placeholder="province"
                        required />
                    <label><span class="border-info ps-3">Province*</span></label>
                </div>
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" name="pupil_guardian_name" class="form-control border border-info"
                        placeholder="Guardian Name" required />
                    <label><span class="border-info ps-3">Guardian Name*</span></label>
                </div>
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                    <input type="text" name="pupil_guardian_contact_no" class="form-control border border-info"
                        placeholder="Guardian Phone Number" required maxlength="11" />
                    <label><span class="border-info ps-3">Guardian Phone Number*</span></label>
                </div>
                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input primary check-outline outline-primary" type="radio"
                            name="add_to_masterlist" id="primary2-outline-radio" value="1" >
                        <label class="form-check-label" for="primary2-outline-radio">Add Now To Your Masterlist</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input primary check-outline outline-primary" type="radio"
                            name="add_to_masterlist" id="primary-outline-radio" value="0" checked="">
                        <label class="form-check-label" for="primary-outline-radio">No</label>
                    </div>
                </div>
                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                    <input type="number" name="class_id" value="{{ $firstRecord->id }}" class="form-control border border-info" placeholder="CLass Id"
                        required/>
                    <label><span class="border-info ps-3">Class ID</span></label>
                </div>

                <div class="form-floating mb-3 col-lg-4 col-md-6 col-12 hidden">
                    <input type="number" name="schoolyear_id" value="{{ $activeSchoolYear['getRecord'][0]->id}}" class="form-control border border-info" placeholder="CLass Id"
                        required/>
                    <label><span class="border-info ps-3">SchoolYear ID</span></label>
                </div>
                <div class="form-floating mb-3 col-12 mt-3">
                    <input class="form-control" type="file" name="profile_photo" accept="image/*" id="formFile">
                </div>

                <div class="d-flex justify-content-end align-items-center">
                    <div class="mt-3 mt-md-0 d-content cursor-pointer col-lg-4 col-md-6 col-12">
                        <button type="button" class="btn btn-info font-medium w-100 px-4" id="submitButton"
                            data-bs-toggle="modal" data-bs-target="#add-pupils-modal">
                            Submit
                        </button>
                    </div>
                </div>

                @include('class_adviser.class_adviser.modals.add-pupil')
            </form>
            @include('validator/form-validator')
        </div>
    </div>
