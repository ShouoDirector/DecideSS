<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">

        <form method="post" action="{{ route('admin.admin.mass_masterlist_insert') }}" id="massInsertMasterListForm">
            {{ csrf_field() }}
            <div class="card d-flex" id="pupilMasterlistDetailsDiv">
                <h5>Mass Insertion of Pupils To MasterList</h5>
                <p class="card-subtitle mb-3 mt-3">
                    Below are potential pupils you are going to mass insert in the masterlist. Pupils that are already
                    added in the masterlist will be skipped.
                </p>
            </div>

            <input type="text" name="schoolId" class="form-control border border-info d-none" value="{{ $schoolId }}"
                required>
            <input type="text" name="districtId" class="form-control border border-info d-none"
                value="{{ $districtId }}" required>
            <input type="text" name="sectionId" class="form-control border border-info d-none" value="{{ $sectionId }}"
                required>
            <input type="text" name="classId" class="form-control border border-info d-none" value="{{ $classId }}"
                required>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-primary rounded-0 m-1"
                    onclick="clearAllMasterListData()">Clear All Pupil Data</button>
                <button type="button" onclick="submitAllMasterListEntries()"
                    class="btn btn-primary px-5 rounded-0 m-1">Insert All
                    <i class="ti ti-send fs-3"></i>
                </button>
            </div>
        </form>
    </div>
</div>
