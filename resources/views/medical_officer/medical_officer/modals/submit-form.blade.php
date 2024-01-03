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
                Upon approval, the data from this Consolidated Nutritional Status Report will be consolidated into the Main Consolidated Nutritional Status Report. 
                Please note that only the data from the latest approved version of the Consolidated Nutritional Status Report will be included, replacing any previous entries.<br><br>
                It is crucial to thoroughly review the Consolidated Nutritional Status Report, as any inaccuracies may significantly impact the reliability of the consolidated data.<br><br>
            </h6>
            
            <form class="mx-3" method="post" action="{{ route('cnsr.add') }}" id="userForm">
                {{ csrf_field() }}
                <div class="d-flex row justify-content-center" style="height: fit-content;">
                    <div class="form-floating mb-3 hidden">
                        <input type="text" name="schoolyear_id"
                            value="{{ json_decode($activeSchoolYear['getRecord'], true)[0]['id'] ?? '' }}"
                            class="form-control border border-info" placeholder="School Name" required readonly/>
                        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">School
                                Year Phase</span></label>
                    </div>
                    <div class="form-floating mb-3 hidden">
                        <input type="text" name="cnsr_id" value="{{ $getCNSRId }}"
                            class="form-control border border-info" placeholder="CNSR" required readonly/>
                        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">CNSR ID</span></label>
                    </div>
                    <div class="form-floating mb-3 hidden">
                        @foreach($dataSchoolRecord['getRecord'] as $value)
                        @endforeach
                        <input type="text" name="district_id" value="{{ $districtId[$value->school_id] }}"
                            class="form-control border border-info" placeholder="District Name" required readonly/>
                        <label><i class="ti ti-user me-2 fs-4 text-info"></i><span class="border-start border-info ps-3">District ID</span></label>
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