<div class="row mb-2">
    <div class="col-lg-4 shadow rounded">
        <div class="card shadow-none">
            <div class="card-body shadow-none">
                <div class="d-flex align-items-start">
                    <div>
                        <h4 class="card-title">General</h4>
                        <h6 class="card-subtitle">General Information</h6>
                    </div>
                </div>
            </div>

            <div class="card-body shadow-none">
                <div class="row pb-3 border-bottom">
                    <div class="col-3">
                        <div class="bg-light-primary text-primary text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-users fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex align-items-center">
                        <div>
                            <h5 class="card-title mb-1">{{ $totalPupils[0] }} Pupils</h5>
                            <p class="text-muted mb-0">
                                Total Number of Pupils
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-3">
                        <div class="bg-light-danger text-danger text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-gender-female fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex align-items-center">
                        <div>
                            <h5 class="card-title mb-1">{{ $totalFemalePupils[0] }} Female Pupils</h5>
                            <p class="text-muted mb-0">
                                Total Number of Female Pupils
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-3">
                        <div class="bg-light-info text-info text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-gender-male fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex align-items-center">
                        <div>
                            <h5 class="card-title mb-1">{{ $totalMalePupils[0] }} Male Pupils</h5>
                            <p class="text-muted mb-0">Total Number of Male Pupils</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 shadow rounded">
        <div class="card shadow-none">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h4 class="card-title">Body Mass Index</h4>
                        <h6 class="card-subtitle">Unit kg/m<sup>2</sup></h6>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row pb-3 border-bottom">
                    <div class="col-3">
                        <div class="bg-light-danger text-danger text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-weight fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex row align-items-center">

                        <div>
                            @php
                            $severelyWastedPercentage = ($totalSeverelyWastedPupils[0] / $totalPupils[0]) * 100;
                            @endphp
                            <h5 class="card-title mb-1">{{ $totalSeverelyWastedPupils[0] }}
                                ({{ $severelyWastedPercentage }})%</h5>
                            <p class="text-muted mb-0">
                                Severely Wasted
                            </p>
                        </div>
                        <div class="col-12">
                            <div class="progress bg-light-primary">
                                <div class="progress-bar bg-danger border-0 m-0" role="progressbar"
                                    style="width: <?php echo $severelyWastedPercentage . '%'; ?>; height: 6px;"
                                    aria-valuenow="{{ $severelyWastedPercentage }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-3">
                        <div class="bg-light-warning text-warning text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-weight fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex row align-items-center">
                        <div>
                            @php
                            $wastedPercentage = ($totalWastedPupils[0] / $totalPupils[0]) * 100;
                            @endphp
                            <h5 class="card-title mb-1">{{ $totalWastedPupils[0] }}
                                ({{ $wastedPercentage }})%</h5>
                            <p class="text-muted mb-0">
                                Wasted
                            </p>
                        </div>
                        <div class="col-12">
                            <div class="progress bg-light-primary">
                                <div class="progress-bar bg-warning border-0 m-0" role="progressbar"
                                    style="width: <?php echo $wastedPercentage . '%'; ?>; height: 6px;"
                                    aria-valuenow="{{ $wastedPercentage }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-3">
                        <div class="bg-light-success text-success text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-weight fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex row align-items-center">
                        <div>
                            @php
                            $normalWeightedPercentage = ($totalNormalInWeightPupils[0] / $totalPupils[0]) * 100;
                            @endphp
                            <h5 class="card-title mb-1">{{ $totalNormalInWeightPupils[0] }}
                                ({{ $normalWeightedPercentage }})%</h5>
                            <p class="text-muted mb-0">
                                Normal
                            </p>
                        </div>
                        <div class="col-12">
                            <div class="progress bg-light-primary">
                                <div class="progress-bar bg-success border-0 m-0" role="progressbar"
                                    style="width: <?php echo $normalWeightedPercentage . '%'; ?>; height: 6px;"
                                    aria-valuenow="{{ $normalWeightedPercentage }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row py-3 border-bottom">
                    <div class="col-3">
                        <div class="bg-light-warning text-warning text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-weight fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex row align-items-center">
                        <div>
                        @php
                        $overweightPercentage = ($totalOverweightPupils[0] / $totalPupils[0]) * 100;
                        @endphp
                            <h5 class="card-title mb-1">{{ $totalOverweightPupils[0] }}
                                ({{ $overweightPercentage }})%</h5>
                            <p class="text-muted mb-0">
                                Overweight
                            </p>
                        </div>
                        <div class="col-12">
                            <div class="progress bg-light-primary">
                                <div class="progress-bar bg-warning border-0 m-0" role="progressbar"
                                    style="width: <?php echo $overweightPercentage . '%'; ?>; height: 6px;"
                                    aria-valuenow="{{ $overweightPercentage }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row py-3 border-bottom">
                    <div class="col-3">
                        <div class="bg-light-warning text-warning text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-weight fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex row align-items-center">
                        <div>
                        @php
                        $obesePercentage = ($totalObesePupils[0] / $totalPupils[0]) * 100;
                        @endphp
                            <h5 class="card-title mb-1">{{ $totalObesePupils[0] }}
                                ({{ $obesePercentage }})%</h5>
                            <p class="text-muted mb-0">
                                Obese
                            </p>
                        </div>
                        <div class="col-12">
                            <div class="progress bg-light-primary">
                                <div class="progress-bar bg-danger border-0 m-0" role="progressbar"
                                    style="width: <?php echo $obesePercentage . '%'; ?>; height: 6px;"
                                    aria-valuenow="{{ $obesePercentage }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="col-lg-4 shadow rounded">
        <div class="card shadow-none">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div>
                        <h4 class="card-title">Height-For-Age</h4>
                        <h6 class="card-subtitle">Z-score</h6>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row pb-3 border-bottom">
                    <div class="col-3">
                        <div class="bg-light-danger text-danger text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-line-height fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex row align-items-center">
                        <div>
                            @php
                            $severelyStuntedPercentage = ($totalSeverelyStuntedPupils[0] / $totalPupils[0]) * 100;
                            @endphp
                            <h5 class="card-title mb-1">{{ $totalSeverelyStuntedPupils[0] }}
                                ({{ $severelyStuntedPercentage }})%</h5>
                            <p class="text-muted mb-0">Severely Stunted</p>
                        </div>
                        <div class="col-12">
                            <div class="progress bg-light-primary">
                                <div class="progress-bar bg-danger border-0 m-0" role="progressbar"
                                    style="width: <?php echo $severelyStuntedPercentage . '%'; ?>; height: 6px;"
                                    aria-valuenow="{{ $severelyStuntedPercentage }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row py-3 border-bottom">
                    <div class="col-3">
                        <div class="bg-light-warning text-warning text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-line-height fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex row align-items-center">
                        <div>
                        @php
                        $totalStuntedPupilPercentage = ($totalStuntedPupils[0] / $totalPupils[0]) * 100;
                        @endphp
                            <h5 class="card-title mb-1">{{ $totalStuntedPupils[0] }}
                                ({{ $totalStuntedPupilPercentage }})%</h5>
                            <p class="text-muted mb-0">
                                Stunted
                            </p>
                        </div>
                        <div class="col-12">
                            <div class="progress bg-light-primary">
                                <div class="progress-bar bg-warning border-0 m-0" role="progressbar"
                                    style="width: <?php echo $severelyStuntedPercentage . '%'; ?>; height: 6px;"
                                    aria-valuenow="{{ $severelyStuntedPercentage }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-3">
                        <div class="bg-light-success text-success text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-message fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex row align-items-center">
                        <div>
                        @php
                        $totalPupilsNormalInHeightPercentage = ($totalPupilsNormalInHeight[0] / $totalPupils[0]) * 100;
                        @endphp
                            <h5 class="card-title mb-1">{{ $totalPupilsNormalInHeight[0] }}
                                ({{ $totalPupilsNormalInHeightPercentage }})%</h5>
                            <p class="text-muted mb-0">
                                Normal
                            </p>
                        </div>
                        <div class="col-12">
                            <div class="progress bg-light-primary">
                                <div class="progress-bar bg-success border-0 m-0" role="progressbar"
                                    style="width: <?php echo $totalPupilsNormalInHeightPercentage . '%'; ?>; height: 6px;"
                                    aria-valuenow="{{ $totalPupilsNormalInHeightPercentage }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row py-3 border-bottom">
                    <div class="col-3">
                        <div class="bg-light-warning text-warning text-center py-2 rounded-1 shadow-lg">
                            <i class="ti ti-line-height fs-8"></i>
                        </div>
                    </div>
                    <div class="col-9 d-flex row align-items-center">
                        <div>
                        @php
                        $totalTallPupilsPercentage = ($totalTallPupils[0] / $totalPupils[0]) * 100;
                        @endphp
                            <h5 class="card-title mb-1">{{ $totalTallPupils[0] }}
                                ({{ $totalTallPupilsPercentage }})%</h5>
                            <p class="text-muted mb-0">
                                Tall
                            </p>
                        </div>
                        <div class="col-12">
                            <div class="progress bg-light-primary">
                                <div class="progress-bar bg-warning border-0 m-0" role="progressbar"
                                    style="width: <?php echo $totalTallPupilsPercentage . '%'; ?>; height: 6px;"
                                    aria-valuenow="{{ $totalTallPupilsPercentage }}" aria-valuemin="0"
                                    aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>
