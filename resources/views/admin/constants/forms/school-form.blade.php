<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerMessage1'] }}
        </p>
        <form class="" method="post" action="{{ route('school.add') }}" id="userForm">
            {{ csrf_field() }}
            <div class="form-floating mb-3">
                <input type="text" name="school" class="form-control border border-info" placeholder="School Name"
                    required />
                <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                        class="border-start border-info ps-3">School</span></label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="school_id" class="form-control border border-info" placeholder="School ID"
                    required />
                <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">School
                        ID</span></label>
            </div>
            <div class="mb-3">
                <select class="form-control form-select border border-info p-3 select2" name="district_id"
                    id="userTypeSelect">
                    <option value="#" selected disabled>Select District It Belongs</option>
                    @if(isset($dataDistrict['getList']) && !empty($dataDistrict['getList']))
                    @foreach($dataDistrict['getList'] as $district)
                    <option value="{{ $district->id }}">{{ $district->district }}</option>
                    @endforeach
                    @else
                    <option value="#" disabled>No School available</option>
                    @endif
                </select>

                <div id="validationMessage" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <select class="form-control form-select border border-info p-3 select2" name="school_nurse_id"
                    id="userTypeSelect">
                    <option value="#" selected disabled>Assign Available School Nurse</option>
                    @if(isset($availableSchoolNurses) && !empty($availableSchoolNurses))
                    @foreach($availableSchoolNurses as $schoolnurse)
                    <option value="{{ $schoolnurse->id }}">{{ $schoolnurse->email }}</option>
                    @endforeach
                    @else
                    <option value="#" disabled>No School Nurse available</option>
                    @endif
                </select>

                <div id="validationMessage" class="text-danger"></div>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="address_barangay" class="form-control border border-info"
                    placeholder="Barangay" />
                <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                        class="border-start border-info ps-3">Barangay</span></label>
                        {{ $head['skipMessage'] }}
            </div>

            <div class="d-md-flex align-items-center">
                <div class="mt-3 mt-md-0 d-content" style="display: contents;">
                    <input type="submit" value="Submit" class="btn btn-info font-medium w-100 px-4" id="submitButton">
                </div>
            </div>
        </form>

        @include('validator/form-validator')

    </div>
