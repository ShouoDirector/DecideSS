<div class="table-responsive pb-3 mb-5">
    <table class="user_table table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>Unique ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Date Added</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($data['getRecord']) === 0)
            <tr>
                <td colspan="8" class="text-center">No accounts</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($data['getRecord'] as $value)
            <tr class="data-row">
                <td> {{ $value->id }} </td>
                <td class="copy-unique-id"> {{ $value->unique_id }} </td>
                <td> {{ $value->name }} </td>
                <td> {{ $value->email }} </td>
                <td>
                    @if($value->user_type == 2)
                        <span class="badge bg-dark">Medical Officer</span>
                    @elseif($value->user_type == 3)
                        <span class="badge bg-primary">School Nurse</span>
                    @elseif($value->user_type == 4)
                        <span class="badge bg-success">Class Adviser</span>
                    @endif
                </td>
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
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="col-12 d-flex justify-content-end">
        {!! $data['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>
