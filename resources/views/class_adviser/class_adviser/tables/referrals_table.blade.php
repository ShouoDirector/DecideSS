<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th></th>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Section</th>
                <th>Notes/Observation</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($data['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($data['getRecord'] as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
            <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
            <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
            <td> {{ $dataClassNames[$value->class_id] }}</td>
            <td> {{ $value->explanation ?? 'No notes/observation' }}</td>
            <td> {{ \Carbon\Carbon::parse($value->created_at)->format('F j, Y \a\t h:i a') }} </td>
            <td> {{ \Carbon\Carbon::parse($value->updated_at)->format('F j, Y \a\t h:i a') }}</td>
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
