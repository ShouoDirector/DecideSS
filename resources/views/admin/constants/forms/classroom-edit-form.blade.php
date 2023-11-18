<form class="" method="post" action="{{ route('admin.constants.classroom_update', ['id' => $data['getRecord']->id]) }}" id="userForm">
    {{ csrf_field() }}

    <div class="form-floating mb-3">
        <select class="form-control form-select border border-info p-3 select2" name="school_id" id="schoolSelect">
            <option value="#" selected disabled>Select School</option>
            @if(isset($dataSchools['getList']) && !$dataSchools['getList']->isEmpty())
                @foreach($dataSchools['getList'] as $school)
                    <option value="{{ $school->id }}" {{ old('school_id', $data['getRecord']->school_id) == $school->id ? 'selected' : '' }}>{{ $school->school }}</option>
                @endforeach
            @else
                <option value="#" disabled>No Schools available</option>
            @endif
        </select>
    </div>
    
    <div class="form-floating mb-3">
        <input type="text" name="section" value="{{ old('section', $data['getRecord']->section) }}"
            class="form-control border border-info" placeholder="Classroom Name" required />
        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">Section</span></label>
    </div>

    <div class="mb-3">
        <select class="form-control form-select border border-info p-3 select2" name="classadviser_id" id="userTypeSelect">
            @php
                $selectedClassAdviserEmail = null;
                foreach($dataClassAdvisers['getList'] as $user) {
                    if($user->id == $data['getRecord']->classadviser_id) {
                        $selectedClassAdviserEmail = $user->email;
                        break;
                    }
                }
            @endphp

            @forelse($dataClassAdvisers['getList'] as $classAdviser)
                <option value="{{ $classAdviser->id }}" {{ old('classadviser_id', $data['getRecord']->classadviser_id) == $classAdviser->id ? 'selected' : '' }}>
                    {{ $classAdviser->email }}
                </option>
            @empty
                <option value="#" disabled>No Class Adviser available</option>
            @endforelse
        </select>

        <div id="validationMessage" class="text-danger"></div>
    </div>

    <div class="mb-3">
        <select class="form-control form-select border border-info p-3" name="grade_level" id="userTypeSelect">
            <option value="" disabled>Choose Grade Level</option>
            <option value="Kinder" {{ $data['getRecord']->grade_level == 'Kinder' ? 'selected' : '' }}>Kinder
            </option>
            <option value="1" {{ $data['getRecord']->grade_level == '1' ? 'selected' : '' }}>Grade 1
            </option>
            <option value="2" {{ $data['getRecord']->grade_level == '2' ? 'selected' : '' }}>Grade 2
            </option>
            <option value="3" {{ $data['getRecord']->grade_level == '3' ? 'selected' : '' }}>Grade 3
            </option>
            <option value="4" {{ $data['getRecord']->grade_level == '4' ? 'selected' : '' }}>Grade 4
            </option>
            <option value="5" {{ $data['getRecord']->grade_level == '5' ? 'selected' : '' }}>Grade 5
            </option>
            <option value="6" {{ $data['getRecord']->grade_level == '6' ? 'selected' : '' }}>Grade 6
            </option>
            <option value="SPED" {{ $data['getRecord']->grade_level == 'SPED' ? 'selected' : '' }}>SPED
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
