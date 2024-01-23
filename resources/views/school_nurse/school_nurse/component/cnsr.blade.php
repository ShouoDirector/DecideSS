<div class="card shadow-none">

    <div class="d-flex row">
        <h6>IMPORTANT: You must always approve all reports. Time and time again as class advisers may update their
            nutritional status reports.</h6>
    </div>

    @if(count($dataClassRecord['getRecord']) === 0)
    <div class="card-body py-0">

        <div class="table-responsive">

            <table class="table stylish-table v-middle mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th class="border-0 fw-normal"></th>
                        <th class="border-0 fw-normal">Class</th>
                        <th class="border-0 fw-normal">School</th>
                        <th class="border-0 fw-normal">By Adviser</th>
                        <th class="border-0 fw-normal">Action</th>
                    </tr>
                </thead>
                @if($filteredRecords->isNotEmpty() && $activeSchoolYear['getRecord']->isNotEmpty())
                @foreach($filteredRecords as $index => $record)
                <tbody>

                    @if($sectionIds->contains($record->id))
                    <tr>
                        <td>
                            <span class="round-40 text-white d-flex align-items-center justify-content-center text-center rounded-circle 
                                {{ $index % 2 == 0 ? 'bg-primary' : 'bg-secondary' }}">
                                {{ strtoupper(substr($sectionNames[$record->section_id], 0, 1)) }}</span>
                        </td>
                        <td class="d-flex flex-column align-items-baseline justify-content-center card-hover">
                            <h6 class="font-weight-medium mb-0">{{ $sectionNames[$record->section_id] }}</h6>
                            <small class="text-muted">Grade {{ $record->grade_level }}</small>
                        </td>
                        <td class="align-middle card-hover">{{ $schoolName[$record->school_id] }}</td>
                        <td class="align-middle">
                            <span class="badge px-3 py-2 card_hover {{ $sectionIds->contains($record->id) 
                                ? ($index % 2 == 0 ? 'bg-primary rounded' : 'bg-secondary rounded') 
                                : 'bg-danger rounded' }}">
                                {{ $sectionIds->contains($record->id) 
                                ? "Submitted by " . $classAdviserNames[$record->classadviser_id] 
                                : $classAdviserNames[$record->classadviser_id] . " has yet to submit" }}
                                <i class="ti {{ $sectionIds->contains($record->id) ? 'ti-check' : 'ti-x' }} fs-5"></i>
                            </span>

                        </td>

                        <td class="d-flex flex-column align-items-baseline justify-content-center">
                            <form class="d-flex row col-12 w-auto"
                                action="{{ route('school_nurse.school_nurse.cnsr') }}">
                                <div class="hidden">
                                    <input type="search" class="border-dark col-1 " id="text-srh" name="search"
                                        value="{{ $record->id }}" placeholder="Search" readonly>
                                </div>
                                <button type="submit" class="d-inline-flex align-items-center justify-content-center 
                                btn btn-circle btn-lg card-zoom
                                {{ $index % 2 == 0 ? 'bg-primary' : 'bg-secondary' }}">
                                    <i class="fs-5 ti ti-eye text-white card-zoom"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @else
                    @endif

                </tbody>
                @endforeach
                @else
                <li class="breadcrumb-item active text-info font-medium" aria-current="page">
                    <span>You are not assigned nor permitted to do the task.</span>
                </li>
                @endif
            </table>
        </div>
    </div>
    @else
    @endif

</div>

<div class="d-flex row w-100">

    <div class="col-12">
        <div class="card-body w-100">

            <!-- Nav tabs -->

            <!-- Tab panes -->

            <div class="tab-content">

                <div class="tab-pane active show" id="home2" role="tabpanel">
                    <div class="p-3">

                        <!-- =========================================TABLE FILTER - PUPILS ====================================== -->

                        @if(count($dataClassRecord['getRecord']) !== 0)
                        @include('school_nurse.school_nurse.component.submitted_nsr_class')
                        <!-- ========================================= REPORT TABLE ====================================== -->
                        @include('school_nurse.school_nurse.tables.submitted_nsr')
                        @else
                        @endif

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
