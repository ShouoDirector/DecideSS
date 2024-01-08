<div class="d-flex row w-100 m-0">
    <div class="col-12">
        <div class="card-body w-100">
            <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
                <a href="#" type="button"
                class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Enlist</a>
                <a href="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}" type="button"
                            class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">List of Beneficiaries</a>
                <a href="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries_program') }}" type="button"
                            class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Healthcare Services</a>
            </div>
            <!-- ================================ SIDE FORM - ENLIST PUPILS TO BENEFICIARIES ================================================ -->
            @include('school_nurse.school_nurse.forms.enlist-new-form')
        </div>
    </div>

</div>
