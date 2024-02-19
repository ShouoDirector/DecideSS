<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerMessage1'] }}
        </p>

        <div id="addPupilDiv">
            <form class="d-flex row" id="addPupilForm">
                {{ csrf_field() }}
                <div class="form-floating mb-3 col-12">
                <input type="text" 
                        name="lrn" 
                        id="lrn"
                        class="form-control border border-info"
                        placeholder="LRN" 
                        required 
                        pattern="[0-9]{12}"
                        minlength="12"
                        maxlength="12"
                        title="LRN must be exactly 12 digits and contain only numbers" />
                    <label class="mx-2 d-flex align-items-center"><i class="ti ti-user me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">LRN*</span></label>
                </div>
                <div class="form-floating mb-3 col-6">
                    <input type="text" name="first_name" id="firstName" class="form-control border border-info"
                        placeholder="Name" required />
                    <label class="mx-2 d-flex align-items-center"><i class="ti ti-user me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">First Name*</span></label>
                </div>
                <div class="form-floating mb-3 col-6">
                    <input type="text" name="last_name" id="lastName" class="form-control border border-info"
                        placeholder="Name" required />
                    <label class="mx-2 d-flex align-items-center"><i class="ti ti-user me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">Last Name*</span></label>
                </div>
                <div class="form-floating mb-3 col-6">
                    <input type="text" name="middle_name" id="middleName" class="form-control border border-info"
                        placeholder="Name"/>
                    <label class="mx-2 d-flex align-items-center"><i class="ti ti-user me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">Middle Name</span></label>
                </div>
                <div class="form-floating mb-3 col-6">
                    <input type="text" name="suffix" id="suffix" class="form-control border border-info"
                        placeholder="Name"/>
                    <label class="mx-2 d-flex align-items-center"><i class="ti ti-user me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">Suffix</span></label>
                </div>
                <div class="form-floating mb-3 col-12">
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control border border-info"
                        placeholder="Date of Birth" required/>
                    <label class="mx-2 d-flex align-items-center"><i class="ti ti-user me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">Date of Birth</span></label>
                </div>

                <div class="mb-3 col-12">
                    <select class="form-control form-select border border-info p-3" name="gender"
                        id="gender">
                        <option value="NULL" selected disabled>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="d-flex row justify-content-end m-0 p-0">
                    <div class="d-md-flex align-items-center">
                        <div class="mt-3 mt-md-0 d-content" style="display: contents;">
                            <button type="button" onclick="submitPupilForm()"
                                class="btn btn-primary font-medium w-100 rounded-pill">Add Pupil To Rows</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
