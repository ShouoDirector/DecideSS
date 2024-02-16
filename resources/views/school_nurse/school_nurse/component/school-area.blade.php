<div class="card shadow-none">

    <div class="alert alert-primary alert-dismissible bg-primary text-white border-0 fade show d-none" role="alert">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        IMPORTANT: You must always check and approve all reports. Time and time again as class advisers may update their
        nutritional status reports.
    </div>

    @if(count($dataClassRecord['getRecord']) === 0)
    <div class="card-body p-0 m-0">

        <div class="table-responsive" style="width: max-content;">

            <table class="table table-striped stylish-table v-middle mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th></th>
                        <th class="border-0 fw-normal">Grade</th>
                        <th class="border-0 fw-normal">Adviser</th>
                        <th class="border-0 fw-normal">Action</th>
                    </tr>
                </thead>
                @if($filteredRecords->isNotEmpty())
                @foreach($filteredRecords as $index => $record)

                @for($i = 0; $i <= 6; $i++) @php $grade=($i==0) ? 'Kinder' : (string)$i; @endphp @if($record->
                    grade_level == $grade)
                    <tbody>
                        <tr>
                            <td class="align-middle py-3 pe-3">{{ $loop->iteration }}</td>
                            <td class="align-middle">
                                        <h6 class="font-weight-medium mb-0">{{ $sectionNames[$record->section_id] }}</h6>
                                        <small class="text-muted">Grade {{ $record->grade_level }}</small>
                                    </td>
                            <td class="align-middle card-hover text-dark pe-3">
                                {{ $classAdviserNames[$record->classadviser_id]  }}</td>

                            <td class="d-flex flex-column align-items-baseline justify-content-center">
                                <form class="d-flex row col-12 w-auto"
                                    action="{{ route('school_nurse.school_nurse.school') }}">
                                    <div class="hidden">
                                        <input type="search" class="border-dark col-1 " id="text-srh" name="search"
                                            value="{{ $record->id }}" placeholder="Search" readonly>
                                    </div>
                                    <button type="submit" class="d-inline-flex align-items-center justify-content-center 
                                        btn btn-circle btn-lg card-zoom
                                        {{ $index % 2 == 0 ? 'bg-outline-primary' : 'bg-outline-secondary' }}"
                                        data-bs-toggle="tooltip" data-bs-placement="right"
                                        data-bs-original-title="View More">
                                        <i class="fs-5 ti ti-door-enter text-dark card-zoom"></i>
                                    </button>
                                </form>
                                
                            </td>
                        </tr>
                    </tbody>
                    @endif
                    @endfor

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
