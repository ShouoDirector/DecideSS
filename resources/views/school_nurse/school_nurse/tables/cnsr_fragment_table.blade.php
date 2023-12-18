@if(count($dataClassRecord['getRecord']) !== 0)
<div class="print-btn float-right" onclick="printToPDF()">Print to PDF</div>
<div class="table w-100 pb-3">
    <table class="table border border-2 border-dark table-bordered text-nowrap mt-3">
        <thead>
            <!-- start row -->
            <tr>
                <th></th>
                <th>Pupil Name</th>
                <th>Date of Birth</th>
                <th>Weight <br> (kg)</th>
                <th>Height <br> (m)</th>
                <th>Sex</th>
                <th>Height<br> (m<sup>2</sup>)</th>
                <th>Age <br>
                    (y, m)</th>
                    <th>Body Mass <br>
                    Index <br>
                    (kg/m<sup>2</sup>)</th>
                <th>Body Mass <br>
                    Index <br>
                    Category</th>
                <th>Height For <br>
                Age <br>
                Category</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataClassRecord['getRecord']) === 0)
            <tr>
                <td colspan="12" class="text-center">No class selected</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataClassRecord['getRecord'] as $value)

            <tr>
            <td>{{ $loop->iteration }}</td>
            <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
            <td> {{ \Carbon\Carbon::parse($dataPupilBDate[$value->pupil_id])->format('F j, Y') }} </td>
            <td> {{ $value->weight }}</td>
            <td> {{ $value->height }}</td>
            <td> {{ $dataPupilSex[$value->pupil_id] }}</td>
            <td> {{ number_format($value->height_squared, 2) }}</td>
            @php
                $birthdate = \Carbon\Carbon::parse($dataPupilBDate[$value->pupil_id]);
                $age = $birthdate->diff(\Carbon\Carbon::now());
            @endphp
            <td>{{ $age->y }} y, {{ $age->m }} m</td>
            <td>{{ $value->bmi }}</td>
            <td>{{ $value->bmiCategory }}</td>
            <td>{{ $value->hfaCategory }}</td>

            </tr>
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>
    <div class="d-flex row mt-5">
        <div class="d-flex row col-6">
            <div class="fs-2 fw-bolder mb-1">
                Prepared By:
            </div>
            <div class="mt-3">{{ $classAdviserNames[$value->class_adviser_id] }}</div>
            <div class="fs-2 fw-bolder mb-1">
                Class Adviser
            </div>
        </div>
        <div class="d-flex row col-6">
            <div class="fs-1 mb-1 d-flex text-gray justify-content-end">
            
            </div>
            <div></div>
            <div class="fs-1 mb-1 d-flex justify-content-end">
                NSR CODE : #{{ $nsrCodes[$value->nsr_id] }} 
                @php echo now()->toDateTimeString(); @endphp
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
            {!! $dataClassRecord['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>

@else
<div class="d-flex bg-warning text-white">
    The NSR has no data. 
</div>
@endif
