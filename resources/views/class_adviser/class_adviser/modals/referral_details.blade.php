<div class="modal fade" id="referral_details" tabindex="-1" aria-labelledby="referral_details" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded">
            <div class="modal-header d-flex align-items-center px-4 pt-4">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Values
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row p-4">
                    <div class="col-12 mb-4" style="white-space: normal;">
                        Old Values: {{ isset($value->old_value) && !empty($value->old_value) ? $value->old_value : 'No old values' }}
                    </div>
                    <div class="col-12 mb-4" style="white-space: normal;">
                        New Values: {{ isset($value->new_value) && !empty($value->new_value) ? $value->new_value : 'No new values' }}
                    </div>
                </div>
                <div class="d-flex row px-3">
                    <button type="button" class="btn btn-danger card-hover text-white" data-bs-dismiss="modal" aria-label="Close">
                        Okay
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
