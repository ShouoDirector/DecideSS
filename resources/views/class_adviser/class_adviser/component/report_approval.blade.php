<div class="card shadow-none">

    <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
        <a href="{{ route('class_adviser.class_adviser.nutritional_assessment') }}" type="button"
            class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Create</a>
        <a href="{{ route('class_adviser.class_adviser.approved_report') }}" type="button"
            class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Nutritional
            Status Report</a>
    </div>
    <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
        <a href="#" type="button"
            class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Review &
            Approve</a>
        <a href="{{ route('class_adviser.class_adviser.edit_na') }}"
            class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-5 col-sm-7 justify-content-center">
            Nutritional Assessments
        </a>
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
                        <th class="border-0 fw-normal">Status</th>
                        <th class="border-0 fw-normal">Action</th>
                    </tr>
                </thead>
                @if($filteredRecords->isNotEmpty() && $activeSchoolYear['getRecord']->isNotEmpty())
                @foreach($filteredRecords as $index => $record)
                <tbody>
                    <tr>
                        <td>
                            <span class="round-40 text-white d-flex align-items-center justify-content-center text-center rounded-circle 
                                {{ $index % 2 == 0 ? 'bg-primary' : 'bg-secondary' }}">
                                {{ strtoupper(substr($record->section, 0, 1)) }}</span>
                        </td>
                        <td class="d-flex flex-column align-items-baseline justify-content-center card-hover">
                            <h6 class="font-weight-medium mb-0">{{ $record->section }}</h6>
                            <small class="text-muted">Grade {{ $record->grade_level }}</small>
                        </td>
                        <td class="align-middle card-hover">{{ $schoolName[$record->school_id] }}</td>
                        <td class="align-middle">
                            <span
                                class="badge px-3 py-2 card-hover
                            {{ $sectionIds->contains($record->id) ? ($index % 2 == 0 ? 'bg-primary rounded' : 'bg-secondary') : 'bg-danger rounded' }}">
                                {{ $sectionIds->contains($record->id) ? 'You submitted' : 'You are yet to submit' }}
                                <i class="ti {{ $sectionIds->contains($record->id) ? 'ti-check' : 'ti-x' }} fs-5"></i>
                            </span>
                        </td>
                        <td class="d-flex flex-column align-items-baseline justify-content-center">
                            <form class="d-flex row col-12 w-auto"
                                action="{{ route('class_adviser.class_adviser.report_approval') }}">
                                <div class="hidden">
                                    <input type="search" class="border-dark col-1" id="text-srh" name="search"
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

<div class="d-flex">

    <div class="col-12 p-0">
        <div class="card-body w-100">

            <!-- Nav tabs -->

            <!-- Tab panes -->

            <div class="tab-content">

                <div class="tab-pane active show" id="home2" role="tabpanel">
                    <div class="p-0">

                        <!-- =========================================TABLE FILTER - PUPILS ====================================== -->

                        @if(count($dataClassRecord['getRecord']) !== 0)
                        @include('class_adviser.class_adviser.component.classes')
                        <!-- ========================================= REPORT TABLE ====================================== -->
                        @include('class_adviser.class_adviser.tables.report')
                        @else
                        @endif

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
