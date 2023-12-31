<div class="table-responsive pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>School ID</th>
                <th>School</th>
                <th>School Nurse Email</th>
                <th>Barangay</th>
                <th>District</th>
                <th>Date Added</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataSchoolModel_SchoolNurse['getList']) === 0)
            <tr>
                <td colspan="9" class="text-center">No school record</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataSchoolModel_SchoolNurse['getList'] as $value)
            <tr>
                <td> {{ $value->id }} </td>
                <td> {{ $value->school_id }} </td>
                <td> {{ $value->school }} </td>
                <td> {{ $schoolNursesEmails[$value->school_nurse_id] }} </td>
                <td> {{ $value->address_barangay }} </td>
                <td> {{ $schoolDistrictNames[$value->district_id] }} </td>
                <td> {{ date('M d, Y | h:ia', strtotime($value->created_at)) }} </td>
                <td> {{ date('M d, Y | h:ia', strtotime($value->updated_at)) }} </td>

                <td>
                    <div class="dropdown dropstart">
                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ti ti-tool fs-6"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-3"
                                    href="{{ route('admin.constants.school-edit', ['id' => $value->id]) }}">
                                    <i class="fs-4 ti ti-edit"></i>Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-3"
                                    href="{{ route('admin.constants.school-delete', ['id' => $value->id]) }}">
                                    <i class="fs-4 ti ti-trash"></i>Delete
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

    <div class="col-12 d-flex justify-content-end">
        {!!
        $dataSchoolModel_SchoolNurse['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links()
        !!}
    </div>

</div>
