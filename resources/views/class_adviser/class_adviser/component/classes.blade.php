<div class="d-flex justify-content-end col-12" style="height: fit-content;">
        <div class="d-flex justify-content-end mb-1 col-auto font-medium m-0 p-0">
            <button type="button" class="btn btn-outline-primary card-hover mb-1 font-medium"
                data-bs-toggle="modal" data-bs-target="#vertical-center-modal" style="height: fit-content; width: fit-content;">
                Approve Report
            </button>
        </div>
        <div class="d-flex justify-content-end mb-1 col-auto font-medium m-0 p-0">
            <button type="button" class="btn btn-outline-white card-hover mb-1 font-medium"
                data-bs-toggle="modal" data-bs-target="#exit-class-modal" style="height: fit-content; width: fit-content;">
                <i class="ti ti-x fs-6 align-middle"></i>
            </button>
        </div>
    </div>

<div class="card d-flex shadow-0 row flex-row m-0">

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
                        <h4 class="mb-0 text-dark fs-6">Grade Level : {{ $gradeLevel }}</h4>
                        <span class="text-dark">Section : {{ $classNameValue ?? 'No Class found' }} </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    @include('class_adviser.class_adviser.modals.submit-form')
    @include('class_adviser.class_adviser.modals.exit-class')


</div>

<div class="col-12 d-flex justify-content-between align-items-center mb-4">
    <a class="btn row d-lg-none d-flex justify-content-" data-bs-toggle="offcanvas" href="#offcanvasExample"
        role="button" aria-controls="offcanvasExample">
        <i class="ti ti-menu-2 fs-6"></i>
    </a>
</div>
