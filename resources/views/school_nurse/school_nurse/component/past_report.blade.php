<form class="d-flex" action="{{ route('school_nurse.school_nurse.past_reports') }}">
    <select class="form-select rounded-0" style="border: 1px solid blue;" name="schoolYear" id="schoolYear">
        <option value="" default selected disabled>
            Select School Year
        </option>
        @foreach($listOfSchoolYears['getList'] as $year)
        <option value="{{ $year->id }}" @if(Request::get('schoolYear')==$year->id) selected @endif>
            {{ $year->school_year }}
        </option>
        @endforeach
    </select>
    <select class="form-select rounded-0 ms-1" style="border: 1px solid blue;" name="reportType" id="reportType">
        <option value="" default selected disabled>
            Select Report
        </option>
        <option value="1" @if(Request::get('reportType') == 1) selected @endif>Nutritional Status & Masterlist Report</option>
        <option value="2" @if(Request::get('reportType') == 2) selected @endif>Health Services Report</option>
        <option value="3" @if(Request::get('reportType') == 3) selected @endif>School Consolidated Nutritional Status Report</option>
    </select>
    <button class="btn btn-primary rounded-0 ms-1" type="submit">Find</button>
</form>

@if(Request::get('schoolYear') && Request::get('reportType') == 1)
<div class="table-responsive mt-2">

    <table class="table border-info table-bordered mb-0 text-nowrap">
        <thead class="bg-info border-info border-1">
            <tr>
                <th class="border-1 fw-normal">Grade Level</th>
                <th class="border-1 fw-normal">Class</th>
                <th class="border-1 fw-normal">Adviser</th>
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
                <td class="d-flex align-items-baseline justify-content-start">
                    <form class="d-flex row w-auto" action="{{ route('school_nurse.school_nurse.past_reports') }}">
                        <input type="text" name="schoolYear" class="d-none" value="{{ Request::get('schoolYear') }}">
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
@endif

<div class="d-flex row w-100">
    <div class="col-12 px-0">
        <div class="card-body w-100 px-0">
            <div class="tab-content">
                <div class="tab-pane active show" id="home2" role="tabpanel">
                    <div class="p-3">
                        <!-- =========================================TABLE FILTER - PUPILS ====================================== -->
                        @if(count($dataClassRecord['getRecord']) !== 0 && Request::get('reportType') == 1)

                        @include('school_nurse.school_nurse.component.past_cnsr_class')

                        @include('school_nurse.school_nurse.component.submitted_nsr_class')
                        <!-- ========================================= REPORT TABLE ====================================== -->
                        @include('school_nurse.school_nurse.tables.submitted_nsr')
                        @else
                        @endif

                        @if(Request::get('schoolYear') && Request::get('reportType') == 2)
                            @include('school_nurse.school_nurse.component.health_table_past')
                        @endif

                        @if(Request::get('schoolYear') && Request::get('reportType') == 3)
                            @include('school_nurse.school_nurse.component.past_nsr_list')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
