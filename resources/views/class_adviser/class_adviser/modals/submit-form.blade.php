<div class="modal fade" id="vertical-center-modal" tabindex="-1" aria-labelledby="vertical-center-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded">
            <div class="modal-header d-flex align-items-center px-4 pt-4">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Warning!
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <h6 class="px-4">
                {{ $head['headerMessage'] }} <br><br>
                {{ $head['headerMessage2'] }} <br><br>
                {{ $head['headerMessage3'] }} <br><br>
            </h6>
            <form class="mx-3" method="post" action="{{ route('report.add') }}" id="userForm">
                {{ csrf_field() }}
                <div class="d-flex row justify-content-center" style="height: fit-content;">
                    <div class="form-floating mb-3 hidden">
                        <input type="text" name="schoolyear_id"
                            value="{{ json_decode($activeSchoolYear['getRecord'], true)[0]['id'] ?? '' }}"
                            class="form-control border border-info" placeholder="School Name" required readonly/>
                        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">School
                                Year</span></label>
                    </div>
                    @foreach($dataClassRecord['getRecord'] as $value)
                    <div class="form-floating mb-3 hidden">
                        <input type="text" name="class_id" value="{{ $value->class_id }}"
                            class="form-control border border-info" placeholder="School Name" required readonly/>
                        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">Class
                                ID</span></label>
                    </div>
                    @endforeach

                    @foreach($dataClassRecord['getRecord'] as $value)
                    @endforeach

                    <div class="form-floating mb-3 hidden">
                        <input type="text" name="school_id" value="{{ $classSchoolId[$value->class_id] }}"
                            class="form-control border border-info" placeholder="School Name" required readonly/>
                        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">School
                                ID</span></label>
                    </div>

                    <button type="submit" class="btn btn-danger card-hover">
                        Approve Report
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>