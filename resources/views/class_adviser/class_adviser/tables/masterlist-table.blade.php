<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>Pupil</th>
                <th>School Year</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($data['getRecord']) === 0)
            <tr>
                <td colspan="4" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($data['getRecord'] as $value)
            <tr>
            <td> {{ $value->pupil_id }} </td>
            <td> {{ $value->schoolyear_id }} </td>
            <td> {{ $value->created_at }} </td>
            <td> {{ $value->updated_at }} </td>
            </tr>
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
            {!! $data['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>
