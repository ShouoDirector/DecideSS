<div class="modal fade" id="na-notes-modal" tabindex="-1" aria-labelledby="na-notes-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded">
            <div class="modal-header d-flex align-items-center px-4 pt-4">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Notes & Observations
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="px-4">
                {{ isset($na->explanation) && !empty($na->explanation) ? $na->explanation : 'No notes/observation' }}<br><br>
                </h6>
                <div class="d-flex row px-3">
                    <button type="submit" class="btn btn-danger card-hover text-white" data-bs-dismiss="modal"
                        aria-label="Close">
                        Okay
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
