<div class="card d-flex shadow-none flex-row m-0">

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
                        <h4 class="mb-0 text-dark fs-6">Grade {{ $gradeLevel }}</h4>
                        <span class="text-dark">Section : {{ $classNameValue ?? 'No Class found' }} - </span>
                        <span class="text-dark">As of {{ now()->format('F j, Y') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="col-12 d-flex justify-content-between align-items-center mb-4">
    <a class="btn row d-lg-none d-flex justify-content-" data-bs-toggle="offcanvas" href="#offcanvasExample"
        role="button" aria-controls="offcanvasExample">
        <i class="ti ti-menu-2 fs-6"></i>
    </a>
</div>
