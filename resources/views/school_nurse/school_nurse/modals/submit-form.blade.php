<div class="modal fade" id="submit-form" tabindex="-1" aria-labelledby="submit-form"
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
                Important Notice: This action is irreversible, and updating is the only available option. <br><br>
                Upon approval, the data from this Nutritional Status Report will be consolidated into the main Consolidated Nutritional Status Report. 
                Please note that only the data from the latest approved version of the Nutritional Status Report will be included, replacing any previous entries.<br><br>
                It is crucial to thoroughly review the Nutritional Status Report, as any inaccuracies may significantly impact the reliability of the consolidated data.<br><br>
            </h6>
            <form class="mx-3" method="post" action="{{ route('nsr.add') }}" id="userForm">
                {{ csrf_field() }}

                @foreach($dataClassRecord['getRecord'] as $value)
                        
                @endforeach

                @php
                    $schoolId = $classSchoolId[$value->class_id];
                @endphp
                <div class="d-flex row justify-content-center" style="height: fit-content;">
                    <div class="form-floating mb-3 hidden">
                        <input type="text" name="schoolyear_id"
                            value="{{ json_decode($activeSchoolYear['getRecord'], true)[0]['id'] ?? '' }}"
                            class="form-control border border-info" placeholder="School Name" required readonly/>
                        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">School
                                Year Phase</span></label>
                    </div>

                    <div class="form-floating mb-3 hidden">
                        <input type="text" name="district_id"
                            value="{{ $classDistrictId[$schoolId] }}"
                            class="form-control border border-info" placeholder="District" required readonly/>
                        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">District ID</span></label>
                    </div>
                    <div class="form-floating mb-3 hidden">
                        <input type="text" name="nsr_id" value="{{ $dataNA['classRecords'][0]->nsr_id }}"
                            class="form-control border border-info" placeholder="School Name" required readonly/>
                        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">Class
                                ID</span></label>
                    </div>
                    <div class="form-floating mb-3 hidden">
                        <input type="text" name="search_id" value="{{ Request::get('search') }}"
                            class="form-control border border-info" placeholder="School Name" required readonly/>
                        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">Class</span></label>
                    </div>
                    <div class="form-floating mb-3 hidden">
                        @foreach($dataClassRecord['getRecord'] as $value)
                        @endforeach
                        <input type="text" name="school_id" value="{{ $classSchoolId[$value->class_id] }}"
                            class="form-control border border-info" placeholder="School Name" required readonly/>
                        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">School ID</span></label>
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