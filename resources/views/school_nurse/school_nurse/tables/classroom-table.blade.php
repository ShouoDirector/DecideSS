<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>Grade Level</th>
                <th>Section</th>
                <th>Class Adviser</th>
                <th>Created Date</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataClassroom['getList']) === 0)
            <tr>
                <td colspan="7" class="text-center">No classrooms</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataClassroom['getList'] as $value)
            <tr>
                <td> {{ $value->id }} </td>
                <td> {{ $value->grade_level }} </td>
                <td> {{ $value->section }} </td>
                <td> {{ $classAdvisersEmails[$value->classadviser_id] }} </td>
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
                                    href="{{ route('school_nurse.school_nurse.classroom_edit', ['id' => $value->id]) }}">
                                    <i class="fs-4 ti ti-edit"></i>Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-3"
                                    href="{{ route('school_nurse.school_nurse.classroom-delete', ['id' => $value->id]) }}">
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

    <div class="d-flex justify-content-end">
            {!! $dataClassroom['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>
