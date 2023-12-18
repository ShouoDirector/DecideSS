<div class="d-flex row m-0 justify-content-end mt-4 mb-4">
    <a href="{{ route('class_adviser.class_adviser.pupils') }}" type="button" class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Insert New Pupil</a>
    <a href="{{ route('class_adviser.class_adviser.pupils_records') }}" type="button" class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Pupils</a>
    <a href="#" type="button" class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Insert Pupil To MasterList</a>
    <a href="{{ route('class_adviser.class_adviser.masterlist') }}" type="button" class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">MasterList</a>
</div>

<div class="f-flex row col-12 border-none gap-1 justify-content-end mb-3">
    @if($activeSchoolYear['getRecord']->isNotEmpty())
    <form class="d-flex row col-12 border-none m-0 p-0 py-2"
        action="{{ route('class_adviser.class_adviser.pupil_to_masterlist') }}">
        <div class="col-lg-3 col-md-5 col-sm-6 col-12 border-none">
            <input type="search" class="col-lg-3 col-md-4 col-sm-6 col-12 border-none form-control border-dark"
                id="text-srh" name="search" value="{{ Request::get('search') }}" placeholder="Search Pupil with LRN">
        </div>
        <button type="submit" class="col-auto btn btn-info font-medium px-4">
            Search
        </button>
        <div class="col-auto font-medium px-2">
            <a href="{{ route('class_adviser.class_adviser.masterlist') }}" class="btn btn-primary">
                See MasterList Table
            </a>
        </div>
    </form>
    @endif
    @if(count($pupilData['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty() &&
    !empty(Request::get('search')))
    <a href="{{ route('class_adviser.class_adviser.pupil_to_masterlist') }}"
        class="col-auto d-flex align-items-center btn btn-outline-info font-medium px-4">
        <i class="ti ti-square-minus me-2 fs-4 fw-semibold"></i>
        Clear Result
    </a>
    @endif

</div>

@if(count($pupilData['getList']) !== 0 && $activeSchoolYear['getRecord']->isNotEmpty())
@if(!empty(Request::get('search')))
@forelse($pupilData['getList'] as $pupil)
<div class="card">
    <div class="card-body bg-light-primary">
        <h5>Result</h5>
        <p class="card-subtitle mb-3">
            Please check the result, if this is the pupil you were looking for alongside the details
        </p>
        <form class="d-flex row" method="post"
            action="{{ route('class_adviser.class_adviser.pupil_to_masterlist.pupil_masterclass_add') }}">
            {{ csrf_field() }}
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                <input type="text" class=" form-control border border-info" placeholder="Name" readonly
                    value="{{ $pupil->id }}" name="pupil_id" required>
                <label><span class="border-info ps-3">ID</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control " placeholder="Name" readonly
                    value="{{ $pupil->last_name }}, {{ $pupil->first_name }}, {{ $pupil->middle_name }}, {{ $pupil->suffix }}">
                <label><span class="border-info ps-3">Name</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control" placeholder="LRN" readonly value="{{ $pupil->lrn }}" name="lrn">
                <label><span class="border-info ps-3">LRN</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control" placeholder="Birth Date" readonly
                    value="{{ $pupil->date_of_birth }}">
                <label><span class="border-info ps-3">Birth Date</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control" placeholder="Gender" readonly value="{{ $pupil->gender }}">
                <label><span class="border-info ps-3">Gender</span></label>
            </div>
            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control" placeholder="Address" readonly
                    value="{{ $pupil->barangay }}, {{ $pupil->municipality }}, {{ $pupil->province }}">
                <label><span class="border-info ps-3">Address</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                <input type="text" class="form-control" placeholder="Class Adviser ID" readonly
                    value="{{ Auth::user()->id }}" name="classadviser_id" required>
                <label><span class="border-info ps-3">Class Adviser ID</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none">
                <input type="text" class="form-control" placeholder="School Year ID" readonly
                    value="{{ $activeSchoolYear['getRecord'][0]->school_year }} | {{ $activeSchoolYear['getRecord'][0]->phase }}"
                    required>
                <label><span class="border-info ps-3">School Year | Phase</span></label>
            </div>

            <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                <input type="text" class="form-control border border-info" placeholder="School Year ID" readonly
                    value="{{ $activeSchoolYear['getRecord'][0]->id }}" name="schoolyear_id" required>
                <label><span class="border-info ps-3">School Year ID</span></label>
            </div>

            <div class="d-flex justify-content-end col-12 border-none mt-3 mt-md-0 ms-auto">
                <button type="button" class="btn btn-info font-medium px-4" data-bs-toggle="modal"
                    data-bs-target="#add-pupil-modal">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-send me-2 fs-4"></i>
                        Add Pupil to your MasterList
                    </div>
                </button>
            </div>

            @include('class_adviser.class_adviser.modals.add-pupil-masterlist-form')
        </form>
    </div>
</div>
@empty
<div class="alert alert-warning" role="alert">
    No search result. Please search for a pupil with LRN to add to your masterlist.
</div>
@endforelse

{!! $pupilData['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

@else

@endif
@else
<div class="alert alert-warning px-4" role="alert">
    No search performed. Please search for a pupil with LRN to add to your masterlist.
</div>
@endif

<div class="card w-100 d-flex row shadow-none">
    <div class="card-body col-md-6 col-sm-12 shadow">
        <h5 class="card-title fw-semibold">Pupils You've Added</h5>
        <p class="card-subtitle mb-5">Check the list</p>
        @foreach($getPupils['getList'] as $pupil)
        <table class="table">
            <tr class="">
                <td>{{ $loop->iteration }}</td>
                <td>
                    <h6 class="mb-0 fw-semibold mb-2">
                        {{ $pupil->last_name }} {{ $pupil->first_name }} {{ $pupil->middle_name }}, {{ $pupil->suffix }}
                        <span class="rounded-circle bg-success text-white">
                        <ti class="ti ti-check"></ti>
                    </span>
                    </h6>
                    <span class="fs-3 mt-1 badge {{ $dataPupilsCheckedInMasterlist['getList']->pluck('pupil_id')->flatten()->contains($pupil->id) ? 'bg-primary' : 'bg-danger' }}">
                        {{ $dataPupilsCheckedInMasterlist['getList']->pluck('pupil_id')->flatten()->contains($pupil->id) ? 'Has already been in masterlist' : 'Has not yet in masterlist' }}
                    </span>
                </td>
                <td class="hidden">
                    <input type="search" class="form-control border-dark" id="text-srh" name="search" value="{{ $pupil->lrn }}" placeholder="Search Pupil with LRN" readonly>
                </td>
                <td>
                    @if(!$dataPupilsCheckedInMasterlist['getList']->pluck('pupil_id')->flatten()->contains($pupil->id))
                        <form action="{{ route('class_adviser.class_adviser.pupil_to_masterlist') }}" method="POST">
                            @csrf
                            <input type="hidden" name="search" value="{{ $pupil->lrn }}">
                            <button type="submit" class="btn btn-info font-medium px-2">
                                Add to masterlist
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        </table>

        @endforeach

        <div class="d-flex justify-content-end">
            {!! $getPupils['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
        </div>


    </div>
</div>

