<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <form method="post" action="{{ route('admin.admin.mass_user_insert') }}" id="massInsertForm">
            {{ csrf_field() }}
            <div class="card d-flex" id="userDetailsDiv">
            <h5>Mass Insertion of Potential Users</h5>
            <p class="card-subtitle mb-3 mt-3">
                Below are potential users you are going to mass insert. Rows with emails that are existed in the database will be skipped.
            </p>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-outline-primary rounded-0 m-1" onclick="clearAllUserData()">Clear All User Data</button>
                <button type="button" onclick="submitAllUsers()" class="btn btn-primary px-5 rounded-0 m-1">Insert All
                <i class="ti ti-send fs-3"></i>
            </button>
            </div>
        </form>
    </div>
</div>