<div class="modal fade" id="unarchive-referral-modal" tabindex="-1" aria-labelledby="unarchive-referral-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded">
            <div class="modal-header d-flex align-items-center px-4 pt-4">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Perform Action
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="p-2" style="white-space: normal;">
                You are about to unarchive a referral.
                </h6>
                <br>
                <div class="d-flex row text-white mx-1">
                    <a href="{{ route('school_nurse.school_nurse.referrals_recover', ['id' => $value->id]) }}" type="submit"
                        class="btn btn-danger card-hover text-white" data-bs-toggle="tooltip">
                        Yes, I understand </a>
                </div>
            </div>
        </div>
    </div>
</div>
