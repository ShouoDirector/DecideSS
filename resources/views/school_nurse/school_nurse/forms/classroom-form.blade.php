<div class="col-12 card position-relative overflow-hidden">
    <div class="card-body">
        <h5>{{ $head['headerTitle1'] }}</h5>
        <p class="card-subtitle mb-3 mt-3">
            {{ $head['headerMessage1'] }}
        </p>
        <form class="" method="post" action="{{ route('classroom.add') }}" id="userForm">
            {{ csrf_field() }}
            <div class="form-floating mb-3">
                <input type="text" name="section" class="form-control border border-info" placeholder="Section"
                    required />
                <label><i class="ti ti-user me-2 fs-4 text-info"></i><span
                        class="border-start border-info ps-3">Section</span></label>
            </div>
            <div class="mb-3">
                <select class="form-control form-select border border-info p-3 select2" name="classadviser_id"
                    id="userTypeSelect">
                    <option value="#" selected disabled>Assign Available Class Adviser</option>
                    @if(isset($availableClassAdvisers) && !empty($availableClassAdvisers))
                    @foreach($availableClassAdvisers as $classAdvisers)
                    <option value="{{ $classAdvisers->id }}">{{ $classAdvisers->email }}</option>
                    @endforeach
                    @else
                    <option value="#" disabled>No Class Advisers available</option>
                    @endif
                </select>

                <div id="validationMessage" class="text-danger"></div>
            </div>
            <div class="mb-3">
                <select class="form-control form-select border border-info p-3 select2" name="grade_level"
                    id="userTypeSelect">
                    <option value="#" selected disabled>Select Grade Level</option>
                    <option value="Kinder">Kinder</option>
                    <option value="1">Grade 1</option>
                    <option value="2">Grade 2</option>
                    <option value="3">Grade 3</option>
                    <option value="4">Grade 4</option>
                    <option value="5">Grade 5</option>
                    <option value="6">Grade 6</option>
                    <option value="SPED">SPED</option>
                </select>

                <div id="validationMessage" class="text-danger"></div>
            </div>

            <div class="d-md-flex align-items-center">
                <div class="mt-3 mt-md-0 d-content" style="display: contents;">
                    <input type="submit" value="Submit" class="btn btn-info font-medium w-100 px-4" id="submitButton">
                </div>
            </div>
        </form>

        @include('validator/form-validator')

    </div>
</div>
