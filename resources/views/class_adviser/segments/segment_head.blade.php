<div class="col-12 d-flex align-items-stretch w-100 px-0">
    <div class="col-12 card bg-light-info shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9 card-hover">
                    <h4 class="fw-semibold mb-8">{{ $head['headerTitle'] }}</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted "
                                    href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">{{ $head['headerTitle'] }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-3 card-hover">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('background-images/welcome-bg2.png')}}" alt="" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-12 w-100">
    @include('_message')
</div>
