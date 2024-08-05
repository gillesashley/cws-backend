@extends('layouts.app')

@section('content')
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="desktop" role="img"
                                class="md hydrated" aria-label="home outline"></ion-icon></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Analytics</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary">Settings</button>
                <button type="button"
                    class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                        href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12 col-lg-6 col-xl-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">Campaign Traffic</h6>
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
                            <p class="mb-0 mt-2">Registered Users <span class="float-end">+5.3%</span></p>
                        </div>
                    </div>
                <br>
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
                            <p class="mb-0 mt-2">Points Earned This Month <span class="float-end">+2.4%</span></p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div><!--end row-->


    <div class="row">
        
        <div class="col-12 col-lg-12 col-xl-8 d-flex">
            <div class="card radius-10 overflow-hidden w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">Geo Location Statistics</h6>
                        <div class="dropdown options ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                <ion-icon name="ellipsis-horizontal-sharp" role="img" class="md hydrated"
                                    aria-label="ellipsis horizontal sharp"></ion-icon>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="chart-container5">
                        <canvas id="chart4" width="271" height="230"
                            style="display: block; box-sizing: border-box; height: 230px; width: 271px;"></canvas>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-top">
                        Region
                        <span class="badge bg-tiffany rounded-pill">55</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Constituency
                        <span class="badge bg-success rounded-pill">20</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Area
                        <span class="badge bg-warning rounded-pill">10</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-12 col-lg-12 col-xl-4 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0">Constituencies</h6>
                        <div class="ms-auto">
                            <div class="d-flex align-items-center font-13 gap-2">
                                <span class="border px-1 rounded cursor-pointer"><i
                                        class="bx bxs-circle me-1 text-primary"></i>Shares</span>
                                <span class="border px-1 rounded cursor-pointer"><i
                                        class="bx bxs-circle me-1 text-success"></i>Likes</span>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container4">
                        <canvas id="chart3" width="598" height="350"
                            style="display: block; box-sizing: border-box; height: 350px; width: 598px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->


    
       
    @endsection
