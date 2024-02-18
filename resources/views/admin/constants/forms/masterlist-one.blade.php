<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <h5>Add Pupil To The Masterlist</h5>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerMessage1'] }}
        </p>

        <form action="{{ route('admin.constants.masterlist') }}" method="get">
            <input type="text" name="schoolId" class="form-control border border-info d-none"
                value="{{ Request::get('schoolId'); }}" required>
            <input type="text" name="districtId" class="form-control border border-info d-none"
                value="{{ Request::get('districtId') }}" required>
            <input type="text" name="sectionId" class="form-control border border-info d-none"
                value="{{ Request::get('sectionId') }}" required>
            <input type="text" name="classId" class="form-control border border-info d-none"
                value="{{ Request::get('classId') }}" required>
            <div class="form-floating mb-1 col-12">
                <input type="search" name="name" class="form-control border border-info" placeholder="LRN" />
                <label class="mx-2 d-flex align-items-center"><i class="ti ti-user me-2 fs-4 text-info"></i><span
                        class="border-start border-info ps-3">Search with Name</span></label>
            </div>
            <button type="submit" class="btn btn-primary mb-2 mt-1 w-100">Find</button>
        </form>

        @if(Request::get('name') !== null && !empty($searchWithName['getList']))
        <table class="table table-bordered border-1 border-dark">
            <tr>
                <th>Pupil LRN</th>
                <th>Name</th>
                <th>Check</th>
            </tr>
            @if(count($searchWithName['getList']) > 0)
            @foreach($searchWithName['getList'] as $pupil)
            <tr>
                <td>{{ $pupil->lrn }}</td>
                <td>{{ $pupil->last_name }}, {{ $pupil->first_name }} {{ $pupil->middle_name }} {{ $pupil->suffix }}
                </td>
                <td>
                    <input type="checkbox" class="pupil-checkbox" data-pupil-id="{{ $pupil->id }}"
                        data-full-name="{{ $pupil->last_name }}, {{ $pupil->first_name }} {{ $pupil->middle_name }} {{ $pupil->suffix }}">
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="3">No results</td>
            </tr>
            @endif
        </table>
        @endif

        <div id="addPupilToMasterlistDiv">
            <form class="d-flex row" id="addPupilToMasterlistForm">
                {{ csrf_field() }}

                <div class="form-floating mb-3 col-12 hidden">
                    <input type="text" name="pupil_id" id="pupilId" class="form-control border border-info"
                        placeholder="Pupil ID" />
                    <label class="mx-2 d-flex align-items-center"><i class="ti ti-user me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">Pupil ID</span></label>
                </div>
                <div class="form-floating mb-3 col-12">
                    <input type="text" name="fullName_Id" id="fullNameId" class="form-control border border-info"
                        placeholder="Full Name" readonly/>
                    <label class="mx-2 d-flex align-items-center"><i class="ti ti-user me-2 fs-4 text-info"></i><span
                            class="border-start border-info ps-3">Full Name</span></label>
                </div>

                <div class="form-floating mb-3 col-12 hidden">
                    <input type="text" name="class_id" id="classId" value="{{ Request::get('classId') }}">
                </div>

                <div class="form-floating mb-3 col-6">
                    <select name="promoted" id="promoted" class="form-select border border-info" required>
                        <option value="Yes">Yes</option>
                        <option value="No" selected>No</option>
                    </select>
                    <label class="mx-2 d-flex align-items-center"><span
                            class="ps-1">Promoted</span></label>
                </div>

                <div class="form-floating mb-3 col-6">
                    <select name="transferred" id="transferred" class="form-select border border-info" required>
                        <option value="Yes">Yes</option>
                        <option value="No" selected>No</option>
                    </select>
                    <label class="mx-2 d-flex align-items-center"><span
                            class="ps-1">Transferred</span></label>
                </div>

                <div class="form-floating mb-3 col-6">
                    <select name="repeated" id="repeated" class="form-select border border-info" required>
                        <option value="Yes">Yes</option>
                        <option value="No" selected>No</option>
                    </select>
                    <label class="mx-2 d-flex align-items-center"><span
                            class="ps-1">Repeated</span></label>
                </div>

                <div class="form-floating mb-3 col-6">
                    <select name="dropped" id="dropped" class="form-select border border-info" required>
                        <option value="Yes">Yes</option>
                        <option value="No" selected>No</option>
                    </select>
                    <label class="mx-2 d-flex align-items-center"><span
                            class="ps-1">Dropped</span></label>
                </div>

                <div class="d-flex row justify-content-end m-0 p-0">
                    <div class="d-md-flex align-items-center">
                        <div class="mt-3 mt-md-0 d-content" style="display: contents;">
                            <button type="button" onclick="submitMasterListForm()"
                                class="btn btn-primary font-medium w-100 rounded-pill">Add Pupil</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
