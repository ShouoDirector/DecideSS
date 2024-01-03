<div class="d-flex shadow-none row w-100">

    <div class="col-12 shadow-none">
        <div class="card-body w-100">

            <!-- Nav tabs -->

            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane active show" id="home2" role="tabpanel">
                    <div class="p-3">

                    <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
                        <a href="{{ route('school_nurse.school_nurse.enlist_new') }}" type="button"
                            class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Enlist</a>
                        <a href="#" type="button"
                            class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">List of Beneficiaries</a>
                        <a href="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries_program') }}" type="button"
                            class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Healthcare Services</a>
                    </div>

                        <!-- =========================================TABLE FILTER - PUPILS ====================================== -->
                        @include('school_nurse.segments.filter')

                        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                            <button type="button"
                                class="col-lg-3 col-md-4 col-sm-6 col-12 btn d-flex m-1 btn-light-primary d-block text-primary font-medium">
                                <span>
                                {{ $head['headerTable1'] }}
                                </span>
                                <span class="badge ms-auto bg-primary">{{ $data['getRecord']->total() }}</span>
                            </button>
                            <button type="button"
                                class="col-md-4 col-sm-6 col-12 btn d-flex m-1 btn-light-primary d-block text-primary font-medium">
                                <span>
                                    {{ $head['headerTable2'] }}
                                </span>
                                @if($activeSchoolYear['getRecord'] ?? null)
                                    <span class="badge ms-auto bg-primary">{{ $activeSchoolYear['getRecord'][0]->school_year . ' ' . $activeSchoolYear['getRecord'][0]->phase }}</span>
                                @else
                                    <span class="badge ms-auto bg-danger">Phase not available</span>
                                @endif
                            </button>
                            <div class="d-flex w-100 justify-content-end gap-2">
                                <div class="f-flex row gap-2 justify-content-end">
                                    <form action="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}">
                                        <input type="search" class="form-control search-chat border-dark" id="text-srh"
                                            name="search" value="{{ Request::get('search') }}" placeholder="Search">
                                    </form>
                                </div>
                                <div class="justify-content-end">
                                    <a role="button" href="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}" type="submit"
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

                        <!-- ========================================= MasterList TABLE ====================================== -->
                        @include('school_nurse.school_nurse.tables.beneficiaries_table')

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>