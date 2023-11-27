<div class="col-12 d-flex align-items-stretch w-100">
    <div class="col-12 card card-hover shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="d-flex row">
                <div class="d-flex align-items-center gap-4 mb-2">
                    <div class="position-relative">
                        <div class="border border-2 border-primary rounded-circle">
                            <img src="{{ asset('upload/class_adviser_images/class_adviser.png') }}"
                                class="rounded-circle m-1" alt="user1" width="60">
                        </div>
                    </div>
                    <div>
                        <h3 class="fw-semibold d-flex align-items-center gap-1">Hi, <span
                                class="text-dark me-2">{{ Auth::user()->name }}!</span>
                            @if($filteredRecords->count() > 1)
                            <span class="badge bg-info text-white rounded-pill">You are assigned to
                                {{ $filteredRecords->count() }} classrooms!</span>
                            @endif
                            <span
                                class="badge bg-dark text-white rounded-pill">{{ $activeSchoolYear['getRecord']->first()->school_year }}
                                {{ $activeSchoolYear['getRecord']->first()->phase }}</span>
                        </h3>

                        <nav aria-label="breadcrumb" class="mb-1">
                            @if($filteredRecords->isNotEmpty())
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
                                <span>You are not assigned nor permitted.</span>
                            </li>
                            @endif
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
