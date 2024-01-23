<div class="col-12 card position-relative overflow-hidden shadow">
    <div class="card-body">

        @if(Request::get('districtId') !== null && Request::get('schoolId') !== null)
        <h5>Sections</h5>
        <p class="card-subtitle mb-3 mt-3">
            All Sections
        </p>

        @php
        $schoolID = Request::get('schoolId');
        @endphp

        <form class="d-flex justify-content-end mb-1" action="{{ route('admin.admin.manage_schools') }}">
            @csrf
            <input type="text" name="districtId" class="form-control border border-info d-none"
                value="{{ Request::get('districtId') }}">
            <button type="submit" class="btn btn-outline-primary rounded-0">Go Back 
                <i class="ti ti-arrow-back-up"></i>
            </button>
        </form>

        <form class="d-flex justify-content-end mb-2" action="{{ route('admin.constants.sections') }}">
            @csrf
            <input type="text" value="{{ $scID[$schoolID] }}" name="search"
                class="form-control border border-info d-none">

            <button type="submit" class="btn btn-outline-primary rounded-0">Add Sections to this School Instead</button>
        </form>

        <table class="table">
            <tr>
                <th>Section Name</th>
                <th>Grade Level</th>
                <th>Has Class</th>
                <th>Current Class Adviser</th>
                <th>Action</th>
            </tr>

            @php
            $optionBlocker = 0;
            @endphp

            @foreach($sections['getList'] as $section)
            <tr>
                <td style="vertical-align: middle;">{{ $section->section_name }}</td>
                <td style="vertical-align: middle;">{{ $section->grade_level }}</td>
                <td style="vertical-align: middle;"><span
                        class="fs-3 mt-1 badge py-2 {{ $checkedForClasses['getList']->pluck('section_id')->flatten()->contains($section->id) ? 'bg-primary' : 'bg-danger' }}">
                        {{ $checkedForClasses['getList']->pluck('section_id')->flatten()->contains($section->id) ? 'Yes' : 'Not Yet' }}
                    </span></td>
                <td style="vertical-align: middle;">
                    @php
                    $classInfo = $checkedForClasses['getList']->where('section_id', $section->id)->first();
                    $classAdviserId = $classInfo ? $classInfo->classadviser_id : null;
                    @endphp

                    @if ($classAdviserId)
                    {{ $classAdviserNames[$classAdviserId] }}

                    @php
                        $optionBlocker = 1;
                    @endphp

                    @else
                    @php
                        $optionBlocker = 0;
                    @endphp
                    No Class Adviser Yet
                    @endif
                </td>
                <td style="vertical-align: middle;">
                    <form action="{{ route('admin.admin.manage_schools') }}">
                        @csrf
                        <input type="text" name="option_blocker" class="form-control border border-info d-none"
                            value="{{ $optionBlocker }}">
                        <input type="text" name="schoolId" class="form-control border border-info d-none"
                            value="{{ $schoolID }}">
                        <input type="text" name="districtId" class="form-control border border-info d-none"
                            value="{{ Request::get('districtId') }}">
                        <input type="text" name="sectionId" class="form-control border border-info d-none"
                            value="{{ $section->id }}">
                        <button type="submit" class="badge bg-primary rounded-pill px-3 py-2">Options</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>


        @endif

    </div>
    
</div>

