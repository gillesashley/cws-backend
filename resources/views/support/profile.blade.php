@extends('layouts.app')

@section('content')
    <h2>Admin profile</h2>
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
                Edit Admin Profile
            </button>
        </div>
          </div>

        </div>
      </div>
@endsection
