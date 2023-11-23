<div class="col-12 mb-3">
    <div class="shop-filters flex-shrink-0 border-end d-none d-lg-block">
        <ul class="list-group pt-2 border-bottom rounded-0">
            <form action="" class="d-flex row">
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <h6 class="my-3 fw-semibold">Entries</h6>
                    <div class="col-auto d-flex align-items-center my-1 w-100">
                        <select class="form-control border-dark" name="pagination" id="paginationSelect">
                            <option value="5" {{ Request::get('pagination') == 5 ? 'selected' : '' }}> 5
                                Rows
                            </option>
                            <option value="10" {{ (Request::get('pagination') ?? 10) == 10 ? 'selected' : '' }}> 10
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
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="my-3 fw-semibold">Sort By</h6>
                    <div class="form-group row d-flex align-items-center ps-4 justify-content-start">
                        <div class="d-flex row gap-1 p-0 w-100">
                            <select class="form-select border-dark" name="sort_attribute">
                                <option value="id" {{ Request::get('sort_attribute', 'id') == 'id' ? 'selected' : '' }}>
                                    ID</option>
                                <option value="created_at"
                                    {{ Request::get('sort_attribute') == 'created_at' ? 'selected' : '' }}>Created
                                </option>
                                <option value="updated_at"
                                    {{ Request::get('sort_attribute') == 'updated_at' ? 'selected' : '' }}>Updated
                                </option>
                            </select>
                            <select class="form-select border-dark" name="sort_order">
                                <option value="asc" {{ Request::get('sort_order', 'asc') == 'asc' ? '' : 'selected' }}>
                                    Ascending</option>
                                <option value="desc" {{ Request::get('sort_order') == 'desc' ? 'selected' : '' }}>
                                    Descending</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="my-3 fw-semibold">Last Created</h6>
                    <div class="form-group row d-flex align-items-center justify-content-center">
                        <div class="mx-2">
                            <input type="date" class="form-control border border-dark" name="create_date"
                                value="{{ Request::get('create_date') }}" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-original-title="Created Date">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="my-3 fw-semibold">Last Updated</h6>
                    <div class="form-group row d-flex align-items-center justify-content-center">
                        <div class="mx-2">
                            <input type="date" class="form-control border border-dark" name="update_date"
                                value="{{ Request::get('update_date') }}" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-original-title="Last Update Date">
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex align-items-end justify-content-end">
                    <div class="form-group row d-flex align-items-center justify-content-center">
                        <div class="my-1 mx-2">
                            <button type="submit" class="justify-content-center w-100 btn mt-2 btn-rounded btn-secondary 
                                    d-flex align-items-center card-hover px-5 py-2">Sort and Filter</button>
                        </div>

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
                                    <option value="id" {{ Request::get('sort_attribute', 'id') == 'id' ? 'selected' : '' }}>
                                        ID</option>
                                    <option value="created_at"
                                        {{ Request::get('sort_attribute') == 'created_at' ? 'selected' : '' }}>Created
                                    </option>
                                    <option value="updated_at"
                                        {{ Request::get('sort_attribute') == 'updated_at' ? 'selected' : '' }}>Updated
                                    </option>
                                </select>
                                <select class="form-select  border-dark" name="sort_order">
                                    <option value="asc" {{ Request::get('sort_order', 'asc') == 'asc' ? '' : 'selected' }}>
                                        Ascending</option>
                                    <option value="desc" {{ Request::get('sort_order') == 'desc' ? 'selected' : '' }}>
                                        Descending</option>
                                </select>
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
