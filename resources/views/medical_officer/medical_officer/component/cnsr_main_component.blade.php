<div class="card shadow-none">

    @if(count($dataSchoolRecord['getRecord']) === 0)
    <div class="card-body py-0">

        <div class="table-responsive">

            <table class="table stylish-table v-middle mb-0 text-nowrap">
                <thead>
                    <tr>
                        <th class="border-0 fw-normal"></th>
                        <th class="border-0 fw-normal">School</th>
                        <th class="border-0 fw-normal">District</th>
                        <th class="border-0 fw-normal">Address</th>
                        <th class="border-0 fw-normal">By School Nurse</th>
                        <th class="border-0 fw-normal"></th>
                    </tr>
                </thead>
                @if($filteredRecords->isNotEmpty() && $activeSchoolYear['getRecord']->isNotEmpty())
                @foreach($filteredRecords as $index => $record)
                <tbody>

                    @if($schoolIds->contains($record->id))
                    <tr>
                        <td>
                            <span class="round-40 text-white d-flex align-items-center justify-content-center text-center rounded-circle 
                                {{ $index % 2 == 0 ? 'bg-primary' : 'bg-secondary' }}">
                                {{ strtoupper(substr($record->school, 0, 1)) }}</span>
                        </td>
                        <td class="align-middle card-hover">{{ $record->school }} <br>
                            <small class="text-muted">School ID {{ $record->school_id }}</small>
                        </td>
                        <td class="d-flex flex-column align-items-baseline justify-content-center card-hover">
                            <h6 class="font-weight-medium mb-0">{{ $districtName[$record->district_id] }}</h6>
                        </td>
                        <td class="align-middle card-hover">{{ $record->address_barangay }}</td>
                        <td class="align-middle">
                            <span class="badge px-3 py-2 card_hover {{ $schoolIds->contains($record->id) 
                                ? ($index % 2 == 0 ? 'bg-primary rounded' : 'bg-secondary rounded') 
                                : 'bg-danger rounded' }}">
                                {{ $schoolIds->contains($record->id) 
                                ? "Submitted by " . $schoolNursesNames[$record->school_nurse_id] 
                                : $schoolNursesNames[$record->school_nurse_id] . " has yet to submit" }}
                                <i class="ti {{ $schoolIds->contains($record->id) ? 'ti-check' : 'ti-x' }} fs-5"></i>
                            </span>

                        </td>
                        <td class="d-flex flex-column align-items-baseline justify-content-center">
                            <form class="d-flex row col-12 w-auto"
                                action="{{ route('medical_officer.medical_officer.cnsr_main') }}">
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
            <div class="tab-content">

                <div class="tab-pane active show" id="home2" role="tabpanel">
                    <div class="p-3">

                        <!-- =========================================TABLE FILTER - PUPILS ====================================== -->

                        @if(count($dataSchoolRecord['getRecord']) !== 0)
                        @include('medical_officer.medical_officer.component.submitted_cnsr_class')
                        <!-- ========================================= REPORT TABLE ====================================== -->
                        @include('medical_officer.medical_officer.tables.submitted_cnsr')
                        
                        @else
                        @endif

                    </div>
                </div>

            </div>
            <!-- Tab panes -->

        </div>
    </div>

</div>
