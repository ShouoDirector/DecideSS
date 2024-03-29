<div class="d-flex shadow-none row w-100 m-0">

    <div class="col-12 shadow-none">
        <div class="card-body w-100">

            <div class="d-flex row m-0 justify-content-end mt-4 mb-4">
                <a href="#" type="button"
                    class="btn btn-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Create</a>
                <a href="{{ route('class_adviser.class_adviser.approved_report') }}" type="button"
                    class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Nutritional
                    Status Report</a>
            </div>

            <!-- Tab panes -->
            <div class="tab-content">
                
                <!-- ================================ SIDE FORM - PUPILS ================================================ -->
                @include('class_adviser.class_adviser.forms.na_form')
            </div>
        </div>

    </div>
</div>

</div>
