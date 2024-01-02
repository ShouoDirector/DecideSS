@if(count($data['getRecord']) !== 0)
<div class="print-btn text-right fs-5" onclick="printToPDF()">Print to PDF</div>
<div class="w-100 pb-3">
<table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>LRN</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Classroom</th>
                <th>School Year | Phase</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($data['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($data['getRecord'] as $value)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
            <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
            <td> {{ now()->diff($dataPupilBDate[$value->pupil_id])->y }} years old</td>
            <td> {{ $dataPupilGender[$value->pupil_id] }}</td>
            <td> {{ $dataPupilAddress[$value->pupil_id]}}</td>
            <td> {{ $dataClassNames[$value->class_id] }}</td>
            <td> {{ $dataSchoolYearPhaseNames[$value->schoolyear_id] }} </td>
            </tr>
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

</div>
@else
<div class="d-flex bg-warning text-white">
    The class has no data. 
</div>
@endif
