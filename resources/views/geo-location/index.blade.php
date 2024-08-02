@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add new geolocation</h1>

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
                <label for="validationCustom03" class="form-label">Region</label>
                <select class="form-select" id="validationCustom04" required="">
                    <option selected="" disabled="" value="">Choose...</option>
                    <option>...</option>
                  </select>
              </div>
              <div class="col-md-4">
                <label for="validationCustom04" class="form-label">Constituency</label>
                <select class="form-select" id="validationCustom04" required="">
                  <option selected="" disabled="" value="">Choose...</option>
                  <option>...</option>
                </select>
                <div class="invalid-feedback">Please select a valid state.</div>
              </div>
              <div class="col-md-4">
                <label for="validationCustom05" class="form-label">Geographical Area</label>
                <input type="text" class="form-control" id="validationCustom05" required="">
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


<!-- Add JavaScript to dynamically insert the API key -->
<script>
    // Replace with the actual API key obtained from your .env file
    const apiKey = 'AIzaSyAPozn9l_ge8sxcWkAwkb4a-gmLBVy_5ns';

    // Replace with the desired geographical area from the textfield
    const area = 'Accra,+Ghana';

    // Get the iframe element
    const iframe = document.getElementById('mapFrame');

    // Set the iframe src with the API key
    iframe.src = `https://www.google.com/maps/embed/v1/search?key=${apiKey}&q=${area}`;
</script>

@endsection


