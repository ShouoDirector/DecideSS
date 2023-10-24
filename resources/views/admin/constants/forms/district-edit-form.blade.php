<form class="" method="post" action="{{ route('admin.constants.district-update', ['id' => $data['getDistrictRecord']->id]) }}" id="userForm">
    {{ csrf_field() }}
    
    <div class="form-floating mb-3">
        <input type="text" name="district" value="{{ old('district', $data['getDistrictRecord']->district) }}"
            class="form-control border border-info" placeholder="School Name" required />
        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">District
                Name</span></label>
    </div>

    <div class="mb-3">
        <select class="form-control form-select border border-info p-3 select2" name="medical_officer_id" id="userTypeSelect">
            @php
                $selectedMedicalOfficerEmail = null;
                foreach($dataUsers['getRecord'] as $user) {
                    if($user->id == $data['getDistrictRecord']->medical_officer_id) {
                        $selectedMedicalOfficerEmail = $user->email;
                        break;
                    }
                }
            @endphp
            <option value="{{ $data['getDistrictRecord']->medical_officer_id }}" selected>
                {{ $selectedMedicalOfficerEmail ? $selectedMedicalOfficerEmail : 'Replace Medical Officer?' }}
            </option>
            @forelse($availableMedicalOfficers as $medicalOfficer)
                <option value="{{ $medicalOfficer->id }}" {{ old('medical_officer_id') == $medicalOfficer->id ? 'selected' : '' }}>
                    {{ $medicalOfficer->email }}
                </option>
            @empty
                <option value="#" disabled>No Medical Officer available</option>
            @endforelse
        </select>

        <div id="validationMessage" class="text-danger"></div>
    </div>



    <div class="d-md-flex align-items-center">
        <div class="mt-3 mt-md-0 w-100">
            <input type="submit" value="{{ $head['headerTitle'] }}" class="btn btn-info font-medium w-100"
                id="submitButton">
        </div>
    </div>

</form>
