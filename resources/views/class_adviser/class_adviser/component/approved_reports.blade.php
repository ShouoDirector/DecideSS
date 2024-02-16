<div class="card shadow-none p-0">

    <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
        <a href="{{ route('class_adviser.class_adviser.nutritional_assessment') }}" type="button"
            class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Create</a>
        <a href="#" type="button"
            class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Nutritional Status Report</a>

    </div>

</div>

<div class="d-flex row p-0 m-0">

    <div class="col-12 p-0">
        <div class="card-body p-0">

            <!-- Nav tabs -->

            <!-- Tab panes -->

            <div class="tab-content expanding-div" id="expandingDiv">

                <div class="tab-pane active show" id="home2" role="tabpanel">

                    <!-- =========================================TABLE FILTER - PUPILS ====================================== -->
                    @include('class_adviser.class_adviser.component.approved_report_class')
                    <!-- ========================================= REPORT TABLE ====================================== -->
                    @include('class_adviser.class_adviser.tables.approved_report')

                </div>

            </div>

        </div>
    </div>

</div>
