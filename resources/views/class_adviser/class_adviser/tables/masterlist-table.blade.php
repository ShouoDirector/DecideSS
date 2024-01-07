<div class="table-responsive w-100 pb-3">
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
                <th>Guardian Name</th>
                <th>Guardian Contact No</th>
                <th></th>
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
            <td> {{ $loop->iteration }}</td>
            <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
            <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
            <td> {{ now()->diff($dataPupilBDate[$value->pupil_id])->y }} years old</td>
            <td> {{ $dataPupilGender[$value->pupil_id] }}</td>
            <td> {{ !empty($dataPupilAddress[$value->pupil_id]) ? $dataPupilAddress[$value->pupil_id] : 'None' }} </td>
            <td>{{ !empty($dataPupilGuardian[$value->pupil_id]) ? $dataPupilGuardian[$value->pupil_id] : 'None' }}</td>
            <td>{{ !empty($dataPupilGuardianCo[$value->pupil_id]) ? $dataPupilGuardianCo[$value->pupil_id] : 'None' }}</td>
            <td>
                <div class="dropdown dropstart text-center">
                    <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="ti ti-tool fs-6"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-3"
                                href="{{ route('class_adviser.class_adviser.pupil_to_masterlist', ['search' => $dataPupilLRNs[$value->pupil_id]]) }}">
                                <i class="fs-4 ti ti-edit"></i>Add Pupil To MasterList
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
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
