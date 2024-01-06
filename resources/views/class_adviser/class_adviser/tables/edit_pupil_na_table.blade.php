@if(count($dataClassRecord['getRecord']) !== 0)
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th></th>
                <th></th>
                <th>Pupil Name</th>
                <th>Date of Birth</th>
                <th>Weight <br> (kg)</th>
                <th>Height <br> (m)</th>
                <th>Sex</th>
                <th>Is Dewormed?</th>
                <th>Permitted <br>
                    To Deworm</th>
                <th>Notes</th>
                <th>Dietary Restriction/s</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($dataClassRecord['getRecord']) === 0)
            <tr>
                <td colspan="12" class="text-center">No class selected</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($dataClassRecord['getRecord'] as $value)

            <tr>
                <td> {{ $loop->iteration }} </td>
                <td>
                    <a class="dropdown-item d-flex align-items-center gap-3 card-hover" 
                        href="{{ route('class_adviser.class_adviser.na_page', ['id' => $value->id]) }}">
                        <i class="fs-5 ti ti-edit"></i>
                    </a>
                </td>
                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                <td> {{ \Carbon\Carbon::parse($dataPupilBDate[$value->pupil_id])->format('F j, Y') }} </td>
                <td> {{ $value->weight }}</td>
                <td> {{ $value->height }}</td>
                <td> {{ $dataPupilSex[$value->pupil_id] }}</td>
                <td> {{ $value->is_dewormed == 1 ? 'Yes' : 'No' }} </td>
                <td> {{ $value->is_permitted_deworming == 1 ? 'Permitted' : 'Not Permitted' }} </td>
                <td>{{ $value->explanation ?? 'No Notes' }}</td>
                <td>{{ $value->dietary_restriction ?? 'None' }}</td>
            </tr>
            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $dataClassRecord['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>

</div>
@else
<div class="d-flex bg-warning text-white">
    The class has no data.
</div>
@endif
