
@if(empty(Request::get('masterlist')))
<div class="d-flex row">
    <!-- CLASSES TABLE -->
    <div class="col-md-5">
        @if(count($dataSchools['getList']) !== 0 && empty(Request::get('search')))
        <div class="d-flex row justify-content-start">
            <div class="table-responsive pb-3">
                <table class="table border table-striped table-bordered text-nowrap">
                    <thead>
                        <!-- start row -->
                        <tr>
                            <th></th>
                            <th>School Name</th>
                            <th>CNSR</th>
                            <th></th>
                        </tr>
                        <!-- end row -->
                    </thead>
                    <tbody>
                        @if(count($dataSchools['getList']) === 0)
                        <tr>
                            <td colspan="12" class="text-center">No class selected</td>
                        </tr>
                        @else

                        @foreach($dataSchools['getList'] as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->school }}</td>
                            <td>
                            <span class="fs-3 mt-1 badge {{ $dataCNSRLists['getRecord']->pluck('school_id')->flatten()->contains($value->id) ? 'bg-primary' : 'bg-secondary' }}">
                                {{ $dataCNSRLists['getRecord']->pluck('school_id')->flatten()->contains($value->id) ? 'Yes' : 'Not Yet' }}
                            </span>
                            </td>
                            <td>
                                <form class="d-flex align-items-center"
                                    action="{{ route('medical_officer.medical_officer.schools') }}">
                                    <input type="number" name="class" value="{{ $value->id }}" class="hidden">
                                    <button type="submit" class="btn btn-primary text-white py-1 px-3">Select
                                    </button>
                                    @if(!empty(Request::get('class')) && Request::get('class') == $value->id
                                    )
                                    <i class="ti ti-arrow-right fs-5 ms-3"></i>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        <!-- End row -->
                    </tbody>
                </table>

            </div>
        </div>
        @else
        @endif
    </div>
    @if(!empty(Request::get('class')))
    <div class="d-flex row col-md-7" style="height: fit-content;">

    <div class="p-1">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold">General</h5>
                    <p class="card-subtitle mb-7">Related Information</p>
                    <div class="col-12">
                        @php
                        $getData = $dataSection['getData']->toArray();
                        @endphp
                        <div class="d-flex justify-content-between">
                            <div class="card-subtitle mb-2 text-muted text-muted">School</div>
                            <div class="fs-4">{{$classSchool[Request::get('class')]}}</div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-between">
                            <div class="card-subtitle mb-2 text-muted text-muted">School Nurse
                            </div>
                            <div class="fs-4">{{$schoolNursesNames[$classSchoolNurseId[Request::get('class')]]}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        

    <div class="col-md-6 p-1">
        <div class="card border-start mb-0 border-primary border-2 shadow">
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title fw-semibold">Beneficiaries</h5>
                    <p class="card-subtitle mb-7">And Healthcare Services</p>
                    <div class="col-12 mb-3">
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">No. of Beneficiaries</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->count() }}</div>

                        </div>
                        <hr>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Feeding</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_feeding_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Deworming</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_deworming_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Immunization</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_immunization_vax_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Mental Healthcare</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_mental_healthcare_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Dental Care</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_dental_care_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Medical Support</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_medical_support_program', '1')->count() }}</div>
                        </div>
                        <div class="fs-4 d-flex row justify-content-between">
                            <div class="col-auto">Nursing Services</div>
                            <div class="col-auto">
                                {{ $dataBeneficiary['getData']->where('is_nursing_services', '1')->count() }}</div>
                        </div>
                    </div>

                    <a type="button" class="btn btn-outline-primary w-100"
                        href="{{ route('medical_officer.medical_officer.view_healthcare', ['search' => Request::get('class')]) }}">View Beneficiaries</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 p-1">
            <div class="card border-start mb-0 border-primary border-2 shadow">
                <div class="card-body">
                    <div class="row">
                        <h5 class="card-title fw-semibold">Demographic Data</h5>
                        <p class="card-subtitle mb-7">Based on all MasterLists*</p>
                        <div class="col-12 mb-3">
                            <div class="fs-4 d-flex row justify-content-between">
                                <div class="col-auto">Male</div>
                                @php 
                                    $countMale = 0; 
                                    $countFemale = 0;
                                    $countTotal = 0;
                                @endphp
                                @foreach($dataMasterList['getRecord'] as $pupil)
                                        @php $countTotal++; @endphp
                                    @if($dataPupilGender[$pupil->pupil_id] == 'Male')
                                        @php $countMale++; @endphp
                                    @elseif($dataPupilGender[$pupil->pupil_id] == 'Female')
                                        @php $countFemale++; @endphp
                                    @endif
                                @endforeach
                                <div class="col-auto">{{ $countMale }}</div>
                            </div>
                            <div class="fs-4 d-flex row justify-content-between">
                                <div class="col-auto">Female</div>
                                <div class="col-auto">{{ $countFemale }}</div>
                            </div>
                            <hr>
                            <div class="fs-4 d-flex row justify-content-between">
                                <div class="col-auto">Total</div>
                                <div class="col-auto">{{ $countTotal }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="col-md-6 p-1">
    <a href="{{ route('medical_officer.medical_officer.cnsr_main', ['search' => Request::get('class') ]) }}" class="btn btn-primary text-white mt-2">
        Consolidated Nutritional Status Report
    </a>
    <a href="{{ route('medical_officer.medical_officer.view_healthcare', ['search' => Request::get('class') ]) }}" class="btn btn-primary text-white mt-2">
        Healthcare Services Report
    </a>
    <a href="{{ route('medical_officer.medical_officer.schools', ['masterlist' => Request::get('class') ]) }}" class="btn btn-primary text-white mt-2">
        Masterlist Reports
    </a>
    </div>

    
    @endif
</div>
@endif

@if(!empty(Request::get('masterlist')))
            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('medical_officer.medical_officer.schools', ['class' => Request::get('class')]) }}" class="print-btn col-md-2 col-sm-4 col-6 btn btn-secondary text-white">Back</a>
                </div>
