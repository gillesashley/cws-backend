@extends('layouts.app')

@section('content')
    <h2>Dashboard</h2>
    <div class="row">
        <div class="col-12 col-lg-6 col-xl-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">Total Traffic</h6>
                        <div class="dropdown options ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated"
                                    aria-label="ellipsis horizontal sharp"></ion-icon>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="chart-container3">
                        <div class="piechart-legend">
                            <h2 class="mb-1">85%</h2>
                            <h6 class="mb-0">Total Visitors</h6>
                        </div>
                        <canvas id="chart1" width="271" height="293"
                            style="display: block; box-sizing: border-box; height: 293px; width: 271px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">User Activity</h6>
                        <div class="dropdown options ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated"
                                    aria-label="ellipsis horizontal sharp"></ion-icon>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="chart-container3">
                        <canvas id="chart2" width="271" height="293"
                            style="display: block; box-sizing: border-box; height: 293px; width: 271px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12 col-xl-4 d-flex">
            <div class="card radius-10 bg-transparent shadow-none w-100">
                <div class="card-body p-0">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="widget-icon radius-10 bg-light-success text-success">
                                    <ion-icon name="wallet-sharp" role="img" class="md hydrated"
                                        aria-label="wallet sharp"></ion-icon>
                                </div>
                                <div class="fs-5 ms-auto">
                                    <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated"
                                        aria-label="ellipsis horizontal sharp"></ion-icon>
                                </div>
                            </div>
                            <h4 class="my-3">$4,580</h4>
                            <div class="progress mt-1" style="height: 5px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
                            </div>
                            <p class="mb-0 mt-2">Earned This Month <span class="float-end">+2.4%</span></p>
                        </div>
                    </div>
                    <div class="card radius-10 mb-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="widget-icon-2 bg-light-danger text-danger">
                                    <ion-icon name="people-sharp" role="img" class="md hydrated"
                                        aria-label="people sharp"></ion-icon>
                                </div>
                                <div class="fs-5 ms-auto">
                                    <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated"
                                        aria-label="ellipsis horizontal sharp"></ion-icon>
                                </div>
                            </div>
                            <h4 class="my-3">8,126</h4>
                            <div class="progress mt-1" style="height: 5px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 65%"></div>
                            </div>
                            <p class="mb-0 mt-2">New Clients <span class="float-end">+5.3%</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
