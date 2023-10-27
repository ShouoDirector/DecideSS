<div class="table-responsive pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created Date</th>
                <th>Deleted Date</th>
                <th>Actions</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($data['getDeletedUsers']) === 0)
            <tr>
                <td colspan="7" class="text-center">No deleted accounts</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($data['getDeletedUsers'] as $value)
            <tr>
                <td> {{ $value->id }} </td>
                <td> {{ $value->name }} </td>
                <td> {{ $value->email }} </td>
                <td>
                    @if($value->user_type == 1)
                    Admin
                    @elseif($value->user_type == 2)
                    Medical Officer
                    @elseif($value->user_type == 3)
                    School Nurse
                    @elseif($value->user_type == 4)
                    Class Adviser
                    @endif
                </td>
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
                                    href="{{ route('admin.archives.recover', ['id' => $value->id]) }}">
                                    <i class="fs-4 ti ti-trash"></i>Recover
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
        $data['getDeletedUsers']->appends(Illuminate\Support\Facades\Request::except('page'))->links()
        !!}
    </div>

</div>
