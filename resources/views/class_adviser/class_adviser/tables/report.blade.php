@if(count($dataClassRecord['getRecord']) !== 0)
<div class="table-responsive w-100 pb-3">
    <table class="table border table-striped table-bordered text-nowrap">
        <thead>
            <!-- start row -->
            <tr>
                <th></th>
                <th>Pupil Name</th>
                <th>Date of Birth</th>
                <th>Weight <br> (kg)</th>
                <th>Height <br> (m)</th>
                <th>Sex</th>
                <th>Height<br> (m<sup>2</sup>)</th>
                <th>Age <br>
                    (y, m)</th>
                <th></th>
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
            <td> {{ $loop->index + 1 + ($dataClassRecord['getRecord']->perPage() * 
                ($dataClassRecord['getRecord']->currentPage() - 1)) }}</td>
            <td> {{ $dataPupilNames[$value->pupil_id] }} </td>
            <td> {{ \Carbon\Carbon::parse($dataPupilBDate[$value->pupil_id])->format('F j, Y') }} </td>
            <td> {{ $value->weight }}</td>
            <td> {{ $value->height }}</td>
            <td> {{ $dataPupilSex[$value->pupil_id] }}</td>
            <td> {{ number_format($value->height_squared, 2) }}</td>
            @php
                $birthdate = \Carbon\Carbon::parse($dataPupilBDate[$value->pupil_id]);
                $age = $birthdate->diff(\Carbon\Carbon::now());
            @endphp
            <td>{{ $age->y }} y, {{ $age->m }} m</td>
            <td class="d-flex">
                <button class="dropdown-item d-flex align-items-center gap-3 card-hover" 
                    data-bs-toggle="modal" data-bs-target="#edit-pupil-na-modal">
                    <i class="fs-5 ti ti-edit"></i>
                </button>
                @include('class_adviser.class_adviser.modals.edit-pupil-na-modal')
            </td>

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
