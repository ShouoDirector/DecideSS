<ul class="dropdown-menu animated lightSpeedIn px-3 shadow-lg">
    <form action="{{ route('class_adviser.class_adviser.masterlist') }}">
        {{ csrf_field() }}
        <input type="text" name="gender" value="{{ Request::get('gender') }}" hidden>
        <li>
            <h6 class="my-2 fw-semibold">Entries</h6>
            <div class="col-auto d-flex align-items-center my-1 w-100">
                <select class="form-select border-dark" name="pagination" id="paginationSelect">
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
                    <option value="100" {{ Request::get('pagination') == 100 ? 'selected' : '' }}>
                        100 Rows
                    </option>
                    <option value="250" {{ Request::get('pagination') == 250 ? 'selected' : '' }}>
                        250 Rows
                    </option>
                    <option value="999" {{ Request::get('pagination') == 999 ? 'selected' : '' }}>
                        999 Rows
                    </option>
                </select>
            </div>
        </li>
        <li>
            <h6 class="my-2 fw-semibold">Sort By</h6>
            <div class="form-group row d-flex align-items-center ps-4 justify-content-start">
                <div class="d-flex row gap-1 p-0 w-100">
                    <select class="form-select border-dark" name="sort_attribute">
                        <option value="id" {{ Request::get('sort_attribute', 'id') == 'id' ? 'selected' : '' }}>
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
                        <option value="asc" {{ Request::get('sort_order', 'asc') == 'asc' ? '' : 'selected' }}>
                            Ascending</option>
                        <option value="desc" {{ Request::get('sort_order') == 'desc' ? 'selected' : '' }}>
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
    </form>
</ul>
