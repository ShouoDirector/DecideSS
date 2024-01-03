<div class="card d-flex shadow-none row flex-row m-0">

    <div class="card col-12 m-0 shadow-none" style="height: fit-content;">
        <div class="card-body text-white p-0">
            <div class="d-flex flex-row align-items-center">
                <div class="card-hover d-flex">
                    <div class="ms-3">
                        @if(count($dataSchoolRecord['getRecord']) === 0)
                        No School found.
                        @else
                        @foreach($dataSchoolRecord['getRecord'] as $value)
                        @if(isset($schoolName[$value->school_id]))
                        @php
                        $schoolNameValue = $schoolName[$value->school_id];
                        $district = $districtName[$districtId[$value->school_id]];
                        $schoolyear = $school_Year[$value->schoolyear_id];
                        $schoolyearPhase = $schoolYearPhase[$value->schoolyear_id];
                        @endphp
                        @break
                        @endif
                        @endforeach

                        <h3 class="mb-0 text-dark fs-5">CONSOLIDATED NUTRITIONAL STATUS REPORT OF {{ $schoolNameValue }}
                        </h3>
                        <h4 class="mb-0 text-dark fs-6">{{ $district }} DISTRICT</h4>
                        <span class="text-dark">Baseline SY {{ $schoolyear }} {{ $schoolyearPhase }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex row justify-content-end col-12 gap-2" style="height: fit-content;">
        <div class="d-flex justify-content-end mb-1 col-auto font-medium m-0 p-0">
            <button type="button" class="btn btn-outline-primary card-hover mb-1 font-medium" data-bs-toggle="modal"
                data-bs-target="#submit-form" style="height: fit-content; width: fit-content;">
                Approve Report
            </button>
        </div>
        <div class="d-flex justify-content-end mb-1 col-auto font-medium m-0 p-0">
            <form class="d-flex row col-12 w-auto" action="#">
                <div class="hidden">
                    <input type="search" class="border-dark col-1 " id="text-srh" name="search"
                        value="{{ Request::get('search') }}" placeholder="Search" readonly>
                </div>
                <button type="submit" class="btn btn-outline-primary card-hover mb-1 font-medium"
                    style="height: fit-content; width: fit-content;">
                    View and Print
                </button>
            </form>
        </div>
    </div>

    @include('medical_officer.medical_officer.modals.submit-form')

    @include('medical_officer.medical_officer.modals.exit-na-class')


</div>

<div class="col-12 d-flex justify-content-between align-items-center mb-4">
    <a class="btn row d-lg-none d-flex justify-content-" data-bs-toggle="offcanvas" href="#offcanvasExample"
        role="button" aria-controls="offcanvasExample">
        <i class="ti ti-menu-2 fs-6"></i>
    </a>
</div>