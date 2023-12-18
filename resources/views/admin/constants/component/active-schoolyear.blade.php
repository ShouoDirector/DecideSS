<div class="col-12 d-flex align-items-stretch w-100">
    <div
        class="col-lg-3 col-md-4 col-sm-6 col-12 card border-bottom border-primary card-shadow position-relative overflow-hidden">
        <div class="card-body px-3 py-3">
            <div class="ms-1 mt-2 d-flex row card-hover">
                <div
                    class="col-3 bg-light-primary text-primary rounded d-flex align-items-center p-8 justify-content-center">
                    <i class="ti ti-calendar-time fs-8"></i>
                </div>
                <h5 class="col-9 mb-0 justify-content-center">
                    S.Y {{ $activeSchoolYear['getRecord']->first()->school_year }} |
                    {{ $activeSchoolYear['getRecord']->first()->phase }}</h5>
            </div>
        </div>
    </div>
</div>
