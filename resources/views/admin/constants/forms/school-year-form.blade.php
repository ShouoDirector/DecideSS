<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerMessage1'] }}
        </p>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerNote'] }}
        </p>
        <form class="" method="post"
            action="{{ route('school_year.add') }}"
            id="userForm">
            {{ csrf_field() }}

            <div class="form-floating mb-3">
                <input type="text" name="school_year" value="{{ $schoolYear }}"
                    class="form-control border border-info" placeholder="School Year" required />
                <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">School
                        Year</span></label>
            </div>

            <div class="mb-3">
                <select class="form-control form-select border border-info p-3 select2" name="status"
                    id="userTypeSelect">
                    <option selected disabled>Select Status</option>
                    <option value="Unset">
                        Unset
                    </option>
                    <option value="Active">
                        Active
                    </option>
                </select>
                <div id="validationMessage" class="text-danger"></div>
            </div>

            <div class="d-md-flex align-items-center">
                <div class="mt-3 mt-md-0 w-100">
                    <input type="submit" value="{{ $head['headerTitle1'] }}" class="btn btn-info font-medium w-100"
                        id="submitButton">
                </div>
            </div>

        </form>
    </div>
</div>
