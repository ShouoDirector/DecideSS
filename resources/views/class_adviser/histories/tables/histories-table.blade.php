<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>ID</th>
                <th>Operation</th>
                <th>Table</th>
                <th>Date/Time</th>
                <th>Values</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            <!-- start row -->
            @foreach($data['getUserHistory'] as $value)
            <tr>
                <td> {{ $value->id }} </td>
                <td> {{ $value->action }} </td>
                <td> {{ $value->table_name }} </td>
                <td> {{ date('M d, Y | h:ia', strtotime($value->created_at)) }} </td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#referral_details">
                        <i class="ti ti-eye"></i>
                    </button>
                    @include('class_adviser.class_adviser.modals.referral_details')
                </td>
            </tr>
            @endforeach
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!!
            $data['getUserHistory']->appends(Illuminate\Support\Facades\Request::except('page'))->links()
        !!}
    </div>

</div>
