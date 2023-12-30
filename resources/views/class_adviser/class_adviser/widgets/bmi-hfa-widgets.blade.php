<div class="d-flex row shadow justify-content-between mb-4">
    <!-- Column -->
    <h5 class="row px-4">Body Mass Index</h5>
    <div class="col-md-2-5 col-sm-6">
        <div class="card border-start border-danger shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @php
                        $severelyWastedPercentage = ($totalSeverelyWastedPupils[0] / $totalPupils[0]) * 100;
                        @endphp
                        <h3 class="fs-6">{{ $severelyWastedPercentage }} %</h3>
                        <h6 class="card-subtitle mb-2 text-muted text-muted">Severely Wasted</h6>
                    </div>
                    <div class="col-12">
                        <div class="progress bg-light">
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ $severelyWastedPercentage }}%; height: 6px;"
                                aria-valuenow="{{ $severelyWastedPercentage }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-2-5 col-sm-6">
        <div class="card border-start border-warning shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @php
                        $wastedPercentage = ($totalWastedPupils[0] / $totalPupils[0]) * 100;
                        @endphp
                        <h3 class="fs-6">{{ $wastedPercentage }} %</h3>
                        <h6 class="card-subtitle mb-2 text-muted text-muted">Wasted</h6>
                    </div>
                    <div class="col-12">
                        <div class="progress bg-light">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $wastedPercentage }}%; height: 6px;"
                                aria-valuenow="{{ $wastedPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-2-5 col-sm-6">
        <div class="card border-start border-success shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @php
                        $normalWeightedPercentage = ($totalNormalInWeightPupils[0] / $totalPupils[0]) * 100;
                        @endphp
                        <h3 class="fs-6">{{ $normalWeightedPercentage }} %</h3>
                        <h6 class="card-subtitle mb-2 text-muted text-muted">Normal Weight</h6>
                    </div>
                    <div class="col-12">
                        <div class="progress bg-light">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ $normalWeightedPercentage }}%; height: 6px;"
                                aria-valuenow="{{ $normalWeightedPercentage }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-2-5 col-sm-6">
        <div class="card border-start border-warning shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @php
                        $overweightPercentage = ($totalOverweightPupils[0] / $totalPupils[0]) * 100;
                        @endphp
                        <h3 class="fs-6">{{ $overweightPercentage }} %</h3>
                        <h6 class="card-subtitle mb-2 text-muted text-muted">Overweight</h6>
                    </div>
                    <div class="col-12">
                        <div class="progress bg-light">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $overweightPercentage }}%; height: 6px;"
                                aria-valuenow="{{ $overweightPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-2-5 col-sm-6">
        <div class="card border-start border-danger shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @php
                        $obesePercentage = ($totalObesePupils[0] / $totalPupils[0]) * 100;
                        @endphp
                        <h3 class="fs-6">{{ $obesePercentage }} %</h3>
                        <h6 class="card-subtitle mb-2 text-muted text-muted">Obese</h6>
                    </div>
                    <div class="col-12">
                        <div class="progress bg-light">
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ $obesePercentage }}%; height: 6px;"
                                aria-valuenow="{{ $obesePercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<div class="d-flex row shadow justify-content-between mb-4">
    <!-- Column -->
    <h5 class="row px-4">Height-For-Age</h5>
    <!-- Column -->
    <div class="col-md-3 col-sm-6">
        <div class="card border-start border-danger shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @php
                        $severelyStuntedPercentage = ($totalSeverelyStuntedPupils[0] / $totalPupils[0]) * 100;
                        @endphp
                        <h3 class="fs-6">{{ $severelyStuntedPercentage }} %</h3>
                        <h6 class="card-subtitle mb-2 text-muted text-muted">Severely Stunted</h6>
                    </div>
                    <div class="col-12">
                        <div class="progress bg-light">
                            <div class="progress-bar bg-danger" role="progressbar"
                                style="width: {{ $severelyStuntedPercentage }}%; height: 6px;"
                                aria-valuenow="{{ $severelyStuntedPercentage }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-3 col-sm-6">
        <div class="card border-start border-warning shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @php
                        $totalStuntedPupils = ($totalStuntedPupils[0] / $totalPupils[0]) * 100;
                        @endphp
                        <h3 class="fs-6">{{ $totalStuntedPupils }} %</h3>
                        <h6 class="card-subtitle mb-2 text-muted text-muted">Stunted</h6>
                    </div>
                    <div class="col-12">
                        <div class="progress bg-light">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $totalStuntedPupils }}%; height: 6px;"
                                aria-valuenow="{{ $totalStuntedPupils }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-3 col-sm-6">
        <div class="card border-start border-success shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @php
                        $totalPupilsNormalInHeight = ($totalPupilsNormalInHeight[0] / $totalPupils[0]) * 100;
                        @endphp
                        <h3 class="fs-6">{{ $totalPupilsNormalInHeight }} %</h3>
                        <h6 class="card-subtitle mb-2 text-muted text-muted">Normal Height</h6>
                    </div>
                    <div class="col-12">
                        <div class="progress bg-light">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ $totalPupilsNormalInHeight }}%; height: 6px;"
                                aria-valuenow="{{ $totalPupilsNormalInHeight }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-3 col-sm-6">
        <div class="card border-start border-primary shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @php
                        $totalTallPupils = ($totalTallPupils[0] / $totalPupils[0]) * 100;
                        @endphp
                        <h3 class="fs-6">{{ $totalTallPupils }} %</h3>
                        <h6 class="card-subtitle mb-2 text-muted text-muted">Tall</h6>
                    </div>
                    <div class="col-12">
                        <div class="progress bg-light">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $totalTallPupils }}%; height: 6px;"
                                aria-valuenow="{{ $totalTallPupils }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
