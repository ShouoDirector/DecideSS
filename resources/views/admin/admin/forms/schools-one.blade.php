<div class="card-body shadow">
    <p class="card-subtitle mb-3 mt-3">Options</p>
    <form action="{{ route('admin.admin.manage_schools') }}" class="d-flex justify-content-end mb-2">
        @csrf
        <input type="text" name="schoolId" class="form-control border border-info d-none"
            value="{{ Request::get('schoolId') }}">
        <input type="text" name="districtId" class="form-control border border-info d-none"
            value="{{ Request::get('districtId') }}">
        <button type="submit" class="btn btn-outline-primary rounded-0">Close</button>
    </form>
    @if(Request::get('sectionId')!== null && Request::get('schoolId')!== null && Request::get('districtId')!== null)

    @foreach($classes['getList'] as $class)
    Section : {{ $sectionName[$class->section_id] }}
    <form action="{{ route('admin.constants.masterlist') }}" class="d-flex justify-content-end mb-2">
        @csrf
        <input type="text" name="schoolId" class="form-control border border-info d-none"
            value="{{ Request::get('schoolId'); }}">
        <input type="text" name="districtId" class="form-control border border-info d-none" value="{{ Request::get('districtId') }}">
        <input type="text" name="sectionId" class="form-control border border-info d-none" value="{{ Request::get('sectionId') }}">
        <input type="text" name="classId" class="form-control border border-info d-none" value="{{ $class->id }}">
        <button type="submit" class="btn btn-outline-primary rounded-0">See MasterList</button>
    </form>
    @endforeach
    
    @if(Request::get('option_blocker') != 1)
    <form class="d-flex justify-content-end mb-2" action="{{ route('admin.constants.class_assignment') }}">
        @csrf
        <input type="text" value="{{ Request::get('sectionId') }}" name="retrieveId"
            class="form-control border border-info d-none">
            <button type="submit" class="btn btn-outline-primary rounded-0">Add Class and Assign Class Adviser</button>
    </form>
    @endif

    @endif
</div>
