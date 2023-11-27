<div class="row col-12 d-flex justify-content-end gap-2 mb-2">
    <div class="col-auto d-flex align-items-center p-0 justify-content-between">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link d-flex active py-2 px-4" data-bs-toggle="tab" href="#home2" role="tab"
                    aria-selected="true">
                    <span><i class="ti ti-map"></i></span>
                    <span class="d-none d-md-block ms-2">{{ $head['headerTitle'] }} Table</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link d-flex py-2 px-4" data-bs-toggle="tab" href="#profile2" role="tab"
                    aria-selected="false" tabindex="-1">
                    <span><i class="ti ti-map-pin-plus"></i></span>
                    <span class="d-none d-md-block ms-2">{{ $head['headerTitle1'] }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="d-flex row w-100">

    <div class="col-12 shadow">
        <div class="card-body w-100">

            <!-- Nav tabs -->

            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane active show" id="home2" role="tabpanel">
                    <div class="p-3">

                        <!-- =========================================TABLE FILTER - PUPILS ====================================== -->
                        @include('class_adviser.segments.filter')

                        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                            <button type="button"
                                class="btn d-flex gap-3 btn-light-primary d-block text-primary font-medium">
                                {{ $head['headerTitle'] }}
                                <span class="badge ms-auto bg-primary">{{ $dataPupils['getList']->count() }}</span>
                            </button>
                            <a class="mb-0 btn-minimize px-2 cursor-pointer text-white link d-flex align-items-center"
                                data-action="expand"><i class="ti ti-arrows-maximize fs-6"></i></a>
                            <div class="d-flex w-100 justify-content-end gap-2">
                                <div class="f-flex row gap-2 justify-content-end">
                                    <form action="{{ route('class_adviser.class_adviser.pupils') }}">
                                        <input type="text" class="form-control search-chat border-dark" id="text-srh"
                                            name="search" value="{{ Request::get('search') }}" placeholder="Search">
                                    </form>
                                </div>
                                <div class="justify-content-end">
                                    <a role="button" href="{{ route('class_adviser.class_adviser.pupils') }}"
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

                <div class="tab-pane p-3" id="profile2" role="tabpanel">

                    <!-- ================================ SIDE FORM - PUPILS ================================================ -->
                    @include('class_adviser.class_adviser.forms.pupils-form')

                </div>

            </div>

        </div>
    </div>

</div>
