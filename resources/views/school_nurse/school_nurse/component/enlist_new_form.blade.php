<div class="d-flex row w-100 m-0">
    <div class="col-12">
        <div class="card-body w-100">
            <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
                <a href="{{ route('school_nurse.school_nurse.list_of_beneficiaries') }}" type="button"
                class="btn btn-outline-primary rounded-0 d-flex col-lg-3 col-sm-6 justify-content-center">Beneficiaries Update</a>
                <a href="#" type="button"
                class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Enlist New</a>
            </div>
            <!-- ================================ SIDE FORM - ENLIST PUPILS TO BENEFICIARIES ================================================ -->
            @include('school_nurse.school_nurse.forms.enlist-new-form')
        </div>
    </div>

</div>
