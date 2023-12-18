<div class="modal fade" id="delete-section-modal" tabindex="-1" aria-labelledby="delete-section-modal"
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
                <h6 class="p-2" style="white-space: normal;">
                You are about to delete a section. The section may have been used in the past school year phases.
                Please ensure that you understand the implications of this action,
                as it may affect existing data and overall statistics.
                </h6>
                <br>
                <div class="d-flex row text-white mx-1">
                    <a href="{{ route('admin.constants.section_delete', ['id' => $value->id]) }}" type="submit"
                        class="btn btn-danger card-hover text-white" data-bs-toggle="tooltip">
                        Yes, I understand </a>
                </div>
            </div>
        </div>
    </div>
</div>
