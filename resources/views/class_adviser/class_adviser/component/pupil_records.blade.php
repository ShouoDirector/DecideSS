<div class="d-flex row w-100">

    <div class="col-12 shadow">
        <div class="card-body w-100">

            <!-- Nav tabs -->

            <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
                <a href="{{ route('class_adviser.class_adviser.pupils') }}" type="button" class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Insert New Pupil</a>
                <a href="#" type="button" class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Pupils</a>
                <a href="{{ route('class_adviser.class_adviser.masterlist') }}" type="button" class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">MasterList</a>
            </div>

            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane active show" id="home2" role="tabpanel">
                    <div class="p-3">

                        <!-- =========================================TABLE FILTER - PUPILS ====================================== -->
                        @include('class_adviser.segments.filter')

                        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                            <button type="button"
                                class="col-lg-3 col-md-4 col-sm-6 col-12 btn d-flex gap-3 btn-light-primary d-block text-primary font-medium">
                                {{ $head['headerTitle'] }}
                                <span class="badge ms-auto bg-primary">{{ $dataPupils['getList']->total() }}</span>
                            </button>
                            <a class="mb-0 btn-minimize px-2 cursor-pointer text-white link d-flex align-items-center"
                                data-action="expand"><i class="ti ti-arrows-maximize fs-6"></i></a>
                            <div class="d-flex w-100 justify-content-end gap-2">
                                <div class="f-flex row gap-2 justify-content-end">
                                    <form action="{{ route('class_adviser.class_adviser.pupils_records') }}">
                                        <input type="search" class="form-control search-chat border-dark" id="text-srh"
                                            name="search" value="{{ Request::get('search') }}" placeholder="Search">
                                    </form>
                                </div>
                                <div class="justify-content-end">
                                    <a role="button" href="{{ route('class_adviser.class_adviser.pupils_records') }}"
                                        type="submit" class="btn border-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="right" data-bs-original-title="Clear">
                                        <i class="ti ti-rotate-clockwise-2 fs-5"></i>
                                    </a>
                                </div>
                                <a class="btn row d-lg-none d-flex justify-content-" data-bs-toggle="offcanvas"
                                    href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    <i class="ti ti-menu-2 fs-6"></i>
                                </a>
                            </div>
                        </div>

                        <!-- ========================================= PUPILS TABLE ====================================== -->
                        @include('class_adviser.class_adviser.tables.pupils-table')

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
