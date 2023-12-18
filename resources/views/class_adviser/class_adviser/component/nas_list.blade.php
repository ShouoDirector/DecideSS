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
                        <h4 class="mb-0 text-dark fs-6">Grade {{ $gradeLevel }} | No of Pupils : {{ $dataClassRecord['getRecord']->total() }}</h4>
                        <span class="text-dark">Section : {{ $classNameValue ?? 'No Class found' }} - </span>
                        <span class="text-dark">As of {{ now()->format('F j, Y') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex row justify-content-end col-lg-8 col-md-6 col-12" style="height: fit-content;">
        <div class="d-flex justify-content-end mb-1 col-auto font-medium m-0 p-0">
            <button type="button" class="btn btn-outline-white card-hover mb-1 font-medium"
                data-bs-toggle="modal" data-bs-target="#exit-class-modal" style="height: fit-content; width: fit-content;">
                <i class="ti ti-x fs-6 align-middle"></i>
            </button>
        </div>
    </div>
    @include('class_adviser.class_adviser.modals.exit-class')

</div>

<div class="col-12 d-flex justify-content-between align-items-center mb-4">
    <a class="mb-0 btn-minimize px-2 cursor-pointer text-white link d-flex align-items-center" data-action="expand">
        <i class="ti ti-arrows-maximize fs-6"></i>
    </a>


    <a class="btn row d-lg-none d-flex justify-content-" data-bs-toggle="offcanvas" href="#offcanvasExample"
        role="button" aria-controls="offcanvasExample">
        <i class="ti ti-menu-2 fs-6"></i>
    </a>
</div>
