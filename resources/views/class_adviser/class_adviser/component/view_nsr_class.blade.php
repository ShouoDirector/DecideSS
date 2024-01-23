<div class="card d-flex shadow-none row flex-row m-0 mb-3">

    <div class="card col-lg-4 col-md-6 col-12 m-0 shadow-none p-0" style="height: fit-content;">
        <div class="card-body text-white p-0">
            <div class="d-flex flex-row align-items-center">
                <div class="card-hover d-flex">
                    <div class="ms-0">
                        @if(count($dataClassRecord['getRecord']) === 0)
                        No Class found.
                        @else
                        @foreach($dataClassRecord['getRecord'] as $value)
                        @if(isset($className[$value->class_id]))
                        @php
                        $classNameValue = $sectionNames[$dataClassSectionId[$value->class_id]];
                        $gradeLevel = $classGradeLevel[$value->class_id];
                        @endphp
                        @break
                        @endif
                        @endforeach
                        <h4 class="mb-1 text-dark fs-6">School : {{ $schoolName[$classSchoolId[$value->class_id]] }}</h4>
                        <h4 class="mb-0 text-dark fs-5">Grade : {{ $gradeLevel }}</h4>
                        <span class="text-dark fs-4">Section : {{ $classNameValue ?? 'No Class found' }} </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('class_adviser.class_adviser.modals.exit-na-class')


</div>

