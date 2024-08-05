@extends('layouts.app')

@section('content')
   {{-- Breadcrumb --}}
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3">Profile</div>
  <div class="ps-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0 align-items-center">
            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="person-circle-sharp" role="img"
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
    <div class="row">
        <div class="col-12 col-lg-8 col-xl-9">
          <div class="card overflow-hidden radius-10">
            <div class="profile-cover bg-dark position-relative mb-4">
              <div class="user-profile-avatar shadow position-absolute top-50 start-0 translate-middle-x">
                <img src="{{ asset('assets/images/avatars/06.png')}} " alt="...">
              </div>
            </div>
            <div class="card-body">
              <div class="mt-5 d-flex align-items-start justify-content-between">
                <div class="">
                  <h3 class="mb-2">Jhon Deo</h3>
                  <p class="mb-1">Constituency Admin</p>
                  <p>Gbawe South, Mallam</p>
                  
                </div>
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-3">
          <div class="card radius-10">
            <div class="card-body">
              <h5 class="mb-3">Geolocation</h5>
               <p class="mb-0"><ion-icon name="compass-sharp" class="me-2 md hydrated" role="img" aria-label="compass sharp"></ion-icon>Region - Greater Accra</p>
               <p class="mb-0"><ion-icon name="compass-sharp" class="me-2 md hydrated" role="img" aria-label="compass sharp"></ion-icon>Constituency - Gbawe South</p>
               <p class="mb-0"><ion-icon name="compass-sharp" class="me-2 md hydrated" role="img" aria-label="compass sharp"></ion-icon>Area - Mallam</p>
            </div>
          </div>
          <div class="ms-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                Edit Profile
            </button>
        </div>
          </div>

        </div>
      </div>
@endsection
