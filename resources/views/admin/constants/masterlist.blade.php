@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">

        @include('admin.segments.segment_head')

        <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
            <a href="{{ route('admin.admin.manage_schools') }}" type="button"
                        class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Manage</a>
            <a href="#" type="button"
                        class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">MasterList</a>
        </div>

        @php
            $schoolId = Request::get('schoolId');
            $districtId = Request::get('districtId');
            $sectionId = Request::get('sectionId');
            $classId = Request::get('classId');
        @endphp

        <div class="d-flex row">
            <div class="accordion accordion-flush mb-5 card position-relative overflow-hidden" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            MasterList Table
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body fw-normal">

                        @php
                        $schoolId = Request::get('schoolId');
                        $districtId = Request::get('districtId');
                        $sectionId = Request::get('sectionId');
                        $classId = Request::get('classId');
                        @endphp

                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="px-0">District</td>
                                    <td class="font-weight-medium px-0">{{ $districtName[$districtId] }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0">School</td>
                                    <td class="font-weight-medium px-0">{{ $schoolName[$schoolId] }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0">Grade & Section</td>
                                    <td class="font-weight-medium px-0">Grade {{ $sectionGradeLevel[$sectionId] }} -
                                        {{ $sectionName[$sectionId] }}</td>
                                </tr>
                                <tr>
                                    <td class="px-0">Class Adviser</td>
                                    <td class="font-weight-medium px-0">{{ $userName[$classAdviserId[$classId]] }}</td>
                                </tr>
                            </tbody>
                        </table>

                            <div class="table-responsive pb-3 mb-5">
                                <div class="table-responsive pb-3 mb-5">
                                    <table class="user_table table border table-striped table-bordered text-nowrap">
                                        <thead>
                                            <!-- start row -->
                                            <tr>
                                                <th>ID</th>
                                                <th>LRN</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Date of Birth</th>
                                                <th>Guardian Name</th>
                                                <th>Guardian Contact No.</th>
                                                <th>Date Added</th>
                                                <th>Last Update</th>
                                            </tr>
                                            <!-- end row -->
                                        </thead>
                                        <tbody>
                                            @if(count($masterlistBySection['getRecord']) === 0)
                                            <tr>
                                                <td colspan="8" class="text-center">No accounts</td>
                                            </tr>
                                            @else
                                            <!-- start row -->
                                            @foreach($masterlistBySection['getRecord'] as $value)
                                            <tr class="data-row">
                                                <td>{{ $loop->index + 1 + ($masterlistBySection['getRecord']->perPage() * 
                                                ($masterlistBySection['getRecord']->currentPage() - 1)) }} </td>
                                                <td class="copy-unique-id">{{ $dataPupilLRNs[$value->pupil_id] }}</td>
                                                <td>{{ $dataPupilNames[$value->pupil_id] }}</td>
                                                <td>{{ $dataPupilGender[$value->pupil_id] }}</td>
                                                <td>{{ \Carbon\Carbon::parse($dataPupilBDate[$value->pupil_id])->format('F d, Y') }}</td>
                                                <td>{{ $dataPupilGuardian[$value->pupil_id] ?? 'NULL' }}
                                                </td>
                                                <td>{{ $dataPupilGuardianCo[$value->pupil_id] ?? 'NULL' }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('M d, Y | h:ia') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($value->updated_at)->format('M d, Y | h:ia') }}
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            <!-- End row -->
                                        </tbody>
                                    </table>

                                    <div class="col-12 d-flex justify-content-end">
                                        {!!
                                        $masterlistBySection['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links()
                                        !!}
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex row justify-content-center w-100">
            <div class="col-lg-5">
                <div class="card-body w-100">
                    <div class="card">
                        @include('admin.constants.forms.masterlist-one')
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card-body w-100">
                    <div class="card shadow-none">
                        <!-- ================================ SIDE FORM - USER ================================================ -->
                        @include('admin.constants.forms.masterlist-mass-import')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
