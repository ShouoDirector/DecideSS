<div class="table-responsive pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>School Year</th>
                <th>Phase</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($data['getDeletedSchoolYears']) === 0)
            <tr>
                <td colspan="9" class="text-center">No deleted school year</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($data['getDeletedSchoolYears'] as $value)
            <tr>
                <td> {{ $value->id }} </td>
                <td> {{ $value->school_year }} </td>
                <td> {{ $value->phase }} </td>
                <td> {{ $value->status }} </td>
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
                                    href="{{ route('admin.archives.school_year_recover', ['id' => $value->id]) }}">
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
    </table>

    <div class="col-12 d-flex justify-content-end">
        {!! $data['getDeletedSchoolYears']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>
