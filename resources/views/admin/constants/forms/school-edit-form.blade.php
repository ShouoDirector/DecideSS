<form class="" method="post" action="{{ route('admin.constants.school-update', ['id' => $data['getSchoolRecord']->id]) }}" id="userForm">
    {{ csrf_field() }}
    <div class="form-floating mb-3">
        <input type="text" name="school" value="{{ old('school', $data['getSchoolRecord']->school) }}"
            class="form-control border border-info" placeholder="School Name" required />
        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">School
                Name</span></label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" name="school_id" value="{{ old('school_id', $data['getSchoolRecord']->school_id) }}"
            class="form-control border border-info" placeholder="School ID" required />
        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">School
                ID</span></label>
    </div>

    <div class="mb-3">
        <select class="form-control form-select border border-info p-3 select2" name="school_nurse_id" id="userTypeSelect">
            @php
                $selectedNurseEmail = null;
                foreach($dataUsers['getRecord'] as $user) {
                    if($user->id == $data['getSchoolRecord']->school_nurse_id) {
                        $selectedNurseEmail = $user->email;
                        break;
                    }
                }
            @endphp
            <option value="{{ $data['getSchoolRecord']->school_nurse_id }}" selected>
                {{ $selectedNurseEmail ? $selectedNurseEmail : 'Replace School Nurse?' }}
            </option>
            @forelse($availableSchoolNurses as $schoolnurse)
                <option value="{{ $schoolnurse->id }}" {{ old('school_nurse_id') == $schoolnurse->id ? 'selected' : '' }}>
                    {{ $schoolnurse->email }}
                </option>
            @empty
                <option value="#" disabled>No School Nurse available</option>
            @endforelse
        </select>

        <div id="validationMessage" class="text-danger"></div>
    </div>


    <div class="mb-3">
        <select class="form-control form-select border border-info p-3 select2 selectpicker" 
        data-live-search="true" name="district_id" id="userTypeSelect">
            <option value="#" selected disabled>Change the District</option>
            @forelse($schoolDistrictNames as $districtId => $districtName)
                <option value="{{ $districtId }}"
                    {{ (old('district_id') ?? $data['getSchoolRecord']->district_id) == $districtId ? 'selected' : '' }}>
                    {{ $districtName }}
                </option>
            @empty
                <option value="#" disabled>No District available</option>
            @endforelse
        </select>

        <div id="validationMessage" class="text-danger"></div>
    </div>

    <div class="form-floating mb-3">
        <input type="text" name="address_barangay"
            value="{{ old('address_barangay', $data['getSchoolRecord']->address_barangay) }}"
            class="form-control border border-info" placeholder="Barangay" />
        <label><i class="ti ti-user me-2 fs-4 text-info"></i>
        <span class="border-start border-info ps-3">Barangay</span></label>
    </div>

    <div class="d-md-flex align-items-center">
        <div class="mt-3 mt-md-0 w-100">
            <input type="submit" value="{{ $head['headerTitle'] }}" class="btn btn-info font-medium w-100"
                id="submitButton">
        </div>
    </div>

</form>
