<div class="modal fade" id="edit-pupil-na-modal" tabindex="-1" aria-labelledby="edit-pupil-na-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded">
            <div class="modal-header d-flex align-items-center px-4 pt-4">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Pupil's Nutritional Assessment?
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="px-4">
                    Update Pupil's Nutritional Assessment?<br><br>
                </h6>

                <form action="{{ route('class_adviser.class_adviser.na_page', ['id' => $value->id]) }}" method="get">
                    <div class="d-flex row px-3">
                        <button type="submit" class="btn btn-danger card-hover text-white" >
                            Yes
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
