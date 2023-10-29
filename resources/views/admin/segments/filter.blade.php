<div class="col-3">
    <div class="shop-filters flex-shrink-0 border-end d-none d-lg-block">
        <ul class="list-group pt-2 border-bottom rounded-0">
            <form action="" class="d-flex row">
                <h6 class="my-3 fw-semibold">Entries</h6>
                <div class="col-auto d-flex align-items-center my-1 w-100">
                    <select class="form-control" name="pagination" id="paginationSelect">
                        <option value="5" {{ Request::get('pagination') == 5 ? 'selected' : '' }}> 5 Rows
                        </option>
                        <option value="10" {{ (Request::get('pagination') ?? 10) == 10 ? 'selected' : '' }}> 10 Rows
                        </option>
                        <option value="25" {{ Request::get('pagination') == 25 ? 'selected' : '' }}> 25 Rows
                        </option>
                        <option value="50" {{ Request::get('pagination') == 50 ? 'selected' : '' }}> 50 Rows
                        </option>
                    </select>
                </div>
                <h6 class="my-3 fw-semibold">Sort By</h6>
                <div class="form-group row d-flex align-items-center ps-4 justify-content-start">
                    <div class="col-lg-10 p-0 w-100">
                        <div class="form-check form-check-inline my-3">
                            <i class="ti ti-adjustments-up mx-1"></i>
                            <input class="form-check-input" type="radio" name="sort_option" id="idDescSort"
                                value="id_desc"
                                {{ Request::get('sort_option', 'id_desc') == 'id_desc' ? 'checked' : '' }}>
                            <label class="form-check-label" for="idDescSort">ID Descending</label>
                        </div>
                        <div class="form-check form-check-inline my-3">
                            <i class="ti ti-adjustments-down mx-1"></i>
                            <input class="form-check-input" type="radio" name="sort_option" id="idAscSort"
                                value="id_asc" {{ Request::get('sort_option') == 'id_asc' ? 'checked' : '' }}>
                            <label class="form-check-label" for="idAscSort">ID Ascending</label>
                        </div>
                        <div class="form-check form-check-inline my-3">
                            <i class="ti ti-calendar-time mx-1"></i>
                            <input class="form-check-input" type="radio" name="sort_option" id="recentlyCreatedSort"
                                value="recently_created"
                                {{ Request::get('sort_option') == 'recently_created' ? 'checked' : '' }}>
                            <label class="form-check-label" for="recentlyCreatedSort">Recently Created</label>
                        </div>
                        <div class="form-check form-check-inline my-3">
                            <i class="ti ti-calendar-stats mx-1"></i>
                            <input class="form-check-input" type="radio" name="sort_option" id="recentlyUpdatedSort"
                                value="recently_updated"
                                {{ Request::get('sort_option') == 'recently_updated' ? 'checked' : '' }}>
                            <label class="form-check-label" for="recentlyUpdatedSort">Recently Updated</label>
                        </div>
                    </div>
                </div>
                <h6 class="my-3 fw-semibold">Last Created</h6>
                <div class="form-group row d-flex align-items-center justify-content-center">
                    <div class="my-1 mx-2">
                        <input type="date" class="form-control border border-info" name="create_date"
                            value="{{ Request::get('create_date') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-original-title="Created Date">
                    </div>
                </div>
                <h6 class="my-3 fw-semibold">Last Updated</h6>
                <div class="form-group row d-flex align-items-center justify-content-center">
                    <div class="my-1 mx-2">
                        <input type="date" class="form-control border border-info" name="update_date"
                            value="{{ Request::get('update_date') }}" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-original-title="Last Update Date">
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center justify-content-center">
                    <div class="my-1 mx-2">
                        <button type="submit" class="justify-content-center w-100 btn mt-2 btn-rounded btn-secondary 
                                d-flex align-items-center card-hover px-5 py-2">Sort and Filter</button>
                    </div>
                    
                </div>
            </form>
        </ul>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body shop-filters w-100 p-0">
            <ul class="d-flex p-4 list-group h-100 border-bottom rounded-0 justify-content-between">
                <form action="" class="d-flex row h-100 justify-content-center">
                    <div>
                        <h6 class="my-3 fw-semibold">Entries</h6>
                        <div class="col-auto d-flex align-items-center my-1 w-100">
                            <select class="form-control" name="pagination" id="paginationSelect">
                                <option value="5" {{ Request::get('pagination') == 5 ? 'selected' : '' }}> 5 Rows
                                </option>
                                <option value="10" {{ (Request::get('pagination') ?? 10) == 10 ? 'selected' : '' }}> 10
                                    Rows
                                </option>
                                <option value="25" {{ Request::get('pagination') == 25 ? 'selected' : '' }}> 25 Rows
                                </option>
                                <option value="50" {{ Request::get('pagination') == 50 ? 'selected' : '' }}> 50 Rows
                                </option>
                            </select>
                        </div>
                        <h6 class="my-3 fw-semibold">Sort By</h6>
                        <div class="form-group row d-flex align-items-center ps-4 justify-content-start">
                            <div class="col-lg-10 p-0 w-100">
                                <div class="form-check form-check-inline my-3">
                                    <i class="ti ti-adjustments-up mx-1"></i>
                                    <input class="form-check-input" type="radio" name="sort_option" id="idDescSort"
                                        value="id_desc"
                                        {{ Request::get('sort_option', 'id_desc') == 'id_desc' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="idDescSort">ID Descending</label>
                                </div>
                                <div class="form-check form-check-inline my-3">
                                    <i class="ti ti-adjustments-down mx-1"></i>
                                    <input class="form-check-input" type="radio" name="sort_option" id="idAscSort"
                                        value="id_asc" {{ Request::get('sort_option') == 'id_asc' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="idAscSort">ID Ascending</label>
                                </div>
                                <div class="form-check form-check-inline my-3">
                                    <i class="ti ti-calendar-time mx-1"></i>
                                    <input class="form-check-input" type="radio" name="sort_option"
                                        id="recentlyCreatedSort" value="recently_created"
                                        {{ Request::get('sort_option') == 'recently_created' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="recentlyCreatedSort">Recently Created</label>
                                </div>
                                <div class="form-check form-check-inline my-3">
                                    <i class="ti ti-calendar-stats mx-1"></i>
                                    <input class="form-check-input" type="radio" name="sort_option"
                                        id="recentlyUpdatedSort" value="recently_updated"
                                        {{ Request::get('sort_option') == 'recently_updated' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="recentlyUpdatedSort">Recently Updated</label>
                                </div>
                            </div>
                        </div>
                        <h6 class="my-3 fw-semibold">Last Created</h6>
                        <div class="form-group row d-flex align-items-center justify-content-center">
                            <div class="my-1 mx-2">
                                <input type="date" class="form-control border border-info" name="create_date"
                                    value="{{ Request::get('create_date') }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Created Date">
                            </div>
                        </div>
                        <h6 class="my-3 fw-semibold">Last Updated</h6>
                        <div class="form-group row d-flex align-items-center justify-content-center">
                            <div class="my-1 mx-2">
                                <input type="date" class="form-control border border-info" name="update_date"
                                    value="{{ Request::get('update_date') }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="Last Update Date">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center justify-content-center">
                        <div class="my-1 mx-2">
                            <button type="submit" class="justify-content-center w-100 btn mt-2 btn-rounded btn-secondary 
                                    d-flex align-items-end card-hover px-5 py-2">Sort and Filter</button>
                        </div>
                    </div>

                </form>
            </ul>
        </div>
    </div>

</div>
