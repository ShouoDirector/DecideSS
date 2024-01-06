@if(count($dataClassRecord['getRecord']) !== 0)
<div class="d-flex row justify-content-end p-0 mb-3">
<div class="col-lg-3 col-md-6 col-12 print-btn btn btn-primary text-white text-right fs-3" onclick="printToPDF()">Print to PDF</div>
</div>
<div class="w-100 pb-3">
    <table class="table border table-striped border-2 border-dark text-nowrap">
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
            <td>{{ $value->bmiScore }}</td>
            <td>{{ $value->bmi }}</td>
            <td>{{ $value->hfa }}</td>

            </tr>
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
            {!! $dataClassRecord['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>
@else
<div class="d-flex bg-warning text-white">
    The class has no data. 
</div>
@endif
