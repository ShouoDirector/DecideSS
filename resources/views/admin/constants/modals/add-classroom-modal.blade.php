<div class="modal fade" id="add-classroom-modal" tabindex="-1" aria-labelledby="add-classroom-modal" aria-hidden="true">
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
                    You were going to assign {{ $classAdvisersNames[$dataClassAdvisers['getList'][0]['id']] }}
                    into the {{ $schoolNames[$section->school_id] }}, Class {{ $section->grade_level }} {{ $section->section_name }}
                    <br><br>
                    {{ $head['headerMessage1'] }}<br><br>
                </h6>
                <br>
                <div class="d-flex row text-white mx-1">
                    <button type="submit" class="btn btn-danger card-hover text-white" data-bs-toggle="tooltip">
                        Yes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
