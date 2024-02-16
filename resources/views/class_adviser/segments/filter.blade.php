<div class="col-auto mb-0">
    <div class="shop-filters flex-shrink-0 border-end d-none d-lg-block">
        <ul class="list-group border-bottom rounded-0">
            <form action="#" class="d-flex row">
                <div class="d-flex justify-content-end">
                    <div class="btn-group shadow">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" style="vertical-align: middle;" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-filter fs-4"></i>
                        </button>
                        <ul class="dropdown-menu animated lightSpeedIn px-3 shadow-lg" style="">
                            <li>
                                <h6 class="my-2 fw-semibold">Entries</h6>
                                <div class="col-auto d-flex align-items-center my-1 w-100">
                                    <select class="form-select border-dark" name="pagination" id="paginationSelect">
                                        <option value="5" {{ Request::get('pagination') == 5 ? 'selected' : '' }}> 5
                                            Rows
                                        </option>
                                        <option value="10"
                                            {{ (Request::get('pagination') ?? 10) == 10 ? 'selected' : '' }}> 10
                                            Rows
                                        </option>
                                        <option value="25" {{ Request::get('pagination') == 25 ? 'selected' : '' }}>
                                            25 Rows
                                        </option>
                                        <option value="50" {{ Request::get('pagination') == 50 ? 'selected' : '' }}>
                                            50 Rows
                                        </option>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <h6 class="my-2 fw-semibold">Sort By</h6>
                                <div class="form-group row d-flex align-items-center ps-4 justify-content-start">
                                    <div class="d-flex row gap-1 p-0 w-100">
                                        <select class="form-select border-dark" name="sort_attribute">
                                            <option value="id"
                                                {{ Request::get('sort_attribute', 'id') == 'id' ? 'selected' : '' }}>
                                                ID</option>
                                            <option value="created_at"
                                                {{ Request::get('sort_attribute') == 'created_at' ? 'selected' : '' }}>
                                                Created
                                            </option>
                                            <option value="updated_at"
                                                {{ Request::get('sort_attribute') == 'updated_at' ? 'selected' : '' }}>
                                                Updated
                                            </option>
                                        </select>
                                        <select class="form-select border-dark" name="sort_order">
                                            <option value="asc"
                                                {{ Request::get('sort_order', 'asc') == 'asc' ? '' : 'selected' }}>
                                                Ascending</option>
                                            <option value="desc"
                                                {{ Request::get('sort_order') == 'desc' ? 'selected' : '' }}>
                                                Descending</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <button type="submit" class="justify-content-center w-100 btn mt-2 btn-rounded btn-secondary 
                                    d-flex align-items-center card-hover py-2">Sort and Filter</button>
                            </li>
                        </ul>
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
                            <select class="form-control border-dark" name="pagination" id="paginationSelect">
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
                            <div class="d-flex row gap-2 col-lg-10 p-0 w-100">
                                <select class="form-select border-dark" name="sort_attribute">
                                    <option value="id"
                                        {{ Request::get('sort_attribute', 'id') == 'id' ? 'selected' : '' }}>
                                        ID</option>
                                    <option value="created_at"
                                        {{ Request::get('sort_attribute') == 'created_at' ? 'selected' : '' }}>Created
                                    </option>
                                    <option value="updated_at"
                                        {{ Request::get('sort_attribute') == 'updated_at' ? 'selected' : '' }}>Updated
                                    </option>
                                </select>
                                <select class="form-select  border-dark" name="sort_order">
                                    <option value="asc"
                                        {{ Request::get('sort_order', 'asc') == 'asc' ? '' : 'selected' }}>
                                        Ascending</option>
                                    <option value="desc" {{ Request::get('sort_order') == 'desc' ? 'selected' : '' }}>
                                        Descending</option>
                                </select>
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
