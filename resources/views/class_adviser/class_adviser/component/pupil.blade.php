<div class="d-flex row w-100 m-0">
    <div class="col-12">
        <div class="card-body w-100">
            <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
                <a href="#" type="button" class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Add Pupil</a>
                <a href="{{ route('class_adviser.class_adviser.masterlist') }}" type="button" class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">MasterList</a>
            </div>
            <div class="d-flex row m-0 justify-content-end mt-2 mb-4">
                <a href="#" type="button" class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Insert New Pupil</a>
                <a href="{{ route('class_adviser.class_adviser.pupils_records') }}" type="button" class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Pupils You've Added</a>
                <a href="{{ route('class_adviser.class_adviser.pupil_to_masterlist') }}" type="button" class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Add Pupil To MasterList</a>
            </div>
            <!-- ================================ SIDE FORM - PUPILS ================================================ -->
            @include('class_adviser.class_adviser.forms.pupils-form')
        </div>
    </div>

</div>
