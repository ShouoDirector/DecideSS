@extends('admin.includes.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-stretch">
            <div class="card w-100 bg-light-info overflow-hidden shadow-none">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex align-items-center mb-7">
                                <div class="rounded-circle overflow-hidden me-6">
                                    <img src="../../dist/images/profile/user-1.jpg" alt="" width="40" height="40">
                                </div>
                                <h5 class="fw-semibold mb-0 fs-5">Welcome back Mathew Anderson!</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="border-end pe-4 border-muted border-opacity-10">
                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">$2,340<i
                                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h3>
                                    <p class="mb-0 text-dark">Today’s Sales</p>
                                </div>
                                <div class="ps-4">
                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">35%<i
                                            class="ti ti-arrow-up-right fs-5 lh-base text-success"></i></h3>
                                    <p class="mb-0 text-dark">Overall Performance</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="welcome-bg-img mb-n7 text-end">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/welcome-bg.svg"
                                    alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
                <h5 class="card-title fw-semibold mb-0 lh-sm">Admin List</h5>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive rounded-2 mb-4">
                    <table class="table border text-nowrap customize-table mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">ID</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Customer</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Progress</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h6 class="fw-semibold mb-0">INV-3066</h6>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="../../dist/images/profile/user-1.jpg" class="rounded-circle"
                                            width="40" height="40" />
                                        <div class="ms-3">
                                            <h6 class="fs-4 fw-semibold mb-0">Olivia Rhye</h6>
                                            <span class="fw-normal">olivia@ui.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress bg-light w-100" style="height: 4px;">
                                            <div class="progress-bar" role="progressbar" aria-label="Example 4px high"
                                                style="width: 60%;" aria-valuenow="60" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <span class="fw-normal">60%</span>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-light-primary rounded-3 py-2 text-primary fw-semibold fs-2 d-inline-flex align-items-center gap-1"><i
                                            class="ti ti-check fs-4"></i>paid</span>
                                </td>
                                <td>
                                    <div class="dropdown dropstart">
                                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ti ti-dots-vertical fs-6"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                        class="fs-4 ti ti-plus"></i>Add</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                        class="fs-4 ti ti-edit"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                        class="fs-4 ti ti-trash"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="fw-semibold mb-0">INV-3067</h6>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="../../dist/images/profile/user-2.jpg" class="rounded-circle"
                                            width="40" height="40" />
                                        <div class="ms-3">
                                            <h6 class="fs-4 fw-semibold mb-0">Barbara Steele</h6>
                                            <span class="fw-normal">steele@ui.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="progress bg-light w-100" style="height: 4px;">
                                            <div class="progress-bar" role="progressbar" aria-label="Example 4px high"
                                                style="width: 30%;" aria-valuenow="30" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <span class="fw-normal">30%</span>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-light-danger rounded-3 py-2 text-danger fw-semibold fs-2 d-inline-flex align-items-center gap-1"><i
                                            class="ti ti-x fs-4"></i>cancelled</span>
                                </td>
                                <td>
                                    <div class="dropdown dropstart">
                                        <a href="#" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ti ti-dots-vertical fs-6"></i>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                        class="fs-4 ti ti-plus"></i>Add</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                        class="fs-4 ti ti-edit"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-3" href="#"><i
                                                        class="fs-4 ti ti-trash"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
