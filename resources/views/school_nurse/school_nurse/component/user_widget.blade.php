<div class="col-12 d-flex align-items-stretch m-0 w-100">
    <div class="col-12 card shadow-none position-relative overflow-hidden m-0">
        <div class="card-body px-4 py-3">
            <div class="d-flex row m-0">
                <div class="d-flex row align-items-center gap-4 mb-2">
                    <div class="d-flex row col-12">
                        <h3 class="fw-semibold d-flex row align-items-center col-auto gap-1">
                            <span class="col-auto text-dark card-hover">Hi, {{ Auth::user()->name }}!</span>
                                @if ($filteredRecords->count() > 1 && $activeSchoolYear['getRecord']->isNotEmpty())
                                    <span class="col-auto badge card-hover bg-info text-white rounded-pill">
                                    You are assigned to {{ $filteredRecords->count() }} classrooms!</span>
                                @endif

                            <span class="col-auto badge bg-dark text-white rounded-pill card-hover">
                                @if ($activeSchoolYear['getRecord']->isNotEmpty())
                                    {{ $activeSchoolYear['getRecord']->first()->school_year }} {{ $activeSchoolYear['getRecord']->first()->phase }}
                                @else
                                    No active school year phase at the moment.
                                @endif
                            </span>
                        </h3>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
