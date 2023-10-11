@extends('school_nurse.includes.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 d-flex align-items-stretch">
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
        <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">$10,230</h4>
                    <p class="mb-2 fs-3">Expense</p>
                    <div id="expense"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-2 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h4 class="fw-semibold">$65,432</h4>
                    <p class="mb-1 fs-3">Sales</p>
                    <div id="sales" class="sales-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Revenue Updates</h5>
                    <p class="card-subtitle mb-4">Overview of Profit</p>
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">Footware</span>
                        </div>
                        <div>
                            <span class="round-8 bg-secondary rounded-circle me-2 d-inline-block"></span>
                            <span class="fs-2">Fashionware</span>
                        </div>
                    </div>
                    <div id="revenue-chart" class="revenue-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Sales Overview</h5>
                    <p class="card-subtitle mb-2">Every Month</p>
                    <div id="sales-overview" class="mb-4"></div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div
                                class="bg-light-primary rounded-2 me-8 p-8 d-flex align-items-center justify-content-center">
                                <i class="ti ti-grid-dots text-primary fs-6"></i>
                            </div>
                            <div>
                                <h6 class="fw-semibold text-dark fs-4 mb-0">$23,450</h6>
                                <p class="fs-3 mb-0 fw-normal">Profit</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div
                                class="bg-light-secondary rounded-2 me-8 p-8 d-flex align-items-center justify-content-center">
                                <i class="ti ti-grid-dots text-secondary fs-6"></i>
                            </div>
                            <div>
                                <h6 class="fw-semibold text-dark fs-4 mb-0">$23,450</h6>
                                <p class="fs-3 mb-0 fw-normal">Expance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="p-2 bg-light-primary rounded-2 d-inline-block mb-3">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-cart.svg"
                                    alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div id="sales-two" class="mb-3"></div>
                            <h4 class="mb-1 fw-semibold d-flex align-content-center">$16.5k<i
                                    class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
                            <p class="mb-0">Sales</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 d-flex align-items-stretch">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="p-2 bg-light-info rounded-2 d-inline-block mb-3">
                                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-bar.svg"
                                    alt="" class="img-fluid" width="24" height="24">
                            </div>
                            <div id="growth" class="mb-3"></div>
                            <h4 class="mb-1 fw-semibold d-flex align-content-center">24%<i
                                    class="ti ti-arrow-up-right fs-5 text-success"></i></h4>
                            <p class="mb-0">Growth</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row alig n-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Monthly Earnings </h5>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fw-semibold mb-0 me-8">$6,820</h4>
                                <div class="d-flex align-items-center">
                                    <span
                                        class="me-2 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-up-left text-success"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div class="p-2 bg-light-primary rounded-2 d-inline-block">
                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-master-card-2.svg"
                                        alt="" class="img-fluid" width="24" height="24">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="monthly-earning"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Weekly Stats</h5>
                    <p class="card-subtitle mb-0">Average sales</p>
                    <div id="weekly-stats" class="mb-4 mt-7"></div>
                    <div class="position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <div
                                    class="p-6 bg-light-primary rounded-2 me-6 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grid-dots text-primary fs-6"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">Top Sales</h6>
                                    <p class="fs-3 mb-0">Johnathan Doe</p>
                                </div>
                            </div>
                            <div class="bg-light-primary badge">
                                <p class="fs-3 text-primary fw-semibold mb-0">+68</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <div
                                    class="p-6 bg-light-success rounded-2 me-6 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grid-dots text-success fs-6"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">Best Seller</h6>
                                    <p class="fs-3 mb-0">Footware</p>
                                </div>
                            </div>
                            <div class="bg-light-success badge">
                                <p class="fs-3 text-success fw-semibold mb-0">+68</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex">
                                <div
                                    class="p-6 bg-light-danger rounded-2 me-6 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grid-dots text-danger fs-6"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">Most Commented</h6>
                                    <p class="fs-3 mb-0">Fashionware</p>
                                </div>
                            </div>
                            <div class="bg-light-danger badge">
                                <p class="fs-3 text-danger fw-semibold mb-0">+68</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div>
                        <h5 class="card-title fw-semibold">Yearly Sales</h5>
                        <p class="card-subtitle mb-0">Every month</p>
                        <div id="salary" class="mb-7 pb-8"></div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div
                                    class="bg-light-primary rounded-2 me-8 p-8 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grid-dots text-primary fs-6"></i>
                                </div>
                                <div>
                                    <p class="fs-3 mb-0 fw-normal">Total Sales</p>
                                    <h6 class="fw-semibold text-dark fs-4 mb-0">$36,358</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div
                                    class="bg-light rounded-2 me-8 p-8 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grid-dots text-muted fs-6"></i>
                                </div>
                                <div>
                                    <p class="fs-3 mb-0 fw-normal">Expenses</p>
                                    <h6 class="fw-semibold text-dark fs-4 mb-0">$5,296</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Payment Gateways</h5>
                    <p class="card-subtitle mb-7">Platform for Income</p>
                    <div class="position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <div
                                    class="p-8 bg-light-primary rounded-2 d-flex align-items-center justify-content-center me-6">
                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-paypal2.svg"
                                        alt="" class="img-fluid" width="24" height="24">
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">PayPal</h6>
                                    <p class="fs-3 mb-0">Big Brands</p>
                                </div>
                            </div>
                            <h6 class="mb-0 fw-semibold">+$6,235</h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <div
                                    class="p-8 bg-light-success rounded-2 d-flex align-items-center justify-content-center me-6">
                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-wallet.svg"
                                        alt="" class="img-fluid" width="24" height="24">
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">Wallet</h6>
                                    <p class="fs-3 mb-0">Bill payment</p>
                                </div>
                            </div>
                            <h6 class="mb-0 fw-semibold text-muted">+$345</h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <div
                                    class="p-8 bg-light-warning rounded-2 d-flex align-items-center justify-content-center me-6">
                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-credit-card.svg"
                                        alt="" class="img-fluid" width="24" height="24">
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">Credit card</h6>
                                    <p class="fs-3 mb-0">Money reversed</p>
                                </div>
                            </div>
                            <h6 class="mb-0 fw-semibold">+$2,235</h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-7 pb-1">
                            <div class="d-flex">
                                <div
                                    class="p-8 bg-light-danger rounded-2 d-flex align-items-center justify-content-center me-6">
                                    <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-pie2.svg"
                                        alt="" class="img-fluid" width="24" height="24">
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">Refund</h6>
                                    <p class="fs-3 mb-0">Bill payment</p>
                                </div>
                            </div>
                            <h6 class="mb-0 fw-semibold text-muted">-$32</h6>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary w-100">View all transactions</button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Recent Transactions</h5>
                        <p class="card-subtitle">How to Secure Recent Transactions</p>
                    </div>
                    <ul class="timeline-widget mb-0 position-relative mb-n5">
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">09:30</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1">Payment received from John Doe
                                of $385.90</div>
                        </li>
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">10:00 am</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-info flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a
                                    href="javascript:void(0)" class="text-primary d-block fw-normal ">#ML-3467</a>
                            </div>
                        </li>
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1">Payment was made of $64.95 to
                                Michael</div>
                        </li>
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-warning flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New sale recorded <a
                                    href="javascript:void(0)" class="text-primary d-block fw-normal ">#ML-3467</a>
                            </div>
                        </li>
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">09:30 am</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-danger flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">New arrival recorded
                                <a href="javascript:void(0)" class="text-primary d-block fw-normal ">#ML-3467</a>
                            </div>
                        </li>
                        <li class="timeline-item d-flex position-relative overflow-hidden">
                            <div class="timeline-time text-dark flex-shrink-0 text-end">12:00 am</div>
                            <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border border-success flex-shrink-0 my-8"></span>
                            </div>
                            <div class="timeline-desc fs-3 text-dark mt-n1">Payment Done</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-3">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Product Performances</h5>
                            <p class="card-subtitle">What Impacts Product Performance?</p>
                        </div>
                        <div>
                            <select class="form-select fw-semibold">
                                <option value="1">March 2023</option>
                                <option value="2">April 2023</option>
                                <option value="3">May 2023</option>
                                <option value="4">June 2023</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col" class="ps-0">Assigned</th>
                                    <th scope="col">Progress</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Budget</th>
                                    <th scope="col">Chart</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 pe-1">
                                                <img src="../../dist/images/products/product-1.jpg" class="rounded-2"
                                                    width="48" height="48" alt="" />
                                            </div>
                                            <div>
                                                <h6 class="fw-semibold mb-1">Minecraf App</h6>
                                                <p class="fs-2 mb-0 text-muted">Jason Roy</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-3 text-dark">73.2%</p>
                                    </td>
                                    <td>
                                        <span
                                            class="badge fw-semibold py-1 w-85 bg-light-success text-success">Low</span>
                                    </td>
                                    <td>
                                        <p class="fs-3 text-dark mb-0">$3.5k</p>
                                    </td>
                                    <td>
                                        <div id="table-chart"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 pe-1">
                                                <img src="../../dist/images/products/product-2.jpg" class="rounded-2"
                                                    width="48" height="48" alt="" />
                                            </div>
                                            <div>
                                                <h6 class="fw-semibold mb-1">Web App Project</h6>
                                                <p class="fs-2 mb-0 text-muted">Mathew Flintoff</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-3 text-dark">56.8%</p>
                                    </td>
                                    <td>
                                        <span
                                            class="badge fw-semibold py-1 w-85 bg-light-warning text-warning">Medium</span>
                                    </td>
                                    <td>
                                        <p class="fs-3 text-dark mb-0">$3.5k</p>
                                    </td>
                                    <td>
                                        <div id="table-chart-1"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 pe-1">
                                                <img src="../../dist/images/products/product-3.jpg" class="rounded-2"
                                                    width="48" height="48" alt="" />
                                            </div>
                                            <div>
                                                <h6 class="fw-semibold mb-1">Modernize Dashboard</h6>
                                                <p class="fs-2 mb-0 text-muted">Anil Kumar</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fs-3 text-dark">25%</p>
                                    </td>
                                    <td>
                                        <span class="badge fw-semibold py-1 w-85 bg-light-info text-info">Very
                                            high</span>
                                    </td>
                                    <td>
                                        <p class="fs-3 text-dark mb-0">$3.5k</p>
                                    </td>
                                    <td>
                                        <div id="table-chart-2"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0 border-bottom-0">
                                        <div class="d-flex align-items-center">
                                            <div class="me-2 pe-1">
                                                <img src="../../dist/images/products/product-4.jpg" class="rounded-2"
                                                    width="48" height="48" alt="" />
                                            </div>
                                            <div>
                                                <h6 class="fw-semibold mb-1">Dashboard Co</h6>
                                                <p class="fs-2 mb-0 text-muted">George Cruize</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fs-3 text-dark">96.3%</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span
                                            class="badge fw-semibold py-1 w-85 bg-light-danger text-danger">High</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="fs-3 text-dark mb-0">$3.5k</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div id="table-chart-3"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
