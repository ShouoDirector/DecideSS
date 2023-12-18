<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>Grade Level</th>
                <th>Section</th>
                <th>Class Adviser</th>
                <th>Date Added</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($data['getDeletedClassrooms']) === 0)
            <tr>
                <td colspan="7" class="text-center">No deleted classroom/s</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($data['getDeletedClassrooms'] as $value)
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
                            <i class="ti ti-tool fs-6"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-3"
                                    href="{{ route('school_nurse.archives.classroom_recover', ['id' => $value->id]) }}">
                                    <i class="fs-4 ti ti-edit"></i>Recover
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
            {!! $data['getDeletedClassrooms']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>
