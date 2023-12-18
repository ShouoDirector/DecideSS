<form class="" method="post" action="{{ route('admin.constants.section_update', ['id' => $data['getSectionRecord']->id]) }}" id="userForm">
    {{ csrf_field() }}

    <div class="form-floating mb-3">
        <input type="text" value="{{ old('school_id', $schoolNames[$data['getSectionRecord']->school_id]) }}"
            class="form-control border-0" placeholder="School ID" required readonly/>
        <label><span class="">School</span></label>
    </div>

    <div class="form-floating mb-3 hidden">
        <input type="text" name="school_id" value="{{ old('school_id', $data['getSectionRecord']->school_id) }}"
            class="form-control border-0" placeholder="School ID" required readonly/>
        <label><span class="">School</span></label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" name="section_name" value="{{ old('section_name', $data['getSectionRecord']->section_name) }}"
            class="form-control border border-info" placeholder="Section Name" required />
        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">Section Name</span></label>
    </div>

    <div class="mb-3">
        <select class="form-control form-select border border-info p-3" name="grade_level" id="userTypeSelect">
            <option value="" disabled>Choose Grade Level</option>
            <option value="Kinder" {{ $data['getSectionRecord']->grade_level == 'Kinder' ? 'selected' : '' }}>Kinder
            </option>
            <option value="1" {{ $data['getSectionRecord']->grade_level == '1' ? 'selected' : '' }}>Grade 1
            </option>
            <option value="2" {{ $data['getSectionRecord']->grade_level == '2' ? 'selected' : '' }}>Grade 2
            </option>
            <option value="3" {{ $data['getSectionRecord']->grade_level == '3' ? 'selected' : '' }}>Grade 3
            </option>
            <option value="4" {{ $data['getSectionRecord']->grade_level == '4' ? 'selected' : '' }}>Grade 4
            </option>
            <option value="5" {{ $data['getSectionRecord']->grade_level == '5' ? 'selected' : '' }}>Grade 5
            </option>
            <option value="6" {{ $data['getSectionRecord']->grade_level == '6' ? 'selected' : '' }}>Grade 6
            </option>
            <option value="SPED" {{ $data['getSectionRecord']->grade_level == 'SPED' ? 'selected' : '' }}>SPED
            </option>
        </select>
    </div>

    <div class="d-md-flex align-items-center">
        <div class="mt-3 mt-md-0 w-100">
            <input type="submit" value="{{ $head['headerTitle'] }}" class="btn btn-info font-medium w-100"
                id="submitButton">
        </div>
    </div>

</form>
