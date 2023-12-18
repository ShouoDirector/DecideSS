<div class="card d-flex shadow-none row flex-row m-0">

    <div class="card col-lg-4 col-md-6 col-12 m-0 shadow-none" style="height: fit-content;">
        <div class="card-body text-white p-0">
            <div class="d-flex flex-row align-items-center">
                <div class="card-hover d-flex">
                    <div class="ms-3">
                        @if(count($dataClassRecord['getRecord']) === 0)
                        No Class found.
                        @else
                        @foreach($dataClassRecord['getRecord'] as $value)
                        @if(isset($className[$value->class_id]))
                        @php
                        $classNameValue = $className[$value->class_id];
                        $gradeLevel = $classGradeLevel[$value->class_id];
                        @endphp
                        @break
                        @endif
                        @endforeach
                        <h3 class="mb-0 text-dark fs-5">School : {{ $schoolName[$classSchoolId[$value->class_id]] }}</h3>
                        <h4 class="mb-0 text-dark fs-6">Grade : {{ $gradeLevel }}</h4>
                        <span class="text-dark">Section : {{ $classNameValue ?? 'No Class found' }} </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex row justify-content-end col-lg-8 col-md-6 col-12 gap-2" style="height: fit-content;">
        <div class="d-flex justify-content-end mb-1 col-auto font-medium m-0 p-0">
            <form class="d-flex row col-12 w-auto" action="{{ route('class_adviser.class_adviser.view_nsr') }}">
                <div class="hidden">
                    <input type="search" class="border-dark col-1 " id="text-srh" name="search"
                        value="{{ Request::get('search') }}" placeholder="Search" readonly>
                </div>
                <button type="submit" class="btn btn-outline-primary card-hover mb-1 font-medium"
                    style="height: fit-content; width: fit-content;">
                    View and Print
                </button>
            </form>
        </div>
    </div>

    @include('class_adviser.class_adviser.modals.exit-na-class')


</div>

