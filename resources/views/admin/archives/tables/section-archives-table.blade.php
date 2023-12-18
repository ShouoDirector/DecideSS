<div class="table-responsive pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>Section Code</th>
                <th>Section Name</th>
                <th>Grade Level</th>
                <th>School Name</th>
                <th>Date Added</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($data['getDeletedSections']) === 0)
            <tr>
                <td colspan="9" class="text-center">No deleted sections</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($data['getDeletedSections'] as $value)
            <tr>
                <td> {{ $value->id }} </td>
                <td> {{ $value->section_code }} </td>
                <td> {{ $value->section_name }} </td>
                <td> {{ $value->grade_level }} </td>
                <td> {{ $schoolNames[$value->school_id] }} </td>
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
                                    href="{{ route('admin.archives.section_recover', ['id' => $value->id]) }}">
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
        {!! $data['getDeletedSections']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>
