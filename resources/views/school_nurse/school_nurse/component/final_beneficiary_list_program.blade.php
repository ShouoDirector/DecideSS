<div class="d-flex shadow-none row w-100">

    <div class="col-12 shadow-none">
        <div class="card-body w-100">

            <!-- Nav tabs -->

            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane active show" id="home2" role="tabpanel">
                    <div class="p-3">

                    <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
                        <a href="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}" type="button"
                            class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">List of Beneficiaries</a>
                        <a href="#" type="button"
                            class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Healthcare Services</a>
                    </div>

                        <!-- =========================================TABLE FILTER - PUPILS ====================================== -->

                            @include('school_nurse.school_nurse.tables.beneficiaries_program')

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>