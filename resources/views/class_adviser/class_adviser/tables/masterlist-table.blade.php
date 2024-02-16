<div class="table-responsive w-100 pb-3">
    <table class="table border table-bordered table-striped text-nowrap" id="masterlistTable">
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

        @php
            // Sort the getRecord array based on the gender
            $sortedRecords = $data['getRecord']->sortBy(function($record) use ($dataPupilGender) {
                return $dataPupilGender[$record->pupil_id];
            });
        @endphp

        <tbody>
        @if(count($sortedRecords) === 0)
            <tr>
                <td colspan="8" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($sortedRecords as $value)
            <tr class="card-hover">
            <td>{{ $loop->index + 1 + ($data['getRecord']->perPage() * 
                                ($data['getRecord']->currentPage() - 1)) }}</td>
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
                                href="{{ route('class_adviser.class_adviser.search_pupil', ['search' => $dataPupilLRNs[$value->pupil_id]]) }}">
                                <i class="fs-4 ti ti-edit"></i>View Details
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
    {!! $data['getRecord']->appends(request()->query())->links() !!}
</div>

</div>
