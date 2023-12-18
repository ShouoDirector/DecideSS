<div class="table-responsive w-100 pb-3">
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
            <td> {{ $value->id }}</td>
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

    <div class="d-flex justify-content-end">
            {!! $data['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>
