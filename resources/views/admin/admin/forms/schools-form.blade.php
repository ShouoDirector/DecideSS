<div class="col-12 card position-relative overflow-hidden shadow rounded">
    <div class="card-body">
        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerMessage1'] }}
        </p>

            @foreach ($districts['getList'] as $districts)

                <div class="form-floating mb-3 col-12">
                    <form action="{{ route('admin.admin.manage_schools') }}">
                    <input type="text" name="districtId" class="form-control border border-info d-none" value="{{ $districts->id }}">
                    <button type="submit" class="btn btn-primary rounded-0">{{ $districts->district }}</button>
                    </form>
                </div>

            @endforeach

            @if(Request::get('districtId')!== null)
            <table class="table table-bordered">
                        <tr>
                        <th>School ID</th>
                        <th>School Name</th>
                        <th>Action</th>
                        </tr>
                @foreach($schools['getList'] as $school)
                        <tr>
                            <td>{{ $school->school_id }}</td>
                            <td>{{ $school->school }}</td>
                            <td>
                            <form action="{{ route('admin.admin.manage_schools') }}">
                                <input type="text" name="schoolId" class="form-control border border-info d-none" value="{{ $school->id }}">
                                <input type="text" name="districtId" class="form-control border border-info d-none" value="{{ Request::get('districtId') }}">
                                <button type="submit" class="btn btn-primary rounded-0 shadow-none">Select</button>
                            </form>
                            </td>
                        </tr>

                @endforeach
            </table>
            @endif

    </div>
</div>
