<div class="col-12 d-flex align-items-stretch w-100">
    <div class="col-12 card card-hover shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="d-flex row">
                <div class="d-flex row align-items-center gap-4 mb-2">
                    <div class="d-flex row col-auto">
                        <h3 class="fw-semibold d-flex row align-items-center col-auto gap-1">
                            <span class="col-auto text-dark">Hi, {{ Auth::user()->name }}!</span>
                                @if ($filteredRecords->count() > 1 && $activeSchoolYear['getRecord']->isNotEmpty())
                                    <span class="col-auto badge bg-info text-white rounded-pill">
                                    You are assigned to {{ $filteredRecords->count() }} classrooms!</span>
                                @endif

                            <span class="col-auto badge bg-dark text-white rounded-pill">
                                @if ($activeSchoolYear['getRecord']->isNotEmpty())
                                    {{ $activeSchoolYear['getRecord']->first()->school_year }} {{ $activeSchoolYear['getRecord']->first()->phase }}
                                @else
                                    No active school year phase at the moment.
                                @endif
                            </span>
                        </h3>

                        <nav aria-label="breadcrumb" class="mb-1 col-auto">
                            @if($filteredRecords->isNotEmpty() && $activeSchoolYear['getRecord']->isNotEmpty())
                            @foreach($filteredRecords as $record)
                            <ol class="breadcrumb border border-info px-3 py-2 mb-1">
                                <li class="breadcrumb-item">
                                    <a href="#" class="text-info d-flex align-items-center mt-1"><i
                                            class="ti ti-user fs-4"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#" class="text-info">Class Adviser</a>
                                </li>

                                <li class="breadcrumb-item active text-info font-medium" aria-current="page">
                                    {{ $schoolName[$record->school_id] }}
                                </li>
                                <li class="breadcrumb-item active text-info font-medium" aria-current="page">
                                    Grade {{ $record->grade_level }}
                                </li>
                                <li class="breadcrumb-item active text-info font-medium" aria-current="page">
                                    {{ $record->section }}
                                </li>
                            </ol>
                            @endforeach
                            @else
                            <li class="breadcrumb-item active text-info font-medium" aria-current="page">
                                <span>You are not assigned nor permitted to do the task.</span>
                            </li>
                            @endif
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
