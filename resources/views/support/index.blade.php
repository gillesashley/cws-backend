@extends('layouts.app')

@section('content')
    {{-- Bread crumbs --}}
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Support</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
              <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="help-buoy" role="img"
                          class="md hydrated" aria-label="home outline"></ion-icon></a>
              </li>
              
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

  <div class="col-xl-8 mx-auto">
    <div class="card">
        <div class="card-body">
            <div class="border p-3 rounded">
                <h6 class="mb-0 text-uppercase">Contact Admin</h6>
            <hr>
            <form class="row g-3">
                <div class="col-12">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Constituency</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Report Issue</label>
                    <textarea class="form-control" rows="8" cols="8"></textarea>
                </div>
                <div class="col-12">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
  </div>

@endsection
