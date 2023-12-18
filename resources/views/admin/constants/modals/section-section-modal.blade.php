<div class="modal fade" id="section-section-modal" tabindex="-1" aria-labelledby="section-section-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded">
            <div class="modal-header d-flex align-items-center px-4 pt-4">
                <h4 class="modal-title" id="myLargeModalLabel">
                    Perform Action
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3 border-1 border-dark rounded m-3">
                    <input type="text" class="form-control" placeholder="Section Name" name="section_name" required>
                    <label><span class="border-info">Section Name</span></label>
                </div>
                <div class="form-floating mb-3 border-1 border-dark rounded m-3">
                    <select class="form-control form-select border border-info p-3 select2" name="grade_level"
                        id="userTypeSelect">
                        <option value="#" selected disabled>Select Grade Level</option>
                        <option value="Kinder">Kinder</option>
                        <option value="1">Grade 1</option>
                        <option value="2">Grade 2</option>
                        <option value="3">Grade 3</option>
                        <option value="4">Grade 4</option>
                        <option value="5">Grade 5</option>
                        <option value="6">Grade 6</option>
                        <option value="SPED">SPED</option>
                    </select>

                    <div id="validationMessage" class="text-danger"></div>
                </div>
                <h6 class="px-4">
                    Input the Name and the Grade Level of the Section first<br><br>
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
