<div class="col-12 d-flex align-items-stretch m-0 w-100">
    <div class="col-12 card shadow-none position-relative m-0">
        <div class="card-body p-0">
            <div class="d-flex row m-0">
                <div class="d-flex row align-items-center gap-4 m-0 p-0">
                    <div class="d-flex row col-auto p-0 m-0" style="width: max-content;">
                        <nav aria-label="breadcrumb" class="mb-1 col-auto px-0" style="width: max-content;">
                            @if($filteredRecords->isNotEmpty() && $activeSchoolYear['getRecord']->isNotEmpty())
                            @foreach($filteredRecords as $record)
                            <ol class="breadcrumb border border-info rounded px-3 py-2 mb-1" style="width: fit-content;">
                                <li class="breadcrumb-item card-hover">
                                    <a href="#" class="text-info d-flex align-items-center mt-1"><i
                                            class="ti ti-user fs-4"></i></a>
                                </li>
                                <li class="breadcrumb-item card-hover">
                                    <a href="#" class="text-info">Class Adviser</a>
                                </li>

                                <li class="breadcrumb-item active text-info font-medium card-hover" aria-current="page">
                                    {{ $schoolName[$record->school_id] }}
                                </li>
                                <li class="breadcrumb-item active text-info font-medium card-hover" aria-current="page">
                                    Grade {{ $record->grade_level }}
                                </li>
                                <li class="breadcrumb-item active text-info font-medium card-hover" aria-current="page">
                                    {{ $sectionNames[$record->section_id] }}
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
