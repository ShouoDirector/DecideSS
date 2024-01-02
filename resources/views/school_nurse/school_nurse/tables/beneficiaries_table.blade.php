<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th>Pupil LRN</th>
                <th>Pupil</th>
                <th>Class</th>
                <th>Class Adviser</th>
                <th>Action</th>
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
                <td> {{ $dataPupilLRNs[$value->pupil_id] }} </td>
                <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
                <td> Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                <td> {{ $adviserName[$value->classadviser_id] }}</td>
                <td>
                    <div class="dropdown dropstart">
                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ti ti-tool fs-6"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                            <button type="button" class="dropdown-item d-flex align-items-center gap-3" data-bs-toggle="modal"
                                data-bs-target="#beneficiary-modal-{{ $value->id }}">
                                <i class="fs-4 ti ti-eye"></i>See More
                            </button>
                            </li>
                        </ul>
                        
                    </div>
                </td>
                @include('school_nurse.school_nurse.modals.beneficiary-modal', ['Id' => $value->id])
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
