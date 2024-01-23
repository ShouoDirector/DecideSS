<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerMessage1'] }}
        </p>

        <div id="addUserDiv">
            <form class="d-flex row" id="addUserForm">
                {{ csrf_field() }}
                <div class="form-floating mb-3 col-12">
                    <input type="text" name="name" id="userName" class="form-control border border-info"
                        placeholder="Name" required />
                    <label class="mx-2 d-flex align-items-center"><i class="ti ti-user me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">Name*</span></label>
                </div>
                <div class="form-floating mb-3 col-12">
                    <input type="text" name="email" id="userEmail" class="form-control border border-info"
                        placeholder="Email" required />
                    <label class="mx-2 d-flex align-items-center"><i class="ti ti-mail me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">Email
                            Address*</span></label>
                </div>
                <div class="mb-3 col-12">
                    <select class="form-control form-select border border-info p-3" name="user_type"
                        id="userTypeSelect">
                        <option value="2">Medical Officer</option>
                        <option value="3">School Nurse</option>
                        <option value="4" selected>Class Adviser</option>
                    </select>
                    <div id="validationMessage" class="text-danger"></div>
                </div>

                <div class="form-floating mb-3 col-12">
                    <div class="form-floating mb-0 col-12">
                        <input type="password" id="userPassword" name="password" class="form-control border border-info"
                            placeholder="Password" required
                            pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])[A-Za-z0-9!@#$%^&*()_+]{8,}$"
                            title="Password must be at least 8 characters, 1 number, 1 capital letter, and 1 special character" />

                        <label class="mx-0 d-flex align-items-center"><i
                                class="ti ti-lock me-2 fs-4 text-info"></i><span
                                class="border-start border-info ps-3">Password</span></label>
                    </div>
                    <small class="form-text text-muted">Password must be at least 8 characters, 1 number, 1 capital
                        letter, and 1 special character*</small>
                    <button type="button" id="togglePasswordBtn" onclick="togglePasswordVisibility()"
                            class="btn position-relative border-0" style="float: right; bottom: 65px;"><i class="ti ti-eye fs-5"></i></button>
                    
                </div>

                <div class="d-flex row justify-content-end m-0 p-0">
                    <div class="d-md-flex align-items-center">
                        <div class="mt-3 mt-md-0 d-content" style="display: contents;">
                            <button type="button" onclick="submitUserForm()"
                                class="btn btn-primary font-medium w-100 rounded-pill">Add User To Rows</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
