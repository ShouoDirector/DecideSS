@if(count($getHealthRecords['getList']) !== 0)
<div class="table w-100 pb-3">

    <div class="print-btn rounded btn btn-primary text-white text-right fs-3 position-fixed w-auto"
        style="bottom: 10px; right: 10px;" onclick="printToPDF()"><i class="ti ti-printer"></i></div>
    <button class="print-btn w-auto position-fixed btn btn-secondary text-white" style="bottom: 10px; right: 65px;"
        onclick="window.location.href='{{ url()->previous() }}'"><i class="ti ti-arrow-left"></i></button>


    <h5 class="text-center fw-bolder">HEALTH SERVICES REPORT OF
        {{ strtoupper($schoolName[$getSchoolId]) }}</h5>
    <h6 class="text-center">{{ strtoupper($districtName[$districtId[$getSchoolId]]) }} DISTRICT</h6>
    <h6 class="text-center">{{ $schoolYearPhaseName }}</h6>

    <table class="table border table-bordered text-nowrap mt-5">
        <thead>
            <!-- start row -->
            <tr class="border border-2 border-dark text-center">
                <th rowspan="4">Grade<br>Levels</th>
                <th colspan="2" rowspan="4">Total of<br>Beneficiaries</th>
            </tr>
            <tr class="border border-2 border-dark">
                <th colspan="20" class="bg-light-primary text-bold text-center">HEALTHCARE SERVICES</th>
            </tr>
            <tr class="border border-2 border-dark text-center">
                <th colspan="2" class="fs-1">Feeding Program</th>
                <th colspan="2" class="fs-1">Immunization Vax Program</th>
                <th colspan="2" class="fs-1">Deworming Program</th>
                <th colspan="2" class="fs-1">Dental Care Program</th>
                <th colspan="2" class="fs-1">Mental HealthCare Program</th>
                <th colspan="2" class="fs-1">Eye Care Program</th>
                <th colspan="2" class="fs-1">health & Wellness Program</th>
            </tr>
            <tr class="border border-2 border-dark text-center">
                @php
                $columns = ['No', '%'];
                $numColumns = 8; // Adjust the number of columns as needed
                @endphp

                @for ($i = 1; $i < $numColumns; $i++) 
                    @foreach ($columns as $column) <th colspan="1" class="fs-1">{{ $column }}</th>
                    @endforeach
                @endfor
            </tr>

            <!-- end row -->
        </thead>
        <tbody>

            @include('school_nurse.school_nurse.component.health_list_rows')

            <!-- End row -->
        </tbody>

    </table>

    <div class="d-flex row mt-5">
        <div class="d-flex row col-6">
            <div class="fs-2 fw-bolder mb-1">
                Prepared By:
            </div>
            <div>{{ Auth::user()->name }}</div>
            <div class="fs-2 fw-bolder mb-1">
                School Nurse
            </div>
        </div>

    </div>

</div>
@else
<div class="d-flex bg-dark text-white p-5">
    Attention: The Healthcare Services Report currently contains no data. As the school nurse, it is
    imperative that you health assess the pupils in your school.

    <br>Please be mindful that thorough completion of Healthcare Services Report is critical, as inaccuracies may have a
    cascading effect on existing data and impact the overall statistical integrity of your school's health records and
    status.
</div>

<div class="d-flex row justify-content-end">
    <button class="print-btn col-md-2 col-sm-4 col-6 btn btn-primary mt-2 text-white"
        onclick="window.location.href='{{ url()->previous() }}'">Okay</button>

</div>

@endif
