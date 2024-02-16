<div class="table-responsive pb-3 mb-5">
    <table class="user_table table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>LRN</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Address</th>
                <th>Guardian Name</th>
                <th>Guardian Contact No.</th>
                <th>Date Added</th>
                <th>Last Update</th>
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
                <td>{{ $value->id }}</td>
                <td class="copy-unique-id">{{ $value->lrn }}</td>
                <td>{{ $value->last_name }}, {{ $value->first_name }} {{ $value->middle_name }} {{ $value->suffix }}</td>
                <td>{{ $value->gender }}</td>
                <td>{{ $value->date_of_birth }}</td>
                <td>{{ $value->barangay }} {{ $value->municipality }}, {{ $value->province }}</td>
                <td>{{ $value->pupil_guardian_name !== null ? $value->pupil_guardian_name : 'NULL' }}</td>
                <td>{{ $value->pupil_guardian_contact_no !== null ? $value->pupil_guardian_contact_no : 'NULL' }}</td>
                <td>{{ \Carbon\Carbon::parse($value->created_at)->format('M d, Y | h:ia') }}</td>
                <td>{{ \Carbon\Carbon::parse($value->updated_at)->format('M d, Y | h:ia') }}</td>
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
