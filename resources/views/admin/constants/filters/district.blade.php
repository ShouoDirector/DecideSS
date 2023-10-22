<div class="col-12 card position-relative overflow-hidden pb-3" id="district">
    <div class="row d-flex justify-content-between card-body pt-4 ps-3">
        <h5 class="col-auto">{{ $head['headerFilter1'] }}</h5>
        <a class="col-auto" href="#school"><i class="ti ti-caret-down col-auto fs-5"></i></a>
    </div>
    <div class="d-flex row card-body d-flex justify-between p-0">
        <form class="d-flex row col-12 justify-content-between" method="get"
            action="{{ route('admin.constants.constants') }}" id="userFilterForm">

            <div class="row d-flex col-lg-9 col-12">

                <div class="row d-flex ps-4">
                    <div class="col-lg-3 col-sm-6 col-6 my-1">
                        <input type="text" class="form-control border border-info" name="district"
                            value="{{ Request::get('district') }}" placeholder="District Name">
                    </div>
                    <div class="col-lg-3 col-sm-6 col-6 my-1">
                        <input type="text" class="form-control border border-info" name="medical_officer_email"
                            value="{{ Request::get('medical_officer_email') }}" placeholder="Medical Officer Email">
                    </div>
                    <div class="col-lg-3 col-sm-6 col-6 my-1">
                        <input type="date" class="form-control border border-info" name="create_date"
                            value="{{ Request::get('create_date') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-original-title="Created Date">
                    </div>
                    <div class="col-lg-3 col-sm-6 col-6 my-1">
                        <input type="date" class="form-control border border-info" name="update_date"
                            value="{{ Request::get('update_date') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-original-title="Last Update Date">
                    </div>
                </div>

                <div class="row d-flex ps-4">

                    <div class="col-auto d-flex align-items-center my-1">
                        <h6 class="mt-2">Show </h6>
                        <select class="form-control py-0" name="pagination" id="paginationSelect">
                            <option value="5" {{ Request::get('pagination') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ (Request::get('pagination') ?? 10) == 10 ? 'selected' : '' }}>10
                            </option>
                            <option value="25" {{ Request::get('pagination') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ Request::get('pagination') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <h6 class="mt-2"> rows</h6>
                    </div>

                </div>

                <div class="form-group row d-flex align-items-center ps-4">

                    <label class="col-form-label col-lg-2">Sort By:</label>
                    <div class="col-lg-10">
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="sort_field" id="idSort" value="id"
                                {{ Request::get('sort_field') == 'id' ? 'checked' : '' }}>
                            <label class="form-check-label" for="idSort">ID</label>
                        </div>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="sort_field" id="nameSort"
                                value="district" {{ Request::get('sort_field') == 'district' ? 'checked' : '' }}>
                            <label class="form-check-label" for="nameSort">District Name</label>
                        </div>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="sort_field" id="emailSort"
                                value="medical_officer_email"
                                {{ Request::get('sort_field') == 'medical_officer_email' ? 'checked' : '' }}>
                            <label class="form-check-label" for="emailSort">Medical Officer Email</label>
                        </div>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="sort_field" id="createDateSort"
                                value="created_at" {{ Request::get('sort_field') == 'created_at' ? 'checked' : '' }}>
                            <label class="form-check-label" for="createDateSort">Create Date</label>
                        </div>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="sort_field" id="updateDateSort"
                                value="updated_at" {{ Request::get('sort_field') == 'updated_at' ? 'checked' : '' }}>
                            <label class="form-check-label" for="updateDateSort">Update Date</label>
                        </div>
                    </div>

                </div>

                <!-- Sorting Direction -->
                <div class="form-group row d-flex align-items-center ps-4 my-3">

                    <label class="col-form-label col-lg-2">Sort Direction:</label>
                    <div class="col-lg-10">
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="sort_direction" id="ascSort" value="asc"
                                {{ Request::get('sort_direction') == 'asc' ? 'checked' : '' }}>
                            <label class="form-check-label" for="ascSort">Ascending</label>
                        </div>
                        <div class="form-check form-check-inline mb-2">
                            <input class="form-check-input" type="radio" name="sort_direction" id="descSort"
                                value="desc" {{ Request::get('sort_direction') == 'desc' ? 'checked' : '' }}>
                            <label class="form-check-label" for="descSort">Descending</label>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Buttons -->
            <div class="row d-flex col-lg-3 col-12 align-items-center justify-content-end">
                <div class="col-auto d-flex align-items-stretch p-0 gap-2">
                    <button type="submit"
                        class="justify-content-center w-100 btn mb-1 btn-rounded btn-secondary d-flex align-items-center card-hover px-5 py-2">Filter</button>
                    <a href="{{ route('admin.constants.constants') }}"
                        class="justify-content-center w-100 btn mb-1 btn-rounded btn-secondary d-flex align-items-center card-hover px-5 py-2">Clear</a>
                </div>
            </div>

        </form>

        @include('validator/form-validator')
    </div>

</div>
