@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row">
        @include('admin.segments.segment_head')
        <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
            <a href="#" type="button"
                class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Manage</a>
            <button type="button" disabled
                class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">MasterList</button>
        </div>

        <div class="d-flex row justify-content-end w-100">
            <div class="col-auto d-flex gap-2">
                <form action="{{ route('admin.admin.manage_schools') }}">
                    {{ csrf_field() }}
                    <input type="search" class="form-control col-auto bg-light-primary" name="searchSchool"
                        value="{{ Request::get('searchSchool') }}" placeholder="Search School"
                        aria-label="Input group example" aria-describedby="btnGroupAddon2">
                </form>
                <a href="{{ route('admin.admin.manage_schools') }}" type="button" class="btn btn-secondary d-flex align-items-center" 
                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Clear">
                    <i class="ti ti-clear-all fs-4"></i>
                </a>
            </div>
        </div>

        @if(!empty(Request::get('searchSchool') && empty(Request::get('schoolId'))))

        <div class="table-responsive w-100 pb-3 mt-3">
            <h5 class="mb-3">Results</h5>
            <table class="table border table-striped table-bordered text-nowrap">
                <thead>
                    <!-- start row -->
                    <tr>
                        <th></th>
                        <th>School</th>
                        <th>School Nurse</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    <!-- end row -->
                </thead>
                <tbody>
                    @if(count($searchWithSchoolName['getList']) === 0)
                    <tr>
                        <td colspan="14" class="text-center">No school</td>
                    </tr>
                    @else
                    <!-- start row -->
                    @foreach($searchWithSchoolName['getList'] as $value)
                    <tr>
                        <td>{{ $loop->index + 1 + ($searchWithSchoolName['getList']->perPage() * 
                                        ($searchWithSchoolName['getList']->currentPage() - 1)) }}</td>
                        <td> {{ $value->school }} </td>
                        <td>{{ $userName[$value->school_nurse_id] }}</td>
                        <td>{{ $value->address_barangay }}</td>
                        <td>
                            <form action="{{ route('admin.admin.manage_schools') }}">
                                <input type="text" name="searchSchool" class="d-none"  value="{{ Request::get('searchSchool') }}">
                                <input type="text" name="schoolId" class="form-control border border-info d-none" value="{{ $value->id }}">
                                <button type="submit">View School</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    <!-- End row -->
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                {!! $searchWithSchoolName['getList']->appends(Illuminate\Support\Facades\Request::except('page'))->links()
                !!}
            </div>

        </div>
        @endif

        <div class="w-100">
            <div class="d-flex row justify-content-start">
                <div class="col-lg-7">
                    <div class="card-body w-100">
                        <div class="card shadow-none">
                            <!-- ================================ SIDE FORM - USER ================================================ -->
                            @include('admin.admin.forms.schools-mass-import')
                        </div>
                    </div>
                </div>
                    @if(Request::get('sectionId')!= null)
                    <div class="col-lg-4 d-flex align-items-center shadow-none">
                        <div class="card-body w-100">
                            <div class="card">
                                @include('admin.admin.forms.schools-one')
                            </div>
                        </div>
                    </div>
                    @endif
            </div>

        </div>

        


    </div>
    @include('admin.admin.scripts.user_table')
</div>
@endsection
