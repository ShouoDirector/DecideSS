<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerMessage1'] }}
        </p>

        <form class="d-flex row" method="post" data-insert-route="{{ route('admin.admin.insert') }}" id="insertUserForm">
            {{ csrf_field() }}
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="text" name="name" class="form-control border border-info" placeholder="Name" required />
                <label class="mx-2 d-flex align-items-center"><i class="ti ti-user me-2 fs-4 text-info"></i><span
                        class="border-start border-info ps-3">Name*</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <input type="email" name="email" class="form-control border border-info" placeholder="Email" required />
                <label class="mx-2 d-flex align-items-center"><i class="ti ti-mail me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">Email
                        Address*</span></label>
            </div>
            <div class="mb-3 col-lg-4 col-md-6 col-12">
                <select class="form-control form-select border border-info p-3" name="user_type" id="userTypeSelect">
                    <option value="0" selected disabled>Choose Role*</option>
                    <option value="2">Medical Officer</option>
                    <option value="3">School Nurse</option>
                    <option value="4">Class Adviser</option>
                </select>
                <div id="validationMessage" class="text-danger"></div>
            </div>

            <div class="form-floating mb-3 col-lg-4 col-md-6 col-12">
                <div class="form-floating mb-0 col-12">
                    <input type="password" name="password" class="form-control border border-info" placeholder="Password"
                        required />
                    <label class="mx-0 d-flex align-items-center"><i class="ti ti-lock me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">Password</span></label>
                </div>
                <small class="form-text text-muted">Password must be at least 8 characters, 1 number, 1 capital letter and 1 special character*</small>
            </div>

            <div class="d-flex row justify-content-end">
                <div class="d-md-flex col-auto align-items-center">
                    <div class="mt-3 mt-md-0 d-content" style="display: contents;">
                        <input type="submit" value="{{ $head['headerTitle1'] }}" class="btn btn-info font-medium w-100 px-4"
                            id="submitButton">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
