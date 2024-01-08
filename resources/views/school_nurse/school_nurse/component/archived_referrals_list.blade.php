<div class="d-flex shadow-none row w-100">

    <div class="col-12 shadow-none">
        <div class="card-body w-100">

            <!-- Nav tabs -->

            <!-- Tab panes -->
            <div class="tab-content">

                <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
                    <a href="{{ route('school_nurse.school_nurse.referrals') }}" type="button"
                        class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Referrals</a>
                    <a href="#" type="button"
                        class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Deleted Referrals</a>
                </div>

                <div class="tab-pane active show" id="home2" role="tabpanel">
                    <div class="p-3">

                        <!-- =========================================TABLE FILTER - PUPILS ====================================== -->
                        @include('school_nurse.segments.filter')

                        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex w-100 justify-content-end gap-2">
                                <div class="f-flex row gap-2 justify-content-end">
                                    <form action="{{ route('school_nurse.school_nurse.referrals_archive') }}">
                                        <input type="search" class="form-control search-chat border-dark" id="text-srh"
                                            name="search" value="{{ Request::get('search') }}" placeholder="Search">
                                    </form>
                                </div>
                                <div class="justify-content-end">
                                    <a role="button" href="{{ route('school_nurse.school_nurse.referrals_archive') }}" type="submit"
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
                        @include('school_nurse.school_nurse.tables.archived_referrals_table')

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>