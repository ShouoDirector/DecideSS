<div class="print-btn" onclick="printToPDF()">Print to PDF</div>
<div class="table w-100 pb-3">
    <h5 class="text-center fw-bolder">HEALTHCARE SERVICES REPORT OF {{ strtoupper($schoolName[$getSchoolId]) }}</h5>
    <h6 class="text-center">{{ strtoupper($districtName[$districtId[$getSchoolId]]) }} DISTRICT</h6>
    <h6 class="text-center">{{ $schoolYearPhaseName }}</h6>

    <div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
    Feeding Program
</div>
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>No.</th>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Class</th>
                <th>Class Adviser</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataProgram['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataProgram['getRecord'] as $value)
            @if($value->is_feeding_program == '1')
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                <td> {{ $adviserName[$value->classadviser_id] }}</td>
            </tr>
            @endif
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>
</div>

<div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
    Deworming Program
</div>
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>No.</th>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Class</th>
                <th>Class Adviser</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataProgram['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataProgram['getRecord'] as $value)
            @if($value->is_deworming_program == '1')
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                <td> {{ $adviserName[$value->classadviser_id] }}</td>
            </tr>
            @endif
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>
</div>

<div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
    Immunization Vax Program
</div>
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>No.</th>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Class</th>
                <th>Class Adviser</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataProgram['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataProgram['getRecord'] as $value)
            @if($value->is_immunization_vax_program == '1')
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                <td> {{ $adviserName[$value->classadviser_id] }}</td>
            </tr>
            @endif
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>
</div>

<div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
    Mental HealthCare Program
</div>
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>No.</th>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Class</th>
                <th>Class Adviser</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataProgram['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataProgram['getRecord'] as $value)
            @if($value->is_mental_healthcare_program == '1')
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                <td> {{ $adviserName[$value->classadviser_id] }}</td>
            </tr>
            @endif
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>
</div>

<div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
    Dental Care Program
</div>
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>No.</th>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Class</th>
                <th>Class Adviser</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataProgram['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataProgram['getRecord'] as $value)
            @if($value->is_dental_care_program == '1')
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                <td> {{ $adviserName[$value->classadviser_id] }}</td>
            </tr>
            @endif
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>
</div>

<div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
    Eye Care Program
</div>
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>No.</th>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Class</th>
                <th>Class Adviser</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataProgram['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataProgram['getRecord'] as $value)
            @if($value->is_eye_care_program == '1')
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                <td> {{ $adviserName[$value->classadviser_id] }}</td>
            </tr>
            @endif
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>
</div>

<div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
    Health And Wellness Program
</div>
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>No.</th>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Class</th>
                <th>Class Adviser</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataProgram['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataProgram['getRecord'] as $value)
            @if($value->is_health_wellness_program == '1')
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                <td> {{ $adviserName[$value->classadviser_id] }}</td>
            </tr>
            @endif
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>
</div>

<div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
    Medical Support Program
</div>
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>No.</th>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Class</th>
                <th>Class Adviser</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataProgram['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataProgram['getRecord'] as $value)
            @if($value->is_medical_support_program == '1')
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                <td> {{ $adviserName[$value->classadviser_id] }}</td>

            </tr>
            @endif
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>
</div>

<div class="row px-3 py-3 fs-4 fw-semibold mb-3 bg-light-primary">
    Nursing Services
</div>
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>No.</th>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Class</th>
                <th>Class Adviser</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataProgram['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataProgram['getRecord'] as $value)
            @if($value->is_nursing_services == '1')
            <tr>
                <td> {{ $loop->iteration }} </td>
                <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                <td> {{ $adviserName[$value->classadviser_id] }}</td>

            </tr>
            @endif
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $dataProgram['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>
</div>

<div class="d-flex row mt-5">
        <div class="d-flex row col-6">
            <div class="fs-2 fw-bolder mb-1">
                Prepared By:
            </div>
            <div></div>
            <div class="fs-2 fw-bolder mb-1">
                School Nurse
            </div>
        </div>
        <div class="d-flex row col-6">
            <div class="fs-2 fw-bolder mb-1">
                Noted By:
            </div>
            <div></div>
            <div class="fs-2 fw-bolder mb-1">
                School Head
            </div>
        </div>
    </div>

</div>