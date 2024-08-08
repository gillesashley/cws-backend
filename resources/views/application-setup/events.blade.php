@extends('layouts.app')

@section('content')
    <!--start breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Events</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
              <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="today" role="img"
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

  <div class="card">
    <div class="card-body">
      <div class="p-4 border rounded">
        <h1>Event Schedule</h1>

        <form id="manifestoForm" action="" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Event Title</label>
                <input type="text" name="title" id="title" class="form-control" required maxlength="255"
                    value="">
            </div><br>

            <div class="form-group">
                <label for="content">Agenda</label>
                <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
            </div><br>

            <div class="mb-3">
                <label class="form-label">Shedule Date and Time of Event</label>
                <input class="result form-control" type="text" id="date-time" placeholder="Date Picker..." data-dtp="dtp_ghTYS">
            </div><br>

            <div class="form-group">
                <label for="media">Event Flyer</label>
                <input type="file" name="media[]" id="media" class="form-control-file" accept="image/*,video/*"
                    multiple>
            </div>

            <div id="mediaPreview" class="mt-3">
                <!-- Previews will be appended here -->
            </div><br>

            <button type="submit" class="btn btn-primary">Schedule Event</button>
        </form>
    </div>
</div>
</div>

</div>

@endsection('content')
