<div class="offcanvas offcanvas-end d-flex align-items-center justify-content-center" tabindex="-1" id="offcanvasRight2"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header align-self-end">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="col-12 card position-relative overflow-hidden">
        <div class="card-body">
            <h5>{{ $head['headerTitle2'] }}</h5>
            <p class="card-subtitle mb-3 mt-3">
                {{ $head['headerMessage2'] }}
            </p>
            <form class="" method="post" action="" id="userForm">
                {{ csrf_field() }}
                <div class="form-floating mb-3">
                    <input type="text" name="district" class="form-control border border-info" placeholder="School Name"
                        required />
                    <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">School</span></label>
                </div>
                <div class="mb-3">
                    <select class="form-control form-select border border-info p-3 select2" name="medical_officer_email"
                        id="userTypeSelect">
                        <option value="#" selected disabled>Select District It Belongs</option>
                        @if(isset($dataDistrict['getList']) && !empty($dataDistrict['getList']))
                        @foreach($dataDistrict['getList'] as $district)
                        <option value="{{ $district->district }}">{{ $district->district }}</option>
                        @endforeach
                        @else
                        <option value="#" disabled>No District available</option>
                        @endif
                    </select>

                    <div id="validationMessage" class="text-danger"></div>
                </div>
                <div class="mb-3">
                    <select class="form-control form-select border border-info p-3 select2" name="medical_officer_email"
                        id="userTypeSelect">
                        <option value="#" selected disabled>Assign School Nurse</option>
                        @if(isset($dataSchoolNurse['getList']) && !empty($dataSchoolNurse['getList']))
                        @foreach($dataSchoolNurse['getList'] as $schoolnurse)
                        <option value="{{ $schoolnurse->email }}">{{ $schoolnurse->email }}</option>
                        @endforeach
                        @else
                        <option value="#" disabled>No School Nurse available</option>
                        @endif
                    </select>

                    <div id="validationMessage" class="text-danger"></div>
                </div>

                <div class="d-md-flex align-items-center">
                    <div class="mt-3 mt-md-0 d-content" style="display: contents;">
                        <input type="submit" value="Submit" class="btn btn-info font-medium w-100 px-4"
                            id="submitButton">
                    </div>
                </div>
            </form>

            @include('validator/form-validator')

        </div>
    </div>
</div>
