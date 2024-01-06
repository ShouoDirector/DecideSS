<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th></th>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Class</th>
                <th>Notes/Explanation</th>
                <th>Program</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($data['getRecord']) === 0)
            <tr>
                <td colspan="8" class="text-center">No pupil</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($data['getRecord'] as $value)
            <tr>
                <td>{{ $loop->iteration }}</td>
            <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
            <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
            <td> Grade {{ $dataClassGrade[$value->class_id] }}, {{ $dataClassNames[$value->class_id] }}</td>
            <td> {{ $value->explanation ?? 'No notes/observation' }}</td>
            <td> {{ $value->program }} </td>
            <td> {{ \Carbon\Carbon::parse($value->created_at)->format('F j, Y \a\t h:i a') }} </td>
            <td> {{ \Carbon\Carbon::parse($value->updated_at)->format('F j, Y \a\t h:i a') }}</td>
            <td>
                <div class="dropdown dropstart">
                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ti ti-tool fs-6"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center gap-3"
                                data-bs-toggle="modal" data-bs-target="#delete-referral-modal">
                                    <i class="fs-4 ti ti-trash"></i>Archive</button>
                            </li>
                        </ul>
                        @include('school_nurse.school_nurse.modals.delete-referral-modal')
                    </div>
            </td>
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