<form class="" method="post" action="" id="userForm">
    {{ csrf_field() }}
    <div class="form-floating mb-3">
        <input type="text" name="name" class="form-control border border-info" placeholder="Name" required />
        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                class="border-start border-info ps-3">Name</span></label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" name="email" class="form-control border border-info 
                            @if($errors->has('email')) border-danger is-invalid @endif" placeholder="Email" required />
        <label><i class="ti ti-mail me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">Email
                address</span></label>
        <div class="text-danger">{{ $errors->first('email') }}</div>
    </div>
    <div class="mb-3">
        <select class="form-control form-select border border-info p-3" name="user_type" id="userTypeSelect">
            <option value="0" selected disabled>Choose Role</option>
            <option value="2">Medical Officer</option>
            <option value="3">School Nurse</option>
            <option value="4">Class Adviser</option>
        </select>
        <div id="validationMessage" class="text-danger"></div>
    </div>

    <div class="form-floating mb-3">
        <input type="password" name="password" class="form-control border border-info" placeholder="Password"
            required />
        <label><i class="ti ti-lock me-2 fs-4 text-info"></i><span
                class="border-start border-info ps-3">Password</span></label>
    </div>

    <div class="d-md-flex align-items-center">
        <div class="mt-3 mt-md-0 d-content" style="display: contents;">
            <input type="submit" value="{{ $head['OffcanvasTitle']}}" class="btn btn-info font-medium w-100 px-4"
                id="submitButton">
        </div>
    </div>
</form>
