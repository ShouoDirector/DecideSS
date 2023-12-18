<div class="modal fade" id="exit-class-modal" tabindex="-1" aria-labelledby="exit-class-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded">
            <div class="modal-header d-flex align-items-center px-4 pt-4">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Exit
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="px-4">
                    You want to exit?<br><br>
                </h6>

                <form action="{{ route('class_adviser.class_adviser.report_approval') }}" method="get">
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
