<div class="card shadow-none">

    <div class="col-12">
        <div class="card-body w-100">
            <div class="d-flex row m-0 justify-content-end mt-2 mb-4">
                <a href="{{ route('school_nurse.school_nurse.consolidated') }}" type="button" class="btn btn-outline-primary rounded-0 d-flex col-auto justify-content-center">School Consolidated Nutritional Status Report</a>
        </div>
    </div>

    <div class="d-flex row mb-2">
        <h6>IMPORTANT: You must always approve all reports. Time and time again as class advisers may update their
            nutritional status reports.</h6>
    </div>

    @if(count($dataClassRecord['getRecord']) === 0)
    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table border-info table-bordered mb-0 text-nowrap">
                <thead class="bg-info border-info border-1">
                    <tr>
                        <th class="border-1 fw-normal">Grade Level</th>
                        <th class="border-1 fw-normal">Class</th>
                        <th class="border-1 fw-normal">Adviser</th>
                        <th class="border-1 fw-normal">Status</th>
                        <th class="border-1 fw-normal">Action</th>
                    </tr>
                </thead>
                @if($filteredRecords->isNotEmpty() && $activeSchoolYear['getRecord']->isNotEmpty())
                @foreach($filteredRecords as $index => $record)
                <tbody>
                    @php $grades = ['Kinder', '1', '2', '3', '4', '5', '6'] @endphp
                    @foreach($grades as $grade)
                        <tr>
                            <td colspan="6" class="align-middle bg-light-primary fw-semibold">Grade {{ $grade }}</td>
                        </tr>
                        @if($record->grade_level == $grade)
                            <tr>
                                <td class="align-middle card-hover">
                                    Grade {{ $record->grade_level }}
                                </td>
                                <td class="align-middle card-hover">{{ $sectionNames[$record->section_id] }}</td>
                                <td class="align-middle card-hover">{{ $classAdviserNames[$record->classadviser_id] }}</td>
                                <td class="align-middle">
                                    <span class="px-3 py-1 card_hover text-dark">
                                        {{ $sectionIds->contains($record->id) ? "Submitted" : "Has yet to submit" }}
                                        <i class="ti {{ $sectionIds->contains($record->id) ? 'ti-check' : 'ti-x' }} fs-5"></i>
                                    </span>
                                </td>
                                <td class="d-flex align-items-baseline justify-content-start">
                                    <form class="d-flex row w-auto" action="{{ route('school_nurse.school_nurse.cnsr') }}">
                                        <div class="hidden">
                                            <input type="search" class="border-dark col-1 " id="text-srh" name="search"
                                                value="{{ $record->id }}" placeholder="Search" readonly>
                                        </div>
                                        <button type="submit" class="d-inline-flex align-items-center justify-content-center 
                                            btn card-hover">
                                            &nbsp;&nbsp;View NS Report
                                        </button>
                                    </form> | 
                                    <form class="d-flex row w-auto" action="{{ route('school_nurse.school_nurse.view_a_masterlist') }}">
                                        <div class="hidden">
                                            <input type="search" class="border-dark col-1 " id="text-srh" name="class"
                                                value="{{ $record->id }}" placeholder="Search" readonly>
                                        </div>
                                        <button type="submit" class="d-inline-flex align-items-center justify-content-center 
                                            btn card-hover">
                                            &nbsp;&nbsp;View Masterlist
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
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

    <div class="col-12 px-0">
        <div class="card-body w-100 px-0">

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
