<div class="offcanvas offcanvas-end d-flex align-items-center justify-content-center" tabindex="-1" id="offcanvasRight"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header align-self-end">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="col-12 card position-relative overflow-hidden">
        <div class="card-body">
            <h5>{{ $head['headerTitle1'] }}</h5>
            <p class="card-subtitle mb-3 mt-3">
                {{ $head['headerMessage1'] }}
            </p>
            <form class="" method="post" action="{{ route('district.add') }}" id="userForm">
                {{ csrf_field() }}
                <div class="form-floating mb-3">
                    <input type="text" name="district" class="form-control border border-info" placeholder="Username"
                        required />
                    <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">District</span></label>
                </div>
                <div class="mb-3">
                    <select class="form-control form-select border border-info p-3 select2" name="medical_officer_id"
                        id="userTypeSelect">
                        <option value="#" selected disabled>Assign Available Medical Officer</option>
                        @if(isset($availableMedicalOfficers) && !empty($availableMedicalOfficers))
                        @foreach($availableMedicalOfficers as $medicalOfficer)
                        <option value="{{ $medicalOfficer->id }}">{{ $medicalOfficer->email }}</option>
                        @endforeach
                        @else
                        <option value="#" disabled>No Medical Officers available</option>
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
