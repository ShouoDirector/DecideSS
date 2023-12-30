<div class="d-flex row w-100">

    <div class="col-12 shadow">
        <div class="card-body w-100">

            <!-- Nav tabs -->

                        <!-- =========================================TABLE FILTER - CLASSROOM ====================================== -->
                        @include('admin.segments.filter')

                        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                            <button type="button"
                                class="col-lg-3 col-md-4 col-sm-6 col-12 btn d-flex gap-3 btn-light-primary d-block text-primary font-medium">
                                {{ $head['headerTitle'] }}
                                <span class="badge ms-auto bg-primary">{{ $dataClassroom['getList']->count() }}</span>
                            </button>
                            <div class="d-flex w-100 justify-content-end gap-2">
                                <div class="f-flex row gap-2 justify-content-end">
                                    <div class="f-flex row gap-2 justify-content-end">
                                        <form action="{{ route('admin.constants.classroom') }}">
                                            <input type="search" class="form-control search-chat border-dark"
                                                id="text-srh" name="search" value="{{ Request::get('search') }}"
                                                placeholder="Search">
                                        </form>
                                    </div>
                                </div>
                                <div class="justify-content-end">
                                    <a role="button" href="{{ route('admin.constants.classroom') }}" type="submit"
                                        class="btn border-dark" data-bs-toggle="tooltip" data-bs-placement="right"
                                        data-bs-original-title="Clear">
                                        <i class="ti ti-rotate-clockwise-2 fs-5"></i>
                                    </a>
                                </div>
                                <a class="btn row d-lg-none d-flex justify-content-" data-bs-toggle="offcanvas"
                                    href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    <i class="ti ti-menu-2 fs-6"></i>
                                </a>
                            </div>
                        </div>

                        <!-- ========================================= CLASSROOM TABLE ====================================== -->
                        @include('admin.constants.tables.classroom-table')

                    </div>

        </div>
    </div>

</div>
