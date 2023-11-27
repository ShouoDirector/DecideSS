<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>LRN</th>
                <th>Full Name</th>
                <th>Birth Date</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Guardian Name</th>
                <th>Guardian No</th>
                <th>Actions</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataPupils['getList']) === 0)
            <tr>
                <td colspan="14" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataPupils['getList'] as $value)
            <tr>
            <td> {{ $value->lrn }} </td>
            <td> {{ $value->last_name }}, {{ $value->first_name }}, {{ $value->middle_name }}, {{ $value->suffix }}</td>
            <td> {{ DateTime::createFromFormat('Y-m-d', $value->date_of_birth)->format('F j, Y') }} </td>
            <td> {{ $value->gender }}</td>
            <td> {{ $value->barangay }}, {{ $value->municipality }}, {{ $value->province }} </td>
            <td> {{ $value->pupil_guardian_name }} </td>
            <td> {{ $value->pupil_guardian_contact_no }} </td>
                <td>
                    <div class="dropdown dropstart">
                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ti ti-tool fs-6"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-3"
                                    href="{{ route('class_adviser.class_adviser.pupil_edit', ['id' => $value->id]) }}">
                                    <i class="fs-4 ti ti-edit"></i>Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-3"
                                    href="{{ route('class_adviser.class_adviser.pupil_delete', ['id' => $value->id]) }}">
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
            {!! $dataPupils['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>
