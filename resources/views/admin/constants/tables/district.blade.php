<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <div class="mb-2 d-flex">
            <h5 class="mb-2"> $head['headerTable1']</h5>
            <p class=" ms-2 mt-1"><i class="ti ti-info-circle fs-5 card-subtitle mb-3" data-bs-toggle="tooltip"
                    data-bs-placement="right" data-bs-original-title="
                    The Admin User List provides a structured overview of users with administrative privileges within
                    the system.
                    Each entry includes the user's full name, associated email address, assigned role, creation date,
                    and last update date."></i></p>
            <div class="mt-0 ms-5 fs-4 mx-4 text-dark">
                Total : {{ $dataDistrictModel_MedicalOfficer['getList']->total() }}
            </div>
        </div>

        <div class="table-responsive pb-3">
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th>ID</th>
                        <th>District</th>
                        <th>Medical Officer Email</th>
                        <th>Created Date</th>
                        <th>Last Update</th>
                        <th>Actions</th>
                    </tr>
                    <!-- end row -->
                </thead>
                <tbody>
                    <!-- start row -->
                    @foreach($dataDistrictModel_MedicalOfficer['getList'] as $value)
                    <tr>
                        <td> {{ $value->id }} </td>
                        <td> {{ $value->district }} </td>
                        <td> {{ $value->medical_officer_email }} </td>
                        <td> {{ date('M d, Y | h:ia', strtotime($value->created_at)) }} </td>
                        <td> {{ date('M d, Y | h:ia', strtotime($value->updated_at)) }} </td>

                        <td>
                            <div class="dropdown dropstart">
                                <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3"
                                            href="{{ route('admin.admin.edit', ['id' => $value->id]) }}">
                                            <i class="fs-4 ti ti-edit"></i>Edit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-3"
                                            href="{{ route('admin.admin.delete', ['id' => $value->id]) }}">
                                            <i class="fs-4 ti ti-trash"></i>Delete
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <!-- End row -->
                </tbody>
            </table>

            <div class="col-12 d-flex justify-content-end">
                {!!
                $dataDistrictModel_MedicalOfficer['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links()
                !!}
            </div>

        </div>
    </div>
</div>