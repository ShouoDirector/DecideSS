<div class="card d-flex shadow-none row flex-row m-0">

    <div class="card col-lg-4 col-md-6 col-12 m-0 shadow-none p-0" style="height: fit-content;">
        <div class="card-body text-white p-0">
            <div class="d-flex flex-row align-items-center">
                <div class="card-hover d-flex">
                    <div class="ms-0 mt-0 mb-3">
                        @if(count($dataClassRecord['getRecord']) === 0)
                        No Class found.
                        @else
                        @foreach($dataClassRecord['getRecord'] as $value)
                        @if(isset($className[$value->class_id]))
                        @php
                        $classNameValue = $className[$value->class_id];
                        $gradeLevel = $classGradeLevel[$value->class_id];
                        $nsr_id = $value->nsr_id;
                        @endphp
                        @break
                        @endif
                        @endforeach

                        <h3 class="mb-0 text-dark fs-5">School : {{ $schoolName[$classSchoolId[$value->class_id]] }}
                        </h3>
                        <h4 class="mb-0 text-dark fs-6">Grade : {{ $gradeLevel }}</h4>
                        <span class="text-dark">Section : {{ $classNameValue ?? 'No Class found' }} </span>
                        <span class="text-dark"> {{ $nsr_id }}</span>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>

    </div>


</div>
