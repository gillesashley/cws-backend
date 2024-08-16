@extends('layouts.app')

@section('content')
    <!--start breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Points & Payments</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
              <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="receipt" role="img"
                    class="md hydrated" aria-label="home outline"></ion-icon></a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">Transactions</li>
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

  <div class="card radius-10 w-100">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <h6 class="mb-0">Payment Transactions</h6>
            <div class="fs-5 ms-auto dropdown">
                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots"></i>
                </div>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div><br>
    </div>
</div>

<table id="example" class="table-responsive table table-striped table-bordered align-middle mb-0"
            style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Constituency</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td>001</td>
                        <td>Kwame Asamoah</td>
                        <td>South Gbawe</td>
                        <td>Ghc 350</td>
                        <td></td>
                        <td></td>
                        
                    </tr>
                
            </tbody>

</div> 
@endsection
