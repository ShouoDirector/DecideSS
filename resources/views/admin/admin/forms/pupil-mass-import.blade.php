<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <form method="post" action="{{ route('admin.admin.mass_pupil_insert') }}" id="massInsertPupilForm">
            {{ csrf_field() }}
            <div class="card d-flex" id="pupilDetailsDiv">
            <h5>Mass Insertion of Potential Users</h5>
            <p class="card-subtitle mb-3 mt-3">
                Below are potential pupils you are going to mass insert. LRNs that are existed in the database will be skipped.
            </p>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-primary rounded-0 m-1" onclick="clearAllPupilData()">Clear All Pupil Data</button>
                <button type="button" onclick="submitAllPupils()" class="btn btn-primary px-5 rounded-0 m-1">Insert All
                <i class="ti ti-send fs-3"></i>
            </button>
            </div>
        </form>
    </div>
</div>