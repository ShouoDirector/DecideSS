<div class="modal fade" id="exit-na-class" tabindex="-1" aria-labelledby="exit-na-class"
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
                    You want to exit the nutritional status report?<br><br>
                </h6>

                <form action="{{ route('medical_officer.medical_officer.cnsr_main') }}" method="get">
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