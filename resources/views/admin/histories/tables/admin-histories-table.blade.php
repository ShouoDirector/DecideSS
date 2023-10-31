<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>Action</th>
                <th>Old Values</th>
                <th>New Value/s</th>
                <th>Affected</th>
                <th>Date/Time</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            <!-- start row -->
            @foreach($data['getAdminHistory'] as $value)
            <tr>
                <td> {{ $value->id }} </td>
                <td> {{ $value->action }} </td>
                <td> {{ $value->old_value }} </td>
                <td> {{ $value->new_value }} </td>
                <td> {{ $value->table_name }} </td>
                <td> {{ date('M d, Y | h:ia', strtotime($value->created_at)) }} </td>
            </tr>
            @endforeach
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!!
            $data['getAdminHistory']->appends(Illuminate\Support\Facades\Request::except('page'))->links()
        !!}
    </div>

</div>
