<div class="modal fade" id="add-pupil-modal" tabindex="-1" aria-labelledby="add-pupil-modal" aria-hidden="true">
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
                    You want to add this pupil to your masterlist?<br><br>
                    {{ $head['headerMessage1'] }} <br><br>
                </h6>
                <div class="d-flex row col-12 border-none m-0 p-0">
                    <input type="hidden" name="class_id" value="">
                    <div class="form-floating mb-3 col-lg-3 col-md-6 col-12 border-none hidden">
                        <input type="text" class="form-control" placeholder="Class ID" readonly
                            value="{{ $dataSection['getRecord']->id }}" name="class_id" required>
                        <label><span class="border-info ps-3">Section</span></label>
                    </div>

                </div>
                <div class="d-flex row text-white mx-1">
                    <button type="submit" class="btn btn-danger card-hover text-white" data-bs-toggle="tooltip">
                        Yes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
