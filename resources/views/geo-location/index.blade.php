@extends('layouts.app')

@section('content')
{{-- Bread crumbs --}}
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Geolocation</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0 align-items-center">
              <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="compass" role="img"
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
                <iframe id="mapFrame" width="100%" height="400" style="border:0" loading="lazy" allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" novalidate="">
                        <div class="col-md-4">
                            <label for="region_id" class="form-label">Region</label>
                            <select class="form-select" id="region_id" name="region_id" required>
                                <option value="">Select Region</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a region.</div>
                        </div>
                        <div class="col-md-4">
                            <label for="constituency_id" class="form-label">Constituency</label>
                            <select class="form-select" id="constituency_id" name="constituency_id" required>
                                <option value="">Select Constituency</option>
                                @foreach ($constituencies as $constituency)
                                    <option value="{{ $constituency->id }}" data-region="{{ $constituency->region_id }}">
                                        {{ $constituency->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a constituency.</div>
                        </div>
                        <div class="col-md-4">
                            <label for="geographical_area" class="form-label">Geographical Area</label>
                            <input type="text" class="form-control" id="geographical_area" name="geographical_area" required>
                            <div class="invalid-feedback">Please provide a valid geolocation.</div>
                        </div>           
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Add Geographical Area</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add JavaScript for dynamic dropdowns and map update -->
    <script>
        $(document).ready(function() {
            // Function to filter constituencies based on selected region
            function filterConstituencies() {
                var regionId = $('#region_id').val();
                var constituencySelect = $('#constituency_id');
                constituencySelect.find('option').show();
                if (regionId) {
                    constituencySelect.find('option').not('[data-region="' + regionId + '"]').hide();
                }
                constituencySelect.val('');
            }

            // Filter constituencies when region changes
            $('#region_id').change(filterConstituencies);

            // Update map when geographical area changes
            $('#geographical_area').on('input', function() {
                updateMap();
            });

            // Function to update the map
            function updateMap() {
                const apiKey = '{{ env('GOOGLE_MAPS_API_KEY') }}';
                const area = $('#geographical_area').val() + ',Ghana';
                const iframe = document.getElementById('mapFrame');
                iframe.src = `https://www.google.com/maps/embed/v1/search?key=${apiKey}&q=${area}`;
            }

            // Initial map update
            updateMap();
        });
    </script>

@endsection