@if(count($data['getRecord']) !== 0)
<div class="d-flex row justify-content-end">
<div class="col-lg-4 col-md-6 col-12 print-btn btn btn-primary text-white text-right fs-3" onclick="printToPDF()">Print to PDF</div>
</div>
<div class="w-100 pb-3">
<table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th></th>
                <th>LRN</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Guardian</th>
                <th>Guardian Contact No.</th>
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
            <td> {{ !empty($dataPupilAddress[$value->pupil_id]) ? $dataPupilAddress[$value->pupil_id] : 'None' }} </td>
            <td>{{ !empty($dataPupilGuardian[$value->pupil_id]) ? $dataPupilGuardian[$value->pupil_id] : 'None' }}</td>
            <td>{{ !empty($dataPupilGuardianCo[$value->pupil_id]) ? $dataPupilGuardianCo[$value->pupil_id] : 'None' }}</td>
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