<div class="d-flex row">
                <!-- CLASSES TABLE -->
                <div class="col-md-6">
                    @if(empty(Request::get('search')) && empty(Request::get('class')))
                    <div class="d-flex row justify-content-start">
                        <div class="table-responsive pb-3">
                            <table class="table border table-striped table-bordered text-nowrap">
                                <thead>
                                    <!-- start row -->
                                    <tr>
                                        <th></th>
                                        <th>Section Name</th>
                                        <th>Grade Level</th>
                                        <th></th>
                                    </tr>
                                    <!-- end row -->
                                </thead>
                                <tbody>
    @if($dataClassList['classRecords'] === null || count($dataClassList['classRecords']) === 0)
        <tr>
            <td colspan="12" class="text-center">No classes</td>
        </tr>
    @else
        @php
            $customSortOrder = ['Kinder', '1', '2', '3', '4', '5', '6', 'SPED'];
            // Ensure $dataClassList['classRecords'] is an array before sorting
            $orderedClassRecords = collect($dataClassList['classRecords'])
                ->sortBy(function ($record) use ($customSortOrder) {
                    return array_search($record->grade_level, $customSortOrder);
                });
        @endphp

        @foreach($orderedClassRecords as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $value->section }}</td>
                <td>{{ $value->grade_level }}</td>
                <td>
                    <form class="d-flex align-items-center"
                        action="{{ route('medical_officer.medical_officer.masterlist_view', ['masterlist' => $value->id ]) }}">
                        <input type="number" name="section" value="{{ $value->id }}" class="hidden">
                        <button type="submit" class="btn btn-primary text-white py-1 px-3">View MasterList</button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endif
</tbody>


                            </table>

                        </div>
                    </div>
                    @else
                    @endif
                </div>

</div>
        
@endif