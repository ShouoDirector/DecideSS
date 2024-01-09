<form class="" method="post" action="{{ route('admin.constants.school_year_update', ['id' => $data['getSchoolYearRecord']->id]) }}" id="userForm">
    {{ csrf_field() }}
    
    <div class="form-floating mb-3">
        <input type="text" name="school_year" value="{{ old('school_year', $data['getSchoolYearRecord']->school_year) }}"
            class="form-control border border-info" placeholder="School Year" required />
        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">School Year</span></label>
    </div>

    <div class="mb-3">
        <select class="form-control form-select border border-info p-3 select2" name="status" id="statusSelect">
            <option value="Unset" {{ $data['getSchoolYearRecord']->status === 'Unset' ? 'selected' : '' }}>
                Unset
            </option>
            <option value="Active" {{ $data['getSchoolYearRecord']->status === 'Active' ? 'selected' : '' }}>
                Active
            </option>
            <option value="Complete" {{ $data['getSchoolYearRecord']->status === 'Complete' ? 'selected' : '' }}>
                Complete
            </option>
        </select>
        <div id="statusValidationMessage" class="text-danger"></div>
    </div>

    <div class="d-md-flex align-items-center">
        <div class="mt-3 mt-md-0 w-100">
            <input type="submit" value="{{ $head['headerTitle'] }}" class="btn btn-info font-medium w-100"
                id="submitButton">
        </div>
    </div>

</form>
