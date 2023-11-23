<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Action</th>
                <th>Old Values</th>
                <th>New Value/s</th>
                <th>Affected</th>
                <th>Date/Time</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($data['getUserHistory']) === 0)
            <tr>
                <td colspan="7" class="text-center">No Log</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($data['getUserHistory'] as $value)
            <tr>
                <td> {{ $value->id }} </td>
                <td> {{ $userUniqueId[$value->user_id] }} | {{ $userNames[$value->user_id] }} </td>
                <td> {{ $value->action }} </td>
                <td> {{ $value->old_value }} </td>
                <td> {{ $value->new_value }} </td>
                <td> {{ $value->table_name }} </td>
                <td> {{ date('M d, Y | h:ia', strtotime($value->created_at)) }} </td>
            </tr>
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!!
            $data['getUserHistory']->appends(Illuminate\Support\Facades\Request::except('page'))->links()
        !!}
    </div>

</div>
