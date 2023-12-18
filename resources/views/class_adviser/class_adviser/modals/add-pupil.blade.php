<div class="modal fade" id="add-pupils-modal" tabindex="-1" aria-labelledby="add-pupils-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded">
            <div class="modal-header d-flex align-items-center px-4 pt-4">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Perform Action
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="px-4">
                    You want to add this pupil?<br><br>
                    {{ $head['headerMessage1'] }} <br><br>
                </h6>
                <br>
                <div class="d-flex row text-white mx-1">
                    <button type="submit" value="{{ $head['headerTitle1'] }}" class="btn btn-danger card-hover text-white">
                        Yes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
