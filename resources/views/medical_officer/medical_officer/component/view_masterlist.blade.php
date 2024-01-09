<div class="card d-flex shadow-none row flex-row m-0 mb-3">

    <div class="card col-lg-4 col-md-6 col-12 m-0 shadow-none" style="height: fit-content;">
        <div class="card-body text-white p-0">
            <div class="d-flex flex-row align-items-center">
                <div class="card-hover d-flex">
                    <div class="ms-3">
                        @if(count($data['getRecord']) === 0)
                        No Class found.
                        @else
                        @foreach($data['getRecord'] as $value)
                        @if(isset($className[$value->class_id]))
                        @php
                        $classNameValue = $className[$value->class_id];
                        $gradeLevel = $classGradeLevel[$value->class_id];
                        @endphp
                        @break
                        @endif
                        @endforeach
                        <h3 class="mb-1 text-dark fs-6">School : {{ $schoolName[$classSchoolId[$value->class_id]] }}</h3>
                        <h4 class="mb-0 text-dark fs-5">Grade : {{ $gradeLevel }}</h4>
                        <span class="text-dark fs-4">Section : {{ $classNameValue ?? 'No Class found' }} </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('class_adviser.class_adviser.modals.exit-na-class')


</div>

@if(count($data['getRecord']) !== 0)
    <!-- Print to PDF button -->
    <div class="d-flex row justify-content-end p-0 mb-3">
        <div class="col-lg-3 col-md-6 col-12 print-btn btn btn-primary text-white text-right fs-3" onclick="printToPDF()">Print to PDF</div>
    </div>
    
    <!-- Gender-wise tables -->
    @foreach(['Male', 'Female'] as $gender)
        <div class="w-100 pb-3 mt-5">
            <h2 class="fs-4 px-3 py-2">{{ $gender }}s</h2>
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
                            <td colspan="7" class="text-center">No {{ strtolower($gender) }} pupils</td>
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
    <div class="d-flex bg-dark p-3 text-white">
        The masterlist has no data.
    </div>
    <div class="d-flex justify-content-end mt-3">
                <button class="print-btn col-md-2 col-sm-4 col-6 btn btn-secondary text-white" onclick="window.location.href='{{ url()->previous() }}'">Okay</button>
                </div>
@endif
