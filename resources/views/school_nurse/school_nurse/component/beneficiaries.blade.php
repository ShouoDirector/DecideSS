<div class="d-flex row m-0 justify-content-end mt-4 mb-4">
    <a href="#" type="button"
        class="btn btn-primary rounded-0 d-flex col-lg-3 col-sm-6 justify-content-center">Beneficiaries Update</a>
    <a href="{{ route('school_nurse.school_nurse.enlist_new') }}" type="button"
        class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Enlist</a>
        <a href="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries') }}" type="button"
                            class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">List of Beneficiaries</a>
                <a href="{{ route('school_nurse.school_nurse.final_list_of_beneficiaries_program') }}" type="button"
                            class="btn btn-outline-primary rounded-0 d-flex col-lg-2 col-md-4 col-sm-6 justify-content-center">Healthcare Services</a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="text-center mb-7">
            <h3 class="fw-semibold">Beneficiary List Updates</h3>
            <p class="fw-normal mb-0 fs-4">Kindly ensure regular updates to keep the list current.</p>
        </div>

        <button class="px-4 py-2 btn bg-primary shadow">
            <h6 class="text-white m-0">Nutritional Status</h6>
        </button>
        <!-- UNDER NUTRITION -->
        <div class="accordion accordion-flush mb-5 card position-relative overflow-hidden shadow-lg"
            id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        UnderNutrition
                        <span class="badge {{ (count($getMalnourishedList['getRecords']) == 0) ? 'bg-success' : 'bg-danger' }} mx-2">
                            {{ count($getMalnourishedList['getRecords']) }}
                        </span>
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body fw-normal">
                        <div
                            class="d-sm-flex d-block align-items-center justify-content-between mb-0 bg-primary p-4 rounded">
                            <div class="mb-3 mb-sm-0 w-100">
                                <h5 class="card-title fw-semibold text-white">Beneficiaries By UnderNutrition</h5>
                                <p class="card-subtitle mb-0 text-white">Both Severely Wasted and Wasted</p>
                                @if(count($getMalnourishedList['getRecords']) != 0)
                                <form class="d-flex justify-content-end" action="{{ route('school_nurse.school_nurse.enlist_underweight') }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="text-white text-end bg-info btn" type="submit">Enlist All Underweight Pupils</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        <div class="app-chat">
                            <ul class="chat-users" style="height: calc(100vh - 400px)" data-simplebar="init"
                                id="user-list">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content"
                                                style="height: 100%; overflow: hidden scroll;">
                                                <div class="simplebar-content" style="padding: 5px;">
                                                    @if(empty($getMalnourishedList['getRecords']) ||
                                                    $getMalnourishedList['getRecords'] == null ||
                                                    count($getMalnourishedList['getRecords']) == 0)
                                                    <li>
                                                        <p>Congratulations to your school! There's no underweight pupil!</p>
                                                    </li>
                                                    @else
                                                    @foreach($getMalnourishedList['getRecords'] as $na)
                                                    @php
                                                    $gradeLevel = $classGradeLevel[$na->class_id];
                                                    @endphp

                                                    @if(in_array($gradeLevel, ['Kinder', '1', '2', '3', '4', '5', '6',
                                                    'SPED']))

                                                    <li>
                                                        <a href="javascript:void(0)"
                                                            class="px-4 py-3 bg-hover-light-black d-flex align-items-center chat-user bg-light"
                                                            id="chat_user_1" data-user-id="1">
                                                            <div
                                                                class="p-6 bg-light-primary rounded me-6 d-flex align-items-center justify-content-center">
                                                                <i class="ti ti-user text-primary fs-6"></i>
                                                            </div>
                                                            <h4>{{ $loop->iteration }}</h4>
                                                            <div class="ms-6 d-inline-block w-75">
                                                                <h6 class="mb-1 fw-semibold chat-title">
                                                                    {{ $dataPupilNames[$na->pupil_id] }}
                                                                </h6>
                                                                <span class="fs-2 text-body-color d-block">Grade
                                                                    {{ $gradeLevel }} -
                                                                    {{ $className[$na->class_id] }}</span>
                                                            </div>
                                                            <div class="bg-light-danger badge">
                                                                <p class="fs-3 text-dark fw-semibold mb-0">
                                                                    {{ $na->bmi }}</p>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    @endif
                                                    @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto; height: 720px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                    <div class="simplebar-scrollbar"
                                        style="height: 222px; transform: translate3d(0px, 0px, 0px); display: block;">
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STUNTED GROWTH -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Stunted Growth
                        <span class="badge {{ (count($getStuntedList['getRecords']) == 0) ? 'bg-success' : 'bg-danger' }} mx-2">
                            {{ count($getStuntedList['getRecords']) }}
                        </span>
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body fw-normal">
                        <div
                            class="d-sm-flex d-block align-items-center justify-content-between mb-0 bg-primary p-4 rounded">
                            <div class="mb-3 mb-sm-0 w-100">
                                <h5 class="card-title fw-semibold text-white">Beneficiaries By Stunted Growth</h5>
                                <p class="card-subtitle mb-0 text-white">Both Severely Stunted and Stunted</p>
                                @if(count($getStuntedList['getRecords']) != 0)
                                <form class="d-flex justify-content-end" action="{{ route('school_nurse.school_nurse.enlist_stunted') }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="text-white text-end bg-info btn" type="submit">Enlist All Severely Stunted & Stunted Pupils</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        <div class="app-chat">
                            <ul class="chat-users" style="height: calc(100vh - 400px)" data-simplebar="init"
                                id="user-list">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content"
                                                style="height: 100%; overflow: hidden scroll;">
                                                <div class="simplebar-content" style="padding: 5px;">

                                                    @if(empty($getStuntedList['getRecords']) ||
                                                    $getStuntedList['getRecords'] == null ||
                                                    count($getStuntedList['getRecords']) == 0)
                                                    <li class="px-3 py-2 m-2 bg-success text-white rounded d-flex justify-content-center align-items-center">
                                                        Congratulations to your school! There's no stunted pupil!
                                                    </li>
                                                    @else
                                                    @foreach($getStuntedList['getRecords'] as $na)
                                                    @php
                                                    $gradeLevel = $classGradeLevel[$na->class_id];
                                                    @endphp

                                                    @if(in_array($gradeLevel, ['Kinder', '1', '2', '3', '4', '5', '6',
                                                    'SPED']))
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                            class="px-4 py-3 bg-hover-light-black d-flex align-items-center chat-user bg-light"
                                                            id="chat_user_1" data-user-id="1">
                                                            <div
                                                                class="p-6 bg-light-primary rounded me-6 d-flex align-items-center justify-content-center">
                                                                <i class="ti ti-user text-primary fs-6"></i>
                                                            </div>
                                                            <h4>{{ $loop->iteration }}</h4>
                                                            <div class="ms-6 d-inline-block w-75">
                                                                <h6 class="mb-1 fw-semibold chat-title">
                                                                    {{ $dataPupilNames[$na->pupil_id] }}
                                                                </h6>
                                                                <span class="fs-2 text-body-color d-block">Grade
                                                                    {{ $gradeLevel }} -
                                                                    {{ $className[$na->class_id] }}</span>
                                                            </div>
                                                            <div class="bg-light-danger badge">
                                                                <p class="fs-3 text-dark fw-semibold mb-0">
                                                                    {{ $na->hfa }}</p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @endif

                                                    @endforeach
                                                    @endif

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto; height: 720px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                    <div class="simplebar-scrollbar"
                                        style="height: 222px; transform: translate3d(0px, 0px, 0px); display: block;">
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- OVER NUTRITION -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                        OverNutrition
                        <span class="badge {{ (count($getObesityList['getRecords']) == 0) ? 'bg-success' : 'bg-danger' }} mx-2">
                            {{ count($getObesityList['getRecords']) }}
                        </span>
                    </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body fw-normal">
                        <div
                            class="d-sm-flex d-block align-items-center justify-content-between mb-0 bg-primary p-4 rounded">
                            <div class="mb-3 mb-sm-0 w-100">
                                <h5 class="card-title fw-semibold text-white">Beneficiaries By OverNutrition</h5>
                                <p class="card-subtitle mb-0 text-white">Both Overweight and Obesity</p>
                                @if(count($getObesityList['getRecords']) != 0)
                                <form class="d-flex justify-content-end" action="{{ route('school_nurse.school_nurse.enlist_overweight') }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="text-white text-end bg-info btn" type="submit">Enlist All Overweight & Obese Pupils</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        <div class="app-chat">
                            <ul class="chat-users" style="height: calc(100vh - 400px)" data-simplebar="init"
                                id="user-list">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content"
                                                style="height: 100%; overflow: hidden scroll;">
                                                <div class="simplebar-content" style="padding: 5px;">

                                                    @if(empty($getObesityList['getRecords']) ||
                                                    $getObesityList['getRecords'] == null ||
                                                    count($getObesityList['getRecords']) == 0)
                                                    <li class="px-3 py-2 m-2 bg-success text-white rounded d-flex justify-content-center align-items-center">
                                                        Congratulations to your school! There's no overweight pupil!
                                                    </li>
                                                    @else
                                                    @foreach($getObesityList['getRecords'] as $na)
                                                    @php
                                                    $gradeLevel = $classGradeLevel[$na->class_id];
                                                    @endphp

                                                    @if(in_array($gradeLevel, ['Kinder', '1', '2', '3', '4', '5', '6',
                                                    'SPED']))
                                                    <li>
                                                        <a href="javascript:void(0)"
                                                            class="px-4 py-3 bg-hover-light-black d-flex align-items-center chat-user bg-light"
                                                            id="chat_user_1" data-user-id="1">
                                                            <div
                                                                class="p-6 bg-light-primary rounded me-6 d-flex align-items-center justify-content-center">
                                                                <i class="ti ti-user text-primary fs-6"></i>
                                                            </div>
                                                            <h4>{{ $loop->iteration }}</h4>
                                                            <div class="ms-6 d-inline-block w-75">
                                                                <h6 class="mb-1 fw-semibold chat-title">
                                                                    {{ $dataPupilNames[$na->pupil_id] }}
                                                                </h6>
                                                                <span class="fs-2 text-body-color d-block">Grade
                                                                    {{ $gradeLevel }} -
                                                                    {{ $className[$na->class_id] }}</span>
                                                            </div>
                                                            <div class="bg-light-danger badge">
                                                                <p class="fs-3 text-dark fw-semibold mb-0">
                                                                    {{ $na->bmi }}</p>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @endif

                                                    @endforeach
                                                    @endif

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto; height: 720px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                    <div class="simplebar-scrollbar"
                                        style="height: 222px; transform: translate3d(0px, 0px, 0px); display: block;">
                                    </div>
                                </div>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <button class="px-4 py-2 mt-1 btn bg-primary shadow">
            <h6 class="text-white m-0">Program/s</h6>
        </button>
        <div class="accordion accordion-flush mb-5 card position-relative overflow-hidden shadow-lg"
            id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingFour">
                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        Deworming Program
                        <span class="badge {{ (count($getPermittedAndUndecidedList['getRecords']) == 0) ? 'bg-success' : 'bg-primary' }} mx-2">
                            {{ count($getPermittedAndUndecidedList['getRecords']) }}
                        </span>
                    </button>
                </h2>
                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body fw-normal">
                        <div
                            class="d-sm-flex d-block align-items-center justify-content-between mb-0 bg-primary p-4 rounded">
                            <div class="mb-3 mb-sm-0 w-100">
                                <h5 class="card-title fw-semibold text-white">Beneficiaries By Deworming</h5>
                                <p class="card-subtitle mb-0 text-white">Both Permitted by Parent and Undecided</p>
                                @if(count($getPermittedAndUndecidedList['getRecords']) != 0)
                                <form class="d-flex justify-content-end" action="{{ route('school_nurse.school_nurse.enlist_permitted_deworming') }}" method="POST">
                                    {{ csrf_field() }}
                                    <button class="text-white text-end bg-info btn" type="submit">Enlist All Permitted Pupils</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        <div class="app-chat">
                            <ul class="chat-users" style="height: calc(100vh - 400px)" data-simplebar="init"
                                id="user-list">
                                <div class="simplebar-wrapper" style="margin: 0px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                                aria-label="scrollable content"
                                                style="height: 100%; overflow: hidden scroll;">
                                                <div class="simplebar-content" style="padding: 5px;">
                                                    @if(empty($getPermittedAndUndecidedList['getRecords']) ||
                                                    $getPermittedAndUndecidedList['getRecords'] == null ||
                                                    count($getPermittedAndUndecidedList['getRecords']) == 0)
                                                    <li>
                                                        <p>There's no permitted pupil to undergo deworming!</p>
                                                    </li>
                                                    @else
                                                    @foreach($getPermittedAndUndecidedList['getRecords'] as $na)
                                                    @php
                                                    $gradeLevel = $classGradeLevel[$na->class_id];
                                                    @endphp

                                                    @if(in_array($gradeLevel, ['Kinder', '1', '2', '3', '4', '5', '6',
                                                    'SPED']))

                                                    <li>
                                                        <a href="javascript:void(0)"
                                                            class="px-4 py-3 bg-hover-light-black d-flex align-items-center chat-user bg-light"
                                                            id="chat_user_1" data-user-id="1">
                                                            <div
                                                                class="p-6 bg-light-primary rounded me-6 d-flex align-items-center justify-content-center">
                                                                <i class="ti ti-user text-primary fs-6"></i>
                                                            </div>
                                                            <h4>{{ $loop->iteration }}</h4>
                                                            <div class="ms-6 d-inline-block w-75">
                                                                <h6 class="mb-1 fw-semibold chat-title">
                                                                    {{ $dataPupilNames[$na->pupil_id] }}
                                                                </h6>
                                                                <span class="fs-2 text-body-color d-block">Grade
                                                                    {{ $gradeLevel }} -
                                                                    {{ $className[$na->class_id] }}</span>
                                                            </div>
                                                            <div class="bg-light-danger badge">
                                                            <p class="fs-3 text-dark fw-semibold mb-0">
                                                                @if ($na->is_permitted_deworming == '1')
                                                                    Permitted
                                                                @elseif ($na->is_permitted_deworming == '0')
                                                                    Not Permitted
                                                                @else
                                                                    Undecided
                                                                @endif
                                                            </p>
                                                            </div>
                                                        </a>
                                                    </li>

                                                    @endif
                                                    @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto; height: 720px;"></div>
                                </div>
                                <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                </div>
                                <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                    <div class="simplebar-scrollbar"
                                        style="height: 222px; transform: translate3d(0px, 0px, 0px); display: block;">
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>