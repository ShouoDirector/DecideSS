@if(count($data['getRecord']) !== 0)
    <!-- Print to PDF button -->

    <div class="print-btn rounded btn btn-primary text-white text-right fs-3 position-fixed w-auto" style="bottom: 10px; right: 10px;" onclick="printToPDF()"><i class="ti ti-printer"></i></div>
    <button class="print-btn w-auto position-fixed btn btn-secondary text-white" style="bottom: 10px; right: 65px;" onclick="window.location.href='{{ url()->previous() }}'"><i class="ti ti-arrow-left"></i></button>

    <!-- Gender-wise tables -->
    @foreach(['Male', 'Female'] as $gender)
        <div class="w-100 pb-3 mt-3">
            <h2 class="fs-4 px-0 py-2">{{ $gender }}s</h2>
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
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
                </thead>
                <tbody>
                    @php
                        $filteredRecords = $data['getRecord']->filter(function ($record) use ($gender, $dataPupilGender) {
                            return isset($dataPupilGender[$record->pupil_id]) && $dataPupilGender[$record->pupil_id] === $gender;
                        });
                    @endphp

                    @if(count($filteredRecords) === 0)
                        <tr>
                            <td colspan="9" class="text-center">No {{ strtolower($gender) }} pupils</td>
                        </tr>
                    @else
                        @foreach($filteredRecords as $value)
                            <tr>
                                <td>{{ $loop->index + 1 + ($data['getRecord']->perPage() * ($data['getRecord']->currentPage() - 1)) }}</td>
                                <td>{{ $dataPupilLRNs[$value->pupil_id] }}</td>
                                <td>{{ $dataPupilNames[$value->pupil_id] }}</td>
                                <td>{{ now()->diff($dataPupilBDate[$value->pupil_id])->y }} years old</td>
                                <td>{{ $dataPupilGender[$value->pupil_id] }}</td>
                                <td>{{ !empty($dataPupilAddress[$value->pupil_id]) ? $dataPupilAddress[$value->pupil_id] : 'None' }}</td>
                                <td>{{ !empty($dataPupilGuardian[$value->pupil_id]) ? $dataPupilGuardian[$value->pupil_id] : 'None' }}</td>
                                <td>{{ !empty($dataPupilGuardianCo[$value->pupil_id]) ? $dataPupilGuardianCo[$value->pupil_id] : 'None' }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    @endforeach

@else
    <!-- No data warning -->
    <div class="d-flex bg-warning text-white">
        The class has no data.
    </div>
@endif
