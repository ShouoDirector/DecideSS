<form class="d-flex row" method="post" action="{{ route('class_adviser.class_adviser.pupil_update', ['id' => $data['getPupilRecord']->id]) }}" id="userForm">
    {{ csrf_field() }}
    
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="lrn" value="{{ old('lrn',  $data['getPupilRecord']->lrn) }}"
            class="form-control border border-info" placeholder="LRN" required />
        <label></i><span class="ps-3">LRN</span></label>
    </div>
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="last_name" value="{{ old('last_name',  $data['getPupilRecord']->last_name) }}"
            class="form-control border border-info" placeholder="Last Name" required />
        <label></i><span class="ps-3">Last Name</span></label>
    </div>
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="first_name" value="{{ old('first_name',  $data['getPupilRecord']->first_name) }}"
            class="form-control border border-info" placeholder="First Name" required />
        <label></i><span class="ps-3">First Name</span></label>
    </div>
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="middle_name" value="{{ old('middle_name',  $data['getPupilRecord']->middle_name) }}"
            class="form-control border border-info" placeholder="Middle Name" required />
        <label></i><span class="ps-3">Middle Name</span></label>
    </div>
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="suffix" value="{{ old('suffix',  $data['getPupilRecord']->suffix) }}"
            class="form-control border border-info" placeholder="Suffix"/>
        <label></i><span class="ps-3">Suffix</span></label>
    </div>
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth',  $data['getPupilRecord']->date_of_birth) }}"
            class="form-control border border-info" placeholder="Birth Date" required />
        <label></i><span class="ps-3">BirthDate</span></label>
    </div>
    <div class="mb-3 col-lg-3 col-md-6 col-12">
        <select class="form-control form-select border border-info p-3" name="gender" id="userTypeSelect">
            <option value="#" selected disabled>Choose Gender</option>
            <option value="Male" {{ old('gender', $data['getPupilRecord']->gender) === 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('gender', $data['getPupilRecord']->gender) === 'Female' ? 'selected' : '' }}>Female</option>
        </select>
        <div id="validationMessage" class="text-danger"></div>
    </div>
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="barangay" value="{{ old('barangay', $data['getPupilRecord']->barangay) }}" class="form-control border border-info" placeholder="barangay" />
        <label></i><span class="ps-3">Barangay</span></label>
    </div>
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="municipality" value="{{ old('municipality', $data['getPupilRecord']->municipality) }}" class="form-control border border-info" placeholder="municipality" />
        <label></i><span class="ps-3">Municipality/City</span></label>
    </div>
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="province" value="{{ old('province', $data['getPupilRecord']->province) }}" class="form-control border border-info" placeholder="province" />
        <label></i><span class="ps-3">Province</span></label>
    </div>
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="pupil_guardian_name" value="{{ old('pupil_guardian_name', $data['getPupilRecord']->pupil_guardian_name) }}" class="form-control border border-info" placeholder="Guardian Name" />
        <label></i><span class="ps-3">Guardian Name</span></label>
    </div>
    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12">
        <input type="text" name="pupil_guardian_contact_no" value="{{ old('pupil_guardian_contact_no', $data['getPupilRecord']->pupil_guardian_contact_no) }}" class="form-control border border-info" placeholder="Guardian Phone Number" />
        <label></i><span class="ps-3">Guardian Phone Number</span></label>
    </div>

    <div class="d-flex row justify-content-end align-items-center">
        <div class="mt-3 col-lg-3 col-md-6 col-12">
            <input type="submit" value="{{ $head['headerTitle'] }}" class="btn btn-info font-medium w-100"
                >
        </div>
    </div>

</form>
