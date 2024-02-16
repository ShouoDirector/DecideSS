<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th></th>
                <th>LRN</th>
                <th>Name</th>
                <th>Grade Level</th>
                <th>Class Adviser</th>
                <th>Action</th>
            </tr>
            <!-- end row -->
        </thead>
        <tbody>
            @if(count($data['getRecord']) === 0)
            <tr>
                <td colspan="7" class="text-center">No result</td>
            </tr>
            @else
            <!-- start row -->
            @foreach($data['getRecord'] as $value)
                @foreach(['Kinder', '1', '2', '3', '4', '5', '6', 'SPED'] as $grade)
                    @if($classGradeLevel[$value->class_id] == $grade)
                        <tr>
                            <td>{{ $loop->index + 1 + ($data['getRecord']->perPage() * ($data['getRecord']->currentPage() - 1)) }}</td>
                            <td>{{ $dataPupilLRNs[$value->pupil_id] }}</td>
                            <td>{{ $dataPupilNames[$value->pupil_id] }}</td>
                            <td>Grade {{ $classGradeLevel[$value->class_id] }}, {{ $className[$value->class_id] }}</td>
                            <td>{{ $adviserName[$value->classadviser_id] }}</td>
                            <td>
                                <div class="dropdown dropstart">
                                    <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-tool fs-6"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <form action="{{ route('school_nurse.school_nurse.search_pupil') }}">
                                                {{ csrf_field() }}
                                                <input type="text" name="search" value="{{ $dataPupilLRNs[$value->pupil_id] }}" class="d-none">
                                                <button type="submit" class="dropdown-item d-flex align-items-center gap-3">
                                                    <i class="fs-4 ti ti-eye"></i>View More Details
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach

            @endforeach
            @endif
            <!-- End row -->
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {!! $data['getRecord']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div>
</div>
