<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerMessage1'] }}
        </p>

        <form class="d-flex row" method="post" data-insert-route="{{ route('pupils.add') }}" id="insertUserForm">
            {{ csrf_field() }}
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="text" name="lrn" class="form-control border border-info" placeholder="LRN" required />
                <label><span
                        class="border-info ps-3">LRN</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="text" name="last_name" class="form-control border border-info" placeholder="Last Name" required />
                <label><span
                        class="border-info ps-3">Last Name</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="text" name="first_name" class="form-control border border-info" placeholder="First Name" required />
                <label><span
                        class="border-info ps-3">First Name</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="text" name="middle_name" class="form-control border border-info" placeholder="Middle Name" required />
                <label><span
                        class="border-info ps-3">Middle Name</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="text" name="suffix" class="form-control border border-info" placeholder="Suffix"/>
                <label><span
                        class="border-info ps-3">Suffix</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="date" name="date_of_birth" class="form-control border border-info" placeholder="Birth Date" required />
                <label><span
                        class="border-info ps-3">Date of Birth</span></label>
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
                <input type="text" name="barangay" class="form-control border border-info" placeholder="barangay" />
                <label><span
                        class="border-info ps-3">Barangay</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="text" name="municipality" class="form-control border border-info" placeholder="municipality" />
                <label><span
                        class="border-info ps-3">Municipality/City</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="text" name="province" class="form-control border border-info" placeholder="province" />
                <label><span
                        class="border-info ps-3">Province</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="text" name="pupil_guardian_name" class="form-control border border-info" placeholder="Guardian Name" />
                <label><span
                        class="border-info ps-3">Guardian Name</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="text" name="pupil_guardian_contact_no" class="form-control border border-info" placeholder="Guardian Phone Number" />
                <label><span
                        class="border-info ps-3">Guardian Phone Number</span></label>
            </div>

            <div class="d-md-flex align-items-center">
                <div class="mt-3 mt-md-0 d-content cursor-pointer" style="display: contents;">
                    <input type="submit" value="{{ $head['headerTitle1'] }}" class="btn btn-info font-medium w-100 px-4"
                    id="submitButton">
                </div>
            </div>
        </form>
        @include('validator/form-validator')
    </div>
</div>
